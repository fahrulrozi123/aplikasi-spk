@extends('templates/template')
@section("header_title") PACKAGE / PRODUCT @endsection
@section('content')

<script>
    /* Fungsi formatRupiah */
    function formatRupiah(angka) {

            var number_string = angka.replace(/[^0-9]*/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            // console.log(rupiah);
            return rupiah;
        }
</script>

<div class="col-lg-12">
    <div class="row">

        <a href="/master_data/package/create" class="btn btn-horison btn-lg pull-right"><b>+ UNBOX YOUR PACKAGE</b></a>
        <br>

        <?php $no = 0;?>
        @while (isset($products[$no]))

        @if($products[$no]->category == "1")
        <?php $i = $no; ?>
        @while (isset($products[$i]) and $products[$i]->category == "1")
        @if($i == $no)
        <h4><strong>{{ $menu['recreation'][0]['page_name'] }}</strong></h4>
        @endif
        @php
        $img = count($products[$i]['photos']) > 0 ? $products[$i]['photos'][0]->product_photo_path : "insert-image.jpg";
        @endphp
        <div class="panel panel-default">
            <div class="panel-body shadow">
                <div class="col-lg-3 col-sm-12 mb text-center">
                    <img src="{{asset('/user/'.$img)}}" alt="" class="containerBox shadow" loading="lazy">
                </div>
                <div class="col-lg-4 col-sm-12">
                    <h4 class="mb"><strong>{{$products[$i]->product_name}}</strong></h4>
                    @if(strlen($products[$i]->product_detail) > 500)
                    <p class="mt line-clamp-8">
                        {!! strip_tags(substr($products[$i]->product_detail, 0, 540)."...") !!}
                    </p>
                    @else
                    <p class="mt line-clamp-8">
                        {!! strip_tags($products[$i]->product_detail) !!}</p>
                    @endif
                </div>
                <div class="col-lg-4 col-sm-12">
                    @if($products[$i]->sales_inquiry == 0)
                    <h4 class="mb"><strong>Package Price : <script>
                                document.write("Rp "+formatRupiah("{{$products[$i]->product_price}}"));
                            </script></strong></h4>
                    @endif
                    <p class="mt">Sales Inquiry : {{$products[$i]->sales_inquiry == 1 ? "Yes" : "No"}}</p>
                </div>
                <a href="/master_data/package/edit/{{Crypt::encryptString($products[$i]->id)}}"
                    class="btn btn-horison pull-right manage-pkg"><b>Manage Package</b>
                </a>
            </div>
        </div>
        <?php $i++; ?>
        @endwhile
        <br>

        @elseif($products[$no]->category == "2")
        <?php $i = $no; ?>
        @while (isset($products[$i]) and $products[$i]->category == "2")
        @if($i == $no)
        <h4><strong>{{ $menu['spa'][0]['page_name'] }}</strong></h4>
        @endif
        @php
        $img = count($products[$i]['photos']) > 0 ? $products[$i]['photos'][0]->product_photo_path : "insert-image.jpg";
        @endphp
        <div class="panel panel-default">
            <div class="panel-body shadow">
                <div class="col-lg-3 col-sm-12 mb text-center">
                    <img src="{{asset('/user/'.$img)}}" alt="" class="containerBox shadow" loading="lazy">
                </div>
                <div class="col-lg-4 col-sm-12">
                    <h4 class="mb"><strong>{{$products[$i]->product_name}}</strong></h4>
                    @if(strlen($products[$i]->product_detail) > 500)
                    <p class="mt line-clamp-8">
                        {!! strip_tags(substr($products[$i]->product_detail, 0, 540)."...") !!}
                    </p>
                    @else
                    <p class="mt line-clamp-8">
                        {!! strip_tags($products[$i]->product_detail) !!}</p>
                    @endif
                </div>
                <div class="col-lg-4 col-sm-12">
                    @if($products[$i]->sales_inquiry == 0)
                    <h4 class="mb"><strong>Package Price : <script>
                                document.write("Rp "+formatRupiah("{{$products[$i]->product_price}}"));
                            </script></strong></h4>
                    @endif
                    <p class="mt">Sales Inquiry : {{$products[$i]->sales_inquiry == 1 ? "Yes" : "No"}}</p>
                </div>
                <a href="/master_data/package/edit/{{Crypt::encryptString($products[$i]->id)}}"
                    class="btn btn-horison pull-right manage-pkg"><b>Manage Package</b>
                </a>
            </div>
        </div>
        <?php $i++; ?>
        @endwhile
        <br>

        @elseif($products[$no]->category == "3")
        <?php $i = $no; ?>
        @while (isset($products[$i]) and $products[$i]->category == "3")
        @if($i == $no)
        <h4><strong>{{ $menu['mice'][0]['page_name'] }}</strong></h4>
        @endif
        @php
        $img = count($products[$i]['photos']) > 0 ? $products[$i]['photos'][0]->product_photo_path : "insert-image.jpg";
        @endphp
        <div class="panel panel-default">
            <div class="panel-body shadow">
                <div class="col-lg-3 col-sm-12 mb text-center">
                    <img src="{{asset('/user/'.$img)}}" alt="" class="containerBox shadow" loading="lazy">
                </div>
                <div class="col-lg-4 col-sm-12">
                    <h4 class="mb"><strong>{{$products[$i]->product_name}}</strong></h4>
                    @if(strlen($products[$i]->product_detail) > 500)
                    <p class="mt line-clamp-8">
                        {!! strip_tags(substr($products[$i]->product_detail, 0, 540)."...") !!}
                    </p>
                    @else
                    <p class="mt line-clamp-8">
                        {!! strip_tags($products[$i]->product_detail) !!}</p>
                    @endif
                </div>
                <div class="col-lg-4 col-sm-12">
                    @if($products[$i]->sales_inquiry == 0)
                    <h4 class="mb"><strong>Package Price : <script>
                                document.write("Rp "+formatRupiah("{{$products[$i]->product_price}}"));
                            </script></strong></h4>
                    @endif
                    <p class="mt">Sales Inquiry : {{$products[$i]->sales_inquiry == 1 ? "Yes" : "No"}}</p>
                </div>
                <a href="/master_data/package/edit/{{Crypt::encryptString($products[$i]->id)}}"
                    class="btn btn-horison pull-right manage-pkg"><b>Manage Package</b>
                </a>
            </div>
        </div>
        <?php $i++; ?>
        @endwhile
        <br>

        @elseif($products[$no]->category == "4")
        <?php $i = $no; ?>
        @while (isset($products[$i]) and $products[$i]->category == "4")
        @if($i == $no)
        <h4><strong>{{ $menu['wedding'][0]['page_name'] }}</strong></h4>
        @endif
        @php
        $img = count($products[$i]['photos']) > 0 ? $products[$i]['photos'][0]->product_photo_path : "insert-image.jpg";
        @endphp
        <div class="panel panel-default">
            <div class="panel-body shadow">
                <div class="col-lg-3 col-sm-12 mb text-center">
                    <img src="{{asset('/user/'.$img)}}" alt="" class="containerBox shadow" loading="lazy">
                </div>
                <div class="col-lg-4 col-sm-12">
                    <h4 class="mb"><strong>{{$products[$i]->product_name}}</strong></h4>
                    @if(strlen($products[$i]->product_detail) > 500)
                    <p class="mt line-clamp-8">
                        {!! substr($products[$i]->product_detail, 0, 540)."..."!!}
                    </p>
                    @else
                    <p class="mt line-clamp-8">
                        {!! $products[$i]->product_detail !!}</p>
                    @endif
                </div>
                <div class="col-lg-4 col-sm-12">
                    @if($products[$i]->sales_inquiry == 0)
                    <h4 class="mb"><strong>Package Price : <script>
                                document.write("Rp "+formatRupiah("{{$products[$i]->product_price}}"));
                            </script></strong></h4>
                    @endif
                    <p class="mt">Sales Inquiry : {{$products[$i]->sales_inquiry == 1 ? "Yes" : "No"}}</p>
                </div>
                <a href="/master_data/package/edit/{{Crypt::encryptString($products[$i]->id)}}"
                    class="btn btn-horison pull-right manage-pkg"><b>Manage Package</b>
                </a>
            </div>
        </div>
        <?php $i++; ?>
        @endwhile
        @endif
        <?php $no=$i; ?>
        @endwhile

    </div>
</div>


@endsection
