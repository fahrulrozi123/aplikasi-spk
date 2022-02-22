@extends('templates/template')
@section("header_title") PACKAGE/PRODUCT @endsection
@section('content')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

@if(isset($product))
@php
$product_photos = $product['photos'];
$id = Crypt::encryptString($product->id);
$product_name = $product->product_name;
$product_detail = $product->product_detail;
$product_price = $product->product_price;
$sales_inquiry = $product->sales_inquiry;
if($sales_inquiry == 1){
$sales_class = "hidden";
}else{
$sales_class = "";
}
$category = $product->category;
$product_publish_status = $product->product_publish_status == 1 ? "checked" : "";
@endphp

@else

@php
$sales_class = "";
$product_photos = "";
$id = "";
$product_name = "";
$product_detail = "";
$product_price = "100000";
$sales_inquiry = "0";
$category = "1";
@endphp
@endif

<div class="col-lg-12">
    <div class="row">
        <form method="POST" action="{{ route('package.insert') }}" enctype="multipart/form-data" autocomplete="off">
            {{csrf_field()}}
            <input type="hidden" id="package-id" name="id" value="{{$id}}">
            <input type="hidden" name="selectedCategory" id="selectedCategory" value="{{$category}}" />

            <h3><strong>Category</strong></h3>

            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12 ">
                    <div id="category_1" onClick="setActiveCategory(this);" class="contain category">
                        <a>
                            @foreach ($recreations as $recreation)
                            @foreach($recreation->photo->take(1) as $photo)
                            <img src="{{ asset('/user/'.$photo->photo_path) }}" class="shadow"
                                alt="{{ $recreation->page_name }}" style="width:100%; height:100%; object-fit: cover;">
                            @endforeach
                            @endforeach
                            <div class="centered">
                                <h3 class="font-tertiary"><strong>{{ $menu['recreation'][0]['page_name'] }}</strong>
                                </h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 ">
                    <div id="category_2" onClick="setActiveCategory(this);" class="contain category">
                        <a>
                            @foreach ($spas as $spa)
                            @foreach($spa->photo->take(1) as $photo)
                            <img src="{{ asset('/user/'.$photo->photo_path) }}" class="shadow"
                                alt="{{ $spa->page_name }}" style="width:100%; height:100%; object-fit: cover;">
                            @endforeach
                            @endforeach
                            <div class="centered">
                                <h3 class="font-tertiary"><strong>{{ $menu['spa'][0]['page_name'] }}</strong></h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 ">
                    <div id="category_3" onClick="setActiveCategory(this);" class="contain category">
                        <a>
                            @foreach ($mices as $mice)
                            @foreach($mice->photo->take(1) as $photo)
                            <img src="{{ asset('/user/'.$photo->photo_path) }}" class="shadow"
                                alt="{{ $mice->page_name }}" style="width:100%; height:100%; object-fit: cover;">
                            @endforeach
                            @endforeach
                            <div class="centered">
                                <h3 class="font-tertiary"><strong>{{ $menu['mice'][0]['page_name'] }}</strong></h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 ">
                    <div id="category_4" onClick="setActiveCategory(this);" class="contain category">
                        <a>
                            @foreach ($weddings as $wedding)
                            @foreach($wedding->photo->take(1) as $photo)
                            <img src="{{ asset('/user/'.$photo->photo_path) }}" class="shadow"
                                alt="{{ $wedding->page_name }}" style="width:100%; height:100%; object-fit: cover;">
                            @endforeach
                            @endforeach
                            <div class="centered">
                                <h3 class="font-tertiary"><strong>{{ $menu['wedding'][0]['page_name'] }}</strong></h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <br>

            <div class="panel panel-primary panel-collapsed">
                <div class="panel-heading shadow">
                    <div class="panel-title">
                        <h4><strong>Package/Product Information</strong></h4>
                    </div>
                    <div class="panel-options"><a data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>
                <div class="panel-body shadow form-horizontal" style="display: block;">
                    <div class="form-group">
                        <div class="col-lg-4 col-md-4">
                            <label for="product_name">Package/Product Name</label>
                            <input type="text" class="form-control" name="product_name" maxlength="255"
                                placeholder="Nama Package/Product" value="{{old('product_name', $product_name)}}">
                            @error('product_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <br>
                        </div>
                        @if(isset($product))
                        <div class="col-lg-12 col-md-12">
                            <div class="input-group">
                                <label for="product_publish_status">Status</label>
                                <br>
                                <div class="make-switch switch-small">
                                    <input name="product_publish_status" type="checkbox" id="product_publish_status" {{
                                        $product_publish_status }}>
                                </div>
                            </div>
                            <br>
                        </div>
                        @endif
                        <div class="col-lg-12 col-md-12">
                            <label for="product_detail">Package/Product Detail</label>
                            <textarea name="product_detail">{{old('product_detail', $product_detail)}}</textarea>
                            <script>
                                CKEDITOR.replace( 'product_detail', {
                                    removePlugins: ['image', 'uploadimage'],
                                    removeButtons: 'Anchor,Table,HorizontalLine',
                                    height: 300
                                });
                            </script>
                            @error('product_detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-primary panel-collapsed">
                <div class="panel-heading shadow">
                    <div class="panel-title">
                        <h4><strong>Package/Product Photos</strong></h4>
                    </div>
                    <div class="panel-options"><a data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>
                <div class="panel-body shadow" style="display: block;">
                    <div class="col-md-12">
                        <h5><strong>Package/Product Photos</strong></h5>
                        <h5>Upload your Package Photos, the first uploaded photos will be treated as Main Photos</h5>
                        <fieldset class="form-group">
                            <a class="btn btn-horison-gold" href="javascript:void(0)"
                                onclick="$('#pro-image').click()"><i class="glyphicon glyphicon-circle-arrow-up"></i>
                                Browse Image</a>
                            <input type="file" id="pro-image" name="img[]" style="display: none;"
                                class="form-control validateImage" accept="image/*" onchange="fileValidation();"
                                multiple>
                            @error('img')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </fieldset>
                        <div class="preview-images-zone">
                            @if(isset($product))
                            @php $n = 0; @endphp
                            @foreach($product_photos as $data_photo)@php $n++; @endphp
                            <div class="preview-image preview-show-{{$n}}">
                                <input type="hidden" name="oldImg[]" value="{{$data_photo->product_photo_path}}">
                                <div class="image-cancel" data-no="{{$n}}">x</div>
                                <div class="image-zone"><img id="pro-img-{{$n}}"
                                        src="{{asset('/user/'.$data_photo->product_photo_path)}}"></div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary panel-collapsed">
                <div class="panel-heading shadow">
                    <div class="panel-title">
                        <h4><strong>Package/Product Price</strong></h4>
                    </div>
                    <div class="panel-options"><a data-rel="collapse"><i class="entypo-down-open"></i></a>
                    </div>
                </div>
                <div class="panel-body shadow" style="display: block;">
                    <div class="col-md-12">
                        <h5><strong>Inquired to Sales Team?</strong></h5>
                        <h5>Is this package / product require further assist from the Sales Team?</h5>

                        <input type="hidden" name="salesStatus" id="salesStatus" value="{{$sales_inquiry}}" />
                        <button id="status_1" type="button" onclick="setSalesStatus(this)" class="btn btn-horison"
                            style="padding:1em 4em">YES</button>
                        <button id="status_0" type="button" onclick="setSalesStatus(this)" class="btn btn-horison"
                            style="padding:1em 4em">NO</button>
                        <br>
                        <br>
                    </div>
                    {{-- <label for="product_detail" class="col-md-12">Package/Product Price (Pax)</label> --}}
                    <div class="col-xs-8 col-lg-4 {{$sales_class}}" id="input-group">
                        <label for="product_detail" class="col-md-12" style="padding-left:0px;">Package/Product Price
                            (Pax)</label>
                        <div class="input-group" id="input-group">
                            <span class="input-group-addon">Rp.</span>
                            <input type="text" class="form-control currency-format package_price" name="product_price"
                                id="product_price" oninput="ambilRupiah(this);" placeholder="Harga /pax"
                                value="{{old('product_price', $product_price)}}" autocomplete="off" />
                            <input type="hidden" name="product_price" id="product_price_value"
                                value="{{$product_price}}" autocomplete="off" />
                        </div>
                        @error('product_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="pull-right">
                @if(isset($product))
                <button type="button" onclick="if(confirm('Are you sure?')) deletePackage();"
                    class="btn btn-delete btn-padding">
                    Delete
                </button>
                <a class="btn btn-white btn-padding" href="{{route('package.index')}}">
                    Cancel
                </a>
                <button type="button" onclick="confirmBox(this)" class="btn btn-horison-gold btn-padding">
                    Update
                </button>
                @else
                <a class="btn btn-white btn-padding" href="{{route('package.index')}}">
                    Cancel
                </a>
                <button type="button" onclick="confirmBox(this)" class="btn btn-horison-gold btn-padding">Save</button>
                @endif
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    window.onload = function () {

    }

    if ("{{$product_price}}" != "") {
        var e = document.getElementById("product_price");
        e.value = formatRupiah(e, e.value);
    }

    function ambilRupiah(e) {
        var hiddenInput = document.getElementById(e.id + "_value");
        hiddenInput.value = hiddenInput.value.replace(/[^0-9]*/g, '');
        hiddenInput.value = e.value.match(/\d/g).join("");
        e.value = formatRupiah(e, e.value);
    }
    /* Fungsi formatRupiah */
    function formatRupiah(rupiah, angka, prefix) {
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
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }

    function confirmBox(e) {
        var package_price = document.getElementsByClassName('package_price');
        var cek = true;
        var sales_status = document.getElementById("salesStatus");
        var msg = '';

        for (let index = 0; index < package_price.length; index++) {
            const element = package_price[index];

            if(element.value == "0" && sales_status.value == 0){
                if(msg == ''){
                    msg += element.name;
                }else{
                    msg += ', '+element.name;
                }
               cek = false;
            }

            if(msg != ''){
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This Package/Product Price (Pax) will be sold for Rp 0 ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                    }).then((result) => {
                    if (result.value) {
                        e.setAttribute('type','submit');
                        e.setAttribute('onclick','');
                        e.click();
                        cek = false;
                    // For more information about handling dismissals please visit
                    // https://sweetalert2.github.io/#handling-dismissals
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                        'Cancelled',
                        'Operation Cancel!',
                        'error'
                        )
                    }
                })
            }

        }

       if(cek){
            e.setAttribute('type','submit');
            e.setAttribute('onclick','');
            e.click();
       }
    }

