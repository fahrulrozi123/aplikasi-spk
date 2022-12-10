@extends('layouts.admin')
@section('title')
    SPK-KELOMPOK 3 | Mahasiswa
@endsection
@section('content')
<br>
<div class="row">
    <div class="col-12">
        <div class="card-box">

            <h4 class="header-title m-t-0">Tambah Mahasiswa</h4>

            @include('admin.mahasiswa.add')
            @include('admin.mahasiswa.detail')
            {{-- @include('admin.mahasiswa.edit') --}}


            <div class="button-list">
                <!-- Custom width modal -->
                <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="width: 12%;" data-toggle="modal" data-target="#tambah-mahasiswa" data-table="#tabel-user">
                {{-- <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="width: 12%;" data-toggle="modal" data-target="#edit-mahasiswa" data-table="#tabel-user"> --}}
                    <i class="mdi mdi-library-plus"></i> Tambah Data</button>
            </div>
        </div>
    </div><!-- end col -->
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Mahasiswa Berprestasi</b></h4>
            <p class="text-muted font-14 m-b-30">
            
            </p>

            <table id="table-mahasiswa" class="table table-bordered">
                <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Fakultas</th>
                    <th>Prestasi</th>
                    <th>Bahasa Asing</th>
                    <th>Karya Ilmiah</th>
                    <th>IPK</th>
                    <th>Indeks SKS</th>
                    <th>Aksi</th>                                            
                </tr>
                </thead>


                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->
<!-- end row -->


@endsection
@push('scripts')
        <script type="text/javascript">

            function Detail(trigerer){
                    var tr = $(trigerer).parent().parent();
                    var modal = $(trigerer).data("target");
                    $(modal + " #nim").html($("#table-mahasiswa").DataTable().row(tr).data().nim);
                    $(modal + " #nama").html($("#table-mahasiswa").DataTable().row(tr).data().nama);
                    $(modal + " #fakultas").html("fakultas: "+$("#table-mahasiswa").DataTable().row(tr).data().fakultas);
                    $(modal + " #prestasi").html("prestasi: "+$("#table-mahasiswa").DataTable().row(tr).data().prestasi);
                    $(modal + " #bahasa_asing").html("bahasa asing: "+$("#table-mahasiswa").DataTable().row(tr).data().bahasa_asing);
                    $(modal + " #karya_ilmiah").html("karya ilmiah: "+$("#table-mahasiswa").DataTable().row(tr).data().karya_ilmiah);
                    $(modal + " #ipk").html("ipk: "+$("#table-mahasiswa").DataTable().row(tr).data().ipk);
                    $(modal + " #indeks_sks").html("indeks sks: "+$("#table-mahasiswa").DataTable().row(tr).data().indeks_sks);
                }
            
            function editDataUser(trigerer){
                    var tabel = $(trigerer).parent().data('table-target');
                    var modal = $(trigerer).data('target');
                    var tr =$(trigerer).parent().parent().parent();
                    data = $("table#"+tabel).DataTable().row(tr).data();
                    var form = modal+" form ";
                    var role = JSON.parse(data.role_id);
                    $(form+"input#name").val(data.name);
                    $(form+"input#email").val(data.email);
                    $(form+" input[type=checkbox]").prop("checked",false);
                    role.forEach(role_id => {
                        $(form+" input#role_"+role_id).prop("checked",true);
                    });
                    $(form+"input#id").val(data.id);
                }

            $(document).ready(function() {
                $("#table-mahasiswa").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.mahasiswa.index') !!}',
                    order:[0,'desc'],
                    columns:[
                        {data:'nim',name :'nim'},
                        {data:'nama', name: 'nama'},
                        {data:'fakultas',name:'fakultas'},
                        {data:'prestasi',name:'prestasi'},
                        {data:'bahasa_asing',name:'bahasa_asing'},
                        {data:'karya_ilmiah',name:'karya_ilmiah'},
                        {data:'ipk',name:'ipk'},
                        {data:'indeks_sks',name:'indeks_sks'},
                        {data:'aksi',name: 'aksi',searchable:false,orderable: false}                        
                    ]
                });
            } );

        </script>
        @include("admin.script.form-modal-ajax")
@endpush