@extends('templates/visitor_template')

@section('description', 'Function Room Horison Ultima Bandung. Booking dari website kami untuk dapatkan harga terbaik!')
@section('keywords', 'Function Room Horison Ultima Bandung, Function Room')
@section('title', 'Function Room')

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

{{-- image gallery atas --}}
<div class="container" style="margin-top:20px; margin-bottom:80px;">
    <div class="col-md-6">
        <p class="black-fr fr-row-dsc" style="margin-top:75px; margin-bottom:0px;">
        OUR <span class="gold">FUNCTION</span> ROOMS</p>

        <p class="description-lp-dark2">
            9 Elegant MInimalist Meetings Rooms that ideal for your ideas. Conference, seminar,
            exhibition and other activities fully equip to accomodate your needs.
        </p>

        <a href="/inquiry?from=mice" class="btn btn-horison btn-lg" style="margin-top:25px; margin-bottom: 40px;"><b>Reserve Now</b></a>
    </div>

    <div class="col-md-6">
        <?php $no = 0;?>
        @foreach($pagesettings as $pagesetting)<?php $no++ ;?>
        <?php $i = 0;?>
            @foreach($pagesetting->photo as $photo)<?php $i++;?>
            <div class="mySlides2 id_{{$no}}">
                <div class="numbertext">{{$i}} / 3</div>
                <img src="{{asset('/user/'.$photo->photo_path)}}" class="uwaw2 height-fr" alt="{{ $pagesetting->page_name }}" loading="lazy">
            </div>
            @endforeach
        @endforeach
        <div class="bbaris3">
            <?php $no = 0;?>
            @foreach($pagesettings as $pagesetting)<?php $no++ ;?>
            <?php $i = 0;?>
                @foreach($pagesetting->photo->take(3) as $photo)<?php $i++;?>
                    <div class="column">
                        <img class="demo2 cursor id_{{$no}} height2-fr" src="{{asset('/user/'.$photo->photo_path)}}" onclick="currentSlide2({{$no}}, {{$i}})" alt="{{ $photo->page_name }}" loading="lazy">
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>

{{-- function room type icon --}}
<div class="row bg-secondary">
    <div class="container">
        <div class="col-xs-4 col-md-2">
            <div class="fr-icon horison-icon" style="text-align: center;">
                {!! file_get_contents(asset('/images/function-room/FR-Classroom.svg', false, stream_context_create($arrContextOptions))) !!}
            </div>
            <p class="fr-name" align="center">Class Room</p>
        </div>
        <div class="col-xs-4 col-md-2">
            <div class="fr-icon horison-icon" style="text-align: center;">
                {!! file_get_contents(asset('/images/function-room/FR-Theatre.svg', false, stream_context_create($arrContextOptions))) !!}
            </div>
            <p class="fr-name" align="center">Theatre</p>
        </div>
        <div class="col-xs-4 col-md-2">
            <div class="fr-icon horison-icon" style="text-align: center;">
                {!! file_get_contents(asset('/images/function-room/FR-UShape.svg', false, stream_context_create($arrContextOptions))) !!}
            </div>
            <p class="fr-name" align="center">U-Shape</p>
        </div>
        <div class="col-xs-4 col-md-2">
            <div class="fr-icon horison-icon" style="text-align: center;">
                {!! file_get_contents(asset('/images/function-room/FR-Boardroom.svg', false, stream_context_create($arrContextOptions))) !!}
            </div>
            <p class="fr-name" align="center">Board Room</p>
        </div>
        <div class="col-xs-4 col-md-2">
            <div class="fr-icon horison-icon" style="text-align: center;">
                {!! file_get_contents(asset('/images/function-room/FR-RoundTable.svg', false, stream_context_create($arrContextOptions))) !!}
            </div>
            <p class="fr-name" align="center">Round Table</p>
        </div>
        <div class="col-xs-4 col-md-2">
            <div class="fr-icon horison-icon" style="text-align: center;">
                {!! file_get_contents(asset('/images/function-room/FR-Dimension.svg', false, stream_context_create($arrContextOptions))) !!}
            </div>
            <p class="fr-name" align="center">Dimension</p>
        </div>
    </div>
</div>

