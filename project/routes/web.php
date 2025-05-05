<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\DashboardController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\Admin\SessionController as AdminSessionController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\ReportController;

// Trainer Controllers
use App\Http\Controllers\Trainer\TrainerController;
use App\Http\Controllers\Trainer\SessionController ;
use App\Http\Controllers\Trainer\AttendanceController;
use App\Http\Controllers\Trainer\ScheduleController;

// Receptionist Controllers
use App\Http\Controllers\Receptionist\ReceptionistController;
use App\Http\Controllers\Receptionist\SubscriptionController as ReceptionistSubscriptionController;
use App\Http\Controllers\Receptionist\AttendanceController as ReceptionistAttendanceController;
use App\Http\Controllers\Receptionist\PaymentController as ReceptionistPaymentController;
use App\Http\Controllers\Receptionist\SessionController as ReceptionistSessionController;

// Member Controllers
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Member\SubscriptionController as MemberSubscriptionController;

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
        // View dashboard
        Route::get('/dashboard', [MemberController::class, 'dashboard'])
            ->name('member.dashboard');
        
        // Session booking for members
        Route::get('/sessions', [MemberController::class, 'sessions'])
            ->name('member.sessions');
            
        Route::post('/sessions/{session}/book', [MemberController::class, 'bookSession'])
            ->name('member.sessions.book');
        
        // View subscription details
        Route::get('/subscription', [MemberSubscriptionController::class, 'subscription'])
            ->name('member.subscription');
            
        // View attendance history
        Route::get('/attendance', [MemberController::class, 'attendance'])
            ->name('member.attendance');
            
        // Subscription management routes
        Route::get('/subscription/payment/{plan}/{duration}', [MemberSubscriptionController::class, 'showPaymentPage'])
            ->name('member.subscription.payment');
            
        Route::post('/subscription/purchase', [MemberSubscriptionController::class, 'purchaseSubscription'])
            ->name('member.subscription.purchase');
            
        Route::post('/subscription/checkout-session', [MemberSubscriptionController::class, 'createCheckoutSession'])
            ->name('member.subscription.checkout-session');
            
        Route::get('/subscription/success', [MemberSubscriptionController::class, 'handleCheckoutSuccess'])
            ->name('member.subscription.success');
            
        Route::post('/subscription/stripe-redirect', [MemberSubscriptionController::class, 'stripeRedirect'])
            ->name('member.subscription.stripe-redirect');

            Route::get('/profile', [MemberController::class, 'profile'])
            ->name('member.profile');
    });
    
    // Trainer Routes
    Route::middleware(['role:Trainer'])->prefix('trainer')->group(function () {
        // View dashboard
        Route::get('/dashboard', [TrainerController::class, 'dashboard'])
            ->name('trainer.dashboard');
            
        // Inside the trainer middleware group
Route::get('/profile', [TrainerController::class, 'profile'])
->name('trainer.profile');
Route::get('/profile/download-badge', [TrainerController::class, 'downloadBadge'])
->name('trainer.profile.download-badge');
Route::get('/profile/badge', [TrainerController::class, 'showBadge'])
->name('trainer.profile.badge');

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
        Route::get('/sessions/{session}/attendances', [TrainerController::class, 'sessionAttendances'])
            ->name('trainer.sessions.attendances');

        
        
        // Record attendance
        Route::post('/attendances/record-entry', [AttendanceController::class, 'recordEntry'])
            ->name('trainer.attendances.record-entry');
        Route::post('/attendances/{attendance}/record-exit', [AttendanceController::class, 'recordExit'])
            ->name('trainer.attendances.record-exit');
            
      // Schedule management
      Route::resource('schedule', ScheduleController::class)
      ->except(['show'])
      ->names([
          'index' => 'trainer.schedule.index',
          'create' => 'trainer.schedule.create',
          'store' => 'trainer.schedule.store',
          'edit' => 'trainer.schedule.edit',
          'update' => 'trainer.schedule.update',
          'destroy' => 'trainer.schedule.destroy',
      ]);

// Add the new calendar route
Route::get('schedule/calendar', [ScheduleController::class, 'calendar'])
->name('trainer.schedule.calendar');

        
        // Members in trainer's sessions
        Route::get('/members', [TrainerController::class, 'members'])
            ->name('trainer.members');
        Route::get('/members/{id}', [TrainerController::class, 'memberDetails'])
            ->name('trainer.members.show');
    });
    
    // Receptionist Routes
    Route::middleware(['role:Receptionist'])->prefix('receptionist')->group(function () {
        // View dashboard
        Route::get('/dashboard', [ReceptionistController::class, 'dashboard'])
            ->name('receptionist.dashboard');
            
        // Member management
        Route::get('/members', [ReceptionistController::class, 'members'])
            ->name('receptionist.members');
            
        // Member details
        Route::get('/members/{id}', [ReceptionistController::class, 'memberDetails'])
            ->name('receptionist.members.show');
        
        // Subscription management
        Route::resource('subscriptions', ReceptionistSubscriptionController::class)
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
        Route::post('/subscriptions/{subscription}/renew', [ReceptionistSubscriptionController::class, 'renew'])
            ->name('receptionist.subscriptions.renew');
        Route::post('/subscriptions/{subscription}/cancel', [ReceptionistSubscriptionController::class, 'cancel'])
            ->name('receptionist.subscriptions.cancel');
        
        // Session management
        Route::get('/sessions', [ReceptionistSessionController::class, 'index'])
            ->name('receptionist.sessions.index');
        Route::get('/sessions/{id}', [ReceptionistSessionController::class, 'show'])
            ->name('receptionist.sessions.show');
        Route::post('/sessions/{id}/record-attendance', [ReceptionistSessionController::class, 'recordAttendance'])
            ->name('receptionist.sessions.record-attendance');
        Route::delete('/sessions/{id}/remove-member', [ReceptionistSessionController::class, 'removeMember'])
            ->name('receptionist.sessions.remove-member');
        Route::post('/sessions/{session}/book-for-member', [ReceptionistController::class, 'bookForMember'])
            ->name('receptionist.sessions.book-for-member');
        
        // Attendance management
        Route::resource('attendances', ReceptionistAttendanceController::class)
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
        Route::resource('payments', ReceptionistPaymentController::class)
            ->names([
                'index' => 'receptionist.payments.index',
                'create' => 'receptionist.payments.create',
                'store' => 'receptionist.payments.store',
                'show' => 'receptionist.payments.show',
                'edit' => 'receptionist.payments.edit',
                'update' => 'receptionist.payments.update',
                'destroy' => 'receptionist.payments.destroy',
            ]);
        
        Route::post('/payments/{payment}/process', [ReceptionistPaymentController::class, 'process'])
            ->name('receptionist.payments.process');
        Route::post('/payments/{payment}/refund', [ReceptionistPaymentController::class, 'refund'])
            ->name('receptionist.payments.refund');
        Route::get('/payments/{payment}/receipt', [ReceptionistPaymentController::class, 'generateReceipt'])
            ->name('receptionist.payments.receipt');
            
        // Trainers management
        Route::get('/trainers', [ReceptionistController::class, 'trainers'])
            ->name('receptionist.trainers');
        Route::get('/trainers/{id}', [ReceptionistController::class, 'trainerDetails'])
            ->name('receptionist.trainers.show');
            // Batch payment routes
Route::get('/payments/batch', [PaymentController::class, 'batchCreate'])->name('receptionist.payments.batch');
Route::post('/payments/batch', [PaymentController::class, 'batchStore'])->name('receptionist.payments.batch.store');
Route::get('/payments/search', [PaymentController::class, 'search'])->name('receptionist.payments.search');
        // Add these routes inside your receptionist middleware group
Route::get('/members/create', [ReceptionistController::class, 'createMember'])->name('receptionist.members.create');
Route::post('/members', [ReceptionistController::class, 'storeMember'])->name('receptionist.members.store');
Route::get('payments/{payment}/receipt', [ReceptionistPaymentController::class, 'generateReceipt'])
->name('receptionist.payments.receipt');

Route::get('payments/{payment}/email-receipt', [ReceptionistPaymentController::class, 'emailReceipt'])
->name('receptionist.payments.email-receipt');
});

    
    // Admin Routes
    Route::middleware(['role:Administrator'])->prefix('admin')->group(function () {
        // View dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');
            
        // User management
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('admin.users');
        Route::get('/users/create', [AdminUserController::class, 'create'])
            ->name('admin.users.create');
        Route::post('/users', [AdminUserController::class, 'store'])
            ->name('admin.users.store');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])
            ->name('admin.users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])
            ->name('admin.users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->name('admin.users.destroy');
        
        // Reports
        Route::get('/reports', [ReportController::class, 'index'])
            ->name('admin.reports.index');
        Route::get('/reports/members', [ReportController::class, 'memberActivityReport'])
            ->name('admin.reports.members');
        Route::get('/reports/sessions', [ReportController::class, 'sessionReport'])
            ->name('admin.reports.sessions');
        Route::get('/reports/revenues', [ReportController::class, 'financialReport'])
            ->name('admin.reports.revenues');
        Route::get('/reports/custom', [ReportController::class, 'customReport'])
            ->name('admin.reports.custom');
        Route::get('/reports/export', [ReportController::class, 'exportReport'])
            ->name('admin.reports.export');
        Route::get('/reports/membership-trends', [ReportController::class, 'membershipTrendsReport'])
            ->name('admin.reports.membership-trends');
        Route::get('/reports/trainer-performance', [ReportController::class, 'trainerPerformanceReport'])
            ->name('admin.reports.trainer-performance');
            
        // Session management
        Route::resource('sessions', AdminSessionController::class)
            ->names([
                'index' => 'admin.sessions.index',
                'create' => 'admin.sessions.create',
                'store' => 'admin.sessions.store',
                'show' => 'admin.sessions.show',
                'edit' => 'admin.sessions.edit',
                'update' => 'admin.sessions.update',
                'destroy' => 'admin.sessions.destroy',
            ]);
            
        // Session additional actions
        Route::get('/sessions/{session}/attendance', [AdminSessionController::class, 'attendance'])
            ->name('admin.sessions.attendance');
        Route::post('/sessions/{session}/add-member', [AdminSessionController::class, 'addMember'])
            ->name('admin.sessions.add-member');
        Route::post('/sessions/{session}/cancel', [AdminSessionController::class, 'cancel'])
            ->name('admin.sessions.cancel');
        
        // Subscription management
        Route::resource('subscriptions', AdminSubscriptionController::class)
            ->names([
                'index' => 'admin.subscriptions.index',
                'create' => 'admin.subscriptions.create',
                'store' => 'admin.subscriptions.store',
                'show' => 'admin.subscriptions.show',
                'edit' => 'admin.subscriptions.edit',
                'update' => 'admin.subscriptions.update',
                'destroy' => 'admin.subscriptions.destroy',
            ]);
            
        // Subscription additional actions
        Route::post('/subscriptions/{subscription}/renew', [AdminSubscriptionController::class, 'renew'])
            ->name('admin.subscriptions.renew');
        Route::post('/subscriptions/{subscription}/cancel', [AdminSubscriptionController::class, 'cancel'])
            ->name('admin.subscriptions.cancel');
        Route::get('/subscriptions/report', [AdminSubscriptionController::class, 'report'])
            ->name('admin.subscriptions.report');
        Route::get('/subscriptions/export', [AdminSubscriptionController::class, 'export'])
            ->name('admin.subscriptions.export');
        
        // Attendance management
        Route::resource('attendances', AdminAttendanceController::class)
            ->names([
                'index' => 'admin.attendances.index',
                'create' => 'admin.attendances.create',
                'store' => 'admin.attendances.store',
                'show' => 'admin.attendances.show',
                'edit' => 'admin.attendances.edit',
                'update' => 'admin.attendances.update',
                'destroy' => 'admin.attendances.destroy',
            ]);
            
        // Attendance entry and exit routes
        Route::post('/attendances/record-entry', [AdminAttendanceController::class, 'recordEntry'])
            ->name('admin.attendances.record-entry');
        Route::post('/attendances/{attendance}/record-exit', [AdminAttendanceController::class, 'recordExit'])
            ->name('admin.attendances.record-exit');
            
        // Attendance report route
        Route::get('/attendances/report', [AdminAttendanceController::class, 'report'])
            ->name('admin.attendances.report');
        
        // Payment management
        Route::resource('payments', AdminPaymentController::class)
            ->names([
                'index' => 'admin.payments.index',
                'create' => 'admin.payments.create',
                'store' => 'admin.payments.store',
                'show' => 'admin.payments.show',
                'edit' => 'admin.payments.edit',
                'update' => 'admin.payments.update',
                'destroy' => 'admin.payments.destroy',
            ]);
            
        // Payment additional actions
        Route::post('/payments/{payment}/process', [AdminPaymentController::class, 'process'])
            ->name('admin.payments.process');
        Route::post('/payments/{payment}/refund', [AdminPaymentController::class, 'refund'])
            ->name('admin.payments.refund');
        Route::get('/payments/{payment}/receipt', [AdminPaymentController::class, 'generateReceipt'])
            ->name('admin.payments.receipt');
        Route::get('/payments/report', [AdminPaymentController::class, 'report'])
            ->name('admin.payments.report');
    });
});