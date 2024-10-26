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
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            @if($voucherType === 'CPV')
                                <h3 class="fw-bold m-0">Cash Payment Voucher</h3>
                            @elseif($voucherType === 'CRV')
                                <h3 class="fw-bold m-0">Cash Receipt Voucher</h3>
                            @elseif($voucherType === 'BRV')
                                <h3 class="fw-bold m-0">Bank Receipt Voucher</h3>
                            @elseif($voucherType === 'BPV')
                                <h3 class="fw-bold m-0">Bank Payment Voucher</h3>
                            @elseif($voucherType === 'JV')
                                <h3 class="fw-bold m-0">Journal Voucher</h3>
                            @endif
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_new_voucher" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_new_voucher_form" class="form" data-kt-redirect="/vouchers"
                            action="{{ route('addVoucher') }}" method="POST">
                            @csrf
                            <input type="hidden" name="voucher_type" id="voucher_type" value="{{ $voucherType }}">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                        <span class="required">Account (Debit)</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Select the appropriate account">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4 fv-row">
                                        <select name="debit_account_code" aria-label="Select an Account Head"
                                            class="form-select form-select-solid form-select-lg fw-semibold"
                                            data-control="select2" data-placeholder="Choose an account...">
                                            <option value="">Choose an Account...</option>
                                            @foreach ($accounts as $account)
                                            <option value="{{ $account->Account_Code }}"> {{ $account->Account_Code . '
                                                - ' . $account->Account_Title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                        <span class="required">Account (Credit)</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Select the appropriate account">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4 fv-row">
                                        <select name="credit_account_code" aria-label="Select an Account Head"
                                            class="form-select form-select-solid form-select-lg fw-semibold"
                                            data-control="select2" data-placeholder="Choose an account...">
                                            <option value="">Choose an Account...</option>
                                            @foreach ($accounts as $account)
                                            <option value="{{ $account->Account_Code }}"> {{ $account->Account_Code . '
                                                - ' . $account->Account_Title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                        <span class="required">Date</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Select the date">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4 fv-row">
                                        <input name="voucher_date" id="kt_ecommerce_datepicker"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Pick date" />
                                    </div>
                                    <!--begin::Input group-->
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Amount</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4 fv-row">
                                        <input type="number" step="any" name="amount"
                                            class="form-control form-control-lg form-control-solid" placeholder="Amount"
                                            value="" />
                                    </div>
                                    <!--end::Col-->
                                    <!--end::Input group-->
                                </div>
                                <!--end::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">On account
                                        of</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4 fv-row">
                                        <input type="text" name="description"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Description" value="" />
                                    </div>
                                    <!--end::Col-->
                                    @if($voucherType === 'BPV' || $voucherType === 'BRV')
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Drawn on
                                        Bank</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4 fv-row">
                                        <input type="number" name="drawn_on_bank"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Drawn on Bank" value="" />
                                    </div>
                                    <!--end::Col-->
                                    @endif
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    @if($voucherType === 'BPV' || $voucherType === 'BRV')
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label required fw-semibold fs-6">Cheque No.</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4 fv-row">
                                        <input type="text" name="cheque_no"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Cheque No." value="" />
                                    </div>
                                    <!--end::Col-->
                                    @endif
                                </div>
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                        <span>Attach File</span>
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Select any receipt, bill, cheque copy etc">
                                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-10 fv-row">
                                        <!--begin::Dropzone-->
                                        <div class="dropzone" id="kt_ecommerce_add_voucher_media">
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
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click
                                                        to upload.</h3>
                                                    <span class="fs-7 fw-semibold text-gray-400">Upload up to 10
                                                        files</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                    </div>
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary" id="kt_new_voucher_submit">Save
                                    Changes</button>
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
<script src="{{ URL::asset('assets/js/custom/account/settings/add-voucher.js') }}"></script>
@endpush