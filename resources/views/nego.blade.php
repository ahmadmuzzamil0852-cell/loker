@extends('layouts.main')

@section('content')

<div class="container mt-5">

<h2>Manajemen Nego</h2>

@foreach($data as $n)
<div class="card p-3 mb-3">

<p><b>Produk:</b> {{ $n['produk'] }}</p>
<p>Harga Awal: Rp {{ number_format($n['harga_awal']) }}</p>

<p>Tawaran Pembeli: Rp {{ number_format($n['tawaran_user']) }}</p>

@if($n['tawaran_admin'])
<p>Tawaran Admin: Rp {{ number_format($n['tawaran_admin']) }}</p>
@endif

<p>Status: <b>{{ $n['status'] }}</b></p>

<form method="POST" action="/admin/nego/update/{{ $n['id'] }}">
@csrf

<input type="number" name="harga_admin" class="form-control mb-2" placeholder="Harga counter">

<button name="aksi" value="accept" class="btn btn-success">Terima</button>
<button name="aksi" value="reject" class="btn btn-danger">Tolak</button>
<button name="aksi" value="counter" class="btn btn-warning">Counter</button>

</form>

</div>
@endforeach

</div>

@endsection