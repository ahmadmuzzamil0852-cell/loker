@extends('layouts.main')

@section('title', 'Login User')

@section('content')

<div class="container mt-4">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <h2 class="mb-3">
                Login User
            </h2>

            {{-- ALERT SUCCESS --}}
            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            {{-- ALERT ERROR --}}
            @if(session('error'))

                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>

            @endif

            {{-- ERROR VALIDASI --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif

            {{-- FORM LOGIN USER --}}
            <form
                action="{{ route('login.user') }}"
                method="POST"
            >

                @csrf

                <div class="mb-2">

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email User"
                        value="{{ old('email') }}"
                        required
                    >

                </div>

                <div class="mb-2">

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password User"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-success w-100"
                >

                    <i class="bi bi-box-arrow-in-right me-1"></i>

                    Login User

                </button>

            </form>

            {{-- REGISTER USER --}}
            <a
                href="{{ route('register') }}"
                class="btn btn-outline-success w-100 mt-2"
            >

                <i class="bi bi-person-plus me-1"></i>

                Register User

            </a>

            {{-- LOGIN ADMIN --}}
            <a
                href="{{ route('login.admin') }}"
                class="btn btn-outline-dark w-100 mt-2"
            >

                <i class="bi bi-shield-lock me-1"></i>

                Login Sebagai Admin

            </a>

        </div>

    </div>

</div>

@endsection