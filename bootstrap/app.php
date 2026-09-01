<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
        $middleware->alias([
            'business-role'      => \App\Http\Middleware\BusinessRoleMiddleware::class,
            'no-admin'           => \App\Http\Middleware\PreventAdminFromUserActions::class,
            'audit-admin'        => \App\Http\Middleware\AuditAdminActions::class,
            'guest.business'     => \App\Http\Middleware\BusinessGuestMiddleware::class,
            'auth.office'        => \App\Http\Middleware\OfficeAuthMiddleware::class,
            'guest.office'       => \App\Http\Middleware\OfficeGuestMiddleware::class,
            'complete.office.profile' => \App\Http\Middleware\CompleteOfficeProfile::class,
        ]);
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
            \App\Http\Middleware\SecurityHeaders::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (TokenMismatchException $exception, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'انتهت صلاحية الجلسة. يرجى تسجيل الدخول مرة أخرى.',
                ], 419);
            }

            // Route to the business login page
            return redirect()
                ->route('amrtm.login')
                ->with('error', 'انتهت صلاحية الجلسة بسبب عدم النشاط. سجل الدخول مرة أخرى ثم أعد المحاولة.');
        });
    })->create();
