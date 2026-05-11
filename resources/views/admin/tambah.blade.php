@extends('layouts.main')

@section('title', 'Tambah Produk')

@section('content')

<div class="container mt-5">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h2 class="fw-bold text-success mb-4">

                Tambah Produk

            </h2>

            <form action="/admin/produk/simpan"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Nama Produk
                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Harga
                    </label>

                    <input type="number"
                           name="harga"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Kategori
                    </label>

                    <input type="text"
                           name="kategori"
                           class="form-control"
                           required>

                </div>

                <button class="btn btn-success">

                    Simpan Produk

                </button>

                <a href="/admin/produk"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection