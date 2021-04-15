@extends('templates/visitor_template')

@section('description', 'Wedding Horison Ultima Bandung. Booking dari website kami untuk dapatkan harga terbaik!')
@section('keywords', 'Wedding Horison Ultima Bandung, Wedding')
@section('title', 'Wedding')

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

{{-- image slide header --}}
<div class="row ipad-slideimg">
    <div class="slider-custom" id="slider1">
        <!-- Slides -->
        @foreach ($pagesettings as $pagesetting)
            @foreach($pagesetting->photo->take(2) as $photo)
                <div style="background-image:url('{{ asset('/user/'.$photo->photo_path) }}'); opacity:0.5;"></div>
            @endforeach
        @endforeach
        <!-- The Arrows -->
        <i class="left" class="arrows" style="z-index:2; position:absolute;">
            <svg viewBox="0 0 100 100">
                <path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z"></path>
            </svg>
        </i>
        <i class="right" class="arrows" style="z-index:2; position:absolute;">
            <svg viewBox="0 0 100 100">
                <path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z"
                    transform="translate(100, 100) rotate(180) "></path>
            </svg>
        </i>
    </div>
</div>

{{-- container description --}}
<div class="row bg-secondary">
    <div class="container">
        <br>
        <center>
            <p class="black" style="margin-top:20px; margin-bottom:20px;">NOT <span class="gold">ONLY A PLACES</span>
            </p>
        </center>
        <center>
            <p class="description-mw-dark">
                Meetings, Business Trip and Wedding not like any others. Plan your activities with many our facilities
                at<br>
                Horison Ultima Bandung.
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
                            <div class="mySlides1 id_{{$no}}">
                                <div class="numbertext">{{$i}} / {{$total}}</div>
                                <img src="{{asset('/user/'.$photo->product_photo_path)}}" class="height-package uwaw"
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
                                    <img class="demo1 id_{{$no}}"
                                        src="{{asset('/user/'.$mice['photos'][$i-1]->product_photo_path)}}"
                                        style="width:100%!important; height:45px!important;"
                                        onclick="currentSlide({{$no}}, {{$i}});" alt="Wedding" loading="lazy">
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
                    <h4><b class="line-clamp-1"> {{ $mice->product_name }}</b></h4>
                    @if(strlen($mice->product_detail) > 100)
                    <h5 class="line-clamp-3" style="margin-bottom: 7px; height: 57px;">
                            {{substr($mice->product_detail, 0, 100)."..."}}
                    </h5>
                        <a href="/details?from=mice_wedding&key={{$mice->id}}" class="font-secondary" style="font-size: 11px;"><i><u>See more description</u></i></a>
                    @else
                        <h5 class="line-clamp-3" style="margin-bottom: 7px; height: 57px;">{{$mice->product_detail}}</h5>
                    @endif

                    @if($mice->sales_inquiry == "0")
                        <p class="price">
                            <script>
                                document.write("Rp " + formatRupiah("{{$mice->product_price}}"));
                            </script><span class="pax"> / Pax</span>
                        </p>
                        <form method="POST" action="/product_reservation?date_product={{$today}}&product_list={{$mice->id}}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-horison-gold book-reserve" style="font-weight:bold;" value="Book Now" />
                        </form>
                    @else
                    @php
                        if($mice->category == 4){
                            $from = "wedding";
                        }
                    @endphp
                        <a href="/inquiry?from={{$from}}" class="btn btn-horison-gold book-reserve"><b>Reserve Now</b></a>
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
@include('visitor_site.modal_product')


{{-- script untuk image slide header --}}
<script>
    (function ($) {
        "use strict";
        $.fn.sliderResponsive = function (settings) {

            var set = $.extend({
                slidePause: 5000,
                fadeSpeed: 800,
                autoPlay: "on",
                showArrows: "off",
                hideDots: "off",
                hoverZoom: "on",
                titleBarTop: "off"
            },
                settings
            );

            var $slider = $(this);
            var size = $slider.find("> div").length; //number of slides
            var position = 0; // current position of carousal
            var sliderIntervalID; // used to clear autoplay

            // Add a Dot for each slide
            $slider.append("<ul></ul>");
            $slider.find("> div").each(function () {
                $slider.find("> ul").append('<li></li>');
            });

            // Put .show on the first Slide
            $slider.find("div:first-of-type").addClass("show");

            // Put .showLi on the first dot
            $slider.find("li:first-of-type").addClass("showli")

            //fadeout all items except .show
            $slider.find("> div").not(".show").fadeOut();

            // If Autoplay is set to 'on' than start it
            if (set.autoPlay === "on") {
                startSlider();
            }

            // If showarrows is set to 'on' then don't hide them
            if (set.showArrows === "on") {
                $slider.addClass('showArrows');
            }

            // If hideDots is set to 'on' then hide them
            if (set.hideDots === "on") {
                $slider.addClass('hideDots');
            }

            // If hoverZoom is set to 'off' then stop it
            if (set.hoverZoom === "off") {
                $slider.addClass('hoverZoomOff');
            }

            // If titleBarTop is set to 'on' then move it up
            if (set.titleBarTop === "on") {
                $slider.addClass('titleBarTop');
            }

            // function to start auto play
            function startSlider() {
                sliderIntervalID = setInterval(function () {
                    nextSlide();
                }, set.slidePause);
            }

            // on mouseover stop the autoplay
            $slider.mouseover(function () {
                if (set.autoPlay === "on") {
                    clearInterval(sliderIntervalID);
                }
            });

            // on mouseout starts the autoplay
            $slider.mouseout(function () {
                if (set.autoPlay === "on") {
                    startSlider();
                }
            });

            //on right arrow click
            $slider.find("> .right").click(nextSlide)

            //on left arrow click
            $slider.find("> .left").click(prevSlide);

            // Go to next slide
            function nextSlide() {
                position = $slider.find(".show").index() + 1;
                if (position > size - 1) position = 0;
                changeCarousel(position);
            }

            // Go to previous slide
            function prevSlide() {
                position = $slider.find(".show").index() - 1;
                if (position < 0) position = size - 1;
                changeCarousel(position);
            }

            //when user clicks slider button
            $slider.find(" > ul > li").click(function () {
                position = $(this).index();
                changeCarousel($(this).index());
            });

            //this changes the image and button selection
            function changeCarousel() {
                $slider.find(".show").removeClass("show").fadeOut();
                $slider
                    .find("> div")
                    .eq(position)
                    .fadeIn(set.fadeSpeed)
                    .addClass("show");
                // The Dots
                $slider.find("> ul").find(".showli").removeClass("showli");
                $slider.find("> ul > li").eq(position).addClass("showli");
            }

            return $slider;
        };
    })(jQuery);

    //////////////////////////////////////////////
    // Activate each slider - change options
    //////////////////////////////////////////////
    $(document).ready(function () {

        $("#slider1").sliderResponsive({
            // Using default everything
            // slidePause: 5000,
            // fadeSpeed: 800,
            // autoPlay: "on",
            // showArrows: "off",
            // hideDots: "off",
            // hoverZoom: "on",
            // titleBarTop: "off"
        });

        $("#slider2").sliderResponsive({
            fadeSpeed: 300,
            autoPlay: "off",
            showArrows: "on",
            hideDots: "on"
        });

        $("#slider3").sliderResponsive({
            hoverZoom: "off",
            hideDots: "on"
        });

    });

</script>


{{-- script untuk image slide album --}}
<script>
    var slideIndex = 1;
    var mices = JSON.parse($('#mices').val());

    // console.log(mices.length);
    for (let n = 1; n <= mices.length; n++) {
        if (mices[n - 1]['photos'].length > 0) {
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
        if(first){
            first = false;
        }else{
            $('.slider-for').slick('unslick');
            $('.slider-nav').slick('unslick');
        }
        do_slider();
    }

    $('form').submit(function(){
        $(this).children('input[type=submit]').prop('disabled', true);
    });

</script>
@endsection
