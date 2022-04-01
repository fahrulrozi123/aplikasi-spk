@extends('templates/template')
@section('header_title')
    SALES REPORT
@endsection
@section('content')
    <br>

    {{-- FOR EXPORT PURPOSE --}}
    <div style='display:none'>
        <img id='imgToExport' src="{{ asset('images/logo/' . $setting->logo) }}" />
    </div>

    {{-- FOR EXPORT PURPOSE --}}
    <form id="sales_export_excel" action="{{ route('sales.sales_export_excel') }}" method="post" target="_blank">
        {{ csrf_field() }}
    </form>

    <div class="col-lg-12">
        <div class="row">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="field-1" class="control-label">Report Period</label>
                        <div class="input-group">
                            <input class="form-control borderlight" id="report_period" name="report_period" readonly>
                            <span class="input-group-addon borderlight darkfont"><i class="entypo-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 25px">
                    <input form="sales_export_excel" type="hidden" id="date_start" name="date_start" value="0">
                    <input form="sales_export_excel" type="hidden" id="date_end" name="date_end" value="0">
                    <a id="export_pdf_modal" class="btn btn-horison-gold export_pdf_modal">
                        <i class="fa fa-file-pdf-o"></i>&ensp;Export to PDF
                    </a>
                    <button form="sales_export_excel" type="submit" class="btn btn-horison-gold ">
                        <i class="fa fa-file-pdf-o"></i>&ensp;Export to Excel
                    </button>
                </div>
            </div>

            <hr>
            <br>

            {{-- GENERAL --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary panel-shadow" data-collapsed="0">
                        <!-- panel body -->
                        <div class="panel-body shadow">
                            <h2>
                                <b>GENERAL</b>
                            </h2>

                            <div class="box-custreport shadow">
                                <div class="row">
                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>TOTAL TRANSACTION</b></h5>
                                        <h3 style="margin-top: 3%"><b id="total_transaction">50</b></h3>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>ROOM RESERVATION</b></h5>
                                        <h3 style="margin-top: 3%"><b class="room_total_reservation">40</b></h3>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>PACKAGE RESERVATION</b></h5>
                                        <h3 style="margin-top: 3%"><b class="product_total_reservation">10</b></h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>GROSS SALES</b></h5>
                                        <h3 style="margin-top: 3%"><b id="gross_sales">Rp 65,000,000</b></h3>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>SERVICE SALES</b></h5>
                                        <h3 style="margin-top: 3%"><b id="service_sales">Rp 65,000,000</b></h3>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>TAX SALES</b></h5>
                                        <h3 style="margin-top: 3%"><b id="tax_sales">Rp 6,500,000</b></h3>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>NETT SALES</b></h5>
                                        <h3 style="margin-top: 3%; color:seagreen"><b id="nett_sales">Rp 58,500,000</b></h3>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <h3>
                                <b>MOST RESERVED ROOMS & PACKAGE</b>
                            </h3>

                            <div class="row report-ipad" style="padding: 15px;">
                                <div class="col-sm-6 col-md-12 col-lg-6" id="room_pie_chart">
                                    <div style="font-size: 13px"><strong>Rooms</strong></div>
                                    <br />
                                    <!-- HTML -->
                                    <div id="room_chart" style="width: 100%;height: 300px;"></div><br>
                                    {{-- <div id="chart5" style="height: 250px"></div> --}}
                                    <!-- <canvas id="RoomsChart" style="margin-botto m:20px"></canvas> -->
                                </div>

                                <div class="col-sm-6 col-md-12 col-lg-6" id="package_pie_chart">
                                    <div style="font-size: 13px"><strong>Package / Product</strong></div>
                                    <br />
                                    {{-- <div id="chart5" style="height: 250px"></div> --}}
                                    <div id="product_chart" style="width: 100%;height: 300px;"></div>
                                    <!-- <canvas id="PackageChart"></canvas> -->
                                </div>
                            </div>
                            <br>

                            {{-- ROOM SALES --}}
                            <div id="cek_room_sales" class="panel panel-primary" data-collapsed="0">
                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>
                                            <strong>ROOM SALES</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-options">
                                        {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                                        <a id="btn_room_sales" href="#" data-rel="collapse">
                                            <i class="entypo-down-open"></i>
                                        </a>
                                        {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                                    </div>
                                </div>

                                <!-- panel body -->
                                <div class="panel-body no-padding">
                                    <div style="overflow-x:auto;">
                                        <table class="table table-striped table-bordered datatable"
                                            id="table-room_reservation">
                                            <thead>
                                                <tr>
                                                    <th class="horisonth">Room Type</th>
                                                    <th class="horisonth">Sold</th>
                                                    <th class="horisonth">Average Rate</th>
                                                    <th class="horisonth">Room Revenue</th>
                                                    <th class="horisonth">Tax Collected</th>
                                                    <th class="horisonth">Services Collected</th>
                                                    <th class="horisonth">Nett Sales</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>

                            {{-- PACKAGE SALES --}}
                            <div id="cek_package_sales" class="panel panel-primary" data-collapsed="0">
                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>
                                            <strong>PACKAGE SALES</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-options">
                                        {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                                        <a id="btn_package_sales" href="#" data-rel="collapse">
                                            <i class="entypo-down-open"></i>
                                        </a>
                                        {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                                    </div>
                                </div>

                                <!-- panel body -->
                                <div class="panel-body no-padding">
                                    <div style="overflow-x:auto;">
                                        <table class="table table-striped table-bordered datatable"
                                            id="table-product_reservation">
                                            <thead>
                                                <tr>
                                                    <th class="horisonth">Package Name</th>
                                                    <th class="horisonth">Sold</th>
                                                    <th class="horisonth">Average Rate</th>
                                                    <th class="horisonth">Package Revenue</th>
                                                    <th class="horisonth">Tax Collected</th>
                                                    <th class="horisonth">Services Collected</th>
                                                    <th class="horisonth">Nett Sales</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr class="horisontd">
                                                    <td style="vertical-align:middle" align="center">Deluxe Business</td>
                                                    <td style="vertical-align:middle" align="center">4</td>
                                                    <td style="vertical-align:middle" align="center">Rp 5,900,000</td>
                                                    <td style="vertical-align:middle" align="center">Rp 590,000</td>
                                                    <td style="vertical-align:middle" align="center">Rp 3,300,000</td>
                                                    <td style="vertical-align:middle" align="center">Rp 590,000</td>
                                                    <td style="vertical-align:middle" align="center">Rp 3,300,000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            {{-- ALL ROOMS RESERVATION --}}
            <div class="row">
                <div class="col-sm-12">
                    <div id="cek_all_room" class="panel panel-primary panel-shadow" data-collapsed="0">
                        <!-- panel head -->
                        <div class="panel-heading shadow">
                            <div class="panel-title">
                                <h2>
                                    <b>ALL ROOMS RESERVATION</b>
                                </h2>
                            </div>
                            <div class="panel-options">
                                {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                                <a id="btn_all_room" href="#" data-rel="collapse">
                                    <i class="entypo-down-open"></i>
                                </a>
                                {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                            </div>
                        </div>

                        <!-- panel body -->
                        <div class="panel-body shadow">
                            <br>
                            <div class="box-custreport shadow">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>ROOM RESERVATION</b></h5>
                                        <h3 style="margin-top: 3%"><b class="room_total_reservation">20</b></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>GROSS SALES</b></h5>
                                        <h3 style="margin-top: 3%"><b id="room_gross_sales">Rp 50,000,000</b></h3>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>SERVICE SALES</b></h5>
                                        <h3 style="margin-top: 3%"><b id="room_service">Rp 1,500,000</b></h3>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>TAX SALES</b></h5>
                                        <h3 style="margin-top: 3%"><b id="room_tax">Rp 5,000,000</b></h3>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>NETT SALES</b></h5>
                                        <h3 style="margin-top: 3%; color:seagreen"><b id="room_nett_sales">Rp 45,000,000</b>
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row report-ipad" style="padding: 15px;">
                                <br />
                                {{-- <div id="chart5" style="height: 250px"></div> --}}
                                {{-- <canvas id="RoomSalesChart" style="margin-bottom:20px"></canvas> --}}
                                <div id="room_sales_chart" style="width: 100%; height: 500px;"></div>
                            </div>

                            <div class="panel panel-primary" data-collapsed="0">
                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>All Rooms Reservation</strong>
                                    </div>
                                    <div class="panel-options">
                                        {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                                        <a href="#" data-rel="collapse">
                                            <i class="entypo-down-open"></i>
                                        </a>
                                        {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                                    </div>
                                </div>

                                <!-- panel body -->
                                <div class="panel-body no-padding">
                                    <div style="overflow-x:auto;">
                                        <table class="table table-striped table-bordered datatable"
                                            id="table-room_reservation_all">
                                            <thead>
                                                <tr>
                                                    <th class="horisonth">Date</th>
                                                    <th class="horisonth">Reserved Rooms</th>
                                                    <th class="horisonth">ADR</th>
                                                    <th class="horisonth">Room Revenue</th>
                                                    <th class="horisonth">Tax Collected</th>
                                                    <th class="horisonth">Services Collected</th>
                                                    <th class="horisonth">Nett Revenue</th>
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
            <br>

            {{-- ALL PACKAGE RESERVATION --}}
            <div class="row">
                <div class="col-sm-12">
                    <div id="cek_all_package" class="panel panel-primary panel-shadow" data-collapsed="0">
                        <!-- panel head -->
                        <div class="panel-heading shadow">
                            <div class="panel-title">
                                <h2>
                                    <b>ALL PACKAGE RESERVATION</b>
                                </h2>
                            </div>
                            <div class="panel-options">
                                {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                                <a id="btn_all_package" href="#" data-rel="collapse">
                                    <i class="entypo-down-open"></i>
                                </a>
                                {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                            </div>
                        </div>

                        <!-- panel body -->
                        <div class="panel-body shadow">
                            <br>
                            <div class="box-custreport shadow">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>PACKAGE RESERVATION</b></h5>
                                        <h3 style="margin-top: 3%"><b class="product_total_reservation">30</b></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>GROSS SALES</b></h5>
                                        <h3 style="margin-top: 3%"><b id="product_gross_sales">Rp 15,000,000</b></h3>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>SERVICE SALES</b></h5>
                                        <h3 style="margin-top: 3%"><b id="product_service">Rp 1,500,000</b></h3>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>TAX SALES</b></h5>
                                        <h3 style="margin-top: 3%"><b id="product_tax">Rp 1,500,000</b></h3>
                                    </div>

                                    <div class="col-sm-3 col-md-3">
                                        <h5 style="margin-bottom: 0%; color:silver"><b>NETT SALES</b></h5>
                                        <h3 style="margin-top: 3%; color:seagreen"><b id="product_nett_sales">Rp
                                                13,500,000</b></h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row report-ipad" style="padding: 15px;">
                                <br />
                                {{-- <div id="chart5" style="height: 250px"></div> --}}
                                {{-- <canvas id="PackageSalesChart" style="margin-bottom:20px"></canvas> --}}
                                <div id="package_sales_chart" style="width: 100%; height: 500px;"></div>
                            </div>

                            <div class="panel panel-primary" data-collapsed="0">
                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>All Package Reservation</strong>
                                    </div>
                                    <div class="panel-options">
                                        {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                                        <a href="#" data-rel="collapse">
                                            <i class="entypo-down-open"></i>
                                        </a>
                                        {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                                    </div>
                                </div>

                                <!-- panel body -->
                                <div class="panel-body no-padding">
                                    <div style="overflow-x:auto;">
                                        <table class="table table-striped table-bordered datatable"
                                            id="table-product_reservation_all">
                                            <thead>
                                                <tr>
                                                    <th class="horisonth">Reserved Package</th>
                                                    <th class="horisonth">Quantity</th>
                                                    <th class="horisonth">Unit Price</th>
                                                    <th class="horisonth">Revenue</th>
                                                    <th class="horisonth">Tax Collected</th>
                                                    <th class="horisonth">Services Collected</th>
                                                    <th class="horisonth">Nett Revenue</th>
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
        </div>
    </div>

    @include('main_page.report.modal')

    <script type="text/javascript">
        //initiate chart variabel
        var RoomsChart, RoomSalesChart, ProductChart, ProductSalesChart;

        //initate table
        var $room_reservation_all = jQuery('#table-room_reservation_all');
        var $room_reservation = jQuery('#table-room_reservation');
        var $product_reservation_all = jQuery('#table-product_reservation_all');
        var $product_reservation = jQuery('#table-product_reservation');

        var room_chart_data = [];
        var room_sales_data = [];
        var room_reservation = [];
        var room_reservation_all = [];

        var product_reservation = [];
        var product_chart_data = [];
        var product_sales_data = [];
        var product_reservation_all = [];

        var product_data, room_data;

        var total_transaction, total_gross_sales,
            total_service, total_tax, total_nett_sales;

        var total_room_reservation, room_gross_sales,
            room_service_sales, room_tax_sales, room_nett_sales;

        var total_product_reservation, product_gross_sales,
            product_service_sales, product_tax_sales, product_nett_sales;

        function get_data(start_date = null, end_date = null) {
            room_data = $.ajax({
                type: 'GET',
                url: "{{ route('reservation.room_data_success') }}",
                async: false,
                dataType: 'json',
                data: {
                    "start_date": start_date,
                    "end_date": end_date
                },
                done: function(results) {

                    JSON.parse(results);
                    return results;
                },
                fail: function(jqXHR, textStatus, errorThrown) {
                    console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
                }
            }).responseJSON;

            product_data = $.ajax({
                type: 'GET',
                url: "{{ route('reservation.product_data_success') }}",
                async: false,
                dataType: 'json',
                data: {
                    "start_date": start_date,
                    "end_date": end_date
                },
                done: function(results) {

                    JSON.parse(results);
                    return results;
                },
                fail: function(jqXHR, textStatus, errorThrown) {
                    console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
                }
            }).responseJSON;
            $(".lds-dual-ring-admin").fadeOut("fast");

        }
        //TABLE 1//

        var RoomPie = am4core.create("room_chart", am4charts.PieChart3D);
        var ProductPie = am4core.create("product_chart", am4charts.PieChart3D);
        var RoomSales, ProductSales;

        jQuery(document).ready(function($) {
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                //Room Chart
                RoomPie.hiddenState.properties.opacity = 0; // this creates initial fade-in
                RoomPie.logo.disabled = true;

                RoomPie.legend = new am4charts.Legend();

                var series = RoomPie.series.push(new am4charts.PieSeries3D());
                series.dataFields.value = "total";
                series.dataFields.category = "room_name";

                //Product Chart
                ProductPie.hiddenState.properties.opacity = 0; // this creates initial fade-in
                ProductPie.logo.disabled = true;

                ProductPie.legend = new am4charts.Legend();

                var series = ProductPie.series.push(new am4charts.PieSeries3D());
                series.dataFields.value = "total";
                series.dataFields.category = "product_name";
            }); // end am4core.ready()

            am4core.ready(function() {
                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                RoomSales = am4core.create("room_sales_chart", am4charts.XYChart3D);
                RoomSales.paddingBottom = 30;
                RoomSales.angle = 35;
                RoomSales.logo.disabled = true;

                // Set number format
                RoomSales.numberFormatter.numberFormat = "'Rp '#,###";

                // Create axes
                var categoryAxis = RoomSales.yAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "room_name";
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.minGridDistance = 20;
                categoryAxis.renderer.inside = true;
                categoryAxis.renderer.grid.template.disabled = true;

                let labelTemplate = categoryAxis.renderer.labels.template;
                labelTemplate.rotation = -1;
                labelTemplate.horizontalCenter = "left";
                labelTemplate.verticalCenter = "middle";
                labelTemplate.dy = 10; // moves it a bit down;
                labelTemplate.inside =
                    false; // this is done to avoid settings which are not suitable when label is rotated

                var valueAxis = RoomSales.xAxes.push(new am4charts.ValueAxis());
                valueAxis.renderer.grid.template.disabled = true;

                // Create series
                var series = RoomSales.series.push(new am4charts.ConeSeries());
                series.dataFields.valueX = "price";
                series.dataFields.categoryY = "room_name";
                series.columns.template.tooltipText = "{valueX}";

                var columnTemplate = series.columns.template;
                columnTemplate.adapter.add("fill", function(fill, target) {
                    return RoomSales.colors.getIndex(target.dataItem.index);
                })

                columnTemplate.adapter.add("stroke", function(stroke, target) {
                    return RoomSales.colors.getIndex(target.dataItem.index);
                })
            }); // end am4core.ready()

            am4core.ready(function() {
                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                ProductSales = am4core.create("package_sales_chart", am4charts.XYChart3D);
                ProductSales.paddingBottom = 30;
                ProductSales.angle = 35;
                ProductSales.logo.disabled = true;

                // Create axes
                var categoryAxis = ProductSales.yAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "package";
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.minGridDistance = 20;
                categoryAxis.renderer.inside = true;
                categoryAxis.renderer.grid.template.disabled = true;

                let labelTemplate = categoryAxis.renderer.labels.template;
                labelTemplate.rotation = -1;
                labelTemplate.horizontalCenter = "left";
                labelTemplate.verticalCenter = "middle";
                labelTemplate.dy = 10; // moves it a bit down;
                labelTemplate.inside =
                    false; // this is done to avoid settings which are not suitable when label is rotated

                var valueAxis = ProductSales.xAxes.push(new am4charts.ValueAxis());
                valueAxis.renderer.grid.template.disabled = true;

                // Create series
                var series = ProductSales.series.push(new am4charts.ConeSeries());
                series.dataFields.valueX = "price";
                series.dataFields.categoryY = "package";
                series.columns.template.tooltipText = "{valueX}";

                var columnTemplate = series.columns.template;
                columnTemplate.adapter.add("fill", function(fill, target) {
                    return ProductSales.colors.getIndex(target.dataItem.index);
                })

                columnTemplate.adapter.add("stroke", function(stroke, target) {
                    return ProductSales.colors.getIndex(target.dataItem.index);
                })

            }); // end am4core.ready()

            // Initialize DataTable
            $room_reservation_all.DataTable({
                // dom: 'lBfrtip',
                // buttons: [
                //     'copyHtml5',
                //     'excelHtml5',
                //     'csvHtml5',
                //     'pdfHtml5'
                // ],
                "aLengthMenu": [
                    [5, 10, -1],
                    [5, 10, 50]
                ],
                "bStateSave": true
            });

            // Initalize Select Dropdown after DataTables is created
            $room_reservation_all.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });

            // Initialize DataTable
            $room_reservation.DataTable({
                "aLengthMenu": [
                    [5, 10, -1],
                    [5, 10, 50]
                ],
                "bStateSave": true
            });

            // Initalize Select Dropdown after DataTables is created
            $room_reservation.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });

            // Initialize DataTable
            $product_reservation_all.DataTable({
                "aLengthMenu": [
                    [5, 10, -1],
                    [5, 10, 50]
                ],
                "bStateSave": true
            });

            // Initalize Select Dropdown after DataTables is created
            $product_reservation_all.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });

            // Initialize DataTable
            $product_reservation.DataTable({
                "aLengthMenu": [
                    [5, 10, -1],
                    [5, 10, 50]
                ],
                "bStateSave": true
            });

            // Initalize Select Dropdown after DataTables is created
            $product_reservation.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });

            //to set 1 month data for this month
            var startDay = new Date();
            var start_date = new Date(startDay.getFullYear(), startDay.getMonth(), 1);
            var end_date = new Date(startDay.getFullYear(), startDay.getMonth() + 1, 0);
            // $('#report_period').val(moment(start_date).format('DD/MM/YYYY') + " - " + moment(end_date).format('DD/MM/YYYY'));
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
                onSelect: function(date1, date2) {
                    var startDay = new Date(date1);
                    start = startDay;
                    end = new Date(date2);

                    // $('#report_period').val(moment(start_date).format('DD/MM/YYYY') + " - " + moment(end_date).format('DD/MM/YYYY'));
                    $('#date_start').val(moment(start).format('DD MMMM YYYY'));
                    $('#date_end').val(moment(end).format('DD MMMM YYYY'));
                    start = moment(start).format("YYYY/MM/DD");
                    end = moment(end).format("YYYY/MM/DD");

                    $(".lds-dual-ring-admin").fadeIn("fast");
                    get_data(start, end);
                    set_all_data();
                    $(".lds-dual-ring-admin").fadeOut("fast");
                }
            });

            //set datepicker value
            picker.setDateRange(start_date, end_date);

            $(".lds-dual-ring-admin").fadeIn("fast");

            //set table data
            get_data(start_date, end_date);
            set_all_data();

            $(".lds-dual-ring-admin").fadeOut("fast");
        });

        //MODAL EXPORT TO PDF BUTTON//
        $(document).on('click', '.export_pdf_modal', function() {
            $('#modal_export_pdf').modal("show");
        });

        function set_all_data() {
            // 351 baris menjadi 190 baris
            room_reservation = [];
            room_data['room'].forEach(element => {
                room_reservation.push([element.room_type, formatRibuan(element.total_room_sales ?? 0), formatRupiah(
                        element.average_rate ?? 0), formatRupiah(element.room_revenue ?? 0),
                    formatRupiah(element.tax_collected ?? 0), formatRupiah(element.service_collected ?? 0),
                    formatRupiah(element.nett_sales ?? 0)
                ]);
            });

            $room_reservation.dataTable();
            $room_reservation.fnClearTable();
            if (room_reservation.length > 0) {
                $room_reservation.fnAddData(room_reservation);
            }

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

                check_in = moment(check_in).format('DD MMMM YYYY');
                check_out = moment(check_out).format('DD MMMM YYYY');
                var date = check_in + " - " + check_out;

                var ADR = Math.floor(element.rsvp_grand_total / total_stay);
                var nett_sales = parseInt(element.rsvp_grand_total) - parseInt(element.rsvp_service) - parseInt(
                    element.rsvp_tax);
                room_reservation_all.push([date, element.reserved_rooms, formatRupiah(ADR),
                    formatRupiah(element.rsvp_grand_total), formatRupiah(element.rsvp_tax),
                    formatRupiah(element.rsvp_service), formatRupiah(nett_sales)
                ]);
            });

            $room_reservation_all.dataTable();
            $room_reservation_all.fnClearTable();
            if (room_reservation_all.length > 0) {
                $room_reservation_all.fnAddData(room_reservation_all);
            }

            product_reservation = [];
            product_data['product'].forEach(element => {
                product_reservation.push([element.product_name, formatRibuan(element.total_product_sales ?? 0),
                    formatRupiah(element.average_rate ?? 0), formatRupiah(element.product_revenue ?? 0),
                    formatRupiah(element.tax_collected ?? 0), formatRupiah(element.service_collected ?? 0),
                    formatRupiah(element.nett_sales ?? 0)
                ]);
            });

            $product_reservation.dataTable();
            $product_reservation.fnClearTable();
            if (product_reservation.length > 0) {
                $product_reservation.fnAddData(product_reservation);

            }

            product_reservation_all = [];
            product_data['rsvp'].forEach(element => {
                product_reservation_all.push([element.product_name, formatRibuan(element.rsvp_amount_pax),
                    formatRupiah(element.rsvp_pax_price),
                    formatRupiah(element.rsvp_grand_total), formatRupiah(element.rsvp_tax),
                    formatRupiah(element.rsvp_service), formatRupiah(element.rsvp_total_amount)
                ]);
            });

            $product_reservation_all.dataTable();
            $product_reservation_all.fnClearTable();
            if (product_reservation_all.length > 0) {
                $product_reservation_all.fnAddData(product_reservation_all);
            }

            //set array to default
            room_chart_data = [];
            room_sales_data = [];

            //push data into chart data
            room_data['room'].forEach(element => {
                room_chart_data.push({
                    room_name: element.room_type,
                    total: element.total_room_sales
                });
                room_sales_data.push({
                    room_name: element.room_type,
                    price: element.room_revenue
                });
            });

            product_chart_data = [];
            product_sales_data = [];

            product_data['product'].forEach(element => {
                product_chart_data.push({
                    product_name: element.product_name,
                    total: element.total_product_sales
                });

                product_sales_data.push({
                    package: element.product_name,
                    price: element.product_revenue
                });
            });

            room_chart_data.sort(function(a, b) {
                return b.total - a.total
            });

            for (let i = 0; i < room_chart_data.length; i++) {
                if (i > 3 && product_chart_data[i] != undefined) {
                    room_chart_data[3].room_name = "Other";
                    room_chart_data[3].total = parseInt(room_chart_data[3].total) + parseInt(room_chart_data[i].total);
                    delete room_chart_data[i];
                }

            }

            product_chart_data.sort(function(a, b) {
                return b.total - a.total
            });

            for (let i = 0; i < product_chart_data.length; i++) {
                if (i > 3 && product_chart_data[i] != undefined) {
                    product_chart_data[3].product_name = "Other";
                    product_chart_data[3].total = parseInt(product_chart_data[3].total) + parseInt(product_chart_data[i]
                        .total);
                    delete product_chart_data[i];
                }
            }

            //push Data to chart
            var total = 0;
            room_chart_data.forEach(element => {
                total += element.total;
            });
            if (total == 0) {
                $('#room_pie_chart').fadeOut();
            } else {
                addDatas(RoomPie, room_chart_data);
                $('#room_pie_chart').fadeIn();
            }

            //push Data to chart
            var total = 0;
            room_sales_data.forEach(element => {
                total += element.price;
            });

            if (total == 0) {
                $('#room_sales_chart').fadeOut();
            } else {
                addDatas(RoomSales, room_sales_data);
                $('#room_sales_chart').fadeIn();
            }

            //push Data to chart
            var total = 0;
            product_chart_data.forEach(element => {
                total += element.total;
            });

            if (total == 0) {
                $('#package_pie_chart').fadeOut();
            } else {
                addDatas(ProductPie, product_chart_data);
                $('#package_pie_chart').fadeIn();
            }

            //push Data to sales chart
            var total = 0;
            product_sales_data.forEach(element => {
                total += element.price;
            });

            if (total == 0) {
                $('#package_sales_chart').fadeOut();
            } else {
                addDatas(ProductSales, product_sales_data);
                $('#package_sales_chart').fadeIn();
            }

            total_transaction = parseInt(room_data['total_transaction'] ?? 0) + parseInt(product_data[
                'total_transaction'] ?? 0);
            total_gross_sales = parseInt(room_data['gross_sales'] ?? 0) + parseInt(product_data['gross_sales'] ?? 0);
            total_service = parseInt(room_data['total_service'] ?? 0) + parseInt(product_data['total_service'] ?? 0);
            total_tax = parseInt(room_data['total_tax'] ?? 0) + parseInt(product_data['total_tax'] ?? 0);
            total_nett_sales = parseInt(room_data['nett_sales'] ?? 0) + parseInt(product_data['nett_sales'] ?? 0);

            total_room_reservation = room_data['total_transaction'] ?? 0;
            room_gross_sales = room_data['gross_sales'] ?? 0;
            room_service_sales = room_data['total_service'] ?? 0;
            room_tax_sales = room_data['total_tax'] ?? 0;
            room_nett_sales = room_data['nett_sales'] ?? 0;

            $('.room_total_reservation').text(formatRibuan(total_room_reservation));
            $('#room_gross_sales').text(formatRupiah(room_gross_sales));
            $('#room_service').text(formatRupiah(room_service_sales));
            $('#room_tax').text(formatRupiah(room_tax_sales));
            $('#room_nett_sales').text(formatRupiah(room_nett_sales));

            total_product_reservation = product_data['total_transaction'] ?? 0;
            product_gross_sales = product_data['gross_sales'] ?? 0;
            product_service_sales = product_data['total_service'] ?? 0;
            product_tax_sales = product_data['total_tax'] ?? 0;
            product_nett_sales = product_data['nett_sales'] ?? 0;

            $('.product_total_reservation').text(formatRibuan(total_product_reservation));
            $('#product_gross_sales').text(formatRupiah(product_gross_sales));
            $('#product_service').text(formatRupiah(product_service_sales));
            $('#product_tax').text(formatRupiah(product_tax_sales));
            $('#product_nett_sales').text(formatRupiah(product_nett_sales));

            $('#total_transaction').text(formatRibuan(total_transaction));
            $('#gross_sales').text(formatRupiah(total_gross_sales));
            $('#service_sales').text(formatRupiah(total_service));
            $('#tax_sales').text(formatRupiah(total_tax));
            $('#nett_sales').text(formatRupiah(total_nett_sales));
        }

        function addDatas(chart, data) {
            chart.data = data;
        }

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

        function savePDF() {
            var checkbox_report = document.getElementsByClassName('checkbox_report');
            if (checkbox_report[0].checked == false && checkbox_report[1].checked == false &&
                checkbox_report[2].checked == false && checkbox_report[3].checked == false && checkbox_report[4].checked ==
                false) {
                Swal.fire({
                    icon: 'warning',
                    title: 'warning',
                    text: "At least checklist one report"
                });
                return false;
            }

            $(".lds-dual-ring-admin").fadeIn('fast');

            var imgToExport = document.getElementById('imgToExport');
            var canvas = document.createElement('canvas');
            canvas.width = imgToExport.width;
            canvas.height = imgToExport.height;
            canvas.getContext('2d').drawImage(imgToExport, 0, 0);
            var logoUrl = canvas.toDataURL('image/png');
            var StartDate = $('#date_start').val();
            var EndDate = $('#date_end').val();
            if (StartDate == EndDate) {
                var period = "Until " + StartDate;
            } else {
                var period = StartDate + " - " + EndDate;
            }
            var roomData = [
                [{
                        text: 'Room Type',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: 'Sold',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Average Rate',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Room Revenue',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Tax Collected',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Services Collected',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Nett Sales',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    }
                ]
            ];

            var productData = [
                [{
                        text: 'Package Name',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: 'Sold',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Average Rate',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Package Revenue',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Tax Collected',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Services Collected',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Nett Sales',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    }
                ]
            ];

            var room_sales_report = [
                [{
                        text: 'Date',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: 'Reserved Rooms',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'ADR',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Room Revenue',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Tax Collected',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Services Collected',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Nett Revenue',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    }
                ]
            ];

            var product_sales_report = [
                [{
                        text: 'Reserved Package',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: 'Quantity',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Price',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Revenue',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Tax Collected',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Services Collected',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Nett Revenue',
                        bold: true,
                        fontSize: 9,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    }
                ]
            ];

            room_reservation.forEach(function(sourceRow) {
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
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: sourceRow[6],
                        fontSize: 9,
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    }
                ];
                roomData.push(dataRow)
            });

            room_reservation_all.forEach(function(sourceRow) {
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
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: sourceRow[6],
                        fontSize: 9,
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    }
                ];
                room_sales_report.push(dataRow)
            });

            product_reservation.forEach(function(sourceRow) {
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
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: sourceRow[6],
                        fontSize: 9,
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    }
                ];

                productData.push(dataRow)
            });

            product_reservation_all.forEach(function(sourceRow) {
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
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: sourceRow[6],
                        fontSize: 9,
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    }
                ];

                product_sales_report.push(dataRow)
            });

            Promise.all([
                RoomPie.exporting.pdfmake,
                RoomPie.exporting.getImage("png"),
                ProductPie.exporting.getImage("png"),
                RoomSales.exporting.getImage("png"),
                ProductSales.exporting.getImage("png"),
            ]).then(function(res) {
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
                                        text: 'HORISON SALES REPORT',
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

                if (checkbox_report[0].checked == true) {

                    // GENERAL //
                    doc.content.push({
                        text: "GENERAL",
                        bold: true,
                        fontSize: 17,
                        color: '#333333',
                        margin: [0, 5, 0, 17]
                    });
                    doc.content.push({
                        columns: [{
                                stack: [{
                                        text: 'TOTAL TRANSACTION',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 0, 0, 5]
                                    },
                                    {
                                        text: formatRibuan(total_transaction),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'ROOM RESERVATION',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 0, 0, 5]
                                    },
                                    {
                                        text: formatRibuan(total_room_reservation),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'PACKAGE RESERVATION',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 0, 0, 5]
                                    },
                                    {
                                        text: formatRibuan(total_product_reservation),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            }
                        ],
                        // optional space between columns
                        columnGap: 30
                    });
                    doc.content.push({
                        columns: [{
                                stack: [{
                                        text: 'GROSS SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(total_gross_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'SERVICE SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(total_service),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'TAX SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [-3, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(total_tax),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333',
                                        margin: [-3, 0, 0, 0]
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'NETT SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(total_nett_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#219653'
                                    },
                                ],
                                width: 'auto',
                            }
                        ],
                        // optional space between columns
                        columnGap: 50
                    });

                    doc.content.push({
                        text: "MOST RESERVED ROOMS & PACKAGE",
                        bold: true,
                        fontSize: 12,
                        color: '#333333',
                        margin: [0, 40, 0, 17]
                    });
                    doc.content.push({
                        columns: [{
                                stack: [{
                                        text: "Rooms",
                                        fontSize: 10,
                                        bold: true,
                                        margin: [0, 5, 0, 15]
                                    },
                                    {
                                        image: res[1],
                                        width: 270
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: "Package/Product",
                                        fontSize: 10,
                                        bold: true,
                                        margin: [0, 5, 0, 15]
                                    },
                                    {
                                        image: res[2],
                                        width: 270
                                    },
                                ],
                                width: 'auto',
                            }
                        ],
                        // optional space between columns
                        columnGap: 0
                    });
                }

                if (checkbox_report[0].checked == true || checkbox_report[1].checked == true) {
                    doc.content.push({
                        text: "Room Sales (by amount sold)",
                        bold: true,
                        fontSize: 10,
                        margin: [0, 30, 0, 15]
                    });
                    doc.content.push({
                        table: {
                            headerRows: 1,
                            widths: ["auto", "10%", "auto", "15%", "auto", "auto", "auto"],
                            body: roomData
                        }
                    });
                }

                if (checkbox_report[0].checked == true || checkbox_report[3].checked == true) {
                    doc.content.push({
                        text: "Package Sales (by amount sold)",
                        bold: true,
                        fontSize: 10,
                        margin: [0, 30, 0, 15]
                    });
                    doc.content.push({
                        table: {
                            headerRows: 1,
                            widths: ["auto", "10%", "auto", "auto", "auto", "auto", "auto"],
                            body: productData
                        }
                    });
                }
                // BATAS SUCI - GENERAL //
                if (checkbox_report[0].checked == true || checkbox_report[1].checked == true && checkbox_report[2]
                    .checked == true) {
                    doc.content.push({
                        text: "ALL ROOMS RESERVATION",
                        bold: true,
                        fontSize: 17,
                        color: '#333333',
                        margin: [0, 5, 0, 17],
                        pageBreak: 'before'
                    });
                } else if (checkbox_report[0].checked == true || checkbox_report[1].checked == false &&
                    checkbox_report[2].checked == true) {
                    doc.content.push({
                        text: "ALL ROOMS RESERVATION",
                        bold: true,
                        fontSize: 17,
                        color: '#333333',
                        margin: [0, 5, 0, 17],
                    });
                }

                if (checkbox_report[0].checked == true || checkbox_report[2].checked == true) {
                    // ALL ROOMS RESERVATION //
                    doc.content.push({
                        columns: [{
                            stack: [{
                                    text: 'ROOM RESERVATION',
                                    fontSize: 11,
                                    bold: true,
                                    color: '#C0C0C0',
                                    margin: [0, 0, 0, 5]
                                },
                                {
                                    text: formatRibuan(total_room_reservation),
                                    fontSize: 14,
                                    bold: true,
                                    color: '#333333'
                                },
                            ],
                            width: 'auto',
                        }],
                        // optional space between columns
                        columnGap: 30
                    });
                    doc.content.push({
                        columns: [{
                                stack: [{
                                        text: 'GROSS SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(room_gross_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'SERVICE SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(room_service_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'TAX SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [-3, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(room_tax_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333',
                                        margin: [-3, 0, 0, 0]
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'NETT SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(room_nett_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#219653'
                                    },
                                ],
                                width: 'auto',
                            }
                        ],
                        // optional space between columns
                        columnGap: 50
                    });

                    doc.content.push({
                        image: res[3],
                        width: 450,
                        margin: [0, 20, 0, 0],
                    });

                    doc.content.push({
                        text: "All Rooms Reservation",
                        bold: true,
                        fontSize: 10,
                        margin: [0, 20, 0, 15]
                    });
                    doc.content.push({
                        table: {
                            headerRows: 1,
                            widths: ["auto", "auto", "auto", "15%", "auto", "auto", "auto"],
                            body: room_sales_report
                        }
                    });
                }
                // BATAS SUCI - ALL ROOMS RESERVATION //

                if (checkbox_report[0].checked == true) {
                    // ALL PACKAGE RESERVATION //
                    doc.content.push({
                        text: "ALL PACKAGE RESERVATION",
                        bold: true,
                        fontSize: 17,
                        color: '#333333',
                        margin: [0, 5, 0, 17],
                        pageBreak: 'before'
                    });
                    doc.content.push({
                        columns: [{
                            stack: [{
                                    text: 'PACKAGE RESERVATION',
                                    fontSize: 11,
                                    bold: true,
                                    color: '#C0C0C0',
                                    margin: [0, 0, 0, 5]
                                },
                                {
                                    text: formatRibuan(total_product_reservation),
                                    fontSize: 14,
                                    bold: true,
                                    color: '#333333'
                                },
                            ],
                            width: 'auto',
                        }],
                        // optional space between columns
                        columnGap: 30
                    });
                    doc.content.push({
                        columns: [{
                                stack: [{
                                        text: 'GROSS SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(product_gross_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'SERVICE SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(product_service_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'TAX SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [-3, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(product_tax_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333',
                                        margin: [-3, 0, 0, 0]
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'NETT SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(product_nett_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#219653'
                                    },
                                ],
                                width: 'auto',
                            }
                        ],
                        // optional space between columns
                        columnGap: 50
                    });

                    doc.content.push({
                        image: res[4],
                        width: 450,
                        margin: [0, 20, 0, 0],
                    });

                    doc.content.push({
                        text: "All Package Reservation",
                        bold: true,
                        fontSize: 10,
                        margin: [0, 20, 0, 15]
                    });
                    doc.content.push({
                        table: {
                            headerRows: 1,
                            widths: ["auto", "auto", "auto", "15%", "auto", "auto", "auto"],
                            body: product_sales_report
                        }
                    });
                }
                // BATAS SUCI - ALL PACKAGE RESERVATION //

                // ALL PACKAGE RESERVATION
                if (checkbox_report[4].checked == true) {
                    doc.content.push({
                        columns: [{
                            stack: [{
                                    text: 'PACKAGE RESERVATION',
                                    fontSize: 11,
                                    bold: true,
                                    color: '#C0C0C0',
                                    margin: [0, 0, 0, 5]
                                },
                                {
                                    text: formatRibuan(total_product_reservation),
                                    fontSize: 14,
                                    bold: true,
                                    color: '#333333'
                                },
                            ],
                            width: 'auto',
                        }],
                        // optional space between columns
                        columnGap: 30
                    });
                    doc.content.push({
                        columns: [{
                                stack: [{
                                        text: 'GROSS SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(product_gross_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'SERVICE SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(product_service_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333'
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'TAX SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [-3, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(product_tax_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#333333',
                                        margin: [-3, 0, 0, 0]
                                    },
                                ],
                                width: 'auto',
                            },
                            {
                                stack: [{
                                        text: 'NETT SALES',
                                        fontSize: 11,
                                        bold: true,
                                        color: '#C0C0C0',
                                        margin: [0, 13, 0, 5]
                                    },
                                    {
                                        text: formatRupiah(product_nett_sales),
                                        fontSize: 14,
                                        bold: true,
                                        color: '#219653'
                                    },
                                ],
                                width: 'auto',
                            }
                        ],
                        // optional space between columns
                        columnGap: 50
                    });

                    doc.content.push({
                        image: res[4],
                        width: 450,
                        margin: [0, 20, 0, 0],
                    });

                    doc.content.push({
                        text: "All Package Reservation",
                        bold: true,
                        fontSize: 10,
                        margin: [0, 20, 0, 15]
                    });
                    doc.content.push({
                        table: {
                            headerRows: 1,
                            widths: ["auto", "auto", "auto", "15%", "auto", "auto", "auto"],
                            body: product_sales_report
                        }
                    });
                }
                // END ALL PACKAGE RESERVATION

                pdfMake.createPdf(doc).download("sales_report-" + period + ".pdf");
                // pdfMake.createPdf(doc).open();

                $(".lds-dual-ring-admin").fadeOut('fast');
            });
        }
    </script>
@endsection
