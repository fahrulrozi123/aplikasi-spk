@extends('templates/template')
@section("header_title") PAGE SETTING @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered responsive">
                <thead>
                    <tr>
                        <th width="15%">Page Name</th>
                        <th>Page Description</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagesettings as $pagesetting)
                        <tr>
                            <td>{{ $pagesetting->page_name }}</td>
                            <td>{{ $pagesetting->page_description }}</td>
                            <td><a href="/main_page/page_setting/edit/{{ $pagesetting->id }}" class="btn btn-horison">
                                <b>Manage Page</b></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
