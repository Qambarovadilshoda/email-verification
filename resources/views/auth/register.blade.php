@extends('layouts.app')
@section('title', 'Register')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Register</h2>
            <form action="{{route('handleRegister')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="registerName">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                @error('name')
                <p style="color:red"> {{'* ' . $message }} </p>
                @enderror
                <div class="form-group">
                    <label for="registerEmail">Email address</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                @error('email')
                <p style="color:red"> {{'* ' . $message }} </p>
                @enderror
                <div class="form-group">
                    <label for="registerEmail">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                @error('password')
                <p style="color:red"> {{'* ' . $message }} </p>
                @enderror
                <div class="form-group">
                    <label for="registerEmail">Avatar</label>
                    <input type="file" class="form-control" name="avatar" required>
                </div>
                @error('avatar')
                <p style="color:red"> {{'* ' . $message }} </p>
                @enderror
                <button type="submit" class="btn btn-success btn-block">Register</button>
            </form>
            <p class="text-center mt-2">Already have an account? <a href="{{route('handleLogin')}}">Login</a></p>
        </div>
    </div>
</div>

@endsection
