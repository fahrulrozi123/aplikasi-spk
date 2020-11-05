@extends('templates/template')
@section("header_title") ACCOUNT @endsection
@section('content')

@if(isset($user))
@php

$id = Crypt::encryptString($user->id);
$username = $user->username;
$name = $user->name;
$email = $user->email;
$phone = $user->phone;
$level = "$user->level";
$img = $user->img;
@endphp

@else

@php
$id = "";
$username = "";
$name = "";
$email = "";
$phone = "";
$level = "2";
$img = "";
@endphp
@endif

<ol class="breadcrumb bc-3">
    <li>
        <a href="/main_page/account">Account</a>
    </li>
    @if(isset($user))
    <li class="active">
        <strong>Edit</strong>
    </li>
    @else
    <li class="active">
        <strong>Register</strong>
    </li>
    @endif
</ol>

<form method="POST" action="{{ route('account.insert') }}" enctype="multipart/form-data" autocomplete="off">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$id}}">
    <div class="col-lg-12">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary shadow" data-collapsed="0">

                    <!-- panel head -->
                    <div class="panel-heading shadow">

                        <div class="panel-title">
                            <b>Account Information</b>
                        </div>
                        <div class="panel-options"></div>

                    </div>

                    <!-- panel body -->
                    <div class="panel-body">

                        <div class="row">

                            <div class="col-md-6">

                                <h4><b>Personal Information</b></h4>

                                <div class="container">
                                    <label for="field-1" class="col-sm-2 control-label">Profile Picture<br>
                                        <small class="text-muted"></small>
                                    </label>
                                    <div class="col-sm-5" style="margin-top:20px;">
                                        <h6><i>Choose a picture from your computer</i></h6>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <input type="hidden">
                                            <div class="fileinput-new avatar-img shadow" data-trigger="fileinput"
                                                style="cursor:pointer;">
                                                @if($img != null)
                                                    <img src="{{asset('/user/'.$img)}}" alt="Profile" class="avatar-img">
                                                @endif
                                                @if($img == "")
                                                    <img src="{{asset('images/dashboard/insert-here.png')}}" alt="Insert Here" class="avatar-img">
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists avatar-img shadow"></div>
                                            <div class="text-center" style="margin-top:20px;">
                                                <span class="btn btn-horison-gold btn-file shadow">
                                                    <span class="fileinput-new">
                                                        <i class="glyphicon glyphicon-circle-arrow-up"></i>BrowseFiles
                                                    </span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" id="img" name="img" accept="image/*" class="validateImage" onchange="fileValidation();">
                                                </span>
                                                <a href="#" class="btn btn-orange fileinput-exists shadow" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="container">
                                    <label for="field-1" class="col-sm-2 control-label">Name<br>
                                        <small class="text-muted"></small>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control " maxLength ="20" value="{{old('name', $name)}}" name="name" id="profile_name" placeholder="Profile Name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="container">
                                    <label for="field-1" class="col-sm-2 control-label">Email Address<br>
                                        <small class="text-muted"></small>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control " maxLength ="100" name="email" value="{{old('email', $email)}}" id="email_address" placeholder="Email Address" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="container">
                                    <label for="field-1" class="col-sm-2 control-label">Phone Number<br>
                                        <small class="text-muted"></small>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control numberValidation" maxLength ="20" name="phone" value="{{old('phone', $phone)}}" id="phone_number" placeholder="Phone Number" required>
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h4><b>Account Information</b></h4>

                                <div class="container">
                                    <label for="field-1" class="col-sm-2 control-label">Username<br><small
                                            class="text-muted"></small></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control " maxLength ="20" name="username" value="{{old('username', $username)}}" id="username" placeholder="Username" pattern="^\S+$" title="Spaces not allowed in Username." required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><br>
                                @if(isset($user) && !$myAccount || !isset($user))
                                <input type="hidden" name="from" value="account">
                                <div class="container">
                                    <label for="field-1" class="col-sm-2 control-label">Account Role<br><small
                                            class="text-muted"></small></label>
                                    <div class="col-sm-2">
                                        <div class="radio radio-replace color-primary" style="margin-bottom: 10px">
                                            <input type="radio" id="rd-0" name="level" value="0">
                                            <label>Administrator</label>
                                        </div>

                                        <div class="radio radio-replace color-primary" style="margin-bottom: 5px">
                                            <input type="radio" id="rd-2" name="level" value="2">
                                            <label>Front Office</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="radio radio-replace color-primary">
                                            <input type="radio" id="rd-1" name="level" value="1">
                                            <label>Marketing</label>
                                        </div>
                                    </div>
                                </div><br>
                                @else
                                <input type="hidden" name="from" value="profile">
                                <input type="hidden" name="level" value="{{$level}}">
                                @endif
                                @if(isset($user))
                                <div id="change-password" class="">
                                    <div class="container">
                                        <label for="field-1" class="col-sm-2 control-label">Password<br><small
                                                class="text-muted"></small></label>
                                        <label class="col-sm-2 control-label" id="change_password"><a style="color:#1B729E;" onclick="showPassword();">Change
                                                Password</a></label>
                                        <div class="col-sm-4 hidden" id="password">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>
                                    <div class="container">
                                        <label for="field-1" class="col-sm-2 control-label hidden" id="label_pw_confirm">Verify
                                            Password<br><small class="text-muted"></small></label>
                                        <div class="col-sm-4 hidden" id="password_confirm">
                                            <input type="password" class="form-control " name="pw_confirm"
                                                id="verify_password" placeholder="Verify Password">
                                            @error('pw_confirm')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="container error-validation">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-4">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div><br>
                                @else
                                <div class="container">
                                    <label for="field-1" class="col-sm-2 control-label">Password<br>
                                        <small class="text-muted"></small>
                                    </label>
                                    <div class="col-sm-4" id="password">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="container">
                                    <label for="field-1" class="col-sm-2 control-label">Verify
                                        Password<br><small class="text-muted"></small></label>
                                    <div class="col-sm-4" id="password_confirm">
                                        <input type="password" class="form-control " name="pw_confirm"
                                            id="verify_password" placeholder="Verify Password">
                                        @error('pw_confirm')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <br><br>
                                <img src="{{ asset('/images/dashboard/account.svg') }}" class="img-responsive">
                            </div>
                        </div>

                        <br><br><br>

                        <div class="row" align="center">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <a href="/main_page/account" class="btn btn-white btn-lg shadow"
                                    style="width: 150px; margin-right:3px; font-size:13px;">Cancel</a>
                                <button class="btn btn-horison-gold btn-lg shadow"
                                    style="width: 150px; margin-left:3px; font-size:13px;">Save</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
<script>

    $('#rd-{{$level}}').attr('checked', 'checked');

    function showPassword() {
        $('#password').removeClass("hidden");
        $('#password_confirm').removeClass("hidden");
        $('#label_pw_confirm').removeClass("hidden");
        $('#change_password').addClass("hidden");
        $( ".error-validation" ).hide();
    }

</script>
@endsection
