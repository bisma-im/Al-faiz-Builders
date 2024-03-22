@foreach ($voucherData as $id => $voucher)
    <tr>
        <td>
            <div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1" />
            </div>
        </td>
        <td>
            <a href="#" class="text-gray-600 text-hover-primary mb-1" data-bs-toggle="modal" data-bs-target="#kt_modal_show_voucher" data-voucher-id="{{ $voucher->voucher_id }}" data-voucher-type="{{ $voucher->voucher_type }}">{{ $voucher->voucher_id }}</a>
        </td>
        <td>{{ $voucher->voucher_type }}</td>
        <td>{{ $voucher->description }}</td>
        <td>{{ $voucher->date }}</td>
        {{-- <td data-filter="mastercard"> --}}
        <td>{{ $voucher->debit_amount }}</td>
        <td>{{ $voucher->added_by }}</td>
        <td class="text-end">
            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ route('downloadVoucher', ['voucher_id' => $voucher->voucher_id]) }}" class="menu-link px-3">Download</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </td>
    </tr>
@endforeach