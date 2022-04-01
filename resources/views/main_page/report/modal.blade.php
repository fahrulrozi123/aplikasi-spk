<div class="modal" id="modal_export_pdf">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header mh-exportpdf">
                {{-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> --}}
                <h4 class="modal-title col-lg-6">
                    <b>EXPORT REPORT to PDF</b>
                </h4>
            </div>

            <form action="">
                <div class="modal-body">
                    <div class="container">
                        <div class="col-sm-12">
                            <div style="margin-bottom: 10px">Select Report to Generate:</div>
                            <div class="checkbox checkbox-replace color-primary">
                                <input class="checkbox_report" value="1" type="checkbox" id="chk-20">
                                <label><b>All Sales Report</b></label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="container">
                        <div class="col-sm-3 col-xs-12" style="margin-right: -40px;">
                            <div style="margin-bottom: 10px">Room Sales Report</div>
                            <div class="checkbox checkbox-replace color-primary" style="margin-bottom: 10px">
                                <input type="checkbox" class="checkbox_report" value="2">
                                <label><b>All Room Sales</b></label>
                            </div>
                            <div class="checkbox checkbox-replace color-primary">
                                <input type="checkbox" class="checkbox_report" value="3">
                                <label><b>All Room Reservation Report</b></label>
                            </div><br>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div style="margin-bottom: 10px">Package/Product Report</div>
                            <div class="checkbox checkbox-replace color-primary" style="margin-bottom: 10px">
                                <input type="checkbox" class="checkbox_report" value="4">
                                <label><b>All Package/Product Sales</b></label>
                            </div>
                            <div class="checkbox checkbox-replace color-primary">
                                <input type="checkbox" class="checkbox_report" value="3">
                                <label><b>All Package/Product Reservation Report</b></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    <button onclick="savePDF();" type="button" class="btn btn-blue">Generate Report</button>
                </div>
            </form>
        </div>
    </div>
</div>
