@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))

{{-- @extends('templates/visitor_template')

@section('content') 
<br><br>

<div class="row">
    <div class="col-lg-12">

    </div>
    <center style="">
        <h4>Service Unavailable</h4>
    </center>
</div>

<br><br>
@endsection --}}

