<?php


use App\Http\Controllers\FacultyController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
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

Route::prefix('')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
Route::post('/check_login', [UserController::class, 'check_login'])->name('check_login');

Route::group(['middleware' => ['role:teacher']], function () {
    Route::resource('faculties', FacultyController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('students', StudentController::class);

    Route::get('/impost_subjects/{id}', [SubjectController::class, 'impost_subjects'])->name('impost_subjects');
    Route::post('/upload_subjects/{id}', [SubjectController::class, 'upload_subjects'])->name('upload_subjects');
    Route::get('/export_subjects/{id}', [SubjectController::class, 'export_subjects'])->name('export_subjects');
    
    Route::get('/impost_students/{id}', [StudentController::class, 'impost_students'])->name('impost_students');
    Route::post('/upload_students', [StudentController::class, 'upload_students'])->name('upload_students');
    Route::get('/export_students/{id}', [StudentController::class, 'export_students'])->name('export_students');

    Route::get('/get_student/{id}', [StudentController::class, 'get_student'])->name('get_student');
    
    
    Route::get('/mail_subjects/{id}', [SubjectController::class, 'mail_subjects'])->name('mail_subjects');
    Route::get('/create_point/{id}', [SubjectController::class, 'create_point'])->name('create_point');
    Route::put('/store_point', [SubjectController::class, 'store_point'])->name('store_point');
    Route::get('/mail_subjects_all', [SubjectController::class, 'mail_subjects_all'])->name('mail_subjects_all');
    Route::get('/mail_avg', [SubjectController::class, 'mail_avg'])->name('mail_avg');
    
    
});
// Route::post('/storeStudent', [StudentController::class, 'storeStudent'])->name('storeStudent');

Route::group(['middleware' => ['permission:list|show']], function () {
    Route::resource('faculties', FacultyController::class)->only('index');
    Route::resource('students', StudentController::class)->only('show');
    Route::put('/update_profile/{id}', [StudentController::class, 'update_profile'])->name('update_profile');
    Route::resource('subjects', SubjectController::class)->only('index');
    Route::put('/updateFaculty', [FacultyController::class, 'updateFaculty'])->name('updateFaculty');
});

Route::get('/sub_subject', [SubjectController::class, 'sub_subject'])->name('sub_subject');


