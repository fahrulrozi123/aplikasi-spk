@extends('templates/visitor_template')

@section('description', 'Rooms Horison Ultima Bandung. Booking dari website kami untuk dapatkan harga terbaik!')
@section('keywords', 'Rooms Horison Ultima Bandung, Rooms')
@section('title', 'Rooms')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/horison-custom.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/404-custom.css ') }}">
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

{{-- form reservation --}}
{{-- <div class="row p-20 resp mt-15 col-12 bg-secondary">
    <div style="width: 74vw; margin: auto;">
        <form id="room_reserve" method="GET" action="{{ route('visitor.reservation') }}"></form>
        <form id="product_reserve" method="POST" action="{{ route('visitor.product_reservation') }}">
                {{ csrf_field() }}</form>

        <div class="tab-pane active bg-secondary" id="rooms">
            <div class="tab-content">
                <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                    <label for="date_check" class="label-modal-reserve">Check In</label>
                    <div class="input-group col-xs-12 required">
                        <input form="room_reserve" id="datePickerReserveForm" type="text"
                            autocomplete="off" style="background-color: inherit;"
                            class="form-control modal-form-control inputbox-datepicker visitor-input"
                            name="checkin" placeholder="" readonly required>
                        <span class="input-group-addon addon-modal-reserve"><i
                                class="entypo-calendar font-primary"></i></span>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                    <label for="date_check" class="label-modal-reserve">Duration of Stay</label>
                    <div class="input-group col-xs-12">
                        <select form="room_reserve" name="stay_total"
                            class="form-control modal-form-control visitor-input">
                            @for ($i = 1; $i <= 15; $i++) <option value="{{$i}}">{{$i}} Night</option>
                                @endfor
                        </select>
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
                                value="" data-min="1" data-max="5">
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
                                value="" data-min="1" data-max="10" required>
                            <button type="button" class="btn btn-horison h-32"
                                data-step="1">+</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
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

                <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                    <label for="date_check" class="label-modal-reserve" style="text-align:center;">Extra Bed</label>
                    <div class="input-group col-xs-12">
                        <div class="ri input-spinner">
                            <button type="button" class="btn btn-horison h-32"
                                data-step="-1">-</button>
                            <input type="number" form="room_reserve" id="extra_bed" name="extra_bed"
                                value=""
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
                    <input type="button" onclick="submit('room_reserve');" class="btn btn-horison btn-md" style="padding: 8px 50.5px;margin-bottom: 12px; margin-top: 21px;" value="APPLY">
                </div>

            </div>

            <div class="tab-pane bg-secondary" id="product">
                <div class="">
                    <div class="col-md-12">
                        <label for="date_product" class="label-modal-reserve">Date</label>
                        <div class="input-group col-xs-12">
                            <input form="product_reserve" type="text" style="background-color: inherit;"
                                class="form-control modal-form-control inputbox-datepicker visitor-input bg-secondary"
                                name="date_product" id="date_product" placeholder="" readonly>
                            <span class="input-group-addon addon-modal-reserve"><i
                                    class="entypo-calendar font-primary"></i></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="category_product" class="label-modal-reserve">Package Category</label>
                        <select onchange="set_product(this);"
                            class="form-control modal-form-control visitor-input">
                            <option value="0">{{ $menu['recreation'][0]['page_name'] }}</option>
                            <option value="1">{{ $menu['wellness'][0]['page_name'] }}</option>
                            <option value="2">{{ $menu['mice'][0]['page_name'] }}</option>
                            <option value="3">{{ $menu['promotion'][0]['page_name'] }}</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="select_product" class="label-modal-reserve">Select Package</label>
                        <select form="product_reserve" name="product_list"
                            class="form-control modal-form-control visitor-input product_list">
                        </select>
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
</div> --}}

