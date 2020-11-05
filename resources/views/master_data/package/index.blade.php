@extends('templates/template')
@section("header_title") PACKAGE / PRODUCT @endsection
@section('content')
<div class="col-lg-12">
    <div class="row">
        <a href="/master_data/package/create" class="btn btn-horison btn-lg pull-right"><b>+ UNBOX YOUR PACKAGE</b></a>
        <div class="center" style="margin-top: 10vh;">
            <img src="{{asset('/images/dashboard/package_no_data.png')}}" alt="No Data" class="center" style="margin-top: 0px; margin-bottom: 30px;">
                <center>
                    <h4>Wait, you don’t have any available package.</h4>
                </center>
        </div>
    </div>
</div>
@endsection
