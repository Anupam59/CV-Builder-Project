<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerProfileController;
use App\Http\Controllers\Admin\CvController;


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
});


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // ── Customer ──────────────────────────────────────────────────
    Route::get('customers',               [CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/search',        [CustomerController::class, 'searchForm'])->name('customers.search');
    Route::post('customers/search/phone', [CustomerController::class, 'searchByPhone'])->name('customers.search.phone');
    Route::post('customers/attach',       [CustomerController::class, 'attach'])->name('customers.attach');
    Route::post('customers',              [CustomerController::class, 'store'])->name('customers.store');
    Route::get('customers/{customer}',    [CustomerController::class, 'show'])->name('customers.show');

    // ── Customer Profile ──────────────────────────────────────────
    $p = CustomerProfileController::class;

    Route::get('customers/{customer}/profile', [$p, 'show'])->name('customers.profile.show');

    // Personal Detail
    Route::get('customers/{customer}/profile/detail/edit', [$p, 'detailEdit'])->name('customers.profile.detail.edit');
    Route::put('customers/{customer}/profile/detail',      [$p, 'detailUpdate'])->name('customers.profile.detail.update');

    // Education
    Route::get('customers/{customer}/profile/education/create',           [$p, 'educationCreate'])->name('customers.profile.education.create');
    Route::post('customers/{customer}/profile/education',                  [$p, 'educationStore'])->name('customers.profile.education.store');
    Route::get('customers/{customer}/profile/education/{education}/edit', [$p, 'educationEdit'])->name('customers.profile.education.edit');
    Route::put('customers/{customer}/profile/education/{education}',      [$p, 'educationUpdate'])->name('customers.profile.education.update');
    Route::delete('customers/{customer}/profile/education/{education}',      [$p, 'educationDestroy'])->name('customers.profile.education.destroy');

    // Experience
    Route::get('customers/{customer}/profile/experience/create',            [$p, 'experienceCreate'])->name('customers.profile.experience.create');
    Route::post('customers/{customer}/profile/experience',                   [$p, 'experienceStore'])->name('customers.profile.experience.store');
    Route::get('customers/{customer}/profile/experience/{experience}/edit', [$p, 'experienceEdit'])->name('customers.profile.experience.edit');
    Route::put('customers/{customer}/profile/experience/{experience}',      [$p, 'experienceUpdate'])->name('customers.profile.experience.update');
    Route::delete('customers/{customer}/profile/experience/{experience}',      [$p, 'experienceDestroy'])->name('customers.profile.experience.destroy');

    // Skill
    Route::get('customers/{customer}/profile/skill/create',       [$p, 'skillCreate'])->name('customers.profile.skill.create');
    Route::post('customers/{customer}/profile/skill',              [$p, 'skillStore'])->name('customers.profile.skill.store');
    Route::get('customers/{customer}/profile/skill/{skill}/edit', [$p, 'skillEdit'])->name('customers.profile.skill.edit');
    Route::put('customers/{customer}/profile/skill/{skill}',      [$p, 'skillUpdate'])->name('customers.profile.skill.update');
    Route::delete('customers/{customer}/profile/skill/{skill}',      [$p, 'skillDestroy'])->name('customers.profile.skill.destroy');

    // Project
    Route::get('customers/{customer}/profile/project/create',         [$p, 'projectCreate'])->name('customers.profile.project.create');
    Route::post('customers/{customer}/profile/project',                [$p, 'projectStore'])->name('customers.profile.project.store');
    Route::get('customers/{customer}/profile/project/{project}/edit', [$p, 'projectEdit'])->name('customers.profile.project.edit');
    Route::put('customers/{customer}/profile/project/{project}',      [$p, 'projectUpdate'])->name('customers.profile.project.update');
    Route::delete('customers/{customer}/profile/project/{project}',      [$p, 'projectDestroy'])->name('customers.profile.project.destroy');

    // Language
    Route::get('customers/{customer}/profile/language/create',          [$p, 'languageCreate'])->name('customers.profile.language.create');
    Route::post('customers/{customer}/profile/language',                 [$p, 'languageStore'])->name('customers.profile.language.store');
    Route::get('customers/{customer}/profile/language/{language}/edit', [$p, 'languageEdit'])->name('customers.profile.language.edit');
    Route::put('customers/{customer}/profile/language/{language}',      [$p, 'languageUpdate'])->name('customers.profile.language.update');
    Route::delete('customers/{customer}/profile/language/{language}',      [$p, 'languageDestroy'])->name('customers.profile.language.destroy');

    // Certification
    Route::get('customers/{customer}/profile/certification/create',               [$p, 'certificationCreate'])->name('customers.profile.certification.create');
    Route::post('customers/{customer}/profile/certification',                      [$p, 'certificationStore'])->name('customers.profile.certification.store');
    Route::get('customers/{customer}/profile/certification/{certification}/edit', [$p, 'certificationEdit'])->name('customers.profile.certification.edit');
    Route::put('customers/{customer}/profile/certification/{certification}',      [$p, 'certificationUpdate'])->name('customers.profile.certification.update');
    Route::delete('customers/{customer}/profile/certification/{certification}',      [$p, 'certificationDestroy'])->name('customers.profile.certification.destroy');

    // ── CV ────────────────────────────────────────────────────────
    Route::get('cvs',          [CvController::class, 'index'])->name('cvs.index');
    Route::get('cvs/create',   [CvController::class, 'create'])->name('cvs.create');
    Route::post('cvs',          [CvController::class, 'store'])->name('cvs.store');
    Route::get('cvs/{cv}',     [CvController::class, 'show'])->name('cvs.show');
    Route::delete('cvs/{cv}',   [CvController::class, 'destroy'])->name('cvs.destroy');
});


require __DIR__ . '/auth.php';
