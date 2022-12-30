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
  border: 1px solid #ddd;
  padding: 8px;
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
</style>
</head>
<body>

<h3>Hasil rekomendasi pencarian mahasiswa berprestasi</h3>

<table id="customers">
  <tr>
    <th>Nama Lengkap</th>
    <th>Prestasi</th>
    <th>Karya Ilmiah</th>
    <th>Bahasa Asing</th>
    <th>Ipk</th>
    <th>Indeks sks</th>
    {{-- <th>Nilai Preferensi</th> --}}
  </tr>
  @foreach ($data as $item)     
  <tr>
    <td>{{ $item->nama }}</td>
    <td style="text-align: right">{{ $item->prestasi }}</td>
    <td style="text-align: right">{{ $item->karya_ilmiah }}</td>
    <td style="text-align: right">{{ $item->bahasa_asing }}</td>
    <td style="text-align: right">{{ $item->ipk }}</td>
    <td style="text-align: right">{{ $item->indeks_sks }}</td>
    {{-- <td style="text-align: right">{{ $item->nilai_preferensi }}</td> --}}
  </tr>
  @endforeach
</table>
</body>
</html>


