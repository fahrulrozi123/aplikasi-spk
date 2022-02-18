<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $setting->title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css')}}">

    <link rel="stylesheet" href="{{ asset('js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-core.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{ asset('js/fullcalendar/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ asset('js/selectboxit/jquery.selectBoxIt.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/white.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/font-awesome/css/font-awesome.min.css ') }}">

    <link rel="stylesheet" href="{{ asset('css/md-tripa.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/horison-custom.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/404-custom.css ') }}">

    <link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="shortcut icon" href="{{ asset('/images/logo/'.$setting->favicon) }}" type="image/x-icon" />

    {{-- <script type="text/javascript" src="{{ asset('js/jquery.hislide.js') }}"></script> --}}
    <script src="{{ asset('js/datatables/datatables.js') }}"></script>

    <script src="{{ asset('js/jquery-1.11.3-admin.min.js ') }}"></script>

    <script src="{{ asset('js/numeral/numeral.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <!-- AmChart -->
    {{-- <script src="{{ asset('js/amcharts/core.js') }}"></script>
    <script src="{{ asset('js/amcharts/charts.js') }}"></script> --}}

    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>

    <script src="{{ asset('js/amcharts/animated.js') }}"></script>
    <!-- Imask -->
    <script src="https://unpkg.com/imask"></script>

    <!-- sweet ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- <link href="{{ asset('js/fullcalendar4/packages/core/main.css') }}" rel='stylesheet' />
	<link href="{{ asset('js/fullcalendar4/packages/daygrid/main.css') }}" rel='stylesheet' />


	<script src="{{ asset('js/fullcalendar4/packages/core/main.js') }}"></script>
	<script src="{{ asset('js/fullcalendar4/packages/daygrid/main.js') }}"></script> -->

    {{-- CUSTOM DATEPICKER --}}
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker-module-ranges/dist/index.js"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

    <script type="text/javascript">
        var home_url = "{{url('/')}}";

        $(window).load(function () {
            $(".lds-dual-ring-admin").fadeOut("slow");;
        });
    </script>

    @yield('script')

</head>

<body class="page-body page-left-in">
    <div class="lds-dual-ring-admin"></div>

    <meta name="csrf_token" content="{{ csrf_token() }}">

    <div class="page-container">

        @include('templates/menu')

        <div class="main-content">

            <div class="containerheader">
                <img src="{{ asset('/images/dashboard/header.png') }}" class="img-responsive">
                <div class="bottom-left">
                    <h2><strong>@yield('header_title')</strong></h2>
                </div>
            </div>
            <br>
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

            @yield('content')

            <footer class="footer-office">
                <center>
                    <h4>
                        <small>Copyright &copy; 2020
                            <strong><a class="font-primary" href="https://tripasysfo.com/" target="_blank">Tripasysfo
                                    Development</a></strong>. All rights reserved.</small>
                    </h4>
                </center>
            </footer>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    {{--
    <link rel="stylesheet" href="{{ asset('js/rickshaw/rickshaw.min.css') }}"> --}}
    <script src="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>

    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('js/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('js/neon-calendar.js') }}"></script>
    {{-- <script src="{{asset('assets/js/neon-charts.js') }}"></script> --}}

    <script src="{{ asset('js/jvectormap/jquery-jvectormap-europe-merc-en.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/rickshaw/vendor/d3.v3.js') }}"></script>
    {{-- <script src="{{ asset('js/rickshaw/rickshaw.min.js') }}"></script> --}}
    <script src="{{ asset('js/raphael-min.js') }}"></script>
    {{-- <script src="{{ asset('js/morris.min.js') }}"></script> --}}

    <script src="{{ asset('js/toastr.js') }}"></script>

    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/joinable.js') }}"></script>
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
    <script src="{{ asset('js/jquery.inputmask.bundle.js')}}"></script>

    <!-- Text Editor WYSIWYG -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/wysihtml5/bootstrap-wysihtml5.css') }}">

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>
    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{ asset('js/fileinput.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>
    <!-- Text Editor CKEditor -->
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/css/uikit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/addons/css/markdownarea.css') }}">

    <!-- Bottom scripts (common) -->

    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/uikit/js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('js/marked.js') }}"></script>
    <script src="{{ asset('js/uikit/addons/js/markdownarea.min.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/markdown/markdown.js') }}"></script>
    <script src="{{ asset('js/codemirror/addon/mode/overlay.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/gfm/gfm.js') }}"></script>

    <!-- Advanced Plugins -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/minimal/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/square/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/flat/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/futurico/futurico.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/polaris/polaris.css') }}">
    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/neon-charts.js') }}"></script>
    <!-- Demo Settings -->
    <script src="{{ asset('js/neon-demo.js') }}"></script>
    <script src="{{ asset('js/jquery number/jquery.number.min.js')}}"></script>


    <script type="text/javascript">
        function fileValidation(){
			let fi = document.getElementsByClassName('validateImage');
			fi = fi[0];
			// Check if any file is selected.
			if (fi.files.length > 0) {
				for (let i = 0; i <= fi.files.length - 1; i++) {

					const fsize = fi.files.item(i).size;
					const fname = fi.files.item(i).name;
					const file = Math.round((fsize / 1024));
					// The size of the file.
					if (file >= 2048) {
						alert(
						"File "+fname+" too Big, please select a file less than 2mb !");
						fi.value = '';
					}
				}
			}
		}

		$(function(){
			$(".numbers").number(true,0);
		});

		$('.numberValidation').keyup(function () {
				this.value = this.value.replace(/[^0-9\.]/g,'');
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
		//END

    </script>

    <script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
</body>
</html>
