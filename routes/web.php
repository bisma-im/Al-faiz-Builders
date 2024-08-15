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
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\StatementsController;

Route::post('/signInAuth', [AdminController::class, 'signInAuth'])->name('signInAuth');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
Route::post('/change-password', [AdminController::class, 'changePassword'])->name('changePassword')->middleware('admin.auth');
Route::view('/change-password-form', 'pages.change-password')->name('changePasswordForm')->middleware('admin.auth');
Route::get('/', [AdminController::class, 'viewDashboard'])->middleware('admin.auth');
Route::view('/sign-in', 'pages.sign-in')->name('signInPage');

Route::get('/booking-verification', [CustomerController::class, 'showBookingVerificationForm']);
Route::post('/customer-verification', [CustomerController::class, 'verifyCustomer'])->name('verifyCustomer');

Route::get('/access-rights', [AdminController::class, 'accessRightsTable'])->name('accessRightsTable')->middleware('admin.auth');
Route::post('/save-access-rights', [AdminController::class, 'saveAccessRights'])->name('saveAccessRights')->middleware('admin.auth');

Route::view('/add-product-form', 'pages.add-product')->middleware('admin.auth');
Route::post('/add-product', [ProductController::class, 'addProduct'])->name('addProduct')->middleware('admin.auth');
Route::get('/products', [ProductController::class, 'showProducts'])->name('showProduct')->middleware('admin.auth');

Route::post('/add-user', [UserController::class, 'addUser'])->name('addUser')->middleware('admin.auth');
Route::get('/add-user-form', [UserController::class, 'showAddUserForm'])->name('addUserForm')->middleware('admin.auth');
Route::post('/update-user', [UserController::class, 'updateUser'])->name('updateUser')->middleware('admin.auth');
Route::post('/delete-user', [UserController::class, 'deleteUser'])->name('deleteUser')->middleware('admin.auth');
Route::get('/users', [UserController::class, 'showUsers'])->name('showUsers')->middleware('admin.auth');
Route::get('/users/{id}', [UserController::class, 'showAddUserForm'])->name('updateUserForm')->middleware('admin.auth');

Route::post('/add-customer', [CustomerController::class, 'addCustomer'])->name('addCustomer')->middleware('admin.auth');
Route::get('/add-customer-form', [CustomerController::class, 'showCustomerDetailsForm'])->name('customerDetailsForm')->middleware('admin.auth');
Route::post('/update-customer', [CustomerController::class, 'updateCustomer'])->name('updateCustomer')->middleware('admin.auth');
Route::post('/delete-customer', [CustomerController::class, 'deleteCustomer'])->name('deleteCustomer')->middleware('admin.auth');
Route::get('/customers', [CustomerController::class, 'showCustomers'])->name('showCustomers')->middleware('admin.auth');
Route::get('/customers/{id}', [CustomerController::class, 'showCustomerDetailsForm'])->name('updateCustomerDetailsForm')->middleware('admin.auth');

Route::post('/add-project', [ProjectController::class, 'addProject'])->name('addProject')->middleware('admin.auth');
Route::get('/projects', [ProjectController::class, 'showProjects'])->name('showProjects')->middleware('admin.auth');
Route::get('/projects/{id}', [ProjectController::class, 'showAddProjectForm'])->name('updateProjectForm')->middleware('admin.auth');
Route::get('/add-project-form', [ProjectController::class, 'showAddProjectForm'])->name('showAddProjectForm')->middleware('admin.auth');
Route::post('/update-project', [ProjectController::class, 'updateProject'])->name('updateProject')->middleware('admin.auth');
Route::get('{id}/plots', [ProjectController::class, 'showPlots'])->name('showPlots')->middleware('admin.auth');
Route::post('/update-plot', [ProjectController::class, 'updatePlot'])->name('updatePlot')->middleware('admin.auth');
Route::post('/delete-project/{id}', [ProjectController::class, 'deleteProject'])->name('deleteProject')->middleware('admin.auth');
Route::post('/delete-plot', [ProjectController::class, 'deletePlot'])->name('deletePlot')->middleware('admin.auth');

