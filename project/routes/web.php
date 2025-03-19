<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PaymentController;

// Public Routes
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/subscriptions', function () {
    return view('subscriptions');
})->name('subscriptions');

Route::get('/sessions', function () {
    return view('sessions');
})->name('sessions');

Route::get('/trainers', function () {
    return view('trainers');
})->name('trainers');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // Registration Routes
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Password Reset Routes
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])
        ->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
        ->name('password.update');
});

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'notice'])
        ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.resend');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard Route - Protected with email verification
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');
    
    // Member Routes
    Route::middleware(['role:Member'])->prefix('member')->group(function () {
        // Session booking for members
        Route::post('/sessions/{session}/book', [SessionController::class, 'book'])
            ->name('member.sessions.book');
        
        // View own subscriptions
        Route::get('/my-subscription', [SubscriptionController::class, 'mySubscription'])
            ->name('member.subscription');
        
        // View own attendance
        Route::get('/my-attendance', [AttendanceController::class, 'myAttendance'])
            ->name('member.attendance');

            // View available sessions and book
    Route::get('/sessions', [SessionController::class, 'memberSessions'])
    ->name('member.sessions.book');

// Book a session
Route::post('/sessions/{session}/book', [SessionController::class, 'book'])
    ->name('member.sessions.book-post');

// View subscription details
Route::get('/subscription', [SubscriptionController::class, 'memberSubscription'])
    ->name('member.subscription');

// View attendance history
Route::get('/attendance', [AttendanceController::class, 'memberAttendance'])
    ->name('member.attendance');
   // Add a route to show the payment page
Route::get('/member/subscription/payment/{plan}/{duration}', [SubscriptionController::class, 'showPaymentPage'])
->name('member.subscription.payment');

// Keep the existing route for the final purchase
Route::post('/member/subscription/purchase', [SubscriptionController::class, 'purchaseSubscription'])
->name('member.subscription.purchase');
// Stripe Checkout Routes
Route::post('/member/subscription/checkout-session', [SubscriptionController::class, 'createCheckoutSession'])
    ->name('member.subscription.checkout-session');
    
Route::get('/member/subscription/success', [SubscriptionController::class, 'handleCheckoutSuccess'])
    ->name('member.subscription.success');
// Route pour rediriger vers Stripe
Route::post('/member/subscription/stripe-redirect', [SubscriptionController::class, 'stripeRedirect'])
    ->name('member.subscription.stripe-redirect');
    });
    
    // Trainer Routes
    Route::middleware(['role:Trainer'])->prefix('trainer')->group(function () {
        // Session management
        Route::resource('sessions', SessionController::class)
            ->names([
                'index' => 'trainer.sessions.index',
                'create' => 'trainer.sessions.create',
                'store' => 'trainer.sessions.store',
                'show' => 'trainer.sessions.show',
                'edit' => 'trainer.sessions.edit',
                'update' => 'trainer.sessions.update',
                'destroy' => 'trainer.sessions.destroy',
            ]);
        
        // Attendance management for trainer's sessions
        Route::get('/sessions/{session}/attendances', [AttendanceController::class, 'sessionAttendances'])
            ->name('trainer.sessions.attendances');
        
        // Record attendance
        Route::post('/attendances/record-entry', [AttendanceController::class, 'recordEntry'])
            ->name('trainer.attendances.record-entry');
        Route::post('/attendances/{attendance}/record-exit', [AttendanceController::class, 'recordExit'])
            ->name('trainer.attendances.record-exit');
    });
    
    // Receptionist Routes
    Route::middleware(['role:Receptionist'])->prefix('receptionist')->group(function () {
        // Member management
        Route::get('/members', [DashboardController::class, 'members'])
            ->name('receptionist.members');
        
        // Subscription management
        Route::resource('subscriptions', SubscriptionController::class)
            ->names([
                'index' => 'receptionist.subscriptions.index',
                'create' => 'receptionist.subscriptions.create',
                'store' => 'receptionist.subscriptions.store',
                'show' => 'receptionist.subscriptions.show',
                'edit' => 'receptionist.subscriptions.edit',
                'update' => 'receptionist.subscriptions.update',
                'destroy' => 'receptionist.subscriptions.destroy',
            ]);
        
        // Subscription management actions
        Route::post('/subscriptions/{subscription}/renew', [SubscriptionController::class, 'renew'])
            ->name('receptionist.subscriptions.renew');
        Route::post('/subscriptions/{subscription}/cancel', [SubscriptionController::class, 'cancel'])
            ->name('receptionist.subscriptions.cancel');
        
        // Session booking for members
        Route::get('/sessions', [SessionController::class, 'index'])
            ->name('receptionist.sessions.index');
        Route::post('/sessions/{session}/book-for-member', [SessionController::class, 'bookForMember'])
            ->name('receptionist.sessions.book-for-member');
        
        // Attendance management
        Route::resource('attendances', AttendanceController::class)
            ->names([
                'index' => 'receptionist.attendances.index',
                'create' => 'receptionist.attendances.create',
                'store' => 'receptionist.attendances.store',
                'show' => 'receptionist.attendances.show',
                'edit' => 'receptionist.attendances.edit',
                'update' => 'receptionist.attendances.update',
                'destroy' => 'receptionist.attendances.destroy',
            ]);
        
        // Payment management
        Route::resource('payments', PaymentController::class)
            ->names([
                'index' => 'receptionist.payments.index',
                'create' => 'receptionist.payments.create',
                'store' => 'receptionist.payments.store',
                'show' => 'receptionist.payments.show',
                'edit' => 'receptionist.payments.edit',
                'update' => 'receptionist.payments.update',
                'destroy' => 'receptionist.payments.destroy',
            ]);
        
        Route::post('/payments/{payment}/process', [PaymentController::class, 'process'])
            ->name('receptionist.payments.process');
        Route::post('/payments/{payment}/refund', [PaymentController::class, 'refund'])
            ->name('receptionist.payments.refund');
        Route::get('/payments/{payment}/receipt', [PaymentController::class, 'generateReceipt'])
            ->name('receptionist.payments.receipt');
    });
    
    // Admin Routes
    Route::middleware(['role:Administrator'])->prefix('admin')->group(function () {
        // User management
        Route::get('/users', [DashboardController::class, 'users'])
            ->name('admin.users');
        Route::get('/users/create', [DashboardController::class, 'createUser'])
            ->name('admin.users.create');
        Route::post('/users', [DashboardController::class, 'storeUser'])
            ->name('admin.users.store');
        Route::get('/users/{user}/edit', [DashboardController::class, 'editUser'])
            ->name('admin.users.edit');
        Route::put('/users/{user}', [DashboardController::class, 'updateUser'])
            ->name('admin.users.update');
        Route::delete('/users/{user}', [DashboardController::class, 'destroyUser'])
            ->name('admin.users.destroy');
        
        // Session management
        Route::resource('sessions', SessionController::class)
            ->names([
                'index' => 'admin.sessions.index',
                'create' => 'admin.sessions.create',
                'store' => 'admin.sessions.store',
                'show' => 'admin.sessions.show',
                'edit' => 'admin.sessions.edit',
                'update' => 'admin.sessions.update',
                'destroy' => 'admin.sessions.destroy',
            ]);
        
        // Subscription management
        Route::resource('subscriptions', SubscriptionController::class)
            ->names([
                'index' => 'admin.subscriptions.index',
                'create' => 'admin.subscriptions.create',
                'store' => 'admin.subscriptions.store',
                'show' => 'admin.subscriptions.show',
                'edit' => 'admin.subscriptions.edit',
                'update' => 'admin.subscriptions.update',
                'destroy' => 'admin.subscriptions.destroy',
            ]);
        
        // Attendance management
        Route::resource('attendances', AttendanceController::class)
            ->names([
                'index' => 'admin.attendances.index',
                'create' => 'admin.attendances.create',
                'store' => 'admin.attendances.store',
                'show' => 'admin.attendances.show',
                'edit' => 'admin.attendances.edit',
                'update' => 'admin.attendances.update',
                'destroy' => 'admin.attendances.destroy',
            ]);
        
        // Payment management
        Route::resource('payments', PaymentController::class)
            ->names([
                'index' => 'admin.payments.index',
                'create' => 'admin.payments.create',
                'store' => 'admin.payments.store',
                'show' => 'admin.payments.show',
                'edit' => 'admin.payments.edit',
                'update' => 'admin.payments.update',
                'destroy' => 'admin.payments.destroy',
            ]);
        
        // Reports
        Route::get('/reports/members', [DashboardController::class, 'memberReport'])
            ->name('admin.reports.members');
        Route::get('/reports/sessions', [DashboardController::class, 'sessionReport'])
            ->name('admin.reports.sessions');
        Route::get('/reports/revenues', [DashboardController::class, 'revenueReport'])
            ->name('admin.reports.revenues');
    });
});