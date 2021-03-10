@extends('templates/visitor_template')
@section('content')
<br><br>

<div id="image_slide" class="container" style="display: none">

    <ol class="breadcrumb bc-3" style="font-size:13px;">
        <li>
            <a href="/{{$from}}"><span class="entypo-left-open"></span>Back</a>
        </li>
    </ol>

    {{-- DETAIL HEADER --}}
    <h1 class="mt mb title-roomsdetail" style="text-transform: uppercase;"><label>{{$data->name}}</label></h1>
    <br>
    <div class="slider-for">
        @foreach ($photos as $photo)
        <div align="center"><img class="imgslide1-roomsdetail" src="{{asset('/user/'.$photo->photo_path)}}"></div>
        @endforeach
    </div>
    <br>
    <div class="slider-nav" style="padding:20px;">
        @if(count($photos) > 1)
        @foreach ($photos as $photo)
        <div align="center"><img class="imgslide2-roomsdetail" src="{{asset('/user/'.$photo->photo_path)}}"></div>
        @endforeach
        @endif
    </div>
    <br>

    {{-- DESCRIPTION --}}
    {{$data->detail}}

    <br><br>

    {{-- DETAIL MAIN ROOM CAPACITY --}}
    @if(isset($data->function))
    @php
    $function = $data->function;
    @endphp
    <h2>Function Main Room Capacity</h2>
    <div class="row" align="center">
        <div class="col-md-12">

            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon fr-icon-pt0 horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-Classroom.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">Class Room</p>
                    <p class="fr-modal-pax" id="fr_class">{{$function->func_class}} Pax</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon fr-icon-pt0 horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-Theatre.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">Theatre</p>
                    <p class="fr-modal-pax" id="fr_theatre">{{$function->func_theatre}} Pax</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon fr-icon-pt0 horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-UShape.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">U-Shape</p>
                    <p class="fr-modal-pax" id="fr_ushape">{{$function->func_ushape}} Pax</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon fr-icon-pt0 horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-Boardroom.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">Board Room</p>
                    <p class="fr-modal-pax" id="fr_board">{{$function->func_board}} Pax</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon fr-icon-pt0 horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-RoundTable.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">Round Table</p>
                    <p class="fr-modal-pax" id="fr_round">{{$function->func_round}} Pax</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="row fr-modal-box" align="center">
                    <div class="fr-icon fr-icon-pt0 horison-icon" style="text-align: center;">
                        {!! file_get_contents(asset('/images/function-room/FR-Dimension.svg', false, stream_context_create($arrContextOptions))) !!}
                    </div>
                    <p class="fr-modal-name">Dimension</p>
                    <p class="fr-modal-pax" id="fr_dimension">{{$function->func_dimension}} Sqm</p>
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
                        @foreach($function['partition'] as $partition)
                        <tr>
                            <th class="fr-modal-table-title">{{$partition->func_name}}</th>
                            <th class="fr-modal-table-title">{{$partition->func_dimension}} (Sqm)</th>
                            <th class="fr-modal-table-title">{{$partition->func_class}} (Pax)</th>
                            <th class="fr-modal-table-title">{{$partition->func_theatre}} (Pax)</th>
                            <th class="fr-modal-table-title">{{$partition->func_ushape}} (Pax)</th>
                            <th class="fr-modal-table-title">{{$partition->func_board}} (Pax)</th>
                            <th class="fr-modal-table-title">{{$partition->func_round}} (Pax)</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @endif

    <br><br>

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
