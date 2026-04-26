<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard</title>

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

<h2 class="mb-4">Dashboard</h2>

<div class="row">

<div class="col-md-3">
<div class="card p-3 shadow">
<h5>Total Penjualan</h5>
<h3>Rp {{ number_format($total_penjualan) }}</h3>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 shadow">
<h5>Produk</h5>
<h3>{{ $jumlah_barang }}</h3>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 shadow">
<h5>Transaksi</h5>
<h3>{{ $jumlah_transaksi }}</h3>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 shadow">
<h5>Pelanggan</h5>
<h3>{{ $jumlah_pelanggan }}</h3>
</div>
</div>

</div>

</div>

</body>
</html>
