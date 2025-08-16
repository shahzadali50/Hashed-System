<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\PortfolioCategoryController;

Route::get('/', function () {
    return view('index');
});


// admin routes👇
Route::group(['as' => 'admin.', 'middleware' => ['auth','admin'], 'prefix' => 'admin'], function () {

    Route::get('dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::get('chat/list', [ChatMessageController::class, 'chatList'])->name('chat.list');
    Route::get('leads/list', [LeadController::class, 'list'])->name('leads.list');
    Route::get('leads/create', [LeadController::class, 'create'])->name('leads.create');
    Route::get('leads/edit/{id}', [LeadController::class, 'edit'])->name('leads.edit');
    Route::delete('leads/delete/{id}', [LeadController::class, 'delete'])->name('leads.delete');
     // Role routes
    Route::get('roles', [RoleController::class, 'list'])->name('roles.list');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/update/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('roles/{role}/permissions', [RoleController::class, 'assignPermissions'])->name('roles.permissions');
    Route::post('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');

    // Permission routes
    Route::get('permissions', [PermissionController::class, 'list'])->name('permissions.list');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/edit/{permission}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('permissions/update/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('permissions/{permission}/show', [PermissionController::class, 'show'])->name('permissions.show');

    // User routes
    Route::get('users', [UserController::class, 'list'])->name('users.list');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{user}/show', [UserController::class, 'show'])->name('users.show');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [MainController::class, 'checkRole'])->name('dashboard');
});

//  user profile Route👇
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
