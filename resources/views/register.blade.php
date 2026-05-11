@extends('layouts.main')
@section('title','Daftar – Gudang Kerinci')
@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <div class="text-center mb-4">
                <i class="bi bi-person-plus-fill text-success" style="font-size:2.5rem"></i>
                <h4 class="fw-bold mt-2">Buat Akun Baru</h4>
            </div>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="Nama kamu" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="contoh@email.com" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Min. 6 karakter" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">No. Telepon <span class="text-muted">(opsional)</span></label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat <span class="text-muted">(opsional)</span></label>
                    <textarea name="address" class="form-control" rows="2" placeholder="Alamat lengkap kamu">{{ old('address') }}</textarea>
                </div>
                <button type="submit" class="btn btn-kerinci w-100 py-2 fw-semibold">
                    <i class="bi bi-person-check me-1"></i>Daftar Sekarang
                </button>
            </form>
            <hr>
            <p class="text-center mb-0 small text-muted">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-success fw-semibold">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection