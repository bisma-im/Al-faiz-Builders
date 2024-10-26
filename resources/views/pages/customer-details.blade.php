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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Customer Settings</h1>
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
                        <li class="breadcrumb-item text-muted">Customer</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#"
                            class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Filter</a>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                            id="kt_menu_641d513359495">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">Filter Options</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Status:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true"
                                            data-placeholder="Select option"
                                            data-dropdown-parent="#kt_menu_641d513359495" data-allow-clear="true">
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="2">In Process</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Member Type:</label>
                                    <!--end::Label-->
                                    <!--begin::Options-->
                                    <div class="d-flex">
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                            <span class="form-check-label">Author</span>
                                        </label>
                                        <!--end::Options-->
                                        <!--begin::Options-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2"
                                                checked="checked" />
                                            <span class="form-check-label">Customer</span>
                                        </label>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Notifications:</label>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <div
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" name="notifications"
                                            checked="checked" />
                                        <label class="form-check-label">Enabled</label>
                                    </div>
                                    <!--end::Switch-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                        data-kt-menu-dismiss="true">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-primary"
                                        data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_create_app">Create</a>
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
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Customer Details</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form" data-kt-redirect="/customers"
                            action="{{ route('addCustomer') }}" method="POST">
                            @csrf
                            <input type="hidden" id="isAdmin" name="isAdmin" value="{{ $isAdmin }}">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                @if (isset($customerData) && $customerData->id)
                                <input type="hidden" id="id" name="id" value="{{ $customerData->id }}">
                                <input type="hidden" name="existing_customer_image" id="existing_customer_image" value="{{ $customerData->customer_image }}">
                                <input type="hidden" name="existing_cnic_image" id="existing_cnic_image" value="{{ $customerData->customer_cnic_image }}">
                                <input type="hidden" name="existing_nok_cnic_image" id="existing_nok_cnic_image" value="{{ $customerData->nok_cnic_image }}">
                                <input type="hidden" name="existing_thumb_impression" id="existing_thumb_impression" value="{{ $customerData->thumb_impression }}">
                                @endif
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                            <!--begin::Preview existing avatar-->
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url({{ isset($customerData->customer_image) ? asset('images/customer-images/'.$customerData->customer_image) : asset('images/customer-images/blank.png') }})">
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
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Full Name-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="full_name"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Full Name" value="{{ $customerData->name ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Address-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Address</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="address"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Address" value="{{ $customerData->address ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Area-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Area</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="area"
                                            class="form-control form-control-lg form-control-solid" placeholder="Area"
                                            value="{{ $customerData->area ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group City-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">City</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="city"
                                            class="form-control form-control-lg form-control-solid" placeholder="City"
                                            value="{{ $customerData->city ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Country-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Country</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="country"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Country" value="{{ $customerData->country ?? '' }}" />
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
                                        <input type="text" name="mobile_no_1"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Phone number"
                                            value="{{ $customerData->mobile_number_1 ?? '' }}" />
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
                                        <input type="text" name="mobile_no_2"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Mobile Number 2"
                                            value="{{ $customerData->mobile_number_2 ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Landline Number-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Landline Number</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="landline"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Landline Number" value="{{ $customerData->landline_number ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Office Phone-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Office Phone</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="office_phone"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Office Phone"
                                            value="{{ $customerData->office_phone ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group CNIC-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">CNIC</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="CNIC must be valid">
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
                                        <input type="text" name="cnic"
                                            class="form-control form-control-lg form-control-solid" placeholder="CNIC"
                                            value="{{ $customerData->cnic_number ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <div class="row mb-6">
                                    <label
                                        class="col-lg-4 col-form-label required fw-semibold fs-6">CNIC Image</label>
                                    <div class="custom-file col-lg-8 fv-row">
                                        <input type="file" name="cnic_image"
                                            class="form-control form-control-lg form-control-solid custom-file-input"
                                            id="cnic_image">
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">CNIC Preview</label>
                                    <div class="custom-file col-lg-8 fv-row">
                                        <a href="{{ isset($customerData) && $customerData->customer_cnic_image ? URL::asset('images/customer/customer-cnic/' . $customerData->customer_cnic_image) : '' }}"
                                            target="_blank">
                                            <img id="customer_cnic_preview"
                                                src="{{ isset($customerData) && $customerData->customer_cnic_image ? URL::asset('images/customer/customer-cnic/' . $customerData->customer_cnic_image) : '' }}"
                                                alt="CNIC Customer"
                                                style="max-width: 300px; margin-top: 10px;">
                                        </a>
                                    </div>
                                </div>
                                <!--end::-->
                                <!--begin::Input group customer Thumb Impression-->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Thumb Impression</label>
                                    <div class="custom-file col-lg-8 fv-row">
                                        <input type="file" name="thumb_impression"
                                            class="form-control form-control-lg form-control-solid custom-file-input"
                                            id="thumb_impression">
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Thumb Impression Preview</label>
                                    <div class="custom-file col-lg-8 fv-row">
                                        <a href="{{ isset($customerData) && $customerData->thumb_impression ? URL::asset('images/customer/thumb-impression/' . $customerData->thumb_impression) : '' }}"
                                            target="_blank">
                                            <img id="thumb_impression_preview"
                                                src="{{ isset($customerData) && $customerData->thumb_impression ? URL::asset('images/customer/thumb-impression/' . $customerData->thumb_impression) : '' }}"
                                                alt="Thumb Impression"
                                                style="max-width: 300px; margin-top: 10px;">
                                        </a>
                                    </div>
                                </div>
                                <!--end::Input group customer Thumb Impression-->
                                <!--begin::Input group Next of Kin Name-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Next of Kin Name</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nok_name"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Next of Kin Name"
                                            value="{{ $customerData->next_of_kin_name ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Next of Kin Relation-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Next of Kin Relation</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nok_relation"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Next of Kin Relation"
                                            value="{{ $customerData->next_of_kin_relation ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--begin::Input group Next of Kin Address-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Next of Kin Address</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nok_address"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Next of Kin Address"
                                            value="{{ $customerData->next_of_kin_address ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Next of Kin Area-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Next of Kin Area</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nok_area"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Next of Kin Area"
                                            value="{{ $customerData->next_of_kin_area ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Next of Kin City-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Next of Kin City</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nok_city"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Next of Kin City"
                                            value="{{ $customerData->next_of_kin_city ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Next of Kin Country-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Next of Kin Country</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nok_country"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Next of Kin Country"
                                            value="{{ $customerData->next_of_kin_country ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Next of Kin Mobile Number 1-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Mobile Number 1</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nok_mobile_no_1"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Phone number" value="{{ $customerData->next_of_kin_mobile_number_1 ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Next of Kin Mobile Number 2-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Next of Kin Mobile Number
                                        2</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nok_mobile_no_2"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Next of Kin Mobile Number 2"
                                            value="{{ $customerData->next_of_kin_mobile_number_2 ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Next of Kin Landline Number-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Next of Kin Landline
                                        Number</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nok_landline"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Next of Kin Landline Number"
                                            value="{{ $customerData->next_of_kin_landline_number ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group Next of Kin CNIC-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Next of Kin CNIC</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nok_cnic"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Next of Kin CNIC"
                                            value="{{ $customerData->next_of_kin_cnic ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group customer cnic image-->
                                <div class="row mb-6">
                                    <label
                                        class="col-lg-4 col-form-label required fw-semibold fs-6">CNIC</label>
                                    <div class="custom-file col-lg-8 fv-row">
                                        <input type="file" name="nok_cnic_image"
                                            class="form-control form-control-lg form-control-solid custom-file-input"
                                            id="nok_cnic_image">
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">CNIC Preview</label>
                                    <div class="custom-file col-lg-8 fv-row">
                                        <a href="{{ isset($customerData) && $customerData->nok_cnic_image ? URL::asset('images/customer/nok-cnic/' . $customerData->nok_cnic_image) : '' }}"
                                            target="_blank">
                                            <img id="nok_cnic_preview"
                                                src="{{ isset($customerData) && $customerData->nok_cnic_image ? URL::asset('images/customer/nok-cnic/' . $customerData->nok_cnic_image) : '' }}"
                                                alt="CNIC NOK"
                                                style="max-width: 300px; max-height:300px; margin-top: 10px; padding:5px">
                                        </a>
                                    </div>
                                </div>
                                <!--end::Input group customer cnic image-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                <button type="submit" class="btn btn-primary"
                                    id="kt_account_profile_details_submit">Save Changes</button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
                <!--begin::Delete Account-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_deactivate" aria-expanded="true"
                        aria-controls="kt_account_deactivate">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Delete Customer</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_deactivate" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_deactivate_form" class="form" data-kt-redirect="/customers">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Notice-->
                                <div
                                    class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
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
                                            <h4 class="text-gray-900 fw-bold">You Are Deleting An Account</h4>
                                            <div class="fs-6 text-gray-700">This action can not be undone.
                                                <br />
                                                <a class="fw-bold" href="#">Learn more</a>
                                            </div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--begin::Form input row-->
                                <div class="form-check form-check-solid fv-row">
                                    <input name="deactivate" class="form-check-input" type="checkbox" value=""
                                        id="deactivate" />
                                    <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate">I confirm to
                                        delete this account</label>
                                </div>
                                <!--end::Form input row-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button id="kt_account_deactivate_account_submit" type="submit"
                                    class="btn btn-danger fw-semibold">Delete Customer</button>
                            </div>
                            <!--end::Card footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Deactivate Account-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
</div>
@endsection

@push('scripts')
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ URL::asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ URL::asset('assets/js/custom/account/settings/signin-methods.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/account/settings/save-customer.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/account/settings/delete-customer.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/pages/user-profile/general.js') }}"></script>
<script src="{{ URL::asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/utilities/modals/offer-a-deal/type.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/utilities/modals/offer-a-deal/details.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/utilities/modals/offer-a-deal/finance.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/utilities/modals/offer-a-deal/complete.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/utilities/modals/offer-a-deal/main.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/utilities/modals/two-factor-authentication.js') }}"></script>
<script src="{{ URL::asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
<!--end::Custom Javascript-->
@endpush