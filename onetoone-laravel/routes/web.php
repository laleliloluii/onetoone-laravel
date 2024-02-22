<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students', [StudentController::class, 'index'])->name('student.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/students', [StudentController::class, 'store'])->name('student.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/students/{student}/update', [StudentController::class, 'update'])->name('student.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('students', StudentController::class)->except([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);
