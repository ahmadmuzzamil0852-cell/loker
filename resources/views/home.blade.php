@extends('layouts.main')

@section('title', 'Home – Gudang Kerinci')

@section('styles')
<style>
    /* ── Hero / Banner ── */
    .hero-section {
        background: linear-gradient(135deg, #1b4332 0%, #2d6a2d 60%, #4caf50 100%);
        color: #fff;
        border-radius: 16px;
        padding: 70px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
    }

    .hero-section h1 { font-size: 2.8rem; font-weight: 700; }
    .hero-section p  { font-size: 1.2rem; opacity: .9; }

    .hero-badge {
        display: inline-block;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.3);
        border-radius: 50px;
        padding: 6px 20px;
        font-size: .9rem;
        margin-bottom: 16px;
    }

    /* ── Visi Misi ── */
    .vm-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,.08);
        transition: transform .2s;
    }
    .vm-card:hover { transform: translateY(-4px); }
    .vm-icon {
        width: 52px; height: 52px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 12px;
    }

    /* ── Stats bar ── */
    .stats-bar {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
    }
    .stat-item { text-align: center; padding: 20px; }
    .stat-item h3 { color: #2d6a2d; font-weight: 700; font-size: 1.8rem; }
    .stat-item p  { color: #666; font-size: .9rem; margin: 0; }
</style>
@endsection

@section('content')

{{-- ══════════════ HERO / BANNER ══════════════ --}}
<div class="hero-section mb-5">
    <div class="hero-badge">
        <i class="bi bi-star-fill me-1 text-warning"></i> Produk Unggulan Kerinci
    </div>
    <h1><i class="bi bi-tree-fill me-2"></i>{{ $namaGudang }}</h1>
    <p class="mb-4">{{ $tagline }}</p>
    <a href="{{ route('produk.index') }}" class="btn btn-light btn-lg px-4 fw-semibold">
        <i class="bi bi-grid me-2"></i>Lihat Katalog Produk
    </a>
</div>

{{-- ══════════════ STATS BAR ══════════════ --}}
<div class="stats-bar d-flex flex-wrap justify-content-around mb-5">
    <div class="stat-item">
        <h3>6+</h3>
        <p><i class="bi bi-box-seam me-1"></i>Produk</p>
    </div>
    <div class="stat-item">
        <h3>4</h3>
        <p><i class="bi bi-tags me-1"></i>Kategori</p>
    </div>
    <div class="stat-item">
        <h3>100%</h3>
        <p><i class="bi bi-shield-check me-1"></i>Asli Kerinci</p>
    </div>
    <div class="stat-item">
        <h3>⭐ 5.0</h3>
        <p><i class="bi bi-star me-1"></i>Rating</p>
    </div>
</div>

{{-- ══════════════ VISI & MISI ══════════════ --}}
<div class="row g-4 mb-5">
    {{-- VISI --}}
    <div class="col-md-5">
        <div class="card vm-card h-100 p-4">
            <div class="vm-icon bg-success bg-opacity-10">
                <i class="bi bi-eye-fill text-success"></i>
            </div>
            <h4 class="fw-bold text-success">Visi Kami</h4>
            <p class="text-muted mb-0">{{ $visi }}</p>
        </div>
    </div>

    {{-- MISI --}}
    <div class="col-md-7">
        <div class="card vm-card h-100 p-4">
            <div class="vm-icon bg-warning bg-opacity-10">
                <i class="bi bi-flag-fill text-warning"></i>
            </div>
            <h4 class="fw-bold" style="color:#795548">Misi Kami</h4>
            <ul class="list-unstyled mb-0">
                @foreach($misi as $poin)
                <li class="d-flex align-items-start mb-2">
                    <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                    <span class="text-muted">{{ $poin }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

{{-- ══════════════ CTA ══════════════ --}}
<div class="text-center py-4">
    <h5 class="text-muted mb-3">Siap menemukan produk terbaik dari Kerinci?</h5>
    <a href="{{ route('produk.index') }}" class="btn btn-kerinci btn-lg px-5">
        <i class="bi bi-shop me-2"></i>Jelajahi Katalog Sekarang
    </a>
</div>

@endsection
