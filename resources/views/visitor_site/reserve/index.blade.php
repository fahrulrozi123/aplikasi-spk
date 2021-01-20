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
                <form id="reserve" method="POST" action="{{ route('visitor.credit') }}">
                    {{csrf_field()}}
                    <input type="hidden" name="reserve_data" id="reserve_data">
                </form>

                <form id="rootwizard-2" method="post" action="" class="form-wizard validate" >

                    <div class="bg-primary" style="width: 100%; height: 12rem; position:absolute; top:0; z-index: -1; margin-bottom: 10px;"></div>

                    {{-- HEADER --}}
                    <a href="/">
                        <img id="logo_horison" class="mt-20 img-reserve" style="position: absolute; top: 0; left: 0;" src="{{ asset('images/logo/' . $setting->logo) }}" width="170" alt="tirtasanitaresort" />
                    </a>
                    <div class="steps-progress">
                        <div class="progress-indicator"></div>
                    </div>

                    <ul>
                        <li id="toogle_1">
                            <a href="#tab2-1" data-toggle="tab"><span>1</span>Customer Information</a>
                        </li>
                        <li id="toogle_2">
                            <a href="javascript:;" aria-disabled="true" style="cursor:not-allowed;"><span>2</span>Payment Information</a>
                        </li>
                        <li id="toogle_3">
                            <a href="javascript:;" aria-disabled="true" style="cursor:not-allowed;"><span>3</span>Booking Confirmed!</a>
                        </li>
                    </ul>
                    {{-- END HEADER --}}

                    <div class="container" style="margin-top: 30px; margin-bottom: 30px;">

                        <div class="tab-content mt-35">
                            <div class="tab-pane" id="tab2-1">
                                <div class="col-md-8">
                                    <div class="gallery-env">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <article class="album" style="">
                                                    <section class="album-info-inq shadow">
                                                        {{-- MAIN FORM --}}
                                                        <div class="row">
                                                            <div class="col-md-4" style="padding-top: 20px;">
                                                                <b>Personal Information</b>
                                                            </div>
                                                            <div class="col-xs-12 col-md-6" style="padding-top: 0px; margin-top: 0px; float: right;">
                                                                <span class="timer timez"></span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-xs-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="full_name" style="font-size:12px; font-weight:normal;">Full Name</label>
                                                                    <input class="form-control visitor-input" type="text" id="full_name" value="" focus="true" placeholder="Please Type Your Full Name" maxlength="50"><br>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <div class="form-group">
                                                                    <label class="control-label" for=""
                                                                        style="font-size:12px; font-weight:normal;">Identification
                                                                        Card</label>
                                                                    <select id="id_card" class="form-control"
                                                                        placeholder="Identity Card">
                                                                        <option value="Identity Card">Identity Card</option>
                                                                        <option value="Driver License">Driver License</option>
                                                                        <option value="Passport">Passport</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="number"
                                                                        style="font-size:12px; font-weight:normal;">Identification
                                                                        Number</label>
                                                                    <input class="form-control visitor-input alphanumericValidation" type="text" autocomplete="off"
                                                                        id="id_number" maxlength="30"
                                                                        placeholder="Ex : 321815648126132" >
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="email"
                                                                        style="font-size:12px; font-weight:normal;">Email</label>
                                                                    <input class="form-control" type="email"
                                                                        class="form-control visitor-input" id="email" value=""
                                                                        placeholder="Please Enter Your Email Address">
                                                                    <span style="font-size:9px;">*Reservation details and
                                                                            voucher will be send to provided email</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="number"
                                                                        style="font-size:12px; font-weight:normal;">Phone Number</label><br>
                                                                    <input id="phone_number" class="form-control visitor-input numberValidation" type="text" maxlength="20" onkeypress="return hanyaAngka(event)">
                                                                </div>
                                                            </div>
                                                            @if($data->type == "Room")
                                                            <div class="col-md-12" style="font-size: 13px">
                                                                <input type="checkbox" onclick="for_other(this);" > Booking for other<br><br>
                                                            </div>
                                                            <div class="col-md-12" style="padding-left:34px;display:none;" id="otherBookForm">
                                                                <label class="control-label" for="full_name"
                                                                    style="font-size:12px; font-weight:normal;">Full
                                                                    Name</label>
                                                                <input class="form-control visitor-input" type="text"
                                                                    id="guest_name"
                                                                    placeholder="Please Type Your Full Name"><br>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <br>
                                                        @if($data->type == "Product")
                                                        <h4><strong>Product Details</strong></h4>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label style="font-size:12px; font-weight:normal;" for=""
                                                                    class="control-label">Product Reservation Date
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group ">
                                                                    <span class="input-group-addon custgroup"
                                                                        style="background-color:white;"><i
                                                                            class="entypo-calendar"
                                                                            style="color:black;"></i></span>
                                                                    <input id="datePickerReserveForm" type="text"
                                                                            class="form-control  inputDate"
                                                                            style="background-color:white;"
                                                                            name="checkin"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group minimal">
                                                                    <div class="input-group-addon custgroup">
                                                                        <i class="fa fa-clock-o" style="color:black;"></i>
                                                                    </div>
                                                                    <input type="text" style="width:30%;" id="time_form" class="form-control timepicker inputTime" data-template="dropdown"
                                                                        data-show-meridian="true" data-minute-step="5" readonly>
                                                                </div><br>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label style="font-size:12px; font-weight:normal;"> Amount Pax</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group minimal">
                                                                    <div class="input-group-addon custgroup">
                                                                        <i class="fa fa-user" style="color:black;"></i>
                                                                    </div>
                                                                    <input type="text" style="color:black;" maxlength="5"
                                                                        class="form-control inputPax" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p
                                                                    style="font-size:12px; margin-top:5px; margin-left:-20px;">
                                                                    Pax</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4><strong>Additional Request</strong></h4>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <textarea style="height: 100%;" class="form-control autogrow visitor-input"
                                                                    cols="1" rows="7" id="additional_request"
                                                                    placeholder="e.g Near Swimming Pool, Non Smoking Room"></textarea>
                                                                    <span style="font-size:9px;">*All additional request are Subject to Availability</span>
                                                            </div>
                                                        </div>
                                                        <div class="row" align="right">
                                                            <div class="col-md-12">
                                                                <ul class="pager wizard">

                                                                <li id="tab_customer">
                                                                    <a class="btn btn-horison-payment" style="float:right;"
                                                                        href="javascript:;" onclick="confirm(this, 'customer')">CHOOSE PAYMENT METHOD <i class="entypo-right-open"></i></a>
                                                                </li>
                                                            </ul>
                                                            </div>
                                                        </div>

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
                                                    <section class="album-info-inq shadow">

                                                        {{-- MAIN FORM --}}
                                                        <h4><b>Reservation Details</b></h4>

                                                        <div class="row indent-reserve">
                                                            @if($data->type == "Room")
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-calendar-o"></i>
                                                                <span style="font-weight:normal" for="">&nbsp;
                                                                    {{$data->reserveDate}}</span>
                                                            </div>
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                <span style="font-weight:normal" for="">&nbsp;
                                                                    {{$data->roomNameDetails}}</span>
                                                            </div>
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-users"></i>
                                                                <span style="font-weight:normal" for="">&nbsp;
                                                                    {{$data->totalGuest}}</span>
                                                            </div>
                                                            @else
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-calendar-o"></i>
                                                                <span style="font-weight:normal" class="product_date">&nbsp; {{$data->reserveDate}}</span>
                                                            </div>
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                <span style="font-weight:normal" for="">&nbsp; {{$data->productName}}</span>
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

                                                    <section class="album-info-inq shadow">

                                                        {{-- MAIN FORM --}}
                                                        <h4><b>Price Details</b></h4>

                                                        <div style="display: flex; flex-wrap: wrap;">
                                                            @if($data->type == "Room")
                                                            <div style="width: 65%; text-align: justify;">
                                                                <p style="font-size:14px; color:black;">
                                                                    {{$data->roomDetail}}</p>
                                                            </div>
                                                            <div style="margin-left: auto;">
                                                                <p style="font-size: 14px;">
                                                                    <strong>
                                                                        <script>
                                                                            document.write("Rp "+formatRupiah("{{$data->roomPrice}}"));
                                                                        </script>
                                                                    </strong>
                                                                </p>
                                                            </div>
                                                            @if($data->extrabedTotal > 0)
                                                            <div>
                                                                <p style="font-size:14px; color:black;">Additional Extra Bed
                                                                </p>
                                                            </div>
                                                            <div style="margin-left: auto;">
                                                                <p style="font-size:14px">
                                                                    <strong>
                                                                        <script>
                                                                            document.write("Rp "+formatRupiah("{{$data->extrabedPrice}}"));
                                                                        </script>
                                                                    </strong>
                                                                </p>
                                                            </div>
                                                            @endif
                                                            @else
                                                            <div style="width: 65%; text-align: justify;">
                                                                <p class="product_details" style="font-size:14px; color:black;">
                                                                    0 x {{$data->productName}}</p>
                                                            </div>
                                                            <div style="margin-left: auto;">
                                                                <p class="product_price" style="font-weight: bolder; font-size:14px">
                                                                    <strong>Rp 0</strong>
                                                                </p>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <hr>
                                                        <div class="" style="display: flex">
                                                            <div class="">
                                                                <p style="font-weight: bolder; font-size:18px">Total</p>
                                                            </div>
                                                            <div class="" style="margin-left: auto; ">
                                                                @if($data->type == "Room")
                                                                    <p style="font-size: 20px">
                                                                        <strong>
                                                                            <script>
                                                                                document.write("Rp "+formatRupiah("{{$data->totalPrice}}"));
                                                                            </script>
                                                                        </strong>
                                                                    </p>
                                                                @elseif($data->type == "Product")
                                                                    <p class="product_total" style="font-weight: bolder; font-size:20px;">
                                                                        <strong>Rp 0</strong>
                                                                    </p>
                                                                @endif
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

                            <div class="tab-pane" id="tab2-2">
                                <div class="col-md-8">
                                    <!-- form reserve -->
                                    <div class="gallery-env">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <article class="album">
                                                    <section class="album-info-inq shadow">

                                                        <div id="form_payment">
                                                            <form id="formReserve" class="panel minimal-custom minimal-gray"
                                                                style="display: none" action="">
                                                                {{csrf_field()}}

                                                                <ul class="nav nav-tabs bordered">
                                                                    <!-- available classes "bordered", "right-aligned" -->
                                                                    <li>
                                                                        <a href="#bank" data-toggle="tab" class="bg-primary font-primary">
                                                                            <span><i class="fa fa-archive"></i></span>
                                                                            <span class="hidden-xs">Bank Transfer</span>
                                                                        </a>
                                                                    </li>

                                                                    <li>
                                                                        <a href="#credit" data-toggle="tab" class="bg-primary font-primary">
                                                                            <span><i class="fa fa-credit-card""></i></span>
                                                                            <span class="hidden-xs"">Credit Card</span>
                                                                        </a>
                                                                    </li>

                                                                </ul>

                                                                <div class="tab-content credittab" >
                                                                    <div class="tab-pane tab-horison-bank" id="bank">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label class="control-label" for="payment-channel" style="font-size:12px; font-weight:bold;">Choose Bank</label>
                                                                                    <select id="payment-channel" name="payment-channel" class="form-control visitor-input">
                                                                                        @php
                                                                                            foreach ($listPaymentChannels as $listPaymentChannel => $item) {
                                                                                                if ($item['pg_code'] == 402) {
                                                                                                    unset($listPaymentChannels[$listPaymentChannel]);
                                                                                                }
                                                                                            }

                                                                                            foreach ($listPaymentChannels as $listPaymentChannel ) {
                                                                                                echo"<option value='$listPaymentChannel[pg_code]'>$listPaymentChannel[pg_name]</option>";
                                                                                            }

                                                                                        @endphp
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <ul class="form-group">
                                                                                    <li>Confirm OTP to
                                                                                        make Payment</li>
                                                                                    <li>Complete
                                                                                        payment within 20 minutes</li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row pdrl-20">
                                                                            <div class="col-md-12">
                                                                                <p style="text-align:left;">By proceeding, I agree to Horison Terms of Use and Privacy Policy</p>
                                                                            </div>

                                                                            <div class="col-md-12" align="right">
                                                                                <ul class="pager wizard">
                                                                                    <li class="" style="float:right;">
                                                                                        <a id="btn-transfer" class="btn btn-horison-payment" href="javascript:;" onclick="confirmPayment(this, 'customer')">CONFIRM PAYMENT BANK TRANSFER<i class="entypo-right-open"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane tab-horison-credit" id="credit">

                                                                        <div class="row">
                                                                            <div class="col-md-12" align="left">
                                                                                <ul class="pager wizard">
                                                                                    <li class="" style="float:left;">
                                                                                        <a id="btn-credit" class="btn btn-horison-payment" href="javascript:;" onclick="confirmPaymentCredit();">CONFIRM PAYMENT CREDIT CARD<i class="entypo-right-open"></i></a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

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
                                                    <section class="album-info-inq shadow">

                                                        {{-- MAIN FORM --}}
                                                        <h4><b>Reservation Details</b></h4>

                                                        <div class="row indent-reserve">
                                                            @if($data->type == "Room")
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-calendar-o"></i>
                                                                <span style="font-weight:normal" for="">&nbsp;
                                                                    {{$data->reserveDate}}</span>
                                                            </div>
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                <span style="font-weight:normal" for="">&nbsp;
                                                                    {{$data->roomNameDetails}}</span>
                                                            </div>
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-users"></i>
                                                                <span style="font-weight:normal" for="">&nbsp;
                                                                    {{$data->totalGuest}}</span>
                                                            </div>
                                                            @else
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-calendar-o"></i>
                                                                <span style="font-weight:normal" class="product_date">&nbsp; {{$data->reserveDate}}</span>
                                                            </div>
                                                            <div class="col-md-12 indext-reserve-margin">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                <span style="font-weight:normal" for="">&nbsp; {{$data->productName}}</span>
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

                                                    <section class="album-info-inq shadow">

                                                        {{-- MAIN FORM --}}
                                                        <h4><b>Price Details</b></h4>

                                                        <div style="display: flex; flex-wrap: wrap;">
                                                            @if($data->type == "Room")
                                                            <div style="width: 65%; text-align: justify;">
                                                                <p style="font-size:14px; color:black;">
                                                                    {{$data->roomDetail}}</p>
                                                            </div>
                                                            <div style="margin-left: auto;">
                                                                <p style="font-size: 14px;">
                                                                    <strong>
                                                                        <script>
                                                                            document.write("Rp "+formatRupiah("{{$data->roomPrice}}"));
                                                                        </script>
                                                                    </strong>
                                                                </p>
                                                            </div>
                                                            @if($data->extrabedTotal > 0)
                                                            <div>
                                                                <p style="font-size:14px; color:black;">Additional Extra Bed
                                                                </p>
                                                            </div>
                                                            <div style="margin-left: auto;">
                                                                <p style="font-size:14px">
                                                                    <strong>
                                                                        <script>
                                                                            document.write("Rp "+formatRupiah("{{$data->extrabedPrice}}"));
                                                                        </script>
                                                                    </strong>
                                                                </p>
                                                            </div>
                                                            @endif
                                                            @else
                                                            <div style="width: 65%; text-align: justify;">
                                                                <p class="product_details" style="font-size:14px; color:black;">
                                                                    0 x {{$data->productName}}</p>
                                                            </div>
                                                            <div style="margin-left: auto;">
                                                                <p class="product_price" style="font-weight: bolder; font-size:14px">
                                                                    <strong>Rp 0</strong>
                                                                </p>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <hr>
                                                        <div class="" style="display: flex">
                                                            <div class="">
                                                                <p style="font-weight: bolder; font-size:18px">Total</p>
                                                            </div>
                                                            <div class="" style="margin-left: auto; ">
                                                                @if($data->type == "Room")
                                                                    <p style="font-size: 20px">
                                                                        <strong>
                                                                            <script>
                                                                                document.write("Rp "+formatRupiah("{{$data->totalPrice}}"));
                                                                            </script>
                                                                        </strong>
                                                                    </p>
                                                                @elseif($data->type == "Product")
                                                                    <p class="product_total" style="font-weight: bolder; font-size:20px;">
                                                                        <strong>Rp 0</strong>
                                                                    </p>
                                                                @endif
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

                            <div class="tab-pane" id="tab2-3">
                                <div class="col-md-8">
                                    <div class="gallery-env">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <article class="album" style="">
                                                    <section class="album-info-inq shadow"
                                                        style="border-bottom:none;">
                                                        {{-- MAIN FORM --}}
                                                        <br>
                                                        <h4></h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="">
                                                                        <strong>Your Booking <b class="booking_id">{{ $data->booking_id }}</b> has been placed!</strong>
                                                                    </label>
                                                                    <ul>
                                                                        <li>You will receive your booking details at
                                                                            <b class="customer_email">noreply1@tripasysfo.com</b></li>
                                                                        <li>You will receive your Voucher after you have made
                                                                            your payment</li>
                                                                        <li id="transaction_due">Please finish this transaction before <b class="transaction_due"></b></li>
                                                                        <li>You will receive a confirmation email as soon this
                                                                            transaction has been approved</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row" style="margin-top:30px">
                                                            <div class="col-md-12">
                                                                <label><strong>Transfer to:</strong></label><br><br>
                                                                <div class="form-group" style="padding:20px; border:1px solid #BDBDBD;">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account Number</p>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <p class="transaction_id" style="color:black; font-weight: bold !important;"><strong>379xxxxxxxxx</strong></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Method</p>
                                                                        </div>
                                                                        <div class="col-md-8" align="left">
                                                                            <p class="payment_type" style="color:black; font-weight: bold !important;"><strong>BCA Virtual Account</strong></p>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row" style="margin-top:-20px;">
                                                                        <div class="col-md-4">
                                                                            <p>Transfer Amount</p>
                                                                        </div>
                                                                        <div class="col-md-8" align="left">
                                                                            @if($data->type == "Room")
                                                                                <p style="color:black">
                                                                                    <strong>
                                                                                        <script>
                                                                                            document.write("Rp "+formatRupiah("{{$data->totalPrice}}"));
                                                                                        </script>
                                                                                    </strong>
                                                                                </p>
                                                                            @elseif($data->type == "Product")
                                                                                <p class="product_total" style="color:black; font-weight: bolder;">
                                                                                    <strong>Rp 0</strong>
                                                                                </p>
                                                                            @endif


                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
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
                                                <div class="panel-footer footer-payment">
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
                                                            <div class="col-md-12">
                                                                <p><strong>Booking ID</strong></p>
                                                            </div>
                                                            <div class="col-md-12 mt-10">
                                                                <label class="booking_id" for="">{{ $data->booking_id }}</label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <p><strong>Reserve By</strong></p>
                                                            </div>
                                                            <div class="col-md-12 mt-10">
                                                                <label class="customer_name" for="">Norma Steward</label>
                                                            </div>
                                                        </div>
                                                        <hr><br>
                                                        {{-- MAIN FORM --}}
                                                        <h4><b>Booking Details</b></h4>

                                                        <div class="row">
                                                            @if($data->type == "Room")
                                                            <div class="col-md-12">
                                                                <i class="fa fa-calendar-o"></i>
                                                                <span style="font-weight:normal" for="">&nbsp; {{$data->reserveDate}}</span>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                <span style="font-weight:normal" for="">&nbsp; {{$data->roomName}}</span>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i class="fa fa-users"></i>
                                                                <span style="font-weight:normal" for="">&nbsp;
                                                                    {{$data->totalGuest}}</span>
                                                            </div>
                                                            @elseif($data->type == "Product")
                                                            <div class="col-md-12">
                                                                <i class="fa fa-calendar-o"></i>
                                                                <span style="font-weight:normal" for="">&nbsp; {{$data->reserveDate}}</span>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                <span style="font-weight:normal" for="">&nbsp; {{$data->productName}}</span>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i class="fa fa-users"></i>
                                                                <span class="amount_pax" style="font-weight:normal" for="">&nbsp;
                                                                    Pax</span>
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

                                                    <section class="album-info-inq shadow">
                                                        {{-- MAIN FORM --}}
                                                        <h4><b>Price Details</b></h4>
                                                        <div style="display: flex; flex-wrap: wrap;">
                                                            @if($data->type == "Room")
                                                            <div class="col-md-7">
                                                                <p style="font-size:14px; color:black;">{{$data->roomDetail}}
                                                                </p>
                                                            </div>
                                                            <div style="margin-left: auto;">
                                                                <p style="font-size:14px">
                                                                    <strong>
                                                                        <script>
                                                                            document.write("Rp "+formatRupiah("{{$data->roomPrice}}"));
                                                                        </script>
                                                                    </strong>
                                                                </p>
                                                            </div>
                                                            @if($data->extrabedTotal > 0)
                                                            <div class="col-md-7">
                                                                <p style="font-size:14px; color:black;">Additional Extra Bed
                                                                </p>
                                                            </div>
                                                            <div style="margin-left: auto;">
                                                                <p style="font-size:14px">
                                                                    <strong>
                                                                        <script>
                                                                            document.write("Rp "+formatRupiah("{{$data->extrabedPrice}}"));
                                                                        </script>
                                                                    </strong>
                                                                </p>
                                                            </div>
                                                            @endif
                                                            @else
                                                            <div class="col-md-7">
                                                                <p class="product_details" style="font-size:14px; color:black;">
                                                                    0 x {{$data->productName}}</p>
                                                            </div>
                                                            <div class="col-md-5">
                                                            <p class="product_price" style="font-size:14px; font-weight: bolder;">
                                                                <strong>Rp 0</strong>
                                                            </p>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <hr>
                                                        <div class="row" style="display: flex">
                                                            <div class="col-md-7">
                                                                <p style="margin-left: 10px; font-weight: bolder; font-size:18px">Total</p>
                                                            </div>
                                                            <div class="col-md-5" style="margin-left: auto; padding-left: 55px; min-width: 200px;">
                                                            @if($data->type == "Room")
                                                                <p style="font-weight: bolder; font-size:18px;">
                                                                    <strong style="font-weight: bolder;">
                                                                        <script>
                                                                            document.write("Rp "+formatRupiah("{{$data->totalPrice}}"));
                                                                        </script>
                                                                    </strong>
                                                                </p>
                                                            @elseif($data->type == "Product")
                                                                <p class="product_total" style="font-weight: bolder; font-size:18px;"><strong></strong>
                                                                </p>
                                                            @endif
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
                                        <a href="{{ $setting->so_instagram }}" class="fa fa-instagram visitor-footer-icon" target="_blank"></a>
                                    </p>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <p>
                                        <a href="{{ $setting->so_facebook }}" class="fa fa-facebook visitor-footer-icon" target="_blank"></a>
                                    </p>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <p><a href="{{ $setting->so_twitter }}" class="fa fa-twitter visitor-footer-icon" target="_blank"></a></p>
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

    {{-- input type number only --}}
    <script>

        function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
        }
    </script>
    {{-- End input type number only --}}

    {{-- CUSTOM DATEPICKER --}}
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker-module-ranges/dist/index.js"></script>

    <script>
        function IsMobile() {
            var Uagent = navigator.userAgent||navigator.vendor||window.opera;
            return(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(Uagent)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(Uagent.substr(0,4)));
        };

        if (IsMobile())
        {
            $('.timez').css("text-align", "center");
            $('#logo_horison').hide();
        }else{
            $('.timez').css("text-align", "end");

            $('#logo_horison').show();
        }

        // CREATE TIMER
        const timezz = new TimezZ('.timez', {
            date: moment(new Date("{{$data->expired_at}}")).format("LLL"),
            text: {
                minutes: ' minutes',
                seconds: ' seconds',
            },
            finished() {
                window.onbeforeunload = '';
                window.location.href = '/';
            },
        });

        window.onbeforeunload = function() { return "Your work will be lost."; };

        $('.numberValidation').keyup(function () {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });

        $('.alphanumericValidation').keyup(function () {
            this.value = this.value.replace(/[^A-Za-z0-9]/g, '');
        });

        function for_other(e) {
            if(e.checked == true){
                $('#otherBookForm').fadeIn('slow');
            }else{
                $('#otherBookForm').fadeOut('slow');
            }
        }

        function resetPax() {
            $('.inputPax').val(1);
            var price = {{$data->productPrice}} * 1;

            var total = price;
            $('.product_details').text("1x "+"{{$data->productName}}");
            $('.product_price').text("Rp "+formatRupiah(price));
            $('.product_total').text("Rp "+formatRupiah(total));
        }

        var product_picker;
        if("{{$data->type}}" == "Product"){

            $('.amount_pax').html("&nbsp;"+"1 Pax");
            var time = $('.inputTime').val();
            var date = $('.inputDate').val();
            $('.product_date').html("&nbsp;"+date+" / "+time);

            //CREATE CUSTOMER DATEPICKER
            product_picker = new Litepicker({
                firstDay: 1,
                format: "DD MMMM YYYY",
                lang: 'en-US',
                numberOfMonths: 1,
                numberOfColumns: 1,
                minDate: moment(new Date()).format("DD MMMM YYYY"),
                autoApply: true,
                showTooltip: true,
                singleMode: true,
                element: document.getElementById('datePickerReserveForm'),
                onSelect: function(date1) {
                    date = moment(date1).format("DD MMMM YYYY");
                    var time = $('.inputTime').val();

                    $('.product_date').html("&nbsp;"+date+" / "+time);
                }
            });

            product_picker.setDate(new Date("{{$data->reserveDate}}"));

            resetPax();

            $('.inputPax').keyup(function () {

            this.value = this.value.replace(/[^0-9\.]/g, '');
            if(this.value > 4){
                Swal.fire(
                    'Sorry',
                    "Sorry max Pax is 4 and min Pax is 1",
                    'warning'
                );
                resetPax();
            }

            var price = {{$data->productPrice}} * this.value;
            var total = price;
                $('.product_details').text(formatRupiah(this.value)+" x "+"{{$data->productName}}");
                $('.product_price').text("Rp "+formatRupiah(price));
                $('.product_total').text("Rp "+formatRupiah(total));
                $('.amount_pax').html("&nbsp;"+formatRupiah(this.value)+" Pax");
            });
        }

        $('.inputDate').on('change',function () {
            var date = this.value;
            var time = $('.inputTime').val();
            $('.product_date').html("&nbsp;"+date+" / "+time);
        });

        $('.inputTime').on('change',function () {
            var time = this.value;
            var date = $('.inputDate').val();
            $('.product_date').html("&nbsp;"+date+" / "+time);
        });

        var input_number = document.querySelector("#phone_number");

        var iti = window.intlTelInput(input_number, {
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                return "e.g. " + selectedCountryPlaceholder;
            },
            separateDialCode: true,
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
                });
            },
            utilsScript: "{{ asset('js/intl-phone/utils.js') }}", // just for formatting/placeholders etc
        });

        var data;
        function confirm(e, type) {
            var customer_name = $('#full_name').val();
            var id_card = $('#id_card').val();
            var id_number = $('#id_number').val();
            var email = $('#email').val();
            var additional_request = $('#additional_request').val();

            if (iti.isValidNumber()) {
                var phone_number = iti.getNumber();
            } else {
                Swal.fire(
                    'Sorry',
                    'Phone Number is invalid',
                    'warning'
                );
                return false;
            }

            var guest = $('#guest_name').val();

            if(type == 'customer'){
                if("{{$data->type}}" == "Room"){

                    var url = "{{ route('visitor.reserve_room') }}";

                    data = {
                        rsvp : "{{$data->type}}",
                        type : "customer",
                        cust_name : customer_name,
                        cust_id_type : id_card,
                        cust_id_num : id_number,
                        cust_email : email,
                        cust_phone : phone_number,
                        guest_name : guest,
                        additional_request: additional_request,
                        room_name   : "{{$data->roomName}}",
                        total_rooms : "{{$data->totalRooms}}",
                        total_days : "{{$data->totalDays}}",
                        total_room_price : {{$data->roomPrice}},
                        total_extrabed : {{$data->extrabedTotal}},
                        total_extrabed_price : {{$data->extrabedPrice}},
                        total_price : {{$data->totalPrice}}
                    }
                } else if("{{$data->type}}" == "Product") {
                    var pax = $('.inputPax').val();
                    var date_reserve = moment(product_picker.getDate()).format("DD MMMM YYYY");

                    var time_reserve = $('.inputTime').val();
                    var url = "{{ route('visitor.reserve_product') }}";

                    data = {
                        rsvp : "{{$data->type}}",
                        type : "customer",
                        product_id : "{{$data->productId}}",
                        cust_name : customer_name,
                        cust_id_type : id_card,
                        cust_id_num : id_number,
                        cust_email : email,
                        cust_phone : phone_number,
                        additional_request: additional_request,
                        date_reserve : date_reserve,
                        time_reserve : time_reserve,
                        product_name   : "{{$data->productName}}",
                        amount_pax : pax,
                    }
                }

            }

            data = JSON.stringify(data);

            $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "booking_id": "{{$data->booking_id}}",
                "data": data
            },
            url: url,
            success: function (data) {
                // console.log(data);
                if( data.status === 422 ) {

                    Swal.fire(
                        'Sorry',
                        data.msg,
                        'warning'
                    );
                }else if(data.status === 200) {
                    $('#toogle_1 > a').css('cursor','not-allowed');
                    $('#toogle_1 > a').removeAttr('href');
                    var html ='<a href="#'+data.href+'" id="btn_tab'+data.tab+'" data-toggle="tab"><span>'+data.tab+'</span>'+data.text+'</a>';
                    $('.customer_name').text(data.customer_name);
                    $('.customer_email').text(data.customer_email);

                    $('#toogle_'+data.tab).empty();
                    $('#toogle_1').addClass('completed');
                    $('#toogle_'+data.tab).append(html);
                    $('#btn_tab'+data.tab).click();
                }
            }
        });

        }

        function confirmPayment(e, type) {

            $('.lds-dual-ring-admin').show();

            $('#btn-transfer').css("pointer-events", "none");

            // $("#btn-transfer").attr("disabled",true);
            $("#btn-credit").attr("disabled",true);

            var paymentChannel = ($('#payment-channel').val());

            if("{{$data->type}}" == "Room"){
                var url = "{{ route('visitor.room_checkout') }}";

                data = {
                    room_name           : "{{ $data->roomName }}",
                    total_rooms         : "{{ $data->totalRooms }}",
                    total_days          : "{{ $data->totalDays }}",
                    total_room_price    : "{{ $data->roomPrice }}",
                    total_extrabed      : "{{ $data->extrabedTotal }}",
                    total_extrabed_price: "{{ $data->extrabedPrice }}",
                    total_price         : "{{ $data->totalPrice }}"
                }

            } else if("{{$data->type}}" == "Product") {
                var url = "{{ route('visitor.product_checkout') }}";

                var pax = $('.inputPax').val();

                var price = {{$data->productPrice}} * pax;

                data = {
                    product_name: "{{ $data->productName }}",
                    amount_pax  : pax,
                    total_price : price
                }
            }

            // data = JSON.stringify(data);

            // console.log(data);

            $.ajax({
                type: "POST",
                data: {
                    "_token"         : "{{ csrf_token() }}",
                    "booking_id"     : "{{ $data->booking_id }}",
                    "payment_channel": paymentChannel,
                    "data": data

                },
                url: url,

                success: function (data) {
                    // console.log(data);
                    if( data.status === 422 ) {
                        Swal.fire(
                            'Sorry',
                            data.msg,
                            'warning'
                        );
                    }  else if(data.status === 200) {
                        // console.log(data);
                        $('.lds-dual-ring-admin').hide();

                        $('.transaction_id').text(data.transaction_id);
                        $('.payment_type').text(data.payment_type);
                        $('.product_total').text("Rp "+formatRupiah(data.product_total));

                        var expired = moment(data.bill_expired).format('DD MMMM YYYY HH:mm');

                        $('.transaction_due').text(expired);

                        var html1 ='<a href="javascript:;" aria-disabled="true" style="cursor:not-allowed;"><span>1</span>Customer Information</a>';
                        var html2 ='<a href="javascript:;" aria-disabled="true" style="cursor:not-allowed;"><span>2</span>Payment Information</a>';
                        var html3 ='<a href="#tab2-3" id="btn_tab3" data-toggle="tab"><span>3</span>Booking Confirmed!</a>';

                        $('#toogle_1').empty();
                        $('#toogle_1').addClass('completed');
                        $('#toogle_1').append(html1);
                        $('#toogle_2').empty();
                        $('#toogle_2').addClass('completed');
                        $('#toogle_2').append(html2);
                        $('#toogle_3').empty();
                        $('#toogle_3').append(html3);

                        $("html, body").animate({
                            scrollTop: 0
                        }, "fast");

                        $('#btn_tab3').click();
                        $('#timer_text').text("Finished");
                        timezz.destroy();
                    }
                }
            });
        }

        function confirmPaymentCredit() {
            top.window.onbeforeunload = null;

            if("{{$data->type}}" == "Room"){

                var value = {
                    room_name           : "{{ $data->roomName }}",
                    total_rooms         : "{{ $data->totalRooms }}",
                    total_days          : "{{ $data->totalDays }}",
                    total_room_price    : "{{ $data->roomPrice }}",
                    total_extrabed      : "{{ $data->extrabedTotal }}",
                    total_extrabed_price: "{{ $data->extrabedPrice }}",
                    total_price         : "{{ $data->totalPrice }}",
                    booking_id          : "{{$data->booking_id}}",
                    from                : "ROOMS"
                };

            } else if("{{$data->type}}" == "Product") {

                var pax = $('.inputPax').val();

                var price = {{$data->productPrice}} * pax;

                var value = {
                    "product_name": "{{ $data->productName }}",
                    "booking_id"  : "{{$data->booking_id}}",
                    "total_price" : price,
                    "total_pax"   : pax,
                    "from"        : "PRODUCTS"
                };
            }

            $('#reserve_data').val(JSON.stringify(value));
            $('#reserve').submit();
        }

    </script>

</body>

</html>
