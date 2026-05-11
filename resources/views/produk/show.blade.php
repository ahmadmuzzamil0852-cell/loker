{{-- resources/views/produk/show.blade.php --}}

@extends('layouts.main')

@section('title', $produk ? $produk['nama'] . ' – Gudang Kerinci' : 'Produk Tidak Ditemukan')

@section('content')

{{-- TOMBOL KEMBALI --}}
<a href="{{ route('produk.index') }}"
   class="btn btn-outline-secondary mb-4">

    <i class="bi bi-arrow-left me-1"></i>

    Kembali ke Katalog

</a>

{{-- ALERT --}}
@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

@endif

@if($produk)

<div class="card border-0 shadow-sm"
     style="border-radius:14px; overflow:hidden;">

    {{-- HEADER --}}
    <div class="card-header py-4 text-white"
         style="background: linear-gradient(135deg, #1b4332, #2d6a2d);">

        <div class="d-flex align-items-center gap-3">

            <div style="font-size:3rem; line-height:1;">

                @if($produk['kategori'] == 'Minuman')

                    <i class="bi bi-cup-hot-fill"></i>

                @elseif($produk['kategori'] == 'Rempah')

                    <i class="bi bi-flower1"></i>

                @elseif($produk['kategori'] == 'Kesehatan')

                    <i class="bi bi-heart-pulse-fill"></i>

                @else

                    <i class="bi bi-basket2-fill"></i>

                @endif

            </div>

            <div>

                <span class="badge-kategori mb-1 d-inline-block">

                    {{ $produk['kategori'] }}

                </span>

                <h3 class="fw-bold mb-0">

                    {{ $produk['nama'] }}

                </h3>

            </div>

        </div>

    </div>

    <div class="card-body p-4">

        <div class="row g-4">

            {{-- KIRI --}}
            <div class="col-md-7">

                <h5 class="fw-semibold text-success mb-3">

                    <i class="bi bi-info-circle me-1"></i>

                    Deskripsi Produk

                </h5>

                <p class="text-muted"
                   style="font-size:1.05rem; line-height:1.7;">

                    {{ $produk['deskripsi'] }}

                </p>

                <hr>

                <table class="table table-borderless table-sm">

                    <tbody>

                        <tr>

                            <td width="40%" class="text-muted">

                                ID Produk

                            </td>

                            <td>

                                <b>#{{ $produk['id'] }}</b>

                            </td>

                        </tr>

                        <tr>

                            <td class="text-muted">

                                Kategori

                            </td>

                            <td>

                                <span class="badge-kategori">

                                    {{ $produk['kategori'] }}

                                </span>

                            </td>

                        </tr>

                        <tr>

                            <td class="text-muted">

                                Berat

                            </td>

                            <td>

                                {{ $produk['berat'] }}

                            </td>

                        </tr>

                        <tr>

                            <td class="text-muted">

                                Stok

                            </td>

                            <td>

                                <span class="badge bg-success">

                                    {{ $produk['stok'] }}

                                </span>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            {{-- KANAN --}}
            <div class="col-md-5">

                <div class="card border-0 p-4 h-100"
                     style="background:#f0faf0; border-radius:12px;">

                    <p class="text-muted mb-1">

                        Harga

                    </p>

                    <h2 class="fw-bold text-success mb-3">

                        Rp {{ number_format($produk['harga'],0,',','.') }}

                    </h2>

                    <hr>

                    {{-- KHUSUS USER --}}
                    @if(session('role') == 'user')

                        {{-- ========================= --}}
                        {{-- STATUS NEGO --}}
                        {{-- ========================= --}}
                        @php

                            $negoUser = null;

                            $semuaNego = session('nego', []);

                            foreach($semuaNego as $n) {

                                if(
                                    $n['produk_id'] == $produk['id']
                                    &&
                                    $n['user'] == session('email')
                                ) {

                                    $negoUser = $n;
                                }
                            }

                        @endphp

                        @if($negoUser)

                            <div class="alert

                                @if($negoUser['status'] == 'Disetujui')

                                    alert-success

                                @elseif($negoUser['status'] == 'Ditolak')

                                    alert-danger

                                @else

                                    alert-warning

                                @endif

                            ">

                                <b>Status Nego :</b>

                                {{ $negoUser['status'] }}

                            </div>

                        @endif

                        {{-- ========================= --}}
                        {{-- FORM BELI --}}
                        {{-- ========================= --}}
                        <form action="/beli"
                              method="POST"
                              class="mt-3">

                            @csrf

                            <input type="hidden"
                                   name="produk_id"
                                   value="{{ $produk['id'] }}">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">

                                    Jumlah Beli

                                </label>

                                <input type="number"
                                       name="jumlah"
                                       class="form-control"
                                       min="1"
                                       value="1"
                                       required>

                            </div>

                            <button type="submit"
                                    class="btn btn-success w-100 mb-3">

                                <i class="bi bi-cart-fill me-1"></i>

                                Beli Sekarang

                            </button>

                        </form>

                        {{-- ========================= --}}
                        {{-- FORM NEGO --}}
                        {{-- ========================= --}}
                        <form action="/nego/respon"
                              method="POST">

                            @csrf

                            <input type="hidden"
                                   name="produk_id"
                                   value="{{ $produk['id'] }}">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">

                                    Ajukan Harga Nego

                                </label>

                                <input type="number"
                                       name="harga"
                                       class="form-control"
                                       placeholder="Contoh: 50000"
                                       required>

                            </div>

                            <button type="submit"
                                    class="btn btn-outline-success w-100">

                                <i class="bi bi-cash-coin me-1"></i>

                                Ajukan Nego Harga

                            </button>

                        </form>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@else

<div class="alert alert-danger">

    Produk tidak ditemukan.

</div>

@endif

@endsection