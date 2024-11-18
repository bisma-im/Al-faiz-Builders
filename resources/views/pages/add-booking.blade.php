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
                @if (isset($bookingData) && $isCancelled)
                {{-- <h3 class="fw-bold m-0">{{ 'Booking No. ' . $bookingData->id . ' - CANCELLED' }}</h3> --}}
                <!--begin::Notice-->
                <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed m-0 p-6">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-information fs-2tx text-danger me-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">{{'This booking of plot no. ' . $bookingData->plot_no . '
                                is cancelled.'}}</h4>
                            <div class="fs-6 text-gray-700">This record has been blocked permanently and can not be
                                edited.</div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
                @else
                <h3 class="fw-bold m-0">Generate New Booking</h3>
                @endif

                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_new_account" class="collapse show">
                    @if (isset($bookingData))
                    <input type="hidden" id="id" name="id" value="{{ $bookingData->id }}">
                    <input type="hidden" id="customer_id" name="customer_id" value="{{ $bookingData->customer_id }}">
                    @endif
                    <input type="hidden" id="isLocked" name="isLocked" value="{{ $isLockedMode ? 'true' : 'false' }}">
                    <!--begin::Form-->
                    <form id="kt_new_booking_form" class="form" data-kt-redirect="{{ route('showActiveBookings') }}"
                        action="{{ route('addBooking') }}" method="POST">
                        @csrf
                        <!--begin::Card body-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::Input group-->
                            <div id="bookingForm" data-selected-plot="{{ $bookingData->plot_id ?? '' }}"
                                data-selected-phase="{{ $bookingData->phase_id ?? '' }}">
                                <!-- Your form content -->
                            </div>
                            <!--end::Input group-->
                            <!--booking date-->
                            <div class="d-flex flex-column gap-7 gap-lg-10 ">
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Booking Date</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group Project-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                                <span class="required">Booking Date (Only for old projects)</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-9 fv-row">
                                                <input name="booking_date" id="kt_ecommerce_booking_datepicker"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Pick date & time" />
                                                <input type="hidden" id="fetchedBookingDate"
                                                    value="{{ $bookingData->created_on ?? '' }}" />
                                            </div>
                                        </div>
                                        <!--end::Input group Project-->
                                    </div>
                                </div>
                            </div>
                            <!--begin::Plot Details Card-->
                            <div class="d-flex flex-column gap-7 gap-lg-10 ">
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>General</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group Project-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                                <span class="required">Plot Details</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Select the appropriate role">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-3 fv-row">
                                                <select name="project_id" id="projectDropdown"
                                                    aria-label="Select Project"
                                                    class="form-select form-select-solid form-select-lg fw-semibold"
                                                    data-control="select2" data-placeholder="Select project...">
                                                    <option value="" selected disabled>Select Project...</option>
                                                    @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}" {{ (isset($bookingData) &&
                                                        $bookingData->project_id == $project->id) ? 'selected' : '' }}>
                                                        {{ $project->project_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-3 fv-row">
                                                @if ($isLockedMode)
                                                <select name="selectedPhase" id="selectedPhase"
                                                    aria-label="Select Phase"
                                                    class="form-select form-select-solid form-select-lg fw-semibold"
                                                    data-placeholder="Select phase.." data-control="select2">
                                                    <option value="{{ $bookingData->phase_id }}" selected>
                                                        {{ $bookingData->phase_title }}
                                                    </option>
                                                </select>
                                                @else
                                                <select name="phase_id" id="phaseDropdown" aria-label="Select Phase"
                                                    class="form-select form-select-solid form-select-lg fw-semibold"
                                                    data-placeholder="Select phase.." data-control="select2">
                                                    <option value="" selected disabled>Select phase...</option>
                                                </select>
                                                @endif
                                            </div>
                                            <div class="col-lg-3 fv-row">
                                                @if ($isLockedMode)
                                                <select name="selectedPlot" id="selectedPlot"
                                                    class="form-select form-select-solid form-select-lg fw-semibold"
                                                    data-placeholder="Select plot number.." data-control="select2">
                                                    <option value="{{ $bookingData->plot_id }}" selected>
                                                        {{ $bookingData->plot_no . ' (' . $bookingData->category . ')' }}
                                                    </option>
                                                </select>
                                                @else
                                                <select name="plot_id" id="plotDropdown" aria-label="Select Plot Number"
                                                    class="form-select form-select-solid form-select-lg fw-semibold"
                                                    data-placeholder="Select plot number.." data-control="select2">
                                                    <option value="" selected disabled>Select plot...</option>
                                                </select>
                                                @endif
                                            </div>
                                        </div>
                                        <!--begin::Input group Project-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                                <span class="required">Registration Number</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Select the appropriate role">
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
                                                <input type="text" id="file_reg_number" name="file_reg_number"
                                                    class="form-control form-control-lg form-control-solid"
                                                    value="{{ $bookingData->file_reg_number ?? '' }}"
                                                    placeholder="Registration Number" />
                                            </div>
                                        </div>
                                        <!--end::Input group Project-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Plot Details Card-->
                            <!--begin::Customer Details Card-->
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Customer</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group customer exists check-->
                                        @if (!$isLockedMode)
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Customer
                                                Already Exists?</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-1 fv-row">
                                                <input class="form-check-input" type="radio" name="customer_exists"
                                                    value="yes" id="customer_exists_yes">
                                                <label class="fs-6 text-gray-800" for="customer_exists_yes">Yes</label>
                                            </div>
                                            <div class="col-lg-1 fv-row">
                                                <input class="form-check-input" type="radio" name="customer_exists"
                                                    value="no" id="customer_exists_no">
                                                <label class="form-check-label fs-6 text-gray-800"
                                                    for="customer_exists_no">No</label>
                                            </div>
                                            <div class="col-lg-3 fv-row" style="display: none;"
                                                id="customerExistsCheck">
                                                <input type="hidden" id="customer_id_dropdown">
                                                <input type="hidden" name="existing_customer_image"
                                                    id="existing_customer_image">
                                                <input type="hidden" name="existing_cnic_image"
                                                    id="existing_cnic_image">
                                                <input type="hidden" name="existing_nok_cnic_image"
                                                    id="existing_nok_cnic_image">
                                                <input type="hidden" name="existing_thumb_impression"
                                                    id="existing_thumb_impression">
                                                <select name="customer_id_dropdown" id="customerDropdown"
                                                    aria-label="Select Customer"
                                                    class="form-select form-select-solid form-select-lg fw-semibold"
                                                    data-control="select2" data-placeholder="Select customer...">
                                                    <option value="">Select Customer...</option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ (isset($bookingData) &&
                                                        $bookingData->customer_id == $customer->id) ? 'selected' : ''
                                                        }}>
                                                        {{ $customer->name . ' (' . $customer->cnic_number . ')' }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        @endif
                                        <!--end::Input group customer exists check-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Customer
                                                Image</label>
                                            <!--end::Label-->
                                            <div class="col-lg-8 fv-row">
                                                <!--begin::Image input-->
                                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                                    style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-125px h-125px"
                                                        style="background-image: url({{ isset($bookingData->customer_image) ? URL::asset('images/customer-images/'.$bookingData->customer_image) : URL::asset('assets/media/svg/avatars/blank.svg') }})">
                                                    </div>
                                                    <!--end::Preview existing avatar-->
                                                    <!--begin::Label-->
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change avatar">
                                                        <i class="ki-duotone ki-pencil fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" id="avatar" name="avatar"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Cancel-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="ki-duotone ki-cross fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <!--end::Cancel-->
                                                    <!--begin::Remove-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="ki-duotone ki-cross fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                            </div>
                                            <!--end::Image input-->
                                            <!--begin::Hint-->
                                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                            <!--end::Hint-->
                                        </div>
                                        <!--begin::Input group customer cnic image-->
                                        <div class="row mb-6">
                                            <label
                                                class="col-lg-3 col-form-label required fw-semibold fs-6">CNIC</label>
                                            <div class="custom-file col-lg-9 fv-row">
                                                <input type="file" name="cnic_image"
                                                    class="form-control form-control-lg form-control-solid custom-file-input"
                                                    id="cnic_image">
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">CNIC
                                                Preview</label>
                                            <div class="custom-file col-lg-9 fv-row">
                                                <a href="{{ isset($bookingData) && $bookingData->customer_cnic_image ? URL::asset('images/customer/customer-cnic/' . $bookingData->customer_cnic_image) : '' }}"
                                                    target="_blank">
                                                    <img id="customer_cnic_preview"
                                                        src="{{ isset($bookingData) && $bookingData->customer_cnic_image ? URL::asset('images/customer/customer-cnic/' . $bookingData->customer_cnic_image) : '' }}"
                                                        alt="CNIC Customer" style="max-width: 300px; margin-top: 10px;">
                                                </a>
                                            </div>
                                        </div>
                                        <!--end::Input group customer cnic image-->
                                        <!--begin::Input group customer Thumb Impression-->
                                        <div class="row mb-6">
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Thumb
                                                Impression</label>
                                            <div class="custom-file col-lg-9 fv-row">
                                                <input type="file" name="thumb_impression"
                                                    class="form-control form-control-lg form-control-solid custom-file-input"
                                                    id="thumb_impression">
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Thumb
                                                Impression Preview</label>
                                            <div class="custom-file col-lg-9 fv-row">
                                                <a href="{{ isset($bookingData) && $bookingData->thumb_impression ? URL::asset('images/customer/thumb-impression/' . $bookingData->thumb_impression) : '' }}"
                                                    target="_blank">
                                                    <img id="thumb_impression_preview"
                                                        src="{{ isset($bookingData) && $bookingData->thumb_impression ? URL::asset('images/customer/thumb-impression/' . $bookingData->thumb_impression) : '' }}"
                                                        alt="Thumb Impression"
                                                        style="max-width: 300px; margin-top: 10px;">
                                                </a>
                                            </div>
                                        </div>
                                        <!--end::Input group customer Thumb Impression-->
                                        <!--begin::Input group customer name-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Customer
                                                Details</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-3 fv-row">
                                                <input type="text" id="customer_name" name="customer_name"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Customer Name"
                                                    value="{{ $bookingData->name ?? '' }}" />
                                            </div>
                                            <!--end::Col-->
                                            <div class="col-lg-3 fv-row">
                                                <input type="text" id="customer_cnic" name="customer_cnic"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Customer CNIC"
                                                    value="{{ $bookingData->cnic_number ?? '' }}" />
                                            </div>
                                            <div class="col-lg-3 fv-row">
                                                <input type="text" id="mobile_no" name="mobile_no"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Contact Number"
                                                    value="{{ $bookingData->mobile_number_1 ?? '' }}" />
                                            </div>
                                        </div>
                                        <!--end::Input group customer name-->
                                        <!--begin::Input group customer address-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Customer
                                                Address</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-9 fv-row">
                                                <input type="text" id="customer_address" name="customer_address"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Customer Address"
                                                    value="{{ $bookingData->address ?? '' }}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group customer address-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Customer Details Card-->
                            <!--begin::Next of Kin Details Card-->
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Next of Kin</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Personal
                                                Information</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-3 fv-row">
                                                <input type="text" id="nok_relation" name="nok_relation"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Relation"
                                                    value="{{ $bookingData->next_of_kin_relation ?? '' }}" />
                                            </div>
                                            <div class="col-lg-3 fv-row">
                                                <input type="text" id="nok_name" name="nok_name"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Name"
                                                    value="{{ $bookingData->next_of_kin_name ?? '' }}" />
                                            </div>
                                            <div class="col-lg-3 fv-row">
                                                <input type="text" id="nok_cnic" name="nok_cnic"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="CNIC"
                                                    value="{{ $bookingData->next_of_kin_cnic ?? '' }}" />
                                            </div>

                                            <!--end::Col-->
                                        </div>
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Contact
                                                Details</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-3 fv-row">
                                                <input type="text" id="nok_mobile_no" name="nok_mobile_no"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Mobile Number"
                                                    value="{{ $bookingData->next_of_kin_mobile_number_1 ?? '' }}" />
                                            </div>
                                            <div class="col-lg-3 fv-row">
                                                <input type="text" id="nok_address" name="nok_address"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Address"
                                                    value="{{ $bookingData->next_of_kin_address ?? '' }}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--begin::Input group customer cnic image-->
                                        <div class="row mb-6">
                                            <label
                                                class="col-lg-3 col-form-label required fw-semibold fs-6">CNIC</label>
                                            <div class="custom-file col-lg-9 fv-row">
                                                <input type="file" name="nok_cnic_image"
                                                    class="form-control form-control-lg form-control-solid custom-file-input"
                                                    id="nok_cnic_image">
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">CNIC
                                                Preview</label>
                                            <div class="custom-file col-lg-9 fv-row">
                                                <a href="{{ isset($bookingData) && $bookingData->nok_cnic_image ? URL::asset('images/customer/nok-cnic/' . $bookingData->nok_cnic_image) : '' }}"
                                                    target="_blank">
                                                    <img id="nok_cnic_preview"
                                                        src="{{ isset($bookingData) && $bookingData->nok_cnic_image ? URL::asset('images/customer/nok-cnic/' . $bookingData->nok_cnic_image) : '' }}"
                                                        alt="CNIC NOK"
                                                        style="max-width: 300px; max-height:300px; margin-top: 10px; padding:5px">
                                                </a>
                                            </div>
                                        </div>
                                        <!--end::Input group customer cnic image-->
                                    </div>
                                </div>
                            </div>
                            <!--begin::Payment Details Card-->
                            <!--begin::Card body-->
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Booking Media</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-2">
                                            <!--begin::Dropzone-->
                                            <div class="dropzone" id="kt_ecommerce_add_booking_media">
                                                <!--begin::Message-->
                                                <div class="dz-message needsclick">
                                                    <!--begin::Icon-->
                                                    <i class="ki-duotone ki-file-up text-primary fs-3x">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    <!--end::Icon-->
                                                    <!--begin::Info-->
                                                    <div class="ms-4">
                                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or
                                                            click to upload.</h3>
                                                        <span class="fs-7 fw-semibold text-gray-400">Upload up to 10
                                                            files</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                            </div>
                                            <!--end::Dropzone-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Description-->
                                        <div class="text-muted fs-7">Set the project media gallery.</div>
                                        <!--end::Description-->
                                    </div>
                                    @if (isset($bookingMedia))
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Download Booking Media</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="fv-row mb-2">
                                                @foreach ($bookingMedia as $media)
                                                <a href="{{ route('downloadBookingMedia', $media->media_name) }}"
                                                    class="text-gray-800 text-hover-primary d-flex flex-column">
                                                    <span class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        {{ $media->media_name }} <i class="fas fa-download ms-2"></i>
                                                    </span>
                                                </a>
                                                @endforeach
                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!--end::Card header-->
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Payment Details</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group base unit cost-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Base Unit
                                                Cost</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-9 fv-row">
                                                <input type="number" step="any" id="unit_cost" name="unit_cost"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Base Unit Cost"
                                                    value="{{ $bookingData->unit_cost ?? '' }}" />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group base unit cost-->
                                        <!--begin::Input group extra charges-->
                                        {{-- <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label
                                                class="col-lg-3 col-form-label required fw-semibold fs-6">Charges</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-3 fv-row">
                                                <input type="number" step="any" id="extra_charges" name="extra_charges"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Extra Charges"
                                                    value="{{ $bookingData->extra_charges ?? '' }}" />
                                            </div>
                                            <!--end::Col-->
                                            <div class="col-lg-3 fv-row">
                                                <input type="number" step="any" id="development_charges"
                                                    name="development_charges"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Development Charges"
                                                    value="{{ $bookingData->development_charges ?? '' }}" />
                                            </div>
                                        </div> --}}
                                        <!--end::Input group extra charges-->
                                        <!--begin::Input group per month installment-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Total
                                                Amount</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-9 fv-row">
                                                <input type="number" step="any" name="total_amount" id="total_amount"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Total Amount"
                                                    value="{{ $bookingData->total_amount ?? '' }}" />

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group per month installment-->
                                        <!--begin::Input group token amount-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Token
                                                Amount</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-9 fv-row">
                                                <input type="number" step="any" id="token_amount" name="token_amount"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Token Amount"
                                                    value="{{ $bookingData->token_amount ?? '' }}" />

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group token amount-->
                                        <!--begin::Input group advance amount-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Advance
                                                Amount</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-9 fv-row">
                                                <input type="number" step="any" id="advance_amount"
                                                    name="advance_amount"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Advance Amount"
                                                    value="{{ $bookingData->advance_amount ?? '' }}" />

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group advance amount-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Remaining
                                                Amount</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-9 fv-row">
                                                <input type="number" step="any" name="remaining_amount"
                                                    id="remaining_amount"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Remaining Amount" disabled />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                                <span class="required">Payment Plan</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Select the appropriate role">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-3 fv-row">
                                                <select name="payment_plan" id="paymentPlan"
                                                    aria-label="Select Payment Plan"
                                                    class="form-select form-select-solid form-select-lg fw-semibold"
                                                    data-control="select2" data-placeholder="Select Payment Plan...">
                                                    <option value="">Select Payment Plan...</option>
                                                    <option value="full_cash" {{ (isset($bookingData) && $bookingData->
                                                        payment_plan == 'full_cash') ? 'selected' : '' }}>Full Cash
                                                    </option>
                                                    <option value="installment" {{ (isset($bookingData) &&
                                                        $bookingData->payment_plan == 'installment') ? 'selected' : ''
                                                        }}>Installment</option>
                                                    <option value="part_payment" {{ (isset($bookingData) &&
                                                        $bookingData->payment_plan == 'part_payment') ? 'selected' : ''
                                                        }}>Part Payment</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 fv-row" style="display: none;" id="partPaymentInput">
                                                <input type="number" id="part_payment_amount" name="part_payment_amount"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Part Paid Amount" value="" />
                                            </div>
                                            <!--end::Col for Number of Installments Input-->
                                        </div>
                                        <div class="row mb-6" id="discountPlan" style="display: none;">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                                <span class="required">Discount Plan</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Select the appropriate role">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-3 fv-row" style="display: none;" id="discountType">
                                                <select name="discount_type" id="discount_type"
                                                    aria-label="Select Discount Type"
                                                    class="form-select form-select-solid form-select-lg fw-semibold"
                                                    data-control="select2" data-placeholder="Select discount type...">
                                                    <option value="">Select Discount Type...</option>
                                                    {{-- <option value="discount_amount" {{ (isset($bookingData) &&
                                                        $bookingData->payment_plan == 'full_cash') ? 'selected' : ''
                                                        }}>Full Cash</option>
                                                    <option value="discount_percentage" {{ (isset($bookingData) &&
                                                        $bookingData->payment_plan == 'installment') ? 'selected' : ''
                                                        }}>Installment</option> --}}
                                                    <option value="discount_amount">Discount Amount</option>
                                                    <option value="discount_percentage">Discount Percentage</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 fv-row" id="discountAmount" style="display: none;">
                                                <input type="number" id="discount_amount" name="discount_amount"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Discount Amount" value="" />
                                            </div>
                                            <div class="col-lg-3 fv-row" id="discountPercentage" style="display: none;">
                                                <input type="number" id="discount_percentage" name="discount_percentage"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Discount Percentage" value="" />
                                            </div>
                                            <div class="col-lg-3 fv-row">
                                                <input type="number" id="pending_amount" name="pending_amount"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Pending Amount" value="" readonly />
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <div class="row mb-6" style="display: none;" id="installments">
                                            <!--begin::Label-->
                                            <label class="col-lg-3 col-form-label fw-semibold fs-6">
                                                <span class="required">Installments</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Select the appropriate role">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-3 fv-row" style="display: none;"
                                                id="numOfInstallmentsInput">
                                                <input type="number" id="num_of_installments" name="num_of_installments"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Number of Installment"
                                                    value="{{ $bookingData->number_of_installments ?? '' }}" />
                                            </div>
                                            <!--end::Col for Number of Installments Input-->
                                            <!--begin::Col for Installment Amount Input-->
                                            <div class="col-lg-3 fv-row" style="display: none;"
                                                id="installmentAmountInput">
                                                <input type="number" step="any" name="installment_amount"
                                                    id="installment_amount"
                                                    class="form-control form-control-lg form-control-solid"
                                                    placeholder="Installment Amount"
                                                    value="{{ $bookingData->installment_amount ?? '' }}" readonly />
                                            </div>
                                            <!--begin::Col-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Payment Details Card-->
                            <!--begin::Dev Charges Details Card-->
                            @if ($isLockedMode)
                            <input type="hidden" name="development_charges" id="development_charges" value="{{ $bookingData->development_charges }}"/>
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4" id="devChargesCard" style="display: none;">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Development/Extra Charges</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!-- Installment Table -->
                                        <table id="devChargesTable"
                                            class="table align-middle table-row-dashed fs-6 gy-5">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 ">
                                                    <th class="min-w-125px">S.No</th>
                                                    <th class="min-w-125px">Amount</th>
                                                    <th class="min-w-125px">Due Date</th>
                                                    <th class="min-w-125px">Intimation Date</th>
                                                    <th class="min-w-125px">Payment Date</th>
                                                    <th class="min-w-125px">Payment Status</th>
                                                    <th class="text-end min-w-125px">Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @forelse ($devCharges as $index => $devCharge)
                                                <tr>
                                                    <input type="hidden" name="dev_installment_ids[]" value="{{ $devCharge->id }}" />
                                                    {{-- <input type="hidden" name="dev_installment_ids[]" value="1"> --}}
                                                    <td>
                                                        {{ $index + 1 }}
                                                    </td>
                                                    <td>
                                                        <input type="number" name="devAmounts[]" class="form-control editable-devcharge" value="{{ $devCharge->amount }}" data-index={{ $index }} {{ $devCharge->payment_status === 'paid' ? 'readonly' : '' }}>
                                                    </td>
                                                    <td>{{ $devCharge->due_date }}</td>
                                                    <td>{{ $devCharge->intimation_date }}</td>
                                                    <td>
                                                        {{ $devCharge->payment_date }}
                                                        <input type="hidden" name="devPaymentDates[]" value="{{ $devCharge->payment_date }}"/>
                                                    </td>
                                                    <td>
                                                        {{ $devCharge->payment_status }}
                                                        <input type="hidden" name="devStatuses[]" value="{{ $devCharge->payment_status }}"/>
                                                    </td>
                                                    <td class="text-end">
                                                        @if($devCharge->invoice_id && $devCharge->payment_status !== 'cancelled')
                                                            <a class="btn btn-light disabled-link" style="pointer-events: none; opacity: 0.6;">
                                                                Generate Invoice
                                                            </a>
                                                        @else
                                                            <form class="devChargeInvoiceForm" method="POST" style="display: inline;">
                                                                @csrf
                                                                <button type="submit" data-devChargeId = "{{ $devCharge->id ?? '' }}" id="{{'myButton' . $devCharge->id }}" class="btn btn-light generate-invoice-button">
                                                                    Generate Invoice
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No entries found</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                            </div>
                            @endif
                            <!--end::Dev Charges Details Card-->
                            <!--begin::Payment Details Card-->
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4" id="installmentTableCard" style="display: none;">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Installment Table</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!-- Installment Table -->
                                        <table id="installmentTable"
                                            class="table align-middle table-row-dashed fs-6 gy-5">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 ">
                                                    <th class="min-w-125px">S.No</th>
                                                    <th class="min-w-125px">Amount</th>
                                                    <th class="min-w-125px">Due Date</th>
                                                    <th class="min-w-125px">Intimation Date</th>
                                                    <th class="min-w-125px">Payment Date</th>
                                                    <th class="min-w-125px">Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                <!-- Installment rows will be dynamically inserted here -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                            </div>

                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_new_booking_submit">Save
                                Changes</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                    <!--begin::Cancel Booking  Card-->
                    @if ($isLockedMode && !$isCancelled)
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Cancel Booking</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Notice-->
                                <div
                                    class="notice d-flex bg-light-danger rounded border-danger border border-dashed mb-9 p-6">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-information fs-2tx text-danger me-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">You Are Canceling a Booking. Press the
                                                Cancel Booking button to cancel the booking.</h4>
                                            <div class="fs-6 text-gray-700">This action can not be undone.</div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a class="btn btn-danger fw-semibold" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_cancel_booking">Cancel Booking</a>
                            </div>
                            <!--end::Card footer-->
                        </div>
                    </div>
                    @endif
                    <!--end::Cancel Booking Card-->
                </div>
                <!--end::Content-->
                <!--end::Basic info-->
                @if ($isLockedMode)
                <!--begin::Modal - Cancel - Booking-->
                <div class="modal fade" id="kt_modal_cancel_booking" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form id="kt_modal_cancel_booking_form" class="form" data-kt-redirect="/active-bookings"
                                method="POST">
                                @csrf
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_add_customer_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Cancel Booking</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div id="kt_modal_cancel_booking_close"
                                        class="btn btn-icon btn-sm btn-active-icon-primary">
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
                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_customer_scroll"
                                        data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7">
                                            <label for="plot_details" class="form-label">Plot Details</label>
                                            <input class="form-control" name="plot_details" id="plot_details"
                                                value="{{ $bookingData->project_title }} - {{ $bookingData->phase_title }} - {{ $bookingData->plot_no }}"
                                                disabled />
                                        </div>
                                        <!--begin::Input-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <label for="cancelled" class="form-label required">Type CANCELLED in the
                                                below box.</label>
                                            <input class="form-control" name="cancelled" id="cancelled"
                                                placeholder="type CANCELLED in uppercase" />
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2 required">Reason for
                                                Cancellation</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control"
                                                placeholder="Reason for Cancellation" name="reason_for_cancellation"
                                                id="reason_for_cancellation" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group for Next Call Date Time-->
                                        <div class="fv-row mb-7">
                                            <label for="noc" class="form-label">NOC</label>
                                            <input type="file" name="noc"
                                                class="form-control form-control-lg custom-file-input" id="noc">
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="form-label">Documents</label>
                                            <!--begin::Dropzone-->
                                            <div class="dropzone mb-7" id="kt_cancel_booking_media">
                                                <!--begin::Message-->
                                                <div class="dz-message needsclick">
                                                    <!--begin::Icon-->
                                                    <i class="ki-duotone ki-file-up text-primary fs-3x">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                    <!--end::Icon-->
                                                    <!--begin::Info-->
                                                    <div class="ms-4">
                                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or
                                                            click to upload.</h3>
                                                        <span class="fs-7 fw-semibold text-gray-400">Upload up to 10
                                                            files</span>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                            </div>
                                            <!--end::Dropzone-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Form input row-->
                                        <div class="form-check form-check-solid fv-row mb-7">
                                            <input name="cancel_booking_checkbox" class="form-check-input"
                                                type="checkbox" value="" id="cancel_booking_checkbox" />
                                            <label class="form-check-label fw-semibold ps-2 fs-6 required"
                                                for="cancel_booking_checkbox">I confirm to cancel this booking</label>
                                        </div>
                                        <!--end::Form input row-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" id="kt_modal_cancel_booking_cancel"
                                        class="btn btn-light me-3">Discard</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_cancel_booking_submit" class="btn btn-danger">
                                        <span class="indicator-label">Cancel Booking</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
                <!--end::Modal - Cancel - Booking-->
                @endif
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</div>
@endsection
@push('scripts')
<script src="{{ URL::asset('assets/js/custom/account/settings/add-booking.js') }}"></script>
@if ($isLockedMode)
<script src="{{ URL::asset('assets/js/custom/account/settings/cancel-booking.js') }}"></script>
{{-- <script>
    function updateAmount(input, id) {
        const newAmount = parseFloat(input.value);
        let totalRemaining = 0;
        const rows = document.querySelectorAll('#devChargesTable tbody tr');
        let startIndex = 0;
        rows.forEach((row, index) => {
            const currentId = parseFloat(row.querySelector('.generate-invoice-button').dataset.devchargeid);
            if (currentId === id) {
                startIndex = index + 1; // Start adjusting from the next row
            }
            if (index >= startIndex) {
                totalRemaining += parseFloat(row.cells[1].querySelector('input').value);
            }
        });
    
        // Assuming the total amount remains fixed, adjust the following installments
        const remainingInstallments = rows.length - startIndex;
        const averageAdjustment = totalRemaining / remainingInstallments;
    
        for (let i = startIndex; i < rows.length; i++) {
            rows[i].cells[1].querySelector('input').value = averageAdjustment.toFixed(2);
        }
    }
</script> --}}
    
@endif
@endpush