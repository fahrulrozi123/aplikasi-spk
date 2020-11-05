<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />
    <title>Horison Tirta Sanita</title>

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
    <link rel="stylesheet" href="{{ asset('css/skins/black.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/font-awesome/css/font-awesome.min.css ') }}">


    <link rel="stylesheet" href="{{ asset('css/md-tripa.css ') }}">
    <link rel="stylesheet" href="{{ asset('css/horison-custom.css ') }}">

    {{-- custom slider --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slider-custom.css') }}">
    {{-- batas suci --}}

    <link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="shortcut icon" href="{{asset('images/icon.png')}}" type="image/x-icon" />


    <script src="{{ asset('js/datatables/datatables.js') }}"></script>
    <script src="{{ asset('js/jquery-1.11.3.min.js ') }}"></script>

    <script src="{{ asset('js/numeral/numeral.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

    <script type="text/javascript">
        var home_url = "{{url('/')}}";

    </script>

    @yield('script')


</head>


<body class="page-body" data-url="">

    <!-- form reserve -->





    <div class="page-container horizontal-menu">

        <header class="navbar navbar-fixed-top shadow " style="padding-bottom:25px;">
            <!-- set fixed position by adding class "navbar-fixed-top" -->
            <div class="navbar-inner" style="margin:10px;">

                <!-- logo -->
                <div class="navbar-brand mt-10" style="padding-top:5px;">
                    <a href="/">
                        <img src="{{asset('/images/sidebar.png')}}" width="170" alt="" />
                    </a>
                </div>

                <!-- main menu -->
                <div class="container">
                    <form id="rootwizard-2" method="post" action="" class="form-wizard validate custwizard">

                        <div class="steps-progress">
                            <div class="progress-indicator"></div>
                        </div>

                        <ul>
                            <li id="tab1" class="active">
                                <a href="#"><span>1</span>Customer Information</a>
                            </li>
                            <li id="tab2">
                                <a href="#"><span>2</span>Payment Information</a>
                            </li>
                            <li id="tab3">
                                <a href="#"><span>3</span>Booking Confirmed!</a>
                            </li>
                        </ul>
                </div>



            </div>
        </header>

        <div class="">

            @if (count($errors) > 0)
            <div class="alert alert-dismissible alert-danger" style="text-align:center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-dismissible alert-success" style="text-align:center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('status') }}
            </div>
            @endif
            @if (session('warning'))
            <div class="alert alert-dismissible alert-danger" style="text-align:center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('warning') }}
            </div>
            @endif

            <div class="col-lg-12">

                @yield('content')

                <footer>
                    <div class="row" style="background-color:#333333;">
                        <div class="container" style="background-color:#333333; height:185px;">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <img src="{{asset('/images/sidebar.png')}}" width="200" alt=""
                                    style="margin-top:55px;" />
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 visitor-footer" align="center">
                                <div class=row>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <p><a href="https://twitter.com/cemaragunung"
                                                    class="fa fa-twitter visitor-footer-icon"></a></p>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <p><a href="https://www.instagram.com/jktinfo/?hl=id"
                                                    class="fa fa-instagram visitor-footer-icon"></a></p>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <p><a href="https://www.facebook.com/pages/Tripasysfo-Development/106278127427149"
                                                    class="fa fa-facebook visitor-footer-icon"></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 visitor-footer d-flex-column">
                                <div class="d-flex f-align-end">
                                    <p>
                                        Jl. Raya Panawuan No. 98 - Sangkanhurip,<br>
                                        Kuningan Jawa Barat, Kuningan
                                    </p>
                                    <span style="margin-top:10px; margin-left: 10px; font-size:18px"><i
                                            class="entypo-location"></i></span>
                                </div>
                                <div class="d-flex f-align-end">
                                    <p>
                                        0232 613061<br>
                                        +62 812 2335 2324
                                    </p>
                                    <span style="margin-top:7px; margin-left: 10px; font-size:18px"><i
                                            class="entypo-phone"></i></span>
                                </div>
                                <div class="d-flex f-align-end">
                                    <p>
                                        horison@email.com
                                    </p>
                                    <span style="margin-top:0px; margin-left: 10px; font-size:18px"><i
                                            class="entypo-mail"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>

        </div>

    </div>


    @include('visitor_site.landing_page.reserve_modal')


    <link rel="stylesheet" href="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/rickshaw/rickshaw.min.css') }}">
    <script src="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>

    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/reserve-popover.js') }}"></script>

    <script src="{{ asset('js/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('js/neon-calendar.js') }}"></script>
    {{-- <script src="{{asset('assets/js/neon-charts.js') }}"></script> --}}

    <script src="{{ asset('js/jvectormap/jquery-jvectormap-europe-merc-en.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/rickshaw/vendor/d3.v3.js') }}"></script>
    <script src="{{ asset('js/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('js/raphael-min.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>

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
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/jquery.bootstrap.wizard.min.js') }}"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="{{ asset('js/neon-custom.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>

    <script src="{{ asset('js/moment.min.js') }}"></script>

    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('js/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.bundle.js')}}"></script>

    <!-- Text Editor WYSIWYG -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/wysihtml5/bootstrap-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{ asset('js/selectboxit/jquery.selectBoxIt.css') }}">

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/joinable.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>
    <script src="{{ asset('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>


    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('js/fileinput.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>

    {{-- <!-- JavaScripts initializations and stuff -->
	<script src="{{ asset('js/neon-custom.js') }}"></script> --}}


    <!-- Text Editor CKEditor -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/wysihtml5/bootstrap-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{ asset('js/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/css/uikit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/uikit/addons/css/markdownarea.css') }}">

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/joinable.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>
    <script src="{{ asset('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>


    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('js/uikit/js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('js/marked.js') }}"></script>
    <script src="{{ asset('js/uikit/addons/js/markdownarea.min.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/markdown/markdown.js') }}"></script>
    <script src="{{ asset('js/codemirror/addon/mode/overlay.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('js/codemirror/mode/gfm/gfm.js') }}"></script>
    <script src="{{ asset('js/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>



    <!-- Advanced Plugins -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/select2/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('js/selectboxit/jquery.selectBoxIt.css') }}">
    <link rel="stylesheet" href="{{ asset('js/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/minimal/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/square/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/flat/_all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/futurico/futurico.css') }}">
    <link rel="stylesheet" href="{{ asset('js/icheck/skins/polaris/polaris.css') }}">

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/joinable.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>

    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.min.js') }}"></script>
    <script src="{{ asset('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('js/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>



    <!-- Charts -->
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('js/rickshaw/rickshaw.min.css') }}">

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/joinable.js') }}"></script>
    <script src="{{ asset('js/resizeable.js') }}"></script>
    <script src="{{ asset('js/neon-api.js') }}"></script>
    <script src="{{ asset('js/rickshaw/vendor/d3.v3.js') }}"></script>


    <!-- Imported scripts on this page -->
    <script src="{{ asset('js/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('js/raphael-min.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <script src="{{ asset('js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/neon-charts.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/neon-chat.js') }}"></script>



    <!-- Demo Settings -->
    <script src="{{ asset('js/neon-demo.js') }}"></script>
    <script src="{{ asset('js/jquery number/jquery.number.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $(".numbers").number(true, 0);

        });

        // Pattern for numbers
        // if ($(".numberValidation").length > 0) {
        //     VMasker($(".numberValidation")).maskNumber();
        // }

        $('.numberValidation').keyup(function () {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });

        // // Pattern for NPWP
        // if ($(".npwpMaskingTextBox").length > 0) {
        //     VMasker($(".npwpMaskingTextBox")).maskPattern('99.999.999.9-999.999');
        // }

    </script>


    {{-- <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>

</body>

</html>
