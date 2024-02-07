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
                            <h3 class="fw-bold m-0">Generate New Booking</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_new_account" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_new_booking_form" class="form" data-kt-redirect="/bookings" action="{{ route('addInvoice') }}" method="POST">
                        {{-- <form id="kt_new_booking_form" class="form" > --}}
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                @if (isset($bookingData) && $bookingData->id)
                                    <input type="hidden" id="id" name="id" value="{{ $bookingData->id }}">
                                @endif
                                <!--begin::Input group-->
                                <div id="invoiceForm" 
                                data-selected-plot="{{ $bookingData->plot_id ?? '' }}">
                                <!-- Your form content -->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Project-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Project</span>
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
                                    <div class="col-lg-8 fv-row">
                                        <select name="project_id" id="projectDropdown" aria-label="Select Project" class="form-select form-select-solid form-select-lg fw-semibold" data-control="select2" data-placeholder="Select project...">
                                            <option value="">Select Project...</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}" {{ (isset($bookingData) && $bookingData->project_id == $project->id) ? 'selected' : '' }}>
                                                    {{ $project->project_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>    
                                </div>
                                <!--end::Input group Project-->
                                <!--begin::Input group Phase-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Phase</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="project_phase" class="form-control form-control-lg form-control-solid" placeholder="Phase" value="{{ $bookingData->plot_phase ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group Phase-->
                                <!--begin::Input group plot id-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Plot Number</span>
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
                                    <div class="col-lg-8 fv-row">
                                        <select name="plot_id" id="plotDropdown" aria-label="Select Plot Number" class="form-select form-select-solid form-select-lg fw-semibold" placeholder="Select plot number.." data-control="select2">
                                        </select>
                                    </div>    
                                </div>
                                <!--end::Input group plot id-->
                                <!--begin::Input group customer name-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Customer Name</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="customer_name" class="form-control form-control-lg form-control-solid" placeholder="Customer Name" value="{{ $bookingData->plot_phase ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group customer name-->
                                <!--begin::Input group customer cnic-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Customer CNIC</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="customer_cnic" class="form-control form-control-lg form-control-solid" placeholder="Customer CNIC" value="{{ $bookingData->plot_phase ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group customer cnic-->
                                <!--begin::Input group customer cnic-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Contact Number</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="mobile_no" class="form-control form-control-lg form-control-solid" placeholder="Contact Number" value="{{ $bookingData->plot_phase ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group customer cnic-->
                                <!--begin::Input group base unit cost-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Base Unit Cost</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" step="any" name="unit_cost" class="form-control form-control-lg form-control-solid" placeholder="Base Unit Cost" value="{{ $bookingData->plot_phase ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group base unit cost-->
                                <!--begin::Input group extra charges-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Extra Charges</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" step="any" name="extra_charges" class="form-control form-control-lg form-control-solid" placeholder="Extra Charges" value="{{ $bookingData->plot_phase ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group extra charges-->
                                <!--begin::Input group development charges-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Development Charges</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" step="any" name="development_charges" class="form-control form-control-lg form-control-solid" placeholder="Development Charges" value="{{ $bookingData->total_amount ?? '' }}" />
                                        
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group development charges-->
                                <!--begin::Input group per month installment-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Monthly Installment</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" step="any" name="monthly_installment" class="form-control form-control-lg form-control-solid" placeholder="Monthly Installment" value="{{ $bookingData->total_amount ?? '' }}" />
                                        
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group per month installment-->
                                <!--begin::Input group token amount-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Token Amount</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" step="any" name="token_amount" class="form-control form-control-lg form-control-solid" placeholder="Token Amount" value="{{ $bookingData->total_amount ?? '' }}" />
                                        
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group token amount-->
                                <!--begin::Input group advance amount-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Advance Amount</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" step="any" name="advance_amount" class="form-control form-control-lg form-control-solid" placeholder="Advance Amount" value="{{ $bookingData->total_amount ?? '' }}" />
                                        
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group advance amount-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary" id="kt_new_booking_submit">Save Changes</button>
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
    <!--begin::Footer-->
    <div id="kt_app_footer" class="app-footer">
        <!--begin::Footer container-->
        <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted fw-semibold me-1">2023&copy;</span>
                <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Menu-->
            <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                <li class="menu-item">
                    <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
                </li>
                <li class="menu-item">
                    <a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
                </li>
                <li class="menu-item">
                    <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
                </li>
            </ul>
            <!--end::Menu-->
        </div>
        <!--end::Footer container-->
    </div>
    <!--end::Footer-->
</div>
@endsection
@push('scripts')
    <script src="{{ URL::asset('assets/js/custom/account/settings/add-booking.js') }}"></script>
@endpush