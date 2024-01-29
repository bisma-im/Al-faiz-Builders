<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LeadController;

Route::post('/signInAuth', [AdminController::class, 'signInAuth'])->name('signInAuth');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
Route::post('/change-password', [AdminController::class, 'changePassword'])->name('changePassword');
Route::view('/', 'dashboards.index')->middleware('admin.auth');
Route::view('/sign-in', 'pages.sign-in')->name('signInPage');

Route::view('/add-product-form', 'pages.add-product');
Route::post('/add-product', [ProductController::class, 'addProduct'])->name('addProduct');
Route::get('/products', [ProductController::class, 'showProducts'])->name('showProduct');

Route::post('/add-user', [UserController::class, 'addUser'])->name('addUser');
Route::get('/add-user-form', [UserController::class, 'showAddUserForm'])->name('addUserForm');
Route::post('/update-user', [UserController::class, 'updateUser'])->name('updateUser');
Route::post('/delete-user', [UserController::class, 'deleteUser'])->name('deleteUser');
Route::get('/users', [UserController::class, 'showUsers'])->name('showUsers');
Route::get('/users/{id}', [UserController::class, 'showAddUserForm'])->name('updateUserForm');

Route::post('/add-customer', [CustomerController::class, 'addCustomer'])->name('addCustomer');
Route::get('/add-customer-form', [CustomerController::class, 'showCustomerDetailsForm'])->name('customerDetailsForm');
Route::post('/update-customer', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');
Route::post('/delete-customer', [CustomerController::class, 'deleteCustomer'])->name('deleteCustomer');
Route::get('/customers', [CustomerController::class, 'showCustomers'])->name('showCustomers');
Route::get('/customers/{id}', [CustomerController::class, 'showCustomerDetailsForm'])->name('updateCustomerDetailsForm');

Route::post('/add-project', [ProjectController::class, 'addProject'])->name('addProject');
Route::get('/projects', [ProjectController::class, 'showProjects'])->name('showProjects');
Route::get('/projects/{id}', [ProjectController::class, 'showAddProjectForm'])->name('updateProjectForm');
Route::get('/add-project-form', [ProjectController::class, 'showAddProjectForm'])->name('showAddProjectForm');
Route::post('/update-project', [ProjectController::class, 'updateProject'])->name('updateProject');
Route::post('/delete-project/{id}', [ProjectController::class, 'deleteProject'])->name('deleteProject');

Route::get('/add-lead-form', [LeadController::class, 'showAddLeadForm'])->name('addLeadForm');
Route::post('/add-lead', [LeadController::class, 'addLead'])->name('addLead');
Route::post('/update-lead', [LeadController::class, 'updateLead'])->name('updateLead');
Route::post('/delete-lead', [LeadController::class, 'deleteLead'])->name('deleteLead');
Route::get('/leads', [LeadController::class, 'showLeads'])->name('showLeads');
Route::get('/leads/{id}', [LeadController::class, 'showAddLeadForm'])->name('updateLeadForm');
Route::get('/leads/{id}/view', [LeadController::class, 'showLead'])->name('viewLead');

Route::get('/change-password-form', function () {
    return view('pages.change-password');
});

Route::get('/add-project-form', function () {
    return view('pages.add-project');
});