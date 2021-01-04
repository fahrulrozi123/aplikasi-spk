@extends('templates/visitor_template')
@section('content')
<br><br>

<div class="container newsletter">

    <ol class="breadcrumb bc-3" style="font-size:13px;">
        <li>
            <a href="/visitor/newsletter"><span class="entypo-left-open"></span>Back</a>
        </li>
    </ol>

    {{-- NEWS HEADER --}}
    <h2 class="mt mb"><label>{{$news->news_title}}</label></h2>
    <p class="news-date"><b>{{$news->news_publish_date}}</b></p>
    {{-- NEWS BODY --}}
    <img style="width:100%; height:550px; object-fit:cover;" src="{{asset('/user/'.$news->news_photo_path)}}"  />
    <br><br><br>
    {!! $news->news_content !!}
    <br>
    <hr>
    <br>
    <h2 class="mt mb"><label>Other News</label></h2>
    <br>
    <div class="row">
        <div class="gallery-env">
            <?php $no = 0;?>
            @foreach($other_news->take(6) as $news) <?php $no++ ;?>
                <div class="col-sm-4">
                    <article class="album">
                    <header>
                            <img src="{{asset('/user/'.$news->news_photo_path)}}" class="news-third" />
                    </header>
                        <section class="album-info shadow">
                            <a href="/visitor/news_detail/{{$news->id}}"><h4 class="line-clamp-1" style="margin-top: 0px;"><b>{{$news->news_title}}<b></h4></a>

                            <p style="font-size:12px;">{{$news->news_publish_date}}</p>
                        </section>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
