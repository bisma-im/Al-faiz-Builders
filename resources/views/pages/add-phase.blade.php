@extends('layouts.dashboardlayout')
@section('content')
    <!--begin::Main-->
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
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Phase Form</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Phase</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
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
                            <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Filter</a>
                            <!--end::Menu toggle-->
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_641d510217861">
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
                                            <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641d510217861" data-allow-clear="true">
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
                                                <input class="form-check-input" type="checkbox" value="2" checked="checked" />
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
                                        <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                            <label class="form-check-label">Enabled</label>
                                        </div>
                                        <!--end::Switch-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
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
                        <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
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
                    <!--begin::Form-->
                    <form id="kt_ecommerce_add_phase_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="/projects" action="{{ route('addPhase') }}" method="POST">
                        @csrf
                        @if (isset($phaseData) && $phaseData->id)
                            <input type="hidden" id="id" name="id" value="{{ $phaseData->id }}">
                        @endif
                        <input type="hidden" id="project_id" name="project_id" value="{{ $projectId }}">
                        <input type="hidden" id="phase_completion_date" name="phase_completion_date" value="{{ $phaseData->formattedDateTime ?? '' }}"/>
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            
                            <!--begin::Thumbnail settings-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Thumbnail</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body text-center pt-0">
                                    <!--begin::Image input-->
                                    <!--begin::Image input placeholder-->
                                    <style>.image-input-placeholder { background-image: url('assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
                                    <!--end::Image input placeholder-->
                                    <div class="image-input image-input-outline {{ isset($phaseData->phase_logo) ? '' : 'image-input-empty' }} image-input-placeholder mb-3" data-kt-image-input="true">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-150px h-150px" style="{{ isset($phaseData->phase_logo) ? 'background-image: url('.asset('images/phase-logos/'.$phaseData->phase_logo).')' : '' }}"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="ki-duotone ki-pencil fs-7">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="phase_logo" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Thumbnail settings-->
                            <!--begin::Status-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Status</h2>
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_project_status"></div>
                                    </div>
                                    <!--begin::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_project_status_select" name="status">
                                        <option></option>
                                        <option value="published" selected="selected">Published</option>
                                        <option value="draft">Draft</option>
                                        <option value="scheduled">Scheduled</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Set the product status.</div>
                                    <!--end::Description-->
                                    <!--begin::Datepicker-->
                                    <div class="d-none mt-10">
                                        <label for="kt_ecommerce_add_project_status_datepicker" class="form-label">Select publishing date and time</label>
                                        <input class="form-control" id="kt_ecommerce_add_project_status_datepicker" placeholder="Pick date & time" />
                                    </div>
                                    <!--end::Datepicker-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Status-->
                            <!--begin::Category & tags-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Project Details</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <!--begin::Label-->
                                    <label class="form-label">Categories</label>
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple">
                                        <option></option>
                                        <option value="Computers">Computers</option>
                                        <option value="Watches">Watches</option>
                                        <option value="Headphones">Headphones</option>
                                        <option value="Footwear">Footwear</option>
                                        <option value="Cameras">Cameras</option>
                                        <option value="Shirts">Shirts</option>
                                        <option value="Household">Household</option>
                                        <option value="Handbags">Handbags</option>
                                        <option value="Wines">Wines</option>
                                        <option value="Sandals">Sandals</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7 mb-7">Add product to a category.</div>
                                    <!--end::Description-->
                                    <!--end::Input group-->
                                    <!--begin::Button-->
                                    <a href="../../demo1/dist/apps/ecommerce/catalog/add-category.html" class="btn btn-light-primary btn-sm mb-10">
                                    <i class="ki-duotone ki-plus fs-2"></i>Create new category</a>
                                    <!--end::Button-->
                                    <!--begin::Input group-->
                                    <!--begin::Label-->
                                    <label class="form-label d-block">Tags</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input id="kt_ecommerce_add_project_tags" name="kt_ecommerce_add_project_tags" class="form-control mb-2" value="" />
                                    <!--end::Input-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Add tags to a product.</div>
                                    <!--end::Description-->
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Category & tags-->
                            <!--begin::Weekly sales-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Weekly Sales</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <span class="text-muted">No data available. Sales data will begin capturing once product has been published.</span>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Weekly sales-->
                            <!--begin::Template settings-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>Product Template</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Select store template-->
                                    <label for="kt_ecommerce_add_product_store_template" class="form-label">Select a product template</label>
                                    <!--end::Select store template-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template">
                                        <option></option>
                                        <option value="default" selected="selected">Default template</option>
                                        <option value="electronics">Electronics</option>
                                        <option value="office">Office stationary</option>
                                        <option value="fashion">Fashion</option>
                                    </select>
                                    <!--end::Select2-->
                                    <!--begin::Description-->
                                    <div class="text-muted fs-7">Assign a template from your current theme to define how a single product is displayed.</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Template settings-->
                        </div>
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <!--begin:::Tabs-->
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">General</a>
                                </li>
                                <!--end:::Tab item-->
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Advanced</a>
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <!--begin::Tab content-->
                            <div class="tab-content">
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <!--begin::General options-->
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
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Phase Name</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="phase_name" class="form-control mb-2" placeholder="Phase Name" value="{{ $phaseData->phase_title ?? '' }}" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Enter the project phase.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Project Cost</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="number" step="any" name="phase_cost" class="form-control mb-2" placeholder="Project Cost" value="{{ $phaseData->phase_cost ?? '' }}" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set the project cost.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <label for="kt_ecommerce_phase_complete_datepicker" class="form-label">
                                                        <span class="required">Phase Completion Date</span>
                                                    </label>
                                                    
                                                    <div class="col-lg-8 fv-row">
                                                        <input class="form-control" name="completion_date" id="kt_ecommerce_phase_complete_datepicker" class="form-control form-control-lg form-control-solid" placeholder="Pick date & time"/>
                                                        
                                                    </div>
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::General options-->
                                        <!--begin::Media-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Media</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-2">
                                                    <!--begin::Dropzone-->
                                                    <div class="dropzone" id="kt_ecommerce_add_phase_media">
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
                                                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                                <span class="fs-7 fw-semibold text-gray-400">Upload up to 10 files</span>
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
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::Media-->
                                        <!--begin::Pricing-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Pricing</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Down Payment</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="number" step="any" name="down_payment" class="form-control mb-2" placeholder="Product price" value="{{ $phaseData->down_payment ?? '' }}" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set the down payment.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Development Charges</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="number" step="any" name="development_charges" class="form-control mb-2" placeholder="Development Charges" value="{{ $phaseData->development_charges ?? '' }}" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set the development charges.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Extra Charges</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="number" step="any" name="extra_charges" class="form-control mb-2" placeholder="Extra Charges" value="{{ $phaseData->extra_charges ?? '' }}" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set the extra charges.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Monthly Installment</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="number" step="any" name="monthly_installment" class="form-control mb-2" placeholder="Monthly Installment" value="{{ $phaseData->monthly_installment ?? '' }}" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set the monthly installment.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-10">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold mb-2">Discount Type
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Select a discount type that will be applied to this product">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span></label>
                                                    <!--End::Label-->
                                                    <!--begin::Row-->
                                                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                                        <!--begin::Col-->
                                                        <div class="col">
                                                            <!--begin::Option-->
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                                                                <!--begin::Radio-->
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discount_option" value="1" checked="checked" />
                                                                </span>
                                                                <!--end::Radio-->
                                                                <!--begin::Info-->
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">No Discount</span>
                                                                </span>
                                                                <!--end::Info-->
                                                            </label>
                                                            <!--end::Option-->
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <div class="col">
                                                            <!--begin::Option-->
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                                                <!--begin::Radio-->
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discount_option" value="2" />
                                                                </span>
                                                                <!--end::Radio-->
                                                                <!--begin::Info-->
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">Percentage %</span>
                                                                </span>
                                                                <!--end::Info-->
                                                            </label>
                                                            <!--end::Option-->
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <div class="col">
                                                            <!--begin::Option-->
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                                                <!--begin::Radio-->
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discount_option" value="3" />
                                                                </span>
                                                                <!--end::Radio-->
                                                                <!--begin::Info-->
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">Fixed Price</span>
                                                                </span>
                                                                <!--end::Info-->
                                                            </label>
                                                            <!--end::Option-->
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Row-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_percentage">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Set Discount Percentage</label>
                                                    <!--end::Label-->
                                                    <!--begin::Slider-->
                                                    <div class="d-flex flex-column text-center mb-5">
                                                        <div class="d-flex align-items-start justify-content-center mb-7">
                                                            <span class="fw-bold fs-3x" id="kt_ecommerce_add_product_discount_label">0</span>
                                                            <span class="fw-bold fs-4 mt-1 ms-2">%</span>
                                                        </div>
                                                        <div id="kt_ecommerce_add_product_discount_slider" class="noUi-sm"></div>
                                                    </div>
                                                    <!--end::Slider-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set a percentage discount to be applied on this product.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_fixed">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Fixed Discounted Price</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="dicsounted_price" class="form-control mb-2" placeholder="Discounted price" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set the discounted product price. The product will be reduced at the determined fixed price</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Tax-->
                                                <div class="d-flex flex-wrap gap-5">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <!--begin::Label-->
                                                        <label class="required form-label">Tax Class</label>
                                                        <!--end::Label-->
                                                        <!--begin::Select2-->
                                                        <select class="form-select mb-2" name="tax" data-control="select2" data-hide-search="true" data-placeholder="Select an option">
                                                            <option></option>
                                                            <option value="0">Tax Free</option>
                                                            <option value="1">Taxable Goods</option>
                                                            <option value="2">Downloadable Product</option>
                                                        </select>
                                                        <!--end::Select2-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Set the product tax class.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <!--begin::Label-->
                                                        <label class="form-label">VAT Amount (%)</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control mb-2" value="" />
                                                        <!--end::Input-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Set the product VAT about.</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end:Tax-->
                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::Pricing-->
                                    </div>
                                </div>
                                <!--end::Tab pane-->
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <!--begin::Inventory-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Inventory</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Phase Area</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="number" name="phase_area" step="any" class="form-control mb-2" placeholder="Phase Area" value="{{ $phaseData->phase_area ?? '' }}" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Enter the phase area.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="form-label required">Plots</label>
                                                    <!--end::Label-->
                                                    @if(isset($phaseData))
                                                        <div class="d-flex gap-3">
                                                            <button type="button" class="btn btn-primary mb-7" onclick="location.href='{{ route('showPlots', ['id' => $phaseData->id]) }}'">Show Details</button>
                                                        </div>
                                                    @else
                                                        <!--begin::Input group-->
                                                        <div class="" data-kt-ecommerce-catalog-add-project="auto-options">
                                                            <!--begin::Repeater-->
                                                            <div id="kt_ecommerce_add_plot_options">
                                                                <!--begin::Form group-->
                                                                <div class="form-group">
                                                                    <div data-repeater-list="kt_ecommerce_add_plot_options" class="d-flex flex-column gap-3">
                                                                        <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
                                                                            <!--begin::Input-->
                                                                            <input type="text" name="category" class="form-control mw-100 w-200px" placeholder="Plot Size" />
                                                                            <!--begin::Select2-->
                                                                            <div class="w-100 w-md-200px">
                                                                                <select class="form-select" name="plot_or_shop" data-placeholder="Select type" data-kt-ecommerce-catalog-add-project="project_option">
                                                                                    <option></option>
                                                                                    <option value="plot">Plot</option>
                                                                                    <option value="shop">Shop</option>
                                                                                </select>
                                                                            </div>
                                                                            <!--end::Select2-->
                                                                            <input type="number" name="no_of_plots" class="form-control mw-100 w-200px" placeholder="Number of Plots"  />
                                                                            <input type="text" name="plot_prefix" class="form-control mw-100 w-200px" placeholder="Plot Prefix" />
                                                                            <input type="number" step="any" name="amount" class="form-control mw-100 w-200px" placeholder="Amount"  />
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
                                                                    <i class="ki-duotone ki-plus fs-2"></i>Add another category</button>
                                                                </div>
                                                                <!--end::Form group-->
                                                            </div>
                                                            <!--end::Repeater-->
                                                        </div>
                                                        <!--end::Input group-->
                                                    @endif
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Enter the plot quantity.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::Inventory-->
                                        <!--begin::Shipping-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Shipping</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="fv-row">
                                                    <!--begin::Input-->
                                                    <div class="form-check form-check-custom form-check-solid mb-2">
                                                        <input class="form-check-input" type="checkbox" id="kt_ecommerce_add_product_shipping_checkbox" value="1" />
                                                        <label class="form-check-label">This is a physical product</label>
                                                    </div>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set if the product is a physical or digital item. Physical products may require shipping.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Shipping form-->
                                                <div id="kt_ecommerce_add_product_shipping" class="d-none mt-10">
                                                    <!--begin::Input group-->
                                                    <div class="mb-10 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="form-label">Weight</label>
                                                        <!--end::Label-->
                                                        <!--begin::Editor-->
                                                        <input type="text" name="weight" class="form-control mb-2" placeholder="Product weight" value="" />
                                                        <!--end::Editor-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Set a product weight in kilograms (kg).</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row">
                                                        <!--begin::Label-->
                                                        <label class="form-label">Dimension</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                                                            <input type="number" name="width" class="form-control mb-2" placeholder="Width (w)" value="" />
                                                            <input type="number" name="height" class="form-control mb-2" placeholder="Height (h)" value="" />
                                                            <input type="number" name="length" class="form-control mb-2" placeholder="Lengtn (l)" value="" />
                                                        </div>
                                                        <!--end::Input-->
                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Enter the product dimensions in centimeters (cm).</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Shipping form-->
                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::Shipping-->
                                        <!--begin::Meta options-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Meta Options</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Meta Tag Title</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta tag name" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Meta Tag Description</label>
                                                    <!--end::Label-->
                                                    <!--begin::Editor-->
                                                    <div id="kt_ecommerce_add_project_meta_description" name="kt_ecommerce_add_project_meta_description" class="min-h-100px mb-2"></div>
                                                    <!--end::Editor-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set a meta tag description to the product for increased SEO ranking.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div>
                                                    <!--begin::Label-->
                                                    <label class="form-label">Meta Tag Keywords</label>
                                                    <!--end::Label-->
                                                    <!--begin::Editor-->
                                                    <input id="kt_ecommerce_add_product_meta_keywords" name="kt_ecommerce_add_product_meta_keywords" class="form-control mb-2" />
                                                    <!--end::Editor-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set a list of keywords that the product is related to. Separate the keywords by adding a comma
                                                    <code>,</code>between each keyword.</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::Meta options-->
                                    </div>
                                </div>
                                <!--end::Tab pane-->
                            </div>
                            <!--end::Tab content-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="../../demo1/dist/apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" id="kt_ecommerce_add_phase_submit" class="btn btn-primary">
                                    <span class="indicator-label">Save Changes</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
    <!--end:::Main-->
@endsection

@push('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
	<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/custom/pages/listings/projects/save-phase.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript-->

@endpush