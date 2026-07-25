<?php

use App\Http\Controllers\aboutUs;
use App\Http\Controllers\Admin\userController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\weatherController;
use App\Http\Middleware\CheckUserStatus;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AlertRiskController;
use App\Http\Controllers\Admin\RiskLevelController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

});

// routes/web.php

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // for alert management
    Route::get('/alerts', [AlertRiskController::class, 'index'])->name('admin.alerts.index');

    Route::get('/alerts/manage', [AlertRiskController::class, 'manageAlerts'])->name('admin.alerts.manage');

    Route::get('/alerts/create', [AlertRiskController::class, 'create'])->name('admin.alerts.create');

    Route::post('/alerts', [AlertRiskController::class, 'store'])->name('admin.alerts.store');

    Route::delete('/alerts/{id}', [AlertRiskController::class, 'destroy'])->name('admin.alerts.delete');

    Route::delete('pending_alert/{id}', [AlertRiskController::class, 'destroyPendingAlerts'])->name('admin.alerts.pending_alert_delete');

    Route::get('/alerts/search', [AlertRiskController::class, 'search'])->name('admin.alerts.search');
    // for Risk level management
    Route::get('/risk-levels', [RiskLevelController::class, 'index'])->name('admin.risk.index');

    Route::get('/risk-levels/create', [RiskLevelController::class, 'create'])->name('admin.risk.create');

    Route::post('/risk-levels', [RiskLevelController::class, 'store'])->name('admin.risk.store');

    Route::get('/risk-levels/{id}/edit', [RiskLevelController::class, 'edit'])->name('admin.risk.edit');

    Route::put('/risk-levels/{id}', [RiskLevelController::class, 'update'])->name('admin.risk.update');

    Route::delete('/risk-levels/{id}', [RiskLevelController::class, 'destroy'])->name('admin.risk.delete');
    // for user management
    Route::get('/user', [userController:: class, 'index'])->name('admin.user.index');

    //for userToggle
    Route::patch('/user/{id}/status', [UserController::class, 'toggleUser'])
        ->name('admin.users.toggleUser');

    Route::get('/user/search', [userController::class, 'search'])->name('admin.user.search');

});

// logged in users but blocked
Route::middleware(['auth', 'user.status'])->group( function () {
   Route::get('/donation', [DonationController::class, 'index'])->name('admin.donations.index');
});


Route::get('/aboutUs', [AboutUs::class, 'index'])->name('aboutUs');
Route::get('/weather-data', [weatherController::class, 'index'])->name('weather.data');
Route::post('/chatbot', [ChatBotController::class, 'index'])->name('chatbot');
