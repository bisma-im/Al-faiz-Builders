@extends('layouts.dashboardlayout')
@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Generate New Invoice</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_new_account" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_new_invoice_form" class="form" data-kt-redirect="/invoices" action="{{ route('addInvoice') }}" method="POST">
                        {{-- <form id="kt_new_invoice_form" class="form" > --}}
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                @if (isset($invoiceData) && $invoiceData->id)
                                    <input type="hidden" id="id" name="id" value="{{ $invoiceData->id }}">
                                    <input type="hidden" id="isInstallment" name="isInstallment" value="{{ $invoiceData->isInstallment === 'y' ?  true: false}}">
                                @endif
                                {{-- <input type="hidden" id="date_and_time" name="date_and_time" value="{{ $invoiceData->formattedDateTime ?? '' }}"/> --}}
                                <!--begin::Input group-->
                                <div id="invoiceForm" 
                                data-update-mode="{{ isset($invoiceData) ? 'true' : 'false' }}" 
                                data-selected-plot="{{ $invoiceData->plot_id ?? '' }}">
                                <!-- Your form content -->
                                </div>
                                <!--end::Input group-->
                                
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                        <span class="required">Booking</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Select the appropriate role">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-9 fv-row">
                                        <select name="booking_id" id="bookingDropdown" aria-label="Select Booking" class="form-select form-select-lg fw-semibold" data-control="select2" data-placeholder="Select Booking...">
                                            <option value="">Select Booking...</option>
                                            @foreach ($bookings as $booking)
                                                <option value="{{ $booking->id }}" {{ (isset($invoiceData) && $invoiceData->booking_id == $booking->id) ? 'selected' : '' }}>
                                                    {{ $booking->name }} - CNIC: {{ $booking->cnic_number }} - Booking: {{ $booking->id }} 
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>    
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                        <span>Plot Details</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-3 fv-row">
                                        <input class="form-control" name="project" id="project" class="form-control form-control-lg form-control-solid" 
                                        disabled placeholder="Project" value="{{ isset($invoiceData) ? $invoiceData->project_title : '' }}"/>
                                    </div>    
                                    <div class="col-lg-3 fv-row">
                                        <input class="form-control" name="phase" id="phase" class="form-control form-control-lg form-control-solid" disabled 
                                        placeholder="Phase" value="{{ isset($invoiceData) ? $invoiceData->phase_title : '' }}"/>
                                    </div> 
                                    <div class="col-lg-3 fv-row">
                                        <input class="form-control" name="plot_no" id="plot_no" class="form-control form-control-lg form-control-solid" disabled 
                                        placeholder="Plot Number" value="{{ isset($invoiceData) ? $invoiceData->plot_no : '' }}"/>
                                    </div> 
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="required col-lg-3 col-form-label fw-semibold fs-6 mb-6">
                                        <span>Invoice Items</span>
                                    </label>
                                    <!--end::Label-->
                                    <div id="invoiceData" style="display:none;" data-items="{{$invoiceItems}}"></div>
                                    <div class="col-lg-9 fv-row" data-kt-ecommerce-catalog-add-project="auto-options">
                                        <!--begin::Repeater-->
                                        <div id="kt_ecommerce_add_item_options">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="kt_ecommerce_add_item_options" class="d-flex flex-column gap-3">
                                                    <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
                                                        <!--begin::Input-->
                                                        <div class="col-lg-6 fv-row">
                                                            <input required type="text" name="description" class="form-control form-control-lg" placeholder="Description" />
                                                        </div>
                                                        <div class="col-lg-3 fv-row">
                                                            <input required type="text" name="amount" class="form-control form-control-lg" placeholder="Amount"  />
                                                        </div>
                                                        <!--end::Input-->
                                                        <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger">
                                                            <i class="ki-duotone ki-cross fs-1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Form group-->
                                            <!--begin::Form group-->
                                            <div class="form-group mt-5">
                                                <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary">
                                                <i class="ki-duotone ki-plus fs-2"></i>Add an item</button>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 col-form-label fw-semibold fs-6">Total Amount
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-9 fv-row">
                                        <input type="hidden" id="totalAmount" name="total_amount" value="{{ isset($invoiceData) ? $invoiceData->total_amount : '' }}"/>
                                        <input type="number" step="any" id="total" name="total" class="form-control form-control-lg" placeholder="Total Amount" disabled value="{{ isset($invoiceData) ? $invoiceData->total_amount : '' }}"/>
                                    </div>    
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">Payment Status</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-9 fv-row">
                                        <input class="mt-3 form-check-input" type="radio" name="payment_status" id="paid" value="paid" {{ isset($invoiceData) && $invoiceData->payment_status === 'paid' ? 'checked' : '' }}/>
                                        <label for="paid" class="mt-3 pe-5 ps-1 fw-semibold fs-6">Paid</label>
                                        <input class="mt-3 form-check-input" type="radio" name="payment_status" id="unpaid" value="unpaid" {{ isset($invoiceData) && $invoiceData->payment_status === 'unpaid' ? 'checked' : '' }}/>
                                        <label for="unpaid" class="mt-3 pe-5 ps-1 fw-semibold fs-6">Unpaid</label>
                                        <input class="mt-3 form-check-input" type="radio" name="payment_status" id="cancelled" value="cancelled" {{ isset($invoiceData) && $invoiceData->payment_status === 'cancelled' ? 'checked' : '' }}/>
                                        <label for="cancelled" class="mt-3 pe-5 ps-1 fw-semibold fs-6">Cancelled</label>
                                    </div>    
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary" id="kt_new_invoice_submit">Save Changes</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</div>
@endsection
@push('scripts')
    <script src="{{ URL::asset('assets/js/custom/account/settings/add-invoice.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
@endpush