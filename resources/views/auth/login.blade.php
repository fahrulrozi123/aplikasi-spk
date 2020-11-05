@extends('layouts.app')
@section('title','Horison Tirta Sanita')
@section('content')
    <style type="text/css">
    .login-page .login-header {
        position: relative;
        /* background-image: url("{{asset('images/Horison Login Header.png')}}") !important; */
        padding: 100px 0;
        -moz-transition: all 550ms ease-in-out;
        -webkit-transition: all 550ms ease-in-out;
        -o-transition: all 550ms ease-in-out;
        transition: all 550ms ease-in-out;
    }


    @media only screen and (max-width: 700px) {
        .login-page .login-header {
            /* background-image: url("{{asset('images/Horison Login Header.png')}}") !important; */
            background-size: 500px !important;
        }
    }


    @media only screen and (min-width: 750px) {
        .login-page .login-header {
            /* background-image: url("{{asset('images/Horison Login Header.png')}}") !important; */
            /* background-size: 500px !important; */
            background-size: 1000px !important;
        }
    }


    @media only screen and (min-width: 1200px) {
        .login-page .login-header {
            /* background-image: url("{{asset('images/Horison Login Header.png')}}") !important; */
            background-size: 1250px !important;
        }
    }


    @media only screen and (min-width: 1300px) {
        .login-page .login-header {
            height: 48vh;
            /* background-image: url("{{asset('images/Horison Login Header.png')}}") !important; */
            background-size: 1400px !important;
        }
    }

    @media only screen and (min-width: 1400px) {
        .login-page .login-header {
            /* background-image: url("{{asset('images/Horison Login Header.png')}}") !important; */
            background-size: 1570px !important;
        }
    }

    @media only screen and (min-width: 1600px) {
        .login-page .login-header {
            /* background-image: url("{{asset('images/Horison Login Header.png')}}") !important; */
            background-size: 1690px !important;
        }
    }

    @media only screen and (min-width: 1700px) {
        .login-page .login-header {
            /* background-image: url("{{asset('images/Horison Login Header.png')}}") !important; */
            background-size: 1750px !important;
        }
    }

    @media only screen and (min-width: 1900px) {
        .login-page .login-header {
            /* background-image: url("{{asset('images/Horison Login Header.png')}}") !important; */
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

                <a href="/login" class="logo">
                    <img src="{{ asset('images/logo/' . $setting->logo) }}" width="240" alt="tirtasanitaresort" />
                </a>


                <br>
                <!-- progress bar indicator -->

            </div>

        </div>

{{-- @foreach ($collection as $item) --}}

            <div class="login-content">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-user"></i>
                            </div>
                            <input type="text" class="form-control" name="username" id="username" value="" placeholder="Username" autocomplete="off" required/>
                        </div>

                    </div>
                    @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror

                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-key"></i>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required/>
                        </div>

                    </div>
                    @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror

					<div class="form-group" align="left">


					</div>

					<br>

                    <div class="form-group">
                        <button type="submit" name="login" class="btn btn-horison btn-block">
                        <i class="entypo-login"></i>
                        Log In
                        </button>
					</div>

					<div class="login-bottom-links">

					</div>


                </form>

        </div>
    </div>
</body>

{{-- @endforeach --}}
    @endsection
