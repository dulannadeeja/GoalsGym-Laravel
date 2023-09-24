<?php

use App\Http\Controllers\auth\AuthProviderController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduledClassController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//member routes
Route::middleware(['auth', 'verified', 'role:member'])->group(function () {
    Route::get('/member/dashboard', fn() => view('member.dashboard'))->name('member.dashboard');
    Route::get('/member/bookings', [BookingController::class, 'index'])->name('member.bookings');
    Route::get('/member/bookings/create', [BookingController::class, 'create'])->name('member.bookings.create');
    Route::post('/member/bookings/{scheduledClass}', [BookingController::class, 'store'])->name('member.bookings.store');
    Route::delete('/member/bookings/{scheduledClass}', [BookingController::class, 'destroy'])->name('member.bookings.destroy');
});

Route::resource('/schedule', ScheduledClassController::class)->only(['index', 'create', 'store', 'destroy'])->middleware(['auth', 'verified', 'role:instructor']);

Route::get('/auth/{provider}/redirect', [AuthProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [AuthProviderController::class, 'callBack']);

require __DIR__ . '/auth.php';
