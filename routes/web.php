<?php

use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Controllers\MainSiteController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GeneralSettingsController;


Route::get('/', [MainSiteController::class, 'home'])->name('home');
Route::get('menu/', [MainSiteController::class, 'menu'])->name('menu');
Route::get('menu-item/', [MainSiteController::class, 'menuItem'])->name('menu.item');
Route::get('cart/', [MainSiteController::class, 'cart'])->name('cart');
Route::get('checkout/', [MainSiteController::class, 'checkout'])->name('checkout');

Route::get('about/', [MainSiteController::class, 'about'])->name('about');
Route::get('contact/', [MainSiteController::class, 'contact'])->name('contact');

Route::get('blog/', [MainSiteController::class, 'blog'])->name('blog');
Route::get('blog-details/', [MainSiteController::class, 'blogDetails'])->name('blog.details');


// Admin auth routes
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/process-login/', [AdminController::class, 'login'])->name('admin.login.process');
Route::get('admin/login/password-forgot', [AdminController::class, 'passwordForgot'])->name('admin.password.forgot');
Route::get('admin/activate-account', [AdminController::class, 'activateAccount'])->name('admin.activate.account');
Route::post('admin/process-activate-account/', [AdminController::class, 'processApdatePassword'])->name('admin.process.activate.account');


//Admin Dashboard routes
Route::prefix('admin')->middleware(RedirectIfNotAdmin::class)->group(function () {
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::prefix('settings')->group(function () {
        Route::get('category', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('category/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::post('category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        Route::get('menu', [MenuController::class, 'index'])->name('admin.menus.index');
        Route::post('menu', [MenuController::class, 'store'])->name('admin.menus.store');
        Route::patch('menu/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
        Route::delete('menu/{id}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
    });

    Route::get('general-settings', [GeneralSettingsController::class, 'index'])->name('admin.general-settings');

    
    //Admin Settings Phone Number routes
    Route::post('phone-number', [GeneralSettingsController::class, 'storePhoneNumber'])->name('admin.phone-number.store');
    Route::put('phone-number/{id}', [GeneralSettingsController::class, 'updatePhoneNumber'])->name('admin.phone-number.update');
    Route::delete('phone-number/{id}', [GeneralSettingsController::class, 'deletePhoneNumber'])->name('admin.phone-number.delete');

    //Admin Settings Address routes 
    Route::post('address', [GeneralSettingsController::class, 'storeAddress'])->name('admin.address.store');
    Route::put('address/{id}', [GeneralSettingsController::class, 'updateAddress'])->name('admin.address.update');
    Route::delete('address/{id}', [GeneralSettingsController::class, 'deleteAddress'])->name('admin.address.delete');

    //Admin Settings Working hour routes 
    Route::post('working-hour', [GeneralSettingsController::class, 'storeWorkingHour'])->name('admin.working-hour.store');
    Route::put('working-hour/{id}', [GeneralSettingsController::class, 'updateWorkingHour'])->name('admin.working-hour.update');
    Route::delete('working-hour/{id}', [GeneralSettingsController::class, 'deleteWorkingHour'])->name('admin.working-hour.delete');

    //Admin Settings Social Media routes 
    Route::post('social-media-handles', [GeneralSettingsController::class, 'storeSocialMediaHandle'])->name('admin.social-media-handles.store');
    Route::put('social-media-handles/{id}', [GeneralSettingsController::class, 'updateSocialMediaHandle'])->name('admin.social-media-handles.update');
    Route::delete('social-media-handles/{id}', [GeneralSettingsController::class, 'deleteSocialMediaHandle'])->name('admin.social-media-handles.delete');

    //Admin Settings Livechat routes 
    Route::post('livechat', [GeneralSettingsController::class, 'createLiveChatScript'])->name('admin.livechat.store');
    Route::put('livechat/{id}', [GeneralSettingsController::class, 'updateLiveChatScript'])->name('admin.livechat.update');
    Route::delete('livechat/{id}', [GeneralSettingsController::class, 'destroyLiveChatScript'])->name('admin.livechat.destroy');

    //Admin Users routes
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    //Admin Blog routes
    Route::get('blog', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('blog', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('blog/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('blog/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('blog/{id}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');
});
