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
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Lead Settings</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Lead</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    @if($isViewMode)
                        <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_log">Add Log</a>
                    @endif
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
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
                            <h3 class="fw-bold m-0">Lead Details</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_leads_form" class="form" data-kt-redirect="/leads" action="{{ route('addLead') }}" method="POST">
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                @if (isset($leadData) && $leadData->id)
                                    <input type="hidden" id="id" name="id" value="{{ $leadData->id }}">
                                @endif
                                <input type="hidden" id="session_username" name="session_username" value="{{ session('username') }}">
                                <!--begin::Input group Name-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Name</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Name" value="{{ $leadData->name ?? '' }}" {{ $isViewMode ? 'readonly' : '' }} />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Mobile Number 1-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Mobile Number 1</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
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
                                        <input type="text" name="mobile_no_1" class="form-control form-control-lg form-control-solid" placeholder="Mobile number 1" value="{{ $leadData->mobile_number_1 ?? '' }}" {{ $isViewMode ? 'readonly' : '' }}/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Mobile Number 2-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Mobile Number 2</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="mobile_no_2" class="form-control form-control-lg form-control-solid" placeholder="Mobile Number 2" value="{{ $leadData->mobile_no_2 ?? '' }}" {{ $isViewMode ? 'readonly' : '' }}/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Landline Number 1-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Landline Number 1</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="landline_no_1" class="form-control form-control-lg form-control-solid" placeholder="Landline Number 1" value="{{ $leadData->landline_no_1 ?? '' }}" {{ $isViewMode ? 'readonly' : '' }}/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Landline Number 2-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Landline Number 2</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="landline_no_2" class="form-control form-control-lg form-control-solid" placeholder="Landline Number 2" value="{{ $leadData->landline_no_2 ?? '' }}" {{ $isViewMode ? 'readonly' : '' }}/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Email</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="{{ $leadData->email ?? '' }}" {{ $isViewMode ? 'readonly' : '' }}/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Source of Information</span>
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
                                        <select name="source_of_information" aria-label="Select a Source of Information" class="form-select form-select-solid form-select-lg fw-semibold" data-control="select2" data-placeholder="Select a Source of Information..." {{ $isViewMode ? 'disabled' : '' }}>
                                            <option value="">Select a Source of Information...</option>
                                            <option value="brochure" {{ (isset($leadData) && $leadData->source_of_information === 'brochure') ? 'selected' : '' }}>Brochure</option>
                                            <option value="pamphlet" {{ (isset($leadData) && $leadData->source_of_information === 'pamphlet') ? 'selected' : '' }}>Pamphlet</option>
                                            <option value="word_of_mouth" {{ (isset($leadData) && $leadData->source_of_information === 'word_of_mouth') ? 'selected' : '' }}>Word of Mouth</option>
                                            <option value="tv" {{ (isset($leadData) && $leadData->source_of_information === 'tv') ? 'selected' : '' }}>TV</option>
                                            <option value="internet" {{ (isset($leadData) && $leadData->source_of_information === 'internet') ? 'selected' : '' }}>Internet</option>
                                            <option value="phone_call" {{ (isset($leadData) && $leadData->source_of_information === 'phone_call') ? 'selected' : '' }}>Phone Call</option>
                                        </select>
                                    </div>                                 
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Full Name-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Details</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="details" class="form-control form-control-lg form-control-solid" placeholder="Details" value="{{ $leadData->details ?? '' }}" {{ $isViewMode ? 'readonly' : '' }}/>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                <button type="submit" class="btn btn-primary" id="kt_leads_submit">Save Changes</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
                @if($isViewMode)
                <!--begin::Call Logs Table-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Call Logs</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-6">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Users" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--begin::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                        <!--begin::Filter-->
                                        <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-duotone ki-filter fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>Filter</button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                                            <!--begin::Header-->
                                            <div class="px-7 py-5">
                                                <div class="fs-4 text-dark fw-bold">Filter Options</div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Separator-->
                                            <div class="separator border-gray-200"></div>
                                            <!--end::Separator-->
                                            <!--begin::Content-->
                                            <div class="px-7 py-5">
                                                <!--begin::Input group-->
                                                <div class="mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-5 fw-semibold mb-3">Month:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
                                                        <option></option>
                                                        <option value="aug">August</option>
                                                        <option value="sep">September</option>
                                                        <option value="oct">October</option>
                                                        <option value="nov">November</option>
                                                        <option value="dec">December</option>
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-5 fw-semibold mb-3">Payment Type:</label>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <div class="d-flex flex-column flex-wrap fw-semibold" data-kt-customer-table-filter="payment_type">
                                                        <!--begin::Option-->
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                            <input class="form-check-input" type="radio" name="payment_type" value="all" checked="checked" />
                                                            <span class="form-check-label text-gray-600">All</span>
                                                        </label>
                                                        <!--end::Option-->
                                                        <!--begin::Option-->
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                            <input class="form-check-input" type="radio" name="payment_type" value="visa" />
                                                            <span class="form-check-label text-gray-600">Visa</span>
                                                        </label>
                                                        <!--end::Option-->
                                                        <!--begin::Option-->
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                                            <input class="form-check-input" type="radio" name="payment_type" value="mastercard" />
                                                            <span class="form-check-label text-gray-600">Mastercard</span>
                                                        </label>
                                                        <!--end::Option-->
                                                        <!--begin::Option-->
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" name="payment_type" value="american_express" />
                                                            <span class="form-check-label text-gray-600">American Express</span>
                                                        </label>
                                                        <!--end::Option-->
                                                    </div>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Actions-->
                                                <div class="d-flex justify-content-end">
                                                    <button type="reset" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset</button>
                                                    <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">Apply</button>
                                                </div>
                                                <!--end::Actions-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Menu 1-->
                                        <!--end::Filter-->
                                        <!--begin::Export-->
                                        <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_customers_export_modal">
                                        <i class="ki-duotone ki-exit-up fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>Export</button>
                                        <!--end::Export-->
                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Group actions-->
                                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                                        <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
                                        <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
                                    </div>
                                    <!--end::Group actions-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_users_table">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_users_table .form-check-input" value="1" />
                                                </div>
                                            </th>
                                            <th class="min-w-125px">Date of Call</th>
                                            <th class="min-w-125px">Time of Call</th>
                                            <th class="min-w-125px">Customer Response</th>
                                            <th class="min-w-125px">Next Date of Call</th>
                                            <th class="min-w-125px">Next Time of Call</th>
                                            <th class="text-end min-w-70px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach ($callLogData as $id => $callLog)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary mb-1">{{ $callLog->date_of_call }}</a>
                                            </td>
                                            <td>{{ $callLog->time_of_call }}</td>
                                            <td>{{ $callLog->customer_response }}</td>
                                            {{-- <td data-filter="mastercard"> --}}
                                            <td>{{ $callLog->next_call_date }}</td>
                                            <td>{{ $callLog->next_call_time }}</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">View</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                        <!--begin::Modal - Adjust Balance-->
                        <div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bold">Export Customers</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div id="kt_customers_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                            <i class="ki-duotone ki-cross fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::Modal header-->
                                    <!--begin::Modal body-->
                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                        <!--begin::Form-->
                                        <form id="kt_customers_export_form" class="form" action="#">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10">
                                                <!--begin::Label-->
                                                <label class="fs-5 fw-semibold form-label mb-5">Select Export Format:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select data-control="select2" data-placeholder="Select a format" data-hide-search="true" name="format" class="form-select form-select-solid">
                                                    <option value="excell">Excel</option>
                                                    <option value="pdf">PDF</option>
                                                    <option value="cvs">CVS</option>
                                                    <option value="zip">ZIP</option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10">
                                                <!--begin::Label-->
                                                <label class="fs-5 fw-semibold form-label mb-5">Select Date Range:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder="Pick a date" name="date" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Row-->
                                            <div class="row fv-row mb-15">
                                                <!--begin::Label-->
                                                <label class="fs-5 fw-semibold form-label mb-5">Payment Type:</label>
                                                <!--end::Label-->
                                                <!--begin::Radio group-->
                                                <div class="d-flex flex-column">
                                                    <!--begin::Radio button-->
                                                    <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                        <input class="form-check-input" type="checkbox" value="1" checked="checked" name="payment_type" />
                                                        <span class="form-check-label text-gray-600 fw-semibold">All</span>
                                                    </label>
                                                    <!--end::Radio button-->
                                                    <!--begin::Radio button-->
                                                    <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" name="payment_type" />
                                                        <span class="form-check-label text-gray-600 fw-semibold">Visa</span>
                                                    </label>
                                                    <!--end::Radio button-->
                                                    <!--begin::Radio button-->
                                                    <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                        <input class="form-check-input" type="checkbox" value="3" name="payment_type" />
                                                        <span class="form-check-label text-gray-600 fw-semibold">Mastercard</span>
                                                    </label>
                                                    <!--end::Radio button-->
                                                    <!--begin::Radio button-->
                                                    <label class="form-check form-check-custom form-check-sm form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="4" name="payment_type" />
                                                        <span class="form-check-label text-gray-600 fw-semibold">American Express</span>
                                                    </label>
                                                    <!--end::Radio button-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Actions-->
                                            <div class="text-center">
                                                <button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">Discard</button>
                                                <button type="submit" id="kt_customers_export_submit" class="btn btn-primary">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                            </div>
                            <!--end::Modal dialog-->
                        </div>
                        <!--end::Modal - New Card-->
                        <!--end::Modals-->
                    </div>
                    
                    <!--end::Content-->
                </div>
                <!--end::Call Logs Table-->
                @endif
                <!--begin::Delete Account-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Delete Lead</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_deactivate" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_deactivate_form" class="form" data-kt-redirect="/leads">
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Notice-->
                                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">You Are Deleting a Lead</h4>
                                            <div class="fs-6 text-gray-700">This action can not be undone.
                                            <br />
                                            <a class="fw-bold" href="#">Learn more</a></div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--begin::Form input row-->
                                <div class="form-check form-check-solid fv-row">
                                    <input name="deactivate" class="form-check-input" type="checkbox" value="" id="deactivate" />
                                    <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate">I confirm to delete this lead</label>
                                </div>
                                <!--end::Form input row-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button id="kt_account_deactivate_account_submit" type="submit" class="btn btn-danger fw-semibold">Delete lead</button>
                            </div>
                            <!--end::Card footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Deactivate Account-->
                <!--begin::Modal - Log - Add-->
				<div class="modal fade" id="kt_modal_add_log" tabindex="-1" aria-hidden="true">
					<!--begin::Modal dialog-->
					<div class="modal-dialog modal-dialog-centered mw-650px">
						<!--begin::Modal content-->
						<div class="modal-content">
							<!--begin::Form-->
							<form class="form" action="#" id="kt_modal_add_log_form" data-kt-redirect="">
                            {{-- <form class="form" action="#" id="kt_modal_add_log_form" data-kt-redirect="{{ route('viewLead', ['id' => $leadData->id]) }}"> --}}

								<!--begin::Modal header-->
								<div class="modal-header" id="kt_modal_add_customer_header">
									<!--begin::Modal title-->
									<h2 class="fw-bold">Add a Call Log</h2>
									<!--end::Modal title-->
									<!--begin::Close-->
									<div id="kt_modal_add_log_close" class="btn btn-icon btn-sm btn-active-icon-primary">
										<i class="ki-duotone ki-cross fs-1">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</div>
									<!--end::Close-->
								</div>
								<!--end::Modal header-->
								<!--begin::Modal body-->
								<div class="modal-body py-10 px-lg-17">
									<!--begin::Scroll-->
									<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                        <!--begin::Input-->
                                        <!--begin::Input group-->
										<div class="fv-row mb-7">
											<label for="kt_ecommerce_add_call_log_datepicker" class="form-label">Select call date and time</label>
                                            <input class="form-control" name="call_date_time" id="kt_ecommerce_add_call_log_datepicker" placeholder="Pick date & time" />
										</div>
										<!--end::Input group-->
										<!--begin::Input group-->
										<div class="fv-row mb-15">
										    <!--begin::Label-->
											<label class="fs-6 fw-semibold mb-2">Customer Response</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" class="form-control form-control-solid" placeholder="" name="customer_response" />
											<!--end::Input-->
										</div>
										<!--end::Input group-->
                                        <!--begin::Input group for Next Call Date Time-->
                                        <div class="fv-row mb-7">
                                            <label for="kt_ecommerce_add_next_call_log_datepicker" class="form-label">Select next call date and time</label>
                                            <input class="form-control" name="next_call_date_time" id="kt_ecommerce_add_next_call_log_datepicker" placeholder="Pick date & time" />
                                        </div>
                                        <!--end::Input group-->
									</div>
									<!--end::Scroll-->
								</div>
								<!--end::Modal body-->
								<!--begin::Modal footer-->
								<div class="modal-footer flex-center">
									<!--begin::Button-->
									<button type="reset" id="kt_modal_add_log_cancel" class="btn btn-light me-3">Discard</button>
									<!--end::Button-->
									<!--begin::Button-->
									<button type="submit" id="kt_modal_add_log_submit" class="btn btn-primary">
										<span class="indicator-label">Submit</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
									<!--end::Button-->
								</div>
								<!--end::Modal footer-->
							</form>
							<!--end::Form-->
						</div>
					</div>
				</div>
				<!--end::Modal - Log - Add-->
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
        <!--begin::Vendors Javascript(used for this page only)-->
		<script src="{{ URL::asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="{{ URL::asset('assets/js/custom/account/settings/save-lead.js') }}"></script>
		<script src="{{ URL::asset('assets/js/custom/account/settings/delete-lead.js') }}"></script>
        <script src="{{ URL::asset('assets/js/custom/account/settings/add-call-log.js') }}"></script>
        @if ($isViewMode)
            <script src="{{ URL::asset('assets/js/custom/apps/customers/list/export.js') }}"></script>
            <script src="{{ URL::asset('assets/js/custom/apps/customers/list/list.js') }}"></script>
        @endif
		<script src="{{ URL::asset('assets/js/widgets.bundle.js') }}"></script>
		<script src="{{ URL::asset('assets/js/custom/widgets.js') }}"></script>
		<!--end::Custom Javascript-->
@endpush