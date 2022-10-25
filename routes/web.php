<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::prefix('')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::post('/check-login', [UserController::class, 'checkLogin'])->name('check-login');

Route::group(['middleware' => ['role:teacher', 'web']], function () {
    Route::resource('faculties', FacultyController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('students', StudentController::class);

    Route::prefix('subjects')->group(function () {
        Route::get('import-subjects/{id}', [SubjectController::class, 'importSubjects'])->name('import-subjects');
        Route::post('upload-subjects/{id}', [SubjectController::class, 'uploadSubjects'])->name('upload-subjects');
        Route::get('export-subjects/{id}', [SubjectController::class, 'exportSubjects'])->name('export-subjects');
        Route::get('mail-subjects/{id}', [SubjectController::class, 'mailSubjects'])->name('mail-subjects');
        Route::get('create-point/{id}', [SubjectController::class, 'createPoint'])->name('create-point');
        Route::put('store-point/{id}', [SubjectController::class, 'storePoint'])->name('store-point');
        Route::get('mail-subjects-all', [SubjectController::class, 'mailSubjectAll'])->name('mail-subjects-all');
        Route::get('mail-avg', [SubjectController::class, 'mailAvg'])->name('mail-avg');
    });

    Route::prefix('students')->group(function () {
        Route::get('get-student/{id}', [StudentController::class, 'getStudent'])->name('get-student');
    });
});

Route::group(['middleware' => ['permission:list|show', 'web']], function () {
    Route::resource('faculties', FacultyController::class)->only('index');
    Route::resource('students', StudentController::class)->only('show');
    Route::resource('subjects', SubjectController::class)->only('index');

    Route::prefix('students')->group(function () {
        Route::put('update-profile/{id}', [StudentController::class, 'updateProfile'])->name('update-profile');
    });

    Route::prefix('subjects')->group(function () {
        Route::post('sub-subject', [SubjectController::class, 'subSubject'])->name('sub-subject');
    });

    Route::put('updateFaculty', [FacultyController::class, 'updateFaculty'])->name('updateFaculty');
});

Route::get('language/{locale}', [HomeController::class, 'language'])->name('language');

Auth::routes();
