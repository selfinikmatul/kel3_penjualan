<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f5f5f5;">

<div class="container mt-5">

<h2 class="mb-4">Edit Produk</h2>

<form action="/produk/update/{{ $barang->id }}" method="POST">
@csrf

<input type="text" name="nama_barang" class="form-control mb-3"
value="{{ $barang->nama_barang }}">

<input type="text" name="kategori" class="form-control mb-3"
value="{{ $barang->kategori }}">

<input type="number" name="harga" class="form-control mb-3"
value="{{ $barang->harga }}">

<input type="number" name="stok" class="form-control mb-3"
value="{{ $barang->stok }}">

<button type="submit" class="btn btn-success">Update</button>

<a href="/produk" class="btn btn-secondary">Kembali</a>

</form>

</div>

</body>
</html>
