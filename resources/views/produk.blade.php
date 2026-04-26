<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Kelola Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
margin:0;
background:#f5f5f5;
}

.sidebar{
width:250px;
height:100vh;
background:#212529;
position:fixed;
padding:20px;
color:white;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
padding:12px;
margin-bottom:10px;
border-radius:8px;
}

.sidebar a:hover{
background:#0d6efd;
}

.content{
margin-left:270px;
padding:30px;
}
</style>

</head>
<body>

<div class="sidebar">

<h3 class="mb-4">SPW Admin</h3>

<a href="/dashboard">Dashboard</a>
<a href="/produk">Kelola Produk</a>
<a href="/pesanan">Kelola Pesanan</a>
<a href="/">Logout</a>

</div>

<div class="content">

<h2 class="mb-4">Kelola Produk</h2>

<a href="/produk/tambah" class="btn btn-primary mb-3">
+ Tambah Produk
</a>

<table class="table table-bordered bg-white shadow">

<thead class="table-dark">
<tr>
<th>No</th>
<th>Nama Barang</th>
<th>Kategori</th>
<th>Harga</th>
<th>Stok</th>
<th width="180">Aksi</th>
</tr>
</thead>

<tbody>

@foreach($barang as $item)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $item->nama_barang }}</td>
<td>{{ $item->kategori }}</td>
<td>Rp {{ number_format($item->harga) }}</td>
<td>{{ $item->stok }}</td>
<td class="text-nowrap">

<a href="/produk/edit/{{ $item->id }}" class="btn btn-warning btn-sm">
Edit
</a>

<a href="/produk/hapus/{{ $item->id }}" class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus data?')">
Hapus
</a>

</td>
</tr>
@endforeach

</tbody>

</table>

</div>

</body>
</html>
