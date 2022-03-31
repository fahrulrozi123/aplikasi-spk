<div class="modal" id="frdetailModal">
    <div class="modal-dialog" style="width: 95%">
        <div class="modal-content">

            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;"> {{-- Main Room Capacity --}}
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Function Main Room Capacity</b></h4>
            </div>

            <div class="modal-body">

                <div class="row" align="center">
                    <div class="col-md-12">

                        <div class="col-xs-6 col-sm-4 col-md-2">
                            <div class="row fr-modal-box" align="center">
                                <div class="size-icon-fr horison-icon" style="text-align: center;">
                                    {!! file_get_contents(asset('/images/function-room/FR-Classroom.svg'), false, stream_context_create($arrContextOptions)) !!}
                                </div>
                                <p class="fr-modal-name">Class Room</p>
                                <p class="fr-modal-pax" id="fr_class">100 Pax</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-2">
                            <div class="row fr-modal-box" align="center">
                                <div class="size-icon-fr horison-icon" style="text-align: center;">
                                    {!! file_get_contents(asset('/images/function-room/FR-Theatre.svg'), false, stream_context_create($arrContextOptions)) !!}
                                </div>
                                <p class="fr-modal-name">Theatre</p>
                                <p class="fr-modal-pax" id="fr_theatre">100 Pax</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-2">
                            <div class="row fr-modal-box" align="center">
                                <div class="size-icon-fr horison-icon" style="text-align: center;">
                                    {!! file_get_contents(asset('/images/function-room/FR-UShape.svg'), false, stream_context_create($arrContextOptions)) !!}
                                </div>
                                <p class="fr-modal-name">U-Shape</p>
                                <p class="fr-modal-pax" id="fr_ushape">100 Pax</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-2">
                            <div class="row fr-modal-box" align="center">
                                <div class="size-icon-fr horison-icon" style="text-align: center;">
                                    {!! file_get_contents(asset('/images/function-room/FR-Boardroom.svg'), false, stream_context_create($arrContextOptions)) !!}
                                </div>
                                <p class="fr-modal-name">Board Room</p>
                                <p class="fr-modal-pax" id="fr_board">100 Pax</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-2">
                            <div class="row fr-modal-box" align="center">
                                <div class="size-icon-fr horison-icon" style="text-align: center;">
                                    {!! file_get_contents(asset('/images/function-room/FR-RoundTable.svg'), false, stream_context_create($arrContextOptions)) !!}
                                </div>
                                <p class="fr-modal-name">Round Table</p>
                                <p class="fr-modal-pax" id="fr_round">100 Pax</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-2">
                            <div class="row fr-modal-box" align="center">
                                <div class="size-icon-fr horison-icon" style="text-align: center;">
                                    {!! file_get_contents(asset('/images/function-room/FR-Dimension.svg'), false, stream_context_create($arrContextOptions)) !!}
                                </div>
                                <p class="fr-modal-name">Dimension</p>
                                <p class="fr-modal-pax" id="fr_dimension">100 Sqm</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;"> {{-- Partition Room Capacity --}}
                <h4 class="modal-title"><b>Function Partition Room Capacity</b></h4>
            </div>

            <div class="modal-body">
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

        </div>
    </div>
</div>
