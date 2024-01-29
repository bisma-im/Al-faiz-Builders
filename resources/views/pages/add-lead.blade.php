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
                <!--begin::Modal - Customers - Add-->
				<div class="modal fade" id="kt_modal_add_log" tabindex="-1" aria-hidden="true">
					<!--begin::Modal dialog-->
					<div class="modal-dialog modal-dialog-centered mw-650px">
						<!--begin::Modal content-->
						<div class="modal-content">
							<!--begin::Form-->
							<form class="form" action="#" id="kt_modal_add_log_form" data-kt-redirect="../../demo1/dist/apps/customers/list.html">
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
				<!--end::Modal - Customers - Add-->
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