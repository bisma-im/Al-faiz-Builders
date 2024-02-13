@extends('layouts.dashboardlayout')
@section('content')
@php
$fileTypeImages = [
    'pdf' => 'assets/media/svg/files/pdf.svg',
    'doc' => 'assets/media/svg/files/doc.svg',
    'docx' => 'assets/media/svg/files/doc.svg',
    'ai' => 'assets/media/svg/files/ai.svg',
    'sql' => 'assets/media/svg/files/sql.svg',
    'xlsx' => 'assets/media/svg/files/xlsx.png',
    'csv' => 'assets/media/svg/files/xlsx.png',
    'tif' => 'assets/media/svg/files/tif.svg',
    'xml' => 'assets/media/svg/files/xml.svg',
];
@endphp
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">My Documents</h1>
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
                        <li class="breadcrumb-item text-muted">User Profile</li>
                        <!--end::Item-->
                    </ul>
                    
                    <!--end::Breadcrumb-->
                </div>
                <!--begin::Controls-->
                <div class="d-flex my-2">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative me-4">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" id="kt_filter_search" class="form-control form-control-sm border-body bg-body w-150px ps-10" placeholder="Search" />
                    </div>
                    <!--end::Search-->
                    <a href="../../demo1/dist/apps/file-manager/files.html" class="btn btn-primary btn-sm">File Manager</a>
                </div>
                <!--end::Controls-->
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Row-->
                <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                    @foreach ($documents as $document)
                    <!--begin::Col-->
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card body-->
                            <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                <!--begin::Name-->
                                <a href="{{ route('downloadDocument', $document) }}" class="text-gray-800 text-hover-primary d-flex flex-column">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-60px mb-5">
                                        @php
                                            // Determine the file extension, assuming you have a filename
                                            $extension = strtolower(pathinfo($document, PATHINFO_EXTENSION));
                                            $imagePath = $fileTypeImages[$extension] ?? 'assets/media/svg/files/upload.svg'; // Fallback to a default image
                                        @endphp
                                        <img src="{{ asset($imagePath) }}" class="theme-light-show" alt="Document" />
                                        <img src="{{ asset($imagePath) }}" class="theme-dark-show" alt="Document" />
                                    </div>
                                    <!--end::Image-->
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">{{ $document }}</div>
                                    <!--end::Title-->
                                </a>
                                <!--end::Name-->
                                <!--begin::Description-->
                                <div class="fs-7 fw-semibold text-gray-400">2 weeks ago</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->
                    @endforeach
                </div>
                <!--end:Row-->
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
@endpush