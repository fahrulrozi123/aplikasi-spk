@extends('templates/visitor_template')

@section('description', 'Inquiry {{ $setting->title }}. Booking dari website kami untuk dapatkan harga terbaik!')
@section('keywords', 'Inquiry {{ $setting->title }}, Inquiry')
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
                                        <option value="tab_wellness">{{ $menu['wellness'][0]['page_name'] }} Inquiry</option>
                                        <option value="tab_mice">{{ $menu['mice'][0]['page_name'] }} Inquiry</option>
                                        <option value="tab_promotion">{{ $menu['promotion'][0]['page_name'] }} Inquiry</option>
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
                                        <button type="submit" value="0" name="btn_general" class="btn btn-holocene-gold"><b>SUBMIT</b></button>
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
                                                    <input type="text" value="{{ old('rec_date') }}" name="rec_date" class="form-control datepicker visitor-input" data-format="D, dd MM yyyy" placeholder="" data-start-date="today">
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
                                                        data-minute-step="5" name="rec_time" placeholder="">
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
                                    <button type="submit" value="1" name="btn_rec" class="btn btn-holocene-gold"><b>SUBMIT</b></button>
                                </div>
                                <hr>
                            </div>

                            {{-- WELLNESS INQUIRY --}}
                            <div id="tab_wellness" style="display:none;">
                                <h4><b>{{ $menu['wellness'][0]['page_name'] }} Inquiry<b></h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="wellness_product" style="font-size:12px">Which product would you like to inquire?</label>
                                        <select id = "wellness_product" name="wellness_product" class="form-control visitor-input">
                                            @foreach($wellnesses as $wellness)
                                            <option value="{{$wellness->id}}">{{$wellness->product_name}}</option>
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
                                                name="wellness_participant" placeholder="" value="{{ old('wellness_participant') }}" data-mask="9999">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="time_arriving" style="font-size:12px">When the activity/event date ?</label>
                                        <div class="row">
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon2 input-group-inquiry">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" value="{{ old('wellness_date') }}" name="wellness_date" class="form-control datepicker visitor-input"
                                                        data-format="D, dd MM yyyy" name="product_quantity"
                                                        placeholder="" data-start-date="today">
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
                                                        data-minute-step="5" name="wellness_time" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inq_details" style="font-size:12px">Inquiry Details</label>
                                        <textarea name= "wellness_details" class="form-control visitor-input textarea-nonresize" cols="1" rows="7"
                                                placeholder="Write your message...">{{ old('wellness_details') }}</textarea>
                                    </div>
                                </div>

                                <div class="row" align="right" style="margin-right:5px; margin-top: 10px;">
                                    <button type="submit" value="2" name="btn_wellness" class="btn btn-holocene-gold"><b>SUBMIT</b></button>
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
                                    <div class="col-lg-12">
                                        <label for="product_quantity" style="font-size:12px">For how many people should we prepare this product?</label>
                                        <div class="input-group">
                                            <span class="input-group-addon2 input-group-inquiry">
                                                <i class="fa fa-user"></i></span>
                                            <input type="text" value="{{ old('mice_participant') }}" class="form-control visitor-input" name="mice_participant"
                                                value="" placeholder="How many guests will be attending?" data-mask="9999">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="time_arriving" style="font-size:12px">When the activity/event date ?</label>
                                        <div class="row">
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon2 input-group-inquiry">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" value="{{ old('mice_date') }}" class="form-control datepicker visitor-input"
                                                        data-format="D, dd MM yyyy" name="mice_date" placeholder="" data-start-date="today">
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
                                                        data-minute-step="5" name="mice_time" placeholder="">
                                                </div>
                                            </div>
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
                                    <button type="submit" value="3" name="btn_mice" class="btn btn-holocene-gold"><b>SUBMIT</b></button>
                                </div>
                                <hr>
                            </div>

                            {{-- PROMOTION INQUIRY --}}
                            <div id="tab_promotion" style="display:none;">
                                <h4><b>{{ $menu['promotion'][0]['page_name'] }} Inquiry<b></h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="promotion_package" style="font-size:12px">Which package would you like to inquire?</label>
                                        <select name="promotion_product" class="form-control visitor-input">
                                            @foreach($promotions as $promotion)
                                            <option value="{{$promotion->id}}">{{$promotion->product_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="product_quantity" style="font-size:12px">For how many people should we prepare this product?</label>
                                        <div class="input-group">
                                            <span class="input-group-addon2 input-group-inquiry">
                                                <i class="fa fa-user"></i></span>
                                            <input type="text" value="{{ old('promotion_participant') }}" class="form-control visitor-input" name="promotion_participant"
                                                value="" placeholder="How many guests will be attending?" data-mask="9999">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="time_arriving" style="font-size:12px">When the activity/event date ?</label>
                                        <div class="row">
                                            <div class="col-lg-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon2 input-group-inquiry">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" value="{{ old('promotion_date') }}" class="form-control datepicker visitor-input"
                                                        data-format="D, dd MM yyyy" name="promotion_date" placeholder="" data-start-date="today"
                                                    >
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
                                                        data-minute-step="5" name="promotion_time" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="inq_details" style="font-size:12px">Inquiry Details</label>
                                        <textarea name= "promotion_details" class="form-control visitor-input textarea-nonresize" cols="1" rows="7"
                                        placeholder="Write your message...">{{ old('promotion_details') }}</textarea>
                                    </div>
                                </div><br>

                                <div class="row" align="right" style="margin-right:5px; margin-top: 10px;">
                                    <button type="submit" value="4" name="btn_promotion" class="btn btn-holocene-gold"><b>SUBMIT</b></button>
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
    const wellness_other_request = {!! json_encode(old('wellness_other_request')) !!};
    const rec_other_request = {!! json_encode(old('rec_other_request')) !!};
    const promotion_service_request = '{{ old('promotion_service_request') }}';

    const from = "{{$from}}";
    if(from !== '' && event_type == '') {
        $('#tab_general').fadeOut();
        $('#event_type').val('tab_'+from);
        $('#tab_'+from).fadeIn();
        $('#promotion_details').removeAttr('required');
        current_tab = 'tab_'+from;
    }
    if(event_type !== '') {
        $('#tab_general').fadeOut();
        $('#event_type').val(event_type);
        $('#'+event_type).fadeIn();
        $('#promotion_details').removeAttr('required');
    }
    if(event_type !== 'tab_general'){
        $('#general_details').removeAttr('required');
    }

    if(promotion_service_request){
        if(event_type == "tab_promotion" && promotion_service_request == "Information"){
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

    var other_request_wellness = document.getElementsByClassName('wellness_other_request');

    if(wellness_other_request){
        wellness_other_request.forEach(data => {
            for (let index = 0; index < other_request_wellness.length; index++) {
                if(data == other_request_wellness[index].value){
                    other_request_wellness[index].checked=true;
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
    if(current_tab == "tab_promotion"){

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
    utilsScript: "{{ asset('holocane/js/intl-phone/utils.js') }}", // just for formatting/placeholders etc
    });
</script>
@endsection
