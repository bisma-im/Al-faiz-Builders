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
        <td>{{ $booking->cnic_number }}</td>
        <td>{{ $booking->mobile_number_1 }}</td>
        <td>{{ $booking->project_title }}</td>
        <td>{{ $booking->plot_no }}</td>
        {{-- <td data-filter="mastercard"> --}}
        <td>{{ $booking->received_amount }}</td>
        <td>{{ $booking->pending_amount }}</td>
    </tr>                      
@endforeach