{{-- PUT DATA IN HIDDEN FOR TRANSFER TO JS --}}
<input id="mices" type="hidden" value='@json($mices)'>
<input id="function_rooms" type="hidden" value='@json($function_rooms)'>
{{-- function room type detail --}}
<?php $no = 1;?>
@foreach($function_rooms as $function)<?php $no++; ?>
<div class="row bg-secondary" style="padding-top:65px;">
    <div class="container">
        <div class="col-md-6" style="margin-bottom:40px;"> {{-- slide image --}}
            <?php $i = 0;$total = count($function['photos']);?>
            @foreach($function['photos'] as $photo)<?php $i++;?>
                <div class="mySlides2 id_{{$no}}">
                    <div class="numbertext">{{$i}} / {{$total}}</div>
                    <img src="{{asset('/user/'.$photo->photo_path)}}" class="uwaw2 height-fr" style="object-fit: cover !important;" loading="lazy">
                </div>
            @endforeach

            <div class="bbaris3">
            <?php $i = 0;$total = count($function['photos']);?>
            @php
            if($total == 1)
            {
                $class = "hidden";
            }else{
                $class="";
            }
            @endphp
            @foreach($function['photos'] as $photo)<?php $i++;?>
            @if($i <= 3)
            <div class="column {{$class}}">
                <img class="demo2 height2-fr cursor id_{{$no}}" src="{{asset('/user/'.$function['photos'][$i-1]->photo_path)}}" style="width:100%; object-fit: cover;" onclick="currentSlide2({{$no}}, {{$i}})" alt="Function Room" loading="lazy">
                @if($i == 3)
                <a href="javascript:;" onclick=" seeAll({{$no}})" class="seal2 seal-fr" style=""><b>+See All</b></a>
                <img class="bblackfr" src="{{asset('/images/blck.jpg')}}"
                    style="width:100%; margin-top: -87px;" loading="lazy">
                @endif
            </div>
            @endif
            @endforeach
            </div>
        </div>

        <div class="col-md-6"> {{-- fr type desc --}}
            <div class="row"> {{-- title & description fr --}}
                <h2 class="line-clamp-1" style="margin-top:0px; margin-left:22px; margin-right:22px;"><b>{{$function->func_name}}</b></h2>
                @if(strlen($function->func_room_desc) > 100)
                <p class="line-clamp-3" style="margin-left:22px; margin-right:22px; margin-bottom: 5px;">
                        {{substr($function->func_room_desc, 0, 145)."..."}}
                </p>
                    <a href="/function-room/{{ $function->func_room_slug }}" style="font-size: 13px; color: #444444; margin-left: 20px;">
                    <i><u>See more description</u></i>
                    </a>
                @else
                <p class="line-clamp-3" style="margin-left:22px; margin-right:22px; margin-bottom: 5px;"> {{$function->func_room_desc}}</p>
                @endif
                </div><br>

                <div class="row"> {{-- list type fr --}}
                <div class="col-sm-6 col-md-6">
                    <div class="row">
                    <div class="col-xs-3 col-md-3"> {{-- icon --}}
                        <div class="fr-icon-2 horison-icon">
                            {!! file_get_contents(asset('/images/function-room/FR-Classroom.svg', false, stream_context_create($arrContextOptions))) !!}
                        </div>
                    </div>
                    <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                        <p class="fr-name-2">Class Room</p>
                    </div>
                    <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                        <p class="fr-pax">{{$function->func_class}} Pax</p>
                    </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                    <div class="col-xs-3 col-md-3"> {{-- icon --}}
                        <div class="fr-icon-2 horison-icon">
                            {!! file_get_contents(asset('/images/function-room/FR-Theatre.svg', false, stream_context_create($arrContextOptions))) !!}
                        </div>
                    </div>
                    <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                        <p class="fr-name-2">Theatre</p>
                    </div>
                    <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                        <p class="fr-pax">{{$function->func_theatre}} Pax</p>
                    </div>
                    </div>
                    <div class="row" style="margin-top:10px; margin-bottom:10px;">
                    <div class="col-xs-3 col-md-3"> {{-- icon --}}
                        <div class="fr-icon-2 horison-icon">
                            {!! file_get_contents(asset('/images/function-room/FR-UShape.svg', false, stream_context_create($arrContextOptions))) !!}
                        </div>
                    </div>
                    <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                        <p class="fr-name-2">U-Shape</p>
                    </div>
                    <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                        <p class="fr-pax">{{$function->func_ushape}} Pax</p>
                    </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="row">
                    <div class="col-xs-3 col-md-3"> {{-- icon --}}
                        <div class="fr-icon-2 horison-icon">
                            {!! file_get_contents(asset('/images/function-room/FR-Boardroom.svg', false, stream_context_create($arrContextOptions))) !!}
                        </div>
                    </div>
                    <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                        <p class="fr-name-2">Board Room</p>
                    </div>
                    <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                        <p class="fr-pax">{{$function->func_board}} Pax</p>
                    </div>
                    </div>
                    <div class="row" style="margin-top:10px;">
                    <div class="col-xs-3 col-md-3"> {{-- icon --}}
                        <div class="fr-icon-2 horison-icon">
                            {!! file_get_contents(asset('/images/function-room/FR-RoundTable.svg', false, stream_context_create($arrContextOptions))) !!}
                        </div>
                    </div>
                    <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                        <p class="fr-name-2">Round Table</p>
                    </div>
                    <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                        <p class="fr-pax">{{$function->func_round}} Pax</p>
                    </div>
                    </div>
                    <div class="row" style="margin-top:10px; margin-bottom:10px;">
                    <div class="col-xs-3 col-md-3"> {{-- icon --}}
                        <div class="fr-icon-2 horison-icon">
                            {!! file_get_contents(asset('/images/function-room/FR-Dimension.svg', false, stream_context_create($arrContextOptions))) !!}
                        </div>
                    </div>
                    <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                        <p class="fr-name-2">Dimension</p>
                    </div>
                    <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                        <p class="fr-pax">{{$function->func_dimension}} Sqm</p>
                    </div>
                    </div>
                </div>
                </div>

                <div class="row"> {{-- row button --}}
                <div class="col-xs-6 col-sm-4 col-md-4">
                    <a href="/inquiry?from=mice" class="btn btn-lg btn-horison-gold" style="margin-top:10px; margin-left:10px;"><b>Reserve Now</b></a>
                </div>
                <div class="col-xs-6 col-sm-8 col-md-8">
                    <a href="javascript:;" onclick="show_partition({{($no-1)}});" >
                    <p class="fr-link-text" align="right">See {{$function->func_name}} Layout Details<span class="entypo-right-open"></span></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- item album gallery --}}
