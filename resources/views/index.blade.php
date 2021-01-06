@extends('templates/template')
@section("header_title") DASHBOARD @endsection
@section('content')

<br>

<div class="col-lg-12">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
            {{-- TAMPILAN CHART DEKSTOP VERSION --}}
            <div class="panel panel-primary panel-shadow rsv_made_thismonth" data-collapsed="0">
                <!-- panel head -->
                <div class="panel-heading"
                    style="background-image: url('/images/dashboard/header-1.png');background-size: 769px 59px; background-repeat: no-repeat; background-position:right;">
                    <div class="panel-title col-xs-8 col-sm-10" style="margin-top:7px">
                        <h5><b>Room Reservation Made This Month</b></h5>
                    </div>
                    <div class="panel-options">
                        {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <b>Total Reservation</b>
                    <div id="chartdiv" style="width: 100%; height: 500px;"></div>
                    <br>
                    <center><b>Room Type</b></center>
                </div>
            </div>

            {{-- TAMPILAN CHART MOBILE VERSION --}}
            <div class="panel panel-primary panel-shadow rsv_made_thismonth_mobile" data-collapsed="0">
                <!-- panel head -->
                <div class="panel-heading"
                    style="background-image: url('/images/dashboard/header-1.png');background-size: 769px 59px; background-repeat: no-repeat; background-position:right;">
                    <div class="panel-title col-xs-8 col-sm-10" style="margin-top:7px">
                        <h5><b>Room Reservation Made This Month</b></h5>
                    </div>
                    <div class="panel-options">
                        {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body" id="mobile_body">

                </div>
                <div class="panel-heading heading_light">
                    <div class="col-md-8 col-sm-9 col-xs-8" style="margin-top: 14px">
                        <h5><b>Total Reservation</b></h5>
                    </div>
                    <div class="col-md-4 col-sm-3 col-xs-4" style="text-align: right; margin-top: 14px;">
                        <h5 id="total_reservation_mobile"><b></b></h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
            <div class="panel panel-primary panel-shadow" data-collapsed="0">
                <!-- panel head -->
                <div class="panel-heading" style="background-image: url('/images/dashboard/header-2.png'); background-size: 369px 59px; background-repeat: no-repeat; background-position:right;">
                    <div class="panel-title col-md-9 col-xs-8" style="margin-top:7px">
                        <h5><b>Today Remaining Allotment</b></h5>
                    </div>
                    <div class="panel-options">
                        {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body" id="remaining_allotment">
                </div>
                <div class="panel-heading heading_light">
                    <div class="col-md-8 col-sm-9 col-xs-8" style="margin-top: 14px">
                        <h5><b>Total Remaining Allotment</b></h5>
                    </div>
                    <div class="col-md-4 col-sm-3 col-xs-4" style="text-align: right; margin-top: 14px;">
                        <h5 style="font-weight: bold;" id="total_remaining_allotment"><b>15</b></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-primary panel-shadow" data-collapsed="0">
                <!-- panel head -->
                <div class="panel-heading" style="background-image: url('/images/dashboard/header-3.png'); background-size: 1169px 59px; background-repeat: no-repeat; background-position:right;">
                    <div class="panel-title col-xs-8" style="margin-top:5px">
                        <h5 class="fontheader">
                            <span class="numberlg" id="today_guest"><b>10</b></span>
                            <b>Guest(s) Check - In for Today</b>
                        </h5>
                    </div>
                    <div class="panel-options">
                        {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                    </div>
                </div>
                <!-- panel body -->
                <div class="panel-body">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped table-bordered datatable" id="table-today_reservation">
                            <thead>
                                <tr>
                                    <th class="horisonth">Reservation Number</th>
                                    <th class="horisonth">Customer Name</th>
                                    <th class="horisonth">Guest Name</th>
                                    <th class="horisonth">Guest Amount</th>
                                    <th class="horisonth">Phone Number</th>
                                    <th class="horisonth">Reserved Rooms</th>
                                    <!-- <th class="horisonth">Duration of Stay</th> -->
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="panel panel-primary panel-shadow" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading" style="background-image: url('/images/dashboard/header-4.png'); background-size: 569px 59px; background-repeat: no-repeat; background-position:right;">
                    <div class="panel-title col-xs-8 col-sm-9" style="margin-top:5px">
                        <h5 class="fontheader">
                            <span class="numberlg" id="total_product_online"><b>5</b></span>
                            <b>Package/Product(s) Reserved Today</b>
                        </h5>
                    </div>
                    <div class="panel-options">
                        {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped table-bordered datatable" id="table-2">
                            <thead>
                                <tr>
                                    <th class="horisonth">Reservation Number</th>
                                    <th class="horisonth">Customer Name</th>
                                    <th class="horisonth">Reserved Package</th>
                                    <th class="horisonth">Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <div class="panel panel-primary panel-shadow" data-collapsed="0">

                <!-- panel head -->
                <div class="panel-heading" style="background-image: url('/images/dashboard/header-4.png'); background-size: 569px 59px; background-repeat: no-repeat; background-position:right;">

                    <div class="panel-title col-xs-9 col-sm-9" style="margin-top:5px">
                        <h5 class="fontheader">
                            <span class="numberlg" id="total_product_offline"><b>2</b></span>
                            <b>Offline Package/Product(s) Inquired Today</b>
                        </h5>
                    </div>
                    <div class="panel-options">
                        {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                    </div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped table-bordered datatable" id="table-3">
                            <thead>
                                <tr>
                                    <th class="horisonth">Reservation Number</th>
                                    <th class="horisonth">Customer Name</th>
                                    <th class="horisonth">Inquired Package</th>
                                    <th class="horisonth">E-mail</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

<canvas id="myChart" width="0" height="0"></canvas>

<script>
    var rooms = 0;

    var room_this_month_reservation = 0;

    var room_total_today = 0;
    var room_today_reservation_data = [];

    var room_reservations = [];

    var online_products = 0;
    var offline_product_today = [];
    var total_product_offline = 0;

    var online_product_today = [];
    var total_product_online = 0;

    var date = new Date();
    var firstDayThisMonth = new Date(date.getFullYear(),
        date.getMonth(), 1);
    var lastDayThisMonth =
        new Date(date.getFullYear(), date.getMonth() + 1, 0);
    jQuery(document).ready(function ($) {
        set_room_this_month();
    });

    function get_data() {

        room_this_month_reservation = $.ajax({
            type: 'GET',
            url: "{{route('dashboard.reservation_this_month')}}",
            async: false,
            dataType: 'json',
            done: function (results) {
                // Uhm, maybe I don't even need this?
                JSON.parse(results);
                return results;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON;


        online_products = $.ajax({
            type: 'GET',
            url: "{{route('dashboard.online_product_today')}}",
            async: false,
            dataType: 'json',
            done: function (results) {
                // Uhm, maybe I don't even need this?
                JSON.parse(results);
                return results;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON;

        offline_products = $.ajax({
            type: 'GET',
            url: "{{route('dashboard.offline_product_today')}}",
            async: false,
            dataType: 'json',
            done: function (results) {
                // Uhm, maybe I don't even need this?
                JSON.parse(results);
                return results;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON;

        rooms = $.ajax({
            type: 'GET',
            url: "{{route('dashboard.room_today')}}",
            async: false,
            dataType: 'json',
            done: function (results) {
                // Uhm, maybe I don't even need this?
                JSON.parse(results);
                return results;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON;

    }

    function set_room_this_month() {
        get_data();

        var room_total = 0;
        var html = '';
        var path = "{{asset('/user/')}}";
        room_this_month_reservation.forEach(function (room, i) {
            //for CHART

            room_reservations.push({
                "room": room.room_name,
                "reserved": room.total_reserve,
                "href": path + '/' + room.photo_path
            });

            //for Today Remaining Allotment
            html += '<div class="row">' +
                '<div class="col-md-9 col-sm-10 col-xs-8">' +
                '<h5><span><i class="fa fa-hotel"></i>&ensp;' + room.room_name + '</span></h5>' +
                '</div>' +
                '<div class="col-md-3 col-sm-10 col-xs-4" style="text-align: right">' +
                '<h5>' + room.allotment_remaining + ' &ensp;</h5>' +
                '</div>' +
                '</div>' +
                '<hr class="custom" />';
            room_total += parseInt(room.allotment_remaining);
        });

        $('#remaining_allotment').append(html);
        $('#total_remaining_allotment').text(room_total);

        var html = '';
        var total_reservation = 0;

        room_reservations.forEach(element => {
            html += '<div class="row">'+
                        '<div class="col-md-8 col-sm-8 col-xs-8">'+
                            '<h5><span><i class="fa fa-hotel"></i>&ensp; '+element.room+'</span></h5>'+
                        '</div>'+
                        '<div class="col-md-4 col-sm-4 col-xs-4" style="text-align: right">'+
                            '<h5>'+element.reserved+' &ensp;</h5>'+
                        '</div>'+
                    '</div>'+
                    '<hr class="custom" />';
            total_reservation += parseInt(element.reserved);
        });

        $('#mobile_body').append(html);
        $('#total_reservation_mobile').text(total_reservation);

        online_products.forEach(function (product, i) {
            var date = moment(new Date(product.rsvp_date_reserve)).format("DD MMMM YYYY");

            online_product_today.push([product.reservation_id, product.rsvp_cust_name, product
                    .product_name, date
                ]);
            total_product_online++;
        });

        offline_products.forEach(function (product, i) {
            if(product.inq_type == 0){
                var product_name = "General Inquiry"
            }else{
                var product_name = product.product_name;
            }

            offline_product_today.push([product.reservation_id, product.inq_cust_name,
                                            product_name, product.cust_email
                                        ]);
            total_product_offline++;
        });

        rooms.forEach(function (room, i) {
            var customer_name = room.rsvp_cust_name;
            if(room.rsvp_guest_name == null){
                var guest_name = customer_name;
            }else{
                var guest_name = room.rsvp_guest_name;
            }

            var phone_number = room.rsvp_cust_phone;
            var guest_amount = room.rsvp_adult +" Adult " +room.rsvp_child+" Child";

            room_today_reservation_data.push([room.reservation_id, customer_name, guest_name, guest_amount,
                                             phone_number, room.rsvp_reserved_room
            ]);
            room_total_today++;
        });

        $('#today_guest').text(room_total_today);
        $('#total_product_offline').text(total_product_offline);
        $('#total_product_online').text(total_product_online);
    }

    am4core.ready(function () {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        /**
         * Chart design taken from Samsung health app
         */

        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.paddingBottom = 30;

        //INSERT DATA INTO CHART
        chart.data = room_reservations;

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "room";
        categoryAxis.renderer.grid.template.strokeOpacity = 0;
        categoryAxis.renderer.minGridDistance = 50;
        categoryAxis.renderer.labels.template.dy = 40;
        categoryAxis.renderer.tooltip.dy = 35;

        var label = categoryAxis.renderer.labels.template;
        label.wrap = true;
        label.maxWidth = 90;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.inside = true;
        valueAxis.renderer.labels.template.fillOpacity = 0.3;
        valueAxis.renderer.grid.template.strokeOpacity = 0;
        valueAxis.min = 0;
        valueAxis.cursorTooltipEnabled = false;
        valueAxis.renderer.baseGrid.strokeOpacity = 0;

        var series = chart.series.push(new am4charts.ColumnSeries);
        series.dataFields.valueY = "reserved";
        series.dataFields.categoryX = "room";
        series.tooltipText = "{valueY.value}";
        series.tooltip.pointerOrientation = "vertical";
        series.tooltip.dy = -6;
        series.columnsContainer.zIndex = 100;

        var columnTemplate = series.columns.template;
        columnTemplate.width = am4core.percent(50);
        columnTemplate.maxWidth = 66;
        columnTemplate.column.cornerRadius(60, 60, 10, 10);
        columnTemplate.strokeOpacity = 0;

        series.heatRules.push({
            target: columnTemplate,
            property: "fill",
            dataField: "valueY",
            min: am4core.color("#e5dc36"),
            max: am4core.color("#5faa46")
        });

        series.mainContainer.mask = undefined;

        var cursor = new am4charts.XYCursor();
        chart.cursor = cursor;
        cursor.lineX.disabled = true;
        cursor.lineY.disabled = true;
        cursor.behavior = "none";
        chart.logo.disabled = true;

        var bullet = columnTemplate.createChild(am4charts.CircleBullet);
        bullet.circle.radius = 30;
        bullet.valign = "bottom";
        bullet.align = "center";
        bullet.isMeasured = true;
        bullet.mouseEnabled = false;
        bullet.verticalCenter = "bottom";
        bullet.interactionsEnabled = false;

        var hoverState = bullet.states.create("hover");
        var outlineCircle = bullet.createChild(am4core.Circle);
        outlineCircle.adapter.add("radius", function (radius, target) {
            var circleBullet = target.parent;
            return circleBullet.circle.pixelRadius + 10;
        })

        var image = bullet.createChild(am4core.Image);
        image.width = 60;
        image.height = 60;
        image.horizontalCenter = "middle";
        image.verticalCenter = "middle";
        image.propertyFields.href = "href";

        image.adapter.add("mask", function (mask, target) {
            var circleBullet = target.parent;
            return circleBullet.circle;
        })

        var previousBullet;
        chart.cursor.events.on("cursorpositionchanged", function (event) {
            var dataItem = series.tooltipDataItem;

            if (dataItem.column) {
                var bullet = dataItem.column.children.getIndex(1);

                if (previousBullet && previousBullet != bullet) {
                    previousBullet.isHover = false;
                }

                if (previousBullet != bullet) {

                    var hs = bullet.states.getKey("hover");
                    hs.properties.dy = -bullet.parent.pixelHeight + 30;
                    bullet.isHover = true;

                    previousBullet = bullet;
                }
            }
        })

    }); // end am4core.ready()

    //TABLE 1//
    var $today_reservation = jQuery('#table-today_reservation');

    //TABLE 2//
    var $online_product_today = jQuery('#table-2');

    //TABLE 3//
    var $offline_product_today = jQuery('#table-3');

    jQuery(document).ready(function ($) {

        // Initialize DataTable
        $today_reservation.DataTable({
            data: room_today_reservation_data,
            "aLengthMenu": [
                [5, 10, 50, -1],
                [5, 10, 50]
            ],
            "bStateSave": true
        });

        $today_reservation.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });

        // Initialize DataTable
        $online_product_today.DataTable({
            data: online_product_today,
            "aLengthMenu": [
                [3, 5, 10, -1],
                [3, 5, 10, "All"]
            ],
            "bStateSave": true
        });

        // Initialize DataTable
        $offline_product_today.DataTable({
            data: offline_product_today,
            "aLengthMenu": [
                [3, 5, 10, -1],
                [3, 5, 10, "All"]
            ],
            "bStateSave": true
        });

        // Initalize Select Dropdown after DataTables is created
        $online_product_today.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });

        // Initalize Select Dropdown after DataTables is created
        $offline_product_today.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
    });

</script>
@endsection
