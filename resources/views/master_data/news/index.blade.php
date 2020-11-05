@extends('templates/template')
@section("header_title") NEWS @endsection
@section('content')

<div class="col-lg-12">
<div class="row">

    <a href="/master_data/news/create" class="btn btn-horison btn-lg pull-right"><strong>+ ADD NEWS</b></a>

    <br><br><br><br>

    <div class="gallery-env">

        <div class="row">
        <?php $no = 0; $status = '';?>
        @foreach($newss as $news) <?php $no++ ;?>
            @if($news->news_publish_status == 0)
            @php
                $status = ' (HIDDEN NEWS)';
            @endphp
            @endif
            <input type="hidden" id="title_{{$no}}" value="{{$news->news_title.$status}}">
            <input type="hidden" id="content_{{$no}}" value="{{$news->news_content}}">
            <input type="hidden" id="gambar_{{$no}}" value="{{asset('/user/'.$news->news_photo_path)}}">
            @if ($no == 1)
            <div class="col-sm-6">
                    <article class="album">
                        <header>
                            <a href="/visitor/news_detail/{{$news->id}}" target="_blank" type="button" >
                                <img class="news-first" src="{{asset('/user/'.$news->news_photo_path)}}"  />
                            </a>
                            <a href="/master_data/news/edit/{{Crypt::encryptString($news->id)}}" class="album-options-2">
                                <i class="entypo-cog"></i>
                                Manage News
                            </a>
                        </header>
                        <section class="album-info shadow">
                            <h3><b>{{$news->news_title}}<span style="color: #E56255;"><i>{{$status}}</i></span><b></h3>

                            <p>{{$news->news_publish_date}}</p>
                        </section>
                    </article>
            </div>
                @if($no == count($newss))
                </div>
                @endif
                @elseif ($no > 1 && $no <= 5)
                    <div class="col-sm-3">
                        <article class="album">
                            <header>
                                <a type="button"  href="/visitor/news_detail/{{$news->id}}" target="_blank" >
                                    <img src="{{asset('/user/'.$news->news_photo_path)}}" class="news-second" />
                                </a>
                                <a href="/master_data/news/edit/{{Crypt::encryptString($news->id)}}" class="album-options-2">
                                    <i class="entypo-cog"></i>
                                    Manage News
                                </a>
                            </header>
                            <section class="album-info shadow">
                                <h4 style="height:40px;"><b>{{$news->news_title}}<span style="color: #E56255;"><i>{{$status}}</i></span><b></h4>

                                <p style="margin-top:5px;">{{$news->news_publish_date}}</p>
                            </section>
                        </article>
                    </div>
                    @if($no == count($newss) || $no == 5)
                    </div>
                    @endif
                @elseif ($no >= 6)
                    @if($no == 6)
                    <div class="row">
                    @endif
                    <div class="col-sm-4">
                        <article class="album">
                            <header>
                                <a type="button"  href="/visitor/news_detail/{{$news->id}}" target="_blank">
                                    <img src="{{asset('/user/'.$news->news_photo_path)}}" class="news-third" />
                                </a>
                                <a href="/master_data/news/edit/{{Crypt::encryptString($news->id)}}" class="album-options-2">
                                    <i class="entypo-cog"></i>
                                    Manage News
                                </a>
                            </header>
                            <section class="album-info shadow">
                                <h4 style="height:40px;"><b>{{$news->news_title}}<span style="color: #E56255;"><i>{{$status}}</i></span><b></h4>

                                <p style="margin-top:5px;">{{$news->news_publish_date}}</p>
                            </section>
                        </article>
                    </div>
                    @if($no == count($newss))
                    </div>
                    @endif
                @endif
        @endforeach
        <div style="text-align: center;">
            <tr>
                <td colspan=10>
                    {{$newss->links()}}
                </td>
            </tr>
        </div>

        @include('master_data.news.modal')
    </div>
</div>


</div>

<script>
    // $(document).on('click', '.preview-modal', function() {
    //        let id = $(this).data('id');

    //        $.get('', function(data) {
    //            $('#news-preview').modal('show', {backdrop: 'static'});
    //        });
    //    });
    function previewNews(e){
        var title = $("#title_"+e.id).val();
        var gambar = $("#gambar_"+e.id).val();
        var content = $("#content_"+e.id).val();

        $("#modal_title").empty();
        $("#modal_title").append(title);

        $("#modal_gambar").attr("src", gambar);

        $("#modal_content").empty();
        $("#modal_content").append(content);

        $('#news-preview').modal('show', {backdrop: 'static'});
    }
   </script>

@endsection



{{-- <script type="text/javascript">
    jQuery(document).ready(function($)
    {
        // Handle the Change Cover
        $(".gallery-env").on("click", ".album header .album-options", function(ev)
        {
            ev.preventDefault();

            // Sample Modal
            $("#album-cover-options").modal('show');

            // Sample Crop Instance
            var image_to_crop = $("#album-cover-options .croppable-image img"),
                img_load = new Image();

            img_load.src = image_to_crop.attr('src');
            img_load.onload = function()
            {
                if(image_to_crop.data('loaded'))
                    return false;

                image_to_crop.data('loaded', true);

                image_to_crop.Jcrop({
                    boxWidth: 410,
                    boxHeight: 265,
                    onSelect: function(cords)
                    {
                        // you can use these vars to save cropping of the image coordinates
                        var h = cords.h,
                            w = cords.w,

                            x1 = cords.x,
                            x2 = cords.x2,

                            y1 = cords.w,
                            y2 = cords.y2;

                    }
                }, function()
                {
                    var jcrop = this;

                    jcrop.animateTo([800, 600, 150, 50]);
                });
            }
        });
    });
</script> --}}
