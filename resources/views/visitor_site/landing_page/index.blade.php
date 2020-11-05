@extends('templates/visitor_template')
@section('content')

<br><br><br>

<div class="row lp-row-1 ipad-lp" style="margin-bottom:80px;">
    <div class="col-md-8">
        <?php $no = 0;?>
        @foreach($banners as $banner)<?php $no++ ;?>
            @if($banner->banner_status != "4")
            <div class="mySlides">
                <div class="numbertext">{{$no}} / 3</div>
                <img src="{{asset('/user/'.$banner->banner_name)}}" class="uwaw height-banner">
            </div>
            @endif
        @endforeach
        <div class="bbaris2">
            <?php $no = 0;?>
            @foreach($banners->take(3) as $banner) <?php $no++ ;?>
            @if($banner->banner_status != "4")
            <div class="column">
                <img class="demo cursor height2-banner" src="{{asset('/user/'.$banner->banner_name)}}" onclick="currentSlide({{$no}})"
                    alt="Banner">
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <div class="col-md-4" align="center">
        <p class="black-unset lp-title-1">
            YOUR <span class="gold">PERFECT<br><br>DESTINATION</span> IS ON</p>
        <p class="description-lp-dark">
            Commited to your satisfactory, we invite you to have the best experience at Kuningan, Horison Tirta Sanita.
        </p>
        <button class="btn btn-horison btn-lg reserveNow btn-rn-dekstop"><b>Reserve Now</b></button>
    </div>

</div>

<div class="row landing-page-bg">
    <div class="container landing-page-bg">
        <div class="row landing-page-mobile" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-sm-5 col-md-5">
                <p class="white lp-title-2" style="margin-top:85px; margin-bottom:25px;">
                    MAKE <span class="gold">THE MOST</span><br><br> OF YOUR STAY</p>
                <p class="description-lp-white">
                    While enjoying Ciremai Mountain View and our occomodation that consist of
                    International TV Chanel, Indonesia Native Cuisine and other Horison Tirta Sanita
                    Hotel Facilities
                </p>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 align-landing">
                {{-- atas --}}
                <a>
                    <img src="{{asset('/images/landing-page/massage-spa-sm.jpg')}}" class="news-second shadow" />
                </a>
                <p class="description-lp-white-2">
                    Relax your body and soul after a long day activity with traditional
                    massage handled by our professional masseur, sauna and volcanic bath
                </p>
                <a href="visitor/allysea_spa" class="btn btn-horison-visitor"><b>Explore Allysea A Spa</b></a>
                <br><br><br>
                {{-- bawah --}}
                <a>
                    <img src="{{asset('/images/landing-page/meet-room-sm.jpg')}}" class="news-second shadow" />
                </a>
                <p class="description-lp-white-2">
                    9 Elegant Minimalist Meetings Rooms that ideal for your ideas. Conference,
                    seminar, exhibiiton and other activities fully equip to accomodate your needs.
                </p>
                <a href="visitor/function_room" class="btn btn-horison-visitor"><b>Explore Function Room</b></a>
            </div>

            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 align-landing" style="margin-top:35px;">
                {{-- atas --}}
                <a>
                    <img src="{{asset('/images/landing-page/wedding-ring-sm.jpg')}}" class="news-second shadow" />
                </a>
                <p class="description-lp-white-3">
                    Take it slow or take it fast with your soulmate.
                    Focus on your happiness and let us handle the rest.
                </p>
                <a href="visitor/mice_wedding" class="btn btn-horison-visitor"><b>Explore MICE & Wedding</b></a>
                <br><br><br>
                {{-- bawah --}}
                <a>
                    <img src="{{asset('/images/landing-page/team-build-sm.jpg')}}" class="news-second shadow" />
                </a>
                <p class="description-lp-white-3">
                    Outdoor activites to achieve a better means of Team Building,
                    contribute yourself in a long run, as and individual and as a Team.
                </p>
                <a href="visitor/recreation" class="btn btn-horison-visitor"><b>Explore Recreational</b></a>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="container">
        <center>
            <p class="black" style="margin-top:20px; margin-bottom:40px;">GET <span class="gold">MORE</span> UPDATES</p>
        </center>

        <div class="gallery-env">
            <div class="row">
                <?php $no = 0;?>
                @foreach($newss as $news) <?php $no++ ;?>
                <input type="hidden" id="title_{{$no}}" value="{{$news->news_title}}">
                <input type="hidden" id="content_{{$no}}" value="{{$news->news_content}}">
                <input type="hidden" id="gambar_{{$no}}" value="{{asset('/user/'.$news->news_photo_path)}}">
                @if ($no == 1)
                <div class="col-sm-6">
                    <article class="album">
                        <header>
                                <img class="news-first" src="{{asset('/user/'.$news->news_photo_path)}}" />
                        </header>
                        <section class="album-info shadow" style="">
                            <a href="/visitor/news_detail/{{$news->id}}"><h4 style="height: 35px; line-height: normal;"><b>{{$news->news_title}}<b></h4></a>

                            <p style="font-size:12px;">{{$news->news_publish_date}}</p>
                        </section>
                    </article>
                </div>
                @if($no == count($newss))
            </div>
            @endif
            @elseif ($no > 1 && $no <= 5) <div class="col-sm-3">
                <article class="album">
                    <header>
                        <img src="{{asset('/user/'.$news->news_photo_path)}}" class="news-second" />
                    </header>
                    <section class="album-info shadow">
                        <a href="/visitor/news_detail/{{$news->id}}">
                            <h4 style="height:45px; line-height: normal;"><b>{{$news->news_title}}<b></h4>
                        </a>
                        <p style="font-size:12px; margin-top:0px !important;">{{$news->news_publish_date}}</p>
                    </section>
                </article>
        </div>
        @if($no == count($newss) || $no == 5)
        </div>
        @endif
        @endif
        @endforeach

        </div>
    </div>
</div>

<script>
    //MODAL EXPORT TO PDF BUTTON//
    $(document).on('click', '.reserve_modal', function () {
        $('#modal_reserve_button').modal("show");
    });
</script>

<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");

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
</script>
@endsection
