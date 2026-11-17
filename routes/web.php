<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AIRecommendationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\AIResumeController;




Route::middleware(['auth'])->group(function () 
{
    Route::get('/student/recommendations', [AIRecommendationController::class, 'recommendationsPage'])->name('student.recommendations');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [GuestController::class, 'guesthome'])->name('guesthome');

Route::get('/loginn', [GuestController::class, 'login'])->name('loginn');
Route::post('/loginn', [GuestController::class, 'loginStore']);

Route::get('/registerr', [GuestController::class, 'register'])->name('register');
Route::post('/registerr', [GuestController::class, 'registerStore'])
    ->name('register.store');


Route::get('/adminhome', [AdminController::class, 'adminhome'])
    ->name('adminhome');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/qualifications', [AdminController::class, 'qualificationsIndex'])
        ->name('addqualification');

    Route::post('/qualifications', [AdminController::class, 'qualificationsStore'])
        ->name('qualifications.store');

    Route::get('/qualifications/{qualification_id}/edit', [AdminController::class, 'qualificationsEdit'])
        ->name('qualifications.edit');

    Route::put('/qualifications/{qualification_id}', [AdminController::class, 'qualificationsUpdate'])
        ->name('qualifications.update');

    Route::delete('/qualifications/{qualification_id}', [AdminController::class, 'qualificationsDestroy'])
        ->name('qualifications.destroy');


    Route::get('/branches', [AdminController::class, 'branchesIndex'])
        ->name('branches.index');

    Route::post('/branches', [AdminController::class, 'branchesStore'])
        ->name('branches.store');

    Route::get('/branches/{branch_id}/edit', [AdminController::class, 'branchesEdit'])
        ->name('branches.edit');

    Route::put('/branches/{branch_id}', [AdminController::class, 'branchesUpdate'])
        ->name('branches.update');

    Route::delete('/branches/{branch_id}', [AdminController::class, 'branchesDestroy'])
        ->name('branches.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
    // your routes
});

    Route::get('/addplan', [AdminController::class, 'plansIndex'])->name('addplan');
    Route::get('/plans', [AdminController::class, 'plansIndex'])->name('plans.index');
    Route::post('/addplan', [AdminController::class, 'plansStore'])->name('plans.store');
    Route::get('/addplan/{id}/edit', [AdminController::class, 'plansEdit'])->name('plans.edit');
    Route::put('/addplan/{id}', [AdminController::class, 'plansUpdate'])->name('plans.update');
    Route::delete('/addplan/{id}', [AdminController::class, 'plansDestroy'])->name('plans.destroy');
    Route::patch('/addplan/{id}/activate', [AdminController::class, 'plansActivate'])->name('plans.activate');
    Route::patch('/addplan/{id}/deactivate', [AdminController::class, 'plansDeactivate'])->name('plans.deactivate');

    // Resume Templates
    Route::get('/resume-templates', [AdminController::class, 'resumeTemplatesIndex'])->name('resumetemplates.index');
    Route::get('/addresumetemplate', [AdminController::class, 'resumeTemplatesIndex'])->name('addresumetemplate');
    Route::post('/resume-templates', [AdminController::class, 'resumeTemplatesStore'])->name('resumetemplates.store');
    Route::get('/resume-templates/{id}/edit', [AdminController::class, 'resumeTemplatesEdit'])->name('resumetemplates.edit');
    Route::put('/resume-templates/{id}', [AdminController::class, 'resumeTemplatesUpdate'])->name('resumetemplates.update');
    Route::delete('/resume-templates/{id}', [AdminController::class, 'resumeTemplatesDestroy'])->name('resumetemplates.destroy');
    Route::patch('/resume-templates/{id}/activate', [AdminController::class, 'resumeTemplatesActivate'])->name('resumetemplates.activate');
    Route::patch('/resume-templates/{id}/deactivate', [AdminController::class, 'resumeTemplatesDeactivate'])->name('resumetemplates.deactivate');

    // Reports & User Feedbacks
    Route::get('/reports', [AdminController::class, 'reportsIndex'])->name('reports');
    Route::get('/feedbacks', [AdminController::class, 'reportsIndex'])->name('feedbacks.index');
    Route::patch('/feedbacks/{id}/mark-read', [AdminController::class, 'feedbackMarkRead'])->name('feedbacks.markread');
    Route::delete('/feedbacks/{id}', [AdminController::class, 'feedbackDestroy'])->name('feedbacks.destroy');

    // Manage Payments
    Route::get('/payments', [AdminController::class, 'paymentsIndex'])->name('payments.index');
    Route::get('/managepayments', [AdminController::class, 'paymentsIndex'])->name('managepayments');

});

