@extends('layouts.main')

@section('title', 'Kelola Produk')

@section('content')

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold text-success">

            Kelola Produk

        </h2>

        {{-- TOMBOL TAMBAH --}}
        <a href="{{ route('admin.produk.tambah') }}"
           class="btn btn-success">

            <i class="bi bi-plus-circle me-1"></i>

            Tambah Produk

        </a>

    </div>

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

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-success">

                        <tr>

                            <th>ID</th>

                            <th>Nama Produk</th>

                            <th>Kategori</th>

                            <th>Harga</th>

                            <th>Stok</th>

                            <th width="250">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($produk as $p)

                            <tr>

                                {{-- ID --}}
                                <td>

                                    #{{ $p->id }}

                                </td>

                                {{-- NAMA PRODUK --}}
                                <td>

                                    <span class="fw-semibold">

                                        {{ $p->nama }}

                                    </span>

                                </td>

                                {{-- KATEGORI --}}
                                <td>

                                    <span class="badge bg-secondary">

                                        {{ $p->kategori }}

                                    </span>

                                </td>

                                {{-- HARGA --}}
                                <td>

                                    Rp {{ number_format(
                                        $p->harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>

                                {{-- STOK --}}
                                <td>

                                    @if($p->stok > 0)

                                        <div>

                                            <span class="badge bg-success">

                                                Tersedia

                                            </span>

                                        </div>

                                        <small class="text-muted">

                                            {{ $p->stok }} stok

                                        </small>

                                    @else

                                        <div>

                                            <span class="badge bg-danger">

                                                Habis

                                            </span>

                                        </div>

                                        <small class="text-muted">

                                            0 stok

                                        </small>

                                    @endif

                                </td>

                                {{-- AKSI --}}
                                <td>

                                    <div class="d-flex gap-1 flex-wrap">

                                        {{-- DETAIL --}}
                                        <a href="{{ route(
                                                'produk.show',
                                                $p->id
                                            ) }}"
                                           class="btn btn-primary btn-sm">

                                            <i class="bi bi-eye me-1"></i>

                                            Detail

                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route(
                                                'admin.produk.edit',
                                                $p->id
                                            ) }}"
                                           class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil-square me-1"></i>

                                            Edit

                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route(
                                                    'admin.produk.hapus',
                                                    $p->id
                                                ) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">

                                                <i class="bi bi-trash me-1"></i>

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center text-muted py-4">

                                    <i class="bi bi-box-seam fs-3 d-block mb-2"></i>

                                    Belum ada produk.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection