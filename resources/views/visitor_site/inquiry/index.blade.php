@extends('templates/visitor_rsv_template')

@section('description', 'Inquiry Horison Ultima Bandung. Booking dari website kami untuk dapatkan harga terbaik!')
@section('keywords', 'Inquiry Horison Ultima Bandung, Inquiry')
@section('title', 'Inquiry')

@section('content')

<br><br>

<div class="row">
    <div class="container">
        <div class="gallery-env">
            <div class="row">
                <div class="col-sm-12">
                    <article class="album">
                    <form method="POST" action="{{ route('inquiry.insert') }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <section class="album-info-inq shadow inquiry">
                            {{-- MAIN FORM --}}
                            <div class="row">

                                <div class="col-xs-12 col-md-12">
                                    <h3><b>How Can We Help You?<b></h3>
                                    <br>
                                </div>

                                <div class="col-xs-12 col-lg-12">
                                    <select focus="true" onchange="selectEvent(event);" name="event_type" id="event_type" class="form-control visitor-input">
                                        <option value="tab_general">General Inquiry</option>
                                        <option value="tab_recreational">{{ $menu['recreation'][0]['page_name'] }} Inquiry</option>
                                        <option value="tab_spa">{{ $menu['spa'][0]['page_name'] }} Inquiry</option>
                                        <option value="tab_mice">{{ $menu['mice'][0]['page_name'] }} Inquiry</option>
                                        <option value="tab_wedding">{{ $menu['wedding'][0]['page_name'] }} Inquiry</option>
                                    </select><br><br>
                                </div><br>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <h4><b>Personal Information<b></h4>
                                </div>

                                <div class="col-lg-12">
                                    <label for="full_name" style="font-size:12px">Full Name</label>
                                    <input type="text" class="form-control visitor-input" name="full_name"
                                    value="{{ old('full_name') }}" placeholder="Please Type Your Full Name" required><br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="email" style="font-size:12px">Email</label>
                                    <input type="email" class="form-control visitor-input"  name="email" value="{{ old('email') }}"
                                        placeholder="Please Enter Your Email Address" required><br>
                                </div>
                                <div class="col-lg-6">
                                    <label for="number" style="font-size:12px">Phone Number</label><br>
                                    <input id="phone_number" class="form-control visitor-input numberValidation" type="tel" maxlength="20" required>
                                        <br>
                                </div>
                            </div>
                            <hr><br>

                            {{-- GENERAL INQUIRY --}}
                            <div id="tab_general" >
                                <h4><b>Inquiry Details<b></h4>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <textarea id="general_details" name="general_details" class="form-control visitor-input textarea-nonresize" cols="1" rows="7"
                                                placeholder="Write your message..." required>{{ old('general_details') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row" align="right" style="margin-right:5px; margin-top: 10px;">
                                        <button type="submit" value="0" name="btn_general" class="btn btn-horison-gold"><b>SUBMIT</b></button>
                                    </div>
                                    <hr>
                            </div>

                            {{-- RECREATIONAL INQUIRY --}}
                            <div id="tab_recreational" style="display:none;">
                                <h4><b>{{ $menu['recreation'][0]['page_name'] }} Inquiry<b></h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="recreation_product" style="font-size:12px">Which package would you like to inquire?</label>
                                        <select id = "rec_product" name="rec_product" class="form-control visitor-input">
                                            @foreach($recreations as $recreation)
                                        <option value="{{$recreation->id}}">{{$recreation->product_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="product_quantity" style="font-size:12px">For how many people should we prepare this package?</label>
                                        <div class="input-group">
                                            <span class="input-group-addon2 input-group-inquiry">
                                                <i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control visitor-input" value="{{ old('rec_participant') }}"
                                                name="rec_participant" placeholder="" data-mask="9999">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="time_arriving" style="font-size:12px">When are you arriving?</label>
                                        <div class="row">
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon2 input-group-inquiry">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" value="{{ old('rec_date') }}" name="rec_date" class="form-control datepicker visitor-input" data-format="D, dd MM yyyy" placeholder="" data-start-date="today" readonly>
                                                </div><br>
                                            </div>
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon2 input-group-inquiry">
                                                        <i class="fa fa-clock-o"></i>
                                                    </span>
                                                    <input type="text" value="{{ old('rec_time') }}" class="form-control timepicker visitor-input"
                                                        data-template="dropdown" data-show-seconds="false"
                                                        data-default-time="12:00 PM" data-show-meridian="true"
                                                        data-minute-step="5" name="rec_time" placeholder="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="contact_type" style="font-size:12px">Any other request?</label>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input class="rec_other_request" type="checkbox"  name="rec_other_request[]" value="1">
                                                    <label style="font-size:11px">Accommodation</label>
                                                </div><br>
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input class="rec_other_request" type="checkbox"  name="rec_other_request[]" value="2">
                                                    <label style="font-size:11px">Dinner</label>
                                                </div><br>
                                            </div>
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input class="rec_other_request" type="checkbox" name="rec_other_request[]" value="3">
                                                    <label style="font-size:11px">Breakfast</label>
                                                </div><br>
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input class="rec_other_request" type="checkbox" name="rec_other_request[]" value="4">
                                                    <label style="font-size:11px">Swimming Pool Access</label>
                                                </div><br>
                                            </div>
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input class="rec_other_request" type="checkbox" name="rec_other_request[]" value="5">
                                                    <label style="font-size:11px">Lunch</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-xs-12 col-lg-12">
                                        <label for="inq_details" style="font-size:12px">Inquiry Details</label>
                                        <div class="input-group col-xs-12 col-lg-12">
                                            <textarea name= "rec_details" class="form-control visitor-input textarea-nonresize" cols="1" rows="7"
                                                placeholder="Write your message...">{{ old('rec_details') }}</textarea><br>
                                        </div>
                                    </div>
                                </div><br>

                                <div class="row" align="right" style="margin-right:5px; margin-top: 10px;">
                                    <button type="submit" value="1" name="btn_rec" class="btn btn-horison-gold"><b>SUBMIT</b></button>
                                </div>
                                <hr>
                            </div>

                            {{-- ALLYSEA A SPA INQUIRY --}}
                            <div id="tab_spa" style="display:none;">
                                <h4><b>{{ $menu['spa'][0]['page_name'] }} Inquiry<b></h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="spa_product" style="font-size:12px">Which product would you like to inquire?</label>
                                        <select id = "spa_product" name="spa_product" class="form-control visitor-input">
                                            @foreach($spas as $spa)
                                            <option value="{{$spa->id}}">{{$spa->product_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="product_quantity" style="font-size:12px">For how many people should we prepare this product?</label>
                                        <div class="input-group">
                                            <span class="input-group-addon2 input-group-inquiry">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control visitor-input"
                                                name="spa_participant" placeholder="" value="{{ old('spa_participant') }}" data-mask="9999">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="time_arriving" style="font-size:12px">When are you arriving?</label>
                                        <div class="row">
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon2 input-group-inquiry">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" value="{{ old('spa_date') }}" name="spa_date" class="form-control datepicker visitor-input"
                                                        data-format="D, dd MM yyyy" name="product_quantity"
                                                        placeholder="" data-start-date="today" readonly>
                                                </div><br>
                                            </div>
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon2 input-group-inquiry">
                                                        <i class="fa fa-clock-o"></i>
                                                    </span>
                                                    <input type="text" class="form-control timepicker visitor-input"
                                                        data-template="dropdown" data-show-seconds="false"
                                                        data-default-time="12:00 PM" data-show-meridian="true"
                                                        data-minute-step="5" name="spa_time" placeholder="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="contact_type" style="font-size:12px">Any other request?</label>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input class="spa_other_request" type="checkbox" name="spa_other_request[]" value="1">
                                                    <label style="font-size:11px">Accommodation</label>
                                                </div><br>
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input class="spa_other_request" type="checkbox" name="spa_other_request[]" value="2">
                                                    <label style="font-size:11px">Dinner</label>
                                                </div><br>
                                            </div>
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input class="spa_other_request" type="checkbox" name="spa_other_request[]" value="3">
                                                    <label style="font-size:11px">Breakfast</label>
                                                </div><br>
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input class="spa_other_request" type="checkbox" name="spa_other_request[]" value="4">
                                                    <label style="font-size:11px">Swimming Pool Access</label>
                                                </div><br>
                                            </div>
                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input class="spa_other_request" type="checkbox" name="spa_other_request[]" value="5">
                                                    <label style="font-size:11px">Lunch</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inq_details" style="font-size:12px">Inquiry Details</label>
                                        <textarea name= "spa_details" class="form-control visitor-input textarea-nonresize" cols="1" rows="7"
                                                placeholder="Write your message...">{{ old('spa_details') }}</textarea>

                                    </div>
                                </div>

                                <div class="row" align="right" style="margin-right:5px; margin-top: 10px;">
                                    <button type="submit" value="2" name="btn_spa" class="btn btn-horison-gold"><b>SUBMIT</b></button>
                                </div>
                                <hr>
                            </div>

                            {{-- MICE INQUIRY --}}
                            <div id="tab_mice" style="display:none;">
                                <h4><b>{{ $menu['mice'][0]['page_name'] }} Inquiry<b></h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="mice_package" style="font-size:12px">Which package would you like to inquire?</label>
                                        <select name="mice_product" class="form-control visitor-input">
                                            @foreach($mices as $mice)
                                            <option value="{{$mice->id}}">{{$mice->product_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="event_name" style="font-size:12px">Event Name</label>
                                        <input type="text" value="{{ old('mice_name') }}" class="form-control visitor-input"  name="mice_name"
                                            value="" placeholder="What is your event's name?" ><br>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="participant_quantity" style="font-size:12px">Number of Participant</label>
                                        <input type="text" value="{{ old('mice_participant') }}" class="form-control visitor-input" name="mice_participant"
                                            value="" placeholder="How many guests will be attending?" data-mask="9999">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="event_type" style="font-size:12px">Type of Event</label>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <div class="radio radio-replace color-primary">
                                                    <input type="radio" name="mice_event_type" value= "Meeting"  checked>
                                                    <label style="font-size:11px">Meeting</label>
                                                </div><br>
                                            </div>
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <div class="radio radio-replace color-primary">
                                                    <input type="radio" name="mice_event_type" value= "Incentive" >
                                                    <label style="font-size:11px">Incentive</label>
                                                </div><br>
                                            </div>
                                            <div class="col-sm-3 col-md-2 col-lg-3">
                                                <div class="radio radio-replace color-primary">
                                                    <input type="radio" name="mice_event_type" value = "Conference">
                                                    <label style="font-size:11px">Conference</label>
                                                </div><br>
                                            </div>
                                            <div class="col-sm-3 col-md-1 col-lg-3">
                                                <div class="radio radio-replace color-primary">
                                                    <input type="radio" name="mice_event_type" value = "Others" >
                                                    <label style="font-size:11px">Others</label>
                                                </div><br>
                                            </div>
                                        </div>
                                        <div id="other_value" class="row" style="display:none;">
                                            <div class="col-xs-12 col-md-6">
                                                <input type="text" class="form-control visitor-input"
                                                id="mice_other_values" name="mice_other_values" value="" placeholder="Others">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="pref_func_room" style="font-size:12px">Preferred Function Room</label>
                                        <select name="mice_function_room" class="form-control visitor-input">
                                            <option value="None">None</option>
                                            @foreach($function_rooms as $function_room)
                                            <option value="{{$function_room->id}}">{{$function_room->func_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="other_requirement" style="font-size:12px">Any other requirement?</label>
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input type="checkbox" name="mice_other_request[]" value="1">
                                                    <label style="font-size:11px">Accommodation</label>
                                                </div><br>
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input type="checkbox" name="mice_other_request[]" value="2">
                                                    <label style="font-size:11px">Dinner</label>
                                                </div><br>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input type="checkbox" name="mice_other_request[]" value="3">
                                                    <label style="font-size:11px">Breakfast</label>
                                                </div><br>
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input type="checkbox" name="mice_other_request[]" value="4">
                                                    <label style="font-size:11px">Swimming Pool Access</label>
                                                </div><br>
                                            </div>
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input type="checkbox" name="mice_other_request[]" value="5">
                                                    <label style="font-size:11px">Lunch</label>
                                                </div><br>
                                                <div class="checkbox checkbox-replace color-primary">
                                                    <input type="checkbox" name="mice_other_request[]" value="6">
                                                    <label style="font-size:11px">Leisure Activity</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="event_start" style="font-size:12px">When will the event start?</label>
                                        <div class="input-group">
                                            <span class="input-group-addon2 input-group-inquiry">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" value="{{ old('mice_event_start') }}" class="form-control datepicker visitor-input"
                                                data-format="D, dd MM yyyy" name="mice_event_start" placeholder="" data-start-date="today"
                                                readonly >
                                        </div><br>

                                    </div>
                                    <div class="col-lg-6">
                                        <label for="alternate_event_start" style="font-size:12px">Alternate date for the event</label>
                                        <div class="input-group">
                                            <span class="input-group-addon2 input-group-inquiry">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <input type="text" value="{{ old('mice_alt_start') }}" class="form-control datepicker visitor-input"
                                                data-format="D, dd MM yyyy" name="mice_alt_start"
                                                placeholder="" data-start-date="today" readonly >
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="est_budget" style="font-size:12px">Estimated Budget (Optional)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="color:#333333; font-size:11px;">Rp</span>
                                            <input type="text" value="{{ old('mice_budget') }}" class="form-control visitor-input numberValidation thousandSeperator" id="mice_budget" name="mice_budget"
                                                value="" placeholder="Enter your budget">
                                            <input type="hidden" name="mice_budget" id="mice_budget_input"
                                                value="" />
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inq_details" style="font-size:12px">Inquiry Details</label>
                                        <textarea name= "mice_details" class="form-control visitor-input textarea-nonresize" cols="1" rows="7"
                                        placeholder="Write your message...">{{ old('mice_details') }}</textarea>
                                    </div>
                                </div><br>

                                <div class="row" align="right" style="margin-right:5px; margin-top: 10px;">
                                    <button type="submit" value="3" name="btn_mice" class="btn btn-horison-gold"><b>SUBMIT</b></button>
                                </div>
                                <hr>
                            </div>

                            {{-- WEDDING INQUIRY --}}
                            <div id="tab_wedding" style="display:none;">
                                <h4><b>{{ $menu['wedding'][0]['page_name'] }} Inquiry<b></h4>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="service_req" style="font-size:12px">Service Request</label>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="radio radio-replace color-primary">
                                                    <input type="radio"  name="wedding_service_request" value="Information" checked>
                                                    <label style="font-size:11px">Information</label>
                                                </div><br>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="radio radio-replace color-primary">
                                                    <input type="radio"  name="wedding_service_request" value="Proposal Sheet">
                                                    <label style="font-size:11px">Proposal Sheet</label>
                                                </div><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="wedding_proposal">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="wedding_package" style="font-size:12px">Which package would you like to inquire?</label>
                                            <select name="wedding_product" class="form-control visitor-input">
                                                @foreach($weddings as $wedding)
                                                <option value="{{$wedding->id}}">{{$wedding->product_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="wedding_date" style="font-size:12px">When are you planning the Wedding?</label>
                                            <div class="input-group">
                                                <span class="input-group-addon2 input-group-inquiry">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" value="{{ old('wedding_event_start') }}" name="wedding_event_start" class="form-control datepicker visitor-input"
                                                    data-format="D, dd MM yyyy" name="wedding_date" placeholder="" data-start-date="today"
                                                    readonly>
                                            </div><br>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="alternate_wedding_date" style="font-size:12px">Alternate date for the Wedding</label>
                                            <div class="input-group">
                                                <span class="input-group-addon2 input-group-inquiry">
                                                    <i class="fa fa-clock-o"></i>
                                                </span>
                                                <input type="text" value="{{ old('wedding_alt_start') }}" name="wedding_alt_start" class="form-control datepicker visitor-input"
                                                    data-format="D, dd MM yyyy" name="alternate_wedding_date"
                                                    placeholder="" data-start-date="today" readonly>
                                            </div><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label for="guest_quantity" style="font-size:12px">Number of Guests</label>
                                            <input type="text" class="form-control visitor-input" value="{{ old('wedding_participant') }}"
                                                name="wedding_participant" value=""
                                                placeholder="How many guests will be attending?"  data-mask="9999">
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="wedding_other_req" style="font-size:12px">Other Request</label>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="7" type="checkbox" >
                                                        <label style="font-size:11px">Wedding Ceremony</label>
                                                    </div><br>
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="8" type="checkbox" >
                                                        <label style="font-size:11px">Dinner Reception</label>
                                                    </div><br>
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="9" type="checkbox" >
                                                        <label style="font-size:11px">Flowers</label>
                                                    </div><br>
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="10" type="checkbox" >
                                                        <label style="font-size:11px">Videography</label>
                                                    </div><br>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="11" type="checkbox" >
                                                        <label style="font-size:11px">After Wedding Brunch</label>
                                                    </div><br>
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="12" type="checkbox" >
                                                        <label style="font-size:11px">Lunch Reception</label>
                                                    </div><br>
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="13" type="checkbox" >
                                                        <label style="font-size:11px">Entertainment</label>
                                                    </div><br>
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="14" type="checkbox" >
                                                        <label style="font-size:11px">Wedding Organizer</label>
                                                    </div><br>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="15" type="checkbox" >
                                                        <label style="font-size:11px">Welcome Dinner</label>
                                                    </div><br>
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="16" type="checkbox" >
                                                        <label style="font-size:11px">Spa Treatment</label>
                                                    </div><br>
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="17" type="checkbox" >
                                                        <label style="font-size:11px">Linens</label>
                                                    </div><br>
                                                    <div class="checkbox checkbox-replace color-primary">
                                                        <input name="wedding_other_request[]" value="18" type="checkbox" >
                                                        <label style="font-size:11px">Photography</label>
                                                    </div><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inq_details" style="font-size:12px">Inquiry Details</label>
                                        <textarea name= "wedding_details" class="form-control visitor-input textarea-nonresize" cols="1" rows="7"
                                        placeholder="Write your message...">{{ old('wedding_details') }}</textarea>
                                    </div>
                                </div><br>

                                <div class="row" align="right" style="margin-right:5px; margin-top: 10px;">
                                    <button type="submit" value="4" name="btn_wedding" class="btn btn-horison-gold"><b>SUBMIT</b></button>
                                </div>
                                <hr>
                            </div>
                        </section>
                    </form>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const event_type = '{{ old('event_type') }}';
    const spa_other_request = {!! json_encode(old('spa_other_request')) !!};
    const rec_other_request = {!! json_encode(old('rec_other_request')) !!};
    const wedding_service_request = '{{ old('wedding_service_request') }}';

    const from = "{{$from}}";
    if(from !== '' && event_type == '') {
        $('#tab_general').fadeOut();
        $('#event_type').val('tab_'+from);
        $('#tab_'+from).fadeIn();
        $('#wedding_details').removeAttr('required');
        current_tab = 'tab_'+from;
    }
    if(event_type !== '') {
        $('#tab_general').fadeOut();
        $('#event_type').val(event_type);
        $('#'+event_type).fadeIn();
        $('#wedding_details').removeAttr('required');
    }
    if(event_type !== 'tab_general'){
        $('#general_details').removeAttr('required');
    }

    if(wedding_service_request){
        if(event_type == "tab_wedding" && wedding_service_request == "Information"){
        }else{
            $("input[value='Proposal Sheet']").click();
        }
    }

    var other_request_rec = document.getElementsByClassName('rec_other_request');

    if(rec_other_request){
        rec_other_request.forEach(data => {
            for (let index = 0; index < other_request_rec.length; index++) {
                if(data == other_request_rec[index].value){
                    other_request_rec[index].checked=true;
                    break;
                }
            }
        });
    }

    var other_request_spa = document.getElementsByClassName('spa_other_request');

    if(spa_other_request){
        spa_other_request.forEach(data => {
            for (let index = 0; index < other_request_spa.length; index++) {
                if(data == other_request_spa[index].value){
                    other_request_spa[index].checked=true;
                    break;
                }
            }
        });
    }
});

var element;
var current_tab = 'tab_general';

function selectEvent(e) {
    $('#'+current_tab).fadeOut();

    current_tab = e.target.value;
    if(current_tab == "tab_wedding"){

        $('#wedding_details').attr('required','required');
    }else{

        $('#wedding_details').removeAttr('required');
    }

    if(current_tab == "tab_general"){

        $('#general_details').attr('required','required');
    }else{
        $('#general_details').removeAttr('required');
    }

    $('#'+current_tab).fadeIn();
}

$("input[name=mice_event_type ]").click(function() {
    element = $(this);
    if(element.val() == "Others"){
            $('#other_value').fadeIn();
            $('#mice_other_value').attr('required', 'required');

    }else{
            $('#mice_other_value').removeAttr('required');
            $('#other_value').fadeOut();
    }
});


var input = document.querySelector("#phone_number");
    window.intlTelInput(input, {
    customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
            return "e.g. " + selectedCountryPlaceholder;
    },
    separateDialCode: true,
    hiddenInput: "phone_number",
    initialCountry: "auto",
    geoIpLookup: function(callback) {
        $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
        var countryCode = (resp && resp.country) ? resp.country : "";
        callback(countryCode);
        });
    },
    utilsScript: "{{ asset('js/intl-phone/utils.js') }}", // just for formatting/placeholders etc
    });
</script>
@endsection