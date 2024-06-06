<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskShareController;
use App\Http\Controllers\TaskCommentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/adminlte', function () {
    return view('adminlte');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::post('tasks/{task}/markAsCompleted', [TaskController::class, 'markAsCompleted'])->name('tasks.markAsCompleted');
    Route::post('tasks/{task}/markAsPending', [TaskController::class, 'markAsPending'])->name('tasks.markAsPending');

    Route::get('/tasks/{id}', [TaskController::class, 'view'])->name('tasks.view');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/tasks/{task}/comments', [TaskCommentController::class, 'store'])->name('taskcomments.store');
    // Route::get('/tasks/{task}/comments/{comment}', [TaskCommentController::class, 'update'])->name('taskcomments.update');
    Route::delete('/tasks/{task}/comments/{comment}', [TaskCommentController::class, 'destroy'])->name('taskcomments.destroy');

    Route::post('/task/{task}/share', [TaskShareController::class, 'shared'])->name('taskshare.shared');

    // Route::get('/tasks/{task}/comments', [TaskCommentController::class, 'index'])->name('taskscomment.index');
    // Route::get('/tasks/{task}/share', [TaskShareController::class, 'index'])->name('taskshare.index');
});
