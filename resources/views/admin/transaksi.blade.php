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

    {{-- DATA --}}
    @forelse($data as $index => $item)

        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

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

                <p class="mb-3">

                    Status :

                    <span class="badge bg-primary">

                        {{ $item['status'] }}

                    </span>

                </p>

                {{-- CEK BUKTI --}}
                @if($item['bukti'])

                    <div class="alert alert-info">

                        Bukti pembayaran sudah dikirim:
                        <b>{{ $item['bukti'] }}</b>

                    </div>

                    {{-- VERIFIKASI --}}
                    @if($item['status'] == 'Menunggu Verifikasi Admin')

                        <form action="/nego/verifikasi"
                              method="POST">

                            @csrf

                            <input type="hidden"
                                   name="index"
                                   value="{{ $index }}">

                            <button class="btn btn-success">

                                Verifikasi Pembayaran

                            </button>

                        </form>

                    @endif

                @endif

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