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
});

Route::group(['middleware' => ['permission:list|show']], function () {
    Route::resource('faculties', FacultyController::class)->only('index');
    Route::resource('students', StudentController::class)->only('show');
    Route::resource('subjects', SubjectController::class)->only('index');
});

Route::prefix('subjects')->name('subjects.')->group(function () {
    Route::post('/sub_subject/{$student}', [SubjectController::class, 'sub_subject'])->name('sub_subject');
});

