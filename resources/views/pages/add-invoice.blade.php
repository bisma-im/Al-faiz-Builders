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
                                @endif
                                <input type="hidden" id="date_and_time" name="date_and_time" value="{{ $invoiceData->formattedDateTime ?? '' }}"/>
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
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Customer</span>
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
                                        <select name="customer_id" aria-label="Select Customer" class="form-select form-select-solid form-select-lg fw-semibold" data-control="select2" data-placeholder="Select customer...">
                                            <option value="">Select Customer...</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ (isset($invoiceData) && $invoiceData->customer_id == $customer->id) ? 'selected' : '' }}>
                                                    {{ $customer->name }} (CNIC {{ $customer->cnic_number }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>    
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
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
                                                <option value="{{ $project->id }}" {{ (isset($invoiceData) && $invoiceData->project_id == $project->id) ? 'selected' : '' }}>
                                                    {{ $project->project_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>    
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
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
                                        <select name="plot_id" id="plotDropdown" aria-label="Select Plot Number" class="form-select form-select-solid form-select-lg fw-semibold" data-control="select2">
                                        </select>
                                    </div>    
                                </div>
                                <!--end::Input group-->
                                
                                <!--begin::Input group-->
									<div class="row mb-6">
										<label for="kt_ecommerce_add_invoice_datepicker" class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required">Invoice date and time</span>
                                        </label>
                                        
                                        <div class="col-lg-8 fv-row">
                                            <input class="form-control" name="invoice_date_time" id="kt_ecommerce_add_invoice_datepicker" class="form-control form-control-lg form-control-solid" placeholder="Pick date & time"/>
                                            
                                        </div>
                                    </div>
								<!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Created By</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="created_by" class="form-control form-control-lg form-control-solid" placeholder="Created By" value="{{ $invoiceData->created_by ?? '' }}" />
                                        
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Description</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="description" class="form-control form-control-lg form-control-solid" placeholder="Description" value="{{ $invoiceData->description ?? '' }}" />
                                        
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Total Amount</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" step="any" name="total_amount" class="form-control form-control-lg form-control-solid" placeholder="Total Amount" value="{{ $invoiceData->total_amount ?? '' }}" />
                                        
                                    </div>
                                    <!--end::Col-->
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
@endpush