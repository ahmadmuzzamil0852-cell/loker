@extends('layouts.main')

@section('title', 'Transaksi Saya')

@section('content')

@if(session('role') != 'user')

    <div class="alert alert-danger mt-4">
        Halaman ini hanya untuk user.
    </div>

@else

<div class="container mt-4">

    <h2 class="fw-bold text-success mb-4">
        Transaksi Saya
    </h2>

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


    {{-- ========================= --}}
    {{-- STATUS NEGO USER --}}
    {{-- ========================= --}}

    @if(isset($nego) && $nego->count() > 0)

        <h4 class="fw-bold mb-3">
            Status Pengajuan Nego
        </h4>

        @foreach($nego as $itemNego)

            {{-- NEGO DISETUJUI --}}
            @if($itemNego->status == 'Disetujui')

                <div class="alert alert-success shadow-sm">

                    <div class="row align-items-center">

                        <div class="col-md-8">

                            <h5 class="fw-bold mb-2">

                                <i class="bi bi-check-circle me-1"></i>

                                Nego Disetujui

                            </h5>

                            <p class="mb-1">

                                Produk :

                                <b>
                                    {{ $itemNego->produk->nama ?? 'Produk Tidak Ditemukan' }}
                                </b>

                            </p>

                            <p class="mb-1">

                                Harga Asli :

                                <b>

                                    Rp{{ number_format(
                                        $itemNego->produk->harga ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </b>

                            </p>

                            <p class="mb-0">

                                Harga Nego :

                                <b class="text-success">

                                    Rp{{ number_format(
                                        $itemNego->harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </b>

                            </p>

                        </div>

                        <div class="col-md-4 text-end">

                            <a href="{{ route(
                                    'nego.beli',
                                    $itemNego->id
                                ) }}"
                               class="btn btn-success">

                                <i class="bi bi-cart-check me-1"></i>

                                Beli Harga Nego

                            </a>

                        </div>

                    </div>

                </div>

            {{-- NEGO DITOLAK --}}
            @elseif($itemNego->status == 'Ditolak')

                <div class="alert alert-danger shadow-sm">

                    <h5 class="fw-bold mb-2">

                        <i class="bi bi-x-circle me-1"></i>

                        Nego Ditolak

                    </h5>

                    <p class="mb-1">

                        Produk :

                        <b>
                            {{ $itemNego->produk->nama ?? 'Produk Tidak Ditemukan' }}
                        </b>

                    </p>

                    <p class="mb-0">

                        Harga nego sebesar

                        <b>

                            Rp{{ number_format(
                                $itemNego->harga,
                                0,
                                ',',
                                '.'
                            ) }}

                        </b>

                        ditolak oleh admin.

                    </p>

                </div>

            {{-- MENUNGGU PERSETUJUAN --}}
            @else

                <div class="alert alert-warning shadow-sm">

                    <h5 class="fw-bold mb-2">

                        <i class="bi bi-clock me-1"></i>

                        Nego Menunggu Persetujuan

                    </h5>

                    <p class="mb-1">

                        Produk :

                        <b>
                            {{ $itemNego->produk->nama ?? 'Produk Tidak Ditemukan' }}
                        </b>

                    </p>

                    <p class="mb-0">

                        Harga yang diajukan :

                        <b>

                            Rp{{ number_format(
                                $itemNego->harga,
                                0,
                                ',',
                                '.'
                            ) }}

                        </b>

                    </p>

                </div>

            @endif

        @endforeach

        <hr class="my-4">

    @endif


    {{-- ========================= --}}
    {{-- RIWAYAT TRANSAKSI --}}
    {{-- ========================= --}}

    <h4 class="fw-bold mb-3">
        Riwayat Transaksi
    </h4>

    @forelse($data as $item)

        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <div class="row align-items-center">

                    {{-- DATA TRANSAKSI --}}
                    <div class="col-md-8">

                        <h5 class="fw-bold text-success">
                            {{ $item->user }}
                        </h5>

                        <p class="mb-1">

                            ID Transaksi :

                            <b>
                                #{{ $item->id }}
                            </b>

                        </p>

                        <p class="mb-1">

                            Nama Produk :

                            <b>
                                {{ $item->nama_produk }}
                            </b>

                        </p>

                        <p class="mb-1">

                            Produk ID :

                            <b>
                                #{{ $item->produk_id }}
                            </b>

                        </p>

                        <p class="mb-1">

                            Harga Satuan :

                            <b>

                                Rp{{ number_format(
                                    $item->harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </b>

                        </p>

                        <p class="mb-1">

                            Jumlah :

                            <b>
                                {{ $item->jumlah }}
                            </b>

                        </p>

                        <p class="mb-2">

                            Total Harga :

                            <b class="text-success">

                                Rp{{ number_format(
                                    $item->total_harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </b>

                        </p>

                        {{-- STATUS --}}
                        <p class="mb-0">

                            Status :

                            @if($item->status == 'Pembayaran Disetujui')

                                <span class="badge bg-success">
                                    {{ $item->status }}
                                </span>

                            @elseif($item->status == 'Menunggu Pembayaran')

                                <span class="badge bg-warning text-dark">
                                    {{ $item->status }}
                                </span>

                            @elseif($item->status == 'Menunggu Verifikasi Admin')

                                <span class="badge bg-primary">
                                    {{ $item->status }}
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ $item->status }}
                                </span>

                            @endif

                        </p>

                    </div>

                    {{-- AKSI USER --}}
                    <div class="col-md-4 text-end">

                        {{-- BAYAR QRIS --}}
                        @if($item->status == 'Menunggu Pembayaran')

                            <a href="{{ route(
                                    'transaksi.qris',
                                    $item->id
                                ) }}"
                               class="btn btn-success">

                                <i class="bi bi-qr-code me-1"></i>

                                Bayar QRIS

                            </a>

                        @endif

                        {{-- MENUNGGU VERIFIKASI --}}
                        @if($item->status == 'Menunggu Verifikasi Admin')

                            <span class="badge bg-info text-dark">

                                Pembayaran QRIS Sudah Dikirim

                            </span>

                        @endif

                        {{-- TRANSAKSI SELESAI --}}
                        @if($item->status == 'Pembayaran Disetujui')

                            <div class="d-flex justify-content-end
                                        align-items-center gap-2">

                                <span class="badge bg-success">
                                    Transaksi Selesai
                                </span>

                                <a href="{{ route(
                                        'transaksi.struk',
                                        $item->id
                                    ) }}"
                                   class="btn btn-outline-success btn-sm">

                                    <i class="bi bi-printer me-1"></i>

                                    Cetak Struk

                                </a>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="alert alert-warning">
            Belum ada transaksi.
        </div>

    @endforelse

</div>

@endif

@endsection