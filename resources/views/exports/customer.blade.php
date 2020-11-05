<table>
    <thead>
    <tr>
        <td style="text-align: center; font-weight: bold;" colspan="8">ALL REGISTERED CUSTOMER</td>
    </tr>
    <tr>
        <th style="width:30px">Latest Registered Names</th>
        <th style="width:20px">Email</th>
        <th style="width:20px">Phone Number</th>
        <th style="width:30px">Total Reservation Made</th>
        <th style="width:30px">Latest Reservation Date</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($customer as $item)
        <tr>
            <td>{{ $item['last_register_name'] }}</td>
            <td>{{ $item['cust_email'] }}</td>
            <td>{{ $item['last_phone_number'] }}</td>
            <td>{{ $item['total_reservation'] }}</td>
            <td>{{ $item['last_reserve'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
