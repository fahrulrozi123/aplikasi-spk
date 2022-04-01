@extends('templates/template')
@section('header_title')
    CUSTOMER REPORT
@endsection
@section('content')
    <div style='display:none'>
        <img id='imgToExport' src="{{ asset('images/logo/' . $setting->logo) }}" />
    </div>

    {{-- FOR EXPORT PURPOSE --}}
    <form id="customer_export_excel" action="{{ route('customer.customer_export_excel') }}" method="post" target="_blank">
        {{ csrf_field() }}
    </form>

    <div class="col-lg-12">
        <div id="room_chart" style="display:none;"></div>
        <br>

        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                    <label for="field-1" class="control-label">Report Period</label>
                    <div class="input-group">
                        <input type="text" class="form-control borderlight" id="report_period" name="report_period" readonly>
                        <span class="input-group-addon borderlight darkfont"><i class="entypo-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 25px">
                <input form="customer_export_excel" type="hidden" id="date_start" name="date_start" value="0">
                <input form="customer_export_excel" type="hidden" id="date_end" name="date_end" value="0">
                <a id="export_pdf_modal" onclick="savePDF();" class="btn btn-horison-gold export_pdf_modal">
                    <i class="fa fa-file-pdf-o"></i>&ensp;Export to PDF</a>
                <button form="customer_export_excel" type="submit" class="btn btn-horison-gold ">
                    <i class="fa fa-file-pdf-o"></i>&ensp;Export to Excel
                </button>
            </div>
        </div>

        <hr>
        <br>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary panel-shadow" data-collapsed="0">
                    <!-- panel body -->
                    <div class="panel-body shadow">
                        <h2>
                            <b>General</b>
                        </h2>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="box-custreport shadow">
                                    <h5 style="margin-bottom: 0%; color:silver"><b>TOTAL REGISTERED CUSTOMER</b></h5>
                                    <h3 style="margin-top: 3%"><b id="total_customer_register">50</b></h3>
                                </div>
                            </div>
                        </div>

                        <h2><b>All Registered Customer</b></h2>
                        <div class="panel-body no-padding table-responsive shadow">
                            <div style="overflow-x:auto;">
                                <table class="table table-striped table-bordered datatable" id="table-3">
                                    <thead>
                                        <tr>
                                            <th class="horisonth">Latest Registered Names</th>
                                            <th class="horisonth">Email</th>
                                            <th class="horisonth">Phone Number</th>
                                            <th class="horisonth">Total Reservation Made</th>
                                            <th class="horisonth">Latest Reservation Date</th>
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

    <script type="text/javascript">
        //dont remove this function, its for datepicker
        var $customer_table = jQuery("#table-3");

        var customer_data, customer_total;

        var customer_table_data = [];

        function get_data(start_date = null, end_date = null) {
            customer_data = $.ajax({
                type: 'GET',
                url: "{{ route('reservation.customer_data') }}",
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
        }

        function set_all_data() {
            // 351 baris menjadi 190 baris
            customer_table_data = [];
            customer_data.forEach(element => {

                var last_reserve = new Date(element.last_reserve);
                last_reserve = moment(last_reserve).format('dddd, DD MMMM YYYY');

                customer_table_data.push([element.last_register_name, element.cust_email, element
                    .last_phone_number, formatRibuan(element.total_reservation), last_reserve
                ]);
            });

            $customer_table.dataTable();
            $customer_table.fnClearTable();
            if (customer_table_data.length > 0) {
                $customer_table.fnAddData(customer_table_data);
            }

            customer_total = customer_data.length;

            $('#total_customer_register').text(formatRibuan(customer_total));
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

        jQuery(document).ready(function($) {
            var table3 = $customer_table.DataTable({
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
            $customer_table.closest('.dataTables_wrapper').find('select').select2({
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
                onSelect: function(date1, date2) {

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
            $(".se-pre-con").fadeIn("fast");

            var imgToExport = document.getElementById('imgToExport');
            var canvas = document.createElement('canvas');
            canvas.width = imgToExport.width;
            canvas.height = imgToExport.height;
            canvas.getContext('2d').drawImage(imgToExport, 0, 0);
            var logoUrl = canvas.toDataURL('image/png');

            var StartDate = $('#date_start').val();
            var EndDate = $('#date_end').val();

            var period = StartDate + " - " + EndDate;

            var customer_report = [
                [{
                        text: 'Latest Registered Names',
                        bold: true,
                        fontSize: 8,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: 'Email',
                        bold: true,
                        fontSize: 8,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Phone Number',
                        bold: true,
                        fontSize: 8,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Total Reservation Made',
                        bold: true,
                        fontSize: 8,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: 'Latest Reservation Date',
                        bold: true,
                        fontSize: 8,
                        fillColor: '#F2F2F2',
                        alignment: 'center',
                        margin: [0, 5, 0, 5]
                    }
                ]
            ];

            customer_table_data.forEach(function(sourceRow) {
                var dataRow = [{
                        text: sourceRow[0],
                        fontSize: 7,
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: sourceRow[1],
                        alignment: 'center',
                        fontSize: 7,
                        margin: [0, 5, 0, 5]
                    },
                    {
                        text: sourceRow[2],
                        fontSize: 7,
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: sourceRow[3],
                        fontSize: 7,
                        alignment: 'center',
                        margin: [0, 6, 0, 6]
                    },
                    {
                        text: sourceRow[4],
                        alignment: 'center',
                        fontSize: 7,
                        margin: [0, 6, 0, 6]
                    }
                ]
                customer_report.push(dataRow);
            });

            Promise.all([
                RoomPie.exporting.pdfmake,
                // RoomPie.exporting.getImage("png"),
                // ProductPie.exporting.getImage("png")
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
                                // text: "Logo",
                                width: 150
                            },
                            {
                                stack: [
                                    // second column consists of paragraphs
                                    {
                                        text: 'HORISON CUSTOMER REPORT',
                                        fontSize: 17,
                                        bold: true,
                                        color: '#333333',
                                        margin: [10, 2, 0, 6]
                                    },
                                    {
                                        text: "Report Period: " + period + "",
                                        fontSize: 10,
                                        color: '#333333',
                                        margin: [10, 1, 0, 0]
                                    },
                                ],
                            },
                        ]
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
                                text: 'TOTAL REGISTERED CUSTOMER',
                                fontSize: 10,
                                bold: true,
                                color: '#C0C0C0',
                                margin: [0, 0, 0, 5]
                            },
                            {
                                text: formatRibuan(customer_total),
                                fontSize: 14,
                                bold: true,
                                color: '#333333',
                                alignment: 'left',
                                margin: [0, 8, 0, 5]
                            },
                        ],
                        width: 'auto',
                    }],
                    // optional space between columns
                    columnGap: 15
                });

                doc.content.push({
                    text: "All Registered Customer",
                    bold: true,
                    fontSize: 17,
                    color: '#333333',
                    margin: [0, 30, 0, 17]
                });
                doc.content.push({
                    table: {
                        headerRows: 1,
                        widths: ["20%", "20%", "20%", "20%", "20%"],
                        body: customer_report
                    }
                });

                // pdfMake.createPdf(doc).open();
                pdfMake.createPdf(doc).download("customer_report-" + period + ".pdf");
                $(".se-pre-con").fadeOut("fast");
            });
        }
    </script>
@endsection