<div class="row" style="margin-top:55px;">
    <div class="container">
        <center>
            <p class="black" style="margin-top:20px; margin-bottom:40px;">EXPLORE <span class="gold">MICE & Wedding</span></p>
        </center>

        <div class="gallery-env">
            <div class="">
            <?php $no = count($function_rooms) + 1;?>
                @foreach($mices->take(6) as $mice)<?php $no++; ?>
                <div class="col-sm-6 col-md-4">
                    <article class="album">
                        <header>
                            <?php $i = 0;$total = count($mice['photos']);?>
                            @foreach($mice['photos'] as $photo)<?php $i++;?>
                                <div class="mySlides2 id_{{$no}}">
                                    <div class="numbertext">{{$i}} / {{$total}}</div>
                                    <img src="{{asset('/user/'.$photo->product_photo_path)}}" class="height-package uwaw" style="height:270px;" loading="lazy">
                                </div>
                            @endforeach

                            <div class="bbaris-rec">
                                @php $i = 0; $total = count($mice['photos']);
                                if($total == 1)
                                {
                                $class = "hidden";
                                }else{
                                $class="";
                                }@endphp
                                @foreach($mice['photos'] as $photo)@php $i++;@endphp
                                        @if($i <= 3) <div class="column {{$class}}" style="height:80px!important;">
                                        <img class="demo2 id_{{$no}}"
                                            src="{{asset('/user/'.$mice['photos'][$i-1]->product_photo_path)}}"
                                            style="width:100% ; height:45px!important; object-fit: cover;"
                                            onclick="currentSlide2({{$no}}, {{$i}})" alt="Function Room" loading="lazy">
                                        @if($i == 3)
                                        <a href="javascript:;" onclick=" seeAll({{$no}})" class="seal2"
                                            style="margin-top:-31px!important; margin-left:14px!important; font-size:8px;!important"><b>+
                                                See All</b></a>
                                        <img class="bblackr" src="{{asset('/images/blck.jpg')}}"
                                            style="width:100%; margin-top:-45px;" loading="lazy">
                                        @endif
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </header>
                        <section class="album-info shadow" style="height: 19rem;">
                            <h4><b class="line-clamp-1">{{$mice->product_name}}</b></h4>
                            @if(strlen($mice->product_detail) > 100)
                            <h5 class="line-clamp-3" style="margin-bottom: 7px; height: 57px;">
                                    {{substr($mice->product_detail, 0, 100)."..."}}
                            </h5>
                                <a href="/mice-wedding/{{ $mice->product_slug }}" class="font-secondary" style="font-size: 11px;"><i><u>See more description</u></i></a>
                            @else
                                <h5 class="line-clamp-3" style="margin-bottom: 7px; height: 57px;">{{$mice->product_detail}}</h5>
                            @endif
                            @if($mice->sales_inquiry == "0")
                                <p class="price">
                                    <script>
                                            document.write("Rp " + formatRupiah("{{$mice->product_price}}"));
                                    </script><span class="pax"> / Pax</span>
                                </p>
                                <br>
                                <form method="POST" action="/product_reservation?date_product={{$today}}&product_list={{$mice->id}}">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-horison-gold book-reserve" style="font-weight:bold;" value="Book Now" />
                                </form>
                            @else
                                <br><br><br><br>
                            @php
                                if($mice->category == 3){
                                    $from = "mice";
                                }else if($mice->category == 4){
                                    $from = "wedding";
                                }
                            @endphp
                                <a href="/inquiry?from={{$from}}" class="btn btn-horison-gold book-reserve"><b>Reserve Now</b></a>
                            @endif
                        </section>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('visitor_site.modal_product')
