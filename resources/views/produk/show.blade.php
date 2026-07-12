{{-- resources/views/produk/show.blade.php --}}

@extends('layouts.main')

@section('title', $produk->nama . ' – Gudang Kerinci')

@section('content')

{{-- TOMBOL KEMBALI --}}
<a href="{{ route('produk.index') }}"
   class="btn btn-outline-secondary mb-4">

    <i class="bi bi-arrow-left me-1"></i>
    Kembali ke Katalog

</a>

{{-- ALERT SUCCESS --}}
@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

@endif

{{-- ALERT ERROR --}}
@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show">

        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

@endif

{{-- VALIDATION ERROR --}}
@if($errors->any())

    <div class="alert alert-danger">

        <b>Terjadi kesalahan:</b>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<div class="card border-0 shadow-sm"
     style="border-radius:14px; overflow:hidden;">

    {{-- HEADER --}}
    <div class="card-header py-4 text-white"
         style="background: linear-gradient(135deg, #1b4332, #2d6a2d);">

        <div class="d-flex align-items-center gap-3">

            <div style="font-size:3rem; line-height:1;">

                @if($produk->kategori == 'Minuman')

                    <i class="bi bi-cup-hot-fill"></i>

                @elseif($produk->kategori == 'Rempah')

                    <i class="bi bi-flower1"></i>

                @elseif($produk->kategori == 'Kesehatan')

                    <i class="bi bi-heart-pulse-fill"></i>

                @else

                    <i class="bi bi-basket2-fill"></i>

                @endif

            </div>

            <div>

                <span class="badge-kategori mb-1 d-inline-block">

                    {{ $produk->kategori }}

                </span>

                <h3 class="fw-bold mb-0">

                    {{ $produk->nama }}

                </h3>

            </div>

        </div>

    </div>

    <div class="card-body p-4">

        <div class="row g-4">

            {{-- ========================= --}}
            {{-- BAGIAN KIRI --}}
            {{-- ========================= --}}

            <div class="col-md-7">

                <h5 class="fw-semibold text-success mb-3">

                    <i class="bi bi-info-circle me-1"></i>

                    Deskripsi Produk

                </h5>

                <p class="text-muted"
                   style="font-size:1.05rem; line-height:1.7;">

                    {{ $produk->deskripsi }}

                </p>

                <hr>

                <table class="table table-borderless table-sm">

                    <tbody>

                        <tr>

                            <td width="40%" class="text-muted">
                                ID Produk
                            </td>

                            <td>
                                <b>#{{ $produk->id }}</b>
                            </td>

                        </tr>

                        <tr>

                            <td class="text-muted">
                                Kategori
                            </td>

                            <td>

                                <span class="badge-kategori">

                                    {{ $produk->kategori }}

                                </span>

                            </td>

                        </tr>

                        <tr>

                            <td class="text-muted">
                                Berat
                            </td>

                            <td>

                                {{ $produk->berat }}

                            </td>

                        </tr>

                        <tr>

                            <td class="text-muted">
                                Stok
                            </td>

                            <td>

                                @if($produk->stok > 0)

                                    <span class="badge bg-success">

                                        Tersedia

                                    </span>

                                    <span class="ms-2 fw-semibold">

                                        {{ $produk->stok }} stok

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Habis

                                    </span>

                                    <span class="ms-2 text-muted">

                                        0 stok

                                    </span>

                                @endif

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            {{-- ========================= --}}
            {{-- BAGIAN KANAN --}}
            {{-- ========================= --}}

            <div class="col-md-5">

                <div class="card border-0 p-4 h-100"
                     style="background:#f0faf0; border-radius:12px;">

                    <p class="text-muted mb-1">

                        Harga Satuan

                    </p>

                    <h2 class="fw-bold text-success mb-3">

                        Rp {{ number_format(
                            $produk->harga,
                            0,
                            ',',
                            '.'
                        ) }}

                    </h2>

                    <div class="mb-3">

                        @if($produk->stok > 0)

                            <span class="badge bg-success">

                                <i class="bi bi-check-circle me-1"></i>

                                Stok Tersedia: {{ $produk->stok }}

                            </span>

                        @else

                            <span class="badge bg-danger">

                                <i class="bi bi-x-circle me-1"></i>

                                Stok Habis

                            </span>

                        @endif

                    </div>

                    <hr>

                    {{-- ========================= --}}
                    {{-- KHUSUS USER --}}
                    {{-- ========================= --}}

                    @if(session('role') == 'user')

                        @if($produk->stok > 0)

                            {{-- ========================= --}}
                            {{-- FORM BELI --}}
                            {{-- ========================= --}}

                            <form action="{{ route('beli') }}"
                                  method="POST"
                                  class="mb-4">

                                @csrf

                                <input type="hidden"
                                       name="produk_id"
                                       value="{{ $produk->id }}">

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        Jumlah Beli

                                    </label>

                                    <input type="number"
                                           name="jumlah"
                                           class="form-control"
                                           min="1"
                                           max="{{ $produk->stok }}"
                                           value="{{ old('jumlah', 1) }}"
                                           required>

                                    <small class="text-muted">

                                        Maksimal pembelian {{ $produk->stok }} produk.

                                    </small>

                                </div>

                                <button type="submit"
                                        class="btn btn-success w-100">

                                    <i class="bi bi-cart-fill me-1"></i>

                                    Beli Sekarang

                                </button>

                            </form>

                            <hr>

                            {{-- ========================= --}}
                            {{-- FORM NEGO --}}
                            {{-- ========================= --}}

                            <h6 class="fw-bold text-success mb-3">

                                <i class="bi bi-cash-coin me-1"></i>

                                Nego Harga

                            </h6>

                            <form action="{{ route('nego.respon') }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="produk_id"
                                       value="{{ $produk->id }}">

                                {{-- JUMLAH NEGO --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        Jumlah Produk

                                    </label>

                                    <input type="number"
                                           name="jumlah"
                                           class="form-control"
                                           min="1"
                                           max="{{ $produk->stok }}"
                                           value="{{ old('jumlah', 1) }}"
                                           required>

                                    <small class="text-muted">

                                        Maksimal nego {{ $produk->stok }} produk.

                                    </small>

                                </div>

                                {{-- HARGA NEGO --}}
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        Total Harga Nego

                                    </label>

                                    <input type="number"
                                           name="harga"
                                           class="form-control"
                                           min="1"
                                           value="{{ old('harga') }}"
                                           placeholder="Contoh: 1000000"
                                           required>

                                    <small class="text-muted">

                                        Masukkan total harga yang Anda tawarkan.

                                    </small>

                                </div>

                                <button type="submit"
                                        class="btn btn-outline-success w-100">

                                    <i class="bi bi-send me-1"></i>

                                    Ajukan Nego Harga

                                </button>

                            </form>

                        @else

                            <div class="alert alert-danger mb-0">

                                <i class="bi bi-exclamation-circle me-1"></i>

                                Produk sedang habis dan tidak dapat dibeli
                                atau dinego.

                            </div>

                        @endif

                    @else

                        <div class="alert alert-warning mb-0">

                            <i class="bi bi-info-circle me-1"></i>

                            Silakan login sebagai user untuk membeli
                            atau melakukan nego produk.

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection