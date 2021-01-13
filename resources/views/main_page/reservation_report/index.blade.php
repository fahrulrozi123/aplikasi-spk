@extends('templates/template')
@section("header_title") RESERVATION REPORT @endsection
@section('content')


{{-- FOR EXPORT PURPOSE --}}
<div style='display:none'>
    <img id='imgToExport' src="{{ asset('images/logo/' . $setting->logo) }}" />
</div>

{{-- FOR EXPORT PURPOSE --}}
<form id="reservation_export_excel" action="{{route('reservation.reservation_export_excel')}}" method="post" target="_blank">
    {{ csrf_field() }}
</form>

<div class="col-lg-12">
    <div id="room_chart" style="display:none;"></div><br>
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label for="field-1" class="control-label">Report Period</label>
                <div class="input-group">
                    <input type="text" class="form-control  borderlight" id="report_period"
                        name="report_period" readonly>
                    <span class="input-group-addon borderlight darkfont"><i class="entypo-calendar"></i></span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 25px">
            <input form="reservation_export_excel" type="hidden" id="date_start" name="date_start" value="0">
            <input form="reservation_export_excel" type="hidden" id="date_end" name="date_end" value="0">
            <button onclick="savePDF();" type="button" class="btn btn-horison-gold export_pdf_modal">
                <i class="fa fa-file-pdf-o"></i>&ensp;Export to PDF
            </button>
            <button form="reservation_export_excel" type="submit" class="btn btn-horison-gold">
                <i class="fa fa-file-pdf-o"></i>&ensp;Export to Excel
            </button>
        </div>
    </div>

    <hr><br>

    <div class="row">
        <div class="col-sm-12">

            <h2><b>General</b></h2>

            <div class="box-rsvreport shadow">
                <div class="row">
                    <div class="col-sm-3 col-md-3">
                        <h5 style="margin-bottom: 0%; color:silver"><b>TOTAL RESERVATION MADE</b></h5>
                        <h3 style="margin-top: 3%"><b id="total_transaction">50</b></h3>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <h5 style="margin-bottom: 0%; color:silver"><b>TOTAL ROOMS RESERVATION</b></h5>
                        <h3 style="margin-top: 3%"><b id="total_room">30</b></h3>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <h5 style="margin-bottom: 0%; color:silver"><b>TOTAL PACKAGE RESERVATION</b></h5>
                        <h3 style="margin-top: 3%"><b id="total_product">20</b></h3>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <h5 style="margin-bottom: 0%; color:silver"><b>TOTAL INQUIRY</b></h5>
                        <h3 style="margin-top: 3%;"><b id="total_inquiry">10</b></h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br><br>

    {{-- DATA TABLE START --}}
    <div class="row">
        {{-- <div class="col-sm-12"> --}}

        <div class="panel minimal minimal-gray" style="margin-bottom: 0px">
            <div class="panel-heading">
                <div class="panel-title"></div>
                <div class="panel-options">
                    <ul class="nav nav-tabs nav-horison">
                        <li class="active"><a href="#room" data-toggle="tab">Room Reservation</a></li>
                        <li><a href="#package" data-toggle="tab">Package / Product</a></li>
                        <li><a href="#inquiry" data-toggle="tab">Inquiry</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    {{-- tab number 1 - Room Reservation --}}
                    <div class="tab-pane active" id="room">
                        <div class="panel panel-primary" data-collapsed="0">
                            <!-- panel head -->
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <strong>All Rooms Booking</strong>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" onclick='reload_data("table-1");' data-rel="reload"><i
                                            class="entypo-arrows-ccw"></i></a>
                                </div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body no-padding table-responsive shadow">
                                <div style="overflow-x:auto;">
                                    <table class="table table-striped table-bordered datatable" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="horisonth-table">Reservation Number</th>
                                                <th class="horisonth-table">Customer Name</th>
                                                <th class="horisonth-table">Reserved Rooms</th>
                                                <th class="horisonth-table">Check In</th>
                                                <th class="horisonth-table">Check Out</th>
                                                <th class="horisonth-table">Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="horisontd">
                                                <td style="vertical-align:middle" align="center">06/RSV/DLXB/XII/19</td>
                                                <td style="vertical-align:middle" align="center">Arlene Wilson</td>
                                                <td style="vertical-align:middle" align="center">2x Deluxe Business</td>
                                                <td style="vertical-align:middle" align="center">Friday, 19 December
                                                    2019</td>
                                                <td style="vertical-align:middle" align="center">Sunday, 21 December
                                                    2019</td>
                                                <td style="vertical-align:middle; color:#219653;" align="center">Payment
                                                    Received</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- tab number 2 - Package / Product --}}
                    <div class="tab-pane" id="package">
                        <div class="panel panel-primary" data-collapsed="0">
                            <!-- panel head -->
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <strong>All Package/Product Reserved</strong>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" onclick='reload_data("table-2");' data-rel="reload"><i
                                            class="entypo-arrows-ccw"></i></a>
                                </div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body no-padding table-responsive shadow">
                                <div style="overflow-x:auto;">
                                    <table class="table table-striped table-bordered datatable" id="table-2">
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- tab number 3 - Inquiry --}}
                    <div class="tab-pane" id="inquiry">
                        <div class="panel panel-primary" data-collapsed="0">
                            <!-- panel head -->
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <strong>All Package Inquiry</strong>
                                </div>
                                <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                    <a href="#" onclick='reload_data("table-3");' data-rel="reload"><i
                                            class="entypo-arrows-ccw"></i></a>
                                </div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body no-padding table-responsive shadow">
                                <div style="overflow-x:auto;">
                                    <table class="table table-striped table-bordered datatable" id="table-3">
                                        <thead>
                                            <tr>
                                                <th class="horisonth-table">Reservation Number</th>
                                                <th class="horisonth-table">Customer Name</th>
                                                <th class="horisonth-table">Customer Email</th>
                                                <th class="horisonth-table">Inquiry Type</th>
                                                <th class="horisonth-table">Package</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- </div> --}}
    </div>

