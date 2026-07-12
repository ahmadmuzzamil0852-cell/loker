@extends('layouts.main')

@section('title', 'Edit Produk')

@section('content')

<div class="container mt-5">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h2 class="fw-bold text-success mb-4">

                Edit Produk

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

            {{-- VALIDATION ERROR --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    <h6 class="fw-bold">

                        Data belum valid

                    </h6>

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>

                                {{ $error }}

                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- FORM EDIT --}}
            <form action="{{ route(
                        'admin.produk.update',
                        $produk->id
                    ) }}"
                  method="POST">

                @csrf

                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Nama Produk

                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ old(
                               'nama',
                               $produk->nama
                           ) }}"
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
                           value="{{ old(
                               'harga',
                               $produk->harga
                           ) }}"
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
                           value="{{ old(
                               'kategori',
                               $produk->kategori
                           ) }}"
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
                           value="{{ old(
                               'berat',
                               $produk->berat
                           ) }}">

                </div>

                {{-- JUMLAH STOK --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Jumlah Stok

                    </label>

                    <input type="number"
                           name="stok"
                           class="form-control"
                           value="{{ old(
                               'stok',
                               $produk->stok
                           ) }}"
                           min="0"
                           required>

                    <small class="text-muted">

                        Isi 0 jika stok produk habis.

                    </small>

                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Deskripsi

                    </label>

                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4">{{ old(
                                  'deskripsi',
                                  $produk->deskripsi
                              ) }}</textarea>

                </div>

                {{-- BUTTON --}}
                <button type="submit"
                        class="btn btn-success">

                    <i class="bi bi-save me-1"></i>

                    Simpan Perubahan

                </button>

                <a href="{{ route('admin.produk') }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection