@foreach ($bookingData as $id => $booking)
    <tr id="{{ $booking->id }}">
        <td>
            <div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" value="1" />
            </div>
        </td>
        <td>
            <a href="{{ route('updateBookingForm', ['id' => $booking->id]) }}" class="text-gray-600 text-hover-primary mb-1">{{ $booking->name }}</a>
        </td>
        <td>{{ $booking->mobile_number_1 }}</td>
        <td>{{ $booking->project_title }}</td>
        <td>{{ $booking->plot_no }}</td>
        {{-- <td data-filter="mastercard"> --}}
        <td>{{ $booking->received_amount }}</td>
        <td>{{ $booking->pending_amount }}</td>
        <td class="text-end">
            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="#" class="menu-link px-3">View</a>
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