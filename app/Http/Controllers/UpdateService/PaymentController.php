<?php

namespace App\Http\Controllers\UpdateService;

use App\Http\Controllers\Controller;
use App\Models\ServicePayment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /* ── GET /amrtm/payment/callback ── */
    public function callback(Request $request): RedirectResponse
    {
        $paymentId = $request->query('id');
        $status    = $request->query('status');

        if (! $paymentId) {
            return redirect()->route('amrtm.user.dashboard')
                ->with('payment_error', 'معرّف الدفع غير صالح.');
        }

        // If Moyasar already flagged it as failed/initiated, short-circuit
        if ($status && $status !== 'paid') {
            return redirect()->route('amrtm.user.dashboard')
                ->with('payment_error', 'لم يكتمل الدفع — حاول مرة أخرى.');
        }

        // Idempotency: skip if already processed
        if (ServicePayment::where('transaction_ref', $paymentId)->exists()) {
            return redirect()->route('amrtm.user.dashboard')
                ->with('payment_success', 'تمت معالجة هذه العملية مسبقاً.');
        }

        // Verify with Moyasar API
        $secretKey = config('services.moyasar.secret_key');
        $response  = Http::withBasicAuth($secretKey, '')
            ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

        if (! $response->successful()) {
            return redirect()->route('amrtm.user.dashboard')
                ->with('payment_error', 'فشل التحقق من الدفع مع مزود الخدمة.');
        }

        $payment = $response->json();

        if (($payment['status'] ?? '') !== 'paid') {
            return redirect()->route('amrtm.user.dashboard')
                ->with('payment_error', 'لم يكتمل الدفع — الحالة: ' . ($payment['status'] ?? 'غير معروفة'));
        }

        $user      = auth('business')->user();
        $amountSar = ($payment['amount'] ?? 0) / 100; // Moyasar uses halalas

        // Verify the payment belongs to this user via metadata
        $metaUserId = $payment['metadata']['user_id'] ?? null;
        if ($metaUserId && (int) $metaUserId !== $user->id) {
            return redirect()->route('amrtm.user.dashboard')
                ->with('payment_error', 'هذا الدفع لا يتطابق مع حسابك.');
        }

        ServicePayment::create([
            'user_id'        => $user->id,
            'amount'         => $amountSar,
            'type'           => 'charge',
            'description_ar' => 'شحن رصيد عبر بطاقة بنكية',
            'description_en' => 'Balance top-up via Moyasar',
            'status'         => 'completed',
            'transaction_ref'=> $paymentId,
        ]);

        $formatted = number_format($amountSar, 2);

        return redirect()->route('amrtm.user.dashboard')
            ->with('payment_success', "تم شحن رصيدك بنجاح! المبلغ المضاف: {$formatted} ر.س");
    }
}