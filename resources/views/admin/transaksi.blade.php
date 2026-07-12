@extends('layouts.main')

@section('title', 'Admin Transaksi')

@section('content')

@if(session('role') != 'admin')

    <div class="alert alert-danger mt-4">
        Halaman ini hanya untuk admin.
    </div>

@else

<div class="container mt-4">

    <h2 class="fw-bold text-success mb-4">
        Data Pembayaran User
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

    {{-- DATA TRANSAKSI --}}
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

                        <p class="mb-3">

                            Status :

                            @if($item->status == 'Pembayaran Disetujui')

                                <span class="badge bg-success">
                                    {{ $item->status }}
                                </span>

                            @elseif($item->status == 'Menunggu Verifikasi Admin')

                                <span class="badge bg-primary">
                                    {{ $item->status }}
                                </span>

                            @elseif($item->status == 'Menunggu Pembayaran')

                                <span class="badge bg-warning text-dark">
                                    {{ $item->status }}
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ $item->status }}
                                </span>

                            @endif

                        </p>

                        {{-- CEK BUKTI --}}
                        @if($item->bukti)

                            <div class="alert alert-info mb-0">

                                Bukti pembayaran sudah dikirim:

                                <b>
                                    {{ $item->bukti }}
                                </b>

                            </div>

                        @endif

                    </div>

                    {{-- AKSI ADMIN --}}
                    <div class="col-md-4 text-end">

                        {{-- VERIFIKASI PEMBAYARAN --}}
                        @if(
                            $item->bukti
                            && $item->status == 'Menunggu Verifikasi Admin'
                        )

                            <form action="{{ route('nego.verifikasi') }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="index"
                                       value="{{ $item->id }}">

                                <button type="submit"
                                        class="btn btn-success">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Verifikasi Pembayaran

                                </button>

                            </form>

                        @endif

                        {{-- PEMBAYARAN SELESAI --}}
                        @if($item->status == 'Pembayaran Disetujui')

                            <div class="d-flex justify-content-end
                                        align-items-center gap-2">

                                <span class="badge bg-success">
                                    Pembayaran Selesai
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
            Belum ada transaksi user.
        </div>

    @endforelse

</div>

@endif

@endsection