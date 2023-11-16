<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Groupe de routes pour les pages accessibles uniquement aux utilisateurs authentifiés
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');

    Route::get('/namesites', function () {
        return Inertia::render('Admin/Namesites');
    })->name('namesites');

    Route::get('/travelzone', function () {
        return Inertia::render('Admin/Travelzone');
    })->name('travelzone');

    Route::get('/users', [UsersController::class, 'index'])->name('users');

    Route::group(['prefix' => 'user'], function(){
        Route::get('/create', [UsersController::class, 'create'])->name('user.create');
        Route::post('/create', [UsersController::class, 'store'])->name('user.store');
    
        Route::get('/{id}', [UsersController::class, 'show'])->name('user.show');
        
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('user.edit');
        Route::patch('/edit/{id}', [UsersController::class, 'update'])->name('user.update');
    
        Route::delete('/delete/{id}', [UsersController::class, 'destroy'])->name('user.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
