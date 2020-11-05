@extends('templates/visitor_template')
@section('content')
<br><br>

<div class="container">

    <ol class="breadcrumb bc-3" style="font-size:13px;">
        <li>
            <a href="/visitor/mice_wedding"><span class="entypo-left-open"></span>Back</a>
        </li>
    </ol>

    {{-- HEADER --}}
    <h1 class="mt mb title-roomsdetail" style="text-transform: uppercase;"><label>Non Residential Package</label></h1>
    <br>
    <div class="slider-for">
        <div align="center"><img class="imgslide1-roomsdetail" src="{{asset('/images/wedding-ring.jpg')}}"></div>
        <div align="center"><img class="imgslide1-roomsdetail" src="{{asset('/images/visitor-mw-2.jpg')}}"></div>
        <div align="center"><img class="imgslide1-roomsdetail" src="{{asset('/images/visitor-mw-1.jpg')}}"></div>
        <div align="center"><img class="imgslide1-roomsdetail" src="{{asset('/images/wa-image1.jpeg')}}"></div>
    </div>
    <br>
    <div class="slider-nav" style="padding:20px;">
        <div align="center"><img class="imgslide2-roomsdetail" src="{{asset('/images/wedding-ring.jpg')}}"></div>
        <div align="center"><img class="imgslide2-roomsdetail" src="{{asset('/images/visitor-mw-2.jpg')}}"></div>
        <div align="center"><img class="imgslide2-roomsdetail" src="{{asset('/images/visitor-mw-1.jpg')}}"></div>
        <div align="center"><img class="imgslide2-roomsdetail" src="{{asset('/images/wa-image1.jpeg')}}"></div>
    </div>
    <br>
     
    {{-- DESCRIPTION --}}
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
    Dapibus ultrices in iaculis nunc sed augue lacus. Quam nulla porttitor massa id neque aliquam. Ultrices mi tempus imperdiet 
    nulla malesuada. Eros in cursus turpis massa tincidunt dui ut ornare lectus. Egestas sed sed risus pretium. Lorem dolor sed 
    viverra ipsum. Gravida rutrum quisque non tellus. Rutrum tellus pellentesque eu tincidunt tortor. Sed blandit libero volutpat 
    sed cras ornare. Et netus et malesuada fames ac. Ultrices eros in cursus turpis massa tincidunt dui ut ornare. Lacus sed viverra 
    tellus in. Sollicitudin ac orci phasellus egestas. Purus in mollis nunc sed. Sollicitudin ac orci phasellus egestas tellus rutrum 
    tellus pellentesque. Interdum consectetur libero id faucibus nisl tincidunt eget.

</div>



<script type="text/javascript">
    $(document).ready(function(){
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
            centerMode: true,
            focusOnSelect: true
        });
    });
</script>




@endsection
