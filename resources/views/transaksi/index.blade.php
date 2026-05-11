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

    {{-- DATA TRANSAKSI --}}
    @forelse($data as $index => $item)

        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <div class="row align-items-center">

                    {{-- DATA --}}
                    <div class="col-md-8">

                        <h5 class="fw-bold text-success">

                            {{ $item['user'] }}

                        </h5>

                        <p class="mb-1">

                            Produk ID :
                            <b>{{ $item['produk_id'] }}</b>

                        </p>

                        <p class="mb-1">

                            Jumlah :
                            <b>{{ $item['jumlah'] }}</b>

                        </p>

                        {{-- STATUS --}}
                        <p class="mb-0">

                            Status :

                            @if($item['status'] == 'Pembayaran Disetujui')

                                <span class="badge bg-success">

                                    {{ $item['status'] }}

                                </span>

                            @elseif($item['status'] == 'Menunggu Pembayaran')

                                <span class="badge bg-warning text-dark">

                                    {{ $item['status'] }}

                                </span>

                            @elseif($item['status'] == 'Menunggu Verifikasi Admin')

                                <span class="badge bg-primary">

                                    {{ $item['status'] }}

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    {{ $item['status'] }}

                                </span>

                            @endif

                        </p>

                    </div>

                    {{-- AKSI --}}
                    <div class="col-md-4 text-end">

                        {{-- UPLOAD BUKTI --}}
                        @if($item['status'] == 'Menunggu Pembayaran')

                            <form action="{{ route('upload.bukti') }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="index"
                                       value="{{ $index }}">

                                <button type="submit"
                                        class="btn btn-success">

                                    Upload Bukti Bayar

                                </button>

                            </form>

                        @endif

                        {{-- MENUNGGU VERIFIKASI --}}
                        @if($item['status'] == 'Menunggu Verifikasi Admin')

                            <span class="badge bg-info">

                                Bukti Sudah Dikirim

                            </span>

                        @endif

                        {{-- SELESAI --}}
                        @if($item['status'] == 'Pembayaran Disetujui')

                            <span class="badge bg-success">

                                Transaksi Selesai

                            </span>

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