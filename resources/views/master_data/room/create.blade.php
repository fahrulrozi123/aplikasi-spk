@extends('templates/template')
@section("header_title") ROOMS @endsection
@section('content')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
@if(isset($room))
@php
$room_amenitites = $room['amenitites'];
$id = Crypt::encryptString($room->id);
$room_name = $room->room_name;
$room_desc = $room->room_desc;
$bed1 = "";
$bed2 = "";
$bed3 = "";
foreach($room['bed'] as $bed_type){
    switch($bed_type->bed_id){
        case "0":
        $bed1 = "checked";
        break;
        case "1":
        $bed3 = "checked";
        break;
        case "2":
        $bed2 = "checked";
        break;
    }
}

if(!isset($amenities)){
$checked="";
}
$room_allotment = $room->room_allotment;
$room_publish_rate = $room->room_publish_rate;
$room_ro_rate = $room->room_ro_rate;
$room_weekend_rate = $room->room_weekend_rate;
$room_weekend_ro_rate = $room->room_weekend_ro_rate;
$room_extrabed_rate = $room->room_extrabed_rate;
$room_future_availability = $room->room_future_availability;
$room_order = $room->room_order;
@endphp

@else

@php
$id = "";
$room_name = "";
$room_desc = "";
$bed1 = "checked";
$bed2 = "";
$bed3 = "";
$room_allotment = "10";
$room_publish_rate = "1000000";
$room_ro_rate = "1000000";
$room_weekend_rate = "1000000";
$room_weekend_ro_rate = "1000000";
$room_extrabed_rate = "200000";
$room_future_availability="0";
$room_order = "";
@endphp

@endif

