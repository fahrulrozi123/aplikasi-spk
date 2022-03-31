@extends('templates/template')
@section('header_title')
    AMENITIES
@endsection
@section('content')
    @php
    $path = asset('/icon-pack/') . '/';
    $stock = 'shapes.svg';
    @endphp
    <div class="col-lg-12">
        <input type="hidden" id="activeRow" value="no-edit">

        <div class="row" id="no-edit">
            <div class="row">
                <div class="col-md-12">
                    <button onclick="showRow();" class="btn btn-horison btn-lg pull-right"><b>MANAGE AMENITIES</b></button>
                </div>
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-body shadow">
                    @if (count($amenitiess) > 0)
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 col-md-12">
                                <h5><strong>All Amenities</strong></h5>
                                <?php $no = 0; ?>
                                @foreach ($amenitiess as $amenities)
                                    <?php $no++; ?>
                                    <div class="col-xs-12 col-lg-4 col-md-4" style="display: flex; margin-bottom: 10px;">
                                        <svg width="17px" height="17px" class="horison-icon">
                                            {!! file_get_contents($path . $amenities->amenities_icon, false, stream_context_create($arrContextOptions)) !!}
                                        </svg>
                                        <h5 style="margin:0px!important">&nbsp;&nbsp;{{ $amenities->amenities_name }}</h5>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="center" style="margin-top: 10vh;">
                                <img src="{{ asset('/images/dashboard/amenities_empty_data.png') }}" alt="No Data"
                                    class="center" style="margin-top: 0px; margin-bottom: 10px;">
                                <center>
                                    <h4>You don’t have any Amenities to show</h4>
                                </center>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row hidden" id="edit">
            <div class="row">
                <div class="col-md-12">
                    <button onclick="showRow();" class="btn btn-horison btn-lg pull-right"><b>ALL AMENITIES</b></button>
                </div>
            </div>
            <br>
            <form method="POST" action="{{ route('amenities.insert') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-body shadow">
                        <h5><strong>All Amenities</strong></h5>
                        <div class="bungkus">
                            @if (isset($amenitiess))
                                <?php $no = 0; ?>
                                @foreach ($amenitiess as $amenities)
                                    <?php $no++; ?>
                                    <div class="col-lg-3 pb">
                                        <div class="input-group">
                                            <input type="hidden" name="amenities_id[]" class="form-control"
                                                value="{{ $amenities->id }}">
                                            <input id="amenities_{{ $no }}" type="hidden"
                                                name="amenities_status[]" class="form-control" value="1">
                                            <span class="input-group-addon nb" style="width: 40px; min-width: 24px;">
                                                <svg id="icon{{ $no }}" width="17px" height="17px"
                                                    class="horison-icon">
                                                    {!! file_get_contents($path . $amenities->amenities_icon, false, stream_context_create($arrContextOptions)) !!}
                                                </svg>
                                            </span>
                                            <input type="text" name="amenities_name[]" class="form-control"
                                                value="{{ $amenities->amenities_name }}"
                                                aria-label="Text input with multiple buttons" maxlength="30" required>
                                            <div class="input-group-btn pl">
                                                <button
                                                    onclick="passData('{{ $amenities->amenities_icon }}','{{ $no }}');"
                                                    type="button" class="btn btn-amenities gray" aria-label="Help">
                                                    <span class="fa fa-search"></span>
                                                </button>
                                                <input type="hidden" id="input{{ $no }}" name="amenities_icon[]"
                                                    value="{{ $amenities->amenities_icon }}" />
                                            </div>
                                            <div class='input-group-btn pl'>
                                                <button type='button' onclick=''
                                                    class='btn btn-amenities red remove_field'><span
                                                        class='fa fa-trash'></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <input type="hidden" id="totalData" name="" value="{{ $no }}" />
                            @else
                                <div class="col-lg-3 pb">
                                    <div class="input-group">
                                        <input type="hidden" name="amenities_id[]" class="form-control" value="X">
                                        <input id="amenities_{{ $no }}" type="hidden" name="amenities_status[]"
                                            class="form-control" value="3">
                                        <span class="input-group-addon nb"><img id="icon1" src="{{ $path . $stock }}"
                                                style="height:17px;width:17px;"></span>
                                        <input type="text" name="amenities_name[]" class="form-control"
                                            aria-label="Text input with multiple buttons" maxlength="30" required>
                                        <div class="input-group-btn pl">
                                            <button onclick="passData(this);" id="1" type="button"
                                                class="btn btn-amenities gray" aria-label="Help">
                                                <span class="fa fa-search"></span>
                                            </button>
                                            <input type="hidden" id="input1" name="amenities_icon[]"
                                                value="{{ $stock }}" />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-12">
                            <br>
                            <a class="add_field_button" href="#">
                                <h5 class="bg-quaternary">+ Add New Amenities</h5>
                            </a>
                        </div>
                        <div class="col-lg-12">
                            <br>
                            <input type="submit" value="SAVE" class="btn btn-horison2 btn-lg pull-right"></button>
                        </div>
                        @include('master_data.amenities.modal')
                    </div>
                </div>
            </form>
        </div>

    </div>


    <script>
        function showRow() {
            var activeRow = document.getElementById("activeRow");

            if (activeRow.value == "no-edit") {
                document.getElementById("no-edit").classList.add("hidden");
                document.getElementById("edit").classList.remove("hidden");
                activeRow.value = "edit";
            } else {
                document.getElementById("no-edit").classList.remove("hidden");
                document.getElementById("edit").classList.add("hidden");
                activeRow.value = "no-edit";
            }
        }
    </script>

    <script>
        function passData(iconName, id) {
            window.idName = id;
            jQuery('#modal-2').modal('show');
            checkIcon(iconName);
        }
    </script>

    <script>
        $(document).ready(function() {

            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".bungkus"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = (document.getElementById("totalData") == null) ? 0 : document.getElementById("totalData")
                .value; //initlal text box count
            $(add_button).click(function(e) {
                //on add input button click
                e.preventDefault();
                x++; //text box increment
                $(wrapper).append(
                    "<div class='col-lg-3 pb'><div class='input-group'><span class='input-group-addon nb' style='width: 40px;min-width: 24px;'><img id = 'icon" +
                    x + "' src='{{ $path . $stock }}' style='height:17px;width:17px;'>" +
                    "</span><input id='amenities_" + x +
                    "' type='hidden' name='amenities_id[]' value='X'><input type='text' name='amenities_name[]' class='form-control' aria-label='Text input with multiple buttons' maxlength='30' required><input id='amenities_" +
                    x +
                    "' type='hidden' name='amenities_status[]' value='3'><input type='hidden' id='input" +
                    x +
                    "' name='amenities_icon[]' value ='{{ $stock }}' /><div class='input-group-btn pl'><button type='button' onclick='passData(\"{{ $stock }}\", \"" +
                    x + "\");'  class='btn btn-amenities gray' id='" +
                    x +
                    "' aria-label='Help'><span class='fa fa-search'></span></button></div><div class='input-group-btn pl'><button type='button'  onclick='' class='btn btn-amenities red remove_field'><span class='fa fa-trash'></button></div></div></div>"
                ); //add input box
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').parent('div').parent('div').remove();
                x--;
            });
        });
    </script>

@endsection
