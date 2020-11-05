@extends('templates/template')
@section("header_title") RESERVATION @endsection
@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="panel minimal minimal-gray" style="margin-bottom: 0px">
            <div class="panel-heading">
                <div class="panel-title"></div>
                <div class="panel-options">
                    <ul class="nav nav-tabs nav-horison">
                        <li class="active"><a href="#profile-1" data-toggle="tab">Room Reservation</a></li>
                        <li><a href="#profile-2" data-toggle="tab">Package / Product</a></li>
                        <li><a href="#profile-3" data-toggle="tab">Inquiry</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    {{-- tab number 1 - Room Reservation --}}
                    <div class="tab-pane active" id="profile-1">
                        <div class="panel panel-horison" data-collapsed="0">
                            <!-- panel head -->
                            <div class="panel-heading">
                                <div class="panel-title white">
                                    <h4><strong>Check - In</strong></h4>
                                    <p id="room_today_guest">{{$room_today}} Guest are going to Check - In
                                        today</p>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" onclick='reload_data("table-1");' data-rel="reload"><i
                                            class="entypo-arrows-ccw"></i></a>
                                </div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body table-responsive shadow">
                                <table class="table table-striped table-bordered datatable hoverTable" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="horisonth-table">Reservation Number</th>
                                            <th class="horisonth-table">Customer Name</th>
                                            <th class="horisonth-table">Customer Phone Number</th>
                                            <th class="horisonth-table">Guest Name</th>
                                            <th class="horisonth-table">Guest Phone Number</th>
                                            <th class="horisonth-table">Reserved Rooms</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                        <div class="panel panel-primary" data-collapsed="0">
                            <!-- panel head -->
                            <div class="panel-heading shadow">
                                <div class="panel-title">
                                    <h4><strong>All Reservation Status</strong></h4>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" onclick='reload_data("table-2");' data-rel="reload"><i
                                            class="entypo-arrows-ccw"></i></a>
                                </div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body table-responsive shadow">
                                <table class="table table-striped table-bordered datatable hoverTable" id="table-2">
                                    <thead style="font-weight:bold">
                                        <tr>
                                            <th class="horisonth-table">Reservation Number</th>
                                            <th class="horisonth-table">Customer Name</th>
                                            <th class="horisonth-table">Reserved Rooms</th>
                                            <th class="horisonth-table">Check In</th>
                                            <th class="horisonth-table">Check Out</th>
                                            <th class="horisonth-table">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="all_reservation">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Reservation Number</th>
                                            <th>Customer Name</th>
                                            <th>Reserved Rooms</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>

                    {{-- tab number 2 - Package/Product --}}
                    <div class="tab-pane" id="profile-2">
                        <div class="panel panel-horison" data-collapsed="0">
                            <!-- panel head -->
                            <div class="panel-heading">
                                <div class="panel-title white">
                                    <h4><strong>Package / Product Reservation Today</strong></h4>
                                    <p id="product_today_guest">{{$product_today}} Customer Reservation Package Today
                                    </p>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" onclick='reload_data("table-3");' data-rel="reload"><i
                                            class="entypo-arrows-ccw"></i></a>
                                </div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body table-responsive shadow">
                                <table class="table table-striped table-bordered  hoverTable datatable" id="table-3">
                                    <thead>
                                        <tr>
                                            <th class="horisonth-table">Reservation Number</th>
                                            <th class="horisonth-table">Customer Name</th>
                                            <th class="horisonth-table">Customer Email</th>
                                            <th class="horisonth-table">Customer Phone Number</th>
                                            <th class="horisonth-table">Reserved Package</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-primary " data-collapsed="0">
                            <!-- panel head -->
                            <div class="panel-heading shadow">
                                <div class="panel-title">
                                    <h4><strong>Online Package / Product Reservation Status</strong></h4>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" onclick='reload_data("table-4");' data-rel="reload"><i
                                            class="entypo-arrows-ccw"></i></a>
                                </div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body table-responsive shadow">
                                <table class="table table-striped table-bordered datatable hoverTable" id="table-4">
                                    <thead>
                                        <tr>
                                            <th class="horisonth-table">Reservation Number</th>
                                            <th class="horisonth-table">Customer Name</th>
                                            <th class="horisonth-table">Customer Email</th>
                                            <th class="horisonth-table">Reserved Package</th>
                                            <th class="horisonth-table">Date</th>
                                            <th class="horisonth-table">Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Reservation Number</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Reserved Package</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- tab number 3 - Inquiry --}}
                    <div class="tab-pane" id="profile-3">
                        <div class="panel panel-horison" data-collapsed="0">
                            <!-- panel head -->
                            <div class="panel-heading">
                                <div class="panel-title white">
                                    <h4><strong>Inquiry Today</strong></h4>
                                    <p id="inquiry_today_guest">{{$inquiry_today}} Package Inquired Today</p>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" onclick='reload_data("table-5");' data-rel="reload"><i
                                            class="entypo-arrows-ccw"></i></a>
                                </div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body table-responsive shadow">
                                <table class="table table-striped table-bordered  hoverTable datatable" id="table-5">
                                    <thead>
                                        <tr>
                                            <th class="horisonth-table">Reservation Number</th>
                                            <th class="horisonth-table">Customer Name</th>
                                            <th class="horisonth-table">Customer Email</th>
                                            <th class="horisonth-table">Inquiry Type</th>
                                            <th class="horisonth-table">Package</th>
                                        </tr>
                                    </thead>
                                    {{-- <tfoot>
                                        <tr>
                                            <th>Rendering engine</th>
                                            <th>Browser</th>
                                            <th>Platform(s)</th>
                                            <th>Engine version</th>
                                            <th>CSS grade</th>
                                            <th>CSS grade</th>
                                        </tr>
                                    </tfoot> --}}
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-primary " data-collapsed="0">
                            <!-- panel head -->
                            <div class="panel-heading shadow">
                                <div class="panel-title">
                                    <h4><strong>All Package Inquiry</strong></h4>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" onclick='reload_data("table-6");' data-rel="reload"><i
                                            class="entypo-arrows-ccw"></i></a>
                                </div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body table-responsive shadow">
                                <table class="table table-striped table-bordered datatable hoverTable" id="table-6">
                                    <thead>
                                        <tr>
                                            <th class="horisonth-table">Reservation Number</th>
                                            <th class="horisonth-table">Customer Name</th>
                                            <th class="horisonth-table">Customer Email</th>
                                            <th class="horisonth-table">Inquiry Type</th>
                                            <th class="horisonth-table">Package</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Reservation Number</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Inquiry Type</th>
                                            <th>Package</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('main_page.reservation.modal')
