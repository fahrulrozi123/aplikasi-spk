@extends('templates/visitor_template')

@section('description', $data->title . ' Horison Ultima Bandung. Booking dari website kami untuk dapatkan harga terbaik!')
@section('keywords', $data->title . ' Horison Ultima Bandung')
@section('title', $data->title)

@section('content')
<div id="image_slide" class="container" style="display: none; margin-top: 30px; margin-bottom: 30px;">
    <ol class="breadcrumb bc-3" style="font-size:13px;">
        <li>
            <a href="{{ route('visitor.package_reservation') }}"><span class="entypo-left-open"></span>Back</a>
        </li>
    </ol>

    {{-- DETAIL HEADER --}}
    <h1 class="mt mb title-roomsdetail" style="text-transform: uppercase;">
        <label>{{ $data->name }}</label>
    </h1>

    <br>
    <div class="slider-for">
        @foreach ($photos as $photo)
            <div align="center">
                <img class="imgslide1-roomsdetail" src="{{ asset('/user/'.$photo->photo_path) }}" alt="{{ $data->title }}">
            </div>
        @endforeach
    </div>
    <br>
    <div class="slider-nav" style="padding: 20px;">
        @if(count($photos) > 1)
            @foreach ($photos as $photo)
                <div align="center">
                    <img class="imgslide2-roomsdetail" src="{{ asset('/user/'.$photo->photo_path) }}" alt="{{ $data->title }}">
                </div>
            @endforeach
        @endif
    </div>
    <br>

    {{-- DESCRIPTION --}}
    <p class="font-primary" style="text-transform: uppercase; font-weight: bold;">Description</p>
    <p>{!! $data->detail !!}<p>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            focusOnSelect: true
        });
    });
    $('#image_slide').fadeIn('slow');
</script>
@endsection