Route::post('/add-phase-form', [ProjectController::class, 'showAddPhaseForm'])->name('showAddPhaseForm')->middleware('admin.auth');
Route::post('/add-phase', [ProjectController::class, 'addPhase'])->name('addPhase')->middleware('admin.auth');
Route::get('/projects/{projectId}/phases/{phaseId}', [ProjectController::class, 'showAddPhaseForm'])->name('updatePhaseForm')->middleware('admin.auth');
Route::post('/update-phase', [ProjectController::class, 'updatePhase'])->name('updatePhase')->middleware('admin.auth');

Route::get('/add-voucher-form', [VoucherController::class, 'showVoucherForm'])->name('showVoucherForm')->middleware('admin.auth');
Route::post('/add-voucher', [VoucherController::class, 'addVoucher'])->name('addVoucher')->middleware('admin.auth');
Route::get('/voucher-pdf', [VoucherController::class, 'voucherPdf'])->name('voucherPdf')->middleware('admin.auth');
Route::get('/download-voucher', [VoucherController::class, 'downloadVoucher'])->name('downloadVoucher')->middleware('admin.auth');
Route::get('/vouchers', [VoucherController::class, 'showVouchers'])->name('showVouchers')->middleware('admin.auth');
Route::get('/get-voucher/{safeVoucherId}', [VoucherController::class, 'getVoucher'])->name('getVoucher')->middleware('admin.auth');
Route::post('/export-vouchers', [VoucherController::class, 'exportVouchers'])->name('exportVouchers')->middleware('admin.auth');

Route::get('/ledger-form', [LedgerController::class, 'showLedgerForm'])->name('showLedgerForm')->middleware('admin.auth');
Route::post('/show-ledger', [LedgerController::class, 'showLedger'])->name('showLedger')->middleware('admin.auth');
Route::get('/generate-pdf', [LedgerController::class, 'downloadLedger'])->name('downloadLedger')->middleware('admin.auth');

Route::post('/trial-balance', [StatementsController::class, 'generateTrialBalance'])->name('generateTrialBalance')->middleware('admin.auth');
Route::get('/trial-balance-form', [StatementsController::class, 'showTBForm'])->name('showTBForm')->middleware('admin.auth');
Route::get('/profit-and-loss', [StatementsController::class, 'generateIncomeStatement'])->name('generateIncomeStatement')->middleware('admin.auth');
Route::get('/invoice-challan', function () {
    return view('pages.test-challan');
});

Route::get('/add-lead-form/{id?}', [LeadController::class, 'showLeadForm'])->name('addLeadForm')->middleware('admin.auth');
Route::post('/add-lead', [LeadController::class, 'addLead'])->name('addLead')->middleware('admin.auth');
Route::post('/update-lead', [LeadController::class, 'updateLead'])->name('updateLead')->middleware('admin.auth');
Route::post('/delete-lead', [LeadController::class, 'deleteLead'])->name('deleteLead')->middleware('admin.auth');
Route::get('/leads', [LeadController::class, 'showLeads'])->name('showLeads')->middleware('admin.auth');
Route::get('/leads/{id}', [LeadController::class, 'showLeadForm'])->name('updateLeadForm')->middleware('admin.auth');
Route::get('/leads/view/{id}', [LeadController::class, 'showLeadForm'])->name('viewLead')->middleware('admin.auth');
Route::post('/add-call-log', [LeadController::class, 'addCallLog'])->name('addCallLog')->middleware('admin.auth');
Route::post('/import-leads-csv', [LeadController::class, 'importLeadsCSV'])->name('importLeadsCSV')->middleware('admin.auth');
Route::get('/get-sales-agents', [LeadController::class, 'getSA'])->name('getSA')->middleware('admin.auth');