</div>


<script type="text/javascript">
    // data table reservation
    jQuery(document).ready(function ($) {

        var $table1 = jQuery('#table-1');
        var $table2 = jQuery('#table-2');
        var $table3 = jQuery('#table-3');
        var $table4 = jQuery('#table-4');
        var $table5 = jQuery('#table-5');
        var $table6 = jQuery('#table-6');

        //{{route('reservation.room_data')}}

        $table1.DataTable({
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "language": {
                "infoFiltered": "",
                "processing": "<div class='lds-dual-ring-admin-table'></div>"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('reservation.today_room_data')}}",
            "columnDefs": [{
                "orderable": false,
                "targets": [1, 2, 3, 4, 5]
            }],
            columns: [{
                    data: 'reservation_id',
                    name: 'reservation_id'
                },
                {
                    data: 'rsvp_cust_name',
                    name: 'rsvp_cust_name'
                },
                {
                    data: 'rsvp_cust_phone',
                    name: 'rsvp_cust_phone'
                },
                {
                    data: 'rsvp_guest_name',
                    name: 'rsvp_guest_name'
                },
                {
                    data: 'rsvp_cust_phone',
                    name: 'rsvp_cust_phone'
                },
                {
                    data: 'rsvp_reserved_room',
                    name: 'rsvp_reserved_room'
                }
            ]
        });

        $table2.DataTable({
            // dom: 'lBfrtip',
            // buttons: [
            //     'copyHtml5',
            //     'excelHtml5',
            //     'csvHtml5',
            //     'pdfHtml5'
            // ],
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "language": {
                "infoFiltered": "",
                "processing": "<div class='lds-dual-ring-admin-table'></div>"
            },
            processing: true,
            serverSide: true,
            initComplete: setFooter("table-2"),
            ajax: "{{route('reservation.room_data')}}",
            "columnDefs": [{
                "targets": [3, 4],
                render: function (data) {
                    return moment(data).format('DD MMMM YYYY');
                },
                "type": "date"
            }, {
                "orderable": false,
                "targets": [1, 2, 5]
            }],
            columns: [{
                    data: 'reservation_id',
                    name: 'reservation_id'
                },
                {
                    data: 'rsvp_cust_name',
                    name: 'rsvp_cust_name'
                },
                {
                    data: 'rsvp_reserved_room',
                    name: 'rsvp_reserved_room'
                },
                {
                    data: 'rsvp_checkin',
                    name: 'rsvp_checkin'
                },
                {
                    data: 'rsvp_checkout',
                    name: 'rsvp_checkout'
                },
                {
                    data: 'rsvp_status',
                    name: 'rsvp_status'
                }
            ]
        });


        // DataTable
        var table2 = $('#table-2').DataTable();

        // Apply the search
        table2.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change clear', function () {
                var data = '';
                if (that[0][0] == 3 || that[0][0] == 4) {

                    data = moment(new Date(this.value)).format('YYYY-MM-DD');
                } else {

                    data = this.value;
                }

                if (that.search() !== data) {

                    that
                        .search(data)
                        .draw();
                } else {
                    that
                        .search("")
                        .draw();
                }
            });
            $('select', this.footer()).on('change', function () {
                var data = this.value;

                if (that.search() !== data) {

                    that
                        .search(data)
                        .draw();
                }
            });
        });

        $table3.DataTable({
            // dom: 'lBfrtip',
            // buttons: [
            //     'copyHtml5',
            //     'excelHtml5',
            //     'csvHtml5',
            //     'pdfHtml5'
            // ],
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "language": {
                "infoFiltered": "",
                "processing": "<div class='lds-dual-ring-admin-table'></div>"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('reservation.product_reservation_today')}}",
            "columnDefs": [{
                "orderable": false,
                "targets": [1, 2, 3, 4]
            }],
            columns: [{
                    data: 'reservation_id',
                    name: 'reservation_id'
                },
                {
                    data: 'rsvp_cust_name',
                    name: 'rsvp_cust_name'
                },
                {
                    data: 'customer.cust_email',
                    name: 'customer.cust_email'
                },
                {
                    data: 'rsvp_cust_phone',
                    name: 'rsvp_cust_phone'
                },
                {
                    data: 'product.product_name',
                    name: 'product.product_name'
                }
            ]
        });

        $table4.DataTable({
            // dom: 'lBfrtip',
            // buttons: [
            //     'copyHtml5',
            //     'excelHtml5',
            //     'csvHtml5',
            //     'pdfHtml5'
            // ],
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "language": {
                "infoFiltered": "",
                "processing": "<div class='lds-dual-ring-admin-table'></div>"
            },
            processing: true,
            serverSide: true,
            initComplete: setFooter('table-4'),
            ajax: "{{route('reservation.product_data')}}",
            "columnDefs": [{
                "targets": 4,
                render: function (data) {
                    if (data != null) {
                        return moment(data).format('DD MMMM YYYY');
                    }
                },
                "type": "date"
            }, {
                "orderable": false,
                "targets": [1, 2, 3, 5]
            }],
            columns: [{
                    data: 'reservation_id',
                    name: 'reservation_id'
                },
                {
                    data: 'rsvp_cust_name',
                    name: 'rsvp_cust_name'
                },
                {
                    data: 'customer.cust_email',
                    name: 'customer.cust_email'
                },
                {
                    data: 'product.product_name',
                    name: 'product.product_name'
                },
                {
                    data: 'rsvp_date_reserve',
                    name: 'rsvp_date_reserve'
                },
                {
                    data: 'rsvp_status',
                    name: 'rsvp_status'
                }
            ]
        });


        // DataTable
        var table4 = $('#table-4').DataTable();

        // Apply the search
        table4.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change clear', function () {
                var data = '';
                if (that[0][0] == 4) {

                    data = moment(new Date(this.value)).format('YYYY-MM-DD');
                } else {

                    data = this.value;
                }

                if (that.search() !== data) {

                    that
                        .search(data)
                        .draw();
                } else {
                    that
                        .search("")
                        .draw();
                }
            });
            $('select', this.footer()).on('change', function () {
                var data = this.value;

                if (that.search() !== data) {

                    that
                        .search(data)
                        .draw();
                }
            });
        });

        $table5.DataTable({
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "language": {
                "infoFiltered": "",
                "processing": "<div class='lds-dual-ring-admin-table'></div>"
            },
            processing: true,
            serverSide: true,
            ajax: "{{route('reservation.product_inquiry_today')}}",
            "columnDefs": [{
                "orderable": false,
                "targets": [3],
                render: function (data) {
                    if (data == 0) {
                        return "General Inquiry";
                    } else if (data == 1) {
                        return "Recreational";
                    } else if (data == 2) {
                        return "AllySea a Spa";
                    } else if (data == 3) {
                        return "Mice";
                    } else if (data == 4) {
                        return "Wedding";
                    }
                }

            }, {
                "targets": [0, 1, 2, 4],
                "defaultContent": ""
            }, {
                "orderable": false,
                "targets": [1, 2, 3, 4]
            }],
            columns: [{
                    data: 'reservation_id',
                    name: 'reservation_id'
                },
                {
                    data: 'inq_cust_name',
                    name: 'inq_cust_name'
                },
                {
                    data: 'customer.cust_email',
                    name: 'customer.cust_email'
                },
                {
                    data: 'inq_type',
                    name: 'inq_type'
                },
                {
                    data: 'product.product_name',
                    name: 'product.product_name'
                }
            ]
        });

        $table6.DataTable({
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "language": {
                "infoFiltered": "",
                "processing": "<div class='lds-dual-ring-admin-table'></div>"
            },
            processing: true,
            serverSide: true,
            initComplete: setFooter('table-6'),
            ajax: "{{route('reservation.product_inquiry_data')}}",
            "columnDefs": [{
                "targets": [3],
                render: function (data) {
                    if (data == 0) {
                        return "General Inquiry";
                    } else if (data == 1) {
                        return "Recreational";
                    } else if (data == 2) {
                        return "AllySea a Spa";
                    } else if (data == 3) {
                        return "Mice";
                    } else if (data == 4) {
                        return "Wedding";
                    }
                }

            }, {
                "orderable": false,
                "targets": [1, 2, 3, 4]
            }],
            columns: [{
                    data: 'reservation_id',
                    name: 'reservation_id'
                },
                {
                    data: 'inq_cust_name',
                    name: 'inq_cust_name'
                },
                {
                    data: 'customer.cust_email',
                    name: 'customer.cust_email'
                },
                {
                    data: 'inq_type',
                    name: 'inq_type'
                },
                {
                    data: 'product_name',
                    name: 'product_name'
                }
            ]
        });

        // DataTable
        var table6 = $('#table-6').DataTable();

        // Apply the search
        table6.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change clear', function () {
                var data = '';
                data = this.value;

                if (that.search() !== data) {

                    that
                        .search(data)
                        .draw();
                } else {
                    that
                        .search("")
                        .draw();
                }
            });
            $('select', this.footer()).on('change', function () {
                var data = this.value;

                if (that.search() !== data) {

                    that
                        .search(data)
                        .draw();
                }
            });
        });

        function setFooter(table) {
            // Setup - add a text input to each footer cell
            $('#' + table + ' tfoot th').each(function () {
                var title = $(this).text();

                if (title == "Check In" || title == "Check Out" || title == "Date") {
                    $(this).html(
                        ' <div class="input-group"><input type="text" class="form-control datepicker" data-format="dd MM yyyy" style ="background-color: #FFFFFF" placeholder="' +
                        title +
                        '"> <div class="input-group-addon"><a href="#"><i class="entypo-calendar"></i></a></div></div>'
                    );
                } else if (title == "Status") {
                    $(this).html('<select class="form-control">' +
                        '<option value="">All status</option>' +
                        '<option value="Payment received">Payment received</option>' +
                        '<option value="Waiting for payment">Waiting for payment</option>' +
                        '<option value="Failed">Failed</option>' +
                        '<option value="Rescheduled">Rescheduled</option>' +
                        '</select>');
                } else if (title == "Inquiry Type") {
                    $(this).html('<select class="form-control">' +
                        '<option value="">All inquiry</option>' +
                        '<option value="0">General Inquiry</option>' +
                        '<option value="1">Recreational</option>' +
                        '<option value="2">AllySea a Spa</option>' +
                        '<option value="3">Mice</option>' +
                        '<option value="4">Wedding</option>' +
                        '</select>');
                } else {
                    $(this).html('<input type="text" class="form-control" placeholder="' + title +
                        '" />');
                }

            });

        }

        function testAnim(x) {
            $('.modal .modal-dialog').attr('class', 'modal-dialog  modal-lg ' + x + '  animated');
        };
        $('#modal-1').on('show.bs.modal', function (e) {
            var anim = "zoomIn";
            testAnim(anim);
        });
        $('#modal-1').on('shown.bs.modal', function () {
            $(document).off('focusin.modal');
        });

        $('#table-1 tbody').on('click', 'tr', function () {

            var data = $table1.DataTable().row(this).data();

            var checkin = moment(data.rsvp_checkin).format('DD MMMM YYYY');
            var checkout = moment(data.rsvp_checkout).format('DD MMMM YYYY');
            var room_accommodation = data.rsvp_adult + " Adult, " + data.rsvp_child + " Children";
            var reservation_date = moment(data.create_at).format('LLLL');
            var room_breakfast = data.rsvp_breakfast == 1 ? "Yes" : "No";

            if (data.rsvp_guest_name == '') {
                var guest_name = data.rsvp_cust_name;
                var guest_phone = '';
                var guest_email = '';

            } else {
                var guest_name = data.rsvp_guest_name;
                var guest_phone = '';
                var guest_email = '';
            }

            if (data.rsvp_status == "Payment received") {
                var payment_status = "Payment Received via " + data.rsvp_payment + " Payment";
                var payment_class = 'text-success col-lg-3';
                $('#paid_amount').text(formatRupiah(data.rsvp_grand_total));

            } else if (data.rsvp_status == "Waiting for payment") {
                var payment_status = data.rsvp_status;
                var payment_class = 'text-warning col-lg-3';
            } else {
                var payment_status = data.rsvp_status;
                var payment_class = 'text-danger col-lg-3';
            }

            $('#reservation_id').text(data.reservation_id);
            $('#reservation_date').text(reservation_date);
            $('#room_checkin').text(checkin);
            $('#room_checkout').text(checkout);
            $('#room_type_reserved').text(data.rsvp_reserved_room);
            $('#room_accommodation').text(room_accommodation);
            $('#room_breakfast').text(room_breakfast);
            $('#room_extrabed').text(data.rsvp_total_extrabed);
            $('#customer_name').text(data.rsvp_cust_name);
            $('#customer_id').text(data.rsvp_cust_idtype + " / " + data.rsvp_cust_idnumber);
            $('#customer_phone').text(data.rsvp_cust_phone);
            $('#customer_email').text(data.customer.cust_email);
            $('#guest_name').text(guest_name);
            $('#special_request').text(data.rsvp_special_request ?? "");
            $('#payment_status').text(payment_status);
            $('#payment_status').removeClass();
            $('#payment_status').addClass(payment_class);
            $('#payment_date').text(reservation_date);
            $('#booking_price').text(formatRupiah(data.rsvp_grand_total));

            $('#cancel_booking_tab').hide();
            $('#reschedule_booking_tab').hide();
            $('#room_cancel_reschedule_btn').hide();
            $('#product_cancel_reschedule_btn').hide();

            $(".general_cust-detail").show();

            $(".payment-detail").show();
            $(".modal-footer").show();
            $(".packageon").hide();
            $(".room").show();
            $(".inquiry-detail").hide();
            $(".modal-title").text('ROOM RESERVATION TODAY');
            $(".form-data").prop('method', 'POST').prop('action', '');
            $(".validation-message").hide();
            $('#modal-1').modal('show', {
                backdrop: 'static'
            });
        });

        $('#table-2 tbody').on('click', 'tr', function () {

            var data = $table2.DataTable().row(this).data();
            var checkin = moment(data.rsvp_checkin).format('DD MMMM YYYY');
            var checkout = moment(data.rsvp_checkout).format('DD MMMM YYYY');
            var room_accommodation = data.rsvp_adult + " Adult, " + data.rsvp_child + " Children";
            var reservation_date = moment(data.create_at).format('LLLL');
            var room_breakfast = data.rsvp_breakfast == 1 ? "Yes" : "No";

            if (data.rsvp_guest_name == '') {
                var guest_name = data.rsvp_cust_name;

            } else {
                var guest_name = data.rsvp_guest_name;
            }

            if (data.rsvp_status == "Payment received") {
                var paid_amount = formatRupiah(parseInt(data.gross_amount));
                var payment_status = "Payment Received via " + data.rsvp_payment + " Payment";
                var payment_class = 'text-success col-lg-3';

                if(data.transaction_status == "settlement"){
                    var payment_date = moment(new Date(data.settlement_time)).format('LLLL');
                }else if(data.transaction_status == "capture"){
                    var payment_date = moment(new Date(data.transaction_time)).format('LLLL');
                }
            } else if (data.rsvp_status == "Waiting for payment") {
                var paid_amount = formatRupiah(0);
                var payment_status = data.rsvp_status;
                var payment_class = 'text-warning col-lg-3';
                var payment_date = "";

            } else {
                var paid_amount = formatRupiah(0);
                var payment_status = data.rsvp_status;
                var payment_class = 'text-danger col-lg-3';
                var payment_date = "";

            }

            $('#reservation_id').text(data.reservation_id);
            $('#reservation_date').text(reservation_date);
            $('#room_checkin').text(checkin);
            $('#room_checkout').text(checkout);
            $('#room_type_reserved').text(data.rsvp_reserved_room);
            $('#room_accommodation').text(room_accommodation);
            $('#room_breakfast').text(room_breakfast);
            $('#room_extrabed').text(data.rsvp_total_extrabed);
            $('#customer_name').text(data.rsvp_cust_name);
            $('#customer_id').text(data.rsvp_cust_idtype + " / " + data.rsvp_cust_idnumber);
            $('#customer_phone').text(data.rsvp_cust_phone);
            $('#customer_email').text(data.customer.cust_email);
            $('#guest_name').text(guest_name);
            $('#special_request').text(data.rsvp_special_request ?? "");
            $('#payment_status').text(payment_status);
            $('#payment_status').removeClass();
            $('#payment_status').addClass(payment_class);
            $('#payment_date').text(payment_date);
            $('#booking_price').text(formatRupiah(data.rsvp_grand_total));
            $('#paid_amount').text(paid_amount);

            // CANCELATION
            var checkin = moment(new Date(checkin)).format('DD MMMM YYYY');
            var checkout = moment(new Date(checkout)).format('DD MMMM YYYY');
            // cancellation fee add days
            var today = moment(new Date()).format('DD MMMM YYYY');
            var one_day_add = moment(new Date(today)).add(1, 'days').format('DD MMMM YYYY');
            var two_day_add = moment(new Date(today)).add(2, 'days').format('DD MMMM YYYY');
            var three_day_add = moment(new Date(today)).add(3, 'days').format('DD MMMM YYYY');

            // cancellation duration of stay
            var checkin_one = moment(new Date(checkin)).add(1, 'days').format('DD MMMM YYYY');
            var checkin_two = moment(new Date(checkin)).add(2, 'days').format('DD MMMM YYYY');

            // stay 1 day
            var day ='<li>Allotment on <b>'+checkin+'</b> will be hold until the next day.</li>'+
                    '<li>Allotment on <b>'+checkout+'</b> will be returned.</li>'+
                    '<li>Sales that reported are Sales that only occured on <b>'+checkin+'</b> counted as <b>Cancellation Fee.</b></li>'+
                    '<li>This action cannot be undone.</li>';
            // stay 2 day
            var twoday ='<li>Allotment on <b>'+checkin+'</b> will be hold until the next day.</li>'+
                        '<li>Allotment on <b>'+checkout+'</b> will be returned.</li>'+
                        '<li>Sales that reported are Sales that only occured on <b>'+checkin+'</b> counted as <b>Cancellation Fee.</b></li>'+
                        '<li>This action cannot be undone.</li>';
            // stay > 2 day
            var threeday ='<li>Allotment on <b>'+checkin+'</b> will be hold until the next day.</li>'+
                        '<li>Allotment on <b>'+checkin+' + '+one_day_add+'</b> will be returned.</li>'+
                        '<li>Sales that reported are Sales that only occured on <b>'+checkin+'</b> counted as <b>Cancellation Fee.</b></li>'+
                        '<li>This action cannot be undone.</li>';

            // today (100%)
            if (data.rsvp_status == "Payment received" && new Date(checkin).getTime() == new Date(today).getTime()) {
                $('#room_cancel_reschedule_btn').fadeIn();
                $('#modal_reservation_id').val(data.reservation_id);
                $('#modal_reservation_type').val("Room");
                $('#modal_reservation_from').val("ROOMS");
                $('#cancellation_fee').text(formatRupiah(data.cancellation_fee));

                // duration of stay
                if (new Date(checkout).getTime() == new Date(checkin_one).getTime()) {
                    $('#two_day').empty();
                    $('#two_day').append(day);
                } else if (new Date(checkout).getTime() == new Date(checkin_two).getTime()) {
                    $('#two_day').empty();
                    $('#two_day').append(twoday);
                } else {
                    $('#two_day').empty();
                    $('#two_day').append(threeday);
                }
            }

            // one day (50%)
            else if (data.rsvp_status == "Payment received" && new Date(checkin).getTime() == new Date(one_day_add).getTime()) {
                $('#room_cancel_reschedule_btn').fadeIn();
                $('#modal_reservation_id').val(data.reservation_id);
                $('#modal_reservation_type').val("Room");
                $('#modal_reservation_from').val("ROOMS");
                $('#cancellation_fee').text(formatRupiah(data.cancellation_fee * 50 / 100));

                // duration of stay
                if (new Date(checkout).getTime() == new Date(checkin_one).getTime()) {
                    $('#two_day').empty();
                    $('#two_day').append(day);
                } else if (new Date(checkout).getTime() == new Date(checkin_two).getTime()) {
                    $('#two_day').empty();
                    $('#two_day').append(twoday);
                } else {
                    $('#two_day').empty();
                    $('#two_day').append(threeday);
                }
            }

            // two day (30%)
            else if (data.rsvp_status == "Payment received" && new Date(checkin).getTime() == new Date(two_day_add).getTime()) {
                $('#room_cancel_reschedule_btn').fadeIn();
                $('#modal_reservation_id').val(data.reservation_id);
                $('#modal_reservation_type').val("Room");
                $('#modal_reservation_from').val("ROOMS");
                $('#cancellation_fee').text(formatRupiah(data.cancellation_fee * 30 / 100));

                // duration of stay
                if (new Date(checkout).getTime() == new Date(checkin_one).getTime()) {
                    $('#two_day').empty();
                    $('#two_day').append(day);
                } else if (new Date(checkout).getTime() == new Date(checkin_two).getTime()) {
                    $('#two_day').empty();
                    $('#two_day').append(twoday);
                } else {
                    $('#two_day').empty();
                    $('#two_day').append(threeday);
                }
            }

            // three day (30%)
            else if (data.rsvp_status == "Payment received" && new Date(checkin).getTime() == new Date(three_day_add).getTime()) {
                $('#room_cancel_reschedule_btn').fadeIn();
                $('#modal_reservation_id').val(data.reservation_id);
                $('#modal_reservation_type').val("Room");
                $('#modal_reservation_from').val("ROOMS");
                $('#cancellation_fee').text(formatRupiah(data.cancellation_fee * 30 / 100));

                // duration of stay
                if (new Date(checkout).getTime() == new Date(checkin_one).getTime()) {
                    $('#two_day').empty();
                    $('#two_day').append(day);
                } else if (new Date(checkout).getTime() == new Date(checkin_two).getTime()) {
                    $('#two_day').empty();
                    $('#two_day').append(twoday);
                } else {
                    $('#two_day').empty();
                    $('#two_day').append(threeday);
                }
            }

            // four day (no cancellition fee)
            else if (data.rsvp_status == "Payment received" && new Date(checkin).getTime() > new Date(three_day_add).getTime()) {
                $('#room_cancel_reschedule_btn').fadeIn();
                $('#modal_reservation_id').val(data.reservation_id);
                $('#modal_reservation_type').val("Room");
                $('#modal_reservation_from').val("ROOMS");
                $('#cancellation_fee').text(formatRupiah('0'));

                // duration of stay
                if (new Date(checkout).getTime() == new Date(checkin_one).getTime()) {
                    $('#two_day').empty();
                    $('#two_day').append(day);
                } else if (new Date(checkout).getTime() == new Date(checkin_two).getTime()) {
                    $('#two_day').empty();
                    $('#two_day').append(twoday);
                } else {
                    $('#two_day').empty();
                    $('#two_day').append(threeday);
                }
            }

            else {
                $('#room_cancel_reschedule_btn').hide();
            }
            // END CANCELLATION

            if ("{{Auth::user()->level}}" == "2") {

                $('#room_cancel_reschedule_btn').hide();
            }

            $('#product_cancel_reschedule_btn').hide();

            $('#cancel_booking_tab').hide();
            $('#reschedule_booking_tab').hide();

            $(".general_cust-detail").show();
            $(".payment-detail").show();
            $(".modal-footer").show();
            $(".packageon").hide();
            $(".room").show();
            $(".inquiry-detail").hide();
            $(".modal-title").text('ROOM RESERVATION');
            $(".form-data").prop('method', 'POST').prop('action', '');
            $(".validation-message").hide();
            $('#modal-1').modal('show', {
                backdrop: 'static'
            });
        });

        $('#table-3 tbody').on('click', 'tr', function () {

            var data = $table3.DataTable().row(this).data();

            var reservation_date = moment(new Date(data.rsvp_date_reserve +' '+ data.rsvp_arrive_time)).format('LLLL');

            if (data.rsvp_guest_name == '') {
                var guest_name = data.rsvp_cust_name;
                var guest_phone = '';
                var guest_email = '';

            } else {
                var guest_name = data.rsvp_guest_name;
                var guest_phone = '';
                var guest_email = '';
            }

            if (data.rsvp_status == "Payment received") {
                $('#product_paid_amount').text(formatRupiah(data.rsvp_grand_total));

                var payment_status = "Payment Received via " + data.rsvp_payment + " Payment";
                var payment_class = 'text-success col-lg-3';
                var payment_date = reservation_date;
            } else if (data.rsvp_status == "Waiting for payment") {
                var payment_status = data.rsvp_status;
                var payment_class = 'text-warning col-lg-3';
                var payment_date = "";

            } else {
                var payment_status = data.rsvp_status;
                var payment_class = 'text-danger col-lg-3';
                var payment_date = "";

            }

            $('#online_rsvp_number').text(data.reservation_id);
            $('#online_rsvp_date').text(reservation_date);
            $('#online_rsvp_product_name').text(data.product.product_name);
            $('#online_rsvp_pax').text(data.rsvp_amount_pax + " Pax");
            $('#online_cust_name').text(data.rsvp_cust_name);
            $('#online_cust_id').text(data.rsvp_cust_idtype + " / " + data.rsvp_cust_idnumber);
            $('#online_cust_phone').text(data.rsvp_cust_phone);
            $('#online_cust_email').text(data.customer.cust_email);
            $('#product_special_request').text(data.rsvp_special_request ?? "");

            $('#product_payment_status').text(payment_status);
            $('#product_payment_status').removeClass();
            $('#product_payment_status').addClass(payment_class);
            $('#product_payment_date').text(payment_date);
            $('#product_booking_price').text(formatRupiah(data.rsvp_grand_total));



            $('#product_cancel_reschedule_btn').hide();
            $('#cancel_booking_tab').hide();
            $('#reschedule_booking_tab').hide();
            $('#room_cancel_reschedule_btn').hide();
            $(".general_cust-detail").show();
            $(".payment-detail").show();
            $(".modal-footer").show();
            $(".room").hide();
            $(".packageon").show();
            $(".inquiry-detail").hide();
            $(".modal-title").text('PACKAGE / PRODUCT RESERVATION TODAY');
            $(".form-data").prop('method', 'POST').prop('action', '');
            $(".validation-message").hide();
            $('#modal-1').modal('show', {
                backdrop: 'static'
            });
        });

        $('#table-4 tbody').on('click', 'tr', function () {

            var data = $table4.DataTable().row(this).data();
            var reservation_date = moment(new Date(data.rsvp_date_reserve +' '+ data.rsvp_arrive_time)).format('LLLL');

            if (data.rsvp_guest_name == null) {
                var guest_name = data.rsvp_cust_name;
                var guest_phone = '';
                var guest_email = '';

            } else {
                var guest_name = data.rsvp_guest_name;
                var guest_phone = '';
                var guest_email = '';
            }

            if (data.rsvp_status == "Payment received") {
                var paid_amount = formatRupiah(parseInt(data['payment'].gross_amount));
                var payment_status = "Payment Received via " + data.rsvp_payment + " Payment";
                var payment_class = 'text-success col-lg-3';
                if(data['payment'].transaction_status == "settlement"){
                    var payment_date = moment(new Date(data['payment'].settlement_time)).format('LLLL');
                }else if(data['payment'].transaction_status == "capture"){
                    var payment_date = moment(new Date(data['payment'].transaction_time)).format('LLLL');
                }
            } else if (data.rsvp_status == "Waiting for payment") {
                var paid_amount = formatRupiah(0);
                var payment_status = data.rsvp_status;
                var payment_class = 'text-warning col-lg-3';
                var payment_date = "";

            } else {
                var paid_amount = formatRupiah(0);
                var payment_status = data.rsvp_status;
                var payment_class = 'text-danger col-lg-3';
                var payment_date = "";

            }

            $('#online_rsvp_number').text(data.reservation_id);
            $('#online_rsvp_date').text(reservation_date);
            $('#online_rsvp_product_name').text(data.product.product_name);
            $('#online_rsvp_pax').text(data.rsvp_amount_pax + " Pax");

            $('#online_cust_name').text(data.rsvp_cust_name);
            $('#online_cust_id').text(data.rsvp_cust_idtype + " / " + data.rsvp_cust_idnumber);
            $('#online_cust_phone').text(data.rsvp_cust_phone);
            $('#online_cust_email').text(data.customer.cust_email);
            $('#product_special_request').text(data.rsvp_special_request ?? "");

            $('#product_payment_status').text(payment_status);
            $('#product_payment_status').removeClass();
            $('#product_payment_status').addClass(payment_class);
            $('#product_payment_date').text(payment_date);
            $('#product_booking_price').text(formatRupiah(data.rsvp_grand_total));
            $('#product_paid_amount').text(paid_amount);

            var today = moment(new Date()).format('DD MMMM YYYY');
            var date_reserve = moment(date_reserve).format('DD MMMM YYYY');
            if (data.rsvp_status == "Payment received" && new Date(date_reserve) >= new Date(today)) {
                $('#modal_reservation_id').val(data.reservation_id);
                $('#modal_reservation_type').val("Product");
                $('#modal_reservation_from').val("PRODUCTS");
                $('#product_cancel_reschedule_btn').fadeIn();

            } else {
                $('#product_cancel_reschedule_btn').fadeOut();
            }

            if ("{{Auth::user()->level}}" == "2") {
                $('#product_cancel_reschedule_btn').fadeOut();
            }

            $('#cancel_booking_tab').fadeOut();
            $('#reschedule_booking_tab').fadeOut();
            $('#room_cancel_reschedule_btn').fadeOut();
            $(".general_cust-detail").show();
            $(".payment-detail").show();
            $(".modal-footer").show();
            $(".room").hide();
            $(".packageon").show();
            $(".inquiry-detail").hide();
            $(".modal-title").text('ONLINE PACKAGE / PRODUCT RESERVATION');
            $(".form-data").prop('method', 'POST').prop('action', '');
            $(".validation-message").hide();
            $('#modal-1').modal('show', {
                backdrop: 'static'
            });
        });

        $('#table-5 tbody').on('click', 'tr', function () {

            var data = $table5.DataTable().row(this).data();

            var inq_at = moment(data.create_at).format('dddd, DD MMMM YYYY');
            var date = moment(data.inq_event_start).format('dddd, DD MMMM YYYY');
            var inq_alt_date = moment(data.inq_alt_start).format('dddd, DD MMMM YYYY')

            $('.inq_number').text(data.reservation_id);
            $('.inq_at').text(inq_at);
            $('.inq_date').text(date);
            $('.inq_product').text(data.product_name);
            $('.inq_participant').text(data.inq_participant);
            $('.inq_desc').text(data.inq_details);
            $('.inq_event_name').text(data.inq_event_name);

            $('.inq_cust_name').text(data.inq_cust_name);
            $('.inq_cust_email').text(data['customer'].cust_email);
            $('.inq_cust_phone').text(data.inq_cust_phone);
            if (data.other_request.length > 0) {
                var html = '';
                var row = '<tr>';
                var total = 0;
                data.other_request.forEach(element => {
                    var field = '<td class="col-lg-3"><li>' + element.master_other_request
                        .request_name + '</li></td>';
                    row += field;
                    total++;
                    if (total == 4 || total == data.other_request.length) {
                        row += "</tr>";
                        html += row;
                        row = '<tr>';
                    }
                });

            }
            switch (data.inq_type) {
                case "0":
                    $('.inq_type').text("General Inquiry");

                    $(".general_cust-detail").hide();
                    $(".inquiry-detail").show();
                    $(".inquiry-general").show();
                    $(".inquiry-recreational").hide();
                    $(".inquiry-wedding").hide();
                    $(".inquiry-mice-1").hide();
                    $(".inquiry-mice-2").hide();
                    break;
                case "1":
                    $('.inq_type').text("Recreational");

                    $(".general_cust-detail").hide();
                    $(".inquiry-detail").show();
                    $(".inquiry-general").hide();
                    $(".inquiry-recreational").show();
                    $(".inquiry-wedding").hide();
                    $(".inquiry-mice-1").hide();
                    $(".inquiry-mice-2").hide();
                    if(data.other_request.length > 0){
                        $('#other_recreational').show();
                        $('#body_recreational').empty();
                        $('#body_recreational').append(html);
                    }
                    break;
                case "2":
                    $('.inq_type').text("AllySea a Spa");
                    $(".general_cust-detail").hide();
                    $(".inquiry-detail").show();
                    $(".inquiry-general").hide();
                    $(".inquiry-recreational").show();
                    $(".inquiry-wedding").hide();
                    $(".inquiry-mice-1").hide();
                    $(".inquiry-mice-2").hide();
                    if(data.inq_arrive_time != null){
                        var arrive_time = data.inq_arrive_time;
                    }else{
                        var arrive_time = '';

                    }
                    $('.inq_date').text(date+' '+arrive_time);

                    if(data.other_request.length > 0){
                        $('#other_recreational').show();
                        $('#body_recreational').empty();
                        $('#body_recreational').append(html);
                    }
                    break;
                case "3":
                    $('.inq_type').text("Mice");

                    if (data['function_room'] != null) {
                        $('.inq_function_room').text(data['function_room'].func_name);
                    } else {
                        $('.inq_function_room').text("No Prefered");
                    }

                    $('.inq_alt_date').text(inq_alt_date);
                    $('.inq_event_type').text(data.inq_event_type);

                    $(".general_cust-detail").hide();
                    $(".inquiry-detail").show();
                    $(".inquiry-general").hide();
                    $(".inquiry-recreational").hide();
                    $(".inquiry-wedding").hide();
                    $(".inquiry-mice-1").hide();
                    $(".inquiry-mice-2").show();
                    if(data.other_request.length > 0){
                        $('#other_mice').show();
                        $('#body_mice').empty();
                        $('#body_mice').append(html);
                    }
                    break;
                case "4":
                    $('.inq_type').text("Wedding");

                    $(".general_cust-detail").hide();
                    $(".inquiry-detail").show();
                    $(".inquiry-general").hide();
                    $(".inquiry-recreational").hide();
                    $(".inquiry-wedding").show();
                    $(".inquiry-mice-1").hide();
                    $(".inquiry-mice-2").hide();
                    if(data.other_request.length > 0){
                        $('#other_wedding').show();
                        $('#body_wedding').empty();
                        $('#body_wedding').append(html);
                    }
                    break;

                default:
                    break;
            }
            $(".room").hide();
            $(".packageon").hide();
            $(".payment-detail").hide();
            $(".modal-footer").hide();
            $(".modal-title").text('PACKAGE INQUIRY TODAY');
            $(".form-data").prop('method', 'POST').prop('action', '');
            $(".validation-message").hide();


            $('#modal-1').modal('show', {
                backdrop: 'static'
            });
        });

        $('#table-6 tbody').on('click', 'tr', function () {

            var data = $table6.DataTable().row(this).data();


            var inq_at = moment(data.create_at).format('dddd, DD MMMM YYYY');
            var date = moment(data.inq_event_start).format('dddd, DD MMMM YYYY');
            var inq_alt_date = moment(data.inq_alt_start).format('dddd, DD MMMM YYYY')

            $('.inq_number').text(data.reservation_id);
            $('.inq_at').text(inq_at);
            $('.inq_date').text(date);
            $('.inq_product').text(data.product_name);
            $('.inq_participant').text(data.inq_participant);
            $('.inq_desc').text(data.inq_details);
            $('.inq_event_name').text(data.inq_event_name);

            $('.inq_cust_name').text(data.inq_cust_name);
            $('.inq_cust_email').text(data['customer'].cust_email);
            $('.inq_cust_phone').text(data.inq_cust_phone);
            if (data.other_request.length > 0) {
                var html = '';
                var row = '<tr>';
                var total = 0;
                data.other_request.forEach(element => {
                    var field = '<td class="col-lg-3"><li>' + element.master_other_request
                        .request_name + '</li></td>';
                    row += field;
                    total++;
                    if (total == 4 || total == data.other_request.length) {
                        row += "</tr>";
                        html += row;
                        row = '<tr>';
                    }
                });

            }
            switch (data.inq_type) {
                case "0":
                    $('.inq_type').text("General Inquiry");

                    $(".general_cust-detail").hide();
                    $(".inquiry-detail").show();
                    $(".inquiry-general").show();
                    $(".inquiry-recreational").hide();
                    $(".inquiry-wedding").hide();
                    $(".inquiry-mice-1").hide();
                    $(".inquiry-mice-2").hide();
                    break;
                case "1":
                    $('.inq_type').text("Recreational");

                    $(".general_cust-detail").hide();
                    $(".inquiry-detail").show();
                    $(".inquiry-general").hide();
                    $(".inquiry-recreational").show();
                    $(".inquiry-wedding").hide();
                    $(".inquiry-mice-1").hide();
                    $(".inquiry-mice-2").hide();
                    if(data.other_request.length > 0){
                        $('#other_recreational').show();
                        $('#body_recreational').empty();
                        $('#body_recreational').append(html);
                    }
                    break;
                case "2":
                    $('.inq_type').text("AllySea a Spa");
                    $(".general_cust-detail").hide();
                    $(".inquiry-detail").show();
                    $(".inquiry-general").hide();
                    $(".inquiry-recreational").show();
                    $(".inquiry-wedding").hide();
                    $(".inquiry-mice-1").hide();
                    $(".inquiry-mice-2").hide();
                    if(data.inq_arrive_time != null){
                        var arrive_time = data.inq_arrive_time;
                    }else{
                        var arrive_time = '';

                    }
                    $('.inq_date').text(date+' '+arrive_time);

                    if(data.other_request.length > 0){
                        $('#other_recreational').show();
                        $('#body_recreational').empty();
                        $('#body_recreational').append(html);
                    }
                    break;
                case "3":
                    $('.inq_type').text("Mice");

                    if (data['function_room'] != null) {
                        $('.inq_function_room').text(data['function_room'].func_name);
                    } else {
                        $('.inq_function_room').text("No Prefered");
                    }

                    $('.inq_alt_date').text(inq_alt_date);
                    $('.inq_event_type').text(data.inq_event_type);

                    $(".general_cust-detail").hide();
                    $(".inquiry-detail").show();
                    $(".inquiry-general").hide();
                    $(".inquiry-recreational").hide();
                    $(".inquiry-wedding").hide();
                    $(".inquiry-mice-1").hide();
                    $(".inquiry-mice-2").show();
                    if(data.other_request.length > 0){
                        $('#other_mice').show();
                        $('#body_mice').empty();
                        $('#body_mice').append(html);
                    }
                    break;
                case "4":
                    $('.inq_type').text("Wedding");

                    $(".general_cust-detail").hide();
                    $(".inquiry-detail").show();
                    $(".inquiry-general").hide();
                    $(".inquiry-recreational").hide();
                    $(".inquiry-wedding").show();
                    $(".inquiry-mice-1").hide();
                    $(".inquiry-mice-2").hide();
                    if(data.other_request.length > 0){
                        $('#other_wedding').show();
                        $('#body_wedding').empty();
                        $('#body_wedding').append(html);
                    }
                    break;

                default:
                    break;
            }

            $(".room").hide();
            $(".packageon").hide();
            $(".payment-detail").hide();
            $(".modal-footer").hide();
            $(".modal-title").text('PACKAGE INQUIRY TODAY');
            $(".form-data").prop('method', 'POST').prop('action', '');
            $(".validation-message").hide();


            $('#modal-1').modal('show', {
                backdrop: 'static'
            });
        });

        // Initalize Select Dropdown after DataTables is created
        $table1.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
        $table2.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
        $table3.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
        $table4.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
        $table5.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
        $table6.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });

    });

    function formatRupiah(angka) {
        angka = String(angka);

        var number_string = angka.replace(/[^0-9]*/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

        rupiah = "Rp " + rupiah;
        return rupiah;
    }

</script>

@endsection
