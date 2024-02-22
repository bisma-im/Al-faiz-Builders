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
                        <form id="kt_new_booking_form" class="form" data-kt-redirect="{{ route('showBookings') }}" action="{{ route('addBooking') }}" method="POST">
                        {{-- <form id="kt_new_booking_form" class="form" > --}}
                            @csrf
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                @if (isset($bookingData) && $bookingData->id)
                                    <input type="hidden" id="id" name="id" value="{{ $bookingData->id }}">
                                    <input type="hidden" id="customer_id" name="customer_id" value="{{ $bookingData->customer_id }}">
                                @endif
                                <input type="hidden" id="isLocked" name="isLocked" value="{{ $isLockedMode ? 'true' : 'false' }}">
                                <!--begin::Input group-->
                                <div id="bookingForm" 
                                data-selected-plot="{{ $bookingData->plot_id ?? '' }}"
                                data-selected-phase="{{ $bookingData->phase_id ?? '' }}">
                                {{-- data-completion-date= "{{ $bookingData->completion_date->format('Y-m-d') ?? '' }}"> --}}
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
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Phase</span>
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
                                        @if ($isLockedMode)
                                        <select name="selectedPhase" id="selectedPhase" class="form-select form-select-solid form-select-lg fw-semibold" placeholder="Select phase.." data-control="select2">
                                            <option value="{{ $bookingData->phase_id }}" selected>
                                                {{ $bookingData->phase_title }}
                                            </option>
                                        </select>
                                        @else
                                        <select name="phase_id" id="phaseDropdown" aria-label="Select Phase" class="form-select form-select-solid form-select-lg fw-semibold" placeholder="Select phase.." data-control="select2">
                                            <option value="" selected disabled>Select phase...</option>
                                        </select>
                                        @endif
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
                                        @if ($isLockedMode)
                                        <select name="selectedPlot" id="selectedPlot" class="form-select form-select-solid form-select-lg fw-semibold" placeholder="Select plot number.." data-control="select2">
                                            <option value="{{ $bookingData->plot_id }}" selected>
                                                {{ $bookingData->plot_no }}
                                            </option>
                                        </select>
                                        @else
                                        <select name="plot_id" id="plotDropdown" aria-label="Select Plot Number" class="form-select form-select-solid form-select-lg fw-semibold" placeholder="Select plot number.." data-control="select2">
                                            <option value="" selected disabled>Select plot...</option>
                                        </select>
                                        @endif
                                    </div>    
                                </div>
                                <!--end::Input group plot id-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Customer Image</label>
                                    <!--end::Label-->
                                    <div class="col-lg-8 fv-row">
                                    <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                            <!--begin::Preview existing avatar-->
                                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ isset($bookingData->customer_image) ? URL::asset('images/customer-images/'.$bookingData->customer_image) : URL::asset('assets/media/svg/avatars/blank.svg') }})"></div>
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                <i class="ki-duotone ki-pencil fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <!--begin::Inputs-->
                                                <input type="file" id="avatar" name="avatar" accept=".png, .jpg, .jpeg" />
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
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--begin::Input group customer name-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Customer Name</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="customer_name" class="form-control form-control-lg form-control-solid" placeholder="Customer Name" value="{{ $bookingData->name ?? '' }}" />
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
                                        <input type="text" name="customer_cnic" class="form-control form-control-lg form-control-solid" placeholder="Customer CNIC" value="{{ $bookingData->cnic_number ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group customer cnic-->
                                <!--begin::Input group customer number-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Contact Number</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="mobile_no" class="form-control form-control-lg form-control-solid" placeholder="Contact Number" value="{{ $bookingData->mobile_number_1 ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group customer number-->
                                <!--begin::Input group customer address-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Customer Address</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="customer_address" class="form-control form-control-lg form-control-solid" placeholder="Customer Address" value="{{ $bookingData->address ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group customer address-->
                                <!--begin::Input group base unit cost-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Base Unit Cost</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" step="any" name="unit_cost" class="form-control form-control-lg form-control-solid" placeholder="Base Unit Cost" value="{{ $bookingData->unit_cost ?? '' }}" />
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
                                        <input type="number" step="any" name="extra_charges" class="form-control form-control-lg form-control-solid" placeholder="Extra Charges" value="{{ $bookingData->extra_charges ?? '' }}" />
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
                                        <input type="number" step="any" name="development_charges" class="form-control form-control-lg form-control-solid" placeholder="Development Charges" value="{{ $bookingData->development_charges ?? '' }}" />
                                        
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group development charges-->
                                <!--begin::Input group per month installment-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Total Amount</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" step="any" name="total_amount" id="total_amount" class="form-control form-control-lg form-control-solid" placeholder="Total Amount" value="{{ $bookingData->total_amount ?? '' }}" />
                                        
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
                                        <input type="number" step="any" name="token_amount" class="form-control form-control-lg form-control-solid" placeholder="Token Amount" value="{{ $bookingData->token_amount ?? '' }}" />
                                        
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
                                        <input type="number" step="any" name="advance_amount" class="form-control form-control-lg form-control-solid" placeholder="Advance Amount" value="{{ $bookingData->advance_amount ?? '' }}" />
                                        
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group advance amount-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Payment Plan</span>
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
                                        <select name="payment_plan" id="paymentPlan" aria-label="Select Payment Plan" class="form-select form-select-solid form-select-lg fw-semibold" data-control="select2" data-placeholder="Select Payment Plan...">
                                            <option value="">Select Payment Plan...</option>
                                            <option value="full_cash" {{ (isset($bookingData) && $bookingData->payment_plan == 'full_cash') ? 'selected' : '' }}>Full Cash</option>
                                            <option value="installment" {{ (isset($bookingData) && $bookingData->payment_plan == 'installment') ? 'selected' : '' }}>Installment</option>
                                            <option value="part_payment" {{ (isset($bookingData) && $bookingData->payment_plan == 'part_payment') ? 'selected' : '' }}>Part Payment</option>
                                        </select>
                                    </div>    
                                </div>

                                <div id="fullCashInputs" style="display: none;">
                                    <!-- Full cash specific fields -->
                                </div>

                                <div class="row mb-6" id="installmentInputs" style="display: none;">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6 mb-9">Number of Installments</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" id="num_of_installments" name="num_of_installments" class="form-control form-control-lg form-control-solid" placeholder="Number of Installment" value="{{ $bookingData->number_of_installments ?? '' }}" />
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Installment Amount</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="number" step="any" name="installment_amount" id="installment_amount" class="form-control form-control-lg form-control-solid" placeholder="Installment Amount" value="{{ $bookingData->installment_amount ?? '' }}" {{ 'readonly' }} />
                                    </div>
                                    <!--end::Col-->
                                    <div class="row">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6 mt-10">Installment Table</label>
                                        <!--end::Label-->
                                    </div>
                                </div>

                                <div id="partPaymentInputs" style="display: none;">
                                    <!-- Part payment specific fields -->
                                </div>
                                <div class="card-body pt-0">
                                    <!-- Installment Table -->
                                    <table id="installmentTable" class="table align-middle table-row-dashed fs-6 gy-5" style="display: none;">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 ">
                                                <th class="min-w-125px">Amount</th>
                                                <th class="min-w-125px">Due Date</th>
                                                <th class="min-w-125px">Intimation Date</th>
                                                <th class="min-w-125px">Status</th>
                                                <th class="min-w-125px">Mode</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            <!-- Installment rows will be dynamically inserted here -->
                                        </tbody>
                                    </table>
                                </div>
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
</div>
@endsection
@push('scripts')
    <script src="{{ URL::asset('assets/js/custom/account/settings/add-booking.js') }}"></script>
@endpush