</script>

<script>
    $(document).ready(function () {
        document.getElementById('pro-image').addEventListener('change', readImage, false);
        $(".preview-images-zone").sortable();

        $(document).on('click', '.image-cancel', function () {
            console.log("ksini");

            let no = $(this).data('no');
            $(".preview-image.preview-show-" + no).remove();
        });

    });

    $("#category_{{$category}}").addClass("active");


    if ("{{$sales_inquiry}}" == "1") {
        $("#status_{{$sales_inquiry}}").removeClass("btn-horison");
        $("#status_{{$sales_inquiry}}").toggleClass("btn-horison-gold active btn").toggleClass("btn");
    }

    if ("{{$sales_inquiry}}" == "0") {
        $("#status_{{$sales_inquiry}}").removeClass("btn-horison");
        $("#status_{{$sales_inquiry}}").toggleClass("btn-horison-gold active btn").toggleClass("btn");
    }

    function setActiveCategory(e) {
        //find recently active product
        var selectedCategory = document.getElementById("selectedCategory");
        //set the product inactive
        var activeNow = document.getElementById("category_" + selectedCategory.value);
        activeNow.classList.remove("active");
        //set clicked product active
        e.classList.add("active");
        //set new product active as activeProduct value
        selectedCategory.value = e.id.substr(e.id.length - 1);


    }

    function setSalesStatus(e) {
        //find recently active product
        var salesStatus = document.getElementById("salesStatus");

        //set the product inactive
        var activeNow = document.getElementById("status_" + salesStatus.value);
        activeNow.className = "btn btn-horison";

        //set new product active as activeProduct value
        salesStatus.value = e.id.substr(e.id.length - 1);

        if (salesStatus.value == 0) {
            //set clicked product active
            e.className = "btn btn-horison-active";

            $('#input-group').removeClass('hidden');
        } else {
            e.className = "btn btn-horison-active";

            $('#input-group').addClass('hidden');

            $('#product_price').val("100000");

            $('#product_price_value').val("100000");
        }
    }

    @if(isset($product['photos']))
    var num = {{count($product['photos'])}} + 1;
    var start = {{count($product['photos'])}} + 1;
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

    function deletePackage() {

        var id = document.getElementById("package-id").value;

        $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
            url: "{{ route('package.delete') }}",
            success: function (data) {
                if(data.status == 422){
                    alert(data.msg);
                }else if(data.status == 200){
                    alert("Package Berhasil Dihapus!");
                    window.location.replace("{{ route('package.index') }}");
                }
            }
        });
    };


</script>

@endsection
