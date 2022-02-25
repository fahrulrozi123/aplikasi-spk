<!DOCTYPE html>
<html lang="en">

<head>

    <title>Hotel Voucher - Horison Ultima Bandung</title>

    <style>
        @page {
            margin-bottom: -100;
            size: letter;
            /*or width x height 150mm 50mm*/
        }

        .font-voucher {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .fs-11 {
            font-size: 11px;
        }

        .fs-12 {
            font-size: 12px;
        }

        .fs-13 {
            font-size: 13px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .horison-dark {
            color: #1E1E1E
        }

        .horison-dark-2 {
            color: #323639
        }

        .mt-min10 {
            margin-top: -10px;
        }

        .mt-min25 {
            margin-top: -25px;
        }

        .mb-12 {
            margin-bottom: 12px;
        }
    </style>

</head>

<body class="page-body" data-url="">
    <div class="col-lg-12">

        <div class="container">

            <div class="panel panel-gradient" style="margin-bottom:100px;">

                <!-- panel body -->
                <div class="panel-body">

                    {{-- BOOKING DETAILS - HEADER --}}
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <img src="{{ asset('/images/logo/logo.jpg') }}" width="210" alt="Horison Ultima Bandung">
                            {{-- <img src="{{ $gambar }}" width="210"> --}}
                            <h1 class="font-voucher horison-dark" style="margin-top: -66px; margin-left: 230px;">
                                <b>Hotel Voucher</b><br>
                                <span><i class="fs-11">Present either electronic or paper copy of your booking
                                        confirmation upon check-in</i></span>
                            </h1>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</body>

</html>
