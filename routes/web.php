<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::middleware('auth', 'verified')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('users', UserController::class)->except(['show']);

    // ── Customer Routes
    Route::get('customers',                [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/search',         [CustomerController::class, 'searchForm'])->name('customers.search');
    Route::post('customers/search/phone',  [CustomerController::class, 'searchByPhone'])->name('customers.search.phone');
    Route::post('customers/attach',        [CustomerController::class, 'attach'])->name('customers.attach');
    Route::post('customers',               [CustomerController::class, 'store'])->name('customers.store');
    Route::get('customers/{customer}',     [CustomerController::class, 'show'])->name('customers.show');

    // ── CV Routes
    // Route::resource('cvs', CvController::class)->except(['index']);

});


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    $ctrl = CustomerProfileController::class;

    // ── Profile Overview ──────────────────────────────────────────
    Route::get('customers/{customer}/profile',[$ctrl, 'show'])->name('customers.profile.show');

    // ── Education ─────────────────────────────────────────────────
    Route::get('customers/{customer}/profile/education/create',[$ctrl, 'educationCreate'])->name('customers.profile.education.create');
    Route::post('customers/{customer}/profile/education',[$ctrl, 'educationStore'])->name('customers.profile.education.store');
    Route::get('customers/{customer}/profile/education/{education}/edit',[$ctrl, 'educationEdit'])->name('customers.profile.education.edit');
    Route::put('customers/{customer}/profile/education/{education}',[$ctrl, 'educationUpdate'])->name('customers.profile.education.update');
    Route::delete('customers/{customer}/profile/education/{education}',[$ctrl, 'educationDestroy'])->name('customers.profile.education.destroy');

    // ── Experience ────────────────────────────────────────────────
    Route::get('customers/{customer}/profile/experience/create',[$ctrl, 'experienceCreate'])->name('customers.profile.experience.create');
    Route::post('customers/{customer}/profile/experience',[$ctrl, 'experienceStore'])->name('customers.profile.experience.store');
    Route::get('customers/{customer}/profile/experience/{experience}/edit',[$ctrl, 'experienceEdit'])->name('customers.profile.experience.edit');
    Route::put('customers/{customer}/profile/experience/{experience}',[$ctrl, 'experienceUpdate'])->name('customers.profile.experience.update');
    Route::delete('customers/{customer}/profile/experience/{experience}',[$ctrl, 'experienceDestroy'])->name('customers.profile.experience.destroy');

    // ── Skill ─────────────────────────────────────────────────────
    Route::get('customers/{customer}/profile/skill/create',[$ctrl, 'skillCreate'])->name('customers.profile.skill.create');
    Route::post('customers/{customer}/profile/skill',[$ctrl, 'skillStore'])->name('customers.profile.skill.store');
    Route::get('customers/{customer}/profile/skill/{skill}/edit',[$ctrl, 'skillEdit'])->name('customers.profile.skill.edit');
    Route::put('customers/{customer}/profile/skill/{skill}',[$ctrl, 'skillUpdate'])->name('customers.profile.skill.update');
    Route::delete('customers/{customer}/profile/skill/{skill}',[$ctrl, 'skillDestroy'])->name('customers.profile.skill.destroy');

    // ── Project ───────────────────────────────────────────────────
    Route::get('customers/{customer}/profile/project/create',[$ctrl, 'projectCreate'])->name('customers.profile.project.create');
    Route::post('customers/{customer}/profile/project',[$ctrl, 'projectStore'])->name('customers.profile.project.store');
    Route::get('customers/{customer}/profile/project/{project}/edit',[$ctrl, 'projectEdit'])->name('customers.profile.project.edit');
    Route::put('customers/{customer}/profile/project/{project}',[$ctrl, 'projectUpdate'])->name('customers.profile.project.update');
    Route::delete('customers/{customer}/profile/project/{project}',[$ctrl, 'projectDestroy'])->name('customers.profile.project.destroy');

    // ── Language ──────────────────────────────────────────────────
    Route::get('customers/{customer}/profile/language/create',[$ctrl, 'languageCreate'])->name('customers.profile.language.create');
    Route::post('customers/{customer}/profile/language',[$ctrl, 'languageStore'])->name('customers.profile.language.store');
    Route::get('customers/{customer}/profile/language/{language}/edit',[$ctrl, 'languageEdit'])->name('customers.profile.language.edit');
    Route::put('customers/{customer}/profile/language/{language}',[$ctrl, 'languageUpdate'])->name('customers.profile.language.update');
    Route::delete('customers/{customer}/profile/language/{language}',[$ctrl, 'languageDestroy'])->name('customers.profile.language.destroy');

    // ── Certification ─────────────────────────────────────────────
    Route::get('customers/{customer}/profile/certification/create',[$ctrl, 'certificationCreate'])->name('customers.profile.certification.create');
    Route::post('customers/{customer}/profile/certification',[$ctrl, 'certificationStore'])->name('customers.profile.certification.store');
    Route::get('customers/{customer}/profile/certification/{certification}/edit',[$ctrl, 'certificationEdit'])->name('customers.profile.certification.edit');
    Route::put('customers/{customer}/profile/certification/{certification}',[$ctrl, 'certificationUpdate'])->name('customers.profile.certification.update');
    Route::delete('customers/{customer}/profile/certification/{certification}',[$ctrl, 'certificationDestroy'])->name('customers.profile.certification.destroy');
});


require __DIR__ . '/auth.php';
