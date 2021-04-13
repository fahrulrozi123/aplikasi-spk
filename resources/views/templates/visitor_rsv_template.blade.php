<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Enjoy your experience at Horison Ultima with Bandung View while traveling in Bandung">
    <meta name="keywords" content="Horison, Ultima, Banudng, Hotel">
    <meta name="author" content="Horison Ultima Bandung">
    <title>{{ $setting->title }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-core.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{ asset('js/selectboxit/jquery.selectBoxIt.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/black.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/font-awesome/css/font-awesome.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/md-tripa.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/horison-custom.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/404-custom.css ') }}">
    <!-- International Phone Mask -->
    <link rel="stylesheet" href="{{ asset('css/intl-phone/intlTelInput.css') }}">
    {{-- custom slider --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slider-custom.css') }}">
    <script src="{{ asset('js/moment.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker-bs3.css') }}">
	<link rel="shortcut icon" href="{{ asset('/images/logo/'.$setting->favicon) }}" type="image/x-icon"/>

    <script src="{{ asset('js/jquery-1.11.3.min.js ') }}"></script>
    <script src="{{ asset('js/numeral/numeral.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <!-- International Phone Mask -->
    <script src="{{ asset('js/intl-phone/intlTelInput.js') }}"></script>
    <!-- sweet ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    {{-- custom datepicker --}}
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker-module-ranges/dist/index.js"></script>

    <script type="text/javascript">
        var home_url = "{{url('/')}}";

        $(window).load(function () {
            $(".lds-dual-ring").fadeOut("slow");;
        });
    </script>

    @yield('script')

</head>

<body class="page-body" data-url="">
    <div class="lds-dual-ring"></div>

    <div class="page-container horizontal-menu">

        <header class="navbar navbar-fixed-top shadow" style="">
            <!-- set fixed position by adding class "navbar-fixed-top" -->
            <div class="navbar-inner" style="margin:10px;">

                <!-- logo -->
                <div class="navbar-brand" style="padding-top:5px;">
                    <a href="/">
                        <img src="{{ asset('images/logo/' . $setting->logo) }}" width="170" height="50" alt="Horison Ultima Bandung" />
                    </a>
                </div>

                <!-- main menu -->

                <ul class="navbar-nav">

                    <li class="{{ Request::path() === 'rooms' ? 'active':'' }}">
                        <a href="{{ route('visitor.room') }}">
                            <span class="title">{{ $menu['room'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'recreation' ? 'active':'' }}">
                        <a href="{{ route('visitor.recreation') }}">
                            <span class="title">{{ $menu['recreation'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'wellness' ? 'active':'' }}">
                        <a href="{{ route('visitor.allysea_spa') }}">
                            <span class="title">{{ $menu['spa'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'mice' ? 'active':'' }}">
                        <a href="{{ route('visitor.mice_wedding') }}">
                            <span class="title">{{ $menu['mice'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'wedding' ? 'active':'' }}">
                        <a href="{{ route('visitor.wedding') }}">
                            <span class="title">{{ $menu['wedding'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'function-room' ? 'active':'' }}">
                        <a href="{{ route('visitor.function_room') }}">
                            <span class="title">{{ $menu['functionroom'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'newsletter' ? 'active':'' }}">
                        <a href="{{ route('visitor.newsletter') }}">
                            <span class="title">{{ $menu['newsletter'][0]['page_name'] }}</span>
                        </a>
                    </li>
                    <li class="{{ Request::path() === 'inquiry' ? 'active':'' }}">
                        <a href="{{ route('inquiry.index') }}">
                            <span class="title">{{ $menu['contact'][0]['page_name'] }}</span>
                        </a>
                    </li>

                </ul>

                <!-- notifications and other links -->
                <ul class="nav navbar-right">
                    <!-- reserveNow -->
                    {{-- <button id="reserveNow" class="btn btn-lg btn-horison-visitor navbar-button2 reserveNow"><b>Book Now</b></button> --}}
                    <!-- mobile only -->
                    <li class="visible-xs">
                        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                        <div class="horizontal-mobile-menu visible-xs">
                            <a href="#" class="with-animation" style="margin-top:0px;">
                                <!-- add class "with-animation" to support animation -->
                                <i class="entypo-menu"></i>
                            </a>
                        </div>
                    </li>
                </ul>

                {{-- <div class="row" >
                    <div class="col-xs-12 col-lg-12 shadow under-period" style="text-align: center; background-color:#fffb5d; position: absolute; bottom: -20px; left:0px;">
                        <small class="font-primary"><strong>This page is under testing period. Do not enter any personal information.</strong></small>
                    </div>
                </div> --}}

            </div>
        </header>

        <div class="">

        @if(isset($errors))
            @if (count($errors) > 0)
            <div class="alert alert-dismissible alert-danger" style="text-align:center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
            @endif
            @if (session('status'))
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: " {{ session('status') }}"
                    })
                });
            </script>
            @endif
            @if (session('warning'))
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Warning',
                        text: "{{ session('warning') }}"
                    })
                });
            </script>
            @endif

            <div class="col-lg-12">

                @yield('content')

                <footer>
                    <div class="row footer-bg-color">
                        <div class="container footer-bg-height">
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 footer-logo">
                                <img src="{{ asset('images/logo/' . $setting->logo) }}" width="200" height="56" alt="Horison Ultima Bandung" style="margin-top:55px;" />
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 visitor-footer" align="center">
                                <div class=row>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <p>
                                                @if($setting->so_instagram !== NULL)
                                                    <a href="{{ $setting->so_instagram }}" class="fa fa-instagram visitor-footer-icon" target="_blank"></a>
                                                @else
                                                    <a class="fa fa-instagram visitor-footer-icon" target="_blank"></a>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <p>
                                                @if($setting->so_facebook !== NULL)
                                                    <a href="{{ $setting->so_facebook }}" class="fa fa-facebook visitor-footer-icon" target="_blank"></a>
                                                @else
                                                    <a class="fa fa-facebook visitor-footer-icon" target="_blank"></a>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <p>
                                                @if($setting->so_twitter !== NULL)
                                                    <a href="{{ $setting->so_twitter }}" class="fa fa-twitter visitor-footer-icon"></a>
                                                @else
                                                    <a class="fa fa-twitter visitor-footer-icon"></a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 visitor-footer d-flex-column">
                                <div class="d-flex f-align-end">
                                    <p style="font-weight: normal;">
                                        {{ $setting->address }}
                                    </p>
                                    <span style="margin-top:10px; margin-left: 10px; font-size:18px"><i
                                            class="entypo-location"></i></span>
                                </div>
                                <div class="d-flex f-align-end">
                                    <p style="font-weight: normal;">
                                        {{ $setting->phone }}
                                    </p>
                                    <span style="margin-left: 10px; font-size:18px"><i
                                            class="entypo-phone"></i></span>
                                </div>
                                @if($setting->wa_number !== NULL)
                                    <div class="d-flex f-align-end">
                                        <p style="font-weight: normal;">
                                            {{ $setting->wa_number }}
                                        </p>
                                        <span style="margin-left: 15px; font-size:18px"><i class="fa fa-whatsapp" style="padding-right: 5px;"></i></span>
                                    </div>
                                @endif
                                <div class="d-flex f-align-end">
                                    <p style="font-weight: normal;">
                                        {{ $setting->email }}
                                    </p>
                                    <span style="margin-top:0px; margin-left: 10px; font-size:18px"><i
                                            class="entypo-mail"></i></span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-12" style="text-align: center;">
                                <h4>
                                    <small class="font-primary">Copyright &copy; 2020 <strong><a class="font-primary" href="https://tripasysfo.com/" target="_blank">Tripasysfo Development</a></strong>. All rights reserved.</small>
                                </h4>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>

        </div>

    </div>

    @include('visitor_site.landing_page.reserve_modal')

    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/reserve-popover.js') }}"></script>
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>
    <script src="{{ asset('js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.min.js') }}"></script>
    <script src="{{ asset('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/jquery.bootstrap.wizard.min.js') }}"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="{{ asset('js/neon-custom.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('js/icheck/icheck.min.js') }}"></script>
    <!-- Imported styles on this page -->
    <script src="{{ asset('js/fileinput.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/uikit/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/addons/css/markdownarea.css') }}">
    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/uikit/js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/marked.js') }}"></script>
    <script src="{{ asset('js/uikit/addons/js/markdownarea.min.js') }}"></script>
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/minimal/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/square/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/flat/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/futurico/futurico.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/polaris/polaris.css') }}">
    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/rickshaw/rickshaw.min.css') }}">
    <script src="{{ asset('js/jquery.peity.min.js') }}"></script>
    <!-- Demo Settings -->
    <script src="{{ asset('js/neon-demo.js') }}"></script>
    <script src="{{ asset('js/jquery number/jquery.number.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $(".numbers").number(true, 0);

        });

        $('.numberValidation').keyup(function () {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });
        $('.thousandSeperator').keyup(function () {
				var cek = parseInt(this.value);
				if(isNaN(cek)){
					this.value = "";
				}else{
					var hiddenInput = document.getElementById(this.id + "_input");
					hiddenInput.value = hiddenInput.value.replace(/[^0-9]*/g, '');
					hiddenInput.value = this.value.match(/\d/g).join("");
					this.value = formatRibuanTyping(this, this.value);
				}
			});

		 /* Fungsi formatRupiah */
		function formatRibuanTyping(rupiah, angka, prefix) {
			var number_string = angka.replace(/[^0-9]*/g, '').toString(),
				split = number_string.split(','),
				sisa = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if (ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
		}
    </script>

    <script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
</body>
</html>
