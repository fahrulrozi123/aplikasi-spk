@extends('templates/visitor_template')

@section('description', 'Package Reservation')
@section('keywords', 'Package Reservation')
@section('title', 'Package Reservation')

    <script src="{{ asset('holocane/js/jquery-1.11.3.min.js ') }}"></script>
    <script src="{{ asset('holocane/js/numeral/numeral.js') }}"></script>
    <script src="{{ asset('holocane/js/bootstrap-datepicker.js') }}"></script>


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

<div class="container package-navigation mt-15 mb-20 pt-30 px-18 visible-md visible-lg">
    <div class="row">
        <div class="col-12 text-center nav-tabs">
            <a href="#category-1" class="btn btn-holocene-gold package-nav-button" style="font-weight:bold;" data-toggle="tab"> {{$category1->page_name}} </a>
            <a href="#category-2" class="btn btn-holocene-gold package-nav-button" style="font-weight:bold;" data-toggle="tab"> {{$category2->page_name}} </a>
            <a href="#category-3" class="btn btn-holocene-gold package-nav-button" style="font-weight:bold;" data-toggle="tab"> {{$category3->page_name}} </a>
            <a href="#category-4" class="btn btn-holocene-gold package-nav-button" style="font-weight:bold;" data-toggle="tab"> {{$category4->page_name}} </a>
        </div>
    </div>
</div>

<div class="container package-navigation mt-15 mb-20 pt-15 px-18 visible-xs visible-sm">
    <div class="row">
        <div class="col-xs-6 col-sm-6 text-center">
            <a href="#category-1" class="btn btn-holocene-gold package-nav-button" style="font-weight:bold;" data-toggle="tab"> {{$category1->page_name}} </a>
        </div>
        <div class="col-xs-6 col-sm-6 text-center">
            <a href="#category-2" class="btn btn-holocene-gold package-nav-button" style="font-weight:bold;" data-toggle="tab"> {{$category2->page_name}} </a>
        </div>
        <div class="col-xs-6 col-sm-6 text-center">
            <a href="#category-3" class="btn btn-holocene-gold package-nav-button" style="font-weight:bold;" data-toggle="tab"> {{$category3->page_name}} </a>
        </div>
        <div class="col-xs-6 col-sm-6 text-center">
            <a href="#category-4" class="btn btn-holocene-gold package-nav-button" style="font-weight:bold;" data-toggle="tab"> {{$category4->page_name}} </a>
        </div>
    </div>
</div>

