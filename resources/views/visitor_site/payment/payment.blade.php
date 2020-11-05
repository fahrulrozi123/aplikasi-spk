<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />
    <title>Horison Tirta Sanita</title>


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
    {{-- batas suci --}}

    <link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="shortcut icon" href="{{asset('images/icon.png')}}" type="image/x-icon" />


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
    </script>
    <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('/gif/loading-spin.gif') center no-repeat #fff;
        }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.12/featherlight.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
        <script id="midtrans-script" type="text/javascript" src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js" data-environment="sandbox" data-client-key="VT-client-0N5ngRfFPbOhBa7k"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/featherlight/1.7.12/featherlight.min.js"></script>

        <script>

        //paste this code under the head tag or in a separate js file.
            // Wait for window load
            $(window).load(function() {
                // Animate loader off screen
                $(".se-pre-con").fadeOut("slow");;
            });
        </script>
</head>

<body class="page-body">
    <div class="se-pre-con"></div>

    <div class="col-lg-12">
        <div class="row">
            <div class="container">


                <form id="rootwizard-2" method="post" action="" class="form-wizard validate" >
                        {{-- HEADER --}}
                        <a href="/">
                            <img id="logo_horison" class="mt-20 " style="position: absolute;top: 0;left: 0;" src="{{asset('/images/sidebar.png')}}" width="170"
                                alt="" />
                        </a>
                        <div class="steps-progress">
                            <div class="progress-indicator"></div>
                        </div>

                        <ul>
                            <li id="toogle_1">
                                <a aria-disabled="true" style="cursor:not-allowed;"><span>1</span>Customer Information</a>
                            </li>
                            <li id="toogle_2">
                                <a aria-disabled="true" style="cursor:not-allowed;"><span>2</span>Payment Information</a>
                            </li>
                            <li id="toogle_3">
                                <a id="btn_tab" href="#tab2-3" data-toggle="tab"><span>3</span>Booking Confirmed!</a>
                            </li>
                        </ul>

                        {{-- END HEADER --}}

                    <div class="tab-content mt-35">
                        <div class="tab-pane">

                            <div class="col-md-8">
                                <div class="gallery-env">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <article class="album" style="">
                                                <section class="album-info-inq shadow"
                                                    style="border:1px solid #D4B580;">
                                                    {{-- MAIN FORM --}}

                                                </section>

                                            </article>
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
                                                <section class="album-info-inq shadow"
                                                    style="border:1px solid #D4B580;">
                                                </section>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                                <div class="gallery-env">
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <article class="album" style="">

                                                <section class="album-info-inq shadow"
                                                    style="border:1px solid #D4B580;">
                                                </section>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                                {{-- end bills --}}
                            </div>
                        </div>
                        <div class="tab-pane">
                            <div class="col-md-8">
                                <!-- form reserve -->
                                <div class="gallery-env">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <article class="album">
                                                <section class="album-info-inq shadow"
                                                    style="border: 1px solid #D4B580;">
                                                </section>
                                            </article>
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
                                            <section class="album-info-inq shadow" style="border:1px solid #D4B580;">
                                            </section>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-env">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <article class="album" style="">

                                            <section class="album-info-inq shadow" style="border:1px solid #D4B580;">
                                            </section>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            {{-- end bills --}}

                        </div>
                    </div>

                    <div class="tab-pane" id="tab2-3">

                        <div class="col-md-8">
                            <div class="gallery-env">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <article class="album" style="">
                                            <section class="album-info-inq shadow"
                                                style="border:1px solid #D4B580; border-bottom:none;">
                                                {{-- MAIN FORM --}}
                                                <br>
                                                <h4></h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for=""><strong>Your Booking <b class="booking_id">{{$id}}</b> has been
                                                                    placed!</strong></label>
                                                            <ul>
                                                                <li>You will receive your booking details at
                                                                    <b class="customer_email">{{$data->customer->cust_email}}</b></li>
                                                                <li>You will receive your Voucher after you have made
                                                                    your payment</li>
                                                                {{-- <li id="transaction_due">Please finish this transaction before <b class="transaction_due">13 January 2020 13:20</b></li> --}}
                                                                <li>You will receive a confirmation email as soon this
                                                                    transaction has been approved</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="form-group" style="padding:20px;">
                                                        <div class="col-md-6 mb-10" align="right">
                                                            <div class="col-md-12">
                                                                <label for="">Customer Service Email</label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i class="entypo-mail"></i>
                                                                <label style="font-weight:normal" for="">&nbsp;
                                                                    dolores.chambers@example.com</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="col-md-12">
                                                                <label for="">Customer Service</label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i class="fa fa-phone"></i>
                                                                <label style="font-weight:normal" for="">&nbsp; (270)
                                                                    555-0117</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                        </article>
                                        <div class="panel-footer footer-payment">
                                            <div class="form-group" style="background-color:#F2F2F2">
                                                <div class="row">
                                                    <div class="col-md-6" align="right">
                                                        <a href="/">
                                                            <p
                                                                style="padding: 10px;font-size: 12px!important; font-weight: 600;">
                                                                Back To Home</p>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="/visitor/rooms" class="btn btn-horison-dark">Reserve another
                                                            Rooms</a>
                                                    </div>
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

                                            <section class="album-info-inq shadow" style="border:1px solid #D4B580;">

                                                <div class="row" style="margin-top:-30px;">
                                                    <div class="col-md-12">
                                                        <p><strong>Booking ID</strong></p>
                                                    </div>
                                                    <div class="col-md-12 mt-10">
                                                        <label class="booking_id" for="">{{$id}}</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p><strong>Reserve By</strong></p>
                                                    </div>
                                                    <div class="col-md-12 mt-10">
                                                        <label class="customer_name" for="">{{$data->rsvp_cust_name}}</label>
                                                    </div>
                                                </div>
                                                <hr><br>
                                                {{-- MAIN FORM --}}
                                                <h4><b>Booking Details</b></h4>

                                                <div class="row">
                                                    @if($from == "ROOMS")
                                                    <div class="col-md-12">
                                                        <i class="fa fa-calendar-o"></i>
                                                        <label style="font-weight:normal" for="">&nbsp; {{$data->rsvp_checkin.' - '.$data->rsvp_checkout}}</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i class="fa fa-shopping-cart"></i>
                                                        <label style="font-weight:normal" for="">&nbsp; {{$data->room->room_name}}</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i class="fa fa-users"></i>
                                                        <label style="font-weight:normal" for="">&nbsp;
                                                            {{$data->person}}</label>
                                                    </div>
                                                    @elseif($from == "PRODUCTS")
                                                    <div class="col-md-12">
                                                        <i class="fa fa-calendar-o"></i>
                                                        <label style="font-weight:normal" for="">&nbsp; {{$data->rsvp_date_reserve}}</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i class="fa fa-shopping-cart"></i>
                                                        <label style="font-weight:normal" for="">&nbsp; {{$data->product->product_name}}</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i class="fa fa-users"></i>
                                                        <label class="amount_pax" style="font-weight:normal" for="">&nbsp;
                                                            {{$data->rsvp_amount_pax}} Pax</label>
                                                    </div>
                                                    @endif
                                                </div>


                                            </section>

                                        </article>

                                    </div>

                                </div>
                            </div>
                            <div class="gallery-env">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <article class="album" style="">

                                            <section class="album-info-inq shadow" style="border:1px solid #D4B580;">
                                                {{-- MAIN FORM --}}
                                                <h4><b>Price Details</b></h4>
                                                <div class="row">
                                                    @if($from == "ROOMS")
                                                    <div class="col-md-7">
                                                        <p style="font-size:14px; color:black;">{{$data->rsvp_total_room." Rooms"." x ".$totalStay}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <p style="font-size:14px text-align:right;">
                                                            <strong>
                                                                <script>
                                                                    document.write("Rp "+formatRupiah("{{$data->rsvp_total_amount_room}}"));
                                                                </script>
                                                            </strong>
                                                        </p>
                                                    </div>
                                                    @if($data->rsvp_total_extrabed > 0)
                                                    <div class="col-md-7">
                                                        <p style="font-size:14px; color:black;">Additional Extra Bed
                                                        </p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <p style="font-size:14px text-align:right;">
                                                            <strong>
                                                                <script>
                                                                    document.write("Rp "+formatRupiah("{{$data->rsvp_total_amount_extrabed}}"));
                                                                </script>
                                                            </strong>
                                                        </p>
                                                    </div>
                                                    @endif
                                                    @else
                                                    <div class="col-md-7">
                                                        <p class="product_details" style="font-size:14px; color:black;">
                                                            {{$data->rsvp_amount_pax.' x '.$data->product->product_name}}</p>
                                                    </div>
                                                    <div class="col-md-5">
                                                    <p class="product_price" style="font-size:14px text-align:right;">
                                                        <strong>
                                                            <script>
                                                                document.write("Rp "+formatRupiah("{{$data->rsvp_total_amount}}"));
                                                            </script>
                                                        </strong>
                                                    </p>
                                                    </div>
                                                    @endif
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p style="font-size:14px">Total</p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <p style="font-size:14px text-align:right;">
                                                            <strong>
                                                                <script>
                                                                    document.write("Rp "+formatRupiah("{{$data->rsvp_grand_total}}"));
                                                                </script>
                                                            </strong>
                                                        </p>
                                                    </div>
                                                </div>
                                            </section>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            {{-- end bills --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <footer>
        <div class="row" style="background-color:#333333;">
            <div class="container" style="background-color:#333333; height:185px;">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 footer-logo">
                    <img src="{{asset('/images/sidebar.png')}}" width="200" alt="" style="margin-top:55px;" />
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 visitor-footer" align="center">
                    <div class=row>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <p><a href="https://twitter.com/tirta_sanita"
                                        class="fa fa-twitter visitor-footer-icon"></a></p>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <p><a href="https://www.instagram.com/horison_tirtasanita/"
                                        class="fa fa-instagram visitor-footer-icon"></a></p>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <p><a href="https://www.facebook.com/Horison-Tirta-Sanita-Hotel-Kuningan-406212926229244/"
                                        class="fa fa-facebook visitor-footer-icon"></a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 visitor-footer d-flex-column">
                    <div class="d-flex f-align-end">
                        <p style="font-weight: normal;">
                            Jl. Raya Panawuan No. 98 - Sangkanhurip,<br>
                            Kuningan Jawa Barat, Kuningan
                        </p>
                        <span style="margin-top:10px; margin-left: 10px; font-size:18px"><i
                                class="entypo-location"></i></span>
                    </div>
                    <div class="d-flex f-align-end">
                        <p style="font-weight: normal;">
                            0232 613061<br>
                            +62 812 2335 2324
                        </p>
                        <span style="margin-top:7px; margin-left: 10px; font-size:18px"><i
                                class="entypo-phone"></i></span>
                    </div>
                    <div class="d-flex f-align-end">
                        <p style="font-weight: normal;">
                            horison@email.com
                        </p>
                        <span style="margin-top:0px; margin-left: 10px; font-size:18px"><i
                                class="entypo-mail"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <link rel="stylesheet" href="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <script src="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>

    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/reserve-popover.js') }}"></script>

    <script src="{{ asset('js/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('js/neon-calendar.js') }}"></script>
    {{-- <script src="{{asset('assets/js/neon-charts.js') }}"></script> --}}

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

    <!-- Text Editor WYSIWYG -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/wysihtml5/bootstrap-wysihtml5.css') }}">

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>


    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{ asset('js/fileinput.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>

    <!-- Text Editor CKEditor -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/css/uikit.min.css') }}">
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



    <!-- Advanced Plugins -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/minimal/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/square/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/flat/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/futurico/futurico.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/polaris/polaris.css') }}">

    <!-- Bottom scripts (common) -->

    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>



    <!-- Charts -->
    <!-- Imported styles on this page -->

    <!-- Bottom scripts (common) -->


    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/neon-charts.js') }}"></script>

    <script>
        $('#btn_tab').click();
    </script>

</body>

</html>
