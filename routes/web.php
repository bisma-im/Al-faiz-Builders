<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BookingController;

Route::post('/signInAuth', [AdminController::class, 'signInAuth'])->name('signInAuth');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
Route::post('/change-password', [AdminController::class, 'changePassword'])->name('changePassword')->middleware('admin.auth');
Route::view('/change-password-form', 'pages.change-password')->name('changePasswordForm')->middleware('admin.auth');
Route::get('/', [AdminController::class, 'viewDashboard'])->middleware('admin.auth');
Route::view('/sign-in', 'pages.sign-in')->name('signInPage');

Route::get('/booking-verification', [CustomerController::class, 'showBookingVerificationForm']);
Route::post('/customer-verification', [CustomerController::class, 'verifyCustomer'])->name('verifyCustomer');

Route::get('/access-rights', [AdminController::class, 'accessRightsTable'])->name('accessRightsTable');
Route::post('/save-access-rights', [AdminController::class, 'saveAccessRights'])->name('saveAccessRights');

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

Route::get('/add-phase-form', [ProjectController::class, 'showAddPhaseForm'])->name('showAddPhaseForm');
Route::post('/add-phase', [ProjectController::class, 'addPhase'])->name('addPhase');
Route::get('/projects/{projectId}/phases/{phaseId}', [ProjectController::class, 'showAddPhaseForm'])->name('updatePhaseForm');


Route::get('/add-lead-form/{id?}', [LeadController::class, 'showLeadForm'])->name('addLeadForm');
Route::post('/add-lead', [LeadController::class, 'addLead'])->name('addLead');
Route::post('/update-lead', [LeadController::class, 'updateLead'])->name('updateLead');
Route::post('/delete-lead', [LeadController::class, 'deleteLead'])->name('deleteLead');
Route::get('/leads', [LeadController::class, 'showLeads'])->name('showLeads');
Route::get('/leads/{id}', [LeadController::class, 'showLeadForm'])->name('updateLeadForm');
Route::get('/leads/view/{id}', [LeadController::class, 'showLeadForm'])->name('viewLead');
Route::post('/add-call-log', [LeadController::class, 'addCallLog'])->name('addCallLog');

Route::get('/add-invoice-form', [InvoiceController::class, 'showAddInvoiceForm'])->name('addInvoiceForm');
Route::post('/get-plots', [InvoiceController::class, 'getPlotsForProject']);
Route::post('/add-invoice', [InvoiceController::class, 'addInvoice'])->name('addInvoice');
Route::get('/invoices', [InvoiceController::class, 'showInvoices'])->name('showInvoices');
Route::get('/invoices/{id}', [InvoiceController::class, 'showAddInvoiceForm'])->name('updateInvoiceForm');
Route::post('/update-invoice', [InvoiceController::class, 'updateInvoice'])->name('updateInvoice');

Route::get('/add-booking-form', [BookingController::class, 'showBookingForm'])->name('addBookingForm');
Route::post('/add-booking', [BookingController::class, 'addBooking'])->name('addBooking');
Route::get('/bookings', [BookingController::class, 'showBookings'])->name('showBookings');
Route::get('/bookings/{id}', [BookingController::class, 'showBookingForm'])->name('updateBookingForm');
Route::post('/update-booking', [BookingController::class, 'updateBooking'])->name('updateBooking');
Route::post('/get-plots-for-booking', [BookingController::class, 'getPlotsForBooking']);
Route::post('/get-phases-for-booking', [BookingController::class, 'getPhasesForBooking']);
Route::get('/get-installments/{bookingId}', [BookingController::class, 'getInstallments']);
Route::get('/get-customer/{customerId}', [BookingController::class, 'getCustomer']);


Route::post('/add-account', [AccountsController::class, 'addAccount'])->name('addAccount');
Route::get('/accounts', [AccountsController::class, 'showAccounts'])->name('showAccounts');
Route::view('/add-account-form', 'pages.add-account')->name('addAccountForm');

Route::get('/user-documents', [DocumentController::class, 'showDocuments'])->name('showDocuments');
Route::get('/download/{docName}', [DocumentController::class, 'downloadDocument'])->name('downloadDocument');
