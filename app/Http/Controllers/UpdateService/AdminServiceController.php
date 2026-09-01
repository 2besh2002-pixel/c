<?php

namespace App\Http\Controllers\UpdateService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\CreateCategoryRequest;
use App\Http\Requests\Business\CreateEntityRequest;
use App\Http\Requests\Business\CreateGovServiceRequest;
use App\Http\Requests\Business\RequestInfoRequest;
use App\Http\Requests\Business\SendNoteRequest;
use App\Http\Requests\Business\UpdateCategoryRequest;
use App\Http\Requests\Business\UpdateEntityRequest;
use App\Http\Requests\Business\UpdateStatusRequest;
use App\Mail\RequestStatusChangedMail;
use App\Models\BusinessNotification;
use App\Models\Category;
use App\Models\Entity;
use App\Models\GovService;
use App\Models\RequestLog;
use App\Models\ServicePayment;
use App\Models\ServiceRequest;
use App\Models\Business\BusinessUser;
use App\Models\Business\Office;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Business\OfficeDocument;
use Illuminate\Support\Facades\Storage;
use App\Models\Business\Specialty;


class AdminServiceController extends Controller
{
    public function dashboard(): View
    {
        return view('update_service.admin_dashboard');
    }

    /* ── JSON: admin stats (structure matches dashboard JS) ── */
    public function adminStats(): JsonResponse
    {
        $total      = ServiceRequest::count();
        $pending    = ServiceRequest::where('status', 'pending')->count();
        $processing = ServiceRequest::whereIn('status', ['processing', 'in_progress'])->count();
        $done       = ServiceRequest::where('status', 'done')->count();
        $rejected   = ServiceRequest::where('status', 'rejected')->count();
        $revenue    = (float) ServiceRequest::where('status', 'done')->sum('price');
        $users      = BusinessUser::count();

        $weekRevenue  = (float) ServiceRequest::where('status', 'done')
            ->where('completed_at', '>=', now()->subDays(7))
            ->sum('price');
        $pendingRevenue = (float) ServiceRequest::whereIn('status', ['pending', 'processing', 'in_progress'])->sum('price');
        $avgPrice       = $done > 0 ? round($revenue / $done, 2) : 0;

        // Last 7 days chart
        $chart = collect(range(6, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo);
            return [
                'label' => $date->format('D'),
                'count' => ServiceRequest::whereDate('created_at', $date->toDateString())->count(),
            ];
        })->values()->all();

        // Top 5 services (last 30 days)
        $topCounts = ServiceRequest::where('created_at', '>=', now()->subDays(30))
            ->select('service_id', DB::raw('count(*) as count'))
            ->groupBy('service_id')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        $govServicesMap = GovService::with('entity')
            ->whereIn('id', $topCounts->pluck('service_id')->filter())
            ->get()
            ->keyBy('id');

        $topServices = $topCounts->map(fn($r) => [
            'name_ar'   => $govServicesMap[$r->service_id]?->name_ar ?? '—',
            'name_en'   => $govServicesMap[$r->service_id]?->name_en ?? '—',
            'icon'      => $govServicesMap[$r->service_id]?->icon ?? 'ti-file-text',
            'entity_ar' => $govServicesMap[$r->service_id]?->entity?->name_ar ?? '',
            'entity_en' => $govServicesMap[$r->service_id]?->entity?->name_en ?? '',
            'color'     => $govServicesMap[$r->service_id]?->entity?->color ?? '#1A237E',
            'bg'        => $govServicesMap[$r->service_id]?->entity?->bg ?? 'rgba(26,35,126,.1)',
            'count'     => (int) $r->count,
        ]);

        // Recent payments (last 10)
        $recentPayments = ServicePayment::with('user')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $statusColors = ['pending' => '#E65100', 'processing' => '#0277BD', 'in_progress' => '#0277BD', 'done' => '#1B5E20', 'rejected' => '#C62828'];
        $labels = ServiceRequest::statusLabels();

        return response()->json([
            'requests' => compact('total', 'pending', 'processing', 'done', 'rejected'),
            'users'    => $users,
            'revenue'  => [
                'total'   => $revenue,
                'week'    => $weekRevenue,
                'avg'     => $avgPrice,
                'pending' => $pendingRevenue,
            ],
            'byStatus' => [
                ['label' => $labels['pending'],     'value' => $pending,    'color' => $statusColors['pending']],
                ['label' => $labels['in_progress'], 'value' => $processing, 'color' => $statusColors['in_progress']],
                ['label' => $labels['done'],        'value' => $done,       'color' => $statusColors['done']],
                ['label' => $labels['rejected'],    'value' => $rejected,   'color' => $statusColors['rejected']],
            ],
            'chart_last7'     => $chart,
            'top_services'    => $topServices,
            'recent_payments' => $recentPayments,
        ]);
    }

    /* ── JSON: all requests (with filters) ── */
    public function adminRequests(Request $request): JsonResponse
    {
        $query = ServiceRequest::with(['govService', 'entity.category', 'user', 'logs'])
            ->orderByDesc('created_at');

        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->search) {
            $s = $request->search;
            $query->where(fn($q) =>
                $q->where('ref_number', 'like', "%$s%")
                  ->orWhere('client_name', 'like', "%$s%")
                  ->orWhere('client_email', 'like', "%$s%")
            );
        }

        $paginated = $query->paginate(15);

        $paginated->getCollection()->transform(fn($r) => $r->toApiArray());

        return response()->json($paginated);
    }

    /* ── JSON: update request status ── */
    public function updateRequestStatus(UpdateStatusRequest $request, int $id): JsonResponse
    {

        $sr = ServiceRequest::findOrFail($id);

        $updates = [];
        $logNote = null;

        if ($request->has('status')) {
            $updates['status']        = $request->status;
            $updates['reject_reason'] = $request->reject_reason;
            $updates['handled_by']    = auth('business')->id();
            $updates['completed_at']  = $request->status === 'done' ? now() : null;
            $logNote = $request->reject_reason;
        }

        if ($request->has('estimated_completion')) {
            $updates['estimated_completion'] = $request->estimated_completion;
            $logNote = $logNote ?? ('الوقت المتوقع: ' . $request->estimated_completion);
        }

        if (empty($updates)) {
            return response()->json(['message' => 'لا توجد بيانات للتحديث'], 422);
        }

        $sr->update($updates);

        RequestLog::create([
            'request_id' => $sr->id,
            'user_id'    => auth('business')->id(),
            'status'     => $sr->fresh()->status,
            'log_type'   => 'status_change',
            'note'       => $logNote,
        ]);

        // Notify user of status change
        if ($request->has('status')) {
            $label = ServiceRequest::statusLabels()[$request->status] ?? $request->status;
            $body  = "تم تحديث حالة طلبك #{$sr->ref_number} إلى: {$label}";
            if ($request->status === 'rejected' && $request->reject_reason) {
                $body .= "\nسبب الرفض: " . $request->reject_reason;
            }

            BusinessNotification::send(
                $sr->user_id,
                'status_update',
                "تحديث طلب #{$sr->ref_number}",
                $body,
                $sr->id,
                auth('business')->id()
            );

            // Send email notification
            try {
                Mail::to($sr->client_email)->queue(new RequestStatusChangedMail($sr->fresh(), $label));
            } catch (\Throwable) {
                // Email is non-critical — continue
            }
        }

        return response()->json(['message' => 'تم التحديث', 'status' => $sr->fresh()->status]);
    }

    /* ── JSON: admin sends a note to the user ── */
    public function sendNote(SendNoteRequest $request, int $id): JsonResponse
    {
        $sr = ServiceRequest::findOrFail($id);

        RequestLog::create([
            'request_id' => $sr->id,
            'user_id'    => auth('business')->id(),
            'status'     => $sr->status,
            'log_type'   => 'admin_note',
            'note'       => $request->note,
        ]);

        BusinessNotification::send(
            $sr->user_id,
            'admin_note',
            "ملاحظة من الإدارة - طلب #{$sr->ref_number}",
            $request->note,
            $sr->id,
            auth('business')->id()
        );

        try {
            Mail::to($sr->client_email)->queue(new RequestStatusChangedMail($sr, 'ملاحظة من الإدارة', $request->note));
        } catch (\Throwable) {}

        return response()->json(['message' => 'تم إرسال الملاحظة']);
    }

    /* ── JSON: admin requests more info from user ── */
    public function requestInfo(RequestInfoRequest $request, int $id): JsonResponse
    {
        $sr = ServiceRequest::findOrFail($id);
        $sr->update(['status' => 'in_progress']);

        RequestLog::create([
            'request_id' => $sr->id,
            'user_id'    => auth('business')->id(),
            'status'     => 'in_progress',
            'log_type'   => 'info_request',
            'note'       => $request->message,
        ]);

        BusinessNotification::send(
            $sr->user_id,
            'info_request',
            "مطلوب معلومات إضافية - طلب #{$sr->ref_number}",
            $request->message,
            $sr->id,
            auth('business')->id()
        );

        try {
            Mail::to($sr->client_email)->queue(new RequestStatusChangedMail($sr, 'مطلوب معلومات إضافية', $request->message));
        } catch (\Throwable) {}

        return response()->json(['message' => 'تم إرسال طلب المعلومات']);
    }

    /* ── JSON: update service price ── */
    public function updateServicePrice(Request $request, int $id): JsonResponse
    {
        $request->validate(['price' => 'required|numeric|min:0']);
        $svc = GovService::findOrFail($id);
        $svc->update(['price' => $request->price]);

        return response()->json(['message' => 'تم تحديث السعر', 'price' => (float) $svc->price]);
    }

    /* ── JSON: update service ── */
    public function updateService(Request $request, int $id): JsonResponse
    {
        $svc = GovService::findOrFail($id);
        $svc->update($request->only(['name_ar', 'name_en', 'price', 'estimated_days', 'is_active']));

        return response()->json($svc);
    }

    /* ── JSON: admin transactions list ── */
    public function adminTransactions(): JsonResponse
    {
        $payments = ServicePayment::with('user')
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json($payments);
    }

    /* ══════════════════════════════════════════════════════
       CATALOG MANAGEMENT — Categories
    ══════════════════════════════════════════════════════ */

    public function adminCategories(): JsonResponse
    {
        $cats = Category::withCount('entities')
            ->orderBy('sort_order')
            ->get();

        return response()->json($cats);
    }

    public function createCategory(CreateCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();
        $cat  = Category::create($data + ['is_active' => true, 'sort_order' => $data['sort_order'] ?? Category::max('sort_order') + 1]);

        return response()->json($cat, 201);
    }

    public function updateCategory(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        $cat = Category::findOrFail($id);
        $cat->update($request->validated());

        return response()->json($cat);
    }

    public function deleteCategory(int $id): JsonResponse
    {
        $cat = Category::withCount('entities')->findOrFail($id);

        if ($cat->entities_count > 0) {
            return response()->json(['message' => 'لا يمكن حذف تصنيف يحتوي على جهات. احذف الجهات أولاً.'], 422);
        }

        $cat->delete();

        return response()->json(['message' => 'تم الحذف']);
    }

    public function createSpecialty(Request $request): JsonResponse
{
    $data = $request->validate([
        'office_type' => [
            'required',
            'in:law,services,customs,accounting,engineering,freelance',
        ],
        'name_ar' => 'required|string|max:255',
        'name_en' => 'nullable|string|max:255',
    ]);

    $specialty = \App\Models\Business\Specialty::create([
        'office_type' => $data['office_type'],
        'name_ar'     => $data['name_ar'],
        'name_en'     => $data['name_en'] ?? null,
        'is_active'   => true,
    ]);

    return response()->json([
        'message'   => 'تم إضافة التخصص بنجاح',
        'specialty' => $specialty,
    ], 201);
}

    /* ══════════════════════════════════════════════════════
       CATALOG MANAGEMENT — Entities (Sectors)
    ══════════════════════════════════════════════════════ */

    public function adminEntities(Request $request): JsonResponse
    {
        $query = Entity::with('category')->withCount('govServices');

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $entities = $query->orderBy('category_id')->orderBy('sort_order')->get();

        return response()->json($entities);
    }

   

