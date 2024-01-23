<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

Route::get('/products', [ProductController::class, 'showProducts'])->name('showProduct');

Route::post('/signInAuth', [AdminController::class, 'signInAuth'])->name('signInAuth');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
Route::view('/', 'dashboards.index')->middleware('admin.auth');
Route::view('/sign-in', 'pages.sign-in')->name('signInPage');

Route::view('/add-product-form', 'pages.add-product');
Route::post('/add-product', [ProductController::class, 'addProduct'])->name('addProduct');

Route::post('/add-user', [UserController::class, 'addUser'])->name('addUser');
Route::get('/add-user-form/{email?}', [UserController::class, 'showAddUserForm'])->name('addUserForm');
Route::post('/update-user', [UserController::class, 'updateUser'])->name('updateUser');
Route::post('/delete-user', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::get('/users', [UserController::class, 'showUsers'])->name('showUsers');


Route::post('/add-customer', [CustomerController::class, 'addCustomer'])->name('addCustomer');
Route::get('/add-customer-form/{cnic?}', [CustomerController::class, 'showCustomerDetailsForm'])->name('customerDetailsForm');
Route::post('/update-customer', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');
Route::post('/delete-customer', [CustomerController::class, 'deleteCustomer'])->name('deleteCustomer');
Route::get('/customer', [CustomerController::class, 'showCustomers'])->name('showCustomers');

Route::get('/change-password', function () {
    return view('pages.change-password');
});

Route::get('/dashboard/bidding', function () {
    return view('dashboards.bidding');
});

Route::get('/dashboard/call-center', function () {
    return view('dashboards.call-center');
});

Route::get('/dashboard/crypto', function () {
    return view('dashboards.crypto');
});

Route::get('/dashboard/delivery', function () {
    return view('dashboards.delivery');
});

Route::get('/dashboard/ecommerce', function () {
    return view('dashboards.ecommerce');
});

Route::get('/dashboard/finance-performance', function () {
    return view('dashboards.finance-performance');
});

Route::get('/dashboard/logistics', function () {
    return view('dashboards.logistics');
});

Route::get('/dashboard/marketing', function () {
    return view('dashboards.marketing');
});

Route::get('/dashboard/online-courses', function () {
    return view('dashboards.online-courses');
});

Route::get('/dashboard/podcast', function () {
    return view('dashboards.podcast');
});

Route::get('/dashboard/pos', function () {
    return view('dashboards.pos');
});

Route::get('/dashboard/projects', function () {
    return view('dashboards.projects');
});

Route::get('/dashboard/school', function () {
    return view('dashboards.school');
});

Route::get('/dashboard/social', function () {
    return view('dashboards.social');
});

Route::get('/dashboard/store-analytics', function () {
    return view('dashboards.store-analytics');
});

Route::get('/dashboard/website-analytics', function () {
    return view('dashboards.website-analytics');
});