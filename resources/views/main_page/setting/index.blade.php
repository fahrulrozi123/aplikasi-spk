@extends('templates/template')
@section("header_title") SETTING @endsection
@section('content')

@if(isset($setting))
    @php
        $id      = Crypt::encryptString($setting->id);
        $logo    = $setting->logo;
        $favicon = $setting->favicon;
    @endphp
@endif


    <form enctype="multipart/form-data" method="POST" action="{{route('setting.store')}}">
        <input type="hidden" name="id" value="{{$id}}">
        @csrf

        <div class="col-lg-12">

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary shadow" data-collapsed="0">

                        <!-- panel head -->
                        <div class="panel-heading shadow">
                            <div class="panel-title">
                                <b>Setting Information</b>
                            </div>
                            <div class="panel-options">
                            </div>
                        </div>

                        <!-- panel body -->
                        <div class="panel-body">

                            <div class="row">

                                <div class="col-md-6">

                                    {{-- HOME --}}
                                    <h4><b>Hotel Information</b></h4>

                                    <div class="container">
                                        <label for="logo" class="col-sm-2 control-label">Logo Company<br><small class="text-muted"></small></label>
                                        <div class="col-sm-5">
                                            <h6><i>Choose a picture from your computer</i></h6>
                                            <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                                                <div class="fileinput-new shadow img-responsive" data-trigger="fileinput" style="cursor:pointer; max-width: 350px;">
                                                    @if($logo != null)
                                                        <img src="{{asset('/images/logo/'.$logo)}}" alt="Company Profile">
                                                    @else
                                                        <img src="{{asset('images/dashboard/insert-here.png')}}" alt="Insert Here">
                                                    @endif
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
                                    <div class="container">
                                        <label for="logo" class="col-sm-2 control-label">Favicon<br><small class="text-muted"></small></label>
                                        <div class="col-sm-5">
                                            <h6><i>Choose a picture from your computer</i></h6>
                                            <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                                                <div class="fileinput-new shadow img-responsive" data-trigger="fileinput" style="cursor:pointer; max-width: 150px;">
                                                    @if($favicon != null)
                                                        <img src="{{asset('/images/logo/'.$favicon)}}" alt="Company Profile">
                                                    @else
                                                        <img src="{{asset('images/dashboard/insert-here.png')}}" alt="Insert Here">
                                                    @endif
                                                </div>
                                                <div class="fileinput-preview fileinput-exists img-responsive shadow" style="width:150px;"></div>
                                                <div class="text-center" style="margin-top:20px;">
                                                    <span class="btn btn-horison-gold btn-file shadow">
                                                        <span class="fileinput-new">
                                                            <i class="glyphicon glyphicon-circle-arrow-up"></i> Browse Files</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" id="favicon" name="favicon" accept="image/*" class="validateImage" onchange="fileValidation();">
                                                    </span>
                                                    <a href="#" class="btn btn-orange fileinput-exists shadow" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                            @error('favicon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>
                                    <div class="container">
                                        <label for="title" class="col-sm-2 control-label">Title<br><small class="text-muted"></small></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="title" id="title" value="{{ $setting->title }}" placeholder="Title">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>

                                    {{-- CONTACT --}}
                                    <h4><b>Contact Information</b></h4>

                                    <div class="container">
                                        <label for="phone" class="col-sm-2 control-label">Phone<br><small class="text-muted"></small></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $setting->phone }}" placeholder="Phone Number">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>
                                    <div class="container">
                                        <label for="wa_number" class="col-sm-2 control-label">WhatsApp<br><small class="text-muted"></small></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="wa_number" id="wa_number" value="{{ $setting->wa_number }}" placeholder="WhatsApp Number">
                                            @error('wa_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>
                                    <div class="container">
                                        <label for="email" class="col-sm-2 control-label">Email<br><small class="text-muted"></small></label>
                                        <div class="col-sm-4">
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $setting->email }}" placeholder="Email Address">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>
                                    <div class="container">
                                        <label for="address" class="col-sm-2 control-label">Address<br><small class="text-muted"></small></label>
                                        <div class="col-sm-4">
                                            <textarea class="form-control" name="address" id="address" rows="4" cols="50" placeholder="Your Address">{{ old('address', $setting->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>

                                    {{-- CONTACT --}}
                                    <h4><b>Social Information</b></h4>

                                    <div class="container">
                                        <label for="so_facebook" class="col-sm-2 control-label">Facebook<br><small class="text-muted"></small></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="so_facebook" id="so_facebook" value="{{ $setting->so_facebook }}" placeholder="Enter Your Facebook Address">
                                            @error('so_facebook')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>
                                    <div class="container">
                                        <label for="so_twitter" class="col-sm-2 control-label">Twitter<br><small class="text-muted"></small></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="so_twitter" id="so_twitter" value="{{ $setting->so_twitter }}" placeholder="Enter Your Twitter Address">
                                            @error('so_twitter')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>
                                    <div class="container">
                                        <label for="so_instagram" class="col-sm-2 control-label">Instagram<br><small class="text-muted"></small></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="so_instagram" id="so_instagram" value="{{ $setting->so_instagram }}" placeholder="Enter Your Instagram Address">
                                            @error('so_instagram')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div><br>
                                </div>

                                <div class="col-md-6">
                                    <br><br>
                                    <img src="{{ asset('/images/dashboard/account.svg') }}" class="img-responsive">
                                </div>

                            </div>

                            <br><br><br>

                            <div class="row" align="center">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="/dashboard" class="btn btn-white btn-lg shadow" style="width: 150px; margin-right:3px; font-size:13px;">Cancel</a>
                                    <button class="btn btn-horison-gold btn-lg shadow" style="width: 150px; margin-left:3px; font-size:13px;">Save</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
