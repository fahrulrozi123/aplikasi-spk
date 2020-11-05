@extends('templates/template')
@section("header_title") ACCOUNT @endsection
@section('content')

<div class="col-lg-12">
    <div class="row">

        <a href="/main_page/account/create" class="btn btn-lg btn-horison pull-right"><b>+ REGISTER USER</b></a>

        <br><br><br>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary" data-collapsed="0">

                    <!-- panel head -->
                    <div class="panel-heading shadow">

                        <div class="panel-title">
                            <h5><strong>All Registered User</strong></h5>
                        </div>
                        <div class="panel-options">
                            {{-- <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1"><i class="entypo-cog"></i></a> --}}
                            {{-- <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> --}}
                            {{-- <a href="#" data-rel="reload" class="bg"><i class="entypo-arrows-ccw"></i></a> --}}
                        </div>

                    </div>

                    <!-- panel body -->
                    <div class="panel-body no-padding shadow">

                        <div style="overflow-x:auto;">
                            <table class="table table-striped table-bordered datatable" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="horisonth">Username</th>
                                        <th class="horisonth">Account Name</th>
                                        <th class="horisonth">Account Role</th>
                                        <th class="horisonth">Phone Number</th>
                                        <th class="horisonth">Email</th>
                                        <th class="horisonth">Last Login</th>
                                        <th class="horisonth">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;?>
                                    @foreach($users as $user) <?php $no++ ;?>
                                    <tr class="horisontd">
                                        <td style="vertical-align:middle" align="center">{{$user->username}}</td>
                                        <td style="vertical-align:middle" align="center">{{$user->name}}</td>
                                        @if($user->level =="0")
                                        <td style="vertical-align:middle" align="center">Administrator</td>
                                        @elseif($user->level =="1")
                                        <td style="vertical-align:middle" align="center">Marketing</td>
                                        @else
                                        <td style="vertical-align:middle" align="center">Front Office</td>

                                        @endif
                                        <td style="vertical-align:middle" align="center">{{$user->phone}}</td>
                                        <td style="vertical-align:middle" align="center">{{$user->email}}</td>
                                        <td style="vertical-align:middle" align="center">{{$user->last_login}}</td>
                                        <td class="text-center">
                                            <a type="button"
                                                href="/main_page/account/edit/{{Crypt::encryptString($user->id)}}/0"
                                                class="btn btn-horison-gold"><i class="fa fa-pencil"></i></a>
                                            @if($user->id != Auth::id())
                                            <a type="button" onclick="return confirm('Are you sure?')"
                                                href="/main_page/account/delete/{{Crypt::encryptString($user->id)}}"
                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @foreach($deleted as $user) <?php $no++ ;?>
                                    <tr class="horisontd " style="background-color: #a49c9c">
                                        <td style="vertical-align:middle" align="center">{{$user->username}}</td>
                                        <td style="vertical-align:middle" align="center">{{$user->name}}</td>
                                        @if($user->level =="0")
                                        <td style="vertical-align:middle" align="center">Administrator</td>
                                        @elseif($user->level =="1")
                                        <td style="vertical-align:middle" align="center">Marketing</td>
                                        @else
                                        <td style="vertical-align:middle" align="center">Front Office</td>

                                        @endif
                                        <td style="vertical-align:middle" align="center">{{$user->phone}}</td>
                                        <td style="vertical-align:middle" align="center">{{$user->email}}</td>
                                        <td style="vertical-align:middle" align="center">{{$user->last_login}}</td>
                                        <td class="text-center">
                                            @if($user->id != Auth::id())
                                            <a type="button" onclick="return confirm('Are you sure?')"
                                                href="/main_page/account/restore/{{Crypt::encryptString($user->id)}}"
                                                class="btn btn-horison">Restore</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>



<script type="text/javascript">
    //TABLE 1//

    jQuery(document).ready(function ($) {
        $(".cke_dialog_ui_vbox_child").fadeOut();
        $('.cke_dialog_ui_fileButton cke_dialog_ui_button').click(function () {
			alert('kwkwkw');
    	});

        var $table1 = jQuery('#table-1');

        // Initialize DataTable
        $table1.DataTable({
            "order": [[ 6, "asc" ]],
            "aLengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "bStateSave": true
        });

        // Initalize Select Dropdown after DataTables is created
        $table1.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
        });
    });


</script>

@endsection
