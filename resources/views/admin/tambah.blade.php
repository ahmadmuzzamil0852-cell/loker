@extends('layouts.main')

@section('title', 'Tambah Produk')

@section('content')

<div class="container mt-5">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h2 class="fw-bold text-success mb-4">

                Tambah Produk

            </h2>

            {{-- VALIDASI ERROR --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>

                                {{ $error }}

                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- FORM TAMBAH PRODUK --}}
            <form action="{{ route('admin.produk.simpan') }}"
                  method="POST">

                @csrf

                {{-- NAMA PRODUK --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Nama Produk

                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ old('nama') }}"
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
                           value="{{ old('harga') }}"
                           min="1"
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
                           value="{{ old('kategori') }}"
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
                           value="{{ old('berat') }}"
                           placeholder="Contoh: 200 gram">

                </div>

                {{-- JUMLAH STOK --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Jumlah Stok

                    </label>

                    <input type="number"
                           name="stok"
                           class="form-control"
                           value="{{ old('stok', 0) }}"
                           min="0"
                           required>

                    <small class="text-muted">

                        Masukkan jumlah stok produk. Isi 0 jika produk habis.

                    </small>

                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Deskripsi

                    </label>

                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4">{{ old('deskripsi') }}</textarea>

                </div>

                {{-- BUTTON SIMPAN --}}
                <button type="submit"
                        class="btn btn-success">

                    <i class="bi bi-save me-1"></i>

                    Simpan Produk

                </button>

                {{-- BUTTON KEMBALI --}}
                <a href="{{ route('admin.produk') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection