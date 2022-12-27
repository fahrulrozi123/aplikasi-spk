<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid black;
  padding: 2px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #b68440;
  color: white;
}
table{
  margin: 20px auto;
  border-collapse: collapse;
}
table th,
table td{
  border: 5px solid #3c3c3c;
  padding: 3px 8px;

}
a{
  background: #b68440;
  color: #fff;
  padding: 8px 10px;
  text-decoration: none;
  border-radius: 2px;
}
</style>
</head>
<body>

  <h1 style="text-align: center;">Hasil rekomendasi pencarian mahasiswa berprestasi</h1>
  <br>
  <table id="customers" border="1">
    <tr>
      <th><b>Nama Lengkap</b></th>
      <th><b>Prestasi</b></th>
      <th><b>Karya Ilmiah</b></th>
      <th><b>Bahasa Asing</b></th>
      <th><b>Ipk</b></th>
      <th><b>Indeks sks</b></th>
      <th><b>Nilai Preferensi</b></th>
    </tr>
    @foreach ($data as $item)     
    <tr>
      <td>{{ $item->nama }}</td>
      <td style="text-align: right">{{ $item->prestasi }}</td>
      <td style="text-align: right">{{ $item->karya_ilmiah }}</td>
      <td style="text-align: right">{{ $item->bahasa_asing }}</td>
      <td style="text-align: right">{{ $item->ipk }}</td>
      <td style="text-align: right">{{ $item->indeks_sks }}</td>
      <td style="text-align: right">{{ $item->nilai_preferensi }}</td>
    </tr>
    @endforeach
  </table>

</body>
</html>


