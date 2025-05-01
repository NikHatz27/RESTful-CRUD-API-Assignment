<?php

use Illuminate\Support\Facades\Route;
use App\Courses\Controllers\CourseController;


Route::get('/courses', [CourseController::class, 'index'])->name('index');
Route::get('/courses/{id}', [CourseController::class, 'showById'])->name('show.by.id');
Route::post('/courses', [CourseController::class, 'createCourse'])->name('create.course');
Route::put('/courses/{id}', [CourseController::class, 'updateCourse'])->name('update.course');
Route::delete('/courses/{id}', [CourseController::class, 'deleteCourse'])->name('delete.course');
