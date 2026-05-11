@extends('layouts.main')

@section('content')

<div class="container mt-5">

<h2>Laporan Penjualan</h2>

@foreach($penjualan as $p)
<div class="card p-3 mb-2">
    @foreach($p as $item)
        <p>{{ $item['nama'] }} - Rp {{ number_format($item['harga']) }}</p>
    @endforeach
</div>
@endforeach

</div>

@endsection