// Feedback Submission
Route::post('/feedback', [GuestController::class, 'feedbackStore'])->name('feedback.store');


// ================================
// RESUME BUILDER & EDIT ROUTES
// ================================

// Catalog / Template Picker Page
Route::get('/student/resume/template-1', [ResumeController::class, 'index'])
    ->middleware(['auth'])
    ->name('student.resume.template1');

// Start / Use a Template (creates record in resumes table from student details if not present, then opens edit page)
Route::get('/student/resume/start/{templateId}', [ResumeController::class, 'startOrEdit'])
    ->middleware(['auth'])
    ->name('student.resume.start');

// Edit Page for already created/saved resume
Route::get('/student/resume/{id}/edit', [ResumeController::class, 'edit'])
    ->middleware(['auth'])
    ->name('student.resume.edit');

// Save / Update Resume
Route::put('/student/resume/{id}', [ResumeController::class, 'update'])
    ->middleware(['auth'])
    ->name('student.resume.update');

// Reset / Reload Resume from latest Student profile details
Route::post('/student/resume/{id}/reset', [ResumeController::class, 'resetFromProfile'])
    ->middleware(['auth'])
    ->name('student.resume.reset');

// AI Resume Suggestions, Job Description Match, Deficiency & Improvement Analysis (Premium Only)
Route::post('/student/resume/{id}/ai-suggestions', [AIResumeController::class, 'generateSuggestions'])
    ->middleware(['auth'])
    ->name('student.resume.ai_suggestions');

// Preview Page with Download / Print option
Route::get('/student/resume/{id}/preview', [ResumeController::class, 'preview'])
    ->middleware(['auth'])
    ->name('student.resume.preview');

// Delete Resume
Route::delete('/student/resume/{id}', [ResumeController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('student.resume.destroy');

// Dynamic Template Viewer by ID (redirects through startOrEdit or preview)
Route::get('/student/resume/template/{id}', [ResumeController::class, 'startOrEdit'])
    ->middleware(['auth'])
    ->name('student.resume.view');

// Legacy fallback routes for normal, standard, premium
Route::get('/student/resume/normal', function () {
    return redirect()->route('student.resume.start', 1);
})->middleware(['auth'])->name('student.resume.normal');

Route::get('/student/resume/standard', function () {
    return redirect()->route('student.resume.start', 2);
})->middleware(['auth'])->name('student.resume.standard');

Route::get('/student/resume/premium', function () {
    return redirect()->route('student.resume.start', 3);
})->middleware(['auth'])->name('student.resume.premium');



// ================================
// SUBSCRIPTION ROUTES
// ================================

// View Subscription Plans
Route::get('/subcriptionplan', [SubscriptionController::class, 'index'])
    ->name('student.subscription');

Route::get('/student/subscription-plans', [SubscriptionController::class, 'index'])
    ->name('student.subscription.plan');


// ================================
// STUDENT ROUTES
// ================================

Route::middleware(['auth'])->group(function () {

    // Student Home
    Route::get('/studenthome', [StudentController::class, 'studenthome'])
        ->name('studenthome');

    // Student Profile
    Route::get('/student/profile', [StudentController::class, 'edit'])
        ->name('student.profile');

    Route::post('/student/profile', [StudentController::class, 'update'])
        ->name('student.profile.update');

    // Subscription Payment & Actions
    Route::get('/student/subscription/payment/{plan_id}', [SubscriptionController::class, 'payment'])
        ->name('student.payment');

    Route::post('/student/subscription/payment/process', [SubscriptionController::class, 'processPayment'])
        ->name('student.payment.process');

    Route::post('/student/subscribe', [SubscriptionController::class, 'subscribe'])
        ->name('student.subscribe');

    Route::post('/student/subscription/{id}/cancel', [SubscriptionController::class, 'cancel'])
        ->name('student.subscription.cancel');

});


require __DIR__ . '/auth.php';