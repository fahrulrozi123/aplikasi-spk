@extends('templates/template')
@section('header_title')
    ROOMS
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="row">
            <a href="/master_data/room/create" class="btn btn-horison btn-lg pull-right"><b>+ ADD NEW ROOM</b></a>
            <div class="center" style="margin-top: 10vh;">
                <img src="{{ asset('/images/dashboard/fr_no_data.png') }}" alt="No Data" class="center"
                    style="margin-top: 0px;">
                <center>
                    <h4>It’s seem you doesn’t have any room</h4>
                    <h4>Try adding your room!</h4>
                </center>
            </div>
        </div>
    </div>
@endsection
