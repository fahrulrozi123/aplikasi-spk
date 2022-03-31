@extends('templates/template')
@section('header_title')
    NEWS
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="row">
            <a href="/master_data/news/create" class="btn btn-horison btn-lg pull-right">
                <strong>+ ADD NEWS</b>
            </a>
            <div class="center" style="margin-top: 10vh;">
                <img src="{{ asset('/images/dashboard/fr_no_data.png') }}" alt="No Data" class="center"
                    style="margin-top: 0px;">
                <center>
                    <h4>It’s seem you doesn’t have any news</h4>
                    <h4>Try adding your news!</h4>
                </center>
            </div>
        </div>
    </div>
@endsection
