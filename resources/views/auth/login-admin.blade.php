@extends('layouts.main')

@section('title', 'Login Admin')

@section('content')

<div class="container mt-4">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <h2 class="mb-3">
                Login Admin
            </h2>

            @if(session('error'))

                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>

            @endif

            <form
                action="{{ route('login.admin.proses') }}"
                method="POST"
            >

                @csrf

                <div class="mb-2">

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email Admin"
                        required
                    >

                </div>

                <div class="mb-2">

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password Admin"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-success w-100"
                >

                    Login Admin

                </button>

            </form>

            <a
                href="{{ route('login') }}"
                class="btn btn-outline-secondary w-100 mt-2"
            >

                Login Sebagai User

            </a>

        </div>

    </div>

</div>

@endsection