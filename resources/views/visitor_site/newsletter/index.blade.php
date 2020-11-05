@extends('templates/visitor_template')
@section('content')

<div class="row bg-secondary" style="padding-top: 30px;">
    <div class="container" style="padding-top:35px; margin-bottom:75px;">
        <div class="col-md-4" align="center">
            <p class="black-unset nl-row-dsc" style="margin-top:145px; margin-bottom:20px;">
                GET TO <br><br><span class="gold">KNOW</span> US</p>

            <p class="description-nl-dark">
                Our latest promo and other exciting event available for you!
            </p>
        </div>
        <div class="col-md-8">
            <img class="" src="{{asset('/images/newsletter/tirta-sanita-view.png')}}" style="width:100%;" />
        </div>
    </div>
</div>

<div class="row">
    <div class="container">
        <center>
            <p class="white" style="margin-top:40px; margin-bottom:40px;">OUR <span class="gold">LATEST</span> NEWS</p>
        </center>
        <div class="gallery-env">
            <div class="row">
                <?php $no = 0;?>
                @foreach($newss as $news) <?php $no++ ;?>
                <input type="hidden" id="title_{{$no}}" value="{{$news->news_title}}">
                <input type="hidden" id="content_{{$no}}" value="{{$news->news_content}}">
                <input type="hidden" id="gambar_{{$no}}" value="{{asset('/user/'.$news->news_photo_path)}}">
                @if ($no == 1)
                <div class="col-sm-6">
                    <article class="album">
                        <header>
                            <img class="news1-height news-first" src="{{asset('/user/'.$news->news_photo_path)}}" />
                        </header>
                        <section class="album-info shadow">
                            <a href="/visitor/news_detail/{{$news->id}}"><h4 style="height: 35px; line-height: normal;">
                                <b>{{$news->news_title}}</b></h4>
                            </a>
                            <p style="font-size:12px;">{{$news->news_publish_date}}</p>
                        </section>
                    </article>
                </div>
                @if($no == count($newss))
            </div>
            @endif
            @elseif ($no > 1 && $no <= 5) <div class="col-sm-3">
                <article class="album">
                    <header>
                        <img src="{{asset('/user/'.$news->news_photo_path)}}" class="news2-height news-second" />
                    </header>
                    <section class="album-info shadow">
                        <a href="/visitor/news_detail/{{$news->id}}">
                            <h4 style="height:45px; line-height: normal;"><b>{{$news->news_title}}</b></h4>
                        </a>
                        <p style="font-size:12px;">{{$news->news_publish_date}}</p>
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
                    <img src="{{asset('/user/'.$news->news_photo_path)}}" class="news-third" />
                </header>
                <section class="album-info shadow">
                    <a href="/visitor/news_detail/{{$news->id}}"><h4 style="height:35px;"><b>{{$news->news_title}}</b></h4></a>

                    <p style="font-size:12px;">{{$news->news_publish_date}}</p>
                </section>
            </article>
        </div>
        @if($no == count($newss))
    </div>
    @endif
    @endif
    @if($no > 11)
    <div class="row" style="margin-bottom:20px;" align="center">
        <a href="#" class="btn btn-horison-visitor btn-lg btn-block-2"><b>SHOW MORE</b></a>
    </div>
    @break
    @endif
    @endforeach

    </div>

    <div style="text-align: center;">
        <tr>
            <td colspan=10>
                {{$newss->links()}}
            </td>
        </tr>
    </div>

    </div>
</div>
@endsection
