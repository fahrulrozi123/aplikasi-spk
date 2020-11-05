<table>
    <thead>
    <tr>
        <td style="text-align: center; font-weight: bold;" colspan="8">ALL PACKAGE/PRODUCT RESERVATION</td>
    </tr>
    <tr>
        <th style="width:20px">Reservation Number</th>
        <th style="width:20px">Customer Name</th>
        <th style="width:20px">Reserved Rooms</th>
        <th style="width:20px">Checked In</th>
        <th style="width:20px">Checked Out</th>
        <th style="width:20px">Status</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($rsvp as $item)
        <tr>
            @php
                $checkout = \Carbon\Carbon::parse($item['rsvp_checkout']);
                $checkin = \Carbon\Carbon::parse($item['rsvp_checkin']);
            @endphp
            <td>{{ $item['reservation_id'] }}</td>
            <td>{{ $item['rsvp_cust_name'] }}</td>
            <td>{{ $item['rsvp_reserved_room'] }}</td>
            <td>{{ $checkin->format('d F y') }}</td>
            <td>{{ $checkout->format('d F y') }}</td>
            <td>{{ $item['rsvp_status'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