<div class="container package-section">
    <div class="row">
        <div class="col-12">
            <div class="tab-content">

                <div class="tab-pane active" id="category-1">
                    {{-- RECREATION --}}
                    {{-- container description --}}
                    <div class="row bg-white">
                        <div class="container">
                            <br>
                            <center>
                                <p class="black" style="margin-top:20px; margin-bottom:20px;">
                                    <span class="gold">{{$category1->page_name}}</span></p>
                            </center>
                            <center>
                                <p class="description-mw-dark">
                                    {{$category1->page_description}}
                                </p>
                            </center>
                        </div>
                    </div>
                    {{-- item album gallery --}}
                    <div class="row">
                        <div class="container">
                            <br><br>
                            <div class="gallery-env">
                                <div class="">
                                    {{-- PUT DATA IN HIDDEN FOR TRANSFER TO JS --}}
                                    <input id="recreations" type="hidden" value='@json($recreations)'>
                                    <?php $no = 0; $row = 0;?>
                                    @foreach($recreations as $recreation)<?php $no++; $row++;?>
                                    @if($row == 1)
                                    <div class="row">
                                    @endif
                                    <div class="col-sm-6 col-md-4">
                                        <article class="album">
                                            <header>
                                                <?php $i = 0;$total = count($recreation['photos']);?>
                                                @foreach($recreation['photos'] as $photo)<?php $i++;?>
                                                <div class="mySlidesRecreations demo-primary id_{{$no}}">
                                                    <div class="numbertext">{{$i}} / {{$total}}</div>
                                                    <img src="{{asset('/user/'.$photo->product_photo_path)}}" class="height-package img-default"
                                                        style="height:270px;" loading="lazy">
                                                </div>
                                                @endforeach
                                                <div class="bbaris-rec">
                                                    @php $i = 0; $total = count($recreation['photos']);
                                                    if($total == 1)
                                                    {
                                                    $class = "hidden";
                                                    }else{
                                                    $class="";
                                                    }@endphp
                                                    @foreach($recreation['photos'] as $photo)@php $i++;@endphp
                                                    @if($i <= 3) <div class="column {{$class}}" style="height:80px!important;">
                                                        <img class="demo1 demoRecreations id_{{$no}}"
                                                            src="{{asset('/user/'.$recreation['photos'][$i-1]->product_photo_path)}}"
                                                            style="width:100%!important; height:45px!important;"
                                                            onclick="currentSlideRecreation({{$no}}, {{$i}});" alt="Recreation" loading="lazy">
                                                        @if($i == 3)
                                                        <a href="javascript:;" onclick=" seeAllRecreation({{$no}})" class="seal2"
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
                                    <section class="album-info shadow bg-primary" style="height: 19rem;">
                                        <h4><b class="line-clamp-1"> {{ $recreation->product_name }}</b></h4>
                                        @if(strlen($recreation->product_detail) > 100)
                                        <h5 class="line-clamp-3 font-black" style="margin-bottom: 7px; height: 57px;">
                                                {{substr($recreation->product_detail, 0, 100)."..."}}
                                        </h5>
                                            <a href="/details?from=recreation&key={{$recreation->id}}" class="font-secondary" style="font-size: 11px"><i><u>See more description</u></i></a>
                                        @else
                                            <h5 class="line-clamp-3 font-black" style="margin-bottom: 7px; height: 57px;">{{$recreation->product_detail}}</h5>
                                        @endif

                                        @if($recreation->sales_inquiry == "0")
                                            <p class="price font-primary">
                                                <script>
                                                    document.write("Rp " + formatRupiah("{{$recreation->product_price}}"));
                                                </script><span class="pax"> / Pax</span>
                                            </p>
                                            <form method="POST" action="/product_reservation?date_product={{$today}}&product_list={{$recreation->id}}">
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn btn-holocene-gold book-reserve" style="font-weight:bold;" value="Book Now" />
                                            </form>
                                        @else
                                            <a href="/inquiry?from=recreational" class="btn btn-holocene-gold book-reserve"><b>Reserve Now</b></a>
                                        @endif
                                    </section>
                                    </article>
                                </div>
                                @if($row == 3 || $no == count($recreations))
                                </div>
                                @php
                                    $row = 0;
                                @endphp
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    </div>
                </div>


                <div class="tab-pane" id="category-2">
                    {{-- WELLNESS --}}
                    {{-- container description --}}
                    <div class="row bg-white">
                        <div class="container">
                            <br>
                            <center>
                                <p class="black" style="margin-top:20px; margin-bottom:20px;">
                                    <span class="gold">{{$category2->page_name}}</span></p>
                            </center>
                            <center>
                                <p class="description-mw-dark">
                                    {{$category2->page_description}}
                                </p>
                            </center>
                        </div>
                    </div>
                    {{-- item album gallery --}}
                    <div class="row">
                        <div class="container">
                            <br><br>
                            <div class="gallery-env">
                                <div class="">
                                    {{-- PUT DATA IN HIDDEN FOR TRANSFER TO JS --}}
                                    <input id="wellnesses" type="hidden" value='@json($wellnesses)'>
                                    <?php $no = 0; $row = 0;?>
                                    @foreach($wellnesses as $wellness)<?php $no++; $row++;?>
                                    @if($row == 1)
                                    <div class="row">
                                    @endif
                                    <div class="col-sm-6 col-md-4">
                                        <article class="album">
                                            <header>
                                                <?php $i = 0;$total = count($wellness['photos']);?>
                                                @foreach($wellness['photos'] as $photo)<?php $i++;?>
                                                <div class="mySlidesWellness id_{{$no}}">
                                                    <div class="numbertext">{{$i}} / {{$total}}</div>
                                                    <img src="{{asset('/user/'.$photo->product_photo_path)}}" class="height-package img-default"
                                                        style="height:270px;" loading="lazy">
                                                </div>
                                                @endforeach
                                                <div class="bbaris-rec">
                                                    @php $i = 0; $total = count($wellness['photos']);
                                                    if($total == 1)
                                                    {
                                                    $class = "hidden";
                                                    }else{
                                                    $class="";
                                                    }@endphp
                                                    @foreach($wellness['photos'] as $photo)@php $i++;@endphp
                                                    @if($i <= 3) <div class="column {{$class}}" style="height:80px!important;">
                                                        <img class="demoWellness demo-primary id_{{$no}}"
                                                            src="{{asset('/user/'.$wellness['photos'][$i-1]->product_photo_path)}}"
                                                            style="width:100%!important; height:45px!important;"
                                                            onclick="currentSlideWellness({{$no}}, {{$i}});" alt="Wellness" loading="lazy">
                                                        @if($i == 3)
                                                        <a href="javascript:;" onclick=" seeAllWellness({{$no}})" class="seal2"
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
                                    <section class="album-info shadow bg-primary" style="height: 19rem;">
                                        <h4><b class="line-clamp-1"> {{ $wellness->product_name }}</b></h4>
                                        @if(strlen($wellness->product_detail) > 100)
                                        <h5 class="line-clamp-3 font-black" style="margin-bottom: 7px; height: 57px;">
                                                {{substr($wellness->product_detail, 0, 100)."..."}}
                                        </h5>
                                            <a href="/wellness/{{ $wellness->product_slug }}" class="font-secondary" style="font-size: 11px;"><i><u>See more description</u></i></a>
                                        @else
                                            <h5 class="line-clamp-3 font-black" style="margin-bottom: 7px; height: 57px;">{{$wellness->product_detail}}</h5>
                                        @endif

                                        @if($wellness->sales_inquiry == "0")
                                            <p class="price font-primary">
                                                <script>
                                                    document.write("Rp " + formatRupiah("{{$wellness->product_price}}"));
                                                </script><span class="pax"> / Pax</span>
                                            </p>
                                            <form method="POST" action="/product_reservation?date_product={{$today}}&product_list={{$wellness->id}}">
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn btn-holocene-gold book-reserve" style="font-weight:bold;" value="Book Now" />
                                            </form>
                                        @else
                                            <a href="/inquiry?from=wellnesse" class="btn btn-holocene-gold book-reserve"><b>Reserve Now</b></a>
                                        @endif
                                    </section>
                                    </article>
                                </div>
                                @if($row == 3 || $no == count($wellnesses))
                                </div>
                                @php
                                    $row = 0;
                                @endphp
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    </div>
                </div>


                <div class="tab-pane" id="category-3">
                    {{-- MICE --}}
                    {{-- container description --}}
                    <div class="row bg-white">
                        <div class="container">
                            <br>
                            <center>
                                <p class="black" style="margin-top:20px; margin-bottom:20px;">
                                    <span class="gold">{{$category3->page_name}}</span></p>
                            </center>
                            <center>
                                <p class="description-mw-dark">
                                    {{$category3->page_description}}
                                </p>
                            </center>
                        </div>
                    </div>
                    {{-- item album gallery --}}
                    <div class="row">
                        <div class="container">
                            <br><br>
                            <div class="gallery-env">
                                <div class="">
                                    {{-- PUT DATA IN HIDDEN FOR TRANSFER TO JS --}}
                                    <input id="mices" type="hidden" value='@json($mices)'>
                                    <?php $no = 0; $row = 0;?>
                                    @foreach($mices as $mice)<?php $no++; $row++;?>
                                    @if($row == 1)
                                    <div class="row">
                                    @endif
                                    <div class="col-sm-6 col-md-4">
                                        <article class="album">
                                            <header>
                                                <?php $i = 0;$total = count($mice['photos']);?>
                                                @foreach($mice['photos'] as $photo)<?php $i++;?>
                                                <div class="mySlidesMices id_{{$no}}">
                                                    <div class="numbertext">{{$i}} / {{$total}}</div>
                                                    <img src="{{asset('/user/'.$photo->product_photo_path)}}" class="height-package img-default"
                                                        style="height:270px;" loading="lazy">
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
                                                        <img class="demoMices demo-primary id_{{$no}}"
                                                            src="{{asset('/user/'.$mice['photos'][$i-1]->product_photo_path)}}"
                                                            style="width:100%!important; height:45px!important;"
                                                            onclick="currentSlideMices({{$no}}, {{$i}});" alt="Mice" loading="lazy">
                                                        @if($i == 3)
                                                        <a href="javascript:;" onclick=" seeAllMices({{$no}})" class="seal2"
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
                                    <section class="album-info shadow bg-primary" style="height: 19rem;">
                                        <h4><b class="line-clamp-1"> {{ $mice->product_name }}</b></h4>
                                        @if(strlen($mice->product_detail) > 100)
                                        <h5 class="line-clamp-3 font-black" style="margin-bottom: 7px; height: 57px;">
                                                {{substr($mice->product_detail, 0, 100)."..."}}
                                        </h5>
                                            <a href="/details?from=mice_wedding&key={{$mice->id}}" class="font-secondary" style="font-size: 11px;"><i><u>See more description</u></i></a>
                                        @else
                                            <h5 class="line-clamp-3 font-black" style="margin-bottom: 7px; height: 57px;">{{$mice->product_detail}}</h5>
                                        @endif

                                        @if($mice->sales_inquiry == "0")
                                            <p class="price font-primary">
                                                <script>
                                                    document.write("Rp " + formatRupiah("{{$mice->product_price}}"));
                                                </script><span class="pax"> / Pax</span>
                                            </p>
                                            <form method="POST" action="/product_reservation?date_product={{$today}}&product_list={{$mice->id}}">
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn btn-holocene-gold book-reserve" style="font-weight:bold;" value="Book Now" />
                                            </form>
                                        @else
                                        @php
                                            if($mice->category == 3){
                                                $from = "mice";
                                            }
                                        @endphp
                                            <a href="/inquiry?from={{$from}}" class="btn btn-holocene-gold book-reserve"><b>Reserve Now</b></a>
                                        @endif
                                    </section>
                                    </article>
                                </div>
                                @if($row == 3 || $no == count($mices))
                                </div>
                                @php
                                    $row = 0;
                                @endphp
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    </div>
                </div>


                <div class="tab-pane" id="category-4">
                    {{-- PROMOTION --}}
                    {{-- container description --}}
                    <div class="row bg-white">
                        <div class="container">
                            <br>
                            <center>
                                <p class="black" style="margin-top:20px; margin-bottom:20px;">
                                    <span class="gold">{{$category4->page_name}}</span></p>
                            </center>
                            <center>
                                <p class="description-mw-dark">
                                    {{$category4->page_description}}
                                </p>
                            </center>
                        </div>
                    </div>
                    {{-- item album gallery --}}
                    <div class="row">
                        <div class="container">
                            <br><br>
                            <div class="gallery-env">
                                <div class="">
                                    {{-- PUT DATA IN HIDDEN FOR TRANSFER TO JS --}}
                                    <input id="promotions" type="hidden" value='@json($promotions)'>
                                    <?php $no = 0; $row = 0;?>
                                    @foreach($promotions as $promotion)<?php $no++; $row++;?>
                                    @if($row == 1)
                                    <div class="row">
                                    @endif
                                    <div class="col-sm-6 col-md-4">
                                        <article class="album">
                                            <header>
                                                <?php $i = 0;$total = count($promotion['photos']);?>
                                                @foreach($promotion['photos'] as $photo)<?php $i++;?>
                                                <div class="mySlidesPromotions id_{{$no}}">
                                                    <div class="numbertext">{{$i}} / {{$total}}</div>
                                                    <img src="{{asset('/user/'.$photo->product_photo_path)}}" class="height-package img-default"
                                                        style="height:270px;" loading="lazy">
                                                </div>
                                                @endforeach
                                                <div class="bbaris-rec">
                                                    @php $i = 0; $total = count($promotion['photos']);
                                                    if($total == 1)
                                                    {
                                                    $class = "hidden";
                                                    }else{
                                                    $class="";
                                                    }@endphp
                                                    @foreach($promotion['photos'] as $photo)@php $i++;@endphp
                                                    @if($i <= 3) <div class="column {{$class}}" style="height:80px!important;">
                                                        <img class="demoPromotions demo-primary id_{{$no}}"
                                                            src="{{asset('/user/'.$promotion['photos'][$i-1]->product_photo_path)}}"
                                                            style="width:100%!important; height:45px!important;"
                                                            onclick="currentSlidePromotions({{$no}}, {{$i}});" alt="Promotion" loading="lazy">
                                                        @if($i == 3)
                                                        <a href="javascript:;" onclick=" seeAllPromotions({{$no}})" class="seal2"
                                                            style="margin-top:-31px!important; margin-left:14px!important; font-size:8px;!important"><b>+
                                                                See All</b></a>
                                                        <img class="bblackr" src="{{asset('user/images/blck.jpg')}}"
                                                            style="width:100%; margin-top:-45px;" loading="lazy">
                                                        @endif
                                                </div>
                                                @endif
                                                @endforeach
                                    </div>
                                    </header>
                                    <section class="album-info shadow bg-primary" style="height: 19rem;">
                                        <h4><b class="line-clamp-1"> {{ $promotion->product_name }}</b></h4>
                                        @if(strlen($promotion->product_detail) > 100)
                                        <h5 class="line-clamp-3 font-black" style="margin-bottom: 7px; height: 57px;">
                                                {{substr($promotion->product_detail, 0, 100)."..."}}
                                        </h5>
                                            <a href="/wedding/{{ $promotion->product_slug }}" class="font-secondary" style="font-size: 11px;"><i><u>See more description</u></i></a>
                                        @else
                                            <h5 class="line-clamp-3 font-black" style="margin-bottom: 7px; height: 57px;">{{$promotion->product_detail}}</h5>
                                        @endif

                                        @if($promotion->sales_inquiry == "0")
                                            <p class="price font-primary">
                                                <script>
                                                    document.write("Rp " + formatRupiah("{{$promotion->product_price}}"));
                                                </script><span class="pax"> / Pax</span>
                                            </p>
                                            <form method="POST" action="/product_reservation?date_product={{$today}}&product_list={{$promotion->id}}">
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn btn-holocene-gold book-reserve" style="font-weight:bold;" value="Book Now" />
                                            </form>
                                        @else
                                        @php
                                            if($promotion->category == 4){
                                                $from = "wedding";
                                            }
                                        @endphp
                                            <a href="/inquiry?from={{$from}}" class="btn btn-holocene-gold book-reserve"><b>Reserve Now</b></a>
                                        @endif
                                    </section>
                                    </article>
                                </div>
                                @if($row == 3 || $no == count($promotions))
                                </div>
                                @php
                                    $row = 0;
                                @endphp
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>




