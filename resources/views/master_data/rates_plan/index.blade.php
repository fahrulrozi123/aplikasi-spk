@extends('templates/template')
@section('header_title')
RATES PLAN
@endsection
@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <p>Create and review different types of rate plans for your customers. You can manage availability and
                pricing in Allotment. You have 3 rates plan.</p>
        </div>
        <div class="col-lg-6 col-sm-12">
            <a href="/master_data/rates-plan/create" class="btn btn-horison btn-lg pull-right">
                <b>+ ADD RATE PLAN</b>
            </a>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body shadow">
                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-md-12">
                        <h5 style="margin-bottom:-5px;">
                            <strong>Room with Breakfast</strong>
                        </h5>
                        <p class="mt">Applied for Deluxe Room, Super Deluxe Room, Executive Room, Executive
                            Suite Room
                            and
                            President Suite room</p>
                    </div>
                    <div class="col-xs-12 col-lg-6 col-md-6">
                        <h5 style="margin-bottom:-5px;">
                            <strong>Room with Breakfast</strong>
                        </h5>
                        <ul class="checklist-ul mt">
                            <li class="mt text-muted">No Meal</li>
                            <li class="mt">Allow extra beds</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-lg-6 col-md-6">
                        <h5 style="margin-bottom:-5px;">
                            <strong>Cancel Policy</strong>
                        </h5>
                        <p class="mt"><strong>Night applied</strong> applied upon cancellation 4 days prior
                            before
                            arrival</p>
                    </div>

                    <div class="col-xs-12 col-lg-6 col-md-6">
                        <a href="/master_data/room/edit/" class="btn btn-horison pull-right">
                            <b>Manage Rates Plan</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
</script>
@endsection
