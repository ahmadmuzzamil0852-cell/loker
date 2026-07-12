@extends('layouts.main')

@section('title', 'Pembayaran QRIS')

@section('content')

@if(session('role') != 'user')

    <div class="alert alert-danger mt-4">
        Halaman ini hanya untuk user.
    </div>

@else

<div class="container mt-5 mb-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card border-0 shadow">

                <div class="card-body text-center p-4">

                    {{-- JUDUL --}}
                    <h3 class="fw-bold text-success mb-2">

                        Pembayaran QRIS

                    </h3>

                    <p class="text-muted">

                        Scan QR Code menggunakan Google Lens

                    </p>

                    <hr>

                    {{-- DATA TRANSAKSI --}}
                    @php

                        $namaProduk = $transaksi['nama_produk']
                            ?? 'Produk';

                        $harga = $transaksi['harga']
                            ?? 0;

                        $jumlah = $transaksi['jumlah']
                            ?? 1;

                        $totalHarga = $transaksi['total_harga']
                            ?? ($harga * $jumlah);

                        $qrData = "QRIS DUMMY - LOKER"
                            . "\nNama Produk: " . $namaProduk
                            . "\nProduk ID: " . $transaksi['produk_id']
                            . "\nHarga Satuan: Rp" . number_format($harga, 0, ',', '.')
                            . "\nJumlah Pembelian: " . $jumlah
                            . "\nTotal Bayar: Rp" . number_format($totalHarga, 0, ',', '.')
                            . "\nStatus: Menunggu Pembayaran";

                    @endphp

                    {{-- QR CODE --}}
                    <div class="my-4">

                        {!! QrCode::format('svg')
                            ->size(300)
                            ->margin(2)
                            ->errorCorrection('H')
                            ->generate($qrData) !!}

                    </div>

                    {{-- NAMA PRODUK --}}
                    <div class="bg-light rounded p-3 mb-3 text-start">

                        <small class="text-muted">

                            Nama Produk

                        </small>

                        <h5 class="fw-bold text-success mb-0">

                            {{ $namaProduk }}

                        </h5>

                    </div>

                    {{-- INFORMASI TRANSAKSI --}}
                    <div class="bg-light rounded p-3 mb-3">

                        <div class="row">

                            {{-- PRODUK ID --}}
                            <div class="col-6 text-start">

                                <small class="text-muted">

                                    Produk ID

                                </small>

                                <h6 class="fw-bold mb-0">

                                    #{{ $transaksi['produk_id'] }}

                                </h6>

                            </div>

                            {{-- JUMLAH --}}
                            <div class="col-6 text-end">

                                <small class="text-muted">

                                    Jumlah Pembelian

                                </small>

                                <h6 class="fw-bold text-success mb-0">

                                    {{ $jumlah }}

                                </h6>

                            </div>

                        </div>

                        <hr>

                        <div class="row">

                            {{-- HARGA SATUAN --}}
                            <div class="col-6 text-start">

                                <small class="text-muted">

                                    Harga Satuan

                                </small>

                                <h6 class="fw-bold mb-0">

                                    Rp{{ number_format(
                                        $harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </h6>

                            </div>

                            {{-- TOTAL HARGA --}}
                            <div class="col-6 text-end">

                                <small class="text-muted">

                                    Total Bayar

                                </small>

                                <h5 class="fw-bold text-success mb-0">

                                    Rp{{ number_format(
                                        $totalHarga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </h5>

                            </div>

                        </div>

                    </div>

                    {{-- INFORMASI QR --}}
                    <div class="alert alert-warning">

                        <strong>

                            QRIS Dummy

                        </strong>

                        <br>

                        Scan QR menggunakan Google Lens
                        atau kamera HP.

                        <br>

                        Total pembayaran:

                        <strong>

                            Rp{{ number_format(
                                $totalHarga,
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>

                    {{-- TOMBOL BAYAR --}}
                    <form
                        action="{{ route('transaksi.qris.bayar') }}"
                        method="POST"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="index"
                            value="{{ $index }}"
                        >

                        <button
                            type="submit"
                            class="btn btn-success w-100"
                        >

                            <i class="bi bi-check-circle me-1"></i>

                            Bayar
                            Rp{{ number_format(
                                $totalHarga,
                                0,
                                ',',
                                '.'
                            ) }}

                        </button>

                    </form>

                    {{-- KEMBALI --}}
                    <a
                        href="{{ route('transaksi') }}"
                        class="btn btn-outline-secondary w-100 mt-2"
                    >

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endif

@endsection