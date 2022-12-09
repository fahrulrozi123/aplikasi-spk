@extends('layouts.admin')
@section('title')
  Dashboard | Admin Page
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group pull-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">Kelompok 3</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Welcome !</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->


<div class="row">

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fi-layers float-right"></i>
            <h6 class="text-muted text-uppercase mb-3">Teknik</h6>
            <h4 class="mb-3">{{$Teknik}} </span></h4>
        </div>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fi-tag float-right"></i>
            <h6 class="text-muted text-uppercase mb-3">FIKES</h6>
            <h4 class="mb-3">{{$FIKES}} </h4>

        </div>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fi-briefcase float-right"></i>
            <h6 class="text-muted text-uppercase mb-3">Hukum</h6>
            <h4 class="mb-3" data-plugin="counterup">{{$Hukum}} </h4>
        </div>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fi-briefcase float-right"></i>
            <h6 class="text-muted text-uppercase mb-3">FEB</h6>
            <h4 class="mb-3" data-plugin="counterup">{{$FEB}} </h4>
        </div>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fi-briefcase float-right"></i>
            <h6 class="text-muted text-uppercase mb-3">FAI</h6>
            <h4 class="mb-3" data-plugin="counterup">{{$FAI}} </h4>
        </div>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fi-briefcase float-right"></i>
            <h6 class="text-muted text-uppercase mb-3">FISIP</h6>
            <h4 class="mb-3" data-plugin="counterup">{{$FISIP}} </h4>
        </div>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card-box tilebox-one">
            <i class="fi-briefcase float-right"></i>
            <h6 class="text-muted text-uppercase mb-3">FKIP</h6>
            <h4 class="mb-3" data-plugin="counterup">{{$FKIP}} </h4>
        </div>
    </div>
</div>
<h4>Total: {{$mahasiswa}} Mahasiswa </h4>



<!-- end row -->

@endsection
