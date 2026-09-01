<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OfficeAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('office')->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'غير مصرح'], 401);
            }
            return redirect()->route('amrtm.office.login')
                ->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $user = Auth::guard('office')->user();
        if (!$user->is_active || !$user->office->is_active) {
            Auth::guard('office')->logout();
            return redirect()->route('amrtm.office.login')
                ->with('error', 'حسابك موقوف. تواصل مع الإدارة.');
        }

        return $next($request);
    }
}