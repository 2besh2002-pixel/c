<?php

namespace App\Http\Controllers\UpdateService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\LoginRequest;
use App\Http\Requests\Business\RegisterRequest;
use App\Models\Business\BusinessUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AmrtmAuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('amrtm.auth.login');
    }

   public function login(LoginRequest $request): RedirectResponse
{
    $credentials = $request->only('email', 'password');
    $remember = $request->boolean('remember');

    /*
    |--------------------------------------------------------------------------
    | 1) محاولة تسجيل الدخول كمستخدم Business
    |--------------------------------------------------------------------------
    | يشمل:
    | - العميل role = user
    | - الأدمن role = admin
    | - المشرف role = supervisor
    |--------------------------------------------------------------------------
    */

    if (Auth::guard('business')->attempt($credentials, $remember)) {

        $user = Auth::guard('business')->user();

        /*
        | التحقق من حالة الحساب
        */

        if (!($user->is_active ?? true)) {

            Auth::guard('business')->logout();

            return back()
                ->withErrors([
                    'email' => 'حسابك موقوف. تواصل مع الإدارة.',
                ])
                ->withInput();
        }

        /*
        | تجديد الجلسة
        */

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | Admin / Supervisor
        |--------------------------------------------------------------------------
        */

        if (
            method_exists($user, 'isAdmin') &&
            $user->isAdmin()
        ) {
            return redirect()->route('amrtm.admin.dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | Business User / Client
        |--------------------------------------------------------------------------
        */

        return redirect()->route('amrtm.index');
    }


    /*
    |--------------------------------------------------------------------------
    | 2) لو مش Business نجرب Office
    |--------------------------------------------------------------------------
    */

    if (Auth::guard('office')->attempt($credentials, $remember)) {

        $officeUser = Auth::guard('office')->user();

        /*
        |--------------------------------------------------------------------------
        | التحقق من حالة مستخدم المكتب والمكتب نفسه
        |--------------------------------------------------------------------------
        */

        if (
            !($officeUser->is_active ?? false) ||
            !$officeUser->office ||
            !($officeUser->office->is_active ?? false)
        ) {

            Auth::guard('office')->logout();

            return back()
                ->withErrors([
                    'email' => 'حساب المكتب موقوف. تواصل مع الإدارة.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | تجديد الجلسة
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | التحقق من اكتمال بيانات المكتب
        |--------------------------------------------------------------------------
        */

        $profile = $officeUser->office->profile ?? null;


        /*
        |--------------------------------------------------------------------------
        | البيانات غير مكتملة
        |--------------------------------------------------------------------------
        */

        if (
            !$profile ||
            !($profile->profile_completed ?? false)
        ) {

            return redirect()
                ->route('amrtm.office.complete')
                ->with(
                    'info',
                    'يرجى استكمال بيانات المكتب والمستندات المطلوبة.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | البيانات مكتملة
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('amrtm.office.dashboard');
    }


    /*
    |--------------------------------------------------------------------------
    | 3) لا Business ولا Office
    |--------------------------------------------------------------------------
    */

    return back()
        ->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
        ])
        ->withInput();
}
    public function showRegisterForm(): RedirectResponse
    {
        return redirect(route('amrtm.login') . '?mode=register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = BusinessUser::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => 'user',
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('business')->login($user);
        $request->session()->regenerate();

        return redirect()->route('amrtm.index')
            ->with('success', 'تم إنشاء حسابك بنجاح. مرحباً بك في منصة آمر تم!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('business')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('amrtm.login');
    }
}
