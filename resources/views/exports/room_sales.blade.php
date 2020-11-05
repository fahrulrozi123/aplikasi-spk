<table>
    <thead>
    <tr>
        <td style="text-align: center;font-weight: bold;" colspan="7">ROOM SALES</td>
    </tr>
    <tr>
        <th style="width:20px">Room Type</th>
        <th style="width:10px">Sold</th>
        <th style="width:20px">Average Rate</th>
        <th style="width:20px">Room Revenue</th>
        <th style="width:20px">Tax Collected</th>
        <th style="width:20px">Services Collected</th>
        <th style="width:20px">Nett Sales</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($room as $item)
        <tr>
            <td>{{ $item['room_type'] }}</td>
            <td>{{ number_format($item['total_room_sales'] ?: 0,0,',','.') }}</td>
            <td>{{ 'Rp. ' . number_format($item['average_rate'] ?: 0,2,',','.') }}</td>
            <td>{{ 'Rp. ' . number_format($item['room_revenue'] ?: 0,2,',','.') }}</td>
            <td>{{ 'Rp. ' . number_format($item['tax_collected'] ?: 0,2,',','.') }}</td>
            <td>{{ 'Rp. ' . number_format($item['service_collected'] ?: 0,2,',','.') }}</td>
            <td>{{ 'Rp. ' . number_format($item['nett_sales'] ?: 0,2,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<table>
    <thead>
    <tr>
        <td style="text-align: center; font-weight: bold;" colspan="8">ALL ROOM RESERVATION</td>
    </tr>
    <tr>
        <th style="width:20px">Check In</th>
        <th style="width:20px">Check Out</th>
        <th style="width:20px">Reserved Rooms</th>
        <th style="width:20px">ADR</th>
        <th style="width:20px">Room Revenue</th>
        <th style="width:20px">Tax Collected</th>
        <th style="width:20px">Service Collected</th>
        <th style="width:25px">Nett Sales</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($rsvp as $item)
        <tr>
            @php
                $checkout = \Carbon\Carbon::parse($item['rsvp_checkout']);
                $checkin = \Carbon\Carbon::parse($item['rsvp_checkin']);
                $totalStay = $checkout->diffInDays($checkin);
                $ADR = floor($item['rsvp_grand_total'] / $totalStay);
                $nett_sales = $item['rsvp_grand_total'] - $item['rsvp_tax'] - $item['rsvp_service'];
            @endphp
            <td>{{ $checkin->format('d F y') }}</td>
            <td>{{ $checkout->format('d F y') }}</td>
            <td>{{ $item['rsvp_reserved_room'] }}</td>
            <td>{{ 'Rp. ' . number_format($ADR ?: 0,2,',','.') }}</td>
            <td>{{ 'Rp. ' . number_format($item['rsvp_grand_total'] ?: 0,2,',','.') }}</td>
            <td>{{ 'Rp. ' . number_format($item['rsvp_tax'] ?: 0,2,',','.') }}</td>
            <td>{{ 'Rp. ' . number_format($item['rsvp_service'] ?: 0,2,',','.') }}</td>
            <td>{{ 'Rp. ' . number_format($nett_sales ?: 0,2,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
