<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f5f5f5;">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-4">

<div class="card shadow p-4">

<h3 class="text-center mb-4">Login Admin</h3>

@if(session('error'))
<div class="alert alert-danger">
{{ session('error') }}
</div>
@endif

<form action="/login-proses" method="POST">
@csrf

<input type="email" name="email" class="form-control mb-3" placeholder="Email">

<input type="password" name="password" class="form-control mb-3" placeholder="Password">

<button class="btn btn-primary w-100">
Login
</button>

</form>

</div>

</div>

</div>

</div>

</body>
</html>
