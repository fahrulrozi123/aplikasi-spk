@extends('templates/template')
@section("header_title") NEWS @endsection
@section('content')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
{{-- <ol class="breadcrumb bc-3">
    <li>
        <a href="/master_data/news">News</a>
    </li>
    <li class="active">
        <strong>Publish News</strong>
    </li>
</ol> --}}

<style>
    .ms-container .ms-list {
        width: 135px;
        height: 205px;
    }

    .post-save-changes {
        float: right;
    }

    @media screen and (max-width: 789px) {
        .post-save-changes {
            float: none;
            margin-bottom: 20px;
        }
    }
</style>

@if(isset($news))
@php
$id = Crypt::encryptString($news->id);
$news_title = $news->news_title;
$news_content = $news->news_content;
$img = $news->news_photo_path;
$news_sticky_state = $news->news_sticky_state == 1 ? "checked" : "";
$news_publish_status = $news->news_publish_status == 0 ? "checked" : "";
$news_publish_date = $news->news_publish_date;
@endphp

@else

@php
$id ="";
$news_title = "";
$news_content = "";
$img = "insert-image.jpg";
$news_sticky_state = "";
$news_publish_status = "";
$news_publish_date = date('Y/m/d');
@endphp

@endif

<form method="POST" action="{{ route('news.insert') }}" enctype="multipart/form-data" autocomplete="off">
    {{csrf_field()}}
    <div class="col-lg-12">
        <input type="hidden" id="news-id" name="id" value="{{$id}}">
        <!-- Title and Publish Buttons -->
        <div class="row">
            @if($id != "")
            <div class="col-sm-2 post-save-changes" style="margin-top:44px;">
                <button type="submit" class="btn btn-horison-gold btn-block shadow">
                    <b>UPDATE</b>
                </button>
            </div>
            <div class="col-sm-1 post-save-changes" style="margin-top:44px;">
                <a href="{{ route('news.index') }}" class="btn btn-link btn-block">
                    <b>Cancel</b>
                </a>
            </div>
            <div class="col-sm-1 post-save-changes" style="margin-top:44px;">
                <button type="button" onclick="if(confirm('Are you sure?')) deleteNews();"
                    class="btn btn-link btn-block danger">
                    <b>Delete News</b>
                </button>
            </div>

            @else
            <div class="col-sm-2 post-save-changes" style="margin-top:44px;">
                <a href="{{ route('news.index') }}" class="btn btn-link btn-block">
                    <b>Cancel</b>
                </a>
            </div>
            <div class="col-sm-2 post-save-changes" style="margin-top:44px;">
                <button type="submit" class="btn btn-horison-gold btn-block shadow">
                    <b>PUBLISH</b>
                </button>
            </div>
            @endif

            <div class="col-sm-8">
                <div class="form-group">
                    <label class="control-label">
                        <h5><b>NEWS TITLE</b></h5>
                    </label>
                    <input type="text" class="form-control input-lg" name="news_title"
                        placeholder="Our Latest Event, Described!" value="{{old('news_title', $news_title)}}"
                        required />
                    @error('news_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <br />

        <!-- CKEditor - Content Editor -->
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">
                    <h5><b>NEWS DESCRIPTION</b></h5>
                </label>

                <textarea name="news_content">{{old('news_content', $news_content)}}</textarea>
                <script>
                    CKEDITOR.replace( 'news_content', {
                    filebrowserUploadUrl: "{{route('news.upload', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form',
                    removeButtons: 'Anchor,Table',
                    height: 300
                });
                </script>
                @error('news_content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <br />

        <!-- Metaboxes -->
        <div class="row">
            <!-- Metabox :: Featured Image -->
            <div class="col-sm-5">
                <div class="panel panel-primary panel-shadow" data-collapsed="0">
                    <div class="panel-heading shadow">
                        <div class="panel-title">
                            <b>News Thumbnail Photos</b>
                        </div>

                    </div>

                    <div class="panel-body shadow">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="" data-trigger="fileinput">
                                @if(isset($news))
                                <img src="{{asset('/user/'.$img)}}" class="shadow" alt="...">
                                @endif
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            <div>
                                <span class="btn btn-file">
                                    <span class="btn btn-horison-gold shadow fileinput-new"><i
                                            class="entypo-upload"></i> Browse
                                        File</span>
                                    <span class="btn btn-white fileinput-exists">Change</span>
                                    <input type="file" name="img" accept="image/*" class="validateImage"
                                        onchange="fileValidation();">
                                </span>
                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
                @error('img')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Metabox :: Publish Settings -->
            <div class="col-sm-3">
                <div class="panel panel-primary panel-shadow" data-collapsed="0">
                    <div class="panel-heading shadow">
                        <div class="panel-title">
                            <b>Publish Settings</b>
                        </div>
                    </div>

                    <div class="panel-body shadow">
                        <div class="checkbox checkbox-replace color-primary">
                            <input name="news_pin_state" type="checkbox" onclick="check('hide',this);" id="chk-pin"
                                {{ $news_sticky_state }}>
                            <label>Pin this news</label><br>
                            <label style="padding-left:0px; font-size:11px; color:#858585">Only 1 (one) News can be
                                Pinned</label>
                        </div><br>

                        <div class="checkbox checkbox-replace color-primary">
                            <input name="news_hide_state" onclick="check('pin',this);" type="checkbox" id="chk-hide"
                                {{ $news_publish_status }}>
                            <label>Hide this news</label><br>
                            <label style="padding-left:0px; font-size:11px; color:#858585">News won't be
                                showed</label>
                        </div>

                        <p><b>Publish Date</b></p>
                        <div class="input-group">
                            <input type="text" id="news_publish_date" name="news_publish_date" class="form-control"
                                value="{{ $news_publish_date }}" data-format="yyyy/mm/dd"
                                style="background-color: #FFFFFF" readonly>

                            <div class="input-group-addon">
                                <a href="#"><i class="entypo-calendar"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</form>

<script>
    var news_publish_status = "{{$news_publish_status}}";

    var news_publish_date = new Litepicker({
        firstDay: 1,
        format: "DD MMMM YYYY",
        lang: 'en-US',
        numberOfMonths: 1,
        numberOfColumns: 1,
        autoApply: true,
        singleMode: true,
        element: document.getElementById('news_publish_date'),
    });

    @if(isset($news))
        news_publish_date.setDate(new Date("{{$news_publish_date}}"));
    @else
        news_publish_date.setDate(new Date());
    @endif

    if (news_publish_status != "") {
        $("#opt_" + news_publish_status).attr('selected', 'selected');
    }

    function check(id, e) {
        if($('#chk-'+id).prop('checked') == true){
            if(id == "hide"){
                alert("You cannot pin news if you hide this news !");
            }else if(id == "pin"){
                alert("You cannot hide news if you pin this news !");
            }
            e.checked = false;
        }

    }

    function deleteNews() {
        var id = document.getElementById("news-id").value;

        $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
            url: "{{ route('news.delete') }}",
            success: function (msg) {
                alert("News Berhasil Dihapus!");
                window.location.replace("{{ route('news.index') }}");
            }
        });
    };

</script>
@endsection
