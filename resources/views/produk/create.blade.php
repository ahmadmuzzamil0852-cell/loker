@extends('layouts.main')

@section('content')

<form action="/tambah" method="POST" enctype="multipart/form-data">
@csrf

<input type="text" name="nama" placeholder="Nama" class="form-control mb-2">
<input type="number" name="harga" placeholder="Harga" class="form-control mb-2">
<input type="text" name="kategori" placeholder="Kategori" class="form-control mb-2">
<textarea name="deskripsi" class="form-control mb-2"></textarea>
<input type="file" name="gambar" class="form-control mb-2">

<button class="btn btn-success">Tambah</button>

</form>

@endsection