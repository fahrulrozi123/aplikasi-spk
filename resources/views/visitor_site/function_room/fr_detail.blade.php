@extends('templates/visitor_template')
@section('content')
<br><br>

<div class="container">

    <ol class="breadcrumb bc-3" style="font-size:13px;">
        <li>
            <a href="/visitor/function_room"><span class="entypo-left-open"></span>Back</a>
        </li>
    </ol>

    {{-- HEADER --}}
    <h1 class="mt mb title-roomsdetail" style="text-transform: uppercase;"><label>Test Function Room</label></h1>
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

    <br><br>

    {{-- DETAIL MAIN ROOM CAPACITY --}}
    <h2>Function Main Room Capacity</h2>
    <div class="row" align="center">
        <div class="col-md-12">

            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-Classroom.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">Class Room</p>
                    <p class="fr-modal-pax" id ="fr_class">100 Pax</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-Theatre.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">Theatre</p>
                    <p class="fr-modal-pax" id ="fr_theatre">100 Pax</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-UShape.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">U-Shape</p>
                    <p class="fr-modal-pax" id ="fr_ushape">100 Pax</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-Boardroom.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">Board Room</p>
                    <p class="fr-modal-pax" id ="fr_board">100 Pax</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-RoundTable.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">Round Table</p>
                    <p class="fr-modal-pax" id ="fr_round">100 Pax</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-Dimension.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">Dimension</p>
                    <p class="fr-modal-pax" id ="fr_dimension">100 Sqm</p>
                </div>
            </div>
        </div>
    </div>

    <br>

    {{-- DETAIL PARTITION ROOM CAPACITY --}}
    <h2>Function Partition Room Capacity</h2>
    <div class="row">
        <div class="col-md-12">

        <div style="overflow-x:auto;">
          <table class="table table-bordered responsive">
            <thead>
              <tr>
                <th class="fr-modal-table-title">Partition Name</th>
                <th class="fr-modal-table-title">Dimension (Sqm)</th>
                <th class="fr-modal-table-title">Class Room (Pax)</th>
                <th class="fr-modal-table-title">Theatre (Pax)</th>
                <th class="fr-modal-table-title">U-Shape (Pax)</th>
                <th class="fr-modal-table-title">Board Room (Pax)</th>
                <th class="fr-modal-table-title">Round Table (Pax)</th>
              </tr>
            </thead>
            <tbody id="partition_table-body">
            </tbody>
          </table>
        </div>

        </div>
      </div>

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
