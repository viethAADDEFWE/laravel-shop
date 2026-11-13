<?php

// ================= KHU VỰC NGƯỜI DÙNG (KHÁCH HÀNG) =================
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChatbotController; // <-- ĐÃ THÊM DÒNG NÀY CHO CHATBOT

// ================= KHU VỰC ADMIN =================
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController; 
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminController as AdminStaffController;

use Illuminate\Support\Facades\Route;

// =====================================================================
// 1. ROUTE DÀNH CHO KHÁCH HÀNG (GIỮ NGUYÊN)
// =====================================================================
Route::middleware(['maintenance_active'])->group(function () {
    Route::get('maintenance', [HomeController::class, "maintenance"])->name('user.maintenance');
});

Route::middleware(['maintenance'])->group(function () {
    Route::get('/', [HomeController::class, "index"])->name('user.home');
    Route::get('introduction', [HomeController::class, "introduction"])->name('user.introduction');
    Route::get('product-detail/{product}', [ProductDetailController::class, "show"])->name('user.products_detail');
    Route::get('search', [SearchController::class, "search"])->name('user.search');
    Route::get('products/{slug}', [ProductController::class, "index"])->name('user.products');
    
    // === ROUTE DÀNH CHO CHATBOT AI (MỚI THÊM) ===
    Route::post('/api/chat', [ChatbotController::class, 'chat'])->name('api.chat');
    // ============================================

    Route::middleware(['auth.user'])->group(function () {
        Route::get('logout', [AuthenticatedSessionController::class, "destroy"])->name('user.logout');
        Route::post('product-review/{product}', [ProductReviewController::class, "store"])->name('product_review.store');
        
        Route::group(['prefix' => 'cart'], function(){
            Route::get('/', [CartController::class, 'index'])->name('cart.index');
            Route::post('add-to-cart', [CartController::class, 'store'])->name('cart.store');
            Route::post('update-cart', [CartController::class, 'update'])->name('cart.update');
            Route::get('delete{id}', [CartController::class, 'delete'])->name('cart.delete');
            Route::get('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
        });
    
        Route::group(['prefix' => 'checkout'], function(){
            Route::get('/', [CheckOutController::class, 'index'])->name('checkout.index');
            Route::post('/', [CheckOutController::class, 'store']);
            Route::get('/callback-momo', [CheckOutController::class, 'callbackMomo'])->name('checkout.callback_momo');
            Route::get('/callback-vnpay', [CheckOutController::class, 'callbackVNPay'])->name('checkout.callback_vnpay');
        });
    
        Route::group(['prefix' => 'profile'], function(){
            Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change_password');
            Route::post('/change-profile', [ProfileController::class, 'changeProfile'])->name('profile.change_profile');
        });
    
        Route::group(['prefix' => 'order-history'], function(){
            Route::get('/', [OrderHistoryController::class, 'index'])->name('order_history.index');
            Route::get('/detail/{order}', [OrderHistoryController::class, 'show'])->name('order_history.show');
            Route::get('/update/{order}', [OrderHistoryController::class, 'update'])->name('order_history.update');
        });
    });
    
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, "create"])->name('user.login');
        Route::post('login', [AuthenticatedSessionController::class, "store"]);
    
        Route::get('register', [RegisterController::class, "create"])->name('user.register');
        Route::post('register', [RegisterController::class, "store"]);
        Route::get('verify-email/{user}', [RegisterController::class, "verifyEmail"])
            ->name('user.verification.notice');
        Route::get('account/verify/{id}', [VerifyEmailController::class, 'verifyAccount'])
            ->name('user.verify');
        Route::post('resend-email', [RegisterController::class, "resendEmail"])->name('user.resend_email');
        Route::get('verify-success', [RegisterController::class, "success"])->name('user.verify.success');
    
        Route::get('forgot-password', [ForgotPasswordController::class, "create"])->name('user.forgot_password_create');
        Route::post('forgot-password', [ForgotPasswordController::class, "store"])->name('user.forgot_password_store');
        Route::get('account/change-new-password', [ForgotPasswordController::class, "changePassword"])->name('user.change_new_password');
        Route::post('account/change-new-password', [ForgotPasswordController::class, "updatePassword"]);
    });
});


// =====================================================================
// 2. ROUTE DÀNH RIÊNG CHO ADMIN
// =====================================================================

// --- 2.1. Đăng nhập / Đăng xuất ---
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'create'])->name('login');
        Route::post('login', [AdminAuthController::class, 'store']);
    });
    Route::get('logout', [AdminAuthController::class, 'destroy'])->name('logout');
});

