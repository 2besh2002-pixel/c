<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NafathController;
use App\Http\Controllers\UpdateService\AdminServiceController;
use App\Http\Controllers\UpdateService\AmrtmAuthController;
use App\Http\Controllers\UpdateService\HomepageController;
use App\Http\Controllers\UpdateService\IconController;
use App\Http\Controllers\UpdateService\NotificationController;
use App\Http\Controllers\UpdateService\OfficeAuthController;
use App\Http\Controllers\UpdateService\OfficeDashboardController;
use App\Http\Controllers\UpdateService\OfficeProfileController;
use App\Http\Controllers\UpdateService\PaymentController;
use App\Http\Controllers\UpdateService\ProviderAccountController;
use App\Http\Controllers\UpdateService\ServiceCatalogController;
use App\Http\Controllers\UpdateService\SupervisorController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Business Sector Routes
|--------------------------------------------------------------------------
|
| Standalone application for the AMRTM business sector.
| The application serves the business-services platform directly at the root,
| plus the /office section, the business-services SPA from dist/,
| and proposal pages with full backward compatibility for legacy /amrtm routes.
|
*/

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// ── Amrtm Services Platform (Served directly at Root) ────────────────────────
Route::name('amrtm.')->group(function () {

    // Business Auth
    Route::middleware('guest.business')->group(function () {
        Route::get('/login', [AmrtmAuthController::class, 'showLoginForm'])->name('login');

        Route::post('/login', [AmrtmAuthController::class, 'login'])
            ->name('login.submit')
            ->middleware('throttle:business-login');

        Route::get('/register', [AmrtmAuthController::class, 'showRegisterForm'])->name('register');

        Route::post('/register', [AmrtmAuthController::class, 'register'])
            ->name('register.submit')
            ->middleware('throttle:business-register');
    });

    // Nafath
    Route::get('/nafath', [NafathController::class, 'show'])->name('nafath.show');
    Route::post('/nafath', [NafathController::class, 'verify'])->name('nafath.verify');
    Route::get('/nafath/wait', [NafathController::class, 'wait'])->name('nafath.wait');
    Route::get('/nafath/callback', [NafathController::class, 'callback'])->name('nafath.callback');

    // Business Logout
    Route::post('/logout', [AmrtmAuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth:business');

    // Public Catalog (Homepage at Root)
    Route::get('/', [ServiceCatalogController::class, 'index'])->name('index');

    // Static Contract Creation Page (no DB/backend)
    Route::get('/create-contract', function () {
        return view('update_service.contracts_create_static');
    })->name('create-contract');
    Route::get('/catalog/{key}', [ServiceCatalogController::class, 'categoryPage'])->name('catalog.category');
    Route::get('/catalog/{key}/{entityId}', [ServiceCatalogController::class, 'entityPage'])->name('catalog.entity');


    // Offices Directory
    $officeTypeConstraint = 'law|services|customs|accounting|engineering|freelance';

    Route::get('/offices/{type}', [ServiceCatalogController::class, 'officeDirectory'])
        ->where('type', $officeTypeConstraint)
        ->name('offices.directory');

    Route::get('/offices/{type}/{officeId}', [ServiceCatalogController::class, 'officeDetail'])
        ->where('type', $officeTypeConstraint)
        ->name('offices.detail');

    // Business User Dashboard
    Route::middleware('auth:business')->group(function () {
        Route::get('/dashboard', [ServiceCatalogController::class, 'userDashboard'])->name('user.dashboard');
        Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    });

    // Business Admin Dashboard
    Route::middleware(['auth:business', 'business-role:admin,supervisor'])->group(function () {
        Route::get('/admin', [AdminServiceController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/icons', [IconController::class, 'page'])->name('admin.icons');
        Route::get('/admin/homepage', [HomepageController::class, 'page'])->name('admin.homepage');

        Route::prefix('/admin/api/homepage')->name('admin.api.homepage.')->group(function () {
            Route::get('/settings', [HomepageController::class, 'getSettings'])->name('settings');
            Route::post('/settings', [HomepageController::class, 'saveSettings'])->name('settings.save');
            Route::get('/slides', [HomepageController::class, 'listSlides'])->name('slides');
            Route::post('/slides', [HomepageController::class, 'storeSlide'])->name('slides.store');
            Route::post('/slides/reorder', [HomepageController::class, 'reorderSlides'])->name('slides.reorder');
            Route::put('/slides/{id}', [HomepageController::class, 'updateSlide'])->name('slides.update');
            Route::post('/slides/{id}/toggle', [HomepageController::class, 'toggleSlide'])->name('slides.toggle');
            Route::delete('/slides/{id}', [HomepageController::class, 'deleteSlide'])->name('slides.delete');
        });
    });

    // Public / Business API
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/services', [ServiceCatalogController::class, 'apiServices'])->name('services');
        Route::get('/office-types', [ServiceCatalogController::class, 'publicOfficeTypes'])->name('office-types');

        Route::middleware(['auth:business', 'throttle:business-api'])->group(function () {
            // User-only actions
            Route::middleware('no-admin')->group(function () {
                Route::post('/requests', [ServiceCatalogController::class, 'submitRequest'])->name('requests.submit');
                Route::post('/payments/charge', [ServiceCatalogController::class, 'chargeBalance'])->name('payments.charge');
                Route::post('/office-requests', [ServiceCatalogController::class, 'submitOfficeRequest'])->name('office-requests.submit');
            });

            // Requests
            Route::get('/requests', [ServiceCatalogController::class, 'myRequests'])->name('requests.index');
            Route::get('/requests/{id}', [ServiceCatalogController::class, 'myRequestShow'])->name('requests.show');

            // Dashboard
            Route::get('/dashboard/user', [ServiceCatalogController::class, 'userStats'])->name('dashboard.user');

            // Payments
            Route::get('/payments/history', [ServiceCatalogController::class, 'paymentHistory'])->name('payments.history');

            // Profile
            Route::put('/profile', [ServiceCatalogController::class, 'updateProfile'])->name('profile.update');
            Route::put('/profile/password', [ServiceCatalogController::class, 'changePassword'])->name('profile.password');

            // Notifications
            Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
            Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread');
            Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
            Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');

            // Admin API
            Route::middleware(['business-role:admin,supervisor', 'audit-admin'])->group(function () {
                Route::get('/dashboard/admin', [AdminServiceController::class, 'adminStats'])->name('dashboard.admin');
                Route::get('/admin/requests', [AdminServiceController::class, 'adminRequests'])->name('admin.requests');
                Route::put('/admin/requests/{id}/status', [AdminServiceController::class, 'updateRequestStatus'])->name('admin.requests.status');
                Route::post('/admin/requests/{id}/note', [AdminServiceController::class, 'sendNote'])->name('admin.requests.note');
                Route::post('/admin/requests/{id}/info', [AdminServiceController::class, 'requestInfo'])->name('admin.requests.info');
                Route::put('/admin/services/{id}/price', [AdminServiceController::class, 'updateServicePrice'])->name('admin.services.price');
                Route::put('/admin/services/{id}', [AdminServiceController::class, 'updateService'])->name('admin.services.update');
                Route::get('/admin/payments', [AdminServiceController::class, 'adminTransactions'])->name('admin.payments');

                // Catalog - Categories
                Route::get('/admin/catalog/categories', [AdminServiceController::class, 'adminCategories'])->name('admin.catalog.categories');
                Route::post('/admin/catalog/categories', [AdminServiceController::class, 'createCategory'])->name('admin.catalog.categories.create');
                Route::put('/admin/catalog/categories/{id}', [AdminServiceController::class, 'updateCategory'])->name('admin.catalog.categories.update');
                Route::delete('/admin/catalog/categories/{id}', [AdminServiceController::class, 'deleteCategory'])->name('admin.catalog.categories.delete');

                // Catalog - Entities
                Route::get('/admin/catalog/entities', [AdminServiceController::class, 'adminEntities'])->name('admin.catalog.entities');
                Route::post('/admin/catalog/entities', [AdminServiceController::class, 'createEntity'])->name('admin.catalog.entities.create');
                Route::put('/admin/catalog/entities/{id}', [AdminServiceController::class, 'updateEntity'])->name('admin.catalog.entities.update');
                Route::delete('/admin/catalog/entities/{id}', [AdminServiceController::class, 'deleteEntity'])->name('admin.catalog.entities.delete');

                // Catalog - Services
                Route::get('/admin/catalog/services', [AdminServiceController::class, 'adminServices'])->name('admin.catalog.services');
                Route::post('/admin/catalog/services', [AdminServiceController::class, 'createGovService'])->name('admin.catalog.services.create');
                Route::delete('/admin/catalog/services/{id}', [AdminServiceController::class, 'deleteGovService'])->name('admin.catalog.services.delete');

                // Icons
                Route::get('/admin/icons', [IconController::class, 'list'])->name('admin.icons.list');
                Route::post('/admin/icons', [IconController::class, 'upload'])->name('admin.icons.upload');
                Route::delete('/admin/icons', [IconController::class, 'delete'])->name('admin.icons.delete');

                // Offices
                Route::get('/admin/offices', [AdminServiceController::class, 'adminOffices'])->name('admin.offices');
                Route::get('/admin/offices/stats', [AdminServiceController::class, 'adminOfficeStats'])->name('admin.offices.stats');
                Route::get('/admin/offices/{id}/details', [AdminServiceController::class, 'adminOfficeDetails'])->name('admin.offices.details');
                Route::get('/admin/offices/{id}/documents/{documentId}', [AdminServiceController::class, 'viewOfficeDocument'])->name('admin.offices.document');
                Route::post('/admin/offices/{id}/verify', [AdminServiceController::class, 'verifyOffice'])->name('admin.offices.verify');
                Route::post('/admin/offices/{id}/toggle', [AdminServiceController::class, 'toggleOffice'])->name('admin.offices.toggle');
                Route::delete('/admin/offices/{id}', [AdminServiceController::class, 'deleteOffice'])->name('admin.offices.delete');

                // Office Financial
                Route::get('/admin/office-financial', [AdminServiceController::class, 'officeFinancialReport'])->name('admin.office-financial');
                Route::get('/admin/office-requests-all', [AdminServiceController::class, 'adminOfficeRequestsList'])->name('admin.office-requests-all');

                // Users
                Route::get('/admin/users', [AdminServiceController::class, 'adminUsers'])->name('admin.users');
                Route::get('/admin/users/stats', [AdminServiceController::class, 'adminUserStats'])->name('admin.users.stats');
                Route::post('/admin/users/{id}/toggle', [AdminServiceController::class, 'toggleUserStatus'])->name('admin.users.toggle');
                Route::post('/admin/users/{id}/balance', [AdminServiceController::class, 'adjustUserBalance'])->name('admin.users.balance');

                // Logs
                Route::get('/admin/logs', [AdminServiceController::class, 'adminActivityLogs'])->name('admin.logs');

                // Analytics
                Route::get('/admin/analytics', [AdminServiceController::class, 'adminAnalytics'])->name('admin.analytics');
            });

            // Supervisor API
            Route::middleware('business-role:supervisor')->group(function () {
                Route::get('/supervisor/admins', [SupervisorController::class, 'admins'])->name('supervisor.admins');
                Route::post('/supervisor/admins', [SupervisorController::class, 'createAdmin'])->name('supervisor.admins.create');
                Route::put('/supervisor/admins/{id}/permissions', [SupervisorController::class, 'updateAdminPermissions'])->name('supervisor.admins.permissions');
                Route::post('/supervisor/admins/{id}/toggle', [SupervisorController::class, 'toggleAdmin'])->name('supervisor.admins.toggle');
                Route::get('/supervisor/revenue', [SupervisorController::class, 'revenueReport'])->name('supervisor.revenue');
                Route::get('/supervisor/monthly-report', [SupervisorController::class, 'monthlyReport'])->name('supervisor.monthly-report');
            });
        });
    });
});

// ── Office / Business Sector Platform (/office) ──────────────────────────────
Route::prefix('office')
    ->name('amrtm.office.')
    ->group(function () {

    // Office Specialties
    Route::get('/specialties', [AdminServiceController::class, 'adminSpecialties'])->name('admin.specialties');
    Route::post('/specialties', [AdminServiceController::class, 'createSpecialty'])->name('admin.specialties.create');
    Route::delete('/specialties/{id}', [AdminServiceController::class, 'deleteOfficeSpecialty'])->name('admin.specialties.delete');

    // معلومات أنواع المكاتب
    $contentViews = [
        'law'        => 'update_service.Content.LawInfo',
        'accounting' => 'update_service.Content.AccountingInfo',
        'engineering' => 'update_service.Content.EngineeringInfo',
        'customs'    => 'update_service.Content.CustomsInfo',
        'services'   => 'update_service.Content.ServicesInfo',
        'freelance'  => 'update_service.Content.FreelanceInfo',
    ];

    foreach ($contentViews as $key => $viewName) {
        Route::get("/{$key}-info", function () use ($viewName, $key) {
            abort_unless(view()->exists($viewName), 404);
            return view($viewName);
        })->name("{$key}.info");
    }

    // Login / Register
    Route::middleware('guest.office')->group(function () {
        Route::get('/login', [OfficeAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [OfficeAuthController::class, 'login'])->name('login.submit');
        Route::get('/register', [OfficeAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [OfficeAuthController::class, 'register'])->name('register.submit');
    });

    // Logout
    Route::post('/logout', [OfficeAuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth.office');

    // استكمال بيانات المكتب
    Route::get('/complete', [OfficeProfileController::class, 'show'])->name('complete');
    Route::post('/complete', [OfficeProfileController::class, 'save'])->name('complete.save');
    Route::post('/complete/submit', [OfficeProfileController::class, 'submit'])->name('complete.submit');

    // Dashboard المكتب
    Route::middleware(['auth.office', 'complete.office.profile'])->group(function () {
        Route::get('/dashboard', [OfficeDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [OfficeDashboardController::class, 'profile'])->name('profile');
        Route::post('/profile', [OfficeDashboardController::class, 'updateProfile'])->name('profile.update');

        Route::prefix('api')->name('api.')->group(function () {
            Route::get('/requests', [OfficeDashboardController::class, 'getRequests'])->name('requests');
            Route::get('/requests/{id}', [OfficeDashboardController::class, 'getRequest'])->name('request');
            Route::put('/requests/{id}/status', [OfficeDashboardController::class, 'updateStatus'])->name('request.status');
            Route::get('/requests/{id}/messages', [OfficeDashboardController::class, 'getMessages'])->name('messages');
            Route::post('/requests/{id}/messages', [OfficeDashboardController::class, 'sendMessage'])->name('message.send');

            Route::get('/stats', [OfficeDashboardController::class, 'stats'])->name('stats');

            Route::get('/services', [OfficeDashboardController::class, 'listServices'])->name('services');
            Route::post('/services', [OfficeDashboardController::class, 'createService'])->name('services.create');
            Route::put('/services/{id}', [OfficeDashboardController::class, 'updateService'])->name('services.update');
            Route::delete('/services/{id}', [OfficeDashboardController::class, 'deleteService'])->name('services.delete');

            Route::get('/direct-requests', [OfficeDashboardController::class, 'directRequests'])->name('direct-requests');
            Route::put('/direct-requests/{id}/status', [OfficeDashboardController::class, 'updateDirectRequestStatus'])->name('direct-requests.status');

            Route::get('/notifications', [OfficeDashboardController::class, 'notifications'])->name('notifications');
            Route::post('/notifications/read-all', [OfficeDashboardController::class, 'markAllNotifsRead'])->name('notifications.read-all');
            Route::post('/notifications/{id}/read', [OfficeDashboardController::class, 'markNotifRead'])->name('notifications.read');

            Route::get('/financial', [OfficeDashboardController::class, 'financial'])->name('financial');
        });
    });
});

// ── Provider Account Registration (/provider-account) ────────────────────────
Route::get('/provider-account/create', [ProviderAccountController::class, 'create'])->name('amrtm.provider.account.create');
Route::get('/provider-account/specialties', [ProviderAccountController::class, 'specialties'])->name('amrtm.provider.account.specialties');
Route::post('/provider-account', [ProviderAccountController::class, 'store'])->name('amrtm.provider.account.store');

// ── Business-services SPA (dist/) ────────────────────────────────────────────
$distContentTypes = [
    'js' => 'application/javascript; charset=UTF-8',
    'mjs' => 'application/javascript; charset=UTF-8',
    'css' => 'text/css; charset=UTF-8',
    'svg' => 'image/svg+xml',
    'json' => 'application/json; charset=UTF-8',
    'map' => 'application/json; charset=UTF-8',
    'png' => 'image/png',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'gif' => 'image/gif',
    'webp' => 'image/webp',
    'ico' => 'image/x-icon',
    'woff' => 'font/woff',
    'woff2' => 'font/woff2',
    'ttf' => 'font/ttf',
];

$distContentType = fn (string $path): string => $distContentTypes[pathinfo($path, PATHINFO_EXTENSION)] ?? 'application/octet-stream';

Route::get('/favicon.svg', function () {
    $fullPath = base_path('dist/favicon.svg');
    abort_unless(File::isFile($fullPath), 404);

    return response()->file($fullPath, [
        'Content-Type' => 'image/svg+xml',
        'Cache-Control' => 'public, max-age=3600',
    ]);
})->name('dist.favicon');

Route::get('/assets/{path}', function (string $path) use ($distContentType) {
    abort_if(str_contains($path, '..'), 404);

    $fullPath = base_path('dist/assets/'.$path);
    abort_unless(File::isFile($fullPath), 404);

    return response()->file($fullPath, [
        'Content-Type' => $distContentType($path),
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('path', '.*')->name('dist.assets');

Route::get('/business-services/dist/{path}', function (string $path) use ($distContentType) {
    abort_if(str_contains($path, '..'), 404);

    $fullPath = base_path('dist/'.$path);
    abort_unless(File::isFile($fullPath), 404);

    return response()->file($fullPath, [
        'Content-Type' => $distContentType($path),
        'Cache-Control' => str_starts_with($path, 'assets/')
            ? 'public, max-age=31536000, immutable'
            : 'public, max-age=3600',
    ]);
})->where('path', '.*')->name('business-services.dist');

Route::get('/business-services/{path?}', function () {
    $indexPath = base_path('dist/index.html');
    abort_unless(File::isFile($indexPath), 404);

    $html = File::get($indexPath);
    $html = str_replace(
        ['href="/favicon.svg"', 'href="/assets/', 'src="/assets/'],
        [
            'href="/business-services/dist/favicon.svg"',
            'href="/business-services/dist/assets/',
            'src="/business-services/dist/assets/',
        ],
        $html,
    );

    return response($html, 200)->header('Content-Type', 'text/html; charset=UTF-8');
})->where('path', '.*')->name('business-services');

// ── Public storage (shared media) ────────────────────────────────────────────
Route::get('/media/public/{path}', function (string $path) {
    abort_if(str_contains($path, '..'), 404);

    $disk = Storage::disk('public');
    abort_unless($disk->exists($path), 404);

    $absolutePath = $disk->path($path);

    return response()->file($absolutePath, [
        'Content-Type' => mime_content_type($absolutePath),
        'Content-Disposition' => 'inline; filename="'.basename($absolutePath).'"',
        'Cache-Control' => 'public, max-age=3600',
    ]);
})->where('path', '.*')->name('public.storage');

// ── Proposal pages ───────────────────────────────────────────────────────────
$proposalViews = [
    1 => 'amrtm_proposal1',
    2 => 'amrtm_proposal2',
    3 => 'amrtm_proposal3',
    4 => 'amrtm_proposal4',
];

Route::get('/amrtm_proposal/{id}', function (int $id) use ($proposalViews) {
    abort_unless(isset($proposalViews[$id]) && view()->exists($proposalViews[$id]), 404);

    return view($proposalViews[$id]);
})->name('proposal.show');

// ── Backward Compatibility & Legacy Fallback for /amrtm/* ───────────────────
Route::prefix('amrtm')->group(function () {
    Route::get('/', fn () => redirect('/', 301));
    Route::get('/login', fn () => redirect()->route('amrtm.login'), 301);
    Route::get('/register', fn () => redirect()->route('amrtm.register'), 301);
    Route::get('/dashboard', fn () => redirect()->route('amrtm.user.dashboard'), 301);
    Route::get('/admin', fn () => redirect()->route('amrtm.admin.dashboard'), 301);
    Route::get('/admin/{path}', fn (string $path) => redirect('/admin/'.$path, 301))->where('path', '.*');
    Route::get('/catalog/{path}', fn (string $path) => redirect('/catalog/'.$path, 301))->where('path', '.*');
    Route::get('/offices/{path}', fn (string $path) => redirect('/offices/'.$path, 301))->where('path', '.*');
    Route::get('/office/{path?}', fn (?string $path = null) => redirect('/office'.($path ? '/'.$path : ''), 301))->where('path', '.*');
    Route::get('/provider-account/{path?}', fn (?string $path = null) => redirect('/provider-account'.($path ? '/'.$path : ''), 301))->where('path', '.*');
    Route::get('/amrtm_proposal/{id}', fn (int $id) => redirect('/amrtm_proposal/'.$id, 301));

    // Legacy API alias: route requests to the public/business API controllers
    Route::prefix('api')->group(function () {
        Route::get('/services', [ServiceCatalogController::class, 'apiServices']);
        Route::get('/office-types', [ServiceCatalogController::class, 'publicOfficeTypes']);
        Route::middleware(['auth:business', 'throttle:business-api'])->group(function () {
            Route::middleware('no-admin')->group(function () {
                Route::post('/requests', [ServiceCatalogController::class, 'submitRequest']);
                Route::post('/payments/charge', [ServiceCatalogController::class, 'chargeBalance']);
                Route::post('/office-requests', [ServiceCatalogController::class, 'submitOfficeRequest']);
            });
            Route::get('/requests', [ServiceCatalogController::class, 'myRequests']);
            Route::get('/requests/{id}', [ServiceCatalogController::class, 'myRequestShow']);
            Route::get('/dashboard/user', [ServiceCatalogController::class, 'userStats']);
            Route::get('/payments/history', [ServiceCatalogController::class, 'paymentHistory']);
            Route::put('/profile', [ServiceCatalogController::class, 'updateProfile']);
            Route::put('/profile/password', [ServiceCatalogController::class, 'changePassword']);
            Route::get('/notifications', [NotificationController::class, 'index']);
            Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount']);
            Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead']);
            Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead']);
        });
    });
});