</div>

<script type="text/javascript">
    //ROOM RESERVATION TABLE
    var $room_reservation_all = jQuery("#table-1");
    //PRODUCT RESERVATION TABLE
    var $product_reservation_all = jQuery("#table-2");
    //INQUIRY RESERVATION TABLE
    var $inquiry_reservation_all = jQuery("#table-3");

    var room_reservation_all = [];

    var product_reservation_all = [];

    var product_data, room_data, inquiry_data;

    var total_transaction, total_room_reservation, total_product_reservation;


    function get_data(start_date = null, end_date = null) {

        room_data = $.ajax({
            type: 'GET',
            url: "{{route('reservation.room_data_success')}}",
            async: false,
            dataType: 'json',
            data: {
                "start_date": start_date,
                "end_date": end_date
            },
            done: function (results) {

                JSON.parse(results);
                return results;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON;

        product_data = $.ajax({
            type: 'GET',
            url: "{{route('reservation.product_data_success')}}",
            async: false,
            dataType: 'json',
            data: {
                "start_date": start_date,
                "end_date": end_date
            },
            done: function (results) {

                JSON.parse(results);
                return results;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON;

        inquiry_data = $.ajax({
            type: 'GET',
            url: "{{route('reservation.inquiry_data_success')}}",
            async: false,
            dataType: 'json',
            data: {
                "start_date": start_date,
                "end_date": end_date
            },
            done: function (results) {

                JSON.parse(results);
                return results;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON;

    }
    function set_all_data() {

        // 351 baris menjadi 190 baris


        room_reservation_all = [];
        room_data['rsvp'].forEach(element => {

            var check_in = new Date(element.rsvp_checkin);
            var check_out = new Date(element.rsvp_checkout);

            // To calculate the time difference of two dates
            var Difference_In_Time = check_out - check_in;
            // To calculate the no. of days between two dates
            var total_stay = Math.floor(Difference_In_Time / (1000 * 3600 * 24));

            // var oneDay = 1000 * 60 * 60 * 24;
            // check_out = new Date(check_out.getTime() + oneDay);

            check_in = moment(check_in).format('dddd, DD MMMM YYYY');
            check_out = moment(check_out).format('dddd, DD MMMM YYYY');
            var rsvp_status = "<p class='text-success'>" + element.rsvp_status + "</p>";


            room_reservation_all.push([element.reservation_id, element.rsvp_cust_name, element.reserved_rooms,
                check_in, check_out, element.rsvp_status
            ]);
        });

        $room_reservation_all.dataTable();
        $room_reservation_all.fnClearTable();
        if (room_reservation_all.length > 0) {
            $room_reservation_all.fnAddData(room_reservation_all);
        }


        product_reservation_all = [];
        product_data['rsvp'].forEach(element => {
            var date_reserve = new Date(element.rsvp_date_reserve);
            date_reserve = moment(date_reserve).format('dddd, DD MMMM YYYY');

            var rsvp_status = "<p class='text-success'>" + element.rsvp_status + "</p>";

            product_reservation_all.push([element.reservation_id, element.rsvp_cust_name,
                element.cust_email, element.product_name, date_reserve, element.rsvp_status
            ]);
        });

        $product_reservation_all.dataTable();
        $product_reservation_all.fnClearTable();
        if (product_reservation_all.length > 0) {
            $product_reservation_all.fnAddData(product_reservation_all);
        }

        inquiry_reservation_all = [];
        inquiry_data['rsvp'].forEach(element => {
            // var date_reserve = new Date(element.rsvp_date_reserve);
            // date_reserve = moment(date_reserve).format('dddd, DD MMMM YYYY');

            switch (element.inq_type) {
                case '0':
                    var inquiry_type = "General";
                    break;
                case '1':
                    var inquiry_type = "Recreational";
                    break;
                case '2':
                    var inquiry_type = "Spa";
                    break;
                case '3':
                    var inquiry_type = "Mice";
                    break;
                case '4':
                    var inquiry_type = "Wedding";
                    break;

                default:
                    break;
            }
            if(element.inq_type == 0){
                var product_name = "General Inquiry";
            }else{
                var product_name = element.product_name;

            }
            inquiry_reservation_all.push([element.reservation_id, element.inq_cust_name,
                element.cust_email, inquiry_type, product_name
            ]);
        });

        $inquiry_reservation_all.dataTable();
        $inquiry_reservation_all.fnClearTable();
        if (inquiry_reservation_all.length > 0) {
            $inquiry_reservation_all.fnAddData(inquiry_reservation_all);
        }


        total_room = parseInt(room_data['total_transaction']);
        total_product = parseInt(product_data['total_transaction']);
        total_inquiry = parseInt(inquiry_data['total_transaction']);
        total_transaction = total_room + total_product + total_inquiry;



        $('#total_transaction').text(formatRibuan(total_transaction));
        $('#total_room').text(formatRibuan(total_room));
        $('#total_product').text(formatRibuan(total_product));
        $('#total_inquiry').text(formatRibuan(total_inquiry));

    }

    function formatRibuan(angka) {
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

        rupiah = "" + rupiah;
        return rupiah;
    }

    jQuery(document).ready(function ($) {

        var table1 = $room_reservation_all.DataTable({
            dom: 'lBfrtip',
            buttons: [
                'excelHtml5',
            ],
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        // Initalize Select Dropdown after DataTables is created
        $room_reservation_all.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });


        var table2 = $product_reservation_all.DataTable({
            dom: 'lBfrtip',
            buttons: [
                'excelHtml5',
            ],
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        // Initalize Select Dropdown after DataTables is created
        $product_reservation_all.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });


        var table3 = $inquiry_reservation_all.DataTable({
            dom: 'lBfrtip',
            buttons: [
                'excelHtml5',
            ],
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });

        // Initalize Select Dropdown after DataTables is created
        $inquiry_reservation_all.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });


        //to set 1 month data for this month
        var startDay = new Date();
        var start_date = new Date(startDay.getFullYear(), startDay.getMonth(), 1);
        var end_date = new Date(startDay.getFullYear(), startDay.getMonth() + 1, 0);

        $('#date_start').val(moment(start_date).format('DD MMMM YYYY'));
        $('#date_end').val(moment(end_date).format('DD MMMM YYYY'));
        start_date = moment(start_date).format("YYYY/MM/DD");
        end_date = moment(end_date).format("YYYY/MM/DD");

        //Initialize datepicker
        var picker = new Litepicker({
            firstDay: 1,
            format: "DD MMMM YYYY",
            lang: 'en-US',
            numberOfMonths: 2,
            numberOfColumns: 2,
            autoApply: true,
            showTooltip: true,
            singleMode: false,
            moduleRanges: true,
            element: document.getElementById('report_period'),
            onSelect: function (date1, date2) {

                var startDay = new Date(date1);
                start = startDay;
                end = new Date(date2);

                // $('#report_period').val(moment(start_date).format('DD/MM/YYYY') + " - " + moment(end_date).format('DD/MM/YYYY'));
                $('#date_start').val(moment(start).format('DD MMMM YYYY'));
                $('#date_end').val(moment(end).format('DD MMMM YYYY'));
                start = moment(start).format("YYYY/MM/DD");
                end = moment(end).format("YYYY/MM/DD");

                $(".se-pre-con").fadeIn("fast");

                get_data(start, end);
                set_all_data();

                $(".se-pre-con").fadeOut("fast");


            }
        });

        //set datepicker value
        picker.setDateRange(start_date, end_date);

        $(".se-pre-con").fadeIn("fast");

        get_data(start_date, end_date);
        set_all_data();

        $(".se-pre-con").fadeOut("fast");

    });

</script>


{{-- SCRIPT PDF --}}
<script type="text/javascript">
    var RoomPie = am4core.create("room_chart", am4charts.PieChart3D);


    function savePDF() {
        $(".se-pre-con").fadeIn('fast');


        var imgToExport = document.getElementById('imgToExport');
        var canvas = document.createElement('canvas');
            canvas.width = imgToExport.width;
            canvas.height = imgToExport.height;
            canvas.getContext('2d').drawImage(imgToExport, 0, 0);
        var logoUrl = canvas.toDataURL('image/png');
        // var checkbox_report = document.getElementsByClassName('checkbox_report');

        var StartDate = $('#date_start').val();
        var EndDate = $('#date_end').val();

        var period = StartDate + " - " + EndDate;

        var room_sales_report = [
            [{
                    text: 'Reservation Number',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: 'Customer Name',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Reserved Rooms',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Check In',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Check Out',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Status',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                }
            ]
        ];

        var product_sales_report = [
            [{
                    text: 'Reservation Number',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: 'Customer Name',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Customer Email',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Reserved Package',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Date',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Status',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                }
            ]
        ];

        var inquiry_report = [
            [{
                    text: 'Reservation Number',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: 'Customer Name',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Customer Email',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Inquiry Type',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: 'Package',
                    bold: true,
                    fontSize: 9.5,
                    fillColor: '#F2F2F2',
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                }
            ]
        ];

        room_reservation_all.forEach(function (sourceRow) {
            var dataRow = [{
                    text: sourceRow[0],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[1],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: sourceRow[2],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[3],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[4],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[5],
                    fontSize: 9,
                    alignment: 'center',
                    color: '#219653',
                    margin: [0, 6, 0, 6]
                }
            ];

            room_sales_report.push(dataRow)
        });

        product_reservation_all.forEach(function (sourceRow) {
            var dataRow = [{
                    text: sourceRow[0],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[1],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: sourceRow[2],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[3],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[4],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[5],
                    fontSize: 9,
                    alignment: 'center',
                    color: '#219653',
                    margin: [0, 6, 0, 6]
                }
            ];

            product_sales_report.push(dataRow)
        });

        inquiry_reservation_all.forEach(function (sourceRow) {
            var dataRow = [{
                    text: sourceRow[0],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[1],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 5, 0, 5]
                },
                {
                    text: sourceRow[2],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[3],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                },
                {
                    text: sourceRow[4],
                    fontSize: 9,
                    alignment: 'center',
                    margin: [0, 6, 0, 6]
                }
            ];

            inquiry_report.push(dataRow)
        });

        Promise.all([
            RoomPie.exporting.pdfmake,
            // RoomPie.exporting.getImage("png"),
            // ProductPie.exporting.getImage("png")
        ]).then(function (res) {

            var pdfMake = res[0];

            // pdfmake is ready
            // Create document template
            var doc = {
                pageSize: "A4",
                pageOrientation: "portrait",
                pageMargins: [30, 95, 30, 30],
                header: {
                    margin: [30, 30, 30, 30],
                    columns: [{
                            // usually you would use a dataUri instead of the name for client-side printing
                            // sampleImage.jpg however works inside playground so you can play with it
                            image: logoUrl,
                            // text: "ini gambar icon",
                            width: 150
                        },
                        {
                            stack: [
                                // second column consists of paragraphs
                                {
                                    text: 'HORISON RESERVATION REPORT',
                                    fontSize: 17,
                                    bold: true,
                                    color: '#333333',
                                    margin: [0, 5, 0, 3]
                                },
                                {
                                    text: "Report Period: " + period + "",
                                    fontSize: 10,
                                    color: '#333333'
                                },
                            ],
                        },
                    ],
                    // optional space between columns
                    columnGap: 20
                },
                footer: {
                    margin: [10, 10, 10, 10],
                    columns: [{
                        // usually you would use a dataUri instead of the name for client-side printing
                        // sampleImage.jpg however works inside playground so you can play with it
                        // image: logoUrl,
                        text: 'Generated in ' + moment(new Date()).format('LLLL'),
                        fontSize: 8,
                        bold: true,
                        color: '#333333',
                        alignment: 'right',
                        margin: [0, 0, 0, 0]
                    }, ],
                    // optional space between columns
                    columnGap: 20
                },
                content: []
            };

            doc.content.push({
                text: "General",
                bold: true,
                fontSize: 17,
                color: '#333333',
                margin: [0, 5, 0, 17]
            });
            doc.content.push({
                columns: [{
                        stack: [{
                                text: 'TOTAL RESERVATION MADE',
                                fontSize: 10,
                                bold: true,
                                color: '#C0C0C0',
                                margin: [0, 0, 0, 5]
                            },
                            {
                                text: formatRibuan(total_transaction),
                                fontSize: 14,
                                bold: true,
                                color: '#333333',
                                alignment: 'center'
                            },
                        ],
                        width: 'auto',
                    },
                    {
                        stack: [{
                                text: 'TOTAL ROOMS RESERVATION',
                                fontSize: 10,
                                bold: true,
                                color: '#C0C0C0',
                                margin: [0, 0, 0, 5]
                            },
                            {
                                text: formatRibuan(total_room),
                                fontSize: 14,
                                bold: true,
                                color: '#333333',
                                alignment: 'center'
                            },
                        ],
                        width: 'auto',
                    },
                    {
                        stack: [{
                                text: 'TOTAL PACKAGE RESERVATION',
                                fontSize: 10,
                                bold: true,
                                color: '#C0C0C0',
                                margin: [0, 0, 0, 5]
                            },
                            {
                                text: formatRibuan(total_product),
                                fontSize: 14,
                                bold: true,
                                color: '#333333',
                                alignment: 'center'
                            },
                        ],
                        width: 'auto',
                    },
                    {
                        stack: [{
                                text: 'TOTAL INQUIRY',
                                fontSize: 10,
                                bold: true,
                                color: '#C0C0C0',
                                margin: [0, 0, 0, 5]
                            },
                            {
                                text: formatRibuan(total_inquiry),
                                fontSize: 14,
                                bold: true,
                                color: '#333333',
                                alignment: 'center'
                            },
                        ],
                        width: 'auto',
                    }
                ],
                // optional space between columns
                columnGap: 15
            });

            doc.content.push({
                text: "All Room Booking",
                bold: true,
                fontSize: 17,
                color: '#333333',
                margin: [0, 30, 0, 17]
            });
            doc.content.push({
                table: {
                    headerRows: 1,
                    widths: ["20%", "auto", "auto", "auto", "auto", "auto"],
                    body: room_sales_report
                }
            });

            doc.content.push({
                text: "All Package Booking",
                bold: true,
                fontSize: 17,
                color: '#333333',
                margin: [0, 30, 0, 17]
            });
            doc.content.push({
                table: {
                    headerRows: 1,
                    widths: ["20%", "auto", "auto", "auto", "auto", "auto"],
                    body: product_sales_report
                }
            });

            doc.content.push({
                text: "All Inquiry",
                bold: true,
                fontSize: 17,
                color: '#333333',
                margin: [0, 30, 0, 17]
            });
            doc.content.push({
                table: {
                    headerRows: 1,
                    widths: ["25%", "20%", "auto", "15%", "auto"],
                    body: inquiry_report
                }
            });

            pdfMake.createPdf(doc).download("reservation_report-" + period + ".pdf");
            // pdfMake.createPdf(doc).open();
            $(".se-pre-con").fadeOut('fast');


        });


    }

</script>


@endsection
