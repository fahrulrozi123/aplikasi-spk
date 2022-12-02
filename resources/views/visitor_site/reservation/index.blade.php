@extends('templates/visitor_rsv_template')
@section('description', 'Reservation {{ $setting->title }}. Booking dari website kami untuk dapatkan harga terbaik!')
@section('keywords', 'Reservation {{ $setting->title }}, Reservation')
@section('title', 'Reservation')

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

{{-- ENHANCEMENT --}}
<div class="row p-20 resp mt-15 col-12 bg-secondary">
    <div style="width: 74vw; margin: auto;">
        <input type="hidden" id="child_temp" value='@json($childTemp)'>
        <input type="hidden" id="child_list" value='@json($childAge)'>
        <input type="hidden" id="rooms_data" value='@json($room_available)'>
        <form id="room_reserve" method="GET" action="{{ route('visitor.reservation') }}"></form>
        <form id="reserve" method="POST" action="{{ route('visitor.room_reservation') }}">
            {{csrf_field()}}
            <input type="hidden" name="reserve_data" id="reserve_data">
        </form>



        {{-- <div class="row collapse" id="look"> --}}

            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                <label for="date_check" class="label-modal-reserve">Check In</label>
                <div class="input-group col-xs-12">
                    <input form="room_reserve" type="text" id="datePickerReserveForm"
                        class="form-control modal-form-control datepicker visitor-input h-32"
                        data-start-date="today" data-format="dd MM yyyy" name="checkin"
                        value="{{$checkIn}}" placeholder="" required>
                    <span class="input-group-addon addon-modal-reserve"><i
                            class="entypo-calendar font-primary"></i></span>
                </div>
            </div>

            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="padding-bottom: 15px;">
                <label for="date_check" class="label-modal-reserve">Duration Of Stay</label>
                <div class="input-group col-xs-12">
                    <select name="stay_total" form="room_reserve"
                        class="select form-control modal-form-control visitor-input h-32">
                        @for($i = 1; $i <= 15; $i++) @if($i==$totalDays) <option value="{{$i}}"
                            selected>{{$i}} Night</option>
                            @else
                            <option value="{{$i}}">{{$i}} Night</option>
                            @endif
                            @endfor
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
                            value="{{$totalRoom}}" data-min="1" data-max="5">
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
                            value="{{$adultTotal}}" data-min="1" data-max="10" required>
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
                            value="{{$childTotal}}" data-min="0" data-max="10">
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
                            value="{{$totalExtrabed}}"
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

