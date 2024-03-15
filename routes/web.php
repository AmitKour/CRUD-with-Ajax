<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::get('/add-student',function(){
    return view('form');
});

Route::post('add-student',[StudentController::class,'addStudent'])->name('addStudent');

Route::get('/get-students',function(){
    return view('show');
});


Route::get('/get-all-students', [StudentController::class, 'index'])->name('students.index');

Route::get('/edit-student/{id}', [StudentController::class, 'edit'])->name('students.edit');

Route::put('/update-student/{id}', [StudentController::class, 'update'])->name('students.update');

Route::delete('/delete-student/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