// --- 2.2. Quản lý ---
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Trang chủ Admin
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    
    // === QUẢN LÝ SẢN PHẨM ===
    Route::get('products', [AdminProductController::class, 'index'])->name('product_index');
    Route::get('products/create', [AdminProductController::class, 'create'])->name('product_create');
    Route::post('products', [AdminProductController::class, 'store'])->name('product_store');
    Route::get('products/{product}/edit', [AdminProductController::class, 'edit'])->name('product_edit');
    Route::put('products/{product}', [AdminProductController::class, 'update'])->name('product_update');
    Route::post('products/delete', [AdminProductController::class, 'delete'])->name('product_delete');
    
    Route::get('products/{product}/color', [AdminProductController::class, 'createColor'])->name('product_color_create');
    Route::post('products/{product}/color', [AdminProductController::class, 'storeColor'])->name('product_color_store');
    Route::get('products/{product}/size', [AdminProductController::class, 'createSize'])->name('product_size_create');
    Route::post('products/{product}/size', [AdminProductController::class, 'storeSizeProduct'])->name('product_size_store');

    // === QUẢN LÝ DANH MỤC, THƯƠNG HIỆU, MÀU, SIZE ===
    Route::get('categories', [CategoryController::class, 'index'])->name('category_index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('category_create');
    Route::post('categories', [CategoryController::class, 'store'])->name('category_store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('category_edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('category_update');
    Route::post('categories/delete', [CategoryController::class, 'delete'])->name('category_delete');

    Route::get('brands', [BrandController::class, 'index'])->name('brands_index');
    Route::get('brands/create', [BrandController::class, 'create'])->name('brands_create');
    Route::post('brands', [BrandController::class, 'store'])->name('brands_store');
    Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands_edit');
    Route::put('brands/{brand}', [BrandController::class, 'update'])->name('brands_update');
    Route::post('brands/delete', [BrandController::class, 'delete'])->name('brands_delete');

    Route::get('colors', [ColorController::class, 'index'])->name('colors_index');
    Route::get('colors/create', [ColorController::class, 'create'])->name('colors_create');
    Route::post('colors', [ColorController::class, 'store'])->name('colors_store');
    Route::get('colors/{color}/edit', [ColorController::class, 'edit'])->name('colors_edit');
    Route::put('colors/{color}', [ColorController::class, 'update'])->name('colors_update');
    Route::post('colors/delete', [ColorController::class, 'delete'])->name('colors_delete');

    Route::get('sizes', [SizeController::class, 'index'])->name('size_index');
    Route::get('sizes/create', [SizeController::class, 'create'])->name('size_create');
    Route::post('sizes', [SizeController::class, 'store'])->name('size_store');
    Route::get('sizes/{size}/edit', [SizeController::class, 'edit'])->name('size_edit');
    Route::put('sizes/{size}', [SizeController::class, 'update'])->name('size_update');
    Route::post('sizes/delete', [SizeController::class, 'delete'])->name('size_delete');

    // === QUẢN LÝ ĐƠN HÀNG & THANH TOÁN ===
    Route::get('orders', [AdminOrderController::class, 'index'])->name('order_index');
    Route::get('orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('order_edit');
    Route::put('orders/{order}', [AdminOrderController::class, 'update'])->name('order_update');
    Route::post('orders/delete', [AdminOrderController::class, 'delete'])->name('order_delete');

    Route::get('payments', [PaymentMethodController::class, 'index'])->name('payment_index');
    Route::get('payments/{payment}/edit', [PaymentMethodController::class, 'edit'])->name('payment_edit');
    Route::put('payments/{payment}', [PaymentMethodController::class, 'update'])->name('payment_update');

    // === QUẢN LÝ NGƯỜI DÙNG & NHÂN VIÊN ===
    Route::get('users', [UserController::class, 'index'])->name('users_index');
    Route::get('users/create', [UserController::class, 'create'])->name('users_create');
    Route::post('users', [UserController::class, 'store'])->name('users_store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users_edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users_update');
    Route::post('users/delete', [UserController::class, 'delete'])->name('users_delete');

    Route::get('staffs', [AdminStaffController::class, 'index'])->name('staffs_index');
    Route::get('staffs/create', [AdminStaffController::class, 'create'])->name('staffs_create');
    Route::post('staffs', [AdminStaffController::class, 'store'])->name('staffs_store');
    Route::get('staffs/{user}/edit', [AdminStaffController::class, 'edit'])->name('staffs_edit');
    Route::put('staffs/{user}', [AdminStaffController::class, 'update'])->name('staffs_update');
    Route::post('staffs/delete', [AdminStaffController::class, 'delete'])->name('staffs_delete');

    // === CÀI ĐẶT & CÁ NHÂN ===
    Route::get('settings', [SettingController::class, 'index'])->name('setting_index');
    Route::post('settings', [SettingController::class, 'store'])->name('setting_store');
});