<div class="col-lg-12">
    <div class="row">
        <form id="delete_room" onsubmit="return confirm('Are you sure ?')" method="POST" action="{{ route('room.delete') }}" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="id" id="room-id" value="{{$id}}">
            {{csrf_field()}}
        </form>
        <form method="POST" action="{{ route('room.insert') }}" enctype="multipart/form-data" autocomplete="off">
            {{csrf_field()}}
            <input type="hidden" name="id" id="room-id" value="{{$id}}">
            <div class="panel panel-primary panel-collapsed">
                <div class="panel-heading shadow">
                    <div class="panel-title">
                        <h4><strong>Room Information</strong></h4>
                    </div>
                    <div class="panel-options"><a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>
                <div class="panel-body shadow">
                    <div class="form-group">
                        <div class="col-lg-4 col-md-4">
                            <label for="product_name">Room Type Name</label>
                            <input type="text" class="form-control" id="product_name" name="room_name"
                                value="{{old('room_name', $room_name)}}" placeholder="Room Type Name">
                            @error('room_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <br>

                            <label for="room_order">Room List Order</label>
                            <input type="text" class="form-control" id="room_order" name="room_order"
                                value="{{old('room_order', $room_order)}}" placeholder="Room List Order">
                            @error('room_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <br>
                        </div>

                        <div class="col-lg-8 col-md-8">
                            <div class="col-lg-12">
                                <label for="" class="control-label">Bed Type</label>
                            </div>

                            <div class="col-lg-3">
                                <div class="checkbox checkbox-replace color-primary">
                                    <input type="checkbox" id="rd-1" name="bed_type[]" value="0" {{$bed1}}>
                                    <label>King</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="checkbox checkbox-replace color-primary">
                                    <input type="checkbox" id="rd-2" name="bed_type[]" value="2" {{$bed2}}>
                                    <label>Double</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="checkbox checkbox-replace color-primary">
                                    <input type="checkbox" id="rd-3" name="bed_type[]" value="1" {{$bed3}}>
                                    <label>Queen</label>
                                </div>
                            </div>
                            <br>

                            <div class="col-lg-12">
                                <br>
                                <label for="" class="control-label">Room Amenities</label>
                            </div>
                            <!-- Set amenities checked -->
                            <?php $no = 0; ?>
                            @foreach($amenitiess as $amenities)<?php $no++; ?>
                            @php
                            $id = $amenities->id;
                            @endphp
                            @if(!isset($room))
                            @php
                            if($no % 2 != 0)
                            $checked = "";
                            else
                            $checked = "";
                            @endphp
                            @else
                            @foreach($room['amenities'] as $data_amenitites)
                            @php
                            $id_amenitites = $data_amenitites->amenities_id;
                            if($id_amenitites == $id){
                            $checked = "checked";
                            break;
                            }
                            else
                            $checked = "";
                            @endphp
                            @endforeach
                            @endif
                            <div class="col-lg-3" style="margin-bottom: 5px;">
                                <div class="checkbox checkbox-replace color-primary">
                                    <input name="room_amenities[]" value="{{$amenities->id}}" type="checkbox"
                                        id="{{$amenities->id}}" {{$checked}}>
                                    <label>{{$amenities->amenities_name}}</label>
                                </div>
                            </div>
                            @if($no == 5)
                            @break
                            @endif
                            @endforeach
                            <div class="col-lg-3" style="margin-bottom: 10px;">
                                <a class="other-amenities">
                                    + Other Amenities
                                </a>
                                @include('master_data.room.modal')
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <label for="product_detail">Room Details</label>
                            <textarea name="room_desc">{{old('room_desc', $room_desc)}}</textarea>
                            <script>
                                CKEDITOR.replace( 'room_desc', {
                                    removePlugins: ['image', 'uploadimage']
                                });
                            </script>
                            @error('room_desc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary panel-collapsed">
                <div class="panel-heading shadow">
                    <div class="panel-title">
                        <h4><strong>Room Photos</strong></h4>
                    </div>
                    <div class="panel-options"><a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>
                <div class="panel-body shadow" style="display: block;">
                    <div class="col-lg-12">
                        <h5 class="mb"><strong>Room Photo</strong></h5>
                        <p class="mt">Upload room photos, the first uploaded photos will be treated as <strong>Main
                                Photos</strong></p>
                        <fieldset class="form-group">
                            <a class="btn btn-horison-gold shadow" href="javascript:void(0)"
                                onclick="$('#pro-image').click()"><i class="glyphicon glyphicon-circle-arrow-up"></i>
                                Browse Image</a>
                            <input type="file" id="pro-image" name="img[]" style="display: none;" class="form-control validateImage"
                                accept="image/*" onchange="fileValidation();" multiple>
                        </fieldset>
                        <div class="preview-images-zone">
                            @if(isset($room))
                            @php $n = 0; @endphp
                            @foreach($room['photo'] as $data_photo)@php $n++; @endphp
                            <div class="preview-image preview-show-{{$n}}">
                                <input type="hidden" style="width:auto" name="oldImg[]" value="{{$data_photo->photo_path}}">
                                <div class="image-cancel" data-no="{{$n}}">x</div>
                                <div class="image-zone" ><img id="pro-img-{{$n}}"
                                        src="{{asset('/user/'.$data_photo->photo_path)}}"></div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @error('img')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="panel panel-primary panel-collapsed">
                <div class="panel-heading shadow">
                    <div class="panel-title">
                        <h4><strong>Room Base Allotment</strong></h4>
                    </div>
                    <div class="panel-options"><a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>
                <div class="panel-body shadow" style="display: block;">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <h5 class="mb"><strong>Future Availabilty</strong></h5>
                            <p class="mt mb">Future availability used <strong>Automatic Allotment</strong> based on
                                <strong>Base Allotment on each type of Room</strong></p>
                            <p class="mt">Note that this availability can be change <strong>Manually</strong> if
                                necessary.</p>
                            <input type="hidden" id="future_availability" name="room_future_availability">
                            <a id="availability_0" onclick="setAvailability('0');" class="btn btn-horison-gold btn-padding">None </a>
                            <a id="availability_6" onclick="setAvailability('6');" class="btn btn-horison-gold btn-padding">6 Month </a>
                            <a id="availability_12" onclick="setAvailability('12');" class="btn btn-horison-gold btn-padding">1 Year </a>
                            <a id="availability_24" onclick="setAvailability('24');" class="btn btn-horison-gold btn-padding">2 Year </a>
                            <br>
                            <br>
                        </div>
                        <div class="col-lg-12">
                            <label for="" class="">Base Allotment</label>
                            <div class="input-group col-lg-1">
                                <input type="number" min="0" class="form-control" name="room_allotment"
                                    value="{{$room_allotment}}" >
                            </div>
                            <br>
                        </div>
                        <div class="col-lg-12"></div>
                        <div class="col-lg-4">
                            <label for="weekday_rate" class="">Base Weekday Publish Rate</label>
                            <div class="input-group col-lg-12">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" name="Base Weekday Publish Rate" class="form-control room_price thousandSeperator" oninput="ambilRupiah(this);"
                                    id="weekday_rate" value="{{$room_publish_rate}}"  />
                                <input type="hidden" name="room_publish_rate" id="weekday_rate_input"
                                    value="{{$room_publish_rate}}" />
                            </div>
                            <br>
                            <label for="weekday_room_rate" class="">Base Weekday Room Only Rate</label>
                            <div class="input-group col-lg-12">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" name="Base Weekday Room Only Rate" class="form-control room_price thousandSeperator" oninput="ambilRupiah(this);"
                                    id="weekday_room_rate" value="{{$room_ro_rate}}" />
                                <input type="hidden" name="room_ro_rate" id="weekday_room_rate_input"
                                    value="{{$room_ro_rate}}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="weekend_rate">Base Weekend Publish Rate</label>
                            <div class="input-group col-lg-12">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" name="Base Weekend Publish Rate" class="form-control room_price thousandSeperator" oninput="ambilRupiah(this);"
                                    id="weekend_rate" value="{{$room_weekend_rate}}" />
                                <input type="hidden" name="room_weekend_rate" id="weekend_rate_input"
                                    value="{{$room_weekend_rate}}" />
                            </div>
                            <br>
                            <label for="weekend_room_rate">Base Weekend Room Only Rate</label>
                            <div class="input-group col-lg-12">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" name="Base Weekend Room Only Rate" class="form-control room_price thousandSeperator" oninput="ambilRupiah(this);"
                                    id="weekend_room_rate" value="{{$room_weekend_ro_rate}}" />
                                <input type="hidden" name="room_weekend_ro_rate" id="weekend_room_rate_input"
                                    value="{{$room_weekend_ro_rate}}" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="bed_price">Extra Bed Rate</label>
                            <div class="input-group col-lg-12">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" name="Extra Bed Rate" class="form-control room_price thousandSeperator"
                                    id="bed_price" value="{{$room_extrabed_rate}}" />
                                <input type="hidden" name="room_extrabed_rate" id="bed_price_input"
                                    value="{{$room_extrabed_rate}}"  />
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                @if(isset($room))
                <button type="submit" form = "delete_room"
                class="btn btn-delete btn-padding">
                Delete
                </button>
                <a class="btn btn-white btn-padding" href="{{route('room.index')}}">
                    Cancel
                </a>
                <button type="button" class="btn btn-horison-gold btn-padding" onclick="confirmBox(this)">
                    Update
                </button>
                @else
                <a class="btn btn-white btn-padding" href="{{route('room.index')}}">
                    Cancel
                </a>
                <button type="button" class="btn btn-horison-gold btn-padding" onclick="confirmBox(this);">Save</button>
                @endif
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    if ("{{$room_publish_rate}}" != "") {
            var e = document.getElementById("weekday_rate");
            e.value = formatRupiah(e, e.value);
    }
    if ("{{$room_ro_rate}}" != "") {
            var e = document.getElementById("weekday_room_rate");
            e.value = formatRupiah(e, e.value);
    }
    if ("{{$room_weekend_rate}}" != "") {
            var e = document.getElementById("weekend_rate");
            e.value = formatRupiah(e, e.value);
    }
    if ("{{$room_weekend_ro_rate}}" != "") {
            var e = document.getElementById("weekend_room_rate");
            e.value = formatRupiah(e, e.value);
    }
    if ("{{$room_extrabed_rate}}" != "") {
            var e = document.getElementById("bed_price");
            e.value = formatRupiah(e, e.value);
    }

    function ambilRupiah(e) {
        var hiddenInput = document.getElementById(e.id + "_value");
        hiddenInput.value = hiddenInput.value.replace(/[^0-9]*/g, '');
        hiddenInput.value = e.value.match(/\d/g).join("");
        e.value = formatRupiah(e, e.value);
    }

    /* Fungsi formatRupiah */
    function formatRupiah(rupiah, angka, prefix) {
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
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }

    function confirmBox(e) {
        var room_price = document.getElementsByClassName('room_price');
        console.log(room_price.length);
        var cek = true;
        var msg = '';

        for (let index = 0; index < room_price.length; index++) {
            const element = room_price[index];

            if(element.value == "0"){
                if(msg == ''){
                    msg += element.name;
                }else{
                    msg += ', '+element.name;
                }
               cek = false;
            }
            console.log(msg);
            if(msg != ''){
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This '+msg+' will be sold for Rp 0 ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                    }).then((result) => {
                    if (result.value) {
                        e.setAttribute('type','submit');
                        e.setAttribute('onclick','');
                        e.click();
                        cek = false;
                    // For more information about handling dismissals please visit
                    // https://sweetalert2.github.io/#handling-dismissals
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                        'Cancelled',
                        'Operation Cancel!',
                        'error'
                        )
                    }
                })
            }

        }

       if(cek){
            e.setAttribute('type','submit');
            e.setAttribute('onclick','');
            e.click();
       }
    }
</script>

<script>
    // set future availibility
    var selectedAvailability = document.getElementById("future_availability");
    selectedAvailability.value = "{{$room_future_availability}}";
    document.getElementById("availability_{{$room_future_availability}}").classList.add("active");

    function setAvailability(value) {
        //find recently active product
        var selectedAvailability = document.getElementById("future_availability");
        //set the product inactive
        var activeNow = document.getElementById("availability_" + selectedAvailability.value);
        activeNow.classList.remove("active");
        //set clicked product active

        document.getElementById("availability_" + value).classList.add("active");
        //set new product active as activeProduct value
        selectedAvailability.value = value;
    }

    $(document).ready(function () {
        document.getElementById('pro-image').addEventListener('change', readImage, false);

        $(".preview-images-zone").sortable();

        $(document).on('click', '.image-cancel', function () {
            let no = $(this).data('no');
            $(".preview-image.preview-show-" + no).remove();
        });
    });

    @if(isset($room['photo']))
    var num = {{count($room['photo'])}} + 1;
    var start = {{count($room['photo'])}} + 1;
    @else
    var num = 0;
    var start = 0;
    @endif

    function delete_image() {
        for (let i = start; i < num; i++) {
            $(".preview-image.preview-show-" + i).remove();
        }
    }

    function readImage() {
        if (window.File && window.FileList && window.FileReader) {
            delete_image();
            var files = event.target.files; //FileList object

            var output = $(".preview-images-zone");

            for (let i = 0; i < files.length; i++) {
                var file = files[i];

                if (!file.type.match('image')) continue;

                var picReader = new FileReader();

                picReader.addEventListener('load', function (event) {
                    var picFile = event.target;
                    var html = '<div class="preview-image preview-show-' + num + '">' +
                        '<input type="hidden" name="oldImg[]" value="new">' +
                        '<div class="image-cancel" data-no="' + num + '">x</div>' +
                        '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result +
                        '"></div>' +
                        '</div>';
                    output.append(html);
                    num = num + 1;
                });

                picReader.readAsDataURL(file);
            }
        } else {
            console.log('Browser not support');
        }
    }

    $(document).on('click', '.other-amenities', function () {
        let id = $(this).data('id');

        $.get('', function (data) {
            $('#other-amenities').modal('show', {
                backdrop: 'static'
            });
        });
    });

</script>
@endsection
