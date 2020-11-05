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

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

    <script type="text/javascript">
        var home_url = "{{url('/')}}";

    </script>

</head>
<body>
    <div class="col-lg-12">
        <div class="row">
            <div class="container">

        <form id="rootwizard-2" method="post" action="" class="form-wizard validate">
        <header class="navbar navbar-fixed-top shadow" style="padding-bottom:70px;">
            <!-- set fixed position by adding class "navbar-fixed-top" -->
            <div class="navbar-inner" >

                <!-- logo -->
                <div class="navbar-brand">
                    <a href="/">
                        <img class="mt-20" src="{{asset('/images/sidebar.png')}}" width="170" alt="" />
                    </a>
                </div>



            </div>
        </header>



                    <div class="steps-progress">
                        <div class="progress-indicator"></div>
                    </div>

                    <ul >
                        <li>
                            <a href="#tab2-1" data-toggle="tab"><span>1</span>Customer Information</a>
                        </li>
                        <li>
                            <a href="#tab2-2" data-toggle="tab"><span>2</span>Payment Information</a>
                        </li>
                        <li>
                            <a href="#tab2-3" data-toggle="tab"><span>3</span>Booking Confirmed!</a>
                        </li>
                    </ul>


                <div class="tab-content mt-35">
                    <div class="tab-pane" id="tab2-1">

                            <div class="col-md-8">
                                <div class="gallery-env">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <article class="album" style="">
                                                <section class="album-info-inq shadow"
                                                    style="border:1px solid #D4B580;">
                                                    {{-- MAIN FORM --}}
                                                    <br>
                                                    <h4><b>Personal Information</b></h4>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label" for="full_name"
                                                                    style="font-size:12px; font-weight:normal;">Full
                                                                    Name</label>
                                                                <input class="form-control"
                                                                type="text"
                                                                class="form-control visitor-input"
                                                                id=""
                                                                name="full_name"
                                                                value=""
                                                                required
                                                                placeholder="Please Type Your Full Name"><br>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label" for=""
                                                                    style="font-size:12px; font-weight:normal;">Identification
                                                                    Card</label>
                                                                <select name="test" class="select2"
                                                                    placeholder="KTP">
                                                                    <option value="1">Identification Card</option>
                                                                    <option value="2">Driver License</option>
                                                                    <option value="3">Passport</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label" for="number"
                                                                    style="font-size:12px; font-weight:normal;">Identification
                                                                    Number</label>
                                                                <input class="form-control" type="text"
                                                                    required
                                                                    class="form-control visitor-input" id=""
                                                                    name="number" value=""
                                                                    placeholder="Ex : 321815648126132">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label" for="email"
                                                                    style="font-size:12px; font-weight:normal;">Email</label>
                                                                <input class="form-control"
                                                                      required
                                                                      type="text"
                                                                      class="form-control visitor-input"
                                                                       id="" name="email" value=""
                                                                      placeholder="Please Enter Your Email Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label" for="phone"
                                                                    style="font-size:12px; font-weight:normal;">Number</label>
                                                                <input class="form-control" type="text"
                                                                    required
                                                                    class="form-control visitor-input" onkeypress="return hanyaAngka(event)"
                                                                    name="number" value=""
                                                                    placeholder="Number Include Country Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12"
                                                            style="margin-top:-30px; margin-bottom:10px;">
                                                            <p style="font-size:10px;">*Reservation Details and
                                                                Reservation Voucher will
                                                                be sent by Email provided</p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <i class="fa fa-square"> Booking for others</i><br><br>
                                                        </div>
                                                        <div class="col-md-12" style="padding-left:34px;">
                                                            <label class="control-label" for="full_name" focus="true"
                                                                style="font-size:12px; font-weight:normal;">Full
                                                                Name</label>
                                                            <input class="form-control" type="text"
                                                                 aria-required="true"
                                                                class="form-control visitor-input" id=""
                                                                name="full_name" value=""
                                                                placeholder="Please Type Your Full Name"><br>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <h4><strong>Product Details</strong></h4>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label style="font-size:12px; font-weight:normal;" for=""
                                                                class="control-label">Product Reservation Date
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group required">
                                                                <span class="input-group-addon custgroup"
                                                                    style="background-color:white;"><i
                                                                        class="entypo-calendar"
                                                                        style="color:black;"></i></span>
                                                                <input id="datePickerReserveForm"
                                                                    required
                                                                    type="text"
                                                                    class="form-control  datepicker "
                                                                    style="background-color:white;" value=""
                                                                    data-format="D, dd MM yyyy" name="checkin"
                                                                    placeholder="" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group minimal">
                                                                <div class="input-group-addon custgroup">
                                                                    <i class="fa fa-clock-o" style="color:black;"></i>
                                                                </div>
                                                                <input type="text"
                                                                    required
                                                                    style="color:black; width:30%;"
                                                                    class="form-control timepicker" />
                                                            </div><br>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label style="font-size:12px; font-weight:normal;"> Jumlah
                                                                Pemesan</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="input-group minimal">
                                                                <div class="input-group-addon custgroup">
                                                                    <i class="fa fa-user" style="color:black;"></i>
                                                                </div>
                                                                <input type="number" style="color:black;"
                                                                    class="form-control" />
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
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4><strong>Additional Request</strong></h4>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control autogrow visitor-input"
                                                                cols="1" rows="7"
                                                                placeholder="Kasur twin bed, dekat kolam renang, etc"></textarea><br>
                                                        </div>
                                                    </div>

                                                    <ul class="pager wizard">
                                                        <li class="next">
                                                            <a class="btn btn-payment"  href="#">CHOOSE PAYMENT METHOD </a>
                                                        </li>
                                                    </ul>

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

                                                    {{-- MAIN FORM --}}
                                                    <h4><b>Reservation Details</b></h4>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <i class="fa fa-calendar-o"></i>
                                                            <label style="font-weight:normal" for="">&nbsp; 22 Agustus 2020 / 08:30 AM</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <i class="fa fa-shopping-cart"></i>
                                                            <label style="font-weight:normal" for="">&nbsp; Massage at Allysea A Spa</label>
                                                        </div>
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

                                                <section class="album-info-inq shadow"
                                                    style="border:1px solid #D4B580;">

                                                    {{-- MAIN FORM --}}
                                                    <h4><b>Price Details</b></h4>

                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p style="font-size:14px; color:black;">5 x Massage at
                                                                Allysea A Spa</p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <p style="font-size:14px text-align:right;"><strong> Rp
                                                                    700,000 </strong>
                                                            </p>
                                                        </div>
                                                    </div>


                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p style="font-size:14px">Total</p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <p style="font-size:14px text-align:right;"><strong> Rp
                                                                    700,000 </strong>
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
                    <div class="tab-pane active" id="tab2-2">


                            <div class="col-md-8">
                                <!-- form reserve -->
                                <div class="gallery-env">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <article class="album">
                                                <section class="album-info-inq shadow"
                                                    style="border: 1px solid #D4B580;">
                                                    <div id="form_payment">
                                                        <form id="formReserve" class="panel minimal-custom minimal-gray"
                                                            style="display: none" action="">
                                                            {{csrf_field()}}

                                                            <ul class="nav nav-tabs bordered">
                                                                <!-- available classes "bordered", "right-aligned" -->
                                                                <li class="active">
                                                                    <a href="#credit" data-toggle="tab" style="background-color:#333; border:1px solid #333;">
                                                                        <span ><i
                                                                                class="fa fa-credit-card" style="color:#D4B580;"></i></span>
                                                                        <span class="hidden-xs" style="color:#D4B580;">Credit Card</span>
                                                                    </a>
                                                                </li>
                                                                <li style="background-color: white">
                                                                    <a href="#bank" data-toggle="tab">
                                                                        <span><i class="fa fa-archive"></i></span>
                                                                        <span class="hidden-xs">Bank Transfer</span>
                                                                    </a>
                                                                </li>
                                                            </ul>

                                                            <div class="tab-content credittab" >
                                                                <div class="tab-pane active tab-horison-credit" id="credit" >
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="control-label text-horison"
                                                                                    for="full_name"
                                                                                    style="font-size:12px; font-weight:bold;">Credit
                                                                                    Card</label>
                                                                                <select name="" id="" class="form-control">
                                                                                    <option value="Mandiri">Mandiri</option>
                                                                                    <option value="BNI">BNI</option>
                                                                                    <option value="BCA">BCA</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="control-label text-horison"
                                                                                    for="full_name"
                                                                                    style="font-size:12px; font-weight:bold;">Card
                                                                                    Number</label>
                                                                                <input class="form-control" type="text"
                                                                                    class="form-control visitor-input"
                                                                                    required
                                                                                     id=""
                                                                                    name="" value=""
                                                                                    placeholder="3 Digit Kode CVV">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="control-label text-horison"
                                                                                    for="full_name"
                                                                                    style="font-size:12px; font-weight:bold;">Expiry
                                                                                    Date</label>
                                                                                <input class="form-control" type="date"
                                                                                    class="form-control visitor-input"

                                                                                     id=""
                                                                                    name="" value=""
                                                                                    placeholder="Ex : 13216547216514651">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="control-label text-horison"
                                                                                    for="full_name"
                                                                                    style="font-size:12px; font-weight:bold;">CVV
                                                                                    Code</label>
                                                                                <input class="form-control"
                                                                                    type="number" maxlength="3"
                                                                                    class="form-control visitor-input"

                                                                                     id=""
                                                                                    name="" value=""
                                                                                    placeholder="Ex : 13216547216514651"><br>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                            <ul class="form-group">
                                                                                <li class="text-horison">Confirm OTP to
                                                                                    make Payment</li>
                                                                                <li class="text-horison">Complete
                                                                                    payment within 30 minutes</li>
                                                                            </ul>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6" >
                                                                            <p style="color:#D4B580">By proceeding, I agree to Horison Terms of Use and Privacy Policy</p>
                                                                        </div>
                                                                        <<div class="col-md-6" align="right">
                                                                            <ul class="pager wizard">
                                                                                <li class="next">
                                                                                    <a class="btn" style="background-color:#D4B580; color:white" href="#">CONFIRM PAYMENT<i class="entypo-right-open"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                    </div>
                                                                    </div>

                                                                </div>


                                                                <div class="tab-pane tab-horison-bank" id="bank">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="control-label"
                                                                                    for="full_name"
                                                                                    style="font-size:12px; font-weight:bold;">Choose Bank</label>
                                                                                <select name="" id="" class="form-control">
                                                                                    <option value="Mandiri">Mandiri</option>
                                                                                    <option value="BNI">BNI</option>
                                                                                    <option value="BCA">BCA</option>
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
                                                                                    payment within 30 minutes</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row pdrl-20">
                                                                        <div class="col-md-6">
                                                                            <p style="text-align:left;">By proceeding, I agree to Horison Terms of Use and Privacy Policy</p>
                                                                        </div>

                                                                        <div class="col-md-6" align="right">
                                                                            <ul class="pager wizard">
                                                                                <li class="next">
                                                                                    <a class="btn" style="background-color:#D4B580; color:white" href="#">CONFIRM PAYMENT<i class="entypo-right-open"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                    </div>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="panel-footer mtm-20">
                                                                <div class="row mt-0">
                                                                    <p class="pl-30"> We’ll send your payment details to
                                                                        customer@mail.com</p>
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
                                {{-- Bill Reservation details --}}
                                <div class="gallery-env">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <article class="album" style="">
                                                <section class="album-info-inq shadow"
                                                    style="border:1px solid #D4B580;">
                                                    {{-- MAIN FORM --}}
                                                    <h4><b>Reservation Details</b></h4>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <i class="fa fa-calendar-o"></i>
                                                            <label style="font-weight:normal" for="">&nbsp; 22 Agustus 2020 / 08:30 AM</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <i class="fa fa-shopping-cart"></i>
                                                            <label style="font-weight:normal" for="">&nbsp; Massage at Allysea A Spa</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <i class="fa fa-users"></i>
                                                            <label style="font-weight:normal" for="">&nbsp; 2 Dewasa & 1 Anak</label>
                                                        </div>
                                                    </div>
                                                </section>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                                {{-- end bill reservation details --}}

                                {{-- bill price details --}}
                                <div class="gallery-env">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <article class="album" style="">
                                                <section class="album-info-inq shadow"
                                                    style="border:1px solid #D4B580;">
                                                    {{-- MAIN FORM --}}
                                                    <h4><b>Price Details</b></h4>
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p style="font-size:12px; color:black;">2 Rooms x 3 Nights
                                                            </p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <p style="font-size:14px text-align:right;"><strong> Rp
                                                                    6,800,000 </strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p style="font-size:14px">Additional Extra Bed</p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <p style="font-size:14px text-align:right;"><strong> Rp
                                                                    6,800,000 </strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <p style="font-size:14px">Total</p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <p style="font-size:14px text-align:right;"><strong> Rp
                                                                    6,800,000 </strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </section>
                                            </article>
                                        </div>
                                    </div>
                                </div>

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
                                                            <label for=""><strong>Your Booking 231315498448 has been placed!</strong></label>
                                                            <ul>
                                                                <li>You will receive your booking details at CustomerEmail@mail.com</li>
                                                                <li>You will receive your Voucher after you have made your payment</li>
                                                                <li>Please finish this transaction before 13 January 2020 13:20</li>
                                                                <li>You will receive a confirmation email as soon this transaction has been approved</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row" style="margin-top:30px">
                                                    <div class="col-md-12">
                                                        <label for=""><strong>Transfer to:</strong></label><br><br>
                                                        <div class="form-group" style="padding:20px; border:1px solid #BDBDBD;">
                                                            <div class="row" style="padding:20px;">
                                                                    <img style="width:15%" src="{{asset('/images/bca.png')}}" alt="">
                                                             </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Bank Central Asia (BCA)</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                   <p>Account Number</p>
                                                                </div>
                                                                <div class="col-md-8">
                                                                   <p style="color:black"><strong>08xxxxxxxxx</strong></p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <p>Account Holder</p>
                                                                 </div>
                                                                 <div class="col-md-8" align="left">
                                                                    <p  style="color:black" for=""><strong>PT Horison Tirta</strong></p>
                                                                 </div>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="col-md-4">
                                                                    <p>Payment Method</p>
                                                                 </div>
                                                                 <div class="col-md-8" align="left">
                                                                     <p  style="color:black" for=""><strong>BCA Virtual Account</strong></p>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row" style="margin-top:-20px;">
                                                                 <div class="col-md-4">
                                                                    <p>Transfer Amount</p>
                                                                 </div>
                                                                 <div class="col-md-8" align="left">
                                                                    <p  style="color:black" for=""><strong>Rp 250.000</strong></p>
                                                                 </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-top:30px">
                                                    <div class="col-md-12">
                                                        <label for=""><strong>Before:</strong></label><br><br>
                                                        <div class="form-group" style="padding:20px; border:1px solid #BDBDBD;">
                                                            <div class="row">
                                                                 <div class="col-md-12">
                                                                     <label for="">Today, 13 January 2020</label>
                                                                 </div>
                                                                 <div class="col-md-12">
                                                                    <label for="">12 : 00 PM</label>
                                                                </div>
                                                            </div>

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
                                                                <label style="font-weight:normal" for="">&nbsp; dolores.chambers@example.com</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="col-md-12">
                                                                <label for="">Customer Service</label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <i class="fa fa-phone"></i>
                                                                <label style="font-weight:normal" for="">&nbsp; (270) 555-0117</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                        </article>
                                        <div class="panel-footer footer-payment">
                                            <div class="form-group" style="background-color:#F2F2F2">
                                                <div class="row" >
                                                    <div class="col-md-6" align="right">
                                                        <a href=""><p style="padding: 10px;font-size: 12px!important; font-weight: 600;"> Back To Home</p></a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="" class="btn btn-horison-dark">Reserve another Rooms</a>
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

                                            <section class="album-info-inq shadow"
                                                style="border:1px solid #D4B580;">

                                                <div class="row" style="margin-top:-30px;">
                                                    <div class="col-md-12">
                                                        <p><strong>Booking ID</strong></p>
                                                    </div>
                                                    <div class="col-md-12 mt-10">
                                                        <label for="">231315498448</label>
                                                    </div>

                                                    <div class="col-md-12">
                                                       <p><strong>Reserve By</strong></p>
                                                    </div>
                                                    <div class="col-md-12 mt-10">
                                                       <label for="">Norma Steward</label>
                                                    </div>
                                                </div>
                                                <hr><br>
                                                {{-- MAIN FORM --}}
                                                <h4><b>Booking Details</b></h4>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <i class="fa fa-calendar-o"></i>
                                                        <label style="font-weight:normal" for="">&nbsp; 22 Agustus 2020 / 08:30 AM</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <i class="fa fa-shopping-cart"></i>
                                                        <label style="font-weight:normal" for="">&nbsp; Massage at Allysea A Spa</label>
                                                    </div>
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

                                            <section class="album-info-inq shadow"
                                                style="border:1px solid #D4B580;">

                                                {{-- MAIN FORM --}}
                                                <h4><b>Price Details</b></h4>

                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p style="font-size:14px; color:black;">5 x Massage at
                                                            Allysea A Spa</p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <p style="font-size:14px text-align:right;"><strong> Rp
                                                                700,000 </strong>
                                                        </p>
                                                    </div>
                                                </div>


                                                <hr>

                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <p style="font-size:14px">Total</p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <p style="font-size:14px text-align:right;"><strong> Rp
                                                                700,000 </strong>
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

                </div>

            </form>
        </div>
    </div>



            <footer>
                <div class="row" style="background-color:#333333;">
                    <div class="container" style="background-color:#333333; height:185px;">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 footer-logo">
                            <img src="{{asset('/images/sidebar.png')}}" width="200" alt=""
                                style="margin-top:55px;" />
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





    {{-- input type number --}}
    <script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))

		    return false;
		  return true;
		}
	</script>
    {{-- End input type number only --}}

    <link rel="stylesheet" href="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/rickshaw/rickshaw.min.css') }}">
    <script src="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>

    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/reserve-popover.js') }}"></script>

    <script src="{{ asset('js/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('js/neon-calendar.js') }}"></script>
    {{-- <script src="{{asset('assets/js/neon-charts.js') }}"></script> --}}

    <script src="{{ asset('js/jvectormap/jquery-jvectormap-europe-merc-en.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/rickshaw/vendor/d3.v3.js') }}"></script>
    <script src="{{ asset('js/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('js/raphael-min.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>

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
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
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
    <link rel="stylesheet" href="{{ asset('js/selectboxit/jquery.selectBoxIt.css') }}">

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/joinable.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>
    <script src="{{ asset('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>


    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('js/fileinput.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>

    {{-- <!-- JavaScripts initializations and stuff -->
	<script src="{{ asset('js/neon-custom.js') }}"></script> --}}


    <!-- Text Editor CKEditor -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/wysihtml5/bootstrap-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{ asset('js/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/css/uikit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/addons/css/markdownarea.css') }}">

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/joinable.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>
    <script src="{{ asset('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>


    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('js/uikit/js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('js/marked.js') }}"></script>
    <script src="{{ asset('js/uikit/addons/js/markdownarea.min.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/markdown/markdown.js') }}"></script>
    <script src="{{ asset('js/codemirror/addon/mode/overlay.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/gfm/gfm.js') }}"></script>
    <script src="{{ asset('js/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>



    <!-- Advanced Plugins -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/selectboxit/jquery.selectBoxIt.css') }}">
    <link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/minimal/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/square/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/flat/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/futurico/futurico.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/polaris/polaris.css') }}">

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/joinable.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>

    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.min.js') }}"></script>
    <script src="{{ asset('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('js/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>



    <!-- Charts -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/rickshaw/rickshaw.min.css') }}">

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/joinable.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>
    <script src="{{ asset('js/rickshaw/vendor/d3.v3.js') }}"></script>


    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('js/raphael-min.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <script src="{{ asset('js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/neon-charts.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>
</body>
</html>
