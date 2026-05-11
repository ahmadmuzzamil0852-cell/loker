@extends('layouts.main')

@section('content')
<div class="col-md-4 mx-auto">
    <h3>Login</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST">
        @csrf
        <input type="email" name="email" class="form-control mb-2" placeholder="Email">
        <input type="password" name="password" class="form-control mb-2" placeholder="Password">
        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection