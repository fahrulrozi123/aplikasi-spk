@extends('templates/template')
@section("header_title") FUNCTION ROOM @endsection
@section('content')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

@php
if(isset($function_room)){
$action = "update";
$id = Crypt::encryptString($function_room->id);
$func_name = $function_room->func_name;
$func_room_desc = $function_room->func_room_desc;
$func_class = $function_room->func_class;
$func_theatre = $function_room->func_theatre;
$func_ushape = $function_room->func_ushape;
$func_board = $function_room->func_board;
$func_round = $function_room->func_round;
$func_dimension = $function_room->func_dimension;

}else{
$action = "create";
$id = "";
$func_name = "";
$func_room_desc = "";
$func_class = "";
$func_theatre = "";
$func_ushape = "";
$func_board = "";
$func_round = "";
$func_dimension = "";
}
@endphp
<div class="col-lg-12">
    <div class="row">

        <form id="function_form" method="POST" action="{{ route('function_room.insert') }}"
            enctype="multipart/form-data" autocomplete="off">
            {{csrf_field()}}
            <input type="hidden" name="form_action" id="form_action" value="{{$action}}">
            <input type="hidden" name="id" value="{{$id}}">
            <div class="panel panel-default shadow">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12">

                            <h4><b>Function Room Details</b></h4>

                            <div class="form-group">
                                <div class="row">
                                    <label for="field-1" class="col-sm-4 control-label fr-label">Functional Room
                                        Name<br><small class="text-muted"></small></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control " value="{{old('func_name', $func_name)}}"
                                            name="func_name" id="" placeholder="Input Functional Room Name"
                                            autocomplete="off" required>
                                        @error('func_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row">
                                    <label for="field-1" class="col-sm-4 control-label fr-label">Function Room
                                        Description<br><small class="text-muted"></small></label>
                                    <div class="col-sm-6">
                                        <textarea
                                            name="func_room_desc">{{old('func_room_desc', $func_room_desc)}}</textarea>
                                        <script>
                                            CKEDITOR.replace( 'func_room_desc', {
                                                removePlugins: ['image', 'uploadimage']
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div><br><br>
                        </div>

                        <div class="col-md-12">
                            <h4 style="margin-bottom: 0px;">
                                <b>Function Room Capacity</b>
                            </h4>

                            <div class="row">
                                <div class="col-xs-6 col-sm-2 col-md-2" style="margin-top: 20px;">
                                    <div class="row fr-icon-box" align="center">
                                        <div class="fr-icon horison-icon" style="text-align: center; padding-top: 0px;">
                                            {!! file_get_contents(asset('/images/function-room/FR-Classroom.svg'),
                                            false, stream_context_create($arrContextOptions)) !!}
                                        </div>
                                        <p class="fr-modal-name">Class Room</p>
                                        <div class="col-xs-9 col-sm-9 input-box">
                                            <input type="text" class="form-control numberValidation"
                                                oninput="ambilRupiah(this);" value="{{old('func_class', $func_class)}}"
                                                id="func_class" placeholder="0" autocomplete="off" required>
                                            <input type="hidden" name="func_class" id="func_class_value"
                                                value="{{$func_class}}" />
                                        </div>
                                        <p class="fr-pax-input">Pax</p>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-2 col-md-2" style="margin-top: 20px;">
                                    <div class="row fr-icon-box" align="center">
                                        <div class="fr-icon horison-icon" style="text-align: center; padding-top: 0px;">
                                            {!! file_get_contents(asset('/images/function-room/FR-Theatre.svg'), false,
                                            stream_context_create($arrContextOptions)) !!}
                                        </div>
                                        <p class="fr-modal-name">Theatre</p>
                                        <div class="col-xs-9 col-sm-9 input-box">
                                            <input type="text" class="form-control numberValidation"
                                                oninput="ambilRupiah(this);"
                                                value="{{old('func_theatre', $func_theatre)}}" id="func_theatre"
                                                placeholder="0" autocomplete="off" required>
                                            <input type="hidden" name="func_theatre" id="func_theatre_value"
                                                value="{{$func_theatre}}" />
                                        </div>
                                        <p class="fr-pax-input">Pax</p>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-2 col-md-2" style="margin-top: 20px;">
                                    <div class="row fr-icon-box" align="center">
                                        <div class="fr-icon horison-icon" style="text-align: center; padding-top: 0px;">
                                            {!! file_get_contents(asset('/images/function-room/FR-UShape.svg'), false,
                                            stream_context_create($arrContextOptions)) !!}
                                        </div>
                                        <p class="fr-modal-name">U-Shape</p>
                                        <div class="col-xs-9 col-sm-9 input-box">
                                            <input type="text" class="form-control numberValidation"
                                                oninput="ambilRupiah(this);"
                                                value="{{old('func_ushape', $func_ushape)}}" id="func_ushape"
                                                placeholder="0" autocomplete="off" required>
                                            <input type="hidden" name="func_ushape" id="func_ushape_value"
                                                value="{{$func_ushape}}" />
                                        </div>
                                        <p class="fr-pax-input">Pax</p>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-2 col-md-2" style="margin-top: 20px;">
                                    <div class="row fr-icon-box" align="center">
                                        <div class="fr-icon horison-icon" style="text-align: center; padding-top: 0px;">
                                            {!! file_get_contents(asset('/images/function-room/FR-Boardroom.svg'),
                                            false, stream_context_create($arrContextOptions)) !!}
                                        </div>
                                        <p class="fr-modal-name">Board Room</p>
                                        <div class="col-xs-9 col-sm-9 input-box">
                                            <input type="text" class="form-control numberValidation"
                                                oninput="ambilRupiah(this);" value="{{old('func_board', $func_board)}}"
                                                id="func_board" placeholder="0" autocomplete="off" required>
                                            <input type="hidden" name="func_board" id="func_board_value"
                                                value="{{$func_board}}" />
                                        </div>
                                        <p class="fr-pax-input">Pax</p>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-2 col-md-2" style="margin-top: 20px;">
                                    <div class="row fr-icon-box" align="center">
                                        <div class="fr-icon horison-icon" style="text-align: center; padding-top: 0px;">
                                            {!! file_get_contents(asset('/images/function-room/FR-RoundTable.svg'),
                                            false, stream_context_create($arrContextOptions)) !!}
                                        </div>
                                        <p class="fr-modal-name">Round Table</p>
                                        <div class="col-xs-9 col-sm-9 input-box">
                                            <input type="text" class="form-control numberValidation"
                                                oninput="ambilRupiah(this);" value="{{old('func_round', $func_round)}}"
                                                id="func_round" placeholder="0" autocomplete="off" required>
                                            <input type="hidden" name="func_round" id="func_round_value"
                                                value="{{$func_round}}" />
                                        </div>
                                        <p class="fr-pax-input">Pax</p>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-2 col-md-2" style="margin-top: 20px;">
                                    <div class="row fr-icon-box" align="center">
                                        <div class="fr-icon horison-icon" style="text-align: center; padding-top: 0px;">
                                            {!! file_get_contents(asset('/images/function-room/FR-Dimension.svg'),
                                            false, stream_context_create($arrContextOptions)) !!}
                                        </div>
                                        <p class="fr-modal-name">Dimension</p>
                                        <div class="col-xs-9 col-sm-9 input-box">
                                            <input oninput="clear_partition();ambilRupiah(this);" type="text"
                                                class="form-control" value="{{old('func_dimension', $func_dimension)}}"
                                                id="func_dimension" placeholder="0" autocomplete="off" required>
                                            <input type="hidden" name="func_dimension" id="func_dimension_value"
                                                value="{{$func_dimension}}" />
                                        </div>
                                        <p class="fr-sqm-input">Sqm</p>
                                    </div>
                                </div>
                            </div>
                        </div><br><br>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4><b>Function Room Photos</b></h4>
                            <fieldset class="col-sm-6">
                                <a class="btn btn-horison-gold shadow" href="javascript:void(0)"
                                    onclick="$('#pro-image').click()"><i
                                        class="glyphicon glyphicon-circle-arrow-up"></i>
                                    Browse Image</a>
                                <input type="file" id="pro-image" name="img[]" style="display: none;"
                                    class="form-control validateImage" accept="image/*" multiple
                                    onchange="fileValidation();">
                            </fieldset>
                            <div class="preview-images-zone">
                                @if(isset($function_room))
                                @php $n = 0; @endphp
                                @foreach($function_room['photos'] as $data_photo)@php $n++; @endphp
                                <div class="preview-image preview-show-{{$n}}">
                                    <input type="hidden" name="oldImg[]" value="{{$data_photo->photo_path}}">
                                    <div class="image-cancel" data-no="{{$n}}">x</div>
                                    <div class="image-zone"><img id="pro-img-{{$n}}"
                                            src="{{asset('/user/'.$data_photo->photo_path)}}"></div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-12">
                            @php
                            if(isset($function_room) && count($function_room['partition']) > 0){
                            $create_class = "hidden";
                            $table_class = "";
                            $total_partition = count($function_room['partition']);
                            }else{
                            $create_class = "";
                            $table_class = "hidden";
                            $total_partition = 0;
                            }
                            @endphp
                            <h4 style="margin-bottom:10px;"><b>Function Room Partition</b></h4>
                            <a onClick="create_partition();" id="btn_partition-create" class="{{$create_class}}">
                                <p class="font-primary">+ Create Partition</p>
                            </a>

                            <div style="overflow-x:auto;">
                                <table id="table_partition" class="table table-bordered responsive {{$table_class}}">
                                    <thead>
                                        <tr>
                                            <th class="fr-modal-table-title">Partition Name</th>
                                            <th class="fr-modal-table-title">Dimension (Sqm)</th>
                                            <th class="fr-modal-table-title">Class Room (Pax)</th>
                                            <th class="fr-modal-table-title">Theatre (Pax)</th>
                                            <th class="fr-modal-table-title">U-Shape (Pax)</th>
                                            <th class="fr-modal-table-title">Board Room (Pax)</th>
                                            <th class="fr-modal-table-title">Round Table (Pax)</th>
                                            <th class="fr-modal-table-title">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_partition-body">
                                        @if(isset($function_room))
                                        @php $no = 0; @endphp
                                        @foreach($function_room['partition'] as $partition)@php $no++; @endphp
                                        <tr id="partition_row_{{$no}}">
                                            <td class="fr-modal-table-content"><input type="text" class="form-control"
                                                    value="{{$partition->func_name}}" name="partition_name[]" id=""
                                                    placeholder="" required=""></td>
                                            <td class="fr-modal-table-content"><input oninput="check_dimension(this);"
                                                    type="text" class="form-control partition_dimension"
                                                    value="{{$partition->func_dimension}}" name="partition_dimension[]"
                                                    id="" placeholder="" required=""></td>
                                            <td class="fr-modal-table-content"><input oninput="numberVal(this);"
                                                    type="text" class="form-control numberValidation"
                                                    value="{{$partition->func_class}}" name="partition_class[]" id=""
                                                    placeholder="" required=""></td>
                                            <td class="fr-modal-table-content"><input oninput="numberVal(this);"
                                                    type="text" class="form-control numberValidation"
                                                    value="{{$partition->func_theatre}}" name="partition_theatre[]"
                                                    id="" placeholder="" required="">
                                            </td>
                                            <td class="fr-modal-table-content"><input oninput="numberVal(this);"
                                                    type="text" class="form-control numberValidation"
                                                    value="{{$partition->func_ushape}}" name="partition_ushape[]" id=""
                                                    placeholder="" required="">
                                            </td>
                                            <td class="fr-modal-table-content"><input oninput="numberVal(this);"
                                                    type="text" class="form-control numberValidation"
                                                    value="{{$partition->func_board}}" name="partition_board[]" id=""
                                                    placeholder="" required=""></td>
                                            <td class="fr-modal-table-content"><input oninput="numberVal(this);"
                                                    type="text" class="form-control numberValidation"
                                                    value="{{$partition->func_round}}" name="partition_round[]" id=""
                                                    placeholder="" required=""></td>
                                            <td class="fr-modal-table-content"><button
                                                    onclick="remove_partition({{$no}});" type="button"
                                                    class="btn btn-danger"><i class="entypo-trash"></i></button></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <a onClick="add_partition();" id="btn_partition-add" class="{{$table_class}}">
                                <p class="font-primary">+ Add Function Room Partition</p>
                            </a>

                        </div>
                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" align="left">
                            <a href="{{ route('function_room.index') }}" class="btn btn-white btn-lg shadow"
                                style="width: 150px; margin-right:3px; font-size:13px;"><b>Cancel</b></a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                            @if(isset($function_room))
                            <button class="btn btn-link btn-lg danger" type="submit" name="delete" id="btn_delete"
                                style="width: 150px; margin-right:3px; font-size:13px;"><b>Delete</b></button>
                            @endif
                            <button type="submit" name="save" class="btn btn-horison-gold btn-lg shadow"
                                style="width: 150px; margin-left:3px; font-size:13px;"><b>Save</b></button>
                        </div>
                    </div>

                </div>
            </div>

        </form>

    </div>
</div>

<script type="text/javascript">
    if ("{{$func_class}}" != "") {
            var e = document.getElementById("func_class");
            e.value = formatRupiah(e, e.value);
    }
    if ("{{$func_theatre}}" != "") {
            var e = document.getElementById("func_theatre");
            e.value = formatRupiah(e, e.value);
    }
    if ("{{$func_ushape}}" != "") {
            var e = document.getElementById("func_ushape");
            e.value = formatRupiah(e, e.value);
    }
    if ("{{$func_board}}" != "") {
            var e = document.getElementById("func_board");
            e.value = formatRupiah(e, e.value);
    }
    if ("{{$func_round}}" != "") {
            var e = document.getElementById("func_round");
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

</script>

<script>
    $('#btn_delete').on('click', function (e) {

        event.preventDefault();
        var form = $('#function_form');

        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.value) {
            $('#form_action').val('delete');
            form.submit();
        }
        })
    });
    var partition_total = parseInt("{{$total_partition}}");

    function clear_partition() {
        var e = document.getElementById('func_dimension');
        e.value = e.value == "" ? 0 : e.value;
        e.value = isNaN(e.value) ? 0 : parseInt(e.value);
        if (partition_total > 0) {
            var partitions = document.getElementsByClassName('partition_dimension');
            partitions.forEach(element => {
                element.value = 0;
            });
        }
    }

    function check_dimension(e) {
        e.value = e.value == "" ? 0 : e.value;
        e.value = isNaN(e.value) ? 0 : parseInt(e.value);
        var partitions = document.getElementsByClassName('partition_dimension');
        var partition = 0;
        partitions.forEach(element => {
            partition += parseInt(element.value);
        });


        var dimension = $('#func_dimension_value').val() == "" ? 0 : $('#func_dimension_value').val();
        dimension = parseInt(dimension);
        partition = parseInt(partition);
        if (partition > dimension) {
            alert('Total Partition Dimension cannot more than Master Dimension(' + dimension + ') !');
            e.value = 0;
        }
    }



    function create_partition() {
        $('#table_partition').removeClass('hidden');
        $('#btn_partition-add').removeClass('hidden');
        $('#btn_partition-create').addClass('hidden');
    }

    function add_partition() {
        partition_total++;
        var html = '<tr id="partition_row_' + partition_total + '"+num>' +
            '<td class="fr-modal-table-content">' +
            '<input type="text" class="form-control" value="" name="partition_name[]" id="" placeholder="" required></td>' +
            '<td class="fr-modal-table-content">' +
            '<input oninput="check_dimension(this);" type="text" class="form-control partition_dimension numberValidation" value="" name="partition_dimension[]" id="" placeholder="" required></td>' +
            '<td class="fr-modal-table-content">' +
            '<input type="text" class="form-control" oninput="numberVal(this);" value="" name="partition_class[]"' +
            'id="" placeholder="" required>' +
            '</td>' +
            '<td class="fr-modal-table-content">' +
            '<input type="text" class="form-control " oninput="numberVal(this);" value="" name="partition_theatre[]"' +
            'id="" placeholder="" required>' +
            '</td>' +
            '<td class="fr-modal-table-content">' +
            '<input type="text" class="form-control " oninput="numberVal(this);" value="" name="partition_ushape[]"' +
            'id="" placeholder="" required>' +
            '</td>' +
            '<td class="fr-modal-table-content">' +
            '<input type="text" class="form-control " oninput="numberVal(this);" value="" name="partition_board[]"' +
            'id="" placeholder="" required>' +
            '</td>' +
            '<td class="fr-modal-table-content">' +
            '<input type="text" class="form-control " oninput="numberVal(this);" value="" name="partition_round[]"' +
            'id="" placeholder="" required>' +
            '</td>' +
            '<td class="fr-modal-table-content">' +
            '<button onclick = "remove_partition(' + partition_total + ');" type="button" class="btn btn-danger">' +
            '<i class="entypo-trash"></i>' +
            '</button>' +
            '</td>' +
            '</tr>';
        $('#table_partition-body').append(html);
    }

    function remove_partition(id) {
        $('#partition_row_' + id).remove();
        partition_total--;
        if (partition_total < 1) {
            $('#table_partition').addClass('hidden');
            $('#btn_partition-add').addClass('hidden');
            $('#btn_partition-create').removeClass('hidden');
        }
    }
    function numberVal(e){
        e.value = e.value.replace(/[^0-9\.]/g,'');
    }

    $(document).ready(function () {

        document.getElementById('pro-image').addEventListener('change', readImage, false);

        $(".preview-images-zone").sortable();

        $(document).on('click', '.image-cancel', function () {
            let no = $(this).data('no');
            $(".preview-image.preview-show-" + no).remove();
        });

    });

    @if(isset($function_room['photos']))
    var num = {{count($function_room['photos'])}} + 1;
    var start = {{count($function_room['photos'])}} + 1;
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

</script>
@endsection