<!-- Room  -->
@if(count($room_available) > 0)
<div class="container">

    {{-- Room Only display --}}
    <div class="row" style="margin-top:15px;">
        <div class="row">
            <div class="col-xs-12 col-lg-10 mt-23" style="margin: auto; padding-bottom: 10px;">
                <p class="text-horison" style="font-size:20px;">Result for <strong> {{$totalRoom}} Rooms, {{$totalGuest}} Guest,</strong> staying for <strong> {{$totalDays}} Nights </strong> from <strong> {{$checkIn}} to {{$checkOut}} </strong>
                @if($totalExtrabed > 0)
                    with <strong>{{$totalExtrabed}} Additional Extra Bed</strong>
                @endif
                </p>
            </div>

            {{-- <div class="col-xs-8 col-lg-2" style="padding-bottom: 10px;">
                <a type="button" style="font-size:12px;text-decoration: none;" class="text-horison" data-toggle="collapse"
                    data-target="#look"><strong>Change Search</strong>
                    <i style="padding-left:10px;" class="fa fa-angle-down"></i>
                </a>
            </div> --}}
        </div>
        <?php $no = 0;?>
        @foreach($room_available as $room) <?php $no++ ;?>
        <div class="container">
            <div class="row" style="margin-top:50px; margin-bottom:40px; margi-left:0px;">
                <div class="col-md-6">
                    @php $i = 0; $total = count($room['photo']) > 3 ? 3 : count($room['photo']); @endphp
                    @foreach($room['photo'] as $photo)@php $i++;@endphp
                    @if($i > 0)
                    <div class="mySlides1 id_{{$no}}">
                        <div class="numbertext">{{$i.'/'.$total}}</div>
                        <img src="{{asset('/user/'.$room['photo'][$i-1]->photo_path)}}" class="uwaw img-rooms-mobile">
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
                        @if($i <= 3) <div class="column {{$class}}" style="height:80px!important;">
                            <img class="demo1 id_{{$no}}" src="{{asset('/user/'.$room['photo'][$i-1]->photo_path)}}"
                                style="width:100% ; heigth:80px!important;" onclick="currentSlide({{$no}}, {{$i}})"
                                alt="Room">
                            @if($i == 3)
                            <a href="javascript:;" onclick="seeAll({{$no}});" class="seal2"><b>+ See All</b></a>
                            <img class="bblack2" src="{{asset('/images/blck.jpg')}}"
                                style="width:100% ; heigth:80px!important;">
                            @endif
                    </div>
                    @endif
                    @endforeach
                </div>

            </div>

            <div class="col-md-6 box-desc-rsvp"> {{-- room type desc --}}

                <div class="row"> {{-- title & description room --}}
                    <div class="row">
                        <h2 style="margin-left:45px;"><strong>{{$room->room_name}}</strong></h2>
                    </div>

                    <div class="row">
                        {{-- Jumlah Orang --}}
                        <div class="col-md-3 col-xs-3" style="margin-left:31px; margin-top:0">
                            <p> 2 Person</p>
                        </div>
                        {{-- Pilihan Tipe Kamar --}}
                        <div class="col-md-6 col-xs-7" style="margin-top:0">
                            <p>@php $i =1; @endphp
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
                                {{$bed_type}}
                                @if($i < count($room['bed'])) {{' / '}}@endif @php $i++; @endphp @endforeach </p> </div>
                                    <div class="col-md-9 col-xs-7" style="margin-left: 31px; margin-top: 0">
                                    {{-- <p>{{$room->room_desc}}</p> --}}
                        </div>
                    </div>
                    <div class="row">
                        {{-- popover amenities --}}
                        <div class="col-md-9" style="margin-left:31px;">
                            @if(count($room['amenities']) > 0)
                            @php
                            $path = asset('/icon-pack/').'/';
                            $n = 0;
                            $exp = 1;
                            $other_amenitites ='<ul
                                style="width: 100%;padding: 0;display: inline-block;list-style: none;">
                                ';
                                @endphp
                                <div>
                                    <ul style="
                                        width: 100%;
                                        padding: 0;
                                        display: inline-block;
                                        list-style: none;">
                                        @foreach($room['amenities'] as $amenities)@php $n++; @endphp
                                        @php
                                        if($n == $exp){
                                        $other_amenitites.='<li class="col-xs-6 col-md-4" style="display: flex; padding-bottom: 10px">
                                            ';
                                            $exp+= 3;
                                            }
                                            else{
                                            $other_amenitites.='
                                        <li class="col-xs-6 col-md-4" style="display: flex; padding-bottom: 10px;">';
                                            }
                                            $other_amenitites.='<img
                                                src="'.$path.$amenities->amenities_name[0]->amenities_icon.'"
                                                style="display: flex;height:17px;width:17px;margin-right:10px;">'.$amenities->amenities_name[0]->amenities_name.'
                                        </li>';
                                        @endphp
                                        @endforeach
                                        @php $other_amenitites.='
                                    </ul>'; @endphp

                                    <li class="col-xs-4 col-md-4" style=" display: flex; padding-left: 0px;">
                                        <button class="btn text-horison hovertools" style="background-color: #fff0; margin-left: -15px;" data-toggle="popover" data-html="true" data-placement="bottom" data-content='{{$other_amenitites}}' data-original-title="Other amenities"> + Show Amenities
                                        </button>
                                    </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


            {{-- Box Room with breakfast --}}
            <div class="row"> {{-- row button --}}
                <div class="col-md-12 col-xs-12 boxrs ml-20 mt-15" style="box-shadow: 8px 4px 10px -4px #888888;">
                    <div class="col-md-12">
                        <p class="pt-20"><strong>Room with Breakfast</strong></p>
                    </div>
                    <div class="col-md-6" style="margin-left:-16px;">
                        <div class="col-md-12">
                            <p>Rp
                                <strong>
                                    <script>
                                        document.write(formatRupiah("{{$room['allotment'][0]->allotment_publish_rate}}"));
                                    </script>
                                </strong> / Night</p>
                        </div>
                        <div class="col-md-12" style="margin-top:-10px;">
                            <p class="mt-0" style="font-size:10px; color: #818285;">*Tax Inclusive</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-md-offset-3 col-xs-4 col-xs-offset-6">
                        <a id="validate_click" href="javascript:;" onclick="reserve({{$no}}, 1);"
                            class="btn btn-horison btn-lg ipad-book"><b>BOOK NOW</b></a>
                    </div>
                </div>
            </div>

            {{-- Box Room Only - Disabled --}}

            <div class="row"> {{-- row button --}}
                @if($totalExtrabed > 0)
                @php
                $class="disabled";
                @endphp
                <div class="col-md-12 col-xs-12 boxrs-disable ml-20 mt-15"
                    style="box-shadow: 8px 4px 10px -4px #888888;">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <p class="text-oren" style="color: #818285;"><strong>Room Only</strong></p>
                        </div>
                        <div class="col-md-8 oren-d">
                            <p class="box-oren" style="float:right">Room Only can’t have Extrabed</p>
                        </div>
                        @else
                        @php
                        $class="";
                        @endphp
                        <div class="col-md-12 col-xs-12 boxrs ml-20 mt-15"
                            style="box-shadow: 8px 4px 10px -4px #888888;">
                            <div class="col-md-12">
                                <p class="pt-20"><strong>Room Only</strong></p>
                                @endif
                            </div>
                            <div class="col-md-6" style="margin-left:-16px;">
                                <div class="col-md-12 col-xs-12">
                                    <p>Rp
                                        <strong>
                                            <script>
                                                document.write(formatRupiah(
                                                    "{{$room['allotment'][0]->allotment_ro_rate}}"));

                                            </script>
                                        </strong> / Night</p>
                                </div>
                                <div class="col-md-12 col-xs-12" style="margin-top:-10px;">
                                    <p class="mt-0" style="font-size:10px; color: #818285;">*Tax Inclusive</p>
                                </div>
                            </div>
                            <div class="col-md-2 col-md-offset-3 col-xs-4 col-xs-offset-6">
                                <a id="validate_clickY" href="javascript:;" onclick="reserve({{$no}}, 0);"
                                    class="btn btn-horison btn-lg ipad-book {{$class}}"><b>BOOK NOW</b></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        @if( $no < count($room_available) )
        <hr>
        @endif

        @endforeach
    </div>
