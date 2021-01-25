<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Enjoy your experience at Horison Ultima with Bandung View while traveling in Bandung">
    <meta name="keywords" content="Horison, Ultima, Banudng, Hotel">
    <meta name="author" content="Horison Ultima Bandung">
    <title>{{ $setting->title }}</title>
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

    @yield('script')

</head>


<body class="page-body" data-url="">

    <div class="lds-dual-ring"></div>

    <!-- form reserve -->
    <div id="form_reserve">
        <div id="formReserve" class="panel minimal-custom minimal-gray" style="display: none">
            <form id="room_reserve" method="GET" action="{{ route('visitor.reservation') }}"></form>
            <form id="product_reserve" method="POST" action="{{ route('visitor.product_reservation') }}">
                {{ csrf_field() }}</form>
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
                                        @for ($i = 1; $i <= 15; $i++) <option value="{{$i}}">{{$i}} Night</option>
                                            @endfor
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
                                    <option value="0">Recreation</option>
                                    <option value="1">Spa & Salon</option>
                                    <option value="2">Mice</option>
                                    <option value="3">Wedding</option>
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
                            <input type="button" onclick="submit('product_reserve');"
                                class="btn btn-block btn-lg btn-horison-visitor" value="Reserve Package"
                                style="font-weight:bold;" />
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- form reserve mobile --}}
    <div id="form_reserve_mobile">
        <div id="formReservemobile" class="panel minimal-custom minimal-gray" style="display: none; bottom: 12px; width: 100%;">
            <form id="room_reserve_mobile" method="GET" action="{{ route('visitor.reservation') }}"></form>
            <form id="product_reserve_mobile" method="POST" action="{{ route('visitor.product_reservation') }}">
                {{ csrf_field() }}</form>
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
                                        @for ($i = 1; $i <= 15; $i++) <option value="{{$i}}">{{$i}} Night</option>
                                            @endfor
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
                                            @for ($i = 1; $i <= 5; $i++) <option>{{$i}}</option>
                                                @endfor
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
                                            @for ($i = 0; $i <= 5; $i++) <option>{{$i}}</option>
                                                @endfor
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
                                            @for ($i = 1; $i <= 10; $i++) <option>{{$i}}</option>
                                                @endfor
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
                                    <option value="0">Recreation</option>
                                    <option value="1">Spa & Salon</option>
                                    <option value="2">Mice</option>
                                    <option value="3">Wedding</option>
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
                            <input type="button" onclick="submit('product_reserve_mobile');"
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
                        <img src="{{ asset('images/logo/' . $setting->logo) }}" alt="tirtasanitaresort" style="max-height: 50px;"/>
                    </a>
                </div>
                <!-- main menu -->
                <ul class="navbar-nav">
                    <li class="{{ Request::path() === 'visitor/rooms' ? 'active':'' }}">
                        <a href="{{ route('visitor.room') }}">
                            <span class="title">{{ $menu['room'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'visitor/recreation' ? 'active':'' }}">
                        <a href="{{ route('visitor.recreation') }}">
                            <span class="title">{{ $menu['recreation'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'visitor/allysea_spa' ? 'active':'' }}">
                        <a href="{{ route('visitor.allysea_spa') }}">
                            <span class="title">{{ $menu['spa'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'visitor/mice' ? 'active':'' }}">
                        <a href="{{ route('visitor.mice_wedding') }}">
                            <span class="title">{{ $menu['mice'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'visitor/wedding' ? 'active':'' }}">
                        <a href="{{ route('visitor.wedding') }}">
                            <span class="title">{{ $menu['wedding'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'visitor/function_room' ? 'active':'' }}">
                        <a href="{{ route('visitor.function_room') }}">
                            <span class="title">{{ $menu['functionroom'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'visitor/newsletter' ? 'active':'' }}">
                        <a href="{{ route('visitor.newsletter') }}">
                            <span class="title">{{ $menu['newsletter'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'visitor/inquiry' ? 'active':'' }}">
                        <a href="{{ route('inquiry.index') }}">
                            <span class="title">{{ $menu['contact'][0]['page_name'] }}</span>
                        </a>
                    </li>
                </ul>

                <!-- notifications and other links -->
                <ul class="nav navbar-right">
                    <!-- reserveNow -->
                    <button id="reserveNow" class="btn btn-lg btn-horison-visitor navbar-button2 reserveNow"><b>Book Now</b></button>
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

        <div>
            @if(isset($errors))
            @if (count($errors) > 0)
            <div class="alert alert-dismissible alert-danger" style="text-align:center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
            @endif
            @if (session('status'))
            <script>
                $(document).ready(function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: " {{ session('status') }}"
                    })
                });

            </script>
            @endif
            @if (session('warning'))
            <script>
                $(document).ready(function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: "{{ session('warning') }}"
                    })
                });

            </script>
            @endif

            <div class="col-lg-12">

                @yield('content')

                <footer>
                    <div class="row footer-bg-color">
                        <div class="container footer-bg-height">
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
                            <div class="col-xs-12 col-lg-12" style="text-align: center;">
                                <h4>
                                    <small class="font-primary copyright-footer">Copyright &copy; 2020 <strong>Tripasyfo Development</strong>. All rights reserved.</small>
                                </h4>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <button type="button" id="reserveNowmobile" class="btn btn-booknow-gold btn-block reserveNowmobile"
                    style="height: 40px;">
                    <b>Book Now</b>
                </button>
            </div>
        </div>

    </div>

    @include('visitor_site.landing_page.reserve_modal')

    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/reserve-popover.js') }}"></script>
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>
    <script src="{{ asset('js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.min.js') }}"></script>
    <script src="{{ asset('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('js/neon-custom.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('js/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/fileinput.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/uikit/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/addons/css/markdownarea.css') }}">
    <script src="{{ asset('js/uikit/js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/marked.js') }}"></script>
    <script src="{{ asset('js/uikit/addons/js/markdownarea.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/minimal/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/square/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/flat/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/futurico/futurico.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/polaris/polaris.css') }}">
    <script src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/rickshaw/rickshaw.min.css') }}">
    <script src="{{ asset('js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/neon-demo.js') }}"></script>
    <script src="{{ asset('js/jquery number/jquery.number.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var room_picker = new Litepicker({
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
            });
            var room_picker_mobile = new Litepicker({
                firstDay: 1,
                format: "DD MMMM YYYY",
                lang: 'en-US',
                numberOfMonths: 1,
                numberOfColumns: 1,
                minDate: moment(new Date()).format("DD MMMM YYYY"),
                autoApply: true,
                showTooltip: true,
                singleMode: true,
                element: document.getElementById('datePickerMobile'),
            });


            var product_picker = new Litepicker({
                firstDay: 1,
                format: "DD MMMM YYYY",
                lang: 'en-US',
                numberOfMonths: 1,
                numberOfColumns: 1,
                minDate: moment(new Date()).format("DD MMMM YYYY"),
                autoApply: true,
                singleMode: true,
                element: document.getElementById('date_product'),
            });
            var product_picker_mobile = new Litepicker({
                firstDay: 1,
                format: "DD MMMM YYYY",
                lang: 'en-US',
                numberOfMonths: 1,
                numberOfColumns: 1,
                minDate: moment(new Date()).format("DD MMMM YYYY"),
                autoApply: true,
                singleMode: true,
                element: document.getElementById('date_product_mobile'),
            });

            //set datepicker value
            room_picker.setDate(new Date());
            room_picker_mobile.setDate(new Date());
            product_picker.setDate(new Date());
            product_picker_mobile.setDate(new Date());

        });

        $(function () {
            $(".numbers").number(true, 0);

        });

        $('.numberValidation').keyup(function () {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });
        $('.thousandSeperator').keyup(function () {
            var cek = parseInt(this.value);
            if (isNaN(cek)) {
                this.value = "";
            } else {
                var hiddenInput = document.getElementById(this.id + "_input");
                hiddenInput.value = hiddenInput.value.replace(/[^0-9]*/g, '');
                hiddenInput.value = this.value.match(/\d/g).join("");
                this.value = formatRibuanTyping(this, this.value);
            }
        });

        /* Fungsi formatRupiah */
        function formatRibuanTyping(rupiah, angka, prefix) {
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
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        }
        //END

        var total_room = 1;
        var totalChild = 0;
        var totalChild2 = 0;

        function addRoomTotal(n = 0) {

            total_room += n;

            if (total_room <= 0) {
                total_room = 1;
            } else if (total_room > 5) {
                total_room = 5;
            }

            if (n == 0) {
                total_room = parseInt($('#room_total').val());
            }
        }

        function submit(form) {
            var cek = true;

            if (form == 'room_reserve' || form == "room_reserve_mobile") {
                if (form == "room_reserve") {
                    var extra_bed = parseInt($('#extra_bed').val());
                    var adult_total = parseInt($('#adult_total').val());
                    var child_total = parseInt(totalChild);
                } else if (form == "room_reserve_mobile") {
                    var extra_bed = parseInt($('#extra_bed_mobile').val());
                    var adult_total = parseInt($('#adult_total_mobile').val());
                    var child_total = parseInt(totalChild2);
                    total_room = $('#room_total_mobile').val();
                }

                var adult_child_total = adult_total + child_total;

                var max_adult_child = total_room * 5 + extra_bed;
                var need_extrabed = total_room * 2 + 1;

                //validation adult
                var max_adult = total_room * 2 + total_room;
                var min_adult = total_room;

                //validation child
                var min_child = 0;
                var max_child = total_room * 2;

                //validation extra bed
                var min_extrabed = Math.floor(adult_total / (total_room + 1));
                var max_extrabed = total_room;
                var check_extrabed = false;
                var max_child = total_room;
                var msg = [];

                if (extra_bed > max_extrabed) {
                    msg.push("Extrabed capacity exceeded, each room only allow 1 extra bed");
                    check_extrabed = true;
                    cek = false;
                }

                if (adult_total < min_adult) {
                    msg.push("Minimal adult is not reached, each room must have minimal 1 adult");
                    cek = false;
                }
                if (adult_total > max_adult) {
                    msg.push("Room capacity exceeded, add more room");
                    cek = false;
                }
                if (adult_total >= need_extrabed && extra_bed < min_extrabed) {
                    msg.push("Room capacity exceeded, add more room or extrabed");
                    cek = false;
                }
                if (adult_child_total > (max_adult_child)) {
                    if (check_extrabed) {
                        msg.push("Room capacity exceeded, room have maximal of 2 child(s) ");
                    } else {
                        msg.push("Room capacity exceeded, room have maximal of 2 child(s) ");
                    }
                    cek = false;
                }

                if (cek) {
                    var child_age = [];
                    if (form == "room_reserve") {
                        var childs = document.getElementsByClassName('child_age');
                    } else if (form == "room_reserve_mobile") {
                        var childs = document.getElementsByClassName('child_age_mobile');
                    }

                    if (childs != null) {
                        for (let i = 0; i < childs.length; i++) {
                            const element = childs[i];
                            child_age.push(element.value);
                        }
                    }
                    if (form == "room_reserve") {
                        $('#child_age').val(child_age.toString());
                    } else if (form == "room_reserve_mobile") {
                        $('#child_age_mobile').val(child_age.toString());
                    }

                    $('#' + form).submit();

                } else {

                    var message = '';
                    var first = true;
                    msg.forEach(element => {
                        if (first) {
                            message += "<li align='left'>" + element + "</li>";
                            first = false;
                        } else {
                            message += "<li align='left'>" + element + "</li>";
                        }
                    });
                    Swal.fire({
                        icon: 'warning',
                        title: 'Your Request below not following our policy :',
                        html: message
                    });
                }
            } else {

                $('#' + form).submit();
            }
        }

        function addChild(n) {

            var html = "";
            var next = totalChild + n;
            if (totalChild == 0 && n == -1) {

            } else if ((totalChild + n) > 10) {
                alert('Maximal 10 Child!');
            } else if (totalChild > next) {

                $('#age_' + String(totalChild)).fadeOut(300, function () {
                    $(this).remove();
                });
                totalChild += n;
            } else {

                totalChild += n;
                var html = '<div class="col-md-3 mt-10" id="age_' + totalChild + '">' +
                    '<label for="date_check" class="label-modal-reserve">Age</label>' +
                    '<div class="row">' +
                    '<div class="col-md-8" style="padding-left: 0px; padding-right: 0px;">' +
                    '<select class="form-control modal-form-control visitor-input child_age" style="width:75px;">' +
                    '@for ($i = 0; $i <= 6; $i++)' +
                    '@if ($i == 0)' +
                    '<option value="{{$i}}"> < 1 </option>' +
                    '@else' +
                    '<option value="{{$i}}"> {{$i}} </option>' +
                    '@endif' +
                    '@endfor' +
                    '</select></div></div></div>';
                $(html).hide().appendTo('#children').fadeIn(300);
            }
        }

        // script tampilan child (mobile)
        function addChild2(n) {

            var html = "";
            var next = totalChild2 + n;
            if (totalChild2 == 0 && n == -1) {

            } else if ((totalChild2 + n) > 10) {
                alert('Maximal 10 Child!');
            } else if (totalChild2 > next) {

                $('#age_' + String(totalChild2)).fadeOut(300, function () {
                    $(this).remove();
                });
                totalChild2 += n;
            } else {

                totalChild2 += n;
                var html = '<div class="col-xs-3 col-sm-4 col-md-3 mt-10" id="age_' + totalChild2 + '">' +
                    '<label for="date_check" class="label-modal-reserve">Age</label>' +
                    '<div class="row">' +
                    '<div class="col-xs-8 col-xs-8" style="padding-left: 0px; padding-right: 0px;">' +
                    '<select class="form-control modal-form-control visitor-input child_age_mobile" style="width:75px;">' +
                    '@for ($i = 0; $i <= 6; $i++)' +
                    '@if ($i == 0)' +
                    '<option value="{{$i}}"> < 1 </option>' +
                    '@else' +
                    '<option value="{{$i}}"> {{$i}} </option>' +
                    '@endif' +
                    '@endfor' +
                    '</select></div></div></div>';
                $(html).hide().appendTo('#children_mobile').fadeIn(300);
            }
        }

        var product_data = $.ajax({
            type: 'GET',
            url: "{{route('visitor.get_product')}}",
            async: false,
            dataType: 'json',
            done: function (results) {

                JSON.parse(results);
                return results;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON;

        set_product();

        function set_product(e = false) {
            if (!e) {
                var index = 0;
            } else {
                var index = e.value;

            }
            $('.product_list').empty();
            product_data[index]['product'].forEach(element => {
                optionText = element.product_name;
                optionValue = element.id;

                $('.product_list').append(`<option value="${optionValue}">
                                            ${optionText}
                                        </option>`);

            });
        }

    </script>
    <script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
</body>
</html>
