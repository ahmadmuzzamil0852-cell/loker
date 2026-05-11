@extends('layouts.main')

@section('title', 'Katalog Produk')

@section('content')

<h2 class="mb-4">Katalog Produk</h2>

<div class="row">

@foreach($produk as $item)
<div class="col-md-4 mb-4">
    <div class="card h-100">

        <div class="card-body d-flex flex-column">
            <span class="badge-kategori mb-2">{{ $item['kategori'] }}</span>

            <h5>{{ $item['nama'] }}</h5>
            <p class="text-muted small">{{ $item['deskripsi'] }}</p>

            <b class="mb-2">
                Rp {{ number_format($item['harga'],0,',','.') }}
            </b>

            <small>{{ $item['berat'] }}</small>

            {{-- DETAIL --}}
            <a href="{{ route('produk.show', $item['id']) }}"
               class="btn btn-kerinci mt-3">
                Detail
            </a>

            {{-- BELI / NEGO --}}
            <form method="POST" action="/beli">
                @csrf
                <input type="hidden" name="id" value="{{ $item['id'] }}">
                <button class="btn btn-success mt-2">
                    Beli / Nego
                </button>
            </form>

        </div>

    </div>
</div>
@endforeach

</div>

@endsection