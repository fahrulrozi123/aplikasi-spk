<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Perhitungan metode topsis</title>
</head>

<style>
  table {
    margin: auto;
    font-family: "Arial";
    font-size: 12px;
  }
  .table {
      border-collapse: collapse;
      font-size: 13px;
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

<body>
  <div class="table-container">
    <table class="table">
        <h3 class="text-center">Tabel Responsive 1</h3>
        <caption>Tabel responsive dengan container</caption>
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
              <td style="text-align: right">{{ $item->v_prestasi }}</td>
              <td style="text-align: right">{{ $item->v_karya_ilmiah }}</td>
              <td style="text-align: right">{{ $item->v_bahasa_asing }}</td>
              <td style="text-align: right">{{ $item->v_ipk }}</td>
              <td style="text-align: right">{{ $item->indeks_sks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>