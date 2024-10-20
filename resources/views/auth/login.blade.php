@extends('layouts.app')
@section('title', 'Login')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Login</h2>
                <form action="{{ route('handleLogin') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="loginEmail">Email address</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    @error('email')
                    <p style="color:red"> {{'* ' . $message }} </p>
                    @enderror
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    @error('password')
                    <p style="color:red"> {{'* ' . $message }} </p>
                    @enderror
                    <button type="submit" class="btn btn-success btn-block">Login</button>
                </form>
                <p class="text-center mt-2">Don't have an account? <a href="{{ route('registerForm') }}">Register</a></p>
            </div>
        </div>
    </div>
@endsection
