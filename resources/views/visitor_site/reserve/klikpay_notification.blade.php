<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Horison Ultima Bandung" />
    <meta name="author" content="Horison Ultima Bandung" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->title }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css')}}">

    <link rel="stylesheet" href="{{ asset('js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-core.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{ asset('js/fullcalendar/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('js/selectboxit/jquery.selectBoxIt.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/black.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/font-awesome/css/font-awesome.min.css ') }}">

    <link rel="stylesheet" href="{{ asset('css/md-tripa.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/horison-custom.css ') }}">

    {{-- custom slider --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slider-custom.css') }}">

    <link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker-bs3.css') }}">
	<link rel="shortcut icon" href="{{ asset('/images/logo/'.$setting->favicon) }}" type="image/x-icon"/>

    <script src="{{ asset('js/datatables/datatables.js') }}"></script>
    <script src="{{ asset('js/jquery-1.11.3.min.js ') }}"></script>

    <script src="{{ asset('js/numeral/numeral.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <!-- International Phone Mask -->
    <link rel="stylesheet" href="{{ asset('css/intl-phone/intlTelInput.css') }}">
    <script src="{{ asset('js/intl-phone/intlTelInput.js') }}"></script>
    <script src="{{ asset('js/timezz/dist/timezz.js') }}"></script>

    <!-- sweet ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script type="text/javascript">
        var home_url = "{{url('/')}}";
                /* Fungsi formatRupiah */
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
            return rupiah;
        }

        $(window).load(function () {
            $(".lds-dual-ring-admin").fadeOut("slow");;
        });
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.12/featherlight.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.12/featherlight.min.js"></script>
</head>

<body class="page-body">
    <div class="lds-dual-ring-admin"></div>

    <div class="col-lg-12">
        <div class="row">
            <div>
                <form id="rootwizard-2" method="post" action="" class="form-wizard validate" >

                    <div class="bg-primary" style="width: 100%; height: 12rem; position:absolute; top:0; z-index: -1; margin-bottom: 10px;"></div>

                    {{-- HEADER --}}
                    <a href="/">
                        <img id="logo_horison" class="mt-20 img-reserve" style="position: absolute; top: 0; left: 0;" src="{{ asset('images/logo/' . $setting->logo) }}" width="170" alt="tirtasanitaresort" />
                    </a>
                    <div class="steps-progress">
                        <div class="progress-indicator-two" style="width: 100% !important;"></div>
                    </div>

                    <ul>
                        <li id="toogle_1" class="completed">
                            <a href="#tab2-1" data-toggle="tab" aria-disabled="true" style="cursor:not-allowed;"><span>1</span>Customer Information</a>
                        </li>
                        <li id="toogle_2" class="completed">
                            <a href="#tab2-2" data-toggle="tab" aria-disabled="true" style="cursor:not-allowed;"><span>2</span>Payment Information</a>
                        </li>
                        <li id="toogle_3" class="completed">
                            <a href="#tab2-3" data-toggle="tab" aria-disabled="true" style="cursor:not-allowed;"><span>3</span>Booking Confirmed!</a>
                        </li>
                    </ul>
                    {{-- END HEADER --}}

                    @if($status_payment == "settlement")
                        <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
                    @else
                        <div class="container" style="margin-top: 55px; margin-bottom: 55px;">
                    @endif

                        <div class="tab-content mt-35">
                            <div class="tab-pane" id="tab2-3">
                                <div class="col-md-8">
                                    <div class="gallery-env">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <article class="album" style="">
                                                    <section class="album-info-inq shadow" style="border-bottom:none;">
                                                        {{-- MAIN FORM --}}
                                                        <br>
                                                        <h4></h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @if($status_payment == "settlement")
                                                                <div class="form-group">
                                                                    <label for="">
                                                                        <strong>Your Reservation <b class="booking_id">{{ $status->reservation_id }}</b> has been placed!</strong>
                                                                    </label>
                                                                    <ul>
                                                                        <li>You will receive your booking details at
                                                                            <b class="customer_email">{{ $customer->cust_email }}</b></li>
                                                                        <li>You will receive your Voucher and Receipt</li>
                                                                        <li>You will receive a confirmation email as soon this
                                                                            transaction has been approved</li>
                                                                    </ul>
                                                                </div>
                                                                @else
                                                                <div class="form-group">
                                                                    <label for="">
                                                                        <strong>Your Booking <b class="booking_id">{{ $rsvp->booking_id }}</b> has been {{ $status_message }}!</strong>
                                                                    </label>
                                                                    {{-- <ul>
                                                                        <li>{{ $status_message }}</li>
                                                                    </ul> --}}
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-6 mb-10">
                                                                    <div>
                                                                        <label for="">Customer Service Email</label>
                                                                    </div>
                                                                    <div>
                                                                        <i class="entypo-mail"></i>
                                                                        <span style="font-weight:normal" for="">&nbsp;
                                                                            {{ $setting->email }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-xs-12">
                                                                    <div>
                                                                        <label for="">Customer Service</label>
                                                                    </div>
                                                                    <div>
                                                                        <i class="fa fa-phone"></i>
                                                                        <span style="font-weight:normal" for="">&nbsp; {{ $setting->phone }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </article>

                                                @if($status_payment == "settlement")
                                                    <div class="panel-footer footer-payment" style="padding: 14px;">
                                                @else
                                                    <div class="panel-footer footer-payment" style="padding: 24px;">
                                                @endif
                                                    <div class="form-group">
                                                        <div class="row">
                                                            @if($from == "ROOMS")
                                                                <div class="col-md-8" align="right">
                                                                    <a href="/">
                                                                        <p style="padding: 10px;font-size: 12px!important; font-weight: 600;"> Back To Home</p>
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-4" align="right">
                                                                    <a href="/visitor/rooms" class="btn btn-horison-dark">Reserve another Rooms</a>
                                                                </div>
                                                            @else
                                                                <div class="col-md-12" align="right">
                                                                    <a href="/">
                                                                        <p style="padding: 10px;font-size: 12px!important; font-weight: 600;"> Back To Home</p>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    {{-- bills dikanan --}}
                                    <div class="gallery-env">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <article class="album" style="">
                                                    <section class="album-info-inq shadow">
                                                        <div class="row" style="margin-top:-30px;">
                                                            @if($status_payment == "settlement")
                                                                <div class="col-md-12">
                                                                    <p><strong>Reservation Number</strong></p>
                                                                </div>
                                                                <div class="col-md-12 mt-10">
                                                                    <label>{{ $status->reservation_id }}</label>
                                                                </div>
                                                            @else
                                                                <div class="col-md-12">
                                                                    <p><strong>Booking ID</strong></p>
                                                                </div>
                                                                <div class="col-md-12 mt-10">
                                                                    <label>{{ $rsvp->booking_id }}</label>
                                                                </div>
                                                            @endif
                                                            <div class="col-md-12">
                                                                <p><strong>Reserve By</strong></p>
                                                            </div>
                                                            <div class="col-md-12 mt-10">
                                                                <label class="customer_name" for="">{{ $rsvp->rsvp_cust_name }}</label>
                                                            </div>
                                                        </div>
                                                        <hr><br>
                                                        {{-- MAIN FORM --}}
                                                        <h4><b>Reservation Details</b></h4>

                                                        <div class="row indent-reserve">
                                                            @if($from == "ROOMS")
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-calendar-o"></i>
                                                                <span style="font-weight:normal" for="">&nbsp; {{  $data->rsvp_checkin }} - {{  $data->rsvp_checkout }}</span>
                                                            </div>
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                <span style="font-weight:normal" for="">&nbsp; {{ $data->room->room_name }}</span>
                                                            </div>
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-users"></i>
                                                                <span style="font-weight:normal" for="">&nbsp;
                                                                    {{ $data->rsvp_adult }} Adult</span>
                                                            </div>
                                                            @elseif($from == "PRODUCTS")
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-calendar-o"></i>
                                                                <span style="font-weight:normal" for="">&nbsp; {{ $data->rsvp_date_reserve }}</span>
                                                            </div>
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                <span style="font-weight:normal" for="">&nbsp; {{ $data['product']->product_name }}</span>
                                                            </div>
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-users"></i>
                                                                <span class="amount_pax" style="font-weight:normal" for="">&nbsp; {{ $data->rsvp_amount_pax }} Pax</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </section>
                                                </article>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>

        <footer>
            <div class="row footer-bg-color margin-footer">
                <div class="container" style="height:185px;">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 footer-logo">
                        <img src="{{ asset('images/logo/' . $setting->logo) }}" width="200" height="56" alt="tirtasanitaresort" style="margin-top:55px;" />
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 visitor-footer" align="center">
                        <div class=row>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <p>
                                        @if($setting->so_instagram !== NULL)
                                            <a href="{{ $setting->so_instagram }}" class="fa fa-instagram visitor-footer-icon" target="_blank"></a>
                                        @else
                                            <a class="fa fa-instagram visitor-footer-icon" target="_blank"></a>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <p>
                                        @if($setting->so_facebook !== NULL)
                                            <a href="{{ $setting->so_facebook }}" class="fa fa-facebook visitor-footer-icon" target="_blank"></a>
                                        @else
                                            <a class="fa fa-facebook visitor-footer-icon" target="_blank"></a>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <p>
                                        @if($setting->so_twitter !== NULL)
                                            <a href="{{ $setting->so_twitter }}" class="fa fa-twitter visitor-footer-icon"></a>
                                        @else
                                            <a class="fa fa-twitter visitor-footer-icon"></a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 visitor-footer d-flex-column">
                        <div class="d-flex f-align-end">
                            <p style="font-weight: normal;">
                                {{ $setting->address }}
                            </p>
                            <span style="margin-top:10px; margin-left: 10px; font-size:18px"><i
                                    class="entypo-location"></i></span>
                        </div>
                        <div class="d-flex f-align-end">
                            <p style="font-weight: normal;">
                                {{ $setting->phone }}<br>
                                {{ $setting->wa_number }}
                            </p>
                            <span style="margin-top:7px; margin-left: 10px; font-size:18px"><i
                                    class="entypo-phone"></i></span>
                        </div>
                        <div class="d-flex f-align-end">
                            <p style="font-weight: normal;">
                                {{ $setting->email }}
                            </p>
                            <span style="margin-top:0px; margin-left: 10px; font-size:18px"><i
                                    class="entypo-mail"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <link rel="stylesheet" href="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <script src="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/reserve-popover.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('js/neon-calendar.js') }}"></script>
    <script src="{{ asset('js/jvectormap/jquery-jvectormap-europe-merc-en.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/raphael-min.js') }}"></script>
    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/joinable.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>
    <script src="{{ asset('js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.min.js') }}"></script>
    <script src="{{ asset('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/jquery.bootstrap.wizard.min.js') }}"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="{{ asset('js/neon-custom.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('js/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.bundle.js')}}"></script>
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/wysihtml5/bootstrap-wysihtml5.css') }}">
    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>
    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{ asset('js/fileinput.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/addons/css/markdownarea.css') }}">
    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/uikit/js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('js/marked.js') }}"></script>
    <script src="{{ asset('js/uikit/addons/js/markdownarea.min.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/markdown/markdown.js') }}"></script>
    <script src="{{ asset('js/codemirror/addon/mode/overlay.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/gfm/gfm.js') }}"></script>

    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/minimal/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/square/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/flat/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/futurico/futurico.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/polaris/polaris.css') }}">

    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>

    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/neon-charts.js') }}"></script>

    {{-- CUSTOM DATEPICKER --}}
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker-module-ranges/dist/index.js"></script>

    <script>

    </script>

</body>

</html>
