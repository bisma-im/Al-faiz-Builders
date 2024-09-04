@extends('layouts.dashboardlayout')
@section('extra-css')
<style>
    .voucher-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
    }
    .voucher-table, .voucher-table th, .voucher-table td {
        border: 1px solid black;
    }
    .voucher-table th, .voucher-table td {
        padding: 8px;
        text-align: left;
    }
</style>
@endsection
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Voucher List</h1>
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
                        <li class="breadcrumb-item text-muted">Vouchers</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
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
                                <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Vouchers" style="max-width: 170px;"/>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            
                            <label for="kt_datepicker_start" class="form-label ki-duotone me-1">From:</label>
                            <input class="form-control form-control-sm me-2" id="kt_datepicker_start" placeholder="Select start date" style="max-width: 100px;"/>
                            <label for="kt_datepicker_end" class="form-label ki-duotone me-1">To: </label>
                            <input class="form-control form-control-sm me-2" id="kt_datepicker_end" placeholder="Select end date" style="max-width: 100px;"/>
                            
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                <!--begin::Export-->
                                <form id="exportVouchersForm" action="/export-vouchers" method="POST" target="_blank">
                                    @csrf
                                    <input type="hidden" name="fromDate" id="fromDate">
                                    <input type="hidden" name="toDate" id="toDate">
                                    <button type="button" class="btn btn-light-primary me-2" style="max-width: 120px;" id="exportPDF">
                                    <i class="ki-duotone ki-exit-up fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Export</button>
                                </form>
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
                                    <th class="min-w-125px">Voucher ID</th>
                                    <th class="min-w-125px">Voucher Type</th>
                                    <th class="min-w-125px">Description</th>
                                    <th class="min-w-125px">Date and Time</th>
                                    <th class="min-w-125px">Amount</th>
                                    <th class="min-w-125px">Added By</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600" id="vouchersList">
                                @include('partials.voucher_row', ['voucherData' => $voucherData])
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Modal - Show - Voucher-->
                <div class="modal fade" id="kt_modal_show_voucher" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_customer_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Voucher Details ( <span id="voucher-id-placeholder"></span> )</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div id="kt_modal_voucher_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                                <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" 
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                    <table class="voucher-table">
                                        <colgroup>
                                            <col style="width: 20%;">  <!-- Smaller width for the Date column -->
                                            <col style="width: 40%;">  <!-- Larger width for the Account column -->
                                            <!-- The next two col elements will split the remaining 50% of the table width -->
                                            <col style="width: 20%;">
                                            <col style="width: 20%;">
                                        </colgroup>
                                        <tr>
                                            <th>Date</th>
                                            <th>Account</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                        </tr>
                                        <tbody id="voucher_entries">
                                            {{-- <tr>
                                                <td id="voucher_date"></td>
                                                <td id="voucher_account"></td>
                                                <td id="voucher_debit"></td>
                                                <td id="voucher_credit"></td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Scroll-->
                            </div>
                            <!--end::Modal body-->
                            <!--begin::Modal footer-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                <button type="reset" id="kt_modal_voucher_cancel" class="btn btn-light me-3">Discard</button>
                                <!--end::Button-->
                            </div>
                            <!--end::Modal footer-->
                        </div>
                    </div>
                </div>
                <!--end::Modal - Show - Voucher-->
                <!--end::Modals-->
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
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets/js/custom/account/settings/voucher-list.js"></script>
        <script src="assets/js/custom/account/settings/show-voucher.js"></script>
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/utilities/modals/users-search.js"></script>
		<!--end::Custom Javascript-->
@endpush