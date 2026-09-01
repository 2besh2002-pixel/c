<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'min:2', 'max:100'],
            'email'    => ['required', 'email', 'max:200', 'unique:business.bs_users,email'],
            'phone'    => ['required', 'string', 'regex:/^[0-9+\-\s]{7,20}$/'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'الاسم الكامل مطلوب.',
            'name.min'           => 'الاسم يجب أن يحتوي على حرفين على الأقل.',
            'email.required'     => 'البريد الإلكتروني مطلوب.',
            'email.unique'       => 'هذا البريد الإلكتروني مسجل مسبقاً.',
            'phone.required'     => 'رقم الهاتف مطلوب.',
            'phone.regex'        => 'صيغة رقم الهاتف غير صحيحة.',
            'password.required'  => 'كلمة المرور مطلوبة.',
            'password.confirmed' => 'كلمة المرور وتأكيدها غير متطابقين.',
            'password.min'       => 'كلمة المرور يجب أن تحتوي على 8 أحرف على الأقل وتشمل أرقاماً وحروفاً.',
        ];
    }
}