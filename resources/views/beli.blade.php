<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Beli Barang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f5f5f5;">

<div class="container mt-5">

<div class="col-md-6 mx-auto">

<div class="card shadow p-4">

<h3 class="mb-4">Pesan Barang</h3>

<p><b>Barang:</b> {{ $barang->nama_barang }}</p>
<p><b>Harga:</b> Rp {{ number_format($barang->harga) }}</p>

<form action="/pesan" method="POST">
@csrf

<input type="hidden" name="id_barang" value="{{ $barang->id }}">

<input type="text" name="nama_pelanggan" class="form-control mb-3" placeholder="Nama">

<input type="text" name="alamat" class="form-control mb-3" placeholder="Kelas / Alamat">

<input type="text" name="no_hp" class="form-control mb-3" placeholder="No HP">

<button class="btn btn-success w-100">
Pesan Sekarang
</button>

</form>

</div>

</div>

</div>

</body>
</html>
