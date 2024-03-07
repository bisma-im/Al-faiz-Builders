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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Project List</h1>
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
                        <li class="breadcrumb-item text-muted">Plots Inventory</li>
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
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_641d512351273">
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
                                        <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641d512351273" data-allow-clear="true">
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
                                            <span class="form-check-label">Project</span>
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
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mt-7 mb-7">
                            @foreach ($categories as $category)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-4 {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#{{ 'category-' . str_replace(' ', '-', $category->category) }}">{{ $category->category }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="plotCategoryContent">
                            @foreach ($categories as $category)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ 'category-' . str_replace(' ', '-', $category->category) }}" role="tab-panel">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_users_table">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="w-10px pe-2">
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_users_table .form-check-input" value="1" />
                                                    </div>
                                                </th>
                                                <th class="min-w-125px">Plot Number</th>
                                                <th class="min-w-125px">Booked By</th>
                                                <th class="min-w-125px">Booking Date Time</th>
                                                <th class="min-w-125px">Amount</th>
                                                <th class="min-w-125px"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach ($plots as $id => $plot)
                                                @if ($plot->category == $category->category)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="1" />
                                                            </div>
                                                        </td>
                                                        @if ($plot->created_on == 'Not Booked')
                                                            <td>{{ $plot->plot_no }}</td>
                                                        @else
                                                            <td>
                                                                <a href="{{ route('updateBookingForm', ['id' => $plot->booking_id]) }}" class="text-gray-600 text-hover-primary mb-1">{{ $plot->plot_no }}</a>
                                                            </td>
                                                        @endif
                                                        <td>{{ $plot->name }}</td>
                                                        <td>{{ $plot->created_on }}</td>
                                                        <td>{{ $plot->amount }}</td>
                                                        <td>
                                                            @if (isset($lastPlotIds[$category->category]) && $plot->id === $lastPlotIds[$category->category])
                                                                {{-- <form action="{{ route('plot.delete', ['id' => $plot->id]) }}" method="POST"> --}}
                                                                <form action="#" method="POST">
                                                                    @csrf
                                                                        <button type="submit" class="btn btn-danger fw-semibold">Delete</button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>       
                                    </table>
                                    <!--end::Table-->
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Modals-->
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
		<script src="{{ URL::asset('assets/js/custom/apps/customers/list/export.js') }}"></script>
        <script src="{{ URL::asset('assets/js/custom/pages/listings/projects/plots.js') }}"></script>
		<script src="{{ URL::asset('assets/js/widgets.bundle.js') }}"></script>
        <script src="{{ URL::asset('assets/js/custom/widgets.js') }}"></script>
        <script src="{{ URL::asset('assets/js/custom/apps/chat/chat.js') }}"></script>
        <script src="{{ URL::asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
        <script src="{{ URL::asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
        <script src="{{ URL::asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
		<!--end::Custom Javascript-->
@endpush