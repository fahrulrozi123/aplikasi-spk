@extends('templates/template')
@section('header_title')
    AMENITIES
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="row">
            <a href="/master_data/amenities/create" class="btn btn-horison btn-lg pull-right">
                <strong>MANAGE AMENITIES</strong>
            </a>
            <div class="center">
                <img src="{{ asset('/images/undraw_empty_xct9.png') }}" alt="" style="" class="center">
                <center>
                    <h4>You don’t have any Amenities to show</h4>
                </center>
            </div>
        </div>
    </div>
@endsection
