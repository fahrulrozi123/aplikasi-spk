@extends('templates/template')
@section("header_title") PAGE SETTING @endsection
@section('content')
    <form enctype="multipart/form-data" method="POST" action="{{ route('page_setting.store') }}">
        <input type="hidden" name="id" value="{{ $id }}">
        @csrf

        <div class="panel panel-primary panel-collapsed">
            <div class="panel-heading shadow">
                <div class="panel-title">
                    <h4><strong>{{ $pagesetting->page_name }}</strong></h4>
                </div>
                <div class="panel-options"><a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                </div>
            </div>
            <div class="panel-body shadow">
                <div class="row">
                    <div class="col-md-6">
                        <div class="container">
                            <label for="page_name" class="col-sm-2 control-label">Page Name<br><small class="text-muted"></small></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="page_name" id="page_name" value="{{ $pagesetting->page_name }}" placeholder="Page Name">
                                @error('page_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><br>
                        <div class="container">
                            <label for="page_description" class="col-sm-2 control-label">Page Details<br><small class="text-muted"></small></label>
                            <div class="col-sm-4">
                                <textarea name="page_description" id="page_description" cols="1" rows="4" style="" class="form-control" id="page_description" placeholder="Describe page description here">{{ old('page_description', $pagesetting->page_description) }}</textarea>
                                @error('page_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div><br>
                        <div class="container">
                            <label for="logo" class="col-sm-2 control-label">Image<br><small class="text-muted"></small></label>
                            <div class="col-sm-5">
                                <h6><i>Choose a picture from your computer</i></h6>
                                <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                                    <div class="fileinput-new shadow img-responsive" data-trigger="fileinput" style="cursor:pointer; max-width: 350px;">
                                        {{-- @if($logo != null)
                                            <img src="{{asset('/images/logo/'.$logo)}}" alt="{{ $pagesetting->page_name }}">
                                        @else
                                            <img src="{{asset('images/dashboard/insert-here.png')}}" alt="Insert Here">
                                        @endif --}}
                                    </div>
                                    <div class="fileinput-preview fileinput-exists img-responsive shadow" style="max-width: 350px;"></div>
                                    <div class="text-center" style="margin-top:20px;">
                                        <span class="btn btn-horison-gold btn-file shadow">
                                            <span class="fileinput-new">
                                                <i class="glyphicon glyphicon-circle-arrow-up"></i> Browse Files</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="img" name="img" accept="image/*" class="validateImage" onchange="fileValidation();">
                                        </span>
                                        <a href="#" class="btn btn-orange fileinput-exists shadow" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                                @error('img')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><br>
                    </div>
                </div>

                <div class="row" align="right">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <a href="/main_page/page_setting" class="btn btn-white btn-lg shadow" style="width: 150px; margin-right:3px; font-size:13px;">Cancel</a>
                        <button class="btn btn-horison-gold btn-lg shadow" style="width: 150px; margin-left:3px; font-size:13px;">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
