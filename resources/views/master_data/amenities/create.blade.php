@extends('templates/template')
@section("header_title") AMENITIES @endsection
@section('content')
<script>
function passData(button) {
    window.idName = button.id;
    window.iconName = document.getElementById("icon"+idName).className;
    jQuery('#modal-2').modal('show');
    checkIcon(iconName);
}
</script>
<div class="col-lg-12">
    <div class="row">
        <a href="/master_data/amenities/create" class="btn btn-horison pull-right"> MANAGE AMENITIES</a>
    </div>
    <div class="row">
        <br>
        <form  method="POST"  action="{{ route('amenities.insert') }}" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="panel panel-default">
                <div class="panel-body shadow">
                    <h5><strong>All Amenities</strong></h5>
                        <div class="bungkus">
                        @if(isset($amenitiess))
                        <?php $no = 0;?>
                        @foreach($amenitiess as $amenities) <?php $no++ ;?>
                        <div class="col-lg-3 pb">
                                <div class="input-group">
                                    <span class="input-group-addon nb"><i id="icon{{$no}}" class="fa-fw {{$amenities->amenities_icon}}"></i></span>
                                    <input type="text" name ="amenities_name[]" class="form-control" value="{{$amenities->amenities_name}}" aria-label="Text input with multiple buttons">
                                    <div class="input-group-btn pl">
                                        <button onclick= "passData(this);" id="{{$no}}" type="button" class="btn btn-amenities gray" aria-label="Help">
                                            <span class="fa fa-search"></span>
                                        </button>
                                        <input type="hidden" id="input{{$no}}" name="amenities_icon[]" value ="fa fa-wifi" />
                                    </div>
                                    <div class='input-group-btn pl'>
                                        <button type='button'  onclick='' class='btn btn-amenities red remove_field'><span class='fa fa-trash'></button>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                        <input type="hidden" id="totalData" name="" value ="{{$no}}" />
                        @else
                        <div class="col-lg-3 pb">
                                <div class="input-group">
                                    <span class="input-group-addon nb"><i id="icon1" class="fa fa-wifi"></i></span>
                                    <input type="text" name ="amenities_name[]" class="form-control" aria-label="Text input with multiple buttons" required>
                                    <div class="input-group-btn pl">
                                        <button onclick= "passData(this);" id="1" type="button" class="btn btn-amenities gray" aria-label="Help">
                                            <span class="fa fa-search"></span>
                                        </button>
                                        <input type="hidden" id="input1" name="amenities_icon[]" value ="fa fa-wifi" />
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div>


                        <div class="col-lg-3">
                                <a class="add_field_button" href="#"><h5 style="color:#D4B580">+ Add New Amenities</h5></a>
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
$(document).ready(function() {

	var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $(".bungkus"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID

	var x = document.getElementById("totalData").value; //initlal text box count
	$(add_button).click(function(e){
         //on add input button click
		e.preventDefault();
		x++; //text box increment
			$(wrapper).append("<div class='col-lg-3 pb'><div class='input-group'><span class='input-group-addon nb'><i class='fa fa-wifi' id='icon"+x+"'></i></span><input type='text' name='amenities_name[]' class='form-control' aria-label='Text input with multiple buttons' required><input type='hidden' id='input"+x+"' name='amenities_icon[]' value ='fa fa-wifi' /><div class='input-group-btn pl'><button type='button' onclick='passData(this);'  class='btn btn-amenities gray' id='"+x+"' aria-label='Help'><span class='fa fa-search'></span></button></div><div class='input-group-btn pl'><button type='button'  onclick='' class='btn btn-amenities red remove_field'><span class='fa fa-trash'></button></div></div></div>"); //add input box
	});

	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); x--;
    });




});
</script>

@endsection
