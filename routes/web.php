<?php

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

Route::get('/', function () {
    return view('pages.add-product');
    return view('dashboards.index');
});

Route::get('/add-product', function () {
    return view('pages.add-product');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/sign-in', function () {
    return view('pages.sign-in');
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