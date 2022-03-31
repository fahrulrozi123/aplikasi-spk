@extends('templates/template')
@section('header_title')
    FUNCTION ROOM
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="row">

            <form method="" action="" enctype="">

                <div class="panel panel-default shadow">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-6">

                                <h4><b>Function Room Details</b></h4>

                                <div class="row">
                                    <label for="field-1" class="col-sm-4 control-label fr-label">Functional Room
                                        Name<br><small class="text-muted"></small></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control " value="" name="fr_name" id=""
                                            placeholder="Input Functional Room Name">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <label for="field-1" class="col-sm-4 control-label fr-label">Function Room
                                        Description<br><small class="text-muted"></small></label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" name="fr_desc" id="" cols="30" rows="4" MAXLENGTH=""
                                            placeholder="Input Function Room Description"></textarea>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <label for="field-1" class="col-sm-4 control-label fr-label">Function Room
                                        Photos<br><small class="text-muted"></small></label>
                                    <fieldset class="col-sm-6">
                                        <a class="btn btn-horison-gold" href="javascript:void(0)"
                                            onclick="$('#pro-image').click()"><i
                                                class="glyphicon glyphicon-circle-arrow-up"></i>
                                            Browse Image</a>
                                        <input type="file" id="pro-image" name="img[]" style="display: none;"
                                            class="form-control" accept="image/*" multiple>
                                    </fieldset>
                                </div><br><br>

                            </div>

                            <div class="col-md-6">

                                <h4 style="margin-bottom: 0px;"><b>Function Room Capacity</b></h4>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <div class="row fr-icon-box" align="center">
                                            <div class="fr-icon horison-icon" style="text-align: center;">
                                                {!! file_get_contents(asset('/images/function-room/FR-Classroom.svg'), false, stream_context_create($arrContextOptions)) !!}
                                            </div>
                                            <p class="fr-modal-name">Class Room</p>
                                            <div class="col-xs-9 col-sm-9 input-box">
                                                <input type="text" class="form-control" value="" name="fr_name" id=""
                                                    placeholder="">
                                            </div>
                                            <p class="fr-pax-input">Pax</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <div class="row fr-icon-box" align="center">
                                            <div class="fr-icon horison-icon" style="text-align: center;">
                                                {!! file_get_contents(asset('/images/function-room/FR-Theatre.svg'), false, stream_context_create($arrContextOptions)) !!}
                                            </div>
                                            <p class="fr-modal-name">Theatre</p>
                                            <div class="col-xs-9 col-sm-9 input-box">
                                                <input type="text" class="form-control" value="" name="fr_name" id=""
                                                    placeholder="">
                                            </div>
                                            <p class="fr-pax-input">Pax</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <div class="row fr-icon-box" align="center">
                                            <div class="fr-icon horison-icon" style="text-align: center;">
                                                {!! file_get_contents(asset('/images/function-room/FR-UShape.svg'), false, stream_context_create($arrContextOptions)) !!}
                                            </div>
                                            <p class="fr-modal-name">U-Shape</p>
                                            <div class="col-xs-9 col-sm-9 input-box">
                                                <input type="text" class="form-control" value="" name="fr_name" id=""
                                                    placeholder="">
                                            </div>
                                            <p class="fr-pax-input">Pax</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <div class="row fr-icon-box" align="center">
                                            <div class="fr-icon horison-icon" style="text-align: center;">
                                                {!! file_get_contents(asset('/images/function-room/FR-Boardroom.svg'), false, stream_context_create($arrContextOptions)) !!}
                                            </div>
                                            <p class="fr-modal-name">Board Room</p>
                                            <div class="col-xs-9 col-sm-9 input-box">
                                                <input type="text" class="form-control" value="" name="fr_name" id=""
                                                    placeholder="">
                                            </div>
                                            <p class="fr-pax-input">Pax</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <div class="row fr-icon-box" align="center">
                                            <div class="fr-icon horison-icon" style="text-align: center;">
                                                {!! file_get_contents(asset('/images/function-room/FR-RoundTable.svg'), false, stream_context_create($arrContextOptions)) !!}
                                            </div>
                                            <p class="fr-modal-name">Round Table</p>
                                            <div class="col-xs-9 col-sm-9 input-box">
                                                <input type="text" class="form-control" value="" name="fr_name" id=""
                                                    placeholder="">
                                            </div>
                                            <p class="fr-pax-input">Pax</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-4" style="margin-top: 20px;">
                                        <div class="row fr-icon-box" align="center">
                                            <div class="fr-icon horison-icon" style="text-align: center;">
                                                {!! file_get_contents(asset('/images/function-room/FR-Dimension.svg'), false, stream_context_create($arrContextOptions)) !!}
                                            </div>
                                            <p class="fr-modal-name">Dimension</p>
                                            <div class="col-xs-9 col-sm-9 input-box">
                                                <input type="text" class="form-control" value="" name="fr_name" id=""
                                                    placeholder="">
                                            </div>
                                            <p class="fr-sqm-input">Sqm</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <br><br>

                        <div class="row">
                            <div class="col-md-12">

                                <h4 style="margin-bottom:10px;"><b>Function Room Partition</b></h4>
                                <a href="#">
                                    <p style="color:#D4B580;">+ Create Partition</p>
                                </a>

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
                                            <th class="fr-modal-table-title">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="partition_name"
                                                    id="" placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="dimension" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="class_room" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="theatre" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="ushape" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="board_room" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="round_table" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <button type="button" class="btn btn-danger">
                                                    <i class="entypo-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="partition_name"
                                                    id="" placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="dimension" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="class_room" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="theatre" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="ushape" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="board_room" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <input type="text" class="form-control" value="" name="round_table" id=""
                                                    placeholder="">
                                            </td>
                                            <td class="fr-modal-table-content">
                                                <button type="button" class="btn btn-danger">
                                                    <i class="entypo-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <a href="#">
                                    <p style="color:#D4B580;">+ Add Function Room Partition</p>
                                </a>

                            </div>
                        </div>

                        <br><br>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6" align="left">
                                <a href="/master_data/function_room/indexisi" class="btn btn-white btn-lg "
                                    style="width: 150px; margin-right:3px; font-size:13px;"><b>Cancel<b></a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                <button class="btn btn-delete btn-lg "
                                    style="width: 150px; margin-right:3px; font-size:13px; color:red;"><b>Delete</b></button>
                                <a href="/master_data/function_room/indexisi" class="btn btn-horison-gold btn-lg shadow"
                                    style="width: 150px; margin-left:3px; font-size:13px;"><b>Save</b></a>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
