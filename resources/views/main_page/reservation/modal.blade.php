<div class="modal " id="modal-1" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header mh-horison">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                    style="margin-right:10px; margin-top:-15px;">
                    ×
                </button>
                <h4 class="modal-title col-lg-6">Basic Modal</h4>
            </div>

            <form method="POST" action="{{ route('reservation.refund_reschedule') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="general_cust-detail">
                        <div class="modal-rsvp">
                            <center>General</center>
                        </div>

                        <div class="row">
                            {{-- general room --}}
                            <div class="col-lg-12 room">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th class="col-lg-3 col-sm-12">
                                                <strong>Reservation Number</strong>
                                            </th>
                                            <th class="col-lg-3 col-sm-12">
                                                <strong>Booking ID</strong>
                                            </th>
                                            <th class="col-lg-3 col-sm-12">
                                                <strong>Reserved Date</strong>
                                            </th>
                                            <th class="col-lg-3 col-sm-12">
                                                <strong>Check In</strong>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="reservation_id">01/RSV/DLXB/XII/19</td>
                                            <td id="booking_id">c725a2f36807490a</td>
                                            <td id="reservation_date">1 December 2019 8:47 AM</td>
                                            <td id="room_checkin">Thursday, 19 December 2019</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th class="col-lg-3">
                                                <strong>Check Out</strong>
                                            </th>
                                            <th class="col-lg-3">
                                                <strong>Room Type Reserved</strong>
                                            </th>
                                            <th class="col-lg-3">
                                                <strong>Accommodation</strong>
                                            </th>
                                            <th class="col-lg-3">
                                                <strong>Breakfast</strong>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="room_checkout">Saturday, 21 December 2019</td>
                                            <td id="room_type_reserved">2x Deluxe Business</td>
                                            <td id="room_accommodation">1 December 2019 8:47 AM</td>
                                            <td id="room_breakfast">Thursday, 19 December 2019</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th class="col-lg-3">
                                                <strong>Additional Extra Bed</strong>
                                            </th>
                                            <th class="col-lg-3">
                                                <strong>Additional Description</strong>
                                            </th>
                                            <th class="col-lg-3"></th>
                                            <th class="col-lg-3"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="room_extrabed">Saturday, 21 December 2019</td>
                                            <td id="special_request">Room with visible mountain view and near breakfast
                                                place</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- tutup general room --}}

                            {{-- general online --}}
                            <div class="packageon">
                                <div class="col-lg-12 ">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Reservation Number</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Booking ID</strong>
                                                </th>
                                                <th class="col-lg-6">
                                                    <strong>Date</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="online_rsvp_number">01/RSV/DLXB/XII/19</td>
                                                <td id="online_booking_id">e0f0c383e3ec8da7</td>
                                                <td id="online_rsvp_date">Thursday, 19 December 2019</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-lg-12"></div>

                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Reserved Package / Product</strong>
                                                </th>
                                                <th class="col-lg-9">
                                                    <strong>Package / Product Amount</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="online_rsvp_product_name">Allysea Package</td>
                                                <td id="online_rsvp_pax">5 Pax</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-5">
                                                    <strong>Additional Description</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="product_special_request">Room with visible mountain view and
                                                    near breakfast place</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- Tutup general online --}}
                        </div>
                        <br>

                        <div class="modal-rsvp">
                            <center>Customer Details</center>
                        </div>
                        <div class="row">
                            {{-- customer detail room --}}
                            <div class="room">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Customer Name</strong>
                                                </th>
                                                {{-- <th class="col-lg-3"><strong>Customer Identification
                                                        Number</strong></th> --}}
                                                <th class="col-lg-3">
                                                    <strong>Guest Name</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Customer Phone Number</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Customer E-mail</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3" id="customer_name">Arlene Wilson</td>
                                                {{-- <td class="col-lg-3" id="customer_id">KTP/4012336593085502</td> --}}
                                                <td class="col-lg-3" id="guest_name">Darlene Flores</td>
                                                <td class="col-lg-3" id="customer_phone">(207) 555-0119</td>
                                                <td class="col-lg-3" id="customer_email">
                                                    donald.phillips@example.com
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3"><strong>Guest Name</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="guest_name">Darlene Flores</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> --}}
                            </div>
                            {{-- tutup customer detail room --}}

                            {{-- customer detail package online --}}
                            <div class="packageon">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-4">
                                                    <strong>Customer Name</strong>
                                                </th>
                                                {{-- <th class="col-lg-3"><strong>Customer Identification
                                                        Number</strong></th> --}}
                                                <th class="col-lg-4">
                                                    <strong>Customer Phone Number</strong>
                                                </th>
                                                <th class="col-lg-4">
                                                    <strong>Customer E-mail</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td id="online_cust_name">Arlene Grande</td>
                                                {{-- <td id="online_cust_id">KTP/4012336593085502</td> --}}
                                                <td id="online_cust_phone">(207) 555-0119</td>
                                                <td id="online_cust_email">donald.phillips@example.com</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- tutup customer detail package online --}}
                        </div>
                    </div>
                    <br>

                    <div class="payment-detail">
                        <div class="modal-rsvp ">
                            <center>Booking Details</center>
                        </div>
                        <div class="row">
                            {{-- payment detail room --}}
                            <div class="room">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Booking Price</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Payment Status</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Payment Date</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Paid Amount</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 " id="booking_price">Rp 0</td>
                                                <td class="" id="payment_status">Payment Received
                                                    via Credit Card Payment</td>
                                                <td class="col-lg-3" id="payment_date">1 December 2019 9:12 AM
                                                </td>
                                                <td class="col-lg-3 " id="paid_amount">Rp 0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- penutup payment detail room --}}
                            {{-- payment detail package online --}}
                            <div class="packageon">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Booking Price</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Payment Status</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Payment Date</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Paid Amount</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3" id="product_booking_price">Rp 0</td>
                                                <td class="" id="product_payment_status">Payment Received
                                                    via Credit Card Payment</td>
                                                <td class="col-lg-3" id="product_payment_date">18 December 2019
                                                    9:12 AM
                                                </td>
                                                <td class="col-lg-3" id="product_paid_amount">Rp 0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- penutup payment detail package online --}}
                        </div>
                    </div>
                    {{-- ISI MODAL INQUIRY START HERE --}}
                    <div class="inquiry-detail">
                        <div class="modal-rsvp ">
                            <center>Inquiry Details</center>
                        </div>
                        <div class="row">
                            {{-- inquiry details / GENERAL --}}
                            <div class="inquiry-general">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Number</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Type</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Inquired At</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_number">0001/INQ/GI/XXI/19</td>
                                                <td class="col-lg-3 inq_type">General Inquiry</td>
                                                <td class="col-lg-3 inq_at">Thursday, 19 December 2019</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3"><strong>Inquiry Description</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_desc">Kalo untuk 20 orang aja bisa ga ya</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- penutup inquiry details / GENERAL --}}
                            {{-- inquiry details / RECREATIONAL --}}
                            <div class="inquiry-recreational">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Number</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Type</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Inquired At</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_number">0001/INQ/GI/XXI/19</td>
                                                <td class="col-lg-3 inq_type">General Inquiry</td>
                                                <td class="col-lg-3 inq_at">Thursday, 19 December 2019</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Package Inquired</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Participant</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Arrival Date</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_product">Table Manner Package</td>
                                                <td class="col-lg-3 inq_participant" id="">100</td>
                                                <td class="col-lg-3 inq_date">Saturday, 01 January 2020</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless" id="other_recreational"
                                        style="display: none">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Other Request</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_recreational">
                                            <tr>
                                                <td class="col-lg-3">
                                                    <li>Accommodation</li>
                                                </td>
                                                <td class="col-lg-3">
                                                    <li>Swimming Pool Access</li>
                                                </td>
                                                <td class="col-lg-3">
                                                    <li>Wedding Ceremony</li>
                                                </td>
                                                <td class="col-lg-3">
                                                    <li>Welcome Dinner</li>
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Description</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_desc">Kalo untuk 20 orang aja bisa ga ya</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- penutup inquiry details / RECREATIONAL --}}
                            {{-- inquiry details / WEDDING --}}
                            <div class="inquiry-wedding">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Number</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Type</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Inquired At</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_number">0001/INQ/GI/XXI/19</td>
                                                <td class="col-lg-3 inq_type">General Inquiry</td>
                                                <td class="col-lg-3 inq_at">Thursday, 19 December 2019</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Package Inquired</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Services Request</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Number of Guest</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_product">Premium Wedding</td>
                                                <td class="col-lg-3 inq_event_name" id="">Information</td>
                                                <td class="col-lg-3 inq_participant" id="">1.000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless" id="other_wedding" style="display: none">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Other Request</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_wedding">
                                            <tr>
                                                <td class="col-lg-3" id="">
                                                    <li>Accommodation</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Swimming Pool Access</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Wedding Ceremony</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Welcome Dinner</li>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3" id="">
                                                    <li>Dinner</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Lunch</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Dinner Reception</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Flowers</li>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3" id="">
                                                    <li>Breakfast</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Leisure Activity</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>After Wedding Brunch</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Videography</li>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Description</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_desc" id="">Kalo untuk 20 orang aja bisa ga ya
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- penutup inquiry details / WEDDING --}}
                            {{-- inquiry details / MICE 1 --}}
                            <div class="inquiry-mice-1">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Number</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Type</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Inquired At</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3" id="">0001/INQ/GI/XXI/19</td>
                                                <td class="col-lg-3" id="">General Inquiry</td>
                                                <td class="col-lg-3" id="">Thursday, 19 December 2019</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Package/Product Inquired</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3" id="">Residential Package</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Event Date</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Alternate Event Date</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong></strong>
                                                </th>
                                                {{-- jangan di delete, ini
                                                biar positionnya rapih --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3" id="">Saturday, 01 January 2020</td>
                                                <td class="col-lg-3" id="">Sunday, 02 January 2020</td>
                                                <td class="col-lg-3" id=""></td> {{-- jangan di delete, ini biar
                                                positionnya rapih --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Other Request</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3" id="">
                                                    <li>Accommodation</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Swimming Pool Access</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Wedding Ceremony</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Welcome Dinner</li>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3" id="">
                                                    <li>Dinner</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Lunch</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Dinner Reception</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Flowers</li>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3" id="">
                                                    <li>Breakfast</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Leisure Activity</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>After Wedding Brunch</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Videography</li>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Description</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3" id="">Kalo untuk 20 orang aja bisa ga ya
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- penutup inquiry details / MICE 1 --}}
                            {{-- inquiry details / MICE 2 --}}
                            <div class="inquiry-mice-2">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Number</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Type</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Inquired At</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_number">0001/INQ/GI/XXI/19</td>
                                                <td class="col-lg-3 inq_type">General Inquiry</td>
                                                <td class="col-lg-3 inq_at">Thursday, 19 December 2019</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Event Name</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Participant</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Prefered Function Room</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_event_name">Star Galaxy 2020</td>
                                                <td class="col-lg-3 inq_participant">50</td>
                                                <td class="col-lg-3 inq_function_room">Subagdja Ballroom I</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Event Date</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Alternate Event Date</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Event Type</strong>
                                                </th>
                                                {{-- jangan di
                                                delete, ini biar positionnya rapih / OKE SIAP --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_date">Saturday, 01 January 2020</td>
                                                <td class="col-lg-3 inq_alt_date">Sunday, 02 January 2020</td>
                                                <td class="col-lg-3 inq_event_type">-</td> {{-- jangan di delete, ini
                                                biar positionnya rapih / OKE SIAP --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless" id="other_mice" style="display: none">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Other Request</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_mice">
                                            <tr>
                                                <td class="col-lg-3" id="">
                                                    <li>Accommodation</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Swimming Pool Access</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Wedding Ceremony</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Welcome Dinner</li>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3" id="">
                                                    <li>Dinner</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Lunch</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Dinner Reception</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Flowers</li>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-lg-3" id="">
                                                    <li>Breakfast</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Leisure Activity</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>After Wedding Brunch</li>
                                                </td>
                                                <td class="col-lg-3" id="">
                                                    <li>Videography</li>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Inquiry Description</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_desc">Kalo untuk 20 orang aja bisa ga ya</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- penutup inquiry details / MICE 2 --}}
                        </div>
                        <div class="modal-rsvp ">
                            <center>Customer Details</center>
                        </div>
                        <div class="row">
                            {{-- inquiry customer details --}}
                            <div class="inquiry-custdetail">
                                <div class="col-lg-12">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th class="col-lg-3">
                                                    <strong>Customer Name</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Customer E-mail</strong>
                                                </th>
                                                <th class="col-lg-3">
                                                    <strong>Customer Phone Number</strong>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-lg-3 inq_cust_name" id="">Arlene Wilson</td>
                                                <td class="col-lg-3 inq_cust_email" id="">arelenewilson17@gmail.com
                                                </td>
                                                <td class="col-lg-3 inq_cust_phone" id="">(319) 555-0115</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- penutup inquiry customer details --}}
                        </div>
                    </div>
                    {{-- BATAS SUCI ISI MODAL INQUIRY --}}
                </div>

                <div class="modal-footer" style="background-color: #F8F8F8;">
                    {{-- OPTION BUTTON AWAL --}}
                    <div class="row" id="room_cancel_reschedule_btn">
                        <div class="col-xs-6 col-md-6" align="left">
                            <span id="room_cancel_reschedule_left">
                                <button type="button" id="btn_cancel" onclick="show_room(1);"
                                    class="btn btn-link danger" style="height: 40px;">
                                    <b>Cancel</b>
                                </button>
                                <button type="button" id="btn_reschedule" onclick="show_room(2);"
                                    class="btn btn-link muted" style="height: 40px;">
                                    <b>Reschedule</b>
                                </button>
                            </span>
                        </div>
                        <div class="col-xs-6 col-md-6" align="right">
                            <span id="room_print_right">
                                <button type="button" id="btn_reschedule" onclick="resendEmail(this);"
                                    class="btn btn-horison-gold" style="height: 40px;">
                                    <b>Resend Voucher</b>
                                </button>
                                <button type="button" id="btn_reschedule" onclick="printVoucher();" target="_blank"
                                    class="btn btn-horison-gold" style="height: 40px;">
                                    <b>Print Voucher</b>
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="row" id="product_cancel_reschedule_btn">
                        <div class="col-xs-6 col-md-6" align="left">
                            <span id="product_cancel_reschedule_left">
                                <button type="button" id="btn_product_cancel" onclick="show_product(1);"
                                    class="btn btn-link danger" style="height: 40px;">
                                    <b>Cancel Booking</b>
                                </button>
                                <button type="button" id="btn_product_reschedule" onclick="show_product(2);"
                                    class="btn btn-horison-gold" style="height: 40px;">
                                    <b>Reschedule Booking</b>
                                </button>
                            </span>
                        </div>
                        <div class="col-xs-6 col-md-6" align="right">
                            <button type="button" id="btn_reschedule" onclick="resendEmail(this);"
                                class="btn btn-horison-gold" style="height: 40px;">
                                <b>Resend Voucher</b>
                            </button>
                            <button type="button" id="btn_reschedule" onclick="printVoucher();" target="_blank"
                                class="btn btn-horison-gold" style="height: 40px;">
                                <b>Print Voucher</b>
                            </button>
                        </div>
                    </div>
                    <br>

                    {{-- PUT Reservation Id --}}
                    <input type="hidden" id="modal_reservation_id" name="reservation_id">
                    {{-- PUT Reservation Booking Id --}}
                    <input type="hidden" id="modal_booking_id" name="booking_id">
                    {{-- PUT Reservation Id --}}
                    <input type="hidden" id="modal_reservation_from" name="reservation_from">
                    {{-- PUT Reservation Type --}}
                    <input type="hidden" id="modal_reservation_type" name="reservation_type">
                    {{-- PUT Reservation Email OPTIONAL --}}
                    <input type="hidden" id="modal_reservation_email" name="reservation_email">

                    {{-- TAMPILAN SAAT MEMILIH 'CANCEL BOOKING' --}}
                    <div id="cancel_booking_tab" style="display:none;">
                        <div class="row" align="left">
                            <p class="rsv-notice">Notice</p>
                            <ol id="two_day"></ol>
                        </div>

                        <div class="row">
                            <p class="rsv-box rsv-box-content">Cancellation Fee<br>
                                <span class="rsv-box-price" id="cancellation_fee">Rp 1.000.000</span>
                            </p>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-md-10" align="right">
                                <button type="button" onclick="show_room(3);" class="btn btn-white"
                                    style="height: 40px; width: 140px;">
                                    <b>Back</b>
                                </button>
                            </div>

                            <div class="col-xs-6 col-md-2" align="left">
                                <input type="button" name="btn_cancel" onclick="confirmBox(this);"
                                    class="danger btn btn-link" style="height: 40px; font-weight: bold;"
                                    value="Cancel Booking">
                            </div>
                        </div>
                    </div>

                    <div id="cancel_booking_package_tab" style="display:none;">
                        <div class="row" align="left">
                            <p class="rsv-notice">Notice</p>
                            <p class="rsv-point">1. <b>No sales</b> are counted from this reservation as this
                                reservation
                                is cancelled.</p>
                            <p class="rsv-point">2. This action cannot be undone.</p>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-md-10" align="right">
                                <button type="button" onclick="show_product(3);" class="btn btn-white"
                                    style="height: 40px; width: 140px;">
                                    <b>Back</b>
                                </button>
                            </div>
                            <div class="col-xs-6 col-md-2" align="left">
                                <input type="button" name="btn_cancel" onclick="confirmBox(this);"
                                    class="danger btn btn-link" style="height: 40px; font-weight: bold;"
                                    value="Cancel Booking">
                            </div>
                        </div>
                    </div>

                    {{-- TAMPILAN SAAT MEMILIH 'RESCHEDULE BOOKING' --}}
                    <div id="reschedule_booking_tab" style="display:none;">
                        <div class="row" align="left">
                            <p class="rsv-notice">Notice</p>
                            <p class="rsv-point">1. This will only mark the booking as rescheduled. NO automatic
                                refund/settlement made to the hotel by the payment provider will be affected.</p>
                            <p class="rsv-point">2. You’ll need to do reschedule manually.</p>
                            <p class="rsv-point">3. Allotment from this booking returned (if the date has not been
                                closed)</p>
                            <p class="rsv-point">4. <b>No Sales</b> are counted from this reservation as this
                                reservation is rescheduled.</p>
                            <p class="rsv-point">5. This action cannot be undone.</p>
                        </div>

                        <div class="row" style="margin-top:20px; margin-right:20px;">
                            <div class="col-xs-6 col-md-10" align="right">
                                <button type="button" onclick="show_room(3);" class="btn btn-white"
                                    style="height: 40px; width: 140px;">
                                    <b>Back</b>
                                </button>
                            </div>
                            <div class="col-xs-6 col-md-2" align="left">
                                <input type="button" name="btn_reschedule" onclick="confirmBox(this);"
                                    class="btn btn-horison-gold" style="height: 40px; font-weight: bold;"
                                    value="Reschedule Booking">
                            </div>
                        </div>
                    </div>

                    <div id="reschedule_booking_package_tab" style="display:none;">
                        <div class="row" align="left">
                            <p class="rsv-notice">Notice</p>
                            <p class="rsv-point">1. This will only mark the booking as rescheduled. NO automatic
                                refund/settlement made to the hotel by the payment provider will be affected.
                            </p>
                            <p class="rsv-point">2. You will need to make the rescheduled reservation manually.
                            </p>
                            <p class="rsv-point">3. <b>No Sales</b> are counted from this reservation as this
                                reservation is rescheduled.</p>
                            <p class="rsv-point">4. This action cannot be undone.</p>
                        </div>

                        <div class="row" style="margin-top:20px; margin-right:20px;">
                            <div class="col-xs-6 col-md-10" align="right">
                                <button type="button" onclick="show_product(3);" class="btn btn-white"
                                    style="height: 40px; width: 140px;">
                                    <b>Back</b>
                                </button>
                            </div>
                            <div class="col-xs-6 col-md-2" align="left">
                                <input type="button" name="btn_reschedule" onclick="confirmBox(this);"
                                    class="btn btn-horison-gold" style="height: 40px; font-weight: bold;"
                                    value="Reschedule Booking">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function show_room(n) {
        $('#room_cancel_reschedule_btn').fadeOut();
        if (n == 1) {
            $('#cancel_booking_tab').fadeIn();
            $('#reschedule_booking_tab').fadeOut();
        } else if (n == 2) {
            $('#reschedule_booking_tab').fadeIn();
            $('#cancel_booking_tab').fadeOut();
        } else if (n == 3) {
            $('#cancel_booking_tab').fadeOut();
            $('#reschedule_booking_tab').fadeOut();
            $('#room_cancel_reschedule_btn').fadeIn();
        }
    }

    function show_product(n) {
        $('#product_cancel_reschedule_btn').fadeOut();
        if (n == 1) {
            $('#cancel_booking_package_tab').fadeIn();
            $('#reschedule_booking_package_tab').fadeOut();
        } else if (n == 2) {
            $('#reschedule_booking_package_tab').fadeIn();
            $('#cancel_booking_package_tab').fadeOut();
        } else if (n == 3) {
            $('#cancel_booking_package_tab').fadeOut();
            $('#reschedule_booking_package_tab').fadeOut();
            $('#product_cancel_reschedule_btn').fadeIn();
        }
    }

    function confirmBox(e) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This is cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
                e.setAttribute('type', 'submit');
                e.setAttribute('onclick', '');
                e.click();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Operation Cancel!',
                    'error'
                )
            }
        })
    }

    function resendEmail(e) {
        var reservation_id = $('#modal_reservation_id').val();
        (async () => {
            const {
                value: formValues
            } = await Swal.fire({
                title: 'Please Input email',
                html: '<input id="rsvp_id" class="swal2-input" value="' + reservation_id +
                    '" readonly>' +
                    '<input id="rsvp_email" placeholder="Insert your email here" class="swal2-input" required>',
                focusConfirm: true,
                preConfirm: () => {
                    return [
                        document.getElementById('rsvp_id').value,
                        document.getElementById('rsvp_email').value,
                    ]
                }
            })

            if (formValues) {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(formValues[1])) {
                    var reservaion_id = $('#modal_reservation_id').val();
                    var booking_id = $('#modal_booking_id').val();
                    var reservation_type = "Email";
                    var reservation_email = formValues[1];
                    var reservation_from = $('#modal_reservation_from').val();
                    Swal.fire(
                        'Success',
                        "Email sending, if you not leave this page, you will notify later if the email already received",
                        'success'
                    );
                    var url = "{{ route('reservation.refund_reschedule') }}";
                    $.ajax({
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "reservation_id": reservation_id,
                            "booking_id": booking_id,
                            "reservation_type": reservation_type,
                            "reservation_email": reservation_email,
                            "reservation_from": reservation_from
                        },
                        url: url,
                        success: function(data) {
                            Swal.fire(
                                'Success',
                                data.msg,
                                'success'
                            );
                        }
                    });
                } else {
                    alert("You have entered an invalid email address!");
                }
            }
        })()
    }

    function printVoucher() {
        var reservation_id = $('#modal_reservation_id').val();
        var booking_id = $('#modal_booking_id').val();
        var reservation_from = $('#modal_reservation_from').val();
        var url = "{{ route('reservation.print_voucher') }}";

        window.open('' + url + '?reservation_id=' + reservation_id + '&booking_id=' + booking_id +
            '&reservation_from=' + reservation_from + '', '_blank').focus();

        Swal.fire(
            'Success',
            data.msg,
            'success'
        );
    }
</script>
