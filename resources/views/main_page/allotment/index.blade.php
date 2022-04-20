@extends('templates/template')
@section("header_title") ALLOTMENT @endsection
@section('content')
<script>
    var dateStart = 0;
    var diffDay = 0;
</script>

<div class="col-lg-12">
    <h4><strong>Room Type</strong></h4>

    <div class="row" style="margin-bottom:15px">

    <input type="hidden" id="active_allotment" value="">
    <div class="responsive">
        @if(isset($rooms))
        @php $no = 0; @endphp
        @foreach($rooms as $room) @php $no++; @endphp
        @php
        if($no == 1){
            $first_room = "first_room";
        }else{
            $first_room ="";
        }
        $img = count($room['photo']) > 0 ? $room['photo'][0]->photo_path : "coming-soon.png";
        $id = count($room['allotment']) > 0 ? Crypt::encryptString($room->id) : "";
        @endphp
        <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="category contain" id="{{$first_room}}" value="room_{{$room->id}}" onClick="setAllotment(this, '{{$room->id}}');">
                <a>
                    <img src="{{asset('/user/'.$img)}}" alt="" class="shadow" style="width:100%; height:100%;">
                    <div class="centered">
                        <h2 class="white-shadow" style="margin-top:75px;"><strong>{{$room->room_name}}</strong></h2>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
        @else
        <p style="text-align: center"> <h2>No Room !</h2></p>
        @endif
    </div>

    </div>

    <div class="row">
        <div class="col-lg-7 ">
            <form action="/master_data/package/indexisi">
                <div class="panel panel-horison">
                    <div class="panel-heading">
                        <div class="panel-title white text-center" style="float:none">
                            <h2 class="white"><strong><span class="">Calendar</span></strong></h2>
                        </div>
                    </div>
                    <div class="panel-body shadow" style="display: block;">
                        <div class="calendar-env">
                            <!-- Calendar Body -->
                            <div class="calendar-body" style="width:100%">
                                <div id="calendar" class="fc fc-ltr fc-unthemed"></div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-lg-5 ">
            <form action="/master_data/package/indexisi">
                <div class="panel panel-horison">
                    <div class="panel-heading">
                        <div class="panel-title white text-center" style="float:none">
                            <h2 class="white"><strong>Set Rooms Allotment</strong></h2>
                        </div>
                    </div>
                    <div class="panel-body shadow" style="display: block;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Room Type</label>
                                    <input type="text" class="form-control" id="room_type" disabled>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Date Period</label>
                                    <div class="input-group">
                                        <div class="daterange daterange-inline" id="date-range" data-format="MMMM D, YYYY">
                                            <input type="hidden" name="date_start" id="date_start">
                                            <input type="hidden" name="date_end" id="date_end">
                                            <span id="date-show">START DATE - END DATE</span>
                                            <i class="entypo-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- ID ROOM EXTRA BED -->
                                <input type="hidden" id="room_id" name="room_id">
                                <input type="hidden" id="room_extrabed_rate">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Opened Allotment</label>
                                    <input type="text"  class="form-control thousandSeperator" id="room_allotment" required>
                                    <input type="hidden" class="form-control" id="room_allotment_input">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <!-- ID ROOM EXTRA BED -->
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Remaining Allotment</label>
                                    <input type="text"  class="form-control" id="remaining_allotment"  disabled>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="field-1" class="control-label">Publish Rate (Rp)</label>
                                <div class="form-group">
                                    <input type="text" id="room_publish_rate" class="form-control thousandSeperator" required>
                                    <input type="hidden" id="room_publish_rate_input" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="field-1" class="control-label">Room Only Rate (Rp)</label>
                                <div class="form-group">
                                    <input type="text" id="room_ro_rate" class="form-control thousandSeperator" required>
                                    <input type="hidden" id="room_ro_rate_input" class="form-control" >
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="form-group">
                                    <a href="#" class="btn btn-horison2 shadow"><strong>SET ALLOTMENT</strong></a>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group" style="margin-top:13px;" align="left">
                                    <a onClick="submitAllotment();"
                                        class="btn btn-horison2 btn-lg"><strong>Save</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>

