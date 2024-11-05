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
                {{-- @if ($isDemarc === 'y') --}}
                    <h3 class="fw-bold m-0">Demarcation Charges</h3>
                {{-- @else
                    <h3 class="fw-bold m-0">Development/Extra Charges</h3>
                @endif --}}
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div id="kt_new_account" class="collapse show">

                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="card card-flush py-4" id="devChargesCard">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    {{-- @if ($isDemarc === 'y') --}}
                                    <h2>Add Demarcation Charges</h2>
                                    {{-- @else
                                    <h2>Add Development/Extra Charges</h2>
                                    @endif --}}
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Form-->
                                <form id="kt_modal_add_charges_form" class="form">
                                    @csrf
                                    <!--begin::Input group-->
                                    <input type="hidden" name="isDemarc" id="isDemarc" value="{{ $isDemarc }}"/>
                                    <div class="row mb-7">
                                        <div class="col-lg-6 fv-row">
                                            <label for="booking_id" class="form-label required">Booking</label>
                                            <select name="booking_id" id="bookingDropdown" aria-label="Select Booking"
                                                class="form-select form-select-lg fw-semibold" data-control="select2"
                                                data-placeholder="Select booking...">
                                                <option value="" selected disabled>Select Booking...</option>
                                                @foreach ($bookings as $booking)
                                                <option value="{{ $booking->id }}">{{ $booking->plot_no . ' - ' .
                                                    $booking->customer_name . ' - ' . $booking->cnic_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 fv-row">
                                            <label for="dev_charges" class="form-label required">Amount</label>
                                            <input type="number" step="any" class="form-control" name="dev_charges"
                                                id="dev_charges" placeholder="Enter amount" />
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold mb-2 required">Description</label>
                                        <input type="text" class="form-control" placeholder="Enter description"
                                            name="dev_charges_description" id="dev_charges_description" />
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Modal footer-->
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <!--begin::Button-->
                                        <button type="submit" id="kt_modal_add_charges_submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
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
                            <!--end::Card body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ URL::asset('assets/js/custom/account/settings/add-demarcation-charges.js') }}"></script>
@endpush