@include('visitor_site.modal_product')


{{-- script untuk image slide album RECREATIONS--}}
<script>
    var slideIndex = 1;

    var recreations = JSON.parse($('#recreations').val());

    for (let n = 1; n <= recreations.length; n++) {
        if (recreations[n - 1]['photos'].length > 0) {
            showSlidesRecreation(n, 1);
        }
    }

    function currentSlideRecreation(id, n) {
        showSlidesRecreation(id, slideIndex = n);
    }

    function showSlidesRecreation(id, n) {
        var i;
        var slides = document.getElementsByClassName("mySlidesRecreations id_" + String(id));
        var dots = document.getElementsByClassName("demoRecreations id_" + String(id));

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
    var path = "{{env('APP_STORE')}}";
    var first = true;

    function seeAllRecreation(id) {
        var recreation = recreations[id - 1];
        var slider_for = "";
        var slider_nav = "";

        $('#modal_title').text(recreation.product_name);

        recreation['photos'].forEach(function (data, index) {
            index++;
            slider_for += '<div align="center"><img loading="lazy" class="gltop" src="' + path + "/" + data.product_photo_path +'"></div>';
            slider_nav += '<div class="sub-seeall">'+
                            '<div align="center"><img loading="lazy" class="imgslide-seeall" src="' + path + "/" + data.product_photo_path +'"></div>'+
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
        })

    }

    $('form').submit(function(){
        $(this).children('input[type=submit]').prop('disabled', true);
    });

</script>


{{-- script untuk image slide album WELLNESS --}}
<script>
    var slideIndex = 1;
    var wellnesses = JSON.parse($('#wellnesses').val());

    for (let n = 1; n <= wellnesses.length; n++) {
        if (wellnesses[n - 1]['photos'].length > 0) {
            showSlidesWellness(n, 1);
        }
    }

    function currentSlideWellness(id, n) {
        showSlidesWellness(id, slideIndex = n);
    }

    function showSlidesWellness(id, n) {
        var i;
        var slides = document.getElementsByClassName("mySlidesWellness id_" + String(id));
        var dots = document.getElementsByClassName("demoWellness id_" + String(id));

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
    function seeAllWellness(id) {
        var wellnesse = wellnesses[id - 1];
        var slider_for = "";
        var slider_nav = "";

        $('#modal_title').text(wellnesse.product_name);


        wellnesse['photos'].forEach(function (data, index) {
            index++;
            slider_for += '<div align="center"><img loading="lazy" class="gltop" src="' + path + "/" + data.product_photo_path +'"></div>';
            slider_nav += '<div class="sub-seeall">'+
                            '<div align="center"><img loading="lazy" class="imgslide-seeall" src="' + path + "/" + data.product_photo_path +'"></div>'+
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
        })
    }

    $('form').submit(function(){
        $(this).children('input[type=submit]').prop('disabled', true);
    });

</script>


{{-- script untuk image slide album MICES--}}
<script>
    var slideIndex = 1;
    var mices = JSON.parse($('#mices').val());


    // console.log(mices.length);
    for (let n = 1; n <= mices.length; n++) {
        if (mices[n - 1]['photos'].length > 0) {
            showSlidesMices(n, 1);
        }
    }

    function currentSlideMices(id, n) {
        showSlidesMices(id, slideIndex = n);
    }

    function showSlidesMices(id, n) {
        var i;
        var slides = document.getElementsByClassName("mySlidesMices id_" + String(id));
        var dots = document.getElementsByClassName("demoMices id_" + String(id));

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
    var path = "{{env('APP_STORE')}}";
    var first = true;

    function seeAllMices(id) {
        var mice = mices[id - 1];
        var slider_for = "";
        var slider_nav = "";


        $('#modal_title').text(mice.product_name);

        mice['photos'].forEach(function (data, index) {
            index++;
            slider_for += '<div align="center"><img loading="lazy" class="gltop" src="' + path + "/" + data.product_photo_path +'"></div>';
            slider_nav += '<div class="sub-seeall">'+
                            '<div align="center"><img loading="lazy" class="imgslide-seeall" src="' + path + "/" + data.product_photo_path +'"></div>'+
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
        })
    }

    $('form').submit(function(){
        $(this).children('input[type=submit]').prop('disabled', true);
    });

</script>

{{-- script untuk image slide album PROMOTIONS--}}
<script>
    var slideIndex = 1;
    var mices = JSON.parse($('#promotions').val());

    // console.log(mices.length);
    for (let n = 1; n <= mices.length; n++) {
        if (mices[n - 1]['photos'].length > 0) {
            showSlidesPromotions(n, 1);
        }
    }

    function currentSlidePromotions(id, n) {
        showSlidesPromotions(id, slideIndex = n);
    }

    function showSlidesPromotions(id, n) {
        var i;
        var slides = document.getElementsByClassName("mySlidesPromotions id_" + String(id));
        var dots = document.getElementsByClassName("demoPromotions id_" + String(id));

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
    var path = "{{env('APP_STORE')}}";
    var first = true;

    function seeAllPromotions(id) {
        var mice = mices[id - 1];
        var slider_for = "";
        var slider_nav = "";

        $('#modal_title').text(mice.product_name);

        mice['photos'].forEach(function (data, index) {
            index++;
            slider_for += '<div align="center"><img loading="lazy" class="gltop" src="' + path + "/" + data.product_photo_path +'"></div>';
            slider_nav += '<div class="sub-seeall">'+
                            '<div align="center"><img loading="lazy" class="imgslide-seeall" src="' + path + "/" + data.product_photo_path +'"></div>'+
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
        })
    }

    $('form').submit(function(){
        $(this).children('input[type=submit]').prop('disabled', true);
    });

</script>


@endsection
