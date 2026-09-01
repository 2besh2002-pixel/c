<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class SubmitRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth('business')->user();
        return $user && !$user->isAdmin();
    }

    public function rules(): array
    {
        return [
            'service_id'       => ['required', 'integer', 'exists:business.bs_services,id'],
            'client_name'      => ['required', 'string', 'min:2', 'max:200'],
            'client_email'     => ['required', 'email', 'max:200'],
            'client_phone'     => ['required', 'string', 'regex:/^[0-9+\-\s]{7,20}$/'],
            'client_id_number' => ['required', 'string', 'min:5', 'max:30', 'regex:/^[a-zA-Z0-9]+$/'],
            'company_name'     => ['nullable', 'string', 'max:200'],
            'company_cr'       => ['nullable', 'string', 'max:100', 'regex:/^[a-zA-Z0-9\-\/]+$/'],
            'notes'            => ['nullable', 'string', 'max:2000'],
            'attachments'      => ['nullable', 'array', 'max:5'],
            'attachments.*'    => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required'       => 'يجب اختيار الخدمة.',
            'service_id.exists'         => 'الخدمة المحددة غير موجودة.',
            'client_name.required'      => 'اسم العميل مطلوب.',
            'client_email.required'     => 'البريد الإلكتروني مطلوب.',
            'client_phone.required'     => 'رقم الهاتف مطلوب.',
            'client_phone.regex'        => 'صيغة رقم الهاتف غير صحيحة.',
            'client_id_number.required' => 'رقم الهوية مطلوب.',
            'client_id_number.min'      => 'رقم الهوية يجب أن يكون 5 أحرف على الأقل.',
            'client_id_number.regex'    => 'رقم الهوية يجب أن يحتوي على أحرف وأرقام فقط.',
            'attachments.max'           => 'لا يمكن رفع أكثر من 5 ملفات.',
            'attachments.*.mimes'       => 'صيغ الملفات المقبولة: PDF، JPG، PNG.',
            'attachments.*.max'         => 'الحد الأقصى لحجم الملف 10 ميغابايت.',
        ];
    }

    protected function failedAuthorization(): never
    {
        abort(403, 'المدير والمشرف لا يمكنهم تقديم طلبات.');
    }
}