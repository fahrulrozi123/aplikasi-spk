<table>
    <thead>
    <tr>
        <td style="text-align: center; font-weight: bold;" colspan="8">INQUIRY RESERVATION</td>
    </tr>
    <tr>
        <th style="width:20px">Reservation Number</th>
        <th style="width:20px">Customer Name</th>
        <th style="width:20px">Customer Email</th>
        <th style="width:20px">Inquiry Type</th>
        <th style="width:20px">Package</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($inquiry as $item)
        <tr>
            @php

                $inquiry_type = $item['inq_type'];

                switch ($inquiry_type) {
                    case '0':
                        $type = "General";
                        break;
                    case '1':
                        $type = "Recreational";
                        break;
                    case '2':
                        $type = "Spa";
                        break;
                    case '3':
                        $type = "Mice";
                        break;
                    case '4':
                        $type = "Wedding";
                        break;
                    default:
                        break;
                }

            @endphp
            <td>{{ $item['reservation_id'] }}</td>
            <td>{{ $item['inq_cust_name'] }}</td>
            <td>{{ $item['cust_email'] }}</td>
            <td>{{ $type }}</td>
            <td>{{ $item['product_name'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
