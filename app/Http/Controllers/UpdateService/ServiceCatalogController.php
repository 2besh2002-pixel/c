<?php

namespace App\Http\Controllers\UpdateService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\ChangePasswordRequest;
use App\Http\Requests\Business\ChargeBalanceRequest;
use App\Http\Requests\Business\SubmitRequestRequest;
use App\Http\Requests\Business\UpdateProfileRequest;
use App\Models\Business\Office;
use App\Models\Business\OfficeRequest;
use App\Models\Business\OfficeService;
use App\Models\BusinessNotification;
use App\Models\Category;
use App\Models\Entity;
use App\Models\ServicePayment;
use App\Models\ServiceRequest;
use App\Services\ServiceRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ServiceCatalogController extends Controller
{
    public function index(): View
    {
        $categories = collect();
        $totalEntities = 0;
        $totalServices = 0;
        $officeCounts = [
            'law'         => 0,
            'services'    => 0,
            'customs'     => 0,
            'accounting'  => 0,
            'engineering' => 0,
            'freelance'   => 0,
        ];

        try {
            $categories = Category::with([
                'entities' => fn($q) => $q->where('is_active', true)
                    ->with(['govServices' => fn($sq) => $sq->where('is_active', true)->orderBy('sort_order')])
                    ->orderBy('sort_order'),
            ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($cat) {
                $entitiesCount = $cat->entities->count();
                $servicesCount = $cat->entities->sum(fn($ent) => $ent->govServices->count());

                return [
                    'id'             => $cat->id,
                    'key'            => $cat->key,
                    'name_ar'        => $cat->name_ar,
                    'name_en'        => $cat->name_en,
                    'icon'           => $cat->icon,
                    'color'          => $cat->color,
                    'bg'             => $cat->bg,
                    'entities_count' => $entitiesCount,
                    'services_count' => $servicesCount,
                    'entities'       => $cat->entities->map(fn($ent) => [
                        'id'             => $ent->id,
                        'name_ar'        => $ent->name_ar,
                        'name_en'        => $ent->name_en,
                        'icon'           => $ent->icon,
                        'color'          => $ent->color,
                        'bg'             => $ent->bg,
                        'tag_ar'         => $ent->tag_ar,
                        'tag_en'         => $ent->tag_en,
                        'services_count' => $ent->govServices->count(),
                        'services'       => $ent->govServices->map(fn($svc) => [
                            'id'             => $svc->id,
                            'name_ar'        => $svc->name_ar,
                            'name_en'        => $svc->name_en,
                            'icon'           => $svc->icon,
                            'price'          => (float) $svc->price,
                            'estimated_days' => $svc->estimated_days,
                        ]),
                    ]),
                ];
            });

            $totalEntities = $categories->sum('entities_count');
            $totalServices = $categories->sum('services_count');

            $dbOfficeCounts = Office::where('is_active', true)
                ->selectRaw('type, count(*) as count')
                ->groupBy('type')
                ->pluck('count', 'type')
                ->toArray();

            $officeCounts = array_merge($officeCounts, $dbOfficeCounts);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Categories DB fetch skipped (offline/fallback mode): ' . $e->getMessage());
            $categories = collect();
        }

        try {
            $homepageSettings = \App\Models\HomepageSetting::query()->pluck('value', 'key');
            $homepageSlides   = \App\Models\HomepageSlide::active()->get()->map(fn ($s) => [
                'id'         => $s->id,
                'title'      => $s->title,
                'image_url'  => $s->image_url,
                'link_url'   => $s->link_url,
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Homepage settings/slides fetch skipped: ' . $e->getMessage());
            $homepageSettings = collect();
            $homepageSlides   = collect();
        }

        $homepageMedia = [
            'video_file'   => $this->resolveMediaUrl($homepageSettings['video_file'] ?? 'videos/0829.mp4'),
            'video_poster' => $this->resolveMediaUrl($homepageSettings['video_poster'] ?? 'images/logo2.jpg'),
        ];

        return view('update_service.index', compact(
            'categories',
            'totalEntities',
            'totalServices',
            'officeCounts',
            'homepageSettings',
            'homepageSlides',
            'homepageMedia'
        ));
    }

    public function userDashboard(): View
    {
        return view('update_service.user_dashboard');
    }

    public function categoryPage(string $key): View
    {
        try {
            $category = Category::with([
                'entities' => fn($q) => $q->where('is_active', true)
                    ->with(['govServices' => fn($sq) => $sq->where('is_active', true)->orderBy('sort_order')])
                    ->orderBy('sort_order'),
            ])->where('key', $key)->where('is_active', true)->first();

            if (!$category) {
                $category = new Category([
                    'key' => $key,
                    'name_ar' => $key === 'ministries' ? 'الوزارات' : ($key === 'authorities' ? 'الهيئات والمؤسسات الحكومية' : 'الشركات والجهات الخاصة'),
                    'name_en' => ucfirst($key),
                ]);
                $category->setRelation('entities', collect());
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('categoryPage DB error: ' . $e->getMessage());
            $category = new Category([
                'key' => $key,
                'name_ar' => $key === 'ministries' ? 'الوزارات' : ($key === 'authorities' ? 'الهيئات والمؤسسات الحكومية' : 'الشركات والجهات الخاصة'),
                'name_en' => ucfirst($key),
            ]);
            $category->setRelation('entities', collect());
        }

        return view('update_service.catalog_category', compact('category'));
    }

    public function entityPage(string $key, int $entityId): View
    {
        try {
            $category = Category::where('key', $key)->where('is_active', true)->first();
            if (!$category) {
                $category = new Category(['key' => $key, 'name_ar' => 'الجهة', 'name_en' => 'Entity']);
            }

            $entity = Entity::where('id', $entityId)
                ->where('is_active', true)
                ->with(['govServices' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')])
                ->first();

            if (!$entity) {
                $entity = new Entity(['id' => $entityId, 'name_ar' => 'الجهة المطلوبة', 'name_en' => 'Requested Entity']);
                $entity->setRelation('govServices', collect());
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('entityPage DB error: ' . $e->getMessage());
            $category = new Category(['key' => $key, 'name_ar' => 'الجهة', 'name_en' => 'Entity']);
            $entity = new Entity(['id' => $entityId, 'name_ar' => 'الجهة المطلوبة', 'name_en' => 'Requested Entity']);
            $entity->setRelation('govServices', collect());
        }

        return view('update_service.catalog_entity', compact('category', 'entity'));
    }

    public function officeDirectory(string $type): View
    {
        $typeLabels = Office::$typeLabels ?? [
            'law'         => 'مكاتب المحاماة',
            'services'    => 'مكاتب الخدمات والتعقيب',
            'customs'     => 'شركات التخليص الجمركي',
            'accounting'  => 'الاستشارات المالية والضريبية',
            'engineering' => 'الاستشارات الهندسية',
            'freelance'   => 'أصحاب المهن الحرة',
        ];

        $offices = collect();

        try {
            $offices = Office::where('type', $type)
                ->where('is_active', true)
                ->where('is_verified', true)
                ->with(['specialtiesRelation', 'services'])
                ->get();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('officeDirectory DB error: ' . $e->getMessage());
            $offices = collect();
        }

        return view('update_service.office_directory', compact('type', 'offices', 'typeLabels'));
    }

    public function officeDetail(string $type, int $officeId): View
    {
        $typeLabels = Office::$typeLabels ?? [
            'law'         => 'مكاتب المحاماة',
            'services'    => 'مكاتب الخدمات والتعقيب',
            'customs'     => 'شركات التخليص الجمركي',
            'accounting'  => 'الاستشارات المالية والضريبية',
            'engineering' => 'الاستشارات الهندسية',
            'freelance'   => 'أصحاب المهن الحرة',
        ];

        try {
            $office = Office::where('id', $officeId)
                ->where('type', $type)
                ->where('is_active', true)
                ->where('is_verified', true)
                ->with([
                    'specialtiesRelation',
                    'services' => fn($q) => $q->where('is_active', true)->orderBy('sort_order'),
                ])
                ->first();

            if (!$office) {
                $office = new Office(['id' => $officeId, 'type' => $type, 'name_ar' => 'مكتب معتمد', 'name_en' => 'Certified Office']);
                $office->setRelation('specialtiesRelation', collect());
                $office->setRelation('services', collect());
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('officeDetail DB error: ' . $e->getMessage());
            $office = new Office(['id' => $officeId, 'type' => $type, 'name_ar' => 'مكتب معتمد', 'name_en' => 'Certified Office']);
            $office->setRelation('specialtiesRelation', collect());
            $office->setRelation('services', collect());
        }

        return view('update_service.office_detail', compact('type', 'office', 'typeLabels'));
    }


    public function submitOfficeRequest(Request $request): JsonResponse
    {
        $request->validate([
            'office_id'         => 'required|integer',
            'office_service_id' => 'required|integer',
            'client_name'       => 'required|string|max:100',
            'client_phone'      => 'required|string|max:20',
            'client_id_number'  => 'nullable|string|max:20',
            'notes'             => 'nullable|string|max:1000',
        ]);

        $office = Office::where('id', $request->office_id)
            ->where('is_active', true)->where('is_verified', true)
            ->firstOrFail();

        $service = OfficeService::where('id', $request->office_service_id)
            ->where('office_id', $office->id)->where('is_active', true)
            ->firstOrFail();

        $user             = \Illuminate\Support\Facades\Auth::guard('business')->user();
        $commissionAmount = round($service->price * ($office->commission_rate / 100), 2);
        $refNumber        = 'OF-' . strtoupper(substr(md5(uniqid()), 0, 8));

        $req = OfficeRequest::create([
            'ref_number'        => $refNumber,
            'user_id'           => $user->id,
            'office_id'         => $office->id,
            'office_service_id' => $service->id,
            'client_name'       => $request->client_name,
            'client_phone'      => $request->client_phone,
            'client_email'      => $user->email,
            'client_id_number'  => $request->client_id_number,
            'notes'             => $request->notes,
            'price'             => $service->price,
            'commission_amount' => $commissionAmount,
            'status'            => 'pending',
        ]);

        // Notifications
        BusinessNotification::forAdmin('new_office_request',
            "طلب مباشر جديد — {$office->name_ar}",
            "العميل {$request->client_name} طلب خدمة من {$office->name_ar} — المرجع: {$refNumber} — المبلغ: {$service->price} ر.س",
            ['request_id' => $req->id, 'ref_number' => $refNumber, 'office_id' => $office->id],
            $req->id
        );
        BusinessNotification::forOffice($office->id, 'new_office_request',
            'طلب خدمة جديد من عميل',
            "تلقيت طلباً جديداً من {$request->client_name} — المرجع: {$refNumber}",
            ['request_id' => $req->id, 'ref_number' => $refNumber],
            $req->id
        );
        if ($user) {
            BusinessNotification::forUser($user->id, 'request_submitted',
                'تم إرسال طلبك بنجاح',
                "تم إرسال طلبك إلى {$office->name_ar} — المرجع: {$refNumber}",
                ['request_id' => $req->id, 'ref_number' => $refNumber],
                $req->id
            );
        }

        return response()->json([
            'message'    => 'تم إرسال طلبك بنجاح. سيتواصل معك المكتب قريباً.',
            'ref_number' => $refNumber,
        ], 201);
    }

    /* ── JSON: all categories with entities & services ── */
    public function apiServices(): JsonResponse
    {
        try {
            $categories = Category::with([
                'entities' => fn($q) => $q->where('is_active', true)
                    ->with(['govServices' => fn($sq) => $sq->where('is_active', true)->orderBy('sort_order')])
                    ->orderBy('sort_order'),
            ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn($cat) => [
                'id'       => $cat->id,
                'key'      => $cat->key,
                'name_ar'  => $cat->name_ar,
                'name_en'  => $cat->name_en,
                'icon'     => $cat->icon,
                'color'    => $cat->color,
                'bg'       => $cat->bg,
                'entities' => $cat->entities->map(fn($ent) => [
                    'id'       => $ent->id,
                    'name_ar'  => $ent->name_ar,
                    'name_en'  => $ent->name_en,
                    'icon'     => $ent->icon,
                    'color'    => $ent->color,
                    'bg'       => $ent->bg,
                    'tag_ar'   => $ent->tag_ar,
                    'tag_en'   => $ent->tag_en,
                    'services' => $ent->govServices->map(fn($svc) => [
                        'id'             => $svc->id,
                        'name_ar'        => $svc->name_ar,
                        'name_en'        => $svc->name_en,
                        'icon'           => $svc->icon,
                        'price'          => (float) $svc->price,
                        'estimated_days' => $svc->estimated_days,
                    ]),
                ]),
            ]);

            return response()->json($categories);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('apiServices DB error: ' . $e->getMessage());
            return response()->json([]);
        }
    }

    /* ── JSON: public office type counts (for main page) ── */
    public function publicOfficeTypes(): JsonResponse
    {
        $types = ['law', 'services', 'customs'];
        $result = ['law' => 0, 'services' => 0, 'customs' => 0];

        try {
            $rows = Office::where('is_active', true)
                ->where('is_verified', true)
                ->selectRaw('type, COUNT(*) as count')
                ->groupBy('type')
                ->get()
                ->keyBy('type');

            foreach ($types as $t) {
                $result[$t] = (int) ($rows[$t]->count ?? 0);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('publicOfficeTypes DB error: ' . $e->getMessage());
        }

        return response()->json($result);
    }

    /* ── JSON: submit service request ── */
    public function submitRequest(SubmitRequestRequest $request, ServiceRequestService $service): JsonResponse
    {
        $sr = $service->submit(
            $request->validated(),
            $request->file('attachments') ?? [],
            auth('business')->user()
        );

        return response()->json(['ref_number' => $sr->ref_number, 'id' => $sr->id], 201);
    }

    /* ── JSON: my requests list (paginated, optional ?status=) ── */
    public function myRequests(Request $request): JsonResponse
    {
        $query = ServiceRequest::with(['govService', 'entity', 'logs'])
            ->where('user_id', auth('business')->id());

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $paginator = $query->orderByDesc('created_at')->paginate(10);

        $paginator->getCollection()->transform(fn($r) => $r->toApiArray());

        return response()->json($paginator);
    }

    /* ── JSON: single request detail ── */
    public function myRequestShow(int $id): JsonResponse
    {
        $sr = ServiceRequest::with(['govService', 'entity.category', 'logs'])->findOrFail($id);

        // Policy check: user can only view own requests; admin can view all
        if (!auth('business')->user()->isAdmin() && $sr->user_id !== auth('business')->id()) {
            abort(403, 'غير مصرح لك بعرض هذا الطلب.');
        }

        return response()->json($sr);
    }

    /* ── JSON: user dashboard stats ── */
    public function userStats(): JsonResponse
    {
        $user = auth('business')->user();
        $uid  = $user->id;

        // Single aggregation query instead of 5 separate count queries
        $counts = ServiceRequest::where('user_id', $uid)
            ->selectRaw("
                COUNT(*) as total,
                SUM(status = 'pending') as pending,
                SUM(status IN ('processing', 'in_progress')) as processing,
                SUM(status = 'done') as done,
                SUM(status = 'rejected') as rejected
            ")
            ->first();

        $recentRequests = ServiceRequest::with(['govService', 'entity', 'logs'])
            ->where('user_id', $uid)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get()
            ->map(fn($r) => $r->toApiArray());

        $recentPayments = ServicePayment::where('user_id', $uid)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return response()->json([
            'user' => [
                'id'      => $user->id,
                'name'    => $user->name,
                'email'   => $user->email,
                'phone'   => $user->phone ?? '',
                'role'    => $user->role,
                'balance' => ServicePayment::getBalance($uid),
                'stats'   => [
                    'total'      => (int) $counts->total,
                    'pending'    => (int) $counts->pending,
                    'processing' => (int) $counts->processing,
                    'done'       => (int) $counts->done,
                    'rejected'   => (int) $counts->rejected,
                ],
            ],
            'recent_requests' => $recentRequests,
            'recent_payments' => $recentPayments,
        ]);
    }

    /* ── JSON: charge balance ── */
    public function chargeBalance(ChargeBalanceRequest $request): JsonResponse
    {
        ServicePayment::create([
            'user_id'        => auth('business')->id(),
            'amount'         => $request->amount,
            'type'           => 'charge',
            'description_ar' => 'شحن رصيد',
            'description_en' => 'Balance top-up',
            'status'         => 'completed',
        ]);

        return response()->json(['message' => 'تم شحن الرصيد', 'amount' => $request->amount]);
    }

    /* ── JSON: payment history ── */
    public function paymentHistory(): JsonResponse
    {
        $payments = ServicePayment::where('user_id', auth('business')->id())
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json($payments);
    }

    /* ── JSON: update profile ── */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $user = auth('business')->user();
        $user->update($request->validated());

        return response()->json(['message' => 'تم حفظ البيانات', 'user' => [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? '',
        ]]);
    }

    /* ── JSON: change password ── */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = auth('business')->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'كلمة المرور الحالية غير صحيحة'], 422);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return response()->json(['message' => 'تم تغيير كلمة المرور بنجاح']);
    }

    private function resolveMediaUrl(string $path): string
    {
        if (str_starts_with($path, 'homepage/')) {
            return \Illuminate\Support\Facades\Storage::url($path);
        }

        return asset($path);
    }
}
