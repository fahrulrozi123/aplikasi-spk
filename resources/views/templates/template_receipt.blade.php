<!DOCTYPE html>
<html lang="en">

<head>
    <title>Receipt Booking - Booking Engine</title>
    <style>
        @page {
            margin-bottom: -100;
            size: letter;
            /*or width x height 150mm 50mm*/
        }

        .font-voucher {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .fs-10 {
            font-size: 10px;
        }

        .fs-11 {
            font-size: 11px;
        }

        .fs-12 {
            font-size: 12px;
        }

        .fs-13 {
            font-size: 13px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .horison-dark {
            color: #1E1E1E
        }

        .horison-dark-2 {
            color: #323639
        }

        .mt-min10 {
            margin-top: -10px;
        }

        .mt-min25 {
            margin-top: -25px;
        }

        .mb-12 {
            margin-bottom: 12px;
        }

        .th-purchase {
            border: 1px solid black;
            background-color: #DAF2FC;
            vertical-align: middle;
            text-align: center;
            height: 7%;
        }

        .td-purchase {
            border: 1px solid black;
            font-size: 11px;
        }

        .indent-reserve {
            /* padding-left: 25px; */
            text-indent: -10px;
        }

        /* table,
        th,
        td {
            border: 1px solid black;
        } */

    </style>

</head>
@php
if ($data->rsvp_guest_name == '') {
    $guest_name = $data->rsvp_cust_name;
} else {
    $guest_name = $data->rsvp_guest_name;
}

if ($data->from == 'ROOMS') {
    // dd($data);
    $room_ppu = $data->rsvp_total_amount_room / $data->total_stay / $data->rsvp_total_room;
    $room_ppu = floor($room_ppu);

    if ($data->rsvp_total_amount_extrabed != 0) {
        $room_rate = ($room_ppu * ($data->rsvp_grand_total - ($room_ppu + $data->rsvp->rsvp_extrabed_rate))) / ($room_ppu + $data->rsvp->rsvp_extrabed_rate);
    } else {
        $room_rate = ($room_ppu * ($data->rsvp_grand_total - $room_ppu)) / $room_ppu;
    }

    $original_rate = ($room_ppu + $room_rate) / $data->rsvp_total_room;
    $total_rate = $original_rate * $data->rsvp_total_room;

    $grand_total = $data->rsvp_total_amount_room;

    if ($data->rsvp_total_extrabed > 0) {
        $extrabed_ppu = $data->rsvp_total_amount_extrabed / $data->total_stay / $data->rsvp_total_extrabed;
        $extrabed_ppu = floor($extrabed_ppu);

        $extra_rate = ($extrabed_ppu * ($data->rsvp_grand_total - ($room_ppu + $extrabed_ppu))) / ($room_ppu + $extrabed_ppu);

        $extrabed_rate = ($extrabed_ppu + $extra_rate) / $data->rsvp_total_extrabed;
        $total_extrabed_rate = $extrabed_ppu + $extra_rate;

        $grand_total += $data->rsvp_total_amount_extrabed;
    }
} elseif ($data->from == 'PRODUCTS') {
    $price_pax = $data->rsvp_pax_price + $data->rsvp_tax_total / $data->rsvp_amount_pax;
    $total_price_pax = $price_pax * $data->rsvp_amount_pax;
    $grand_total = $data->rsvp_total_amount;
}
@endphp

<body class="page-body">
    <div class="col-lg-12">

        <div class="container">
            <div class="panel panel-gradient" style="margin-bottom: 100px;">
                <!-- panel body -->
                <div class="panel-body">
                    {{-- Header --}}
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <img src="{{ asset('/images/logo/logo.jpg') }}" width="210" alt="Booking Engine">
                            <h3 class="font-voucher horison-dark" style="margin-top: -65px; margin-left: 240px;">
                                <b>RECEIPT</b><br>
                                #{{ $data->payment->transaction_id }}
                            </h3>
                        </div>
                    </div>

                    <hr class="mt-min10">

                    {{-- Customer Details --}}
                    <br>
                    <div class="row">
                        <table width="100%" class="font-voucher fs-13 horison-dark">
                            <tr>
                                <td colspan="2" style="height: 3%; vertical-align:top;"><b>CUSTOMER DETAILS</b></td>
                                <td colspan="2" style="vertical-align:top;"><b>PAYMENT DETAILS</b></td>
                            </tr>
                            <tr>
                                <td style="width: 110px; vertical-align:top;">Name</td>
                                <td style="width: 230px; vertical-align:top;">: {{ $data->rsvp_cust_name }}</td>
                                <td style="width: 140px; vertical-align:top;">Payment Date</td>
                                <td class="indent-reserve" style="vertical-align:top;">:
                                    {{ $data->payment->transaction_time }}</td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">E-mail</td>
                                @if ($data->from == 'ROOMS')
                                    <td style="vertical-align:top;">: {{ $data->customer->cust_email }}</td>
                                @elseif($data->from == 'PRODUCTS')
                                    <td style="vertical-align:top;">: {{ $data['customer']->cust_email }}</td>
                                @endif
                                <td style="vertical-align:top;">Payment Method</td>
                                <td class="indent-reserve" style="vertical-align:top;">:
                                    {{ $data->payment->payment_type }}</td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">Contact Number</td>
                                <td style="vertical-align:top;">: +{{ $data->rsvp_cust_phone }}</td>
                                <td style="vertical-align:top;">Reservation Number</td>
                                <td class="indent-reserve" style="vertical-align:top;">: {{ $data->reservation_id }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br><br>

                    {{-- Guest --}}
                    <div class="row">
                        <table class="font-voucher fs-13 horison-dark">
                            <tr>
                                <td style="width:50px; height:3%; vertical-align:top;"><b>GUEST</b></td>
                            </tr>
                            <tr>
                                <td style="width:500px; vertical-align:top;">
                                    <span style="font-size: 12px;"><b>{{ $guest_name }}</b></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>

                    {{-- Booking Details --}}
                    <div class="row">
                        <table class="font-voucher fs-13 horison-dark">
                            <tr>
                                <td style="width:50px; height:3%; vertical-align:top;"><b>BOOKING DETAILS</b></td>
                            </tr>
                            <tr>
                                <td style="width:365px; vertical-align:top;">
                                    @if ($data->from == 'ROOMS')
                                        <span style="font-size: 11px;"><b>{{ $data->room->room_name }}</b></span>
                                    @elseif($data->from == 'PRODUCTS')
                                        <span
                                            style="font-size: 11px;"><b>{{ $data['product']->product_name }}</b></span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <table width="100%" class="font-voucher fs-13 horison-dark">
                            <tr>
                                @if ($data->from == 'ROOMS')
                                    <td style="width:10px; vertical-align:top;">
                                        <span style="font-size: 11px;">Check-in</span>
                                    </td>
                                    <td style="width:300px; vertical-align:top;">
                                        <span style="font-size: 11px;">: {{ $data->rsvp_checkin }}</span>
                                    </td>
                                @elseif($data->from == 'PRODUCTS')
                                    <td style="width:10px; vertical-align:top;">
                                        <span style="font-size: 11px;">Date</span>
                                    </td>
                                    <td style="width:300px; vertical-align:top;">
                                        <span style="font-size: 11px;">: {{ $data->rsvp_date_reserve }}</span>
                                    </td>
                                @endif
                            </tr>
                            @if ($data->from == 'ROOMS')
                                <tr>
                                    <td style="vertical-align:top;">
                                        <span style="font-size: 11px;">Duration</span>
                                    </td>
                                    <td style="vertical-align:top;">
                                        <span style="font-size: 11px;">: {{ $data->total_stay }} night(s)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:top;">
                                        <span style="font-size: 11px;">Breakfast</span>
                                    </td>
                                    <td style="vertical-align:top;">
                                        <span style="font-size: 11px;">:
                                            {{ $data->rsvp_breakfast == 1 ? 'Yes' : 'No' }}</span>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <br>

                    {{-- Purchase Details --}}
                    <div class="row">
                        <p class="font-voucher fs-14 horison-dark"><b>PURCHASE DETAILS</b></p>
                        <table width="100%" class="font-voucher fs-12 horison-dark" style="border-collapse: collapse;">
                            <tr>
                                <td class="th-purchase" style="width:5%;"><b>No.</b></td>
                                <th class="th-purchase" style="width:20%;"><b>Type of Item</b></th>
                                <th class="th-purchase" style="width:25%;"><b>Item Description</b></th>
                                @if ($data->from == 'ROOMS')
                                    <th class="th-purchase" style="width:5%;"><b>Qty</b></th>
                                    <th class="th-purchase" style="width:5%;"><b>Night</b></th>
                                @elseif($data->from == 'PRODUCTS')
                                    <th class="th-purchase" style="width:10%;"><b>Qty</b></th>
                                @endif
                                <th class="th-purchase" style="width:20%;"><b>Price per Unit (Rp)</b></th>
                                <th class="th-purchase" style="width:20%;"><b>Total (Rp)</b></th>
                            </tr>
                            <tr>
                                @if ($data->from == 'ROOMS')
                                    <td class="td-purchase" style="width:5%; height:4%; text-align:center;">1.</td>
                                    <td class="td-purchase" style="width:20%; text-align:center;">
                                        <b>Accommodation</b>
                                    </td>
                                    <td class="td-purchase" style="width:25%;text-align:center;">
                                        {{ $data->room->room_name }} - {{ $data->rsvp_adult + $data->rsvp_child }}
                                        Guest(s)</td>
                                    <td class="td-purchase" style="width:5%; text-align:center;">
                                        {{ $data->rsvp_total_room }}</td>
                                    <td class="td-purchase" style="width:5%; text-align:center;">
                                        {{ $data->total_stay }}</td>
                                    <td class="td-purchase" style="width:20%; text-align:right;">
                                        {{ number_format($original_rate, 2, ',', '.') }}</td>
                                    <td class="td-purchase" style="width:20%; text-align:right;">
                                        {{ number_format($total_rate, 2, ',', '.') }}</td>
                                @elseif($data->from == 'PRODUCTS')
                                    <td class="td-purchase" style="width:5%; height:4%; text-align:center;">1.</td>
                                    <td class="td-purchase" style="width:20%; text-align:center;">
                                        <b>{{ $data['product']->category }}</b>
                                    </td>
                                    <td class="td-purchase" style="width:25%;">
                                        {{ $data['product']->product_name }}
                                    </td>
                                    <td class="td-purchase" style="width:10%; text-align:center;">
                                        {{ $data->rsvp_amount_pax }} Pax</td>
                                    <td class="td-purchase" style="width:20%; text-align:right;">
                                        {{ number_format($price_pax, 2, ',', '.') }}</td>
                                    <td class="td-purchase" style="width:20%; text-align:right;">
                                        {{ number_format($total_price_pax, 2, ',', '.') }}</td>
                                @endif

                            </tr>
                            @if ($data->from == 'ROOMS' && $data->rsvp_total_extrabed > 0)
                                <tr>
                                    <td class="td-purchase" style="width:5%; height:4%; text-align:center;">2</td>
                                    <td class="td-purchase" style="width:20%; text-align:center;"><b>Extra Bed</b>
                                    </td>
                                    <td class="td-purchase" style="width:20%; text-align:center;">Extra Bed</td>
                                    <td class="td-purchase" style="width:5%; text-align:center;">
                                        {{ $data->rsvp_total_extrabed }}</td>
                                    <td class="td-purchase" style="width:5%; text-align:center;">
                                        {{ $data->total_stay }}</td>
                                    <td class="td-purchase" style="width:20%; text-align:right;">
                                        {{ number_format($extrabed_rate, 2, ',', '.') }}</td>
                                    <td class="td-purchase" style="width:20%; text-align:right;">
                                        {{ number_format($total_extrabed_rate, 2, ',', '.') }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td style="width:5%; height:4%; text-align:center;"></td>
                                <td style="width:20%; text-align:center;"><b></b></td>
                                <td style="width:25%;"></td>
                                @if ($data->from == 'ROOMS')
                                    <td style="width:5%; text-align:center;"></td>
                                    <td style="width:5%; text-align:center;"></td>
                                @elseif($data->from == 'PRODUCTS')
                                    <td style="width:10%; text-align:center;"></td>
                                @endif
                                <td class="td-purchase"
                                    style="width:20%; text-align:left; font-size:12px !important;">TOTAL</td>
                                <td class="td-purchase" style="width:20%; text-align:right;">
                                    {{ number_format($data->rsvp_grand_total, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td style="width:5%; height:4%; text-align:center;"></td>
                                <td style="width:20%; text-align:center;"><b></b></td>
                                <td style="width:25%;"></td>
                                @if ($data->from == 'ROOMS')
                                    <td style="width:5%; text-align:center;"></td>
                                    <td style="width:5%; text-align:center;"></td>
                                @elseif($data->from == 'PRODUCTS')
                                    <td style="width:10%; text-align:center;"></td>
                                @endif
                                <td class="td-purchase"
                                    style="width:20%; text-align:left; font-size:12px !important;">PAYMENT AMOUNT</td>
                                <td class="td-purchase" style="width:20%; text-align:right;">
                                    {{ number_format($data->rsvp_grand_total, 2, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                    <br>

                    {{-- Contact --}}
                    <div class="row" style="position: absolute; bottom: 45px;">
                        <hr>
                        <table class="font-voucher fs-11 horison-dark;">
                            <tr>
                                <td style="width:345px; vertical-align: top; text-align: center;"><b><i>Customer
                                            Services
                                            Email</i></b></td>
                                <td style="width:345px; vertical-align: top; text-align: center;"><b><i>Customer
                                            Services</i></b></td>
                            </tr>
                            <tr>
                                <td
                                    style="height: 3%; vertical-align: middle; text-align: center; padding-bottom: 10px;">
                                    <span><img src="{{ asset('/images/utility/mail.jpg') }}" width="10"
                                            style="margin-right: 3px;"> {{ $setting->email }}</span>
                                </td>
                                <td
                                    style="height: 3%; vertical-align: middle; text-align: center; padding-bottom: 10px;">
                                    <span><img src="{{ asset('/images/utility/phone.jpg') }}" width="10"
                                            style="margin-right: 3px;"> {{ $setting->phone }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
