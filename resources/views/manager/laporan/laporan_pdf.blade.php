<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan PDF</title>
	<style>
		#table {
		  font-family: Arial, Helvetica, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		}
		
		#table td, #table th {
		  border: 1px solid #ddd;
		  padding: 8px;
		}
		
		#table tr:nth-child(even){background-color: #f2f2f2;}
		
		#table tr:hover {background-color: #ddd;}
		
		#table th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: #04AA6D;
		  color: white;
		}
		</style>
</head>
<body>
    <h4>Pencetak : {{ $employe }}</h4>
    <table id="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pelanggan</th>
				<th>Nama Menu</th>
				<th>Jumlah</th>
				<th>Total Harga</th>
				<th>Nama Pegawai</th>
				<th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@forelse($laporan as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{ $p->nama_pelanggan }}</td>
				<td>{{ $p->nama_menu }}</td>
				<td>{{ $p->jumlah }}</td>
				<td>Rp {{ number_format($p->total_harga,0,',','.') }}</td>
				<td>{{ $p->nama_pegawai }}</td>
                <td>{{ $p->created_at->format('d-m-Y') }}</td>
			</tr>
			@empty
				<tr>
					<td colspan="7" style="text-align: center">Tidak ada data</td>
				</tr>
			@endforelse
		</tbody>
	</table>
</body>
</html>