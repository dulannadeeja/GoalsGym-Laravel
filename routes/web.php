<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduledClassController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', [DashboardController::class, '__invoke'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/instructor/dashboard', fn() => view('instructor.dashboard'))->middleware(['auth', 'verified', 'role:instructor'])->name('instructor.dashboard');
Route::get('/member/dashboard', fn() => view('member.dashboard'))->middleware(['auth', 'verified', 'role:member'])->name('member.dashboard');
Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/schedule', ScheduledClassController::class)->only(['index', 'create', 'store', 'destroy'])->middleware(['auth', 'verified', 'role:instructor']);

require __DIR__ . '/auth.php';