</div>
@else

<div class="container">
    <div class="row">
        <div class="center-img-2" style="width: 50%; margin: auto;">
            <img src="{{ asset('/images/rooms/room_empty.svg') }}" alt="No rooms available on this date" class="center-img" style="padding: 35px;">
        </div>

        <center style="margin-bottom: 50px;">
            <h3>No rooms available on this date</h3>
        </center>
    </div>
</div>

{{-- <br><br> --}}

@endif
<!-- End Room  -->


@include('visitor_site.modal_product')
<script>
    // Script room atas

    var slideIndex = 1;
    var path = "{{asset('/user/')}}";
    var slideIndex3 = 1;
    var first = true;

    var rooms = JSON.parse($('#rooms_data').val());
    var child_list = JSON.parse($('#child_temp').val());
    var totalChild = 0;
    var total_room = {{$totalRoom}};




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

    function seeAll(id) {
        var room = rooms[id - 1];
        var galery_html = "";
        var roww_html = "";

        var slider_for = "";
        var slider_nav = "";

        $('#modal_title').text(room.room_name);

        room['photo'].forEach(function (data, index) {
            index++;
                slider_for += '<div align="center"><img class="gltop" src="' + path + "/" + data.photo_path +'"></div>';
                slider_nav += '<div class="sub-seeall">'+
                              '<div align="center"><img class="imgslide-seeall" src="' + path + "/" + data.photo_path +'"></div>'+
                              '</div>';


            });


            $('#seeAllModal').modal('show');
            $('.slider-for').empty();
            $('.slider-nav').empty();

            $('.slider-for').append(slider_for);
            $('.slider-nav').append(slider_nav);
            if(first){
            first = false;
            }else{
                $('.slider-for').slick('unslick');
                $('.slider-nav').slick('unslick');
            }
            do_slider();
    }


    if (child_list != null) {
        for (let i = 0; i < child_list.length; i++) {
            const element = child_list[i];
            addChildReservation(1);
            $('#child_' + (i + 1)).val(element);
        }
    }


    function addChildReservation(n) {

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

            var html =
                '<div class="col-xs-6 col-lg-2 col-md-3 col-sm-3 mt-10" id="age_' + totalChild + '" style="padding-left: 0px;">' +
                    '<label for="date_check" class="label-modal-reserve">Age</label>' +
                    '<select id="child_' + totalChild +
                    '" class="form-control modal-form-control visitor-input child_age">' +
                        '@for ($i = 0; $i <= 6; $i++)' +
                            '@if ($i == 0)' +
                                '<option value="{{$i}}"> < 1 </option>' +
                            '@else' +
                                '<option value="{{$i}}"> {{$i}} </option>' +
                            '@endif' +
                        '@endfor' +
                    '</select>' +
                '</div>';
            $(html).hide().appendTo('#children').fadeIn(300);
        }
    }

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

        if (form == 'room_reserve') {
            var extra_bed = parseInt($('#extra_bed').val());
            var adult_total = parseInt($('#adult_total').val());
            var child_total = parseInt(totalChild);

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
                msg.push("Room capacity exceeded, add more room or extrabed");
                cek = false;
            }
            if (adult_total == need_extrabed && extra_bed < min_extrabed) {
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
                var childs = document.getElementsByClassName('child_age');
                for (let i = 0; i < childs.length; i++) {
                    const element = childs[i];
                    child_age.push(element.value);
                }
                $('#child_age').val(child_age.toString());
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

    function reserve(index, type) {
        $('#validate_click').css("pointer-events", "none");
        $('#validate_clickY').css("pointer-events", "none");

        if ({{$childTotal}} > 0) {
            var child_list = $('#child_list').val();
            child_list = child_list.replace("\"", "").replace("\"", "");

        } else {
            var child_list = '';
        }
        var data = rooms[index - 1];
        var value = {
            checkIn: "{{$checkIn}}",
            totalDays: "{{$totalDays}}",
            totalRooms: "{{$totalRoom}}",
            totalExtrabed: "{{$totalExtrabed}}",
            adultTotal: "{{$adultTotal}}",
            childTotal: "{{$childTotal}}",
            childAge: child_list,
            type: type,
            room: data.id
        };
        $('#reserve_data').val(JSON.stringify(value));
        $('#reserve').submit();
    }

</script>
@endsection
