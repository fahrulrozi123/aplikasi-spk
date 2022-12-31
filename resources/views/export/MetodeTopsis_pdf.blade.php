<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Perhitungan metode topsis</title>
  <style>
    table {
      /* margin: auto; */
      font-family: "Arial";
      font-size: 15px;
    }
    .table {
        border-collapse: collapse;
        font-size: 15px;
    }
    .table th, 
    .table td {
        border-bottom: 1px solid #f1e7d8;
        border-left: 1px solid #f1e7d8;
        padding: 9px 21px;
    }
    .table th, 
    .table td:last-child {
        border-right: 1px solid #f1e7d8;
    }
    .table td:first-child {
        border-top: 1px solid #f1e7d8;
    }
    caption {
        caption-side: top;
        margin-bottom: 10px;
        font-size: 16px;
    }
    
    /* Table Header */
    .table thead th {
        background-color: #b68440;
        color: #FFFFFF;
    }
    
    /* Table Body */
    .table tbody td {
        color: #353535;
    }
    .table tbody tr:nth-child(odd) td {
        background-color: #f1e7d8;
    }
    .table tbody tr:hover th,
    .table tbody tr:hover td {
        background-color: #f1e7d8;
        transition: all .2s;
    }
    
    /*Tabel Responsive 1*/
    .table-container {
        overflow: auto;
    }
  </style>
</head>

<h2 style="text-align: center;"><u> Pencarian mahasiswa berprestasi dengan metode topsis </u></h2>
<body>
  <div class="table-container">
    <h3 class="">Data Kriteria</h3>
    <table class="table">
        <thead>
            <tr>
              <th>Kode</th>
              <th>Kriteria</th>
              <th>Atribut</th>
              <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td>C1</td>
            <td>Prestasi</td>
            <td>Cost</td>
            <td>4</td>
        </tr>
        <tr>
            <td>C2</td>
            <td>Karya Tulis Ilmiah</td>
            <td>Benefit</td>
            <td>2</td>
        </tr>
        <tr>
            <td>C3</td>
            <td>Bahasa Asing</td>
            <td>Cost</td>
            <td>5</td>
        </tr>
        <tr>
            <td>C4</td>
            <td>Ipk</td>
            <td>Benefit</td>
            <td>1</td>
        </tr>
        <tr>
            <td>C5</td>
            <td>Indeks Sks</td>
            <td>Cost</td>
            <td>5</td>
        </tr>
        </tbody>
    </table>
  </div>
  <br>
  <div class="table-container">
    <h3 class="">Matrix Keputusan</h3>
    <table class="table">
        <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Prestasi</th>
              <th>Karya Ilmiah</th>
              <th>Bahasa Asing</th>
              <th>Ipk</th>
              <th>Indeks sks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $item)  
            <tr>
              <td>{{ $item->nama }}</td>
              <td style="">{{ $item->l_prestasi }}</td>
              <td style="">{{ $item->l_karya_ilmiah }}</td>
              <td style="">{{ $item->l_bahasa_asing }}</td>
              <td style="">{{ $item->l_ipk }}</td>
              <td style="">{{ $item->indeks_sks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <br>
  <div class="table-container">
    <h3 class="">Matrix Keputusan Ternormalisasi</h3>
    <table class="table">
        <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Prestasi</th>
              <th>Karya Ilmiah</th>
              <th>Bahasa Asing</th>
              <th>Ipk</th>
              <th>Indeks sks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $item)  
            <tr>
              <td>{{ $item->nama }}</td>
              <td style="">{{ $item->r_prestasi }}</td>
              <td style="">{{ $item->r_karya_ilmiah }}</td>
              <td style="">{{ $item->r_bahasa_asing }}</td>
              <td style="">{{ $item->r_ipk }}</td>
              <td style="">{{ $item->r_indeks_sks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <br>
  <div class="table-container">
    <h3 class="">Matrix Keputusan Terbobot</h3>
    <table class="table">
        <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Prestasi</th>
              <th>Karya Ilmiah</th>
              <th>Bahasa Asing</th>
              <th>Ipk</th>
              <th>Indeks sks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $item)  
            <tr>
              <td>{{ $item->nama }}</td>
              <td style="">{{ $item->v_prestasi }}</td>
              <td style="">{{ $item->v_karya_ilmiah }}</td>
              <td style="">{{ $item->v_bahasa_asing }}</td>
              <td style="">{{ $item->v_ipk }}</td>
              <td style="">{{ $item->v_indeks_sks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <br>
  <div class="table-container">
    <h3 class="">Jarak Solusi Positif</h3>
    <table class="table">
        <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Prestasi</th>
              <th>Karya Ilmiah</th>
              <th>Bahasa Asing</th>
              <th>Ipk</th>
              <th>Indeks sks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $item)  
            <tr>
              <td>{{ $item->nama }}</td>
              <td style="">{{ $item->a_prestasi }}</td>
              <td style="">{{ $item->a_karya_ilmiah }}</td>
              <td style="">{{ $item->a_bahasa_asing }}</td>
              <td style="">{{ $item->a_ipk }}</td>
              <td style="">{{ $item->a_indeks_sks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <br>
  <div class="table-container">
    <h3 class="">Jarak Solusi Negatif</h3>
    <table class="table">
        <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Prestasi</th>
              <th>Karya Ilmiah</th>
              <th>Bahasa Asing</th>
              <th>Ipk</th>
              <th>Indeks sks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $item)  
            <tr>
              <td>{{ $item->nama }}</td>
              <td style="">{{ $item->b_prestasi }}</td>
              <td style="">{{ $item->b_karya_ilmiah }}</td>
              <td style="">{{ $item->b_bahasa_asing }}</td>
              <td style="">{{ $item->b_ipk }}</td>
              <td style="">{{ $item->b_indeks_sks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <br>
  <div class="table-container">
    <h3 class="">Nilai Preferensi</h3>
    <table class="table">
        <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Prestasi</th>
              <th>Karya Ilmiah</th>
              <th>Bahasa Asing</th>
              <th>Ipk</th>
              <th>Indeks sks</th>
              <th>Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $item)  
            <tr>
              <td>{{ $item->nama }}</td>
              <td style="">{{ $item->a_prestasi }}</td>
              <td style="">{{ $item->a_karya_ilmiah }}</td>
              <td style="">{{ $item->a_bahasa_asing }}</td>
              <td style="">{{ $item->a_ipk }}</td>
              <td style="">{{ $item->a_indeks_sks }}</td>
              <td style="">{{ $item->nilai_preferensi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <br>
</body>
</html>