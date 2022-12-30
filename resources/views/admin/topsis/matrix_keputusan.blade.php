@extends('layouts.admin')
@section('title')
    SPK-KELOMPOK 3 | Matrix Keputusan
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('content')
<br>
<br>

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="button-list">
                <a href="/export-topsis-excel" class="btn btn-outline-success btn-sm">
                    <i class="fa-sharp fa-solid fa-file-excel"></i> Export Excel
                </a>
                <a href="/export-pdf-topsis" class="btn btn-outline-danger btn-sm">
                    <i class="fa-sharp fa-solid fa-file-pdf"></i> Export PDF
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Matrix Keputusan</b></h4>
            <p class="text-muted font-14 m-b-30">
            
            </p>

            <table id="table-mahasiswa" class="table table-bordered">
                <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Fakultas</th>
                    <th>Prestasi (C1)</th>
                    <th>Karya Ilmiah (C2)</th>
                    <th>Bahasa Asing (C3)</th>
                    <th>IPK (C4)</th>
                    <th>Indeks SKS (C5)</th>
                </tr>
                </thead>


                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Matrix Keputusan Ternormalisasi</b></h4>
            <table id="table-normalisasi" class="table table-bordered">
                <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Fakultas</th>
                    <th>Prestasi (C1)</th>
                    <th>Karya Ilmiah (C2)</th>
                    <th>Bahasa Asing (C3)</th>
                    <th>IPK (C4)</th>
                    <th>Indeks SKS (C5)</th>
                </tr>
                </thead>


                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Matrix Keputusan Terbobot</b></h4>
            <table id="table-terbobot" class="table table-bordered">
                <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Fakultas</th>
                    <th>Prestasi (C1)</th>
                    <th>Karya Ilmiah (C2)</th>
                    <th>Bahasa Asing (C3)</th>
                    <th>IPK (C4)</th>
                    <th>Indeks SKS (C5)</th>
                </tr>
                </thead>


                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Matrix Solusi Ideal Positif Negatif</b></h4>
            <p class="text-muted font-14 m-b-30">
            
            </p>

            <table id="table-mahasiswa" class="table table-bordered">
                <thead>
                <tr>
                    <th>Atribut</th>
                    <th>Prestasi (C1)</th>
                    <th>Karya Ilmiah (C2)</th>
                    <th>Bahasa Asing (C3)</th>
                    <th>IPK (C4)</th>
                    <th>Indeks SKS (C5)</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Positif</b></td>
                        <td>{{$solusi['c1']['positif']}} </td>
                        <td>{{$solusi['c2']['positif']}}</td>
                        <td>{{$solusi['c3']['positif']}}</td>
                        <td>{{$solusi['c4']['positif']}}</td>
                        <td>{{$solusi['c5']['positif']}}</td>
                    </tr>
                    <tr>
                        <td><b>Negatif</b></td>
                        <td>{{$solusi['c1']['negatif']}}</td>
                        <td>{{$solusi['c2']['negatif']}}</td>
                        <td>{{$solusi['c3']['negatif']}}</td>
                        <td>{{$solusi['c4']['negatif']}}</td>
                        <td>{{$solusi['c5']['negatif']}}</td>
                    </tr>
                </tbody>



                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Jarak Solusi Positif</b></h4>
            <p class="text-muted font-14 m-b-30">
            
            </p>

            <table id="table-positif" class="table table-bordered">
                <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Prestasi (C1)</th>
                    <th>Karya Ilmiah (C2)</th>
                    <th>Bahasa Asing (C3)</th>
                    <th>IPK (C4)</th>
                    <th>Indeks SKS (C5)</th>
                    <th>Total</th>
                </tr>
                </thead>


                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Jarak Solusi Negatif</b></h4>
            <p class="text-muted font-14 m-b-30">
            
            </p>

            <table id="table-negatif" class="table table-bordered">
                <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Prestasi (C1)</th>
                    <th>Karya Ilmiah (C2)</th>
                    <th>Bahasa Asing (C3)</th>
                    <th>IPK (C4)</th>
                    <th>Indeks SKS (C5)</th>
                    <th>Total</th>
                </tr>
                </thead>


                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Nilai Preferensi</b></h4>
            <p class="text-muted font-14 m-b-30">
            
            </p>

            <table id="table-Preferensi" class="table table-bordered">
                <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Prestasi (C1)</th>
                    <th>Karya Ilmiah (C2)</th>
                    <th>Bahasa Asing (C3)</th>
                    <th>IPK (C4)</th>
                    <th>Indeks SKS (C5)</th>
                    <th>Nilai Preferensi</th>
                </tr>
                </thead>


                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@push('scripts')
        <script type="text/javascript">
            
            $(document).ready(function() {
                $("#table-mahasiswa").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.topsis.matrix_keputusan') !!}',
                    order:[0,'desc'],
                    columns:[
                        {data:'nim',name :'nim'},
                        {data:'nama', name: 'nama'},
                        {data:'fakultas',name:'fakultas'},
                        {data:'l_prestasi',name:'l_prestasi'},
                        {data:'l_karya_ilmiah',name:'l_karya_ilmiah'},
                        {data:'l_bahasa_asing',name:'l_bahasa_asing'},
                        {data:'l_ipk',name:'l_ipk'},
                        {data:'indeks_sks',name:'indeks_sks'}                        
                    ]
                });
            } );

        </script>

        {{-- normalisasi --}}
        <script type="text/javascript">
                    
            $(document).ready(function() {
                $("#table-normalisasi").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.topsis.matrix_keputusan_ternormalisasi') !!}',
                    order:[0,'desc'],
                    columns:[
                        {data:'nim',name :'nim'},
                        {data:'nama', name: 'nama'},
                        {data:'fakultas',name:'fakultas'},
                        {data:'r_prestasi',name:'r_prestasi'},
                        {data:'r_karya_ilmiah',name:'r_karya_ilmiah'},
                        {data:'r_bahasa_asing',name:'r_bahasa_asing'},
                        {data:'r_ipk',name:'r_ipk'},
                        {data:'r_indeks_sks',name:'r_indeks_sks'}                        
                    ]
                });
            } );

        </script>

        {{-- terbobot --}}
        <script type="text/javascript">
            
            $(document).ready(function() {
                $("#table-terbobot").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.topsis.matrix_keputusan_terbobot') !!}',
                    order:[0,'desc'],
                    columns:[
                        {data:'nim',name :'nim'},
                        {data:'nama', name: 'nama'},
                        {data:'fakultas',name:'fakultas'},
                        {data:'v_prestasi',name:'v_prestasi'},
                        {data:'v_karya_ilmiah',name:'v_karya_ilmiah'},
                        {data:'v_bahasa_asing',name:'v_bahasa_asing'},
                        {data:'v_ipk',name:'v_ipk'},
                        {data:'v_indeks_sks',name:'v_indeks_sks'}                        
                    ]
                });
            } );

        </script>

        {{-- positif --}}
        <script type="text/javascript">
            
            $(document).ready(function() {
                $("#table-positif").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.topsis.jarak_solusi_positif') !!}',
                    order:[0,'desc'],
                    columns:[
                        {data:'nama', name: 'nama'},
                        {data:'a_prestasi',name:'a_prestasi'},
                        {data:'a_karya_ilmiah',name:'a_karya_ilmiah'},
                        {data:'a_bahasa_asing',name:'a_bahasa_asing'},
                        {data:'a_ipk',name:'a_ipk'},
                        {data:'a_indeks_sks',name:'a_indeks_sks'},
                        {data:'a_total',name:'a_total'}                        
                    ]
                });
            } );

        </script>

        {{-- negatif --}}
        <script type="text/javascript">
            
            $(document).ready(function() {
                $("#table-negatif").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.topsis.jarak_solusi_negatif') !!}',
                    order:[0,'desc'],
                    columns:[
                        {data:'nama', name: 'nama'},
                        {data:'b_prestasi',name:'b_prestasi'},
                        {data:'b_karya_ilmiah',name:'b_karya_ilmiah'},
                        {data:'b_bahasa_asing',name:'b_bahasa_asing'},
                        {data:'b_ipk',name:'b_ipk'},
                        {data:'b_indeks_sks',name:'b_indeks_sks'},
                        {data:'b_total',name:'b_total'}                        
                    ]
                });
            } );

        </script>

        {{-- Preferensi --}}
        <script type="text/javascript">
            
            $(document).ready(function() {
                $("#table-Preferensi").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.topsis.nilai_preferensi') !!}',
                    order:[0,'desc'],
                    columns:[
                        {data:'nama', name: 'nama'},
                        {data:'a_prestasi',name:'a_prestasi'},
                        {data:'a_karya_ilmiah',name:'a_karya_ilmiah'},
                        {data:'a_bahasa_asing',name:'a_bahasa_asing'},
                        {data:'a_ipk',name:'a_ipk'},
                        {data:'a_indeks_sks',name:'a_indeks_sks'},
                        {data:'nilai_preferensi',name:'nilai_preferensi'}                        
                    ]
                });
            } );

        </script>
        @include("admin.script.form-modal-ajax")
@endpush