<script>



    const months = ["January", "February", "March","April", "May",
    "June", "July", "August", "September", "October", "November", "December"];

    var rooms = "";



    $( document ).ready(function() {
        if($('#first_room').val() != null){
            $('#first_room').click();
        }

    });

    function load_data() {
        rooms = $.ajax({
            type: 'GET',
            url: "{{route('allotment.data')}}",
            async: false,
            dataType: 'json',
            done: function (results) {
                // Uhm, maybe I don't even need this?
                JSON.parse(results);
                return results;
            },
            fail: function (jqXHR, textStatus, errorThrown) {
                console.log('Could not get posts, server response: ' + textStatus + ': ' + errorThrown);
            }
        }).responseJSON;

    }

    function setAllotmentRate() {
        load_data();
        var id = $('#active_allotment').val();
        rooms.some(function (data, index) {
            if (data.id == id) {
                today = new Date();

                startDate = new Date();

                endDate = today.setMonth( today.getMonth() + parseInt(data.room_future_availability));
                endDate = new Date(endDate);


                // To calculate the time difference of two dates
                var Difference_In_Time = endDate - startDate;
                // To calculate the no. of days between two dates
                var days = Math.floor(Difference_In_Time / (1000 * 3600 * 24));
                dayOne = startDate;
                var oneDay = 1000 * 60 * 60 * 24;

                for (i = 0; i <= days; i++) {
                        var nowDay = oneDay * i;
                        var day = new Date(dayOne.getTime() + nowDay);
                        day = day.getDay();
                        var dayDate = new Date(dayOne.getTime() + nowDay).toISOString().slice(0, 10);
                        $('.allotment_' + dayDate).text(data.room_allotment);
                        $('.allotment_' + dayDate).attr('old_allotment', data.room_allotment);
                }


                if(data['allotment'].length > 0){
                    data['allotment'].forEach(function (allotment, index) {

                        var id = String(allotment.allotment_date);

                        $('.allotment_' + id).text(allotment.remaining_allotment);
                        $('.allotment_' + id).attr('old_allotment', allotment.allotment_room);

                    });
                    return true;
                }
            }
        });
    }

    function submitAllotment() {
        setAllotmentRate();
        var no = $('#active_allotment').val();
        var id = $('#id_' + no).val();
        var room_id = $('#room_id').val();
        var room_allotment = $('#room_allotment_input').val();
        var old_allotment = $('#old_room_allotment').val();

        var room_publish_rate = $('#room_publish_rate_input').val();
        var room_ro_rate = $('#room_ro_rate_input').val();
        var room_extrabed_rate = $('#room_extrabed_rate').val();
        var dateStart = $('#date_start').val();
        var dateEnd = $('#date_end').val();

        if (no == "") {
            alert('Room belum di pilih!')
        } else if (dateStart == "1970-01-01" || dateEnd == "1970-01-01") {
            alert('Please Choose Date on the left calendar first');
        } else {
            var check = true;
            var startDate = new Date(dateStart);
            var endDate = new Date(dateEnd);

            var dayOne = startDate;
            // To calculate the time difference of two dates
            var Difference_In_Time = endDate - startDate;
            // To calculate the no. of days between two dates
            var days = Math.floor(Difference_In_Time / (1000 * 3600 * 24));
            var oneDay = 1000 * 60 * 60 * 24;
            var old_allotment = 0;
            for (i = 0; i <= days; i++) {
                    var nowDay = oneDay * i;
                    var dayDate = new Date(dayOne.getTime() + nowDay).toISOString().slice(0, 10);
                    var remaining_allotment = $('.allotment_' + dayDate).text();
                    old_allotment = $('.allotment_' + dayDate).attr('old_allotment');

                    var total_reservation = parseInt(old_allotment - remaining_allotment);
                    var startDate = moment(new Date(dayDate)).format('DD MMMM YYYY');
                    var today = moment(new Date()).format('DD MMMM YYYY');

                    if(new Date(startDate) < new Date(today)){
                        var msg = "Sorry you cannot set allotment for date less than "+today;
                        alert(msg);
                        check = false;
                        break;
                    }else if(old_allotment != remaining_allotment && room_allotment < total_reservation){
                        dayDate = new Date(dayDate);
                        var msg = "Sorry for allotment in Date: "+moment(dayDate).format('DD MMMM YYYY')+" cannot be less than "+total_reservation;
                        alert(msg);
                        check = false;
                        break;
                    }
            }

           if(check){
                if(days == 0){
                    var remaining_allotment = parseInt(room_allotment - total_reservation);
                    $('#remaining_allotment').val(formatRibuan(remaining_allotment));
                }
                var opened_allotment = $('#room_allotment');
                var publish_rate = $('#room_publish_rate');
                var ro_rate = $('#room_ro_rate');

                if(opened_allotment.val() == ""){
                    alert("Field Opened Allotment Required!");
                    opened_allotment.focus();
                }else if(publish_rate.val() == ""){
                    alert("Field Publish Rate Required!");
                    publish_rate.focus();
                }else if(ro_rate.val() == ""){
                    alert("Field Room Only Rate Required!");
                    ro_rate.focus();
                }else{
                   if (ro_rate.val() == "0" || publish_rate.val() == "0") {
                        Swal.fire({
                            title: 'Are you sure ?',
                            text: 'To set the price 0 ?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No'
                            }).then((result) => {
                            if (result.value) {
                               $.ajax({
                                    type: "POST",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "id": id,
                                        "room_id": room_id,
                                        "room_allotment": room_allotment,
                                        "room_publish_rate": room_publish_rate,
                                        "room_ro_rate": room_ro_rate,
                                        "room_extrabed_rate": room_extrabed_rate,
                                        "dateStart": dateStart,
                                        "dateEnd": dateEnd
                                    },
                                    url: "{{ route('allotment.insert') }}",
                                    success: function (msg) {
                                        alert("Sukses!");
                                        setAllotmentRate();
                                    }
                                });
                            // For more information about handling dismissals please visit
                            // https://sweetalert2.github.io/#handling-dismissals
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                Swal.fire(
                                'Cancelled',
                                'Operation Cancel !',
                                'error'
                                )
                            }
                        })
                   } else {
                        $.ajax({
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id,
                                "room_id": room_id,
                                "room_allotment": room_allotment,
                                "room_publish_rate": room_publish_rate,
                                "room_ro_rate": room_ro_rate,
                                "room_extrabed_rate": room_extrabed_rate,
                                "dateStart": dateStart,
                                "dateEnd": dateEnd
                            },
                            url: "{{ route('allotment.insert') }}",
                            success: function (msg) {
                                alert("Sukses!");
                                setAllotmentRate();
                            }
                        });
                   }
                }
           }
        }

        // var id = document.getElementById("news-id").value;


    };

    function setBackgroundDefault(cek = false) {

        var days = new Date().getFullYear() % 4 == 0 ? 366 : 365;
        var dayOne = new Date(new Date().getFullYear(), 0, 0);
        var oneDay = 1000 * 60 * 60 * 24;
        for (i = 0; i <= days; i++) {
            var nowDay = oneDay * i;
            var dayDate = new Date(dayOne.getTime() + nowDay).toISOString().slice(0, 10);
            $('#' + dayDate).removeAttr('style');
            if(cek){
                $('.allotment_' + dayDate).text(0);
            }
        }

    }

    function setDateBackground(startDate, diffday) {
        setBackgroundDefault();
        startDate = new Date(startDate);

        var start = new Date(startDate.getFullYear(), 0, 0);
        var oneDay = 1000 * 60 * 60 * 24;
        for (i = 0; i <= diffday; i++) {
            var nowDay = oneDay * i;
            var dayDate = new Date(startDate.getTime() + nowDay).toISOString().slice(0, 10);
            $('#' + dayDate).attr('style', 'background:var(--quaternary-font-color);');
        }
        var id = $('#active_allotment').val();
        var setStart = $('#date_start');
        var setEnd = $('#date_end');

        startDate = new Date(startDate.getTime()).toISOString().slice(0, 10);
        setStart.val(startDate);
        setEnd.val(dayDate);
        setAllotmentRate();

    }

    var dateBefore = "";

    function thisDate(e) {
        if ($('#active_allotment').val() == "") {
            alert('Select Room First!')
        } else {
            setBackgroundDefault();
            var id = $('#active_allotment').val();
            var setStart = $('#date_start');
            var setEnd = $('#date_end');


            if (dateBefore != "") {
                dateBefore.removeAttribute('style');
            }
            dateBefore = e;
            var date = new Date(e.id);

            dateStart = date.toISOString().slice(0, 10);
            diffDay = 0;
            var startDate = date.toISOString().slice(0, 10);
            e.setAttribute('style', 'background:var(--quaternary-font-color);');
            setStart.val(String(startDate));
            setEnd.val(String(startDate));

            let current_datetime = new Date(startDate);
            let formatted_date = months[current_datetime.getMonth()] +' '+ current_datetime.getDate() + ", " + current_datetime.getFullYear() + ' - '+
            months[current_datetime.getMonth()] +' '+ current_datetime.getDate() + ", " + current_datetime.getFullYear();
            $('#date-show').text(formatted_date);

            rooms.some(function (data, index) {
                if (data.id == id) {
                    $('#room_extrabed_rate').val(data.room_extrabed_rate);
                    $('#room_allotment').val(formatRibuan(data.room_allotment));
                    $('#room_allotment_input').val(data.room_allotment);

                    $('#remaining_allotment').val(formatRibuan(data.room_allotment));
                    var day = current_datetime.getDay();
                    if(day == 0 || day > 4){
                        $('#room_publish_rate').val(formatRibuan(data.room_weekend_rate));
                        $('#room_publish_rate_input').val(data.room_weekend_rate);
                        $('#room_ro_rate').val(formatRibuan(data.room_weekend_ro_rate));
                        $('#room_ro_rate_input').val(data.room_weekend_ro_rate);

                    }else{
                        $('#room_publish_rate').val(formatRibuan(data.room_publish_rate));
                        $('#room_publish_rate_input').val(data.room_publish_rate);
                        $('#room_ro_rate').val(formatRibuan(data.room_ro_rate));
                        $('#room_ro_rate_input').val(data.room_ro_rate);
                    }


                    if (data['allotment'].length > 0) {
                        data['allotment'].some(function (allotment, index) {
                            if (allotment.allotment_date == startDate) {
                                $('#room_extrabed_rate').val(allotment.allotment_extrabed_rate);
                                $('#room_allotment').val(formatRibuan(allotment.allotment_room));
                                $('#room_allotment_input').val(allotment.allotment_room);
                                $('#remaining_allotment').val(formatRibuan(allotment.remaining_allotment));
                                $('#room_publish_rate').val(formatRibuan(allotment.allotment_publish_rate));
                                $('#room_publish_rate_input').val(allotment.allotment_publish_rate);
                                $('#room_ro_rate').val(formatRibuan(allotment.allotment_ro_rate));
                                $('#room_ro_rate_input').val(allotment.allotment_ro_rate);
                                return true;
                            }
                        });
                    }
                    return true;
                }
            });
        }

    }

    var allotmentBefore = "";

    function setAllotment(e, id) {
        if (allotmentBefore != "") {
            allotmentBefore.classList.remove('active');
        }
        allotmentBefore = e;

        e.classList.add('active');
        $('#active_allotment').val(id);
        setBackgroundDefault(true);
        setAllotmentRate();

        var setStart = $('#date_start');
        var setEnd = $('#date_end');

        let current_datetime = new Date();
        let formatted_date = months[current_datetime.getMonth()] +' '+ current_datetime.getDate() + ", " + current_datetime.getFullYear() + ' - '+
        months[current_datetime.getMonth()] +' '+ current_datetime.getDate() + ", " + current_datetime.getFullYear();
        $('#date-show').text(formatted_date);


        var startDate = current_datetime.toISOString().slice(0, 10);



            rooms.some(function (data, index) {
                if (data.id == id) {
                    $('#room_id').val(data.id);
                    $('#room_type').val(data.room_name);
                    $('#room_extrabed_rate').val(data.room_extrabed_rate);
                    $('#room_allotment').val(formatRibuan(data.room_allotment));
                    $('#room_allotment_input').val(data.room_allotment);

                    $('#remaining_allotment').val(formatRibuan(data.room_allotment));
                    var day = current_datetime.getDay();
                    if(day == 0 || day > 4){
                        $('#room_publish_rate').val(formatRibuan(data.room_weekend_rate));
                        $('#room_publish_rate_input').val(data.room_weekend_rate);
                        $('#room_ro_rate').val(formatRibuan(data.room_weekend_ro_rate));
                        $('#room_ro_rate_input').val(data.room_weekend_ro_rate);

                    }else{
                        $('#room_publish_rate').val(formatRibuan(data.room_publish_rate));
                        $('#room_publish_rate_input').val(data.room_publish_rate);
                        $('#room_ro_rate').val(formatRibuan(data.room_ro_rate));
                        $('#room_ro_rate_input').val(data.room_ro_rate);
                    }


                    if (data['allotment'].length > 0) {
                        data['allotment'].some(function (allotment, index) {
                            if (allotment.allotment_date == startDate) {
                                $('#room_extrabed_rate').val(allotment.allotment_extrabed_rate);
                                $('#room_allotment').val(formatRibuan(allotment.allotment_room));
                                $('#room_allotment_input').val(allotment.allotment_room);
                                $('#remaining_allotment').val(formatRibuan(allotment.remaining_allotment));
                                $('#room_publish_rate').val(formatRibuan(allotment.allotment_publish_rate));
                                $('#room_publish_rate_input').val(allotment.allotment_publish_rate);
                                $('#room_ro_rate').val(formatRibuan(allotment.allotment_ro_rate));
                                $('#room_ro_rate_input').val(allotment.allotment_ro_rate);
                                return true;
                            }
                        });
                    }
                    return true;
                }
            });
            setTimeout(function(){
                $('#' + startDate).attr('style', 'background:var(--quaternary-font-color);');
                setStart.val(String(startDate));
                setEnd.val(String(startDate));
            }, 100);

    }


    //START format untuk di set ketika memilih salah satu allotment
    function formatRibuan(angka) {
        angka = String(angka);

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

        return rupiah;
    }

    //END

    //START merubah ketika mengetik pada kolom

    /* Fungsi formatRupiah */
    function formatRibuanTyping(rupiah, angka, prefix) {
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
    //END

</script>

<script type="text/javascript">
    $(document).ready(function () {
        // $('#calendar').fullCalendar({
        //     defaultView: 'month',
        //     validRange: {
        //         start: '2017-05-01',
        //         end: '2017-06-01'
        //     }
        // });
        $('.responsive').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });

</script>


@endsection
