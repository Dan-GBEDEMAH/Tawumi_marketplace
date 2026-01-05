<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Front\PagesController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProducteurDashboardController;

Route::get('/', [PagesController::class, 'index'])->name('home');

// Frontend routes
Route::get('/boutique', [PagesController::class, 'boutique'])->name('boutique');
Route::get('/nouveautes', [PagesController::class, 'nouveautes'])->name('nouveautes');
Route::get('/offres', [PagesController::class, 'offres'])->name('offres');
Route::get('/blogs', [PagesController::class, 'blogs'])->name('blogs');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/producteurs', [PagesController::class, 'producteurs'])->name('producteurs');

// Cart and Checkout routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/paiement', [CartController::class, 'checkout'])->name('paiement');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/success/{order_id}', [CartController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/my-orders', [CartController::class, 'userOrders'])->name('user.orders');

// Product detail routes
Route::get('/product/{id}', [App\Http\Controllers\Front\ProductDetailController::class, 'show'])->name('product.detail');
Route::post('/product/detail', [App\Http\Controllers\Front\ProductDetailController::class, 'getDetail'])->name('product.detail.ajax');

// Search routes
Route::get('/search', [App\Http\Controllers\Front\SearchController::class, 'search'])->name('search');

// Favorite routes
Route::get('/favorite', [App\Http\Controllers\Front\FavoriteController::class, 'index'])->name('favorite');
Route::post('/favorite/toggle', [App\Http\Controllers\Front\FavoriteController::class, 'toggle'])->name('favorite.toggle');
Route::post('/favorite/clear', [App\Http\Controllers\Front\FavoriteController::class, 'clear'])->name('favorite.clear');

// Invoice routes
Route::get('/invoice/{order_id}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::get('/invoice/{order_id}/download', [InvoiceController::class, 'download'])->name('invoice.download');

// Admin Dashboard routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users/{role?}', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [AdminDashboardController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminDashboardController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/producteurs', [AdminDashboardController::class, 'producteurs'])->name('admin.producteurs');
    
    Route::get('/products', [AdminDashboardController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminDashboardController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminDashboardController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminDashboardController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminDashboardController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminDashboardController::class, 'deleteProduct'])->name('admin.products.delete');
    
    Route::get('/orders', [AdminDashboardController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{id}/edit', [AdminDashboardController::class, 'editOrder'])->name('admin.orders.edit');
    Route::put('/orders/{id}', [AdminDashboardController::class, 'updateOrder'])->name('admin.orders.update');
    
    Route::get('/shops', [AdminDashboardController::class, 'shops'])->name('admin.shops');
    Route::put('/shops/{id}', [AdminDashboardController::class, 'updateShopStatus'])->name('admin.shops.update');
    
    Route::get('/reports', [AdminDashboardController::class, 'reports'])->name('admin.reports');
    Route::get('/settings', [AdminDashboardController::class, 'settings'])->name('admin.settings');
});

// Producteur Dashboard routes
Route::prefix('producteur')->middleware('auth')->group(function () {
    Route::get('/', [ProducteurDashboardController::class, 'index'])->name('producteur.dashboard');
    Route::get('/products', [ProducteurDashboardController::class, 'products'])->name('producteur.products');
    Route::get('/products/create', [ProducteurDashboardController::class, 'createProduct'])->name('producteur.products.create');
    Route::post('/products', [ProducteurDashboardController::class, 'storeProduct'])->name('producteur.products.store');
    Route::get('/products/{id}/edit', [ProducteurDashboardController::class, 'editProduct'])->name('producteur.products.edit');
    Route::put('/products/{id}', [ProducteurDashboardController::class, 'updateProduct'])->name('producteur.products.update');
    Route::delete('/products/{id}', [ProducteurDashboardController::class, 'deleteProduct'])->name('producteur.products.delete');
    
    Route::get('/orders', [ProducteurDashboardController::class, 'orders'])->name('producteur.orders');
    Route::get('/orders/{id}/edit', [ProducteurDashboardController::class, 'editOrder'])->name('producteur.orders.edit');
    Route::put('/orders/{id}', [ProducteurDashboardController::class, 'updateOrder'])->name('producteur.orders.update');
    
    Route::get('/reports', [ProducteurDashboardController::class, 'reports'])->name('producteur.reports');
});

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes (protected)
// Route::get('/admin/dashboard', function () {
//     return '<h1>Admin Dashboard</h1><p>Bienvenue sur le tableau de bord admin.</p><a href="/">Retour à l\'accueil</a>';
// })->name('admin.dashboard')->middleware('auth');

// Route::get('/producteur/dashboard', function () {
//     return '<h1>Producteur Dashboard</h1><p>Bienvenue sur le tableau de bord producteur.</p><a href="/">Retour à l\'accueil</a>';
// })->name('producteur.dashboard')->middleware('auth');

// Route de test pour les images
// Route::get('/test-image', function() {
//     $products = \App\Models\Produit::all();
//     return view('test-image', compact('products'));
// });