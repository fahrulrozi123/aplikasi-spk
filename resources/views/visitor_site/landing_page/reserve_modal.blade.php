<div class="modal fade" id="modal_reserve_button">
    <div class="modal-dialog">
        <div class="modal-content">
            
            {{-- <div class="modal-header mh-exportpdf">
                <h4 class="modal-title col-lg-6"><b>EXPORT REPORT to PDF</b></h4>
            </div> --}}
            
            <form action="">

                <div class="modal-body">
                    <div class="panel minimal-custom minimal-gray">
					
                        <div class="panel-heading">
                            <div class="panel-title"><h4></h4></div>
                            <div class="panel-options">
                                
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#rooms" data-toggle="tab"><i class="fa fa-bed" style="color:#D4B580;"></i>&ensp;Rooms</a></li>
                                    <li><a href="#product" data-toggle="tab"><i class="fa fa-diamond" style="color:#D4B580;"></i>&ensp;Other Product</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="panel-body" style="background-color: #333333;">
                            
                            <div class="tab-content">
                                <div class="tab-pane active" id="rooms" style="background-color: #333333;">

                                    <div class="row modal-reserve-row">
                                        <div class="col-md-12">
                                            <label for="date_check" class="label-modal-reserve">Check In - Check Out</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="input-group col-md-12">
                                                        <input type="text" class="form-control modal-form-control daterange visitor-input" data-format="YYYY-MM-DD" 
                                                        data-start-date="2013-08-02" data-end-date="2013-08-15" data-separator=","name="date_check" placeholder="">
                                                        <span class="input-group-addon addon-modal-reserve"><i class="entypo-calendar" style="color:#D4B580;"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>      
                                    <div class="row modal-reserve-row">
                                        <div class="col-md-4">
                                            <label for="room_choice" class="label-modal-reserve">Rooms</label>
                                            <select class="form-control modal-form-control visitor-input">
                                                <option>1 Rooms</option>
                                                <option>-</option>
                                                <option>-</option>
                                                <option>-</option>
                                            </select><br>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="adult_sum" class="label-modal-reserve">Adults</label>
                                            <select class="form-control modal-form-control visitor-input">
                                                <option>1 Adult</option>
                                                <option>-</option>
                                                <option>-</option>
                                                <option>-</option>
                                            </select><br>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="children_sum" class="label-modal-reserve">Children</label>
                                            <select class="form-control modal-form-control visitor-input">
                                                <option>1 Children</option>
                                                <option>-</option>
                                                <option>-</option>
                                                <option>-</option>
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="row" align="center" style="margin-left:30px; margin-right:30px;">
                                        <a href="#" class="btn btn-block btn-lg btn-horison-visitor"><b>Find Rooms</b></a>
                                    </div>
                                   
                                </div>
                                
                                <div class="tab-pane" id="product" style="background-color: #333333;">

                                    <div class="row modal-reserve-row">
                                        <div class="col-md-12">
                                            <label for="date_product" class="label-modal-reserve">Date</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="input-group col-md-12">
                                                        <input type="text" class="form-control modal-form-control datepicker visitor-input" data-format="D, dd MM yyyy" 
                                                        name="date_product" placeholder="">
                                                        <span class="input-group-addon addon-modal-reserve"><i class="entypo-calendar" style="color:#D4B580;"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>      
                                    <div class="row modal-reserve-row">
                                        <div class="col-md-12">
                                            <label for="category_product" class="label-modal-reserve">Product Category</label>
                                            <select class="form-control modal-form-control visitor-input">
                                                <option>AllySea a SPA</option>
                                                <option>-</option>
                                                <option>-</option>
                                                <option>-</option>
                                            </select>
                                        </div>
                                    </div><br><br>
                                    <div class="row" align="center" style="margin-left:30px; margin-right:30px;">
                                        <a href="#" class="btn btn-block btn-lg btn-horison-visitor"><b>Browse Product</b></a>
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                


            </form>

        </div>
    </div>
</div>