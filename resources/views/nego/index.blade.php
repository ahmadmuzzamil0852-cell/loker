@extends('layouts.main')

@section('title', 'Kelola Nego')

@section('content')

{{-- KHUSUS ADMIN --}}
@if(session('role') != 'admin')

    <div class="container mt-5">

        <div class="alert alert-danger shadow-sm">

            <h5 class="fw-bold mb-2">
                Akses Ditolak
            </h5>

            Halaman ini hanya bisa diakses oleh admin.

        </div>

    </div>

@else

<div class="container mt-4">

    <h2 class="fw-bold mb-4 text-success">
        Kelola Nego User
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

    {{-- DATA NEGO --}}
    @forelse($data as $item)

        <div class="card shadow-sm border-0 mb-3">

            <div class="card-body">

                <div class="row align-items-center">

                    {{-- DATA USER --}}
                    <div class="col-md-8">

                        <h5 class="fw-bold text-success mb-2">
                            {{ $item->user }}
                        </h5>

                        <p class="mb-1">

                            ID Nego :

                            <b>
                                #{{ $item->id }}
                            </b>

                        </p>

                        <p class="mb-1">

                            Nama Produk :

                            <b>
                                {{ $item->produk->nama ?? 'Produk Tidak Ditemukan' }}
                            </b>

                        </p>

                        <p class="mb-1">

                            Produk ID :

                            <b>
                                #{{ $item->produk_id }}
                            </b>

                        </p>

                        <p class="mb-1">

                            Harga Asli :

                            <b>

                                Rp{{ number_format(
                                    $item->produk->harga ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </b>

                        </p>

                        <p class="mb-1">

                            Harga Nego :

                            <b class="text-success">

                                Rp{{ number_format(
                                    $item->harga,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </b>

                        </p>

                        <p class="mb-0">

                            Status :

                            @if($item->status == 'Disetujui')

                                <span class="badge bg-success">

                                    {{ $item->status }}

                                </span>

                            @elseif($item->status == 'Ditolak')

                                <span class="badge bg-danger">

                                    {{ $item->status }}

                                </span>

                            @else

                                <span class="badge bg-warning text-dark">

                                    {{ $item->status }}

                                </span>

                            @endif

                        </p>

                    </div>

                    {{-- TOMBOL ADMIN --}}
                    <div class="col-md-4 text-end">

                        {{-- NEGO MENUNGGU --}}
                        @if($item->status == 'Menunggu Persetujuan')

                            <form action="{{ route('nego.admin.respon') }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="index"
                                       value="{{ $item->id }}">

                                <button type="submit"
                                        name="aksi"
                                        value="setujui"
                                        class="btn btn-success btn-sm">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Setujui

                                </button>

                                <button type="submit"
                                        name="aksi"
                                        value="tolak"
                                        class="btn btn-danger btn-sm">

                                    <i class="bi bi-x-circle me-1"></i>

                                    Tolak

                                </button>

                            </form>

                        {{-- NEGO DISETUJUI --}}
                        @elseif($item->status == 'Disetujui')

                            <div class="alert alert-success mb-0 py-2">

                                <i class="bi bi-check-circle me-1"></i>

                                <b>
                                    Nego Telah Disetujui
                                </b>

                            </div>

                        {{-- NEGO DITOLAK --}}
                        @elseif($item->status == 'Ditolak')

                            <div class="alert alert-danger mb-0 py-2">

                                <i class="bi bi-x-circle me-1"></i>

                                <b>
                                    Nego Telah Ditolak
                                </b>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="alert alert-warning">

            Belum ada pengajuan nego dari user.

        </div>

    @endforelse

</div>

@endif

@endsection