@include('visitor_site.function_room.frdetail_modal')


{{-- script untuk image gallery atas --}}
<script>
    var slideIndex = 1;
    showSlides(1, 1);

    var function_rooms = JSON.parse($('#function_rooms').val());
    var mices = JSON.parse($('#mices').val());

    for (let n = 1; n <= function_rooms.length; n++) {
        // if(n = 1){
        //   showSlides(n, 1);
        // }
            if (function_rooms[n - 1]['photos'].length > 0) {
                showSlides(n+1, 1);
            }
    }

    var next_slide = function_rooms.length + 1;
    for (let n = 1; n <= mices.length; n++) {
        // if(n = 1){
        //   showSlides(n, 1);
        // }
            if (mices[n - 1]['photos'].length > 0) {
                showSlides(n+next_slide, 1);
            }
    }

    function currentSlide2(id, n) {
            showSlides(id, slideIndex = n);
    }

    function showSlides(id, n) {
        var i;
        var slides = document.getElementsByClassName("mySlides2 id_" + String(id));
        var dots = document.getElementsByClassName("demo2 id_" + String(id));

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


    var slideIndex3 = 1;
    var path = "{{asset('/user/')}}";
    var first = true;

    function seeAll(id) {
        var path = "{{asset('/user/')}}";

        var slider_for = "";
        var slider_nav = "";

        if(id > next_slide){
            id = id - next_slide;
            var photos = mices[id - 1];

            $('#modal_title').text(photos.product_name);

            photos['photos'].forEach(function (data, index) {
            index++;

            slider_for += '<div align="center"><img loading="lazy" class="gltop" src="' + path + "/" + data.product_photo_path +'"></div>';
            slider_nav += '<div class="sub-seeall">'+
                        '<div align="center"><img loading="lazy" class="imgslide-seeall" src="' + path + "/" + data.product_photo_path +'"></div>'+
                        '</div>';
            });
        }else{
            var photos = function_rooms[id - 2];

            $('#modal_title').text(photos.func_name);

            photos['photos'].forEach(function (data, index) {

            index++;
            slider_for += '<div align="center"><img class="gltop" src="' + path + "/" + data.photo_path +'"></div>';
            slider_nav += '<div class="sub-seeall">'+
                        '<div align="center"><img class="imgslide-seeall" src="' + path + "/" + data.photo_path +'"></div>'+
                        '</div>';
            });
        }

        $('#seeAllModal').modal('show');

        $('.slider-for').empty();
        $('.slider-nav').empty();

        $('.slider-for').append(slider_for);
        $('.slider-nav').append(slider_nav);

        do_slider();

        $('#seeAllModal').on('hidden.bs.modal', function () {
            $('.slider-for').slick('unslick');
            $('.slider-nav').slick('unslick');
        })
    }

    function show_partition(index){
        var partition = function_rooms[index-1];
        $('#fr_class').text(partition.func_class+" Pax");
        $('#fr_theatre').text(partition.func_theatre+" Pax");
        $('#fr_ushape').text(partition.func_ushape+" Pax");
        $('#fr_board').text(partition.func_board+" Pax");
        $('#fr_round').text(partition.func_round+" Pax");
        $('#fr_dimension').text(partition.func_dimension+" Sqm");
        var html = '';
        partition['partition'].forEach(element => {
            html += '<tr>'+
                        '<td class="fr-modal-table-content">'+element.func_name+'</td>'+
                        '<td class="fr-modal-table-content">'+element.func_dimension+'</td>'+
                        '<td class="fr-modal-table-content">'+element.func_class+'</td>'+
                        '<td class="fr-modal-table-content">'+element.func_theatre+'</td>'+
                        '<td class="fr-modal-table-content">'+element.func_ushape+'</td>'+
                        '<td class="fr-modal-table-content">'+element.func_board+'</td>'+
                        '<td class="fr-modal-table-content">'+element.func_round+'</td>'+
                    '</tr>';
            $('#partition_table-body').empty();
            $('#partition_table-body').append(html);
        });
        jQuery('#frdetailModal').modal('show');
    }

    $('form').submit(function(){
        $(this).children('input[type=submit]').prop('disabled', true);
    });

</script>
@endsection
