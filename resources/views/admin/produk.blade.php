@extends('layouts.main')

@section('title', 'Kelola Produk')

@section('content')

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold text-success">
            Kelola Produk
        </h2>

        {{-- TOMBOL TAMBAH --}}
        <a href="/admin/produk/tambah"
           class="btn btn-success">

            <i class="bi bi-plus-circle me-1"></i>

            Tambah Produk

        </a>

    </div>

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

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead class="table-success">

                    <tr>

                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="220">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($produk as $p)

                    <tr>

                        <td>

                            #{{ $p['id'] }}

                        </td>

                        <td>

                            {{ $p['nama'] }}

                        </td>

                        <td>

                            <span class="badge bg-secondary">

                                {{ $p['kategori'] }}

                            </span>

                        </td>

                        <td>

                            Rp {{ number_format($p['harga'],0,',','.') }}

                        </td>

                        <td>

                            <span class="badge bg-success">

                                {{ $p['stok'] }}

                            </span>

                        </td>

                        <td>

                            {{-- DETAIL --}}
                            <a href="/produk/{{ $p['id'] }}"
                               class="btn btn-primary btn-sm">

                                Detail

                            </a>

                            {{-- EDIT --}}
                            <a href="/edit/{{ $p['id'] }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            {{-- HAPUS --}}
                            <a href="/admin/produk/hapus/{{ $p['id'] }}"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus produk ini?')">

                                Hapus

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection