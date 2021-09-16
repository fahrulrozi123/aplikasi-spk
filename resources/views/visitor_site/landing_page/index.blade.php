@extends('templates/visitor_template')

@section('description', 'Commited to your satisfactory, we invite you to have the best experience at Horison Ultima Bandung. While enjoying Bandung view and our occomodation that consist of International TV Chanel, Indonesia native cuisine and other facilities.')
@section('keywords', 'Horison Ultima Bandung, Horison, Ultima, Bandung, Hotel')
@section('title', 'World Class Hospitality with Indonesian Authenticity')

@section('content')

<br><br><br>

<div class="row lp-row-1 ipad-lp" style="margin-bottom:80px;">
    <div class="col-md-8">
        <?php $no = 0;?>
        @foreach($banners as $banner)<?php $no++ ;?>
            @if($banner->banner_status != "4")
            <div class="mySlides">
                <div class="numbertext">{{$no}} / 3</div>
                <img src="{{asset('/user/'.$banner->banner_name)}}" class="uwaw height-banner" loading="lazy">
            </div>
            @endif
        @endforeach
        <div class="bbaris2">
            <?php $no = 0;?>
            @foreach($banners->take(3) as $banner) <?php $no++ ;?>
            @if($banner->banner_status != "4")
            <div class="column">
                <img class="demo cursor height2-banner" src="{{asset('/user/'.$banner->banner_name)}}" onclick="currentSlide({{$no}})" alt="Horison Ultima Bandung" loading="lazy">
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <div class="col-md-4" align="center">
        <p class="black-unset lp-title-1">
            YOUR <span class="gold">PERFECT<br><br>DESTINATION</span> IS ON</p>
        <p class="description-lp-dark">
            Commited to your satisfactory, we invite you to have the best experience at Bandung, Horison Ultima Bandung.
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
                    While enjoying Bandung View and our occomodation that consist of
                    International TV Chanel, Indonesia Native Cuisine and other Horison Ultima Bandung
                    Hotel Facilities.
                </p>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 align-landing">
                {{-- atas --}}
                @foreach ($spas as $spa)
                    @foreach($spa->photo->take(1) as $photo)
                        <a><img src="{{ asset('/user/'.$photo->photo_path) }}" class="news-second shadow" alt="{{ $spa->page_name }}" loading="lazy" /></a>
                    @endforeach
                    <p class="description-lp-white-2">
                        {{ $spa->page_description }}
                    </p>
                    <a href="wellness" class="btn btn-horison-visitor"><b>Explore {{ $spa->page_name }}</b></a>
                    <br><br><br>
                @endforeach

                {{-- bawah --}}
                @foreach ($functionrooms as $functionroom)
                    @foreach($functionroom->photo->take(1) as $photo)
                        <a><img src="{{ asset('/user/'.$photo->photo_path) }}" class="news-second shadow" alt="{{ $functionroom->page_name }}" loading="lazy" /></a>
                    @endforeach
                    <p class="description-lp-white-2">
                        {{ $functionroom->page_description }}
                    </p>
                    <a href="function-room" class="btn btn-horison-visitor"><b>Explore {{ $functionroom->page_name }}</b></a>
                @endforeach
            </div>

            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 align-landing" style="margin-top:35px;">
                {{-- atas --}}
                @foreach ($mices as $mice)
                    @foreach($mice->photo->take(1) as $photo)
                        <a><img src="{{ asset('/user/'.$photo->photo_path) }}" class="news-second shadow" alt="{{ $mice->page_name }}" loading="lazy" /></a>
                    @endforeach
                    <p class="description-lp-white-3">
                        {{ $mice->page_description }}
                    </p>
                    <a href="mice" class="btn btn-horison-visitor"><b>Explore {{ $mice->page_name }}</b></a>
                    <br><br><br>
                @endforeach

                {{-- bawah --}}
                @foreach ($recreations as $recreation)
                    @foreach($recreation->photo->take(1) as $photo)
                        <a><img src="{{ asset('/user/'.$photo->photo_path) }}" class="news-second shadow" alt="{{ $recreation->page_name }}" loading="lazy" /></a>
                    @endforeach
                    <p class="description-lp-white-3">
                        {{ $recreation->page_description }}
                    </p>
                    <a href="recreation" class="btn btn-horison-visitor"><b>Explore {{ $recreation->page_name }}</b></a>
                @endforeach
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
                            <img class="news-first" src="{{asset('/user/'.$news->news_photo_path)}}" loading="lazy" />
                        </header>
                        <section class="album-info shadow" style="">
                            <a href="/news_detail/{{$news->id}}"><h4 style="height: 35px; line-height: normal;"><b>{{$news->news_title}}<b></h4></a>

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
                        <img src="{{asset('/user/'.$news->news_photo_path)}}" class="news-second" loading="lazy" />
                    </header>
                    <section class="album-info shadow">
                        <a href="/news_detail/{{$news->id}}">
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
