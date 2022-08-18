<?php

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/faculties')->name('faculties.')->group(function () {
    Route::get('/', [FacultyController::class, 'list'])->name('list');
    Route::get('/create', [FacultyController::class, 'create'])->name('create');
    Route::post('/store', [FacultyController::class, 'store'])->name('store');
    Route::get('/edit/{faculty}', [FacultyController::class, 'edit'])->name('edit');
    Route::put('/update/{faculty}', [FacultyController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [FacultyController::class, 'delete'])->name('delete');
});
Route::prefix('/students')->name('students.')->group(function () {
    Route::get('/', [StudentController::class, 'list'])->name('list');
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/store', [StudentController::class, 'store'])->name('store');
    Route::get('/edit/{student}', [StudentController::class, 'edit'])->name('edit');
    Route::put('/update/{student}', [StudentController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [StudentController::class, 'delete'])->name('delete');
    Route::post('/search_old', [StudentController::class, 'search_old'])->name('search_old');
    Route::post('/search_score', [StudentController::class, 'search_score'])->name('search_score');
});
