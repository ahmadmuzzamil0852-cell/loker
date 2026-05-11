@extends('layouts.main')

@section('title', 'Edit Produk')

@section('content')

<div class="container mt-5">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h2 class="fw-bold text-success mb-4">

                Edit Produk

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

            {{-- FORM EDIT --}}
            <form action="/update/{{ $produk['id'] }}"
                  method="POST">

                @csrf

                {{-- NAMA --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Nama Produk

                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ $produk['nama'] }}"
                           required>

                </div>

                {{-- HARGA --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Harga

                    </label>

                    <input type="number"
                           name="harga"
                           class="form-control"
                           value="{{ $produk['harga'] }}"
                           required>

                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Kategori

                    </label>

                    <input type="text"
                           name="kategori"
                           class="form-control"
                           value="{{ $produk['kategori'] }}"
                           required>

                </div>

                {{-- BERAT --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Berat

                    </label>

                    <input type="text"
                           name="berat"
                           class="form-control"
                           value="{{ $produk['berat'] }}"
                           required>

                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Deskripsi

                    </label>

                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4"
                              required>{{ $produk['deskripsi'] }}</textarea>

                </div>

                {{-- BUTTON --}}
                <button type="submit"
                        class="btn btn-success">

                    <i class="bi bi-save me-1"></i>

                    Simpan Perubahan

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