<div class="row p-20 resp mt-15 col-12 bg-secondary">
    <div style="width: 74vw; margin: auto;">
        <div class="tab-content">
            <form id="room_reserve" method="GET" action="{{ route('visitor.reservation') }}"></form>
            <form id="product_reserve" method="POST" action="{{ route('visitor.product_reservation') }}">
                    {{ csrf_field() }}</form>
            <div class="tab-pane active bg-secondary" id="rooms">

                <div class="">
                    <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                        <label for="date_check" class="label-modal-reserve">Check In</label>
                        <div class="input-group col-xs-12 required">
                            <input form="room_reserve" id="datePickerReserveForm" type="text"
                                autocomplete="off" style="background-color: inherit;"
                                class="form-control modal-form-control inputbox-datepicker visitor-input"
                                name="checkin" placeholder="" readonly required>
                            <span class="input-group-addon addon-modal-reserve"><i
                                    class="entypo-calendar font-primary"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                        <label for="date_check" class="label-modal-reserve">Duration of Stay</label>
                        <div class="input-group col-xs-12">
                            <select form="room_reserve" name="stay_total"
                                class="select form-control modal-form-control visitor-input h-32">
                                @for ($i = 1; $i <= 15; $i++) <option value="{{$i}}">{{$i}} Night</option>
                                    @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                        <label for="room_choice" class="label-modal-reserve">Rooms</label>
                        <div class="input-spinner">
                            <button type="button" onclick="addRoomTotal(-1);" class="btn btn-horison"
                                data-step="-1" style="height:31px">-</button>
                            <input type="text" form="room_reserve" id="room_total" onchange="addRoomTotal();"
                                name="room_total" class="form-control size-3-1 dd-horison h-32 moz-view-number" value="1" data-min="1"
                                data-max="5" style="background-color: inherit;" required readonly>
                            <button type="button" onclick="addRoomTotal(1);" class="btn btn-horison"
                                data-step="1" style="height:31px">+</button>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                        <label for="adult_sum" class="label-modal-reserve">Adults</label>
                        <div class="input-spinner">
                            <button type="button" class="btn btn-horison" data-step="-1"
                                style="height:31px">-</button>
                            <input type="text" form="room_reserve" id="adult_total" name="adult_total"
                                class="form-control size-3-1 dd-horison h-32 moz-view-number" value="1" min="1" max="2" data-min="1"
                                data-max="10" style="background-color: inherit;" required readonly>
                            <button type="button" class="btn btn-horison" data-step="1"
                                style="height:31px">+</button>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                        <label for="children_sum" class="label-modal-reserve">Children</label>
                        <div class="input-spinner">
                            <button type="button" class="btn btn-horison h-32" data-step="-1"
                            onclick="addChild(-1);">-</button>
                            <input type="number" form="room_reserve" id="child_total" name="child_total"
                                name="child_total" class="form-control size-3-1 dd-horison h-32 moz-view-number"
                                value="0" data-min="0" data-max="10" data-min="0" data-max="10">
                            <button type="button" class="btn btn-horison h-32" data-step="1"
                                onclick="addChild(1);">+</button>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                        <label for="extrabed_sum" class="label-modal-reserve">Extra Bed</label>
                        <div class="input-spinner">
                            <button type="button" class="btn btn-horison" data-step="-1"
                                style="height:31px">-</button>
                            <input type="text" form="room_reserve" id="extra_bed" name="extra_bed"
                                class="form-control size-3-1 dd-horison h-32 moz-view-number" value="0" data-min="0" data-max="5"
                                style="background-color: inherit;" required readonly>
                            <button type="button" class="btn btn-horison" data-step="1"
                                style="height:31px">+</button>
                        </div>
                    </div>

                    <div class="col-md-12" id="children" style="margin-left: 10px;">
                        <input form="room_reserve" type="hidden" id="child_age" name="child_age">
                    </div>
                </div>

                <div class="col-lg-1 col-xs-12" style="text-align: center;">
                    <input type="button" onclick="submit('room_reserve');" class="btn btn-horison btn-md" style="padding: 8px 50.5px;margin-bottom: 12px; margin-top: 21px;" value="Search">
                </div>

            </div>

            <div class="tab-pane bg-secondary" id="product">
                <div class="">
                    <div class="col-md-12">
                        <label for="date_product" class="label-modal-reserve">Date</label>
                        <div class="input-group col-xs-12">
                            <input form="product_reserve" type="text" style="background-color: inherit;"
                                class="form-control modal-form-control inputbox-datepicker visitor-input bg-secondary"
                                name="date_product" id="date_product" placeholder="" readonly>
                            <span class="input-group-addon addon-modal-reserve"><i
                                    class="entypo-calendar font-primary"></i></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="category_product" class="label-modal-reserve">Package Category</label>
                        <select onchange="set_product(this);"
                            class="form-control modal-form-control visitor-input">
                            <option value="0">{{ $menu['recreation'][0]['page_name'] }}</option>
                            <option value="1">{{ $menu['wellness'][0]['page_name'] }}</option>
                            <option value="2">{{ $menu['mice'][0]['page_name'] }}</option>
                            <option value="3">{{ $menu['promotion'][0]['page_name'] }}</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="select_product" class="label-modal-reserve">Select Package</label>
                        <select form="product_reserve" name="product_list"
                            class="form-control modal-form-control visitor-input product_list">
                        </select>
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
{{-- end form reservation --}}

<input id="rooms_data" type="hidden" value='@json($rooms)'>

<div class="row rooms-row-1 ipad-rooms">

</div>
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
                            // $path = asset('/icon-pack/').'/';
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
                        {{-- <div class="col-md-6 col-xs-12" align="right">
                            <a class="btn btn-horison btn-lg reserveNow" id="reserveNow"
                                style="width:135px; margin-top:0px;"><b>Book Now</b></a>
                        </div> --}}
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
