@extends('templates/template')
@section('content')
@section("header_title") VISITOR BANNER @endsection
<div class="col-lg-12">
    <div class="row">
        <a href="javascript:;" onclick="jQuery('#tambah-banner').modal('show');"
            class="btn btn-horison btn-lg pull-right"><b>+ ADD NEW BANNER</b></a>
    </div>
    <br>
    <div class="col-lg-12">
        <div class="row shadow">
            <?php $no = 0;?>
            @foreach($banners as $banner)<?php $no++ ;?>
            <div class="mySlides">
                <div class="numbertext">{{$no}} / 3</div>
                <img src="{{asset('/user/'.$banner->banner_name)}}" class="uwaw">
            </div>
            @endforeach
            <div class="bbaris">
                <?php $no = 0;?>
                @foreach($banners->take(3) as $banner) <?php $no++ ;?>
                @if($banner->banner_status != "4")
                <div class="column">
                    <img class="demo cursor" src="{{asset('/user/'.$banner->banner_name)}}"
                        onclick="currentSlide({{$no}})">
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
    </div>
    <br><br><br><br><br>
    <div>
        <h3 class="text-center"><strong>ALL BANNER</strong></h3>
        <h4 class="text-center">Select Banner to be showed to at Visitor Web Page (Up to 3 Banner)</h4>
        <br>
        <div class="row">
            <?php $no = 0;?>
            @foreach($banners as $banner) <?php $no++ ;?>
            <div class="col-lg-4 text-center head">
                <a type="button" class="edit-modal"><img onclick="showModal(this)" data-name="{{$banner->banner_name}}"
                        data-status="{{$banner->banner_status}}" data-id="{{Crypt::encryptString($banner->id)}}"
                        src="{{asset('/user/'.$banner->banner_name)}}" alt="" class="lingkaran  shadow"></a>
    
        </div>
        @endforeach

        </div>
</div>
</div>

@include('master_data.banner.modal')

<script>
    //modal edit
    $(document).on('click', '.edit-modal', function () {

    });
    var old = false;
    function showModal(e) {
        if (old) {
            $('#banner_status_' + old).removeClass('checked');
        }

        let id = e.getAttribute('data-id');
        let status = e.getAttribute('data-status');

        old = status;
        let banner_name = e.getAttribute('data-name');

        document.getElementById('id-data').value = id;

        $('#gambar').attr('src', '../user/' + banner_name);
        // $('#banner_status').attr('value', status);
        $('#banner_status_' + status).addClass('checked');

        $('#edit-modal').modal('show');
    }
    //DO DELETE
    $(document).on('click', '#delete-modal', function () {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var id = document.getElementById("id").value;
        window.location.href = "{{ url('') }}" + "/delete/" + data_id;
    });

    //slideshow
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");

        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";

    }

    function setBanner(event) {

        var id = document.getElementById("id-data").value;
        var banner_status = $('input[name=banner_status]:checked').val();

        $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "banner_status": banner_status
            },
            url: "banner/" + event,
            success: function (msg) {
                alert(event + ' Success');
                location.reload(true);
            }
        });
    };

</script>
@endsection