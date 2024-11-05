@extends('layouts.dashboardlayout')
@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <h3 class="fw-bold m-0">Development/Extra Charges</h3>
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
                                    <h2>Add Development/Extra Charges</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Form-->
                                <form id="development_charges_form" class="form">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="row mb-7">
                                        <label for="booking_id" class="form-label required">Booking</label>
                                        <select name="booking_id" id="booking_id" aria-label="Select Booking"
                                            class="form-select form-select-lg fw-semibold" data-control="select2"
                                            data-placeholder="Select booking...">
                                            <option value="" selected disabled>Select Booking...</option>
                                            @foreach ($bookings as $booking)
                                            <option value="{{ $booking->id }}">{{ $booking->plot_no . ' - ' .
                                                $booking->customer_name . ' - ' . $booking->cnic_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="row mb-7">
                                        <div class="col-lg-4 fv-row">
                                            <label for="dev_charge" class="form-label required">Amount</label>
                                            <input type="number" step="any" class="form-control" name="dev_charge"
                                                id="dev_charge" placeholder="Enter amount" />
                                        </div>
                                        <div class="col-lg-4 fv-row">
                                            <label for="num_of_installments" class="form-label required">Number of
                                                Installments</label>
                                            <input type="number" step="any" class="form-control"
                                                name="num_of_installments" id="num_of_installments"
                                                placeholder="Enter number of installments" />
                                        </div>
                                        <div class="col-lg-4 fv-row">
                                            <label for="installment_amount" class="form-label required">Installment
                                                Amount</label>
                                            <input type="number" step="any" class="form-control"
                                                name="installment_amount" id="installment_amount"
                                                placeholder="Installment Amount" readonly />
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                    <div id="installmentTableCard"  style="display: none;">
                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                            <!--begin::Card header-->
                                            <div class="card-header p-0">
                                                <div class="card-title">
                                                    <h2>Installment Table</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body p-0">
                                                <!-- Installment Table -->
                                                <table id="installmentTable"
                                                    class="table align-middle table-row-dashed fs-6 gy-5">
                                                    <thead>
                                                        <tr
                                                            class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0 ">
                                                            <th class="min-w-125px">S.No</th>
                                                            <th class="min-w-125px">Amount</th>
                                                            <th class="min-w-125px">Due Date</th>
                                                            <th class="min-w-150px">Intimation Date</th>
                                                            <th class="min-w-125px">Payment Date</th>
                                                            <th class="text-end min-w-125px">Invoice</th>
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
<script src="{{ URL::asset('assets/js/custom/account/settings/add-development-charges.js') }}"></script>
@endpush