@extends('templates/template')
@section("header_title") PAGE SETTING @endsection
@section('content')

{{-- @if(isset($setting))
    @php
        $id = Crypt::encryptString($setting->id);
        $logo = $setting->logo;
    @endphp
@endif --}}

    <ol class="breadcrumb bc-3">
        <li>
            <a href="/main_page/setting">Setting</a>
        </li>
        <li class="active">
            <strong>Setting</strong>
        </li>
    </ol>

@endsection
