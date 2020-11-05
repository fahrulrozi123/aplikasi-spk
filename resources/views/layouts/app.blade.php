<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $setting->title }}</title>

    <link rel="stylesheet" href="{{ asset('js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-core.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{ asset('js/selectboxit/jquery.selectBoxIt.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/white.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-icons/font-awesome/css/font-awesome.min.css ') }}">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon" />

	<link rel="stylesheet" href="{{ asset('css/horison-custom.css ') }}">
    <script src="{{ asset('js/jquery-1.11.0.min.js') }}" defer></script>

    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/datatables/TableTools.min.js') }}" defer></script>
    <script src="{{ asset('js/dataTables.bootstrap.js') }}" defer></script>
    <script src="{{ asset('js/datatables/jquery.dataTables.columnFilter.js') }}" defer></script>
    <script src="{{ asset('js/datatables/lodash.min.js') }}" defer></script>
    <script src="{{ asset('js/datatables/responsive/js/datatables.responsive.js') }}" defer></script>
    <script src="{{ asset('js/gsap/main-gsap.js') }}" defer></script>
    <script src="{{ asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script src="{{ asset('js/joinable.js') }}" defer></script>
    <script src="{{ asset('js/resizeable.js') }}" defer></script>
    <script src="{{ asset('js/neon-api.js') }}" defer></script>
    <script src="{{ asset('js/select2/select2.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}" defer></script>
    <script src="{{ asset('js/typeahead.min.js') }}" defer></script>
    <script src="{{ asset('js/selectboxit/jquery.selectBoxIt.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-timepicker.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-colorpicker.min.js') }}" defer></script>
    <script src="{{ asset('js/daterangepicker/moment.min.js') }}" defer></script>
    <script src="{{ asset('js/daterangepicker/daterangepicker.js') }}" defer></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}" defer></script>
    <script src="{{ asset('js/icheck/icheck.min.js') }}" defer></script>
    <script src="{{ asset('js/neon-chat.js') }}" defer></script>
    <script src="{{ asset('js/neon-custom.js') }}" defer></script>
    <script src="{{ asset('js/neon-demo.js') }}" defer></script>
    {{-- <script src="{{ asset('js/neon-login.js') }}" defer></script> --}}

</head>
    @yield('content')
</html>
