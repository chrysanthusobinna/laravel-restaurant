<?php

use App\Http\Middleware\CheckRole;

//use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Controllers\MainSiteController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\TableBookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TestimonyController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\TableBookingController as AdminTableBookingController;


Route::get('/', [MainSiteController::class, 'home'])->name('home');

Route::post('table-booking/', [TableBookingController::class, 'bookTable'])->name('table.booking');

Route::get('menu/', [MainSiteController::class, 'menu'])->name('menu');
Route::get('menu-item/{id}', [MainSiteController::class, 'menuItem'])->name('menu.item');

// Customer Cart 
Route::get('cart/', [MainSiteController::class, 'cart'])->name('customer.cart');
Route::post('cart/add', [MainSiteController::class, 'addToCart'])->name('customer.cart.add');
Route::post('cart/remove', [MainSiteController::class, 'removeFromCart'])->name('customer.cart.remove');
Route::get('cart/view', [MainSiteController::class, 'getCart'])->name('customer.cart.view');
Route::post('cart/clear', [MainSiteController::class, 'clearCart'])->name('customer.cart.clear');
Route::post('cart/update', [MainSiteController::class, 'updateCartQuantity'])->name('customer.cart.update');
Route::get('checkout/', [MainSiteController::class, 'checkout'])->name('customer.checkout');

Route::post('proccess-checkout/', [MainSiteController::class, 'proccessCheckout'])->name('customer.proccess.checkout');

Route::get('getcart-totalitems/', [MainSiteController::class, 'getTotalItems'])->name('customer.getcart.totalitems');

 
Route::get('payment/', [PaymentController::class, 'payment'])->name('payment');
Route::get('payment-success/', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('payment-cancel/', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

  

Route::get('about/', [MainSiteController::class, 'about'])->name('about');
Route::get('contact/', [MainSiteController::class, 'contact'])->name('contact');

Route::get('blogs/', [MainSiteController::class, 'blogs'])->name('blogs');
Route::get('blog/view/{id}', [MainSiteController::class, 'blogView'])->name('blog.view');

Route::get('privacy-policy/', [MainSiteController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('terms-conditions/', [MainSiteController::class, 'termsConditions'])->name('terms.conditions');


//Resetting Password
Route::middleware(['guest'])->group(function () {

    // Admin login routes
    Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/process-login/', [AuthController::class, 'login'])->name('admin.login.process');

    //admin activate route
    Route::get('admin/activate-link-request', [AuthController::class, 'requestActivationLink'])->name('admin.activate.link.request');
    Route::get('admin/activate-account/{token}', [AuthController::class, 'activateAccount'])->name('admin.activate.account');
    Route::post('admin/process-activate-account/', [AuthController::class, 'processApdatePassword'])->name('admin.process.activate.account');

    //password reset routes
    Route::get('admin/password/request', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('admin/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('admin/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('admin/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});


//Admin Dashboard routes
Route::prefix('admin')->middleware(RedirectIfNotAdmin::class)->group(function () {
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');


    Route::get('profile', [AdminController::class, 'viewMyProfile'])->name('admin.view.myprofile');
    Route::get('profile/edit', [AdminController::class, 'editMyProfile'])->name('admin.myprofile.edit');
    Route::put('profile/update', [AdminController::class, 'updateMyProfile'])->name('admin.myprofile.update');


    //change password
    Route::get('change-password', [AdminController::class, 'showChangePasswordForm'])->name('change.password.form');
    Route::post('change-password', [AdminController::class, 'changePassword'])->name('change-password.update');

    //Admin Blog routes
    Route::get('blog', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('blog', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('blog/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('blog/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('blog/{id}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');
     


    // Admin Cart / POS routes
    Route::get('pos/', [CartController::class, 'index'])->name('admin.pos.index');
    Route::post('cart/add', [CartController::class, 'addToCart'])->name('admin.cart.add');
    Route::post('cart/remove', [CartController::class, 'removeFromCart'])->name('admin.cart.remove');
    Route::get('cart/view', [CartController::class, 'getCart'])->name('admin.cart.view');
    Route::post('cart/clear', [CartController::class, 'clearCart'])->name('admin.cart.clear');
    Route::post('cart/update', [CartController::class, 'updateCartQuantity'])->name('admin.cart.update');

 
    //Admin Order routes
    Route::get('orders/{filter?}', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('order/{id}', [OrderController::class, 'show'])->name('admin.order.show');
    Route::post('order/create', [OrderController::class, 'createOrder'])->name('admin.order.store');
    Route::post('orders/update/{id}', [OrderController::class, 'update'])->name('admin.orders.update');


    //Admin Manage Booking
    Route::get('table-bookings', [AdminTableBookingController::class, 'index'])->name('admin.table-bookings');
    Route::post('table-bookings/store', [AdminTableBookingController::class, 'store'])->name('admin.table-bookings.store');
    Route::put('table-bookings/{id}', [AdminTableBookingController::class, 'update'])->name('admin.table-bookings.update');
    Route::delete('table-bookings/{id}', [AdminTableBookingController::class, 'destroy'])->name('admin.table-bookings.destroy');
   

    // Routes with CheckRole is Global Admin middleware
    Route::middleware(CheckRole::class)->group(function () {

        // Admin Settings Category
        Route::get('category', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('category/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::post('category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        //Admin Settings Menu
        Route::get('menu', [MenuController::class, 'index'])->name('admin.menus.index');
        Route::post('menu', [MenuController::class, 'store'])->name('admin.menus.store');
        Route::patch('menu/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
        Route::delete('menu/{id}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
    
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

        //Admin Settings Orders
        Route::post('order-settings', [GeneralSettingsController::class, 'updateOrderSettings'])->name('admin.order-settings.update');
        Route::post('/site-settings/save', [GeneralSettingsController::class, 'siteSettings'])->name('site-settings.save');

        //Admin Terms And Condition routes
        Route::get('terms-and-conditions/edit', [TermsAndConditionController::class, 'edit'])->name('admin.terms.edit');
        Route::post('terms-and-conditions/update', [TermsAndConditionController::class, 'update'])->name('admin.terms.update');
    
    
        // Admin Privacy Policy routes
        Route::get('privacy-policy/edit', [PrivacyPolicyController::class, 'edit'])->name('admin.privacy-policy.edit');
        Route::post('privacy-policy/update', [PrivacyPolicyController::class, 'update'])->name('admin.privacy-policy.update');  
        
        
        //Admin testimonies routes
        Route::get('testimonies', [TestimonyController::class, 'index'])->name('admin.testimonies.index');
        Route::post('testimonies/store', [TestimonyController::class, 'store'])->name('admin.testimonies.store');
        Route::put('testimonies/{id}', [TestimonyController::class, 'update'])->name('admin.testimonies.update');
        Route::delete('testimonies/{id}', [TestimonyController::class, 'destroy'])->name('admin.testimonies.destroy');


        //Admin Manage Users routes
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
        Route::put('users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    });
        
});

 