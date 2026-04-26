<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>SPW Store</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="background:#f5f5f5;">

<div class="container mt-5">

<h1 class="text-center mb-4">SPW Store</h1>
<p class="text-center mb-5">Belanja kebutuhan sekolah jadi lebih mudah</p>

<div class="row">

@foreach($barang as $item)

<div class="col-md-4 mb-4">

<div class="card shadow p-3">

<h4>{{ $item->nama_barang }}</h4>

<p>Kategori : {{ $item->kategori }}</p>

<p>Harga : Rp {{ number_format($item->harga) }}</p>

<p>Stok : {{ $item->stok }}</p>

<a href="/beli/{{ $item->id }}" class="btn btn-primary w-100">
Beli
</a>

</div>

</div>

@endforeach

</div>

</div>

</body>
</html>
