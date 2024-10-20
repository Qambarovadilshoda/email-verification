@extends('layouts.app')
@section('title', 'Dashboard')

@include('partials.style')



@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <form action="{{route('logout')}}" method="POST">
                @csrf
                @method('DELETE')
                <li class="nav-item">
                    <!-- <a class="nav-link" href="">Logout</a> -->
                    <button type="submit">Logout</button>
                </li>
            </form>
        </ul>
    </div>
</nav>
<div class="container mt-5">
    <h2 class="text-center">Welcome to Your Dashboard</h2>
    <div class="row justify-content-center mt-4">
        <div class="col-md-4 profile-card">
            <h4 class="text-center">Your Profile</h4>
            <p>Name: <strong>{{auth()->user()->name}}</strong></p>
            <p>Email: <strong>{{auth()->user()->email}}</strong></p>
            <div class="text-center">
                <img src="{{asset('storage/'. auth()->user()->avatar)}}" alt="Avatar" class="img-fluid rounded-circle mb-3" width="150">
                <p><a href="{{route('edit')}}" class="btn btn-secondary">Edit Profile</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
