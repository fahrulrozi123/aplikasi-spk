@extends('templates/template')
@section('header_title')
    FUNCTION ROOM
@endsection
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
            <a href="/master_data/function_room/create" class="btn btn-horison btn-lg pull-right">
                <b>+ ADD NEW FUNCTION ROOM</b>
            </a>
        </div>
        <br>

        <div class="row">
            {{-- PUT DATA IN HIDDEN FOR TRANSFER TO JS --}}
            <input id="function_rooms" type="hidden" value='@json($function_rooms)'>
            @php $no = 0; @endphp
            @foreach ($function_rooms as $function_room)
                @php $no++; @endphp
                @php
                    if (count($function_room['photos']) > 0) {
                        $img = $function_room['photos'][0]->photo_path;
                    } else {
                        $img = '';
                    }
                @endphp
                <div class="panel panel-default">
                    <div class="panel-body shadow">

                        <div class="row">
                            <div class="col-lg-3 col-sm-12 mb">
                                <img src="{{ asset('/user/' . $img) }}" alt="" class="containerBox shadow" loading="lazy">
                                <br><br>
                            </div>

                            <div class="col-lg-4">
                                <h4 style="margin-bottom:-5px;"><b>{{ $function_room->func_name }}</b></h4>
                                @if (strlen($function_room->func_room_desc) > 350)
                                    <p class="mt line-clamp-8" style="text-align:justify;">{!! strip_tags(substr($function_room->func_room_desc, 0, 350) . '...') !!}</p>
                                @else
                                    <p class="mt line-clamp-8" style="text-align:justify;">{!! strip_tags($function_room->func_room_desc) !!}</p>
                                @endif
                                <br>
                            </div>
                            <div class="col-lg-5">
                                <h4><b>Function Room Layout</b></h4>
                                <div class="row"> {{-- list type fr --}}
                                    <div class="col-sm-6 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-3 col-md-3"> {{-- icon --}}
                                                <div class="fr-icon-2 horison-icon">
                                                    {!! file_get_contents(asset('/images/function-room/FR-Classroom.svg'), false, stream_context_create($arrContextOptions)) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                                                <p class="fr-name-2">Class Room</p>
                                            </div>
                                            <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                                                <p class="fr-pax">
                                                    <script>
                                                        document.write(formatRupiah("{{ $function_room->func_class }}"));
                                                    </script> Pax
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-xs-3 col-md-3"> {{-- icon --}}
                                                <div class="fr-icon-2 horison-icon">
                                                    {!! file_get_contents(asset('/images/function-room/FR-Theatre.svg'), false, stream_context_create($arrContextOptions)) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                                                <p class="fr-name-2">Theatre</p>
                                            </div>
                                            <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                                                <p class="fr-pax">
                                                    <script>
                                                        document.write(formatRupiah("{{ $function_room->func_theatre }}"));
                                                    </script> Pax
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px; margin-bottom:10px;">
                                            <div class="col-xs-3 col-md-3"> {{-- icon --}}
                                                <div class="fr-icon-2 horison-icon">
                                                    {!! file_get_contents(asset('/images/function-room/FR-UShape.svg'), false, stream_context_create($arrContextOptions)) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                                                <p class="fr-name-2">U-Shape</p>
                                            </div>
                                            <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                                                <p class="fr-pax">
                                                    <script>
                                                        document.write(formatRupiah("{{ $function_room->func_ushape }}"));
                                                    </script> Pax
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-3 col-md-3"> {{-- icon --}}
                                                <div class="fr-icon-2 horison-icon">
                                                    {!! file_get_contents(asset('/images/function-room/FR-Boardroom.svg'), false, stream_context_create($arrContextOptions)) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                                                <p class="fr-name-2">Board Room</p>
                                            </div>
                                            <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                                                <p class="fr-pax">
                                                    <script>
                                                        document.write(formatRupiah("{{ $function_room->func_board }}"));
                                                    </script> Pax
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-xs-3 col-md-3"> {{-- icon --}}
                                                <div class="fr-icon-2 horison-icon">
                                                    {!! file_get_contents(asset('/images/function-room/FR-RoundTable.svg'), false, stream_context_create($arrContextOptions)) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                                                <p class="fr-name-2">Round Table</p>
                                            </div>
                                            <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                                                <p class="fr-pax">
                                                    <script>
                                                        document.write(formatRupiah("{{ $function_room->func_round }}"));
                                                    </script> Pax
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:10px; margin-bottom:10px;">
                                            <div class="col-xs-3 col-md-3"> {{-- icon --}}
                                                <div class="fr-icon-2 horison-icon">
                                                    {!! file_get_contents(asset('/images/function-room/FR-Dimension.svg'), false, stream_context_create($arrContextOptions)) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-5 col-md-5"> {{-- fr name --}}
                                                <p class="fr-name-2">Dimension</p>
                                            </div>
                                            <div class="col-xs-4 col-md-4"> {{-- fr pax total --}}
                                                <p class="fr-pax">
                                                    <script>
                                                        document.write(formatRupiah("{{ $function_room->func_dimension }}"));
                                                    </script> Sqm
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if (count($function_room['partition']) > 0)
                                    <a href="javascript:;" onclick="show_modal({{ $no - 1 }});">
                                        <p class="fr-link-text2" align="right">See {{ $function_room->func_name }} Layout
                                            Details<span class="entypo-right-open"></span></p>
                                    </a>
                                @endif
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-lg-12">
                                <a href="/master_data/function_room/edit/{{ Crypt::encryptString($function_room->id) }}"
                                    class="btn btn-horison-gold"><b>Manage Function Room</b>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('master_data.function_room.modal')
    <script>
        var function_rooms = JSON.parse($('#function_rooms').val());

        function show_modal(index) {
            var partition = function_rooms[index];
            $('#fr_class').text(partition.func_class + " Pax");
            $('#fr_theatre').text(partition.func_theatre + " Pax");
            $('#fr_ushape').text(partition.func_ushape + " Pax");
            $('#fr_board').text(partition.func_board + " Pax");
            $('#fr_round').text(partition.func_round + " Pax");
            $('#fr_dimension').text(partition.func_dimension + " Sqm");
            var html = '';
            partition['partition'].forEach(element => {
                html += '<tr>' +
                    '<td class="fr-modal-table-content">' + element.func_name + '</td>' +
                    '<td class="fr-modal-table-content">' + element.func_dimension + '</td>' +
                    '<td class="fr-modal-table-content">' + element.func_class + '</td>' +
                    '<td class="fr-modal-table-content">' + element.func_theatre + '</td>' +
                    '<td class="fr-modal-table-content">' + element.func_ushape + '</td>' +
                    '<td class="fr-modal-table-content">' + element.func_board + '</td>' +
                    '<td class="fr-modal-table-content">' + element.func_round + '</td>' +
                    '</tr>';
                $('#partition_table-body').empty();
                $('#partition_table-body').append(html);
            });
            jQuery('#frdetailModal').modal('show');
        }
    </script>
@endsection
