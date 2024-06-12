<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
// 
Route::get('/', [UserController::class, 'index']);



// Admin Route-----______
Route::group(['middleware' => ['auth', 'roles:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');
    Route::get('logout', [AdminController::class, 'adminLogout'])->name('logout');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('admin/profile/stote', [AdminController::class, 'profileStore'])->name('profile-store');
    Route::get('password/change', [AdminController::class, 'changePassword'])->name('password-change');
    Route::post('password/update', [AdminController::class, 'updatePassword'])->name('password-update');
});

Route::get('admin/login', [AdminController::class, 'index'])->name('admin.login');