Route::get('/add-invoice-form', [InvoiceController::class, 'showAddInvoiceForm'])->name('addInvoiceForm')->middleware('admin.auth');
Route::post('/get-plots', [InvoiceController::class, 'getPlotsForProject'])->middleware('admin.auth');
Route::post('/get-booking-details', [InvoiceController::class, 'getBookingDetails'])->middleware('admin.auth');
Route::post('/add-invoice', [InvoiceController::class, 'addInvoice'])->name('addInvoice')->middleware('admin.auth');
Route::get('/invoices', [InvoiceController::class, 'showInvoices'])->name('showInvoices')->middleware('admin.auth');
Route::get('/invoices/{id}', [InvoiceController::class, 'showAddInvoiceForm'])->name('updateInvoiceForm')->middleware('admin.auth');
Route::post('/update-invoice', [InvoiceController::class, 'updateInvoice'])->name('updateInvoice')->middleware('admin.auth');
Route::get('/generate-invoice-pdf', [InvoiceController::class, 'generateInvoicePdf'])->name('generateInvoicePdf')->middleware('admin.auth');

Route::post('/installment-invoice', [InvoiceController::class, 'addInstallmentInvoice'])->name('addInstallmentInvoice')->middleware('admin.auth');
Route::post('/charges-invoice', [InvoiceController::class, 'addChargesInvoice'])->name('addInstallmentInvoice')->middleware('admin.auth');

Route::get('/add-booking-form', [BookingController::class, 'showBookingForm'])->name('addBookingForm')->middleware('admin.auth');
Route::post('/add-booking', [BookingController::class, 'addBooking'])->name('addBooking')->middleware('admin.auth');
Route::get('/active-bookings/{phaseId?}/{projectId?}', [BookingController::class, 'showBookings'])->name('showActiveBookings')->middleware('admin.auth');
Route::get('/cancelled-bookings', [BookingController::class, 'showBookings'])->name('showCancelledBookings')->middleware('admin.auth');
Route::get('/bookings/{id}', [BookingController::class, 'showBookingForm'])->name('updateBookingForm')->middleware('admin.auth');
Route::post('/update-booking', [BookingController::class, 'updateBooking'])->name('updateBooking')->middleware('admin.auth');
Route::post('/cancel-booking', [BookingController::class, 'cancelBooking'])->name('cancelBooking')->middleware('admin.auth');
Route::post('/get-plots-for-booking', [BookingController::class, 'getPlotsForBooking'])->middleware('admin.auth');
Route::post('/get-phases-for-booking', [BookingController::class, 'getPhasesForBooking'])->middleware('admin.auth');
Route::get('/get-installments/{bookingId}', [BookingController::class, 'getInstallments'])->middleware('admin.auth');
Route::get('/get-customer/{customerId}', [BookingController::class, 'getCustomer'])->middleware('admin.auth');
Route::get('/get-registration-number/{plotId}', [BookingController::class, 'getRegistrationNumber'])->middleware('admin.auth');
Route::post('/add-charges', [BookingController::class, 'addDevCharges'])->name('addDevCharges')->middleware('admin.auth');

Route::post('/add-account', [AccountsController::class, 'addAccount'])->name('addAccount')->middleware('admin.auth');
Route::get('/accounts', [AccountsController::class, 'showAccounts'])->name('showAccounts')->middleware('admin.auth');
Route::get('/add-account-form', [AccountsController::class, 'showAddAccountForm'])->name('addAccountForm')->middleware('admin.auth');
Route::get('/user-documents', [DocumentController::class, 'showDocuments'])->name('showDocuments')->middleware('admin.auth');
Route::get('/download/{docName}', [DocumentController::class, 'downloadDocument'])->name('downloadDocument')->middleware('admin.auth');


Route::view('/testing', 'pages.invoice-challan')->name('invoiceChallan');