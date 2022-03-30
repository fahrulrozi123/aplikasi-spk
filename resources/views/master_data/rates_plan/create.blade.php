@extends('templates/template')
@section('header_title')
CREATE RATES PLAN
@endsection
@section('content')
<div class="col-lg-6">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body shadow">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <label for="rates_name">Rates Name</label>
                        <input type="text" class="form-control" id="rates_name" name="room_name" value=""
                            placeholder="Rates Name">
                        <br>

                        {{-- Cancellation Policy --}}
                        <h5 class="mt mb">
                            <strong>Cancellation Policy</strong>
                        </h5>
                        <p class="mt mb">Applied cancellation policy for this rate plan</p>
                        <div class="radio radio-replace color-primary" style="margin-bottom: 5px;">
                            <input type="checkbox" id="policy" name="policy" value="0">
                            <label><strong>Flexible - 4 Days</strong></label>
                        </div>
                        <div class="radio radio-replace color-primary">
                            <input type="checkbox" id="policy" name="policy" value="0">
                            <label><strong>Apply First Night Cancellation Fee</strong>upon cancellation 4 days prior
                                before arrival</label>
                        </div>
                        <br>

                        {{-- Meals --}}
                        <h5 class="mt mb">
                            <strong>Meals</strong>
                        </h5>
                        <p class="mt mb">Applied meals plan for this rate plan</p>
                        <div class="radio radio-replace color-primary" style="margin-bottom: 5px;">
                            <input type="checkbox" id="policy" name="policy" value="0">
                            <label>Include Meal</label>
                        </div>
                        <div class="radio radio-replace color-primary">
                            <input type="checkbox" id="policy" name="policy" value="0">
                            <label>No, don’t add meal plan for this rate plan</label>
                        </div>
                        <br>

                        {{-- Bookables --}}
                        <h5 class="mt mb">
                            <strong>Bookables</strong>
                        </h5>
                        <p class="mt mb">How many days before check-in can guest book this rate plan?</p>
                        <div class="radio radio-replace color-primary" style="margin-bottom: 5px;">
                            <input type="checkbox" id="policy" name="policy" value="0">
                            <label>Any days</label>
                        </div>
                        <div class="radio radio-replace color-primary">
                            <input type="checkbox" id="policy" name="policy" value="0">
                            <label>Set number of days before check in</label>
                        </div>
                        <br>

                        {{-- Minimum length of stay --}}
                        <h5 class="mt mb">
                            <strong>Minimum length of stay</strong>
                        </h5>
                        <p class="mt mb">How many nights require for guest to book for this rate plan?</p>
                        <div class="radio radio-replace color-primary" style="margin-bottom: 5px;">
                            <input type="checkbox" id="policy" name="policy" value="0">
                            <label>No minimum</label>
                        </div>
                        <div class="radio radio-replace color-primary">
                            <input type="checkbox" id="policy" name="policy" value="0">
                            <label>Set minimum nights</label>
                        </div>
                        <br>
                        <hr>

                        {{-- Apply rates to room types --}}
                        <h5 class="mt mb"><strong>Apply rates to room types</strong></h5>
                        <p class="mt mb">Which room type will be bookable with this rate plans?</p>
                        <div class="row">
                            @foreach($rooms as $room)
                            <div class="col-lg-4">
                                <div class="checkbox checkbox-replace color-primary">
                                    <input type="checkbox" id="rd-1" name="room_name[]" value="0">
                                    <label>{{ $room->room_name }}</label>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="pull-right">
            <a class="btn btn-white btn-padding" href="{{ route('rates_plan.index') }}">
                Cancel
            </a>
            <button type="button" class="btn btn-horison-gold btn-padding">Save Rate Plan</button>
        </div>
    </div>
</div>

<script>
</script>
@endsection
