<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\MainController;
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
