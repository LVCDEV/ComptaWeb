@extends('base')

@section('page_title', 'Login')

@section('content')
    <div class="card text-bg-primary bg-opacity-75">
        <div class="card-header text-bg-primary">
            <h1>Login</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('auth.login') }}" method="post" class="vstack gap-3">
                @csrf
                <div class="row mt-5 justify-content-center">
                    <div class="col input-group mb-3">
                        <span class="input-group-text" id="label_email"><i class="bi bi-envelope-at"></i></span>
                        <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}"
                               aria-describedby="label_email">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="col input-group mb-3">
                        <span class="input-group-text" id="label_password"><i class="bi bi-key-fill"></i></span>
                        <input class="form-control" id="password" name="password" type="password"
                               aria-describedby="label_password">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="col-1">
                        <button class="btn btn-success">Login</button>
                    </div>
                </div>
            </form>
        </div>
@endsection
