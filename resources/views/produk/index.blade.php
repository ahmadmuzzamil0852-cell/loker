@extends('layouts.main')

@section('title', 'Katalog Produk – Gudang Kerinci')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #2d6a2d, #1b4332);
        color: #fff;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 30px;
    }

    .product-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 3px 14px rgba(0,0,0,.08);
        transition: transform .2s, box-shadow .2s;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,.15);
    }

    .product-card .card-header {
        background: linear-gradient(135deg, #2d6a2d, #4caf50);
        color: #fff;
        border-radius: 12px 12px 0 0 !important;
        padding: 20px;
        font-size: 1.4rem;
        text-align: center;
    }

    .harga-text {
        color: #2d6a2d;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .product-icon {
        font-size: 2.5rem;
        display: block;
        margin-bottom: 4px;
    }
</style>
@endsection

@section('content')

{{-- ══════════════ PAGE HEADER ══════════════ --}}
<div class="page-header">
    <h2 class="fw-bold mb-1"><i class="bi bi-grid-fill me-2"></i>Katalog Produk</h2>
    <p class="mb-0 opacity-75">Temukan hasil bumi pilihan langsung dari Kerinci</p>
</div>

{{-- ══════════════ GRID PRODUK ══════════════ --}}
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

    @foreach($produk as $item)
    <div class="col">
        <div class="card product-card">

            {{-- Icon header berdasarkan kategori --}}
            <div class="card-header">
                @if($item['kategori'] == 'Minuman')
                    <i class="bi bi-cup-hot-fill product-icon"></i>
                @elseif($item['kategori'] == 'Rempah')
                    <i class="bi bi-flower1 product-icon"></i>
                @elseif($item['kategori'] == 'Kesehatan')
                    <i class="bi bi-heart-pulse-fill product-icon"></i>
                @else
                    <i class="bi bi-basket2-fill product-icon"></i>
                @endif
            </div>

            <div class="card-body d-flex flex-column">
                {{-- Kategori badge --}}
                <span class="badge-kategori mb-2 d-inline-block">{{ $item['kategori'] }}</span>

                <h5 class="card-title fw-semibold">{{ $item['nama'] }}</h5>
                <p class="card-text text-muted small flex-grow-1">{{ $item['deskripsi'] }}</p>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="harga-text">Rp {{ number_format($item['harga'], 0, ',', '.') }}</span>
                    <span class="text-muted small"><i class="bi bi-box-seam me-1"></i>{{ $item['berat'] }}</span>
                </div>

                {{-- Tombol Detail --}}
                <a href="{{ route('produk.show', $item['id']) }}"
                   class="btn btn-kerinci mt-3 w-100">
                    <i class="bi bi-eye me-1"></i> Lihat Detail
                </a>
            </div>

        </div>
    </div>
    @endforeach

</div>

@endsection