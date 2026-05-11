@extends('layouts.main')

@section('content')

<div class="container mt-5">
<h2>Keranjang Belanja</h2>

@foreach(session('cart',[]) as $item)
<div class="card p-3 mb-2">
    {{ $item['nama'] }} - Rp {{ number_format($item['harga']) }}
</div>
@endforeach

<a href="/checkout" class="btn btn-success mt-3">Bayar Sekarang</a>
</div>

@endsection