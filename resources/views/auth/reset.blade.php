@extends('layouts.app')
@section('title','Horison Tirta Sanita')
@section('content')
    <style type="text/css">
    .login-page .login-header {
        position: relative;
        background-image: url("{{asset('images/Horison Login Header.png')}}") !important;
        padding: 100px 0;
        -moz-transition: all 550ms ease-in-out;
        -webkit-transition: all 550ms ease-in-out;
        -o-transition: all 550ms ease-in-out;
        transition: all 550ms ease-in-out;
    }


    @media only screen and (max-width: 700px) {
        .login-page .login-header {
            background-image: url("{{asset('images/Horison Login Header.png')}}") !important;
            background-size: 500px !important;
        }
    }


    @media only screen and (min-width: 750px) {
        .login-page .login-header {
            background-image: url("{{asset('images/Horison Login Header.png')}}") !important;
            /* background-size: 500px !important; */
            background-size: 1000px !important;
        }
    }


    @media only screen and (min-width: 1200px) {
        .login-page .login-header {
            background-image: url("{{asset('images/Horison Login Header.png')}}") !important;
            background-size: 1250px !important;
        }
    }


    @media only screen and (min-width: 1300px) {
        .login-page .login-header {
            height: 48vh;
            background-image: url("{{asset('images/Horison Login Header.png')}}") !important;
            background-size: 1400px !important;
        }
    }

    @media only screen and (min-width: 1400px) {
        .login-page .login-header {
            background-image: url("{{asset('images/Horison Login Header.png')}}") !important;
            background-size: 1570px !important;
        }
    }

    @media only screen and (min-width: 1600px) {
        .login-page .login-header {
            background-image: url("{{asset('images/Horison Login Header.png')}}") !important;
            background-size: 1690px !important;
        }
    }

    @media only screen and (min-width: 1700px) {
        .login-page .login-header {
            background-image: url("{{asset('images/Horison Login Header.png')}}") !important;
            background-size: 1750px !important;
        }
    }

    @media only screen and (min-width: 1900px) {
        .login-page .login-header {
            background-image: url("{{asset('images/Horison Login Header.png')}}") !important;
            background-size: 1950px !important;
        }
    }

    .teks {
        color: black !important;
    }
    </style>

<body class="page-body login-page login-form-fall">
    <!-- This is needed when you send requests via Ajax -->
    <script type="text/javascript">
    var baseurl = '';
    </script>
    <div class="login-container">

        <div class="login-header login-caret">

            <div class="login-content head_logo">

                <a href="index.html" class="logo">
                    <img src="{{asset('images/sidebar.png')}}" width="240" alt="" />
                </a>

                <p class="description teks">Silahkan Masukan E-mail dan Password Baru.</p>
                <br>
                <!-- progress bar indicator -->

            </div>

        </div>

{{-- @foreach ($collection as $item) --}}

            <div class="login-content">
                <form role="form" method="" action="" id="form_login">

                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-mail"></i>
                            </div>
                            <input type="text" class="form-control" name="username" id="username" value="" placeholder="E-Mail" autocomplete="off" />
                        </div>

                    </div>
                    {{-- @if ($errors->has('username'))
                    <br><span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
					@endif --}}

                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-key"></i>
                            </div>
                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" autocomplete="off" />
                        </div>

                    </div>

                    {{-- @if ($errors->has('password'))
                    <br><span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif --}}

                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-help"></i>
                            </div>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" autocomplete="off" />
                        </div>

                    </div>

                    <br>

                    <div class="form-group">
                        <button type="submit" name="login" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-ccw"></i>
                        Reset Password
                        </button>
					</div>

					<div class="login-bottom-links">

                        <a href="/login" class="link">
                            <i class="entypo-lock"></i>
                            Return to Login Page
                        </a>

                    </div>


                </form>

        </div>
    </div>
</body>

{{-- @endforeach --}}
    @endsection
