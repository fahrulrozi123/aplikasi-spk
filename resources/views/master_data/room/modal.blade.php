<!-- Modal preview news-->
<div id="other-amenities" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header mh-horison">
                <h2 class="modal-title col-lg-12"><strong>ADD AMENITIES</strong></h2>
            </div>

            <div class="modal-body">
                <h3 class="text-danger text-center"></h3>
                <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row">
                    <?php $no = 0; ?>
                    @foreach($amenitiess as $amenities)<?php $no++; ?>
                        @php
                            $id = $amenities->id;
                        @endphp
                        @if ($no < 6)
                            @continue;
                        @else
                            @if(!isset($room))
                                @php
                                    $checked="" ;
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
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="checkbox checkbox-replace color-primary" style="margin-bottom: 10px">
                                    <input name ="room_amenities[]" value ="{{ $amenities->id }}" type="checkbox" id="chk-20" {{ $checked }}>
                                        <label>{{ $amenities->amenities_name }}</label>
                                    </div>
                                </div>
                        @endif
                    @endforeach
                    </div>
                                </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="id-data" />
                <a class="btn btn-horison-gold btn-lg" href="#" data-dismiss="modal">
                    Save
                </a>
            </div>
        </div>
    </div>
</div>
