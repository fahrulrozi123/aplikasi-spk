@extends('templates/visitor_rsv_template')

@section('description', 'Rooms Horison Ultima Bandung. Booking dari website kami untuk dapatkan harga terbaik!')
@section('keywords', 'Rooms Horison Ultima Bandung, Rooms')
@section('title', 'Rooms')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-core.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{ asset('js/selectboxit/jquery.selectBoxIt.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/black.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/font-awesome/css/font-awesome.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/md-tripa.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/horison-custom.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/404-custom.css ') }}">
    <!-- International Phone Mask -->
    <link rel="stylesheet" href="{{ asset('css/intl-phone/intlTelInput.css') }}">
    {{-- custom slider --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slider-custom.css') }}">
    <script src="{{ asset('js/moment.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker-bs3.css') }}">
	<link rel="shortcut icon" href="{{ asset('/images/logo/'.$setting->favicon) }}" type="image/x-icon"/>

    <script src="{{ asset('js/jquery-1.11.3.min.js ') }}"></script>
    <script src="{{ asset('js/numeral/numeral.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <!-- International Phone Mask -->
    <script src="{{ asset('js/intl-phone/intlTelInput.js') }}"></script>
    <!-- sweet ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    {{-- custom datepicker --}}
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker-module-ranges/dist/index.js"></script>

    <script type="text/javascript">
        var home_url = "{{url('/')}}";

        $(window).load(function () {
            $(".lds-dual-ring").fadeOut("slow");;
        });
    </script>

<div class="lds-dual-ring"></div>

    <!-- form reserve -->
    <div id="form_reserve">
        <div id="formReserve" class="panel minimal-custom minimal-gray" style="display: none">
            <form id="room_reserve" method="GET" action="http://booking-engine.test/reservation"></form>
            <form id="product_reserve" method="POST" action="http://booking-engine.test/product_reservation">
                <input type="hidden" name="_token" value="g2DqPb0gjJRWiGrZhXxiFyRy00lTqnzmpRXwIG2A"></form>
            <div class="panel-heading">
                <div class="panel-title">
                    <h4></h4>
                </div>
                <div class="panel-options">

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#rooms" data-toggle="tab"><i class="fa fa-bed"></i>&ensp;Rooms</a>
                        </li>
                        <li><a href="#product" data-toggle="tab"><i class="fa fa-diamond"></i>&ensp;Other Package</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel-body bg-secondary">

                <div class="tab-content">
                    <div class="tab-pane active bg-secondary" id="rooms">

                        <div class="row modal-reserve-row">
                            <div class="col-md-6">
                                <label for="date_check" class="label-modal-reserve">Check In</label>
                                <div class="input-group col-md-12 required">
                                    <input form="room_reserve" id="datePickerReserveForm" type="text"
                                        autocomplete="off" style="background-color: inherit;"
                                        class="form-control modal-form-control inputbox-datepicker visitor-input"
                                        name="checkin" placeholder="" readonly required>
                                    <span class="input-group-addon addon-modal-reserve"><i
                                            class="entypo-calendar font-primary"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-right: 0px;">
                                <label for="date_check" class="label-modal-reserve">Duration of Stay</label>
                                <div class="input-group col-md-12">
                                    <select form="room_reserve" name="stay_total"
                                        class="form-control modal-form-control visitor-input">
                                         <option value="1">1 Night</option>
                                             <option value="2">2 Night</option>
                                             <option value="3">3 Night</option>
                                             <option value="4">4 Night</option>
                                             <option value="5">5 Night</option>
                                             <option value="6">6 Night</option>
                                             <option value="7">7 Night</option>
                                             <option value="8">8 Night</option>
                                             <option value="9">9 Night</option>
                                             <option value="10">10 Night</option>
                                             <option value="11">11 Night</option>
                                             <option value="12">12 Night</option>
                                             <option value="13">13 Night</option>
                                             <option value="14">14 Night</option>
                                             <option value="15">15 Night</option>
                                                                                </select>
                                </div>
                            </div>
                        </div><br>


                        <div class="row modal-reserve-row">
                            <div class="col-md-6">
                                <label for="room_choice" class="label-modal-reserve">Rooms</label>
                                <div class="input-spinner">
                                    <button type="button" onclick="addRoomTotal(-1);" class="btn btn-horison"
                                        data-step="-1" style="height:31px">-</button>
                                    <input type="text" form="room_reserve" id="room_total" onchange="addRoomTotal();"
                                        name="room_total" class="form-control size-3 dd-horison" value="1" data-min="1"
                                        data-max="5" style="background-color: inherit;" required readonly>
                                    <button type="button" onclick="addRoomTotal(1);" class="btn btn-horison"
                                        data-step="1" style="height:31px">+</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="extrabed_sum" class="label-modal-reserve">Extra Bed</label>
                                <div class="input-spinner">
                                    <button type="button" class="btn btn-horison" data-step="-1"
                                        style="height:31px">-</button>
                                    <input type="text" form="room_reserve" id="extra_bed" name="extra_bed"
                                        class="form-control size-3 dd-horison" value="0" data-min="0" data-max="5"
                                        style="background-color: inherit;" required readonly>
                                    <button type="button" class="btn btn-horison" data-step="1"
                                        style="height:31px">+</button>
                                </div>
                            </div>
                        </div><br>

                        <div class="row modal-reserve-row">
                            <div class="col-md-6">
                                <label for="adult_sum" class="label-modal-reserve">Adults</label>
                                <div class="input-spinner">
                                    <button type="button" class="btn btn-horison" data-step="-1"
                                        style="height:31px">-</button>
                                    <input type="text" form="room_reserve" id="adult_total" name="adult_total"
                                        class="form-control size-3 dd-horison" value="1" min="1" max="2" data-min="1"
                                        data-max="10" style="background-color: inherit;" required readonly>
                                    <button type="button" class="btn btn-horison" data-step="1"
                                        style="height:31px">+</button>
                                </div><br>
                            </div>
                            <div class="col-md-6">
                                <label for="children_sum" class="label-modal-reserve">Children</label>
                                <div class="input-spinner">
                                    <button type="button" class="btn btn-horison" data-step="-1" style="height:31px"
                                        onclick="addChild(-1);">-</button>
                                    <input type="text" form="room_reserve" id="child_total" name="child_total"
                                        class="form-control size-3 dd-horison" value="0" data-min="0" data-max="10"
                                        style="background-color: inherit;" readonly>
                                    <button type="button" class="btn btn-horison" data-step="1" style="height:31px"
                                        onclick="addChild(1);">+</button>
                                </div>
                            </div>
                            <div class="col-md-12" id="children" style="margin-left: 10px;">
                                <input form="room_reserve" type="hidden" id="child_age" name="child_age">
                            </div>
                        </div><br>

                        <div class="row" align="center" style="margin-left:30px; margin-right:30px;">
                            <input type="button" onclick="submit('room_reserve');"
                                class="btn btn-block btn-lg btn-horison-visitor" value="Find Rooms"
                                style="font-weight:bold;" />
                        </div>

                    </div>

                    <div class="tab-pane bg-secondary" id="product">
                        <div class="row modal-reserve-row">
                            <div class="col-md-12">
                                <label for="date_product" class="label-modal-reserve">Date</label>
                                <div class="input-group col-md-12">
                                    <input form="product_reserve" type="text" style="background-color: inherit;"
                                        class="form-control modal-form-control inputbox-datepicker visitor-input bg-secondary"
                                        name="date_product" id="date_product" placeholder="" readonly>
                                    <span class="input-group-addon addon-modal-reserve"><i
                                            class="entypo-calendar font-primary"></i></span>
                                </div><br>
                            </div>
                            <div class="col-md-12">
                                <label for="category_product" class="label-modal-reserve">Package Category</label>
                                <select onchange="set_product(this);"
                                    class="form-control modal-form-control visitor-input">

                                </select><br>
                            </div>
                            <div class="col-md-12">
                                <label for="select_product" class="label-modal-reserve">Select Package</label>
                                <select form="product_reserve" name="product_list"
                                    class="form-control modal-form-control visitor-input product_list">
                                </select><br><br>
                            </div>
                        </div>

                        <div class="row" align="center" style="margin-left:30px; margin-right:30px;">
                            <input id="validate_click" type="button" onclick="submit('product_reserve');"
                                class="btn btn-block btn-lg btn-horison-visitor" value="Reserve Package"
                                style="font-weight:bold;" />
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div id="form_reserve_mobile">
        <div id="formReservemobile" class="panel minimal-custom minimal-gray" style="display: none; bottom: 12px; width: 100%;">
            <form id="room_reserve_mobile" method="GET" action="http://booking-engine.test/reservation"></form>
            <form id="product_reserve_mobile" method="POST" action="http://booking-engine.test/product_reservation">
                <input type="hidden" name="_token" value="g2DqPb0gjJRWiGrZhXxiFyRy00lTqnzmpRXwIG2A"></form>
            <div class="panel-heading">
                <div class="panel-title">
                    <h4></h4>
                </div>
                <div class="panel-options">
                    <ul class="nav nav-tabs">
                        <li class="active shadow2"><a href="#rooms_mobile" data-toggle="tab">
                            <i class="fa fa-bed"></i>&ensp;Rooms</a>
                        </li>
                        <li class="shadow2"><a href="#product_mobile" data-toggle="tab">
                            <i class="fa fa-diamond"></i>&ensp;Other Package</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="panel-body shadow2 bg-secondary" style="margin-bottom: 10px;">
                <div class="tab-content">
                    <div class="tab-pane active bg-secondary" id="rooms_mobile">
                        <div class="row modal-reserve-row">
                            <div class="col-xs-12 col-sm-8 col-md-6">
                                <label for="date_check" class="label-modal-reserve">Check In</label>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-11">
                                        <div class="input-group col-xs-12 col-md-12 required">
                                            <input id="datePickerMobile" form="room_reserve_mobile" type="text"
                                                name="checkin" autocomplete="off" style="background-color: inherit;"
                                                class="form-control modal-form-control inputbox-datepicker visitor-input"
                                                placeholder="" readonly required>
                                            <span class="input-group-addon addon-modal-reserve"><i
                                                    class="entypo-calendar font-primary"></i></span>
                                        </div>
                                    </div>
                                </div><br>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-6">
                                <label for="date_check" class="label-modal-reserve">Duration of Stay</label>
                                <div style="padding-right: 0px;">
                                    <select form="room_reserve_mobile" name="stay_total"
                                        class="form-control modal-form-control visitor-input">
                                         <option value="1">1 Night</option>
                                             <option value="2">2 Night</option>
                                             <option value="3">3 Night</option>
                                             <option value="4">4 Night</option>
                                             <option value="5">5 Night</option>
                                             <option value="6">6 Night</option>
                                             <option value="7">7 Night</option>
                                             <option value="8">8 Night</option>
                                             <option value="9">9 Night</option>
                                             <option value="10">10 Night</option>
                                             <option value="11">11 Night</option>
                                             <option value="12">12 Night</option>
                                             <option value="13">13 Night</option>
                                             <option value="14">14 Night</option>
                                             <option value="15">15 Night</option>
                                                                                </select>
                                </div><br>
                            </div>
                        </div>
                        <div class="row modal-reserve-row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label for="rooms" class="label-modal-reserve">Rooms</label>
                                <div class="row">
                                    <div class="col-xs-11 col-md-10" style="padding-right: 0px;">
                                        <select form="room_reserve_mobile" id="room_total_mobile" name="room_total"
                                            class="form-control modal-form-control visitor-input">
                                             <option>1</option>
                                                 <option>2</option>
                                                 <option>3</option>
                                                 <option>4</option>
                                                 <option>5</option>
                                                                                        </select>
                                    </div>
                                </div><br>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label for="extrabed" class="label-modal-reserve">Extra Bed</label>
                                <div class="row">
                                    <div class="col-xs-11 col-md-8" style="padding-right: 0px;">
                                        <select form="room_reserve_mobile" id="extra_bed_mobile" name="extra_bed"
                                            class="form-control modal-form-control visitor-input">
                                             <option>0</option>
                                                 <option>1</option>
                                                 <option>2</option>
                                                 <option>3</option>
                                                 <option>4</option>
                                                 <option>5</option>
                                                                                        </select>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                        <div class="row modal-reserve-row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label for="adults" class="label-modal-reserve">Adults</label>
                                <div class="row">
                                    <div class="col-xs-11 col-md-10" style="padding-right: 0px;">
                                        <select form="room_reserve_mobile" id="adult_total_mobile" name="adult_total"
                                            class="form-control modal-form-control visitor-input">
                                             <option>1</option>
                                                 <option>2</option>
                                                 <option>3</option>
                                                 <option>4</option>
                                                 <option>5</option>
                                                 <option>6</option>
                                                 <option>7</option>
                                                 <option>8</option>
                                                 <option>9</option>
                                                 <option>10</option>
                                                                                        </select>
                                    </div>
                                </div><br>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <label for="children_sum_mobile" class="label-modal-reserve">Children</label>
                                <div class="ri input-spinner">
                                    <button type="button" class="btn btn-horison" data-step="-1" style="height:31px"
                                        onclick="addChild2(-1);">-</button>
                                    <input type="text" form="room_reserve_mobile" name="child_total"
                                        class="form-control size-1 dd-horison" value="0" data-min="0" data-max="10"
                                        style="background-color: inherit" readonly>
                                    <button type="button" class="btn btn-horison" data-step="1" style="height:31px"
                                        onclick="addChild2(1);">+</button>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" id="children_mobile">
                                <input form="room_reserve_mobile" type="hidden" id="child_age_mobile" name="child_age">
                            </div>
                        </div><br><br>

                        <div class="row" align="center" style="margin-left:30px; margin-right:30px;">
                            <input type="button" onclick="submit('room_reserve_mobile');"
                                class="btn btn-block btn-lg btn-horison-visitor" value="Find Rooms"
                                style="font-weight:bold;" />
                        </div>

                    </div>

                    <div class="tab-pane bg-secondary" id="product_mobile">
                        <div class="row modal-reserve-row">
                            <div class="col-md-6">
                                <label for="date_product" class="label-modal-reserve">Date</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group col-md-12">
                                            <input form="product_reserve_mobile" style="background-color: inherit;" type="text"
                                                class="form-control modal-form-control inputbox-datepicker visitor-input bg-secondary"
                                                name="date_product" id="date_product_mobile" placeholder="" readonly
                                                required>
                                            <span class="input-group-addon addon-modal-reserve"><i
                                                    class="entypo-calendar font-primary"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row modal-reserve-row">
                            <div class="col-sm-6 col-md-6">
                                <label for="category_product" class="label-modal-reserve">Package Category</label>
                                <select onchange="set_product(this);"
                                    class="form-control modal-form-control visitor-input">

                                </select><br>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <label for="select_product" class="label-modal-reserve">Select Package</label>
                                <select form="product_reserve_mobile" name="product_list"
                                    class="form-control modal-form-control visitor-input product_list">
                                </select>
                            </div>
                        </div><br><br>
                        <div class="row" align="center" style="margin-left:30px; margin-right:30px;">
                            <input id="validate_click_mobile" type="button" onclick="submit('product_reserve_mobile');"
                                class="btn btn-block btn-lg btn-horison-visitor" value="Reserve Package"
                                style="font-weight:bold;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-container horizontal-menu">

        <header class="navbar navbar-fixed-top shadow" style="">
            <!-- set fixed position by adding class "navbar-fixed-top" -->
            <div class="navbar-inner" style="margin:10px;">

                <!-- logo -->
                <div class="navbar-brand" style="padding-top:5px;">
                    <a href="/">
                        <img src="http://booking-engine.test/images/logo/logo.png" width="170" height="50"
                            alt="Booking Engine" />
                    </a>
                </div>

                <!-- main menu -->

                <ul class="navbar-nav">


                    <li class="active">
                        <a href="http://booking-engine.test/reservation">
                            <span class="title">Room Reservation</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="http://booking-engine.test/package-reservation">
                            <span class="title">Package Reservation</span>
                        </a>
                    </li>

                </ul>
                <ul class="navbar-nav navbar-right visible">
                    <li class="">
                        <a href="http://booking-engine.test/inquiry">
                            <span class="title">Contact Us</span>
                        </a>
                    </li>
                </ul>

                <!-- notifications and other links -->
                <ul class="nav navbar-right">
                    <!-- reserveNow -->

                    <!-- mobile only -->
                    <li class="visible-xs">
                        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                        <div class="horizontal-mobile-menu visible-xs">
                            <a href="#" class="with-animation" style="margin-top:0px;">
                                <!-- add class "with-animation" to support animation -->
                                <i class="entypo-menu"></i>
                            </a>
                        </div>
                    </li>
                </ul>



            </div>
        </header>

        <div class="">


            <div class="col-lg-12">

                <script>
    /* Fungsi formatRupiah */
    function formatRupiah(angka) {

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


<div class="row p-20 resp mt-15 col-12 bg-secondary">
    <div style="width: 74vw; margin: auto;">
        <input type="hidden" id="child_temp" value='[]'>
        <input type="hidden" id="child_list" value='null'>

        <form id="room_reserve" method="GET" action="http://booking-engine.test/reservation"></form>
        <form id="reserve" method="POST" action="http://booking-engine.test/room_reservation">
            <input type="hidden" name="_token" value="g2DqPb0gjJRWiGrZhXxiFyRy00lTqnzmpRXwIG2A">
            <input type="hidden" name="reserve_data" id="reserve_data">
        </form>

        {{-- <div class="row mt-15">
            <div class="col-xs-12 col-lg-10 mt-23" style="margin: auto; padding-bottom: 10px;">
                <p class="text-horison" style="font-size:12px;">Result for <strong> 1 Rooms, 1 Guest,</strong> staying for <strong> 1 Nights </strong> from <strong> 28 November 2022 to 29 November 2022 </strong>
                </p>
            </div>
        </div> --}}



            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                <label for="date_check" class="label-modal-reserve">Check In</label>
                <div class="input-group col-xs-12">
                    <input form="room_reserve" type="text" id="datePickerReserveForm"
                        class="form-control modal-form-control datepicker visitor-input h-32"
                        data-start-date="today" data-format="dd MM yyyy" name="checkin"
                        value="28 November 2022" placeholder="" required>
                    <span class="input-group-addon addon-modal-reserve"><i
                            class="entypo-calendar font-primary"></i></span>
                </div>
            </div>

            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                <label for="date_check" class="label-modal-reserve">Duration Of Stay</label>
                <div class="input-group col-xs-12">
                    <select name="stay_total" form="room_reserve"
                        class="select form-control modal-form-control visitor-input h-32">
                          <option value="1"
                            selected>1 Night</option>
                                                                                     <option value="2">2 Night</option>
                                                                                     <option value="3">3 Night</option>
                                                                                     <option value="4">4 Night</option>
                                                                                     <option value="5">5 Night</option>
                                                                                     <option value="6">6 Night</option>
                                                                                     <option value="7">7 Night</option>
                                                                                     <option value="8">8 Night</option>
                                                                                     <option value="9">9 Night</option>
                                                                                     <option value="10">10 Night</option>
                                                                                     <option value="11">11 Night</option>
                                                                                     <option value="12">12 Night</option>
                                                                                     <option value="13">13 Night</option>
                                                                                     <option value="14">14 Night</option>
                                                                                     <option value="15">15 Night</option>
                                                                            </select>
                    <span class="input-group-addon addon-modal-reserve"><i class="fa fa-moon-o font-primary"></i></span>
                </div>
            </div>

            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                <label for="date_check" class="label-modal-reserve">Rooms</label>
                <div class="input-group col-xs-12">
                    <div class="ri input-spinner">
                        <button type="button" onclick="addRoomTotal(-1);"
                            class="btn btn-horison h-32" data-step="-1">-</button>
                        <input type="number" name="room_total" form="room_reserve"
                            id="room_total" class="form-control size-3-1 dd-horison h-32 moz-view-number"
                            value="1" data-min="1" data-max="5">
                        <button type="button" onclick="addRoomTotal(1);"
                            class="btn btn-horison h-32" data-step="1">+</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                <label for="date_check" class="label-modal-reserve" style="text-align:center;">Adult</label>
                <div class="input-group col-xs-12">
                    <div class="ri input-spinner">
                        <button type="button" class="btn btn-horison h-32"
                            data-step="-1">-</button>
                        <input type="number" form="room_reserve" id="adult_total"
                            name="adult_total" class="form-control size-3-1 dd-horison h-32 moz-view-number"
                            value="1" data-min="1" data-max="10" required>
                        <button type="button" class="btn btn-horison h-32"
                            data-step="1">+</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                <label for="date_check" class="label-modal-reserve" style="text-align:center;">Children</label>
                <div class="input-group col-xs-12">
                    <div class="ri input-spinner">
                        <button type="button" class="btn btn-horison h-32" data-step="-1"
                            onclick="addChildReservation(-1);">-</button>
                        <input type="number" form="room_reserve" id="child_total" name="child_total"
                            name="child_total" class="form-control size-3-1 dd-horison h-32 moz-view-number"
                            value="0" data-min="0" data-max="10">
                        <button type="button" class="btn btn-horison h-32" data-step="1"
                            onclick="addChildReservation(1);">+</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                <label for="date_check" class="label-modal-reserve" style="text-align:center;">Extra Bed</label>
                <div class="input-group col-xs-12">
                    <div class="ri input-spinner">
                        <button type="button" class="btn btn-horison h-32"
                            data-step="-1">-</button>
                        <input type="number" form="room_reserve" id="extra_bed" name="extra_bed"
                            value="0"
                            class="form-control size-3-1 dd-horison h-32 moz-view-number" value="0" data-min="0"
                            data-max="5">
                        <button type="button" class="btn btn-horison h-32"
                            data-step="1">+</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-xs-12">
                <div id="children">
                    <input form="room_reserve" type="hidden" id="child_age" name="child_age">
                </div>
            </div>


            <div class="col-lg-1 col-xs-12" style="text-align: center;">
                <input type="button" onclick="submit('room_reserve');" class="btn btn-horison btn-md" style="padding: 8px 50.5px;margin-bottom: 12px; margin-top: 21px;" value="Search">
            </div>
        </div>
    </div>
</div>
@section('content')

<script>
    /* Fungsi formatRupiah */
    function formatRupiah(angka) {
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

<input id="rooms_data" type="hidden" value='@json($rooms)'>




<!-- Rooms Bg Black -->
<?php $no = 0;$div_rooms = ceil(count($rooms)/2);?>
@foreach($rooms as $room) <?php $no++ ;?>
@php
$font_color = "";
$color = "";
$id = Crypt::encryptString($room->id);
$img = count($room['photo']) > 0 ? $room['photo'][0]->photo_path : "insert-here.jpg";
@endphp
@if ($no - 1 < $div_rooms) <div class="row bg-secondary">
    <div class="container bg-secondary">
        @else
        @php
        $font_color = "-black";
        $color = "";
        @endphp
        <div class="row tblack" style="">
            <div class="container">
                @endif
                <div class="row" style="margin-top:50px; margin-bottom:40px; margi-left:0px;">
                    <div class="col-md-6">
                        @php $i = 0; $total = count($room['photo']) > 3 ? 3 : count($room['photo']); @endphp
                        @foreach($room['photo'] as $photo)@php $i++;@endphp
                        @if($i > 0)
                        <div class="mySlides1 id_{{$no}}">
                            <div class="numbertext">{{$i.'/'.$total}}</div>
                            <img src="{{asset('/user/'.$room['photo'][$i-1]->photo_path)}}"
                                class="uwaw img-rooms-mobile" loading="lazy">
                        </div>
                        @endif
                        @endforeach

                        <div class="bbaris">
                            @php $i = 0; $total = count($room['photo']);
                            if($total == 1)
                            {
                            $class = "hidden";
                            }else{
                            $class="";
                            }@endphp
                            @foreach($room['photo'] as $photo)@php $i++;@endphp
                            @if($i <= 3)
                                <div class="column {{$class}}" style="height:80px!important;">
                                <img class="demo1 id_{{$no}}" src="{{asset('/user/'.$room['photo'][$i-1]->photo_path)}}"
                                    style="width:100% ; heigth:80px!important;" onclick="currentSlide({{$no}}, {{$i}})"
                                    alt="Room" loading="lazy">
                                @if($i == 3)
                                <a href="javascript:;" onclick="seeAll({{$no}});" class="seal2"><b>+ See All</b></a>
                                <img onclick="seeAll({{$no}});" class="bblack2" src="{{asset('/images/blck.jpg')}}"
                                    style="width:100% ; heigth:80px!important;" loading="lazy">
                                @endif
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>
                {{-- <br> --}}

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <h2 class="text-horison{{$font_color}} mr-0 title-rooms" style="text-transform: uppercase;">
                                <strong>{{$room->room_name}}</strong>
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 text-left">
                            <p class="text-horison{{$font_color}} mb-0"><i>2 Person</i></p>
                            <p class="text-horison{{$font_color}} mt-0 mb-0"><i>
                                    @php $i =1; @endphp
                                    @foreach($room['bed'] as $bed)
                                    @php
                                    switch($bed->bed_id){
                                    case "0":
                                    $bed_type = "King";
                                    break;
                                    case "1":
                                    $bed_type = "Queen";
                                    break;
                                    case "2":
                                    $bed_type = "Double";
                                    break;
                                    default:
                                    $bed_type = "No Bed";
                                    break;
                                    }
                                    @endphp
                                    {{$bed_type}} @if($i < count($room['bed'])) {{' / '}}@endif @php $i++; @endphp
                                        @endforeach</i> </p> </div> <div class="col-xs-12 col-md-12" style="margin-top: 20px;">
                                        @if(strlen($room->room_desc) > 100)
                                        <p class="line-clamp-room-3  text-horison{{$font_color}}" style="margin-bottom: 5px;">
                                            {!! strip_tags(substr($room->room_desc, 0, 100)."...") !!}
                                        </p>
                                            <a href="/rooms/{{ $room->room_slug }}" class="text-horison{{$font_color}}" style="font-size:13px;">
                                                <i><u>See more description</u></i>
                                            </a>
                                        @else
                                        <p class="line-clamp-room-3  text-horison{{$font_color}}" style="margin-bottom: 5px;">
                                            {!! strip_tags($room->room_desc) !!}
                                        </p>
                                        @endif
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12 col-xs-12" style="font-size:14px"><br>
                            @if(count($room['amenities']) > 0)
                            @php
                            $path = asset('/icon-pack/').'/';
                            $n = 0;
                            $exp = 1;
                            $other_amenitites ='<ul style="width: 100%;padding: 0;display: flex; flex-wrap: wrap; list-style: none;">
                                ';
                                @endphp
                                <div class="box-amenities">
                                        <ul class="ul-amenities" style="list-style-image:">
                                            @foreach($room['amenities'] as $amenities)@php $n++; @endphp
                                            @if($n <= 6) @if($n==$exp) <li class="col-xs-6 col-md-4 list-amenities-rooms text-horison{{$font_color}}">
                                                @php $exp+= 3; @endphp
                                                @else
                                                <li class="col-xs-6 col-md-4 list-amenities-rooms text-horison{{$font_color}}">
                                                    @endif
                                                    <svg width="17px" height="17px" class="horison-icon">
                                                        {!! file_get_contents($path.$color.$amenities->amenities_name[0]->amenities_icon, false, stream_context_create($arrContextOptions)) !!}
                                                    </svg>
                                                    <p style="margin:0px!important; padding-left: 10px;">{{ $amenities->amenities_name[0]->amenities_name }}</p>
                                                </li>
                                                @else
                                                @php
                                                if($n == $exp){
                                                $other_amenitites.='<li class="col-xs-6 col-md-4 '.$font_color.'"
                                                    style="display: flex; padding-bottom: 10px;">
                                                    ';
                                                    $exp+= 3;
                                                    }
                                                    else{
                                                    $other_amenitites.='
                                                    <li class="col-xs-6 col-md-4 '.$font_color.'"style="display: flex; padding-bottom: 10px; ">';
                                                    }
                                                    $other_amenitites.='<svg width="15px" height="15px" class="horison-icon" style="min-width: 20px;">'.file_get_contents($path.$amenities->amenities_name[0]->amenities_icon, false, stream_context_create($arrContextOptions)).'</svg>'.'<span style="margin-left: 10px">'. $amenities->amenities_name[0]->amenities_name.'</span>
                                                </li>';
                                                @endphp
                                                @endif
                                                @endforeach
                                                @if(count($room['amenities']) > 6)
                                                @php $other_amenitites.='</ul>'; @endphp

                                        <li class="col-xs-12 col-md-4" style="display: flex;"><button
                                                class="btn text-horison{{$font_color}} hovertools"
                                                style="background-color: #fff0; margin-left: -15px;" data-toggle="popover"
                                                data-html="true" data-placement="bottom" data-content='{{$other_amenitites}}'
                                                data-original-title="Other amenities">
                                                + other amenities</button></li>
                                        @endif
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row book-room-row" style="font-size:14px; margin-left: 0px;">
                        <div class="col-md-6 col-xs-12">
                            <span class="text-horison{{$font_color}}"> From<br><strong>
                                @foreach($room['allotment_day'] as $allotment)
                                    <script>
                                        document.write("Rp " + formatRupiah("{{ $allotment->allotment_ro_rate }}"));
                                    </script> /
                                </strong>Night
                                @endforeach
                            </span>
                        </div>
                        <div class="col-md-6 col-xs-12" align="right">
                            <a class="btn btn-horison btn-lg" id=""
                                style="width:135px; margin-top:0px;"><b>Book Now</b></a>
                        </div>
                    </div>
                </div>
            <!-- End Rooms Bg Black -->

        </div>
    </div>
    </div>
    @endforeach
    @include('visitor_site.modal_product')


    <script>
        // data table reservation

        // JS room bg Black //
        var slideIndex = 1;
        var path = "{{asset('/user/')}}";
        var slideIndex3 = 1;
        var first = true;

        var rooms = JSON.parse($('#rooms_data').val());


        for (let n = 1; n <= rooms.length; n++) {
            if (rooms[n - 1]['photo'].length > 0) {
                showSlides(n, 1);
            }
        }

        function currentSlide(id, n) {
            showSlides(id, slideIndex = n);
        }

        function showSlides(id, n) {
            var i;
            var slides = document.getElementsByClassName("mySlides1 id_" + String(id));
            var dots = document.getElementsByClassName("demo1 id_" + String(id));
            // console.log(slides.length);
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
        // End JS room bg Black //

        // Script rotate zoom
        (function ($) {
            var slide = function (ele, options) {
                var $ele = $(ele);
                var setting = {
                    speed: 1000,
                    interval: 3000,

                };
                $.extend(true, setting, options);
                var states = [{
                        $zIndex: 1,
                        width: 225,
                        height: 150,
                        top: 69,
                        left: 134,
                        $opacity: 0.2
                    },
                    {
                        $zIndex: 3,
                        width: 450,
                        height: 300.12,
                        top: 35,
                        left: -35,
                        $opacity: 0.7
                    },
                    {
                        $zIndex: 1,
                        width: 225,
                        height: 150,
                        top: 90,
                        left: 300,
                        $opacity: 0.2
                    }
                ];

                var $lis = $ele.find('li');
                var timer = null;

                $ele.find('.btnssl').on('click', function () {
                    next();
                });
                $ele.find('.btnssr').on('click', function () {
                    states.push(states.shift());
                    move();
                });
                $ele.on('mouseenter', function () {
                    clearInterval(timer);
                    timer = null;
                }).on('mouseleave', function () {
                    autoPlay();
                });

                move();
                autoPlay();

                function move() {
                    $lis.each(function (index, element) {
                        var state = states[index];
                        $(element).css('zIndex', state.$zIndex).finish().animate(state, setting.speed).find('img').css('opacity', state.$opacity);
                    });
                }

                function next() {
                    states.unshift(states.pop());
                    move();
                }

                function autoPlay() {
                    timer = setInterval(next, setting.interval);
                }
            }
            $.fn.hiSlide = function (options) {
                $(this).each(function (index, ele) {
                    slide(ele, options);
                });
                return this;
            }
        })(jQuery);

        $('.slide').hiSlide();


        function seeAll(id) {
            var room = rooms[id - 1];
            var slider_for = "";
            var slider_nav = "";

            $('#modal_title').text(room.room_name);

            room['photo'].forEach(function (data, index) {

                index++;
                slider_for += '<div align="center"><img loading="lazy" class="gltop" src="' + path + "/" + data.photo_path +'"></div>';
                slider_nav += '<div class="sub-seeall">'+
                '<div align="center"><img loading="lazy" class="imgslide-seeall" src="' + path + "/" + data.photo_path +'"></div>'+
                '</div>';
            });

            $('#seeAllModal').modal('show');
            $('.slider-for').empty();
            $('.slider-nav').empty();

            $('.slider-for').append(slider_for);
            $('.slider-nav').append(slider_nav);

            do_slider();

            $('#seeAllModal').on('hidden.bs.modal', function () {
                $('.slider-for').slick('unslick');
                $('.slider-nav').slick('unslick');
                // console.log('clear unslick');
            })
        }

    </script>


    @endsection
