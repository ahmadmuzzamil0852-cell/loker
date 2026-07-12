@extends('layouts.main')

@section('title', 'Register User')

@section('content')

<div class="container mt-5 mb-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h2 class="fw-bold text-success text-center mb-2">

                        Register User

                    </h2>

                    <p class="text-muted text-center mb-4">

                        Buat akun untuk mulai berbelanja

                    </p>

                    {{-- ALERT ERROR --}}
                    @if(session('error'))

                        <div class="alert alert-danger">

                            {{ session('error') }}

                        </div>

                    @endif

                    {{-- VALIDATION ERROR --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            @foreach($errors->all() as $error)

                                <div>
                                    {{ $error }}
                                </div>

                            @endforeach

                        </div>

                    @endif

                    {{-- FORM REGISTER --}}
                    <form
                        action="{{ route('register.proses') }}"
                        method="POST"
                    >

                        @csrf

                        {{-- NAMA --}}
                        <div class="mb-3">

                            <label class="form-label">

                                Nama Lengkap

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Masukkan nama lengkap"
                                value="{{ old('name') }}"
                                required
                            >

                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Masukkan email"
                                value="{{ old('email') }}"
                                required
                            >

                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">

                            <label class="form-label">

                                Password

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                required
                            >

                        </div>

                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-4">

                            <label class="form-label">

                                Konfirmasi Password

                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password"
                                required
                            >

                        </div>

                        {{-- REGISTER --}}
                        <button
                            type="submit"
                            class="btn btn-success w-100"
                        >

                            <i class="bi bi-person-plus me-1"></i>

                            Register

                        </button>

                    </form>

                    <hr>

                    <p class="text-center mb-2">

                        Sudah memiliki akun?

                    </p>

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-outline-success w-100"
                    >

                        Login User

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection