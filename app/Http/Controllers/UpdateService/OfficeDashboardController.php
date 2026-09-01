<?php

namespace App\Http\Controllers\UpdateService;

use App\Http\Controllers\Controller;
use App\Models\Business\Office;
use App\Models\Business\OfficeMessage;
use App\Models\Business\OfficeRequest;
use App\Models\Business\OfficeService;
use App\Models\BusinessNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OfficeDashboardController extends Controller
{
    private function officeUser()
    {
        return Auth::guard('office')->user();
    }

    private function office()
    {
        return $this->officeUser()->office;
    }

    // ── Pages ──────────────────────────────────────────────────────────────────

    public function dashboard()
    {
        $office = $this->office()->load('users');
        return view('update_service.office.dashboard', compact('office'));
    }

    public function profile()
    {
        $office = $this->office();
        return view('update_service.office.profile', compact('office'));
    }

    public function updateProfile(Request $request)
    {
        $user   = $this->officeUser();
        $office = $this->office();

        $request->validate([
            'office_name_ar'  => 'required|string|max:255',
            'office_name_en'  => 'required|string|max:255',
            'phone'           => 'required|string|max:20',
            'city'            => 'nullable|string|max:100',
            'cr_number'       => 'nullable|string|max:50',
            'description_ar'  => 'nullable|string|max:1000',
            'description_en'  => 'nullable|string|max:1000',
            'name'            => 'required|string|max:255',
            'password'        => 'nullable|string|min:8|confirmed',
        ]);

        $office->update([
            'name_ar'        => $request->office_name_ar,
            'name_en'        => $request->office_name_en,
            'phone'          => $request->phone,
            'city'           => $request->city,
            'cr_number'      => $request->cr_number,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'specialties'    => $request->specialties ? explode(',', $request->specialties) : null,
        ]);

        $userUpdate = ['name' => $request->name];
        if ($request->filled('password')) {
            $userUpdate['password'] = Hash::make($request->password);
        }
        $user->update($userUpdate);

        return back()->with('success', 'تم تحديث البيانات بنجاح');
    }

    // ── JSON API ───────────────────────────────────────────────────────────────

    public function stats()
    {
        $officeId = $this->office()->id;

        $counts = DB::connection('business')
            ->table('bs_requests')
            ->where('office_id', $officeId)
            ->selectRaw("
                COUNT(*) as total,
                SUM(office_status = 'pending')      as pending,
                SUM(office_status = 'accepted')     as accepted,
                SUM(office_status = 'in_progress')  as in_progress,
                SUM(office_status = 'waiting_docs') as waiting_docs,
                SUM(office_status = 'done')         as done,
                SUM(office_status = 'rejected')     as rejected
            ")
            ->first();

        $unreadMessages = OfficeMessage::where('office_id', $officeId)
            ->where('sender_type', 'client')
            ->where('is_read', false)
            ->count();

        $directPending = OfficeRequest::where('office_id', $officeId)
            ->where('status', 'pending')
            ->count();

        return response()->json([
            'counts'          => $counts,
            'unread_messages' => $unreadMessages,
            'direct_pending'  => $directPending,
        ]);
    }

    public function getRequests(Request $request)
    {
        $officeId = $this->office()->id;
        $status   = $request->input('status', 'all');
        $search   = $request->input('search', '');
        $page     = max(1, (int) $request->input('page', 1));
        $perPage  = 15;

        $query = DB::connection('business')
            ->table('bs_requests as r')
            ->join('bs_services as s',  'r.service_id', '=', 's.id')
            ->join('bs_entities as e',  'r.entity_id',  '=', 'e.id')
            ->where('r.office_id', $officeId)
            ->select(
                'r.id', 'r.ref_number', 'r.client_name', 'r.client_email', 'r.client_phone',
                'r.client_id_number', 'r.company_name', 'r.notes', 'r.price',
                'r.status', 'r.office_status', 'r.created_at', 'r.completed_at',
                's.name_ar as service_ar', 's.name_en as service_en',
                'e.name_ar as entity_ar',  'e.name_en as entity_en'
            );

        if ($status !== 'all') {
            $query->where('r.office_status', $status);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('r.ref_number', 'like', "%$search%")
                  ->orWhere('r.client_name', 'like', "%$search%")
                  ->orWhere('r.client_phone', 'like', "%$search%");
            });
        }

        $total = (clone $query)->count();
        $items = $query->orderByDesc('r.created_at')
                       ->offset(($page - 1) * $perPage)
                       ->limit($perPage)
                       ->get();

        return response()->json([
            'data'       => $items,
            'total'      => $total,
            'page'       => $page,
            'last_page'  => max(1, ceil($total / $perPage)),
        ]);
    }

    public function getRequest($id)
    {
        $officeId = $this->office()->id;

        $req = DB::connection('business')
            ->table('bs_requests as r')
            ->join('bs_services as s', 'r.service_id', '=', 's.id')
            ->join('bs_entities as e', 'r.entity_id',  '=', 'e.id')
            ->where('r.id', $id)
            ->where('r.office_id', $officeId)
            ->select(
                'r.*',
                's.name_ar as service_ar', 's.name_en as service_en',
                'e.name_ar as entity_ar',  'e.name_en as entity_en'
            )
            ->first();

        if (!$req) {
            return response()->json(['message' => 'غير موجود'], 404);
        }

        // Mark messages from client as read
        OfficeMessage::where('request_id', $id)
            ->where('office_id', $officeId)
            ->where('sender_type', 'client')
            ->update(['is_read' => true]);

        return response()->json($req);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'office_status' => 'required|in:accepted,in_progress,waiting_docs,done,rejected',
            'note'          => 'nullable|string|max:500',
        ]);

        $officeId = $this->office()->id;

        $updated = DB::connection('business')
            ->table('bs_requests')
            ->where('id', $id)
            ->where('office_id', $officeId)
            ->update([
                'office_status' => $request->office_status,
                'completed_at'  => $request->office_status === 'done' ? now() : null,
                'updated_at'    => now(),
            ]);

        if (!$updated) {
            return response()->json(['message' => 'الطلب غير موجود أو غير مصرح'], 404);
        }

        // Auto-send a status message to the client
        if ($request->filled('note')) {
            OfficeMessage::create([
                'request_id'  => $id,
                'office_id'   => $officeId,
                'sender_type' => 'office',
                'sender_id'   => $this->officeUser()->id,
                'message'     => $request->note,
            ]);
        }

        return response()->json(['message' => 'تم تحديث الحالة بنجاح', 'office_status' => $request->office_status]);
    }

    public function getMessages($id)
    {
        $officeId = $this->office()->id;

        $exists = DB::connection('business')
            ->table('bs_requests')
            ->where('id', $id)->where('office_id', $officeId)
            ->exists();

        if (!$exists) {
            return response()->json(['message' => 'غير مصرح'], 403);
        }

        $messages = OfficeMessage::where('request_id', $id)
            ->where('office_id', $officeId)
            ->orderBy('created_at')
            ->get(['id', 'sender_type', 'message', 'attachments', 'is_read', 'created_at']);

        return response()->json($messages);
    }

    // ── Office Service Catalog ─────────────────────────────────────────────────

    public function listServices(): JsonResponse
    {
        $services = OfficeService::where('office_id', $this->office()->id)
            ->orderBy('sort_order')->orderBy('id')
            ->get();

        return response()->json($services);
    }

    public function createService(Request $request): JsonResponse
    {
        $request->validate([
            'name_ar'        => 'required|string|max:200',
            'name_en'        => 'required|string|max:200',
            'price'          => 'required|numeric|min:0',
            'duration'       => 'nullable|string|max:100',
            'description_ar' => 'nullable|string|max:1000',
            'description_en' => 'nullable|string|max:1000',
        ]);

        $service = OfficeService::create([
            'office_id'      => $this->office()->id,
            'name_ar'        => $request->name_ar,
            'name_en'        => $request->name_en,
            'price'          => $request->price,
            'duration'       => $request->duration,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'is_active'      => true,
            'sort_order'     => OfficeService::where('office_id', $this->office()->id)->max('sort_order') + 1,
        ]);

        return response()->json(['message' => 'تم إضافة الخدمة', 'service' => $service], 201);
    }

    public function updateService(Request $request, int $id): JsonResponse
    {
        $service = OfficeService::where('id', $id)
            ->where('office_id', $this->office()->id)
            ->firstOrFail();

        $request->validate([
            'name_ar'        => 'required|string|max:200',
            'name_en'        => 'required|string|max:200',
            'price'          => 'required|numeric|min:0',
            'duration'       => 'nullable|string|max:100',
            'description_ar' => 'nullable|string|max:1000',
            'description_en' => 'nullable|string|max:1000',
            'is_active'      => 'boolean',
        ]);

        $service->update($request->only([
            'name_ar', 'name_en', 'price', 'duration',
            'description_ar', 'description_en', 'is_active',
        ]));

        return response()->json(['message' => 'تم تحديث الخدمة', 'service' => $service->fresh()]);
    }

    public function deleteService(int $id): JsonResponse
    {
        $service = OfficeService::where('id', $id)
            ->where('office_id', $this->office()->id)
            ->firstOrFail();

        $service->delete();

        return response()->json(['message' => 'تم حذف الخدمة']);
    }

    // ── Direct Client Requests ─────────────────────────────────────────────────

    public function directRequests(Request $request): JsonResponse
    {
        $officeId = $this->office()->id;
        $status   = $request->input('status', 'all');
        $page     = max(1, (int) $request->input('page', 1));
        $perPage  = 15;

        $query = OfficeRequest::where('office_id', $officeId)
            ->with('officeService:id,name_ar,name_en');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $total = (clone $query)->count();
        $items = $query->orderByDesc('created_at')
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get()
            ->map(fn($r) => [
                'id'           => $r->id,
                'ref_number'   => $r->ref_number,
                'client_name'  => $r->client_name,
                'client_phone' => $r->client_phone,
                'service_ar'   => $r->officeService?->name_ar ?? '—',
                'price'        => $r->price,
                'status'       => $r->status,
                'office_note'  => $r->office_note,
                'created_at'   => $r->created_at,
            ]);

        return response()->json([
            'data'      => $items,
            'total'     => $total,
            'page'      => $page,
            'last_page' => max(1, ceil($total / $perPage)),
        ]);
    }

    public function updateDirectRequestStatus(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'status'      => 'required|in:accepted,in_progress,waiting_docs,done,rejected',
            'office_note' => 'nullable|string|max:500',
        ]);

        $req = OfficeRequest::where('id', $id)
            ->where('office_id', $this->office()->id)
            ->firstOrFail();

        $req->update([
            'status'       => $request->status,
            'office_note'  => $request->office_note,
            'completed_at' => $request->status === 'done' ? now() : null,
        ]);

        // Notify client
        if ($req->user_id) {
            $labels = [
                'accepted'     => 'تم قبول طلبك',
                'in_progress'  => 'طلبك قيد التنفيذ الآن',
                'waiting_docs' => 'مطلوب منك تقديم مستندات',
                'done'         => 'تم إنجاز طلبك بنجاح ✓',
                'rejected'     => 'تم رفض طلبك',
            ];
            $label = $labels[$request->status] ?? 'تم تحديث حالة طلبك';
            BusinessNotification::forUser(
                $req->user_id, 'status_changed', $label,
                ($request->office_note ?: "طلبك #{$req->ref_number} — {$label}"),
                ['ref_number' => $req->ref_number, 'status' => $request->status],
                $req->id
            );
        }

        return response()->json(['message' => 'تم تحديث الحالة', 'status' => $req->status]);
    }

    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ], [
            'message.required' => 'الرسالة مطلوبة',
            'message.max'      => 'الرسالة طويلة جداً',
        ]);

        $officeId = $this->office()->id;

        $exists = DB::connection('business')
            ->table('bs_requests')
            ->where('id', $id)->where('office_id', $officeId)
            ->exists();

        if (!$exists) {
            return response()->json(['message' => 'غير مصرح'], 403);
        }

        $msg = OfficeMessage::create([
            'request_id'  => $id,
            'office_id'   => $officeId,
            'sender_type' => 'office',
            'sender_id'   => $this->officeUser()->id,
            'message'     => $request->message,
        ]);

        return response()->json($msg, 201);
    }

    // ── Notifications ──────────────────────────────────────────────────────────

    public function notifications(): JsonResponse
    {
        $officeId = $this->office()->id;
        $items    = BusinessNotification::where('recipient_type', 'office')
            ->where('office_id', $officeId)
            ->orderByDesc('created_at')
            ->limit(30)
            ->get();

        return response()->json(['data' => $items, 'unread' => $items->where('is_read', false)->count()]);
    }

    public function markNotifRead(int $id): JsonResponse
    {
        BusinessNotification::where('recipient_type', 'office')
            ->where('office_id', $this->office()->id)
            ->where('id', $id)
            ->update(['is_read' => true]);

        return response()->json(['message' => 'ok']);
    }

    public function markAllNotifsRead(): JsonResponse
    {
        BusinessNotification::where('recipient_type', 'office')
            ->where('office_id', $this->office()->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['message' => 'ok']);
    }

    // ── Financial Report ───────────────────────────────────────────────────────

    public function financial(Request $request): JsonResponse
    {
        $officeId = $this->office()->id;
        $from     = $request->input('from');
        $to       = $request->input('to');

        $q = OfficeRequest::where('office_id', $officeId);
        if ($from) $q->whereDate('created_at', '>=', $from);
        if ($to)   $q->whereDate('created_at', '<=', $to);

        $summary = (clone $q)->selectRaw('
            COUNT(*) as total,
            COALESCE(SUM(price), 0) as gross,
            COALESCE(SUM(commission_amount), 0) as commission,
            COALESCE(SUM(price - commission_amount), 0) as net,
            SUM(status = "done") as completed
        ')->first();

        $monthly = (clone $q)->selectRaw('
            DATE_FORMAT(created_at, "%Y-%m") as month,
            COUNT(*) as req_count,
            COALESCE(SUM(price), 0) as gross,
            COALESCE(SUM(commission_amount), 0) as commission,
            COALESCE(SUM(price - commission_amount), 0) as net
        ')->groupBy('month')->orderBy('month')->limit(12)->get();

        $recent = (clone $q)->orderByDesc('created_at')->limit(10)
            ->get(['id', 'ref_number', 'client_name', 'price', 'commission_amount', 'status', 'created_at']);

        return response()->json([
            'office'   => ['name_ar' => $this->office()->name_ar, 'commission_rate' => $this->office()->commission_rate],
            'summary'  => $summary,
            'monthly'  => $monthly,
            'recent'   => $recent,
        ]);
    }
}