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
    // return view('welcome');
    return view('index');
});
Route::get('blogs', [MainController::class, 'blogs'])->name('blogs');
Route::get('blog-detail/{slug}', [MainController::class, 'blogDetail'])->name('blog-details');
Route::get('category/{slug}', [MainController::class, 'categoryBlogs'])->name('category-blogs');
Route::get('contact-us', [MainController::class, 'contactUs'])->name('contact-us');

// admin routes👇
Route::group(['as' => 'admin.', 'middleware' => ['auth','admin'], 'prefix' => 'admin'], function () {

    Route::get('dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::get('blogs-categories', [BlogCategoryController::class, 'index'])->name('blogs.categories');
    Route::post('blogs-categories/store', [BlogCategoryController::class, 'store'])->name('blog.categories.store');
    Route::delete('blogs-categories-delete/{id}', [BlogCategoryController::class, 'delete'])->name('blog.categories.delete');
    Route::get('blog-category-edit/{id}', [BlogCategoryController::class, 'edit'])->name('blog.category.edit');
    Route::put('blog-category-update/{id}', [BlogCategoryController::class, 'update'])->name('blog.category.update');
    Route::get('blog/create/{id}', [BlogController::class, 'create'])->name('blog.create');
    Route::post('blog/store/{id}', [BlogController::class, 'store'])->name('blog.store');
    Route::get('blog/list/{id}', [BlogController::class, 'list'])->name('blog.list');
    Route::post('ckeditor/upload', [BlogController::class, 'ckeditorBlogs'])->name('ckeditor.upload');
    Route::delete('blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
    Route::get('blog/view/{id}', [BlogController::class, 'view'])->name('blog.view');
    Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('website/appearance', [WebsiteController::class, 'websiteAppearance'])->name('website.appearance');
    Route::get('website/theme', [WebsiteController::class, 'websiteTheme'])->name('website.theme');
    Route::get('website/banner', [WebsiteController::class, 'websiteBanner'])->name('website.banner');
    Route::post('update/bussinees/setting', [WebsiteController::class, 'updateBussineesSetting'])->name('updateBussineesSetting');
    Route::get('contact/list', [MainController::class, 'contactList'])->name('contact.list');
    Route::get('portfolio-categories', [PortfolioCategoryController::class, 'PortfolioCategories'])->name('portfolio.categories');
    Route::post('store', [PortfolioCategoryController::class, 'store'])->name('portfolio.categories.store');
    Route::delete('categories-delete/{id}', [PortfolioCategoryController::class, 'delete'])->name('portfolio.categories.delete');
    Route::get('category-edit/{id}', [PortfolioCategoryController::class, 'edit'])->name('category.edit');
    Route::put('category-update/{id}', [PortfolioCategoryController::class, 'update'])->name('category.update');
    Route::get('create-portfolio/{id}', [PortfolioController::class, 'create'])->name('create-portfolio');
    Route::get('portfolio-list/{id}', [PortfolioController::class, 'list'])->name('portfolio-list');
    Route::post('store-portfolio', [PortfolioController::class, 'store'])->name('store-portfolio');
    Route::delete('portfolio-delete/{id}', [PortfolioController::class, 'delete'])->name('portfolio.delete');
    Route::get('portfolio-edit/{id}', [PortfolioController::class, 'edit'])->name('portfolio-edit');
    Route::post('portfolio-update/{id}', [PortfolioController::class, 'update'])->name('portfolio-update');
    Route::get('chat/list', [ChatMessageController::class, 'chatList'])->name('chat.list');
    Route::get('leads/list', [LeadController::class, 'list'])->name('leads.list');
    Route::get('leads/create', [LeadController::class, 'create'])->name('leads.create');
    Route::get('leads/edit/{id}', [LeadController::class, 'edit'])->name('leads.edit');
    Route::delete('leads/delete/{id}', [LeadController::class, 'delete'])->name('leads.delete');
});


Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [MainController::class, 'checkRole'])->name('dashboard');
});

//  user profile Route👇
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