public function deleteOfficeSpecialty(int $id): JsonResponse
{
    $specialty = Specialty::findOrFail($id);

    $specialty->delete();

    return response()->json([
        'message' => 'تم حذف التخصص بنجاح'
    ]);
}

public function createEntity(CreateEntityRequest $request): JsonResponse
{
    $data = $request->validated();

    // رفع الصورة
    if ($request->hasFile('images')) {

        $image = $request->file('images');

        $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images/uploads'), $fileName);

        $data['images'] = $fileName;
    }

    $entity = Entity::create(
        $data + [
            'is_active' => true,
            'sort_order' => $data['sort_order'] ?? Entity::max('sort_order') + 1,
        ]
    );

    return response()->json(
        $entity->load('category'),
        201
    );
}




public function updateEntity(UpdateEntityRequest $request, int $id): JsonResponse
{
    $entity = Entity::findOrFail($id);

    $data = $request->validated();

    if ($request->hasFile('images')) {

        // حذف الصورة القديمة
        $oldImage = public_path('images/uploads/' . $entity->images);

if ($entity->images && File::exists($oldImage)) {
    File::delete($oldImage);
}

        // رفع الصورة الجديدة
        $image = $request->file('images');

        $fileName = Str::uuid() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images/uploads'), $fileName);

        $data['images'] = $fileName;
    }

    $entity->update($data);

    return response()->json($entity->load('category'));
}


    public function deleteEntity(int $id): JsonResponse
    {
        $entity = Entity::withCount('govServices')->findOrFail($id);

        if ($entity->gov_services_count > 0) {
            return response()->json(['message' => 'لا يمكن حذف جهة تحتوي على خدمات. احذف الخدمات أولاً.'], 422);
        }

        $entity->delete();

        return response()->json(['message' => 'تم الحذف']);
    }

    /* ══════════════════════════════════════════════════════
       CATALOG MANAGEMENT — Services
    ══════════════════════════════════════════════════════ */

    public function adminServices(Request $request): JsonResponse
    {
        $query = GovService::with('entity.category');

        if ($request->entity_id) {
            $query->where('entity_id', $request->entity_id);
        }

        $services = $query->orderBy('entity_id')->orderBy('sort_order')->get();

        return response()->json($services);
    }

    public function createGovService(CreateGovServiceRequest $request): JsonResponse
    {
        $data = $request->validated();
        $svc  = GovService::create($data + ['is_active' => true, 'sort_order' => $data['sort_order'] ?? GovService::max('sort_order') + 1]);

        return response()->json($svc->load('entity.category'), 201);
    }

    public function deleteGovService(int $id): JsonResponse
    {
        $svc = GovService::withCount('serviceRequests')->findOrFail($id);

        if ($svc->service_requests_count > 0) {
            return response()->json(['message' => 'لا يمكن حذف خدمة لها طلبات مرتبطة بها.'], 422);
        }

        $svc->delete();

        return response()->json(['message' => 'تم الحذف']);
    }

    /* ══════════════════════════════════════════════════════
       OFFICE MANAGEMENT
    ══════════════════════════════════════════════════════ */
    public function adminOffices(Request $request): JsonResponse
{
    $query = Office::with([
        'profile',
        'documents',
        'specialtiesRelation'
    ])
    ->whereHas('profile', function ($q) {
        $q->where('profile_completed', true)
          ->whereIn('verification_status', ['pending', 'approved']);
    });

    if ($request->filled('type') && $request->type !== 'all') {
        $query->where('type', $request->type);
    }

    if ($request->filled('status')) {

        if ($request->status === 'verified') {
            $query->where('is_verified', true)
                  ->where('is_active', true);
        }

        if ($request->status === 'pending') {
            $query->where('is_verified', false);
        }

        if ($request->status === 'inactive') {
            $query->where('is_active', false);
        }
    }

    if ($request->filled('search')) {

        $s = $request->search;

        $query->where(function ($q) use ($s) {
            $q->where('name_ar', 'like', "%{$s}%")
              ->orWhere('name_en', 'like', "%{$s}%")
              ->orWhere('email', 'like', "%{$s}%")
              ->orWhere('cr_number', 'like', "%{$s}%");
        });
    }

    $offices = $query
        ->orderByDesc('created_at')
        ->paginate(15);

    /*
    |--------------------------------------------------------------------------
    | تجهيز التخصص الظاهر للأدمن
    |--------------------------------------------------------------------------
    */

    $offices->getCollection()->transform(function ($office) {

        /*
        | التخصص المكتوب يدويًا له الأولوية
        */

        if (!empty($office->profile?->custom_specialty)) {

            $office->display_specialty =
                $office->profile->custom_specialty;

        }

        /*
        | لو مفيش تخصص يدوي، نعرض تخصص القائمة
        */

        elseif ($office->specialtiesRelation->isNotEmpty()) {

            $office->display_specialty =
                $office->specialtiesRelation
                    ->first()
                    ->name_ar;

        }

        /*
        | مفيش تخصص
        */

        else {

            $office->display_specialty = null;
        }

        return $office;
    });

    return response()->json($offices);
}
public function adminOfficeStats(): JsonResponse
{
    $baseQuery = Office::whereHas('profile', function ($q) {
        $q->where('profile_completed', true)
          ->whereIn('verification_status', ['pending', 'approved']);
    });

    $total = (clone $baseQuery)->count();

    $verified = (clone $baseQuery)
        ->where('is_verified', true)
        ->where('is_active', true)
        ->count();

    $pending = (clone $baseQuery)
        ->where('is_verified', false)
        ->count();

    $inactive = (clone $baseQuery)
        ->where('is_active', false)
        ->count();

    $byType = (clone $baseQuery)
        ->selectRaw('type, COUNT(*) as count')
        ->groupBy('type')
        ->get()
        ->keyBy('type');

    return response()->json([
        'total'    => $total,
        'verified' => $verified,
        'pending'  => $pending,
        'inactive' => $inactive,

        'by_type' => [
            'law'         => (int) ($byType['law']->count ?? 0),
            'services'    => (int) ($byType['services']->count ?? 0),
            'customs'     => (int) ($byType['customs']->count ?? 0),
            'accounting'  => (int) ($byType['accounting']->count ?? 0),
            'engineering' => (int) ($byType['engineering']->count ?? 0),
            'freelance'   => (int) ($byType['freelance']->count ?? 0),
        ],
    ]);
}
public function verifyOffice(Request $request, int $id): JsonResponse
{
    $request->validate([
        'commission_rate' => 'nullable|numeric|min:0|max:100'
    ]);

    $office = Office::findOrFail($id);

    $office->update([
        'is_verified'     => true,
        'is_active'       => true,
        'commission_rate' => $request->input(
            'commission_rate',
            $office->commission_rate ?? 0
        ),
    ]);
// اعتماد التخصص اليدوي فقط
$specialtyId = DB::connection('business')
    ->table('bs_office_specialties')
    ->where('office_id', $office->id)
    ->join(
        'bs_specialties',
        'bs_office_specialties.specialty_id',
        '=',
        'bs_specialties.id'
    )
    ->where('bs_specialties.is_active', 0)
    ->value('bs_specialties.id');

if ($specialtyId) {
    DB::connection('business')
        ->table('bs_specialties')
        ->where('id', $specialtyId)
        ->update([
            'is_active' => 1,
            'updated_at' => now(),
        ]);
}

    return response()->json([
        'message' => 'تم اعتماد المكتب',
        'office'  => $office->fresh()
    ]);
}

    public function toggleOffice(int $id): JsonResponse
    {
        $office = Office::findOrFail($id);
        $office->update(['is_active' => !$office->is_active]);

        return response()->json(['message' => $office->is_active ? 'تم تفعيل المكتب' : 'تم إيقاف المكتب', 'is_active' => $office->is_active]);
    }

    public function deleteOffice(int $id): JsonResponse
    {
        $office = Office::findOrFail($id);
        $office->delete();

        return response()->json(['message' => 'تم حذف المكتب']);
    }

    /* ══════════════════════════════════════════════════════
       USERS MANAGEMENT
    ══════════════════════════════════════════════════════ */

    public function adminUserStats(): JsonResponse
    {
        $total        = BusinessUser::where('role', 'user')->count();
        $active       = BusinessUser::where('role', 'user')->where('is_active', true)->count();
        $banned       = BusinessUser::where('role', 'user')->where('is_active', false)->count();
        $newThisMonth = BusinessUser::where('role', 'user')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        return response()->json(compact('total', 'active', 'banned', 'newThisMonth'));
    }

    public function adminUsers(Request $request): JsonResponse
    {
        $query = BusinessUser::where('role', 'user');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) =>
                $q->where('name',  'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('phone', 'like', "%$s%")
            );
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $users   = $query->orderByDesc('created_at')->paginate(15);
        $userIds = $users->pluck('id')->toArray();

        $balances = ServicePayment::whereIn('user_id', $userIds)
            ->selectRaw("user_id, SUM(CASE WHEN type='charge' THEN amount WHEN type='payment' THEN -amount WHEN type='refund' THEN amount ELSE 0 END) as balance")
            ->groupBy('user_id')
            ->pluck('balance', 'user_id');

        $reqCounts = ServiceRequest::whereIn('user_id', $userIds)
            ->selectRaw('user_id, COUNT(*) as total, SUM(status="done") as done')
            ->groupBy('user_id')
            ->get()
            ->keyBy('user_id');

        $users->getCollection()->transform(fn($u) => [
            'id'         => $u->id,
            'name'       => $u->name,
            'email'      => $u->email,
            'phone'      => $u->phone ?? '',
            'is_active'  => $u->is_active ?? true,
            'balance'    => (float) ($balances[$u->id] ?? 0),
            'req_total'  => (int) ($reqCounts[$u->id]->total ?? 0),
            'req_done'   => (int) ($reqCounts[$u->id]->done  ?? 0),
            'created_at' => $u->created_at,
        ]);

        return response()->json($users);
    }

    public function toggleUserStatus(int $id): JsonResponse
    {
        $user = BusinessUser::where('role', 'user')->findOrFail($id);
        $user->update(['is_active' => !($user->is_active ?? true)]);

        return response()->json([
            'message'   => $user->is_active ? 'تم تفعيل الحساب' : 'تم حظر الحساب',
            'is_active' => $user->is_active,
        ]);
    }

    public function adjustUserBalance(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type'   => 'required|in:charge,payment',
            'reason' => 'nullable|string|max:200',
        ]);

        $user = BusinessUser::where('role', 'user')->findOrFail($id);

        ServicePayment::create([
            'user_id'        => $user->id,
            'amount'         => $request->amount,
            'type'           => $request->type,
            'description_ar' => $request->reason ?? ($request->type === 'charge' ? 'شحن رصيد من الإدارة' : 'خصم رصيد من الإدارة'),
            'description_en' => $request->reason ?? ($request->type === 'charge' ? 'Admin balance charge' : 'Admin balance deduction'),
            'status'         => 'completed',
        ]);

        return response()->json([
            'message'     => $request->type === 'charge' ? 'تم شحن الرصيد' : 'تم خصم الرصيد',
            'new_balance' => ServicePayment::getBalance($user->id),
        ]);
    }

    /* ══════════════════════════════════════════════════════
       ACTIVITY LOGS
    ══════════════════════════════════════════════════════ */

    public function adminActivityLogs(Request $request): JsonResponse
    {
        $query = RequestLog::with(['request:id,ref_number,client_name', 'user:id,name'])
            ->orderByDesc('created_at');

        if ($request->filled('log_type') && $request->log_type !== 'all') {
            $query->where('log_type', $request->log_type);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->whereHas('request', fn($q) =>
                $q->where('ref_number',  'like', "%$s%")
                  ->orWhere('client_name', 'like', "%$s%")
            );
        }

        $logs = $query->paginate(20);

        $logs->getCollection()->transform(fn($l) => [
            'id'          => $l->id,
            'ref_number'  => $l->request?->ref_number  ?? '—',
            'client_name' => $l->request?->client_name ?? '—',
            'admin_name'  => $l->user?->name            ?? 'النظام',
            'status'      => $l->status,
            'log_type'    => $l->log_type,
            'note'        => $l->note,
            'created_at'  => $l->created_at,
        ]);

        return response()->json($logs);
    }

    /* ══════════════════════════════════════════════════════
       ANALYTICS
    ══════════════════════════════════════════════════════ */

    public function adminAnalytics(Request $request): JsonResponse
    {
        $months = min((int)($request->months ?? 6), 12);

        $monthly = collect(range($months - 1, 0))->map(function ($ago) {
            $date = now()->subMonths($ago);
            return [
                'label'    => $date->format('M Y'),
                'revenue'  => (float) ServiceRequest::where('status', 'done')
                    ->whereYear('completed_at', $date->year)->whereMonth('completed_at', $date->month)->sum('price'),
                'requests' => ServiceRequest::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count(),
                'users'    => BusinessUser::where('role', 'user')
                    ->whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count(),
            ];
        })->values();

        $total    = ServiceRequest::count();
        $done     = ServiceRequest::where('status', 'done')->count();
        $rejected = ServiceRequest::where('status', 'rejected')->count();
        $revenue  = (float) ServiceRequest::where('status', 'done')->sum('price');

        $topServices = ServiceRequest::where('status', 'done')
            ->selectRaw('service_id, COUNT(*) as cnt, SUM(price) as rev')
            ->groupBy('service_id')
            ->orderByDesc('cnt')
            ->limit(8)
            ->with('govService.entity')
            ->get()
            ->map(fn($r) => [
                'name_ar'   => $r->govService?->name_ar ?? '—',
                'name_en'   => $r->govService?->name_en ?? '—',
                'entity_ar' => $r->govService?->entity?->name_ar ?? '',
                'color'     => $r->govService?->entity?->color ?? '#1A237E',
                'bg'        => $r->govService?->entity?->bg ?? 'rgba(26,35,126,.1)',
                'icon'      => $r->govService?->icon ?? 'ti-file-text',
                'count'     => (int) $r->cnt,
                'revenue'   => (float) $r->rev,
            ]);

        return response()->json([
            'monthly'          => $monthly,
            'total_revenue'    => $revenue,
            'completion_rate'  => $total > 0 ? round(($done / $total) * 100, 1) : 0,
            'rejection_rate'   => $total > 0 ? round(($rejected / $total) * 100, 1) : 0,
            'top_services'     => $topServices,
        ]);
    }

    // ── Office Financial Report ────────────────────────────────────────────────

    public function officeFinancialReport(Request $request): JsonResponse
    {
        $from = $request->input('from');
        $to   = $request->input('to');

        $q = DB::connection('business')->table('bs_office_requests as r')
            ->join('bs_offices as o', 'r.office_id', '=', 'o.id');

        if ($from) $q->whereDate('r.created_at', '>=', $from);
        if ($to)   $q->whereDate('r.created_at', '<=', $to);

        $summary = (clone $q)->selectRaw('
            COUNT(*) as total_requests,
            COALESCE(SUM(r.price), 0) as total_gross,
            COALESCE(SUM(r.commission_amount), 0) as total_commission,
            COALESCE(SUM(r.price - r.commission_amount), 0) as total_net,
            SUM(r.status = "done") as completed_requests,
            SUM(r.status = "pending") as pending_requests
        ')->first();

        $byOffice = (clone $q)->selectRaw('
            o.id, o.name_ar, o.name_en, o.commission_rate,
            COUNT(*) as req_count,
            COALESCE(SUM(r.price), 0) as gross,
            COALESCE(SUM(r.commission_amount), 0) as commission,
            COALESCE(SUM(r.price - r.commission_amount), 0) as net,
            SUM(r.status = "done") as completed
        ')->groupBy('o.id', 'o.name_ar', 'o.name_en', 'o.commission_rate')
          ->orderByRaw('SUM(r.commission_amount) DESC')
          ->limit(20)
          ->get();

        $monthly = (clone $q)->selectRaw('
            DATE_FORMAT(r.created_at, "%Y-%m") as month,
            COUNT(*) as req_count,
            COALESCE(SUM(r.price), 0) as gross,
            COALESCE(SUM(r.commission_amount), 0) as commission
        ')->groupBy('month')->orderBy('month')->limit(12)->get();

        return response()->json([
            'summary'   => $summary,
            'by_office' => $byOffice,
            'monthly'   => $monthly,
        ]);
    }

    public function adminOfficeRequestsList(Request $request): JsonResponse
    {
        $page    = max(1, (int) $request->input('page', 1));
        $perPage = 15;
        $status  = $request->input('status', 'all');
        $search  = $request->input('search', '');

        $q = DB::connection('business')->table('bs_office_requests as r')
            ->join('bs_offices as o',         'r.office_id',         '=', 'o.id')
            ->join('bs_office_services as s',  'r.office_service_id', '=', 's.id')
            ->select(
                'r.id', 'r.ref_number', 'r.client_name', 'r.client_phone',
                'r.price', 'r.commission_amount', 'r.status', 'r.created_at',
                'o.name_ar as office_ar', 'o.commission_rate',
                's.name_ar as service_ar'
            );

        if ($status !== 'all') $q->where('r.status', $status);
        if ($search) $q->where(function ($sq) use ($search) {
            $sq->where('r.ref_number', 'like', "%{$search}%")
               ->orWhere('r.client_name', 'like', "%{$search}%")
               ->orWhere('o.name_ar', 'like', "%{$search}%");
        });

        $total = (clone $q)->count();
        $items = $q->orderByDesc('r.created_at')->offset(($page - 1) * $perPage)->limit($perPage)->get();

        return response()->json([
            'data'      => $items,
            'total'     => $total,
            'page'      => $page,
            'last_page' => max(1, ceil($total / $perPage)),
        ]);
    }
    public function adminOfficeDetails(int $id): JsonResponse
{
    $office = Office::with([
        'profile',
        'documents',
        'specialtiesRelation',
        'services',
    ])->find($id);

    if (!$office) {
        return response()->json([
            'message' => 'المكتب غير موجود'
        ], 404);
    }

    /*
    |--------------------------------------------------------------------------
    | التخصصات
    |--------------------------------------------------------------------------
    |
    | 1- لو التخصص مختار من القائمة:
    |    نأخذه من specialtiesRelation
    |
    | 2- لو التخصص مكتوب يدويًا:
    |    نأخذه من profile.custom_specialty
    |
    */

    $specialties = $office->specialtiesRelation
        ->map(function ($specialty) {
            return [
                'id'      => $specialty->id,
                'name_ar' => $specialty->name_ar,
                'name_en' => $specialty->name_en,
            ];
        })
        ->values();

    /*
    |--------------------------------------------------------------------------
    | إضافة التخصص المكتوب يدويًا
    |--------------------------------------------------------------------------
    */

    $customSpecialty = trim(
        $office->profile->custom_specialty ?? ''
    );

    if ($customSpecialty !== '') {

        /*
        | نضيفه بنفس الشكل الذي يتوقعه JavaScript
        */

        $specialties->push([
            'id'      => null,
            'name_ar' => $customSpecialty,
            'name_en' => null,
        ]);
    }

    return response()->json([

        /*
        |--------------------------------------------------------------------------
        | بيانات المكتب
        |--------------------------------------------------------------------------
        */

        'office' => [
            'id'              => $office->id,
            'type'            => $office->type,
            'type_label_ar'   => $office->typeLabelAr(),
            'name_ar'         => $office->name_ar,
            'name_en'         => $office->name_en,
            'description_ar'  => $office->description_ar,
            'description_en'  => $office->description_en,
            'phone'           => $office->phone,
            'email'           => $office->email,
            'city'            => $office->city,
            'cr_number'       => $office->cr_number,
            'logo'            => $office->logo,
            'is_active'       => (bool) $office->is_active,
            'is_verified'     => (bool) $office->is_verified,
            'commission_rate' => $office->commission_rate,
        ],

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        'profile' => $office->profile,

        /*
        |--------------------------------------------------------------------------
        | المستندات
        |--------------------------------------------------------------------------
        */

        'documents' => $office->documents
            ->map(function ($doc) {

                return [
                    'id'            => $doc->id,
                    'document_type' => $doc->document_type,

                    'file' => $doc->file
                        ? url(
                            '/media/public/' .
                            ltrim($doc->file, '/')
                        )
                        : null,

                    'file_name'   => $doc->file_name,
                    'is_verified' => (bool) $doc->is_verified,
                ];

            })
            ->values(),

        /*
        |--------------------------------------------------------------------------
        | التخصصات
        |--------------------------------------------------------------------------
        */

        'specialties' => $specialties,

        /*
        |--------------------------------------------------------------------------
        | الخدمات
        |--------------------------------------------------------------------------
        */

        'services' => $office->services
            ->map(function ($service) {

                return [
                    'id'             => $service->id,
                    'name_ar'        => $service->name_ar,
                    'name_en'        => $service->name_en,
                    'description_ar' => $service->description_ar,
                    'price'          => $service->price,
                    'duration'       => $service->duration,
                ];

            })
            ->values(),
    ]);
}
public function viewOfficeDocument(int $documentId): StreamedResponse
{
    $document = OfficeDocument::find($documentId);

    if (!$document || !$document->file) {
        abort(404, 'المستند غير موجود');
    }

    $path = ltrim($document->file, '/');

    if (!Storage::disk('business')->exists($path)) {
        abort(404, 'الملف غير موجود');
    }

    $mimeType = Storage::disk('business')->mimeType($path);

    return Storage::disk('business')->response(
        $path,
        $document->file_name ?: basename($path),
        [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline',
        ]
    );
}
public function adminSpecialties(Request $request): JsonResponse
{
    $query = Specialty::query();

    if ($request->filled('office_type')) {
        $query->where(
            'office_type',
            $request->office_type
        );
    }

    $specialties = $query
        ->orderBy('office_type')
        ->orderBy('name_ar')
        ->get();

    return response()->json($specialties);
}
}
