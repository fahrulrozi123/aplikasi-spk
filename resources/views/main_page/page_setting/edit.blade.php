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
                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
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
                            <div class="col-sm-10">
                                <h6><i>Choose a picture from your computer</i></h6>
                                <p class="mt">Upload room photos, the first uploaded photos will be treated as <strong>Main Photos</strong></p>
                                @error('oldImg')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <fieldset class="form-group">
                                    <a class="btn btn-horison-gold shadow" href="javascript:void(0)" onclick="$('#pro-image').click()">
                                    <i class="glyphicon glyphicon-circle-arrow-up"></i> Browse Image</a>
                                    <input type="file" id="pro-image" name="img[]" style="display: none;" class="form-control validateImage" accept="image/*" onchange="fileValidation();" multiple>
                                </fieldset>
                                <div class="preview-images-zone">
                                    @if(isset($pagesetting))
                                        @php $n = 0; @endphp
                                            @foreach($pagesetting['photo'] as $data_photo)@php $n++; @endphp
                                                <div class="preview-image preview-show-{{$n}}">
                                                    <input type="hidden" style="width:auto" name="oldImg[]" value="{{$data_photo->photo_path}}">
                                                    <div class="image-cancel" data-no="{{$n}}">x</div>
                                                    <div class="image-zone">
                                                        <img id="pro-img-{{$n}}" src="{{asset('/user/'.$data_photo->photo_path)}}">
                                                    </div>
                                                </div>
                                        @endforeach
                                    @endif
                                </div>
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

    <script>
        $(document).ready(function () {

            document.getElementById('pro-image').addEventListener('change', readImage, false);

            $(".preview-images-zone").sortable();

            $(document).on('click', '.image-cancel', function () {
                let no = $(this).data('no');
                $(".preview-image.preview-show-" + no).remove();
            });
        });

        @if(isset($pagesetting['photo']))
            var num = {{ count($pagesetting['photo']) }} + 1;
            var start = {{ count($pagesetting['photo']) }} + 1;
        @else
            var num = 0;
            var start = 0;
        @endif

        function delete_image() {
            for (let i = start; i < num; i++) {
                $(".preview-image.preview-show-" + i).remove();
            }
        }

        function readImage() {
        if (window.File && window.FileList && window.FileReader) {
            delete_image();
            var files = event.target.files; //FileList object

            var output = $(".preview-images-zone");

            for (let i = 0; i < files.length; i++) {
                var file = files[i];

                if (!file.type.match('image')) continue;

                var picReader = new FileReader();

                picReader.addEventListener('load', function (event) {
                    var picFile = event.target;
                    var html = '<div class="preview-image preview-show-' + num + '">' +
                        '<input type="hidden" name="oldImg[]" value="new">' +
                        '<div class="image-cancel" data-no="' + num + '">x</div>' +
                        '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result +
                        '"></div>' +
                        '</div>';
                    output.append(html);
                    num = num + 1;
                });

                picReader.readAsDataURL(file);
            }
        } else {
            console.log('Browser not support');
        }
    }

    </script>
@endsection
