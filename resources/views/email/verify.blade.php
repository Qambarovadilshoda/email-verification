
@extends('layouts.app')
@section('title', 'Login')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Verification</h2>
                <form action="{{ route('handleVerify') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="verify_token" required>
                    </div>
                    @error('verify_token')
                       <p style="color:red"> {{'* ' . $message }} </p>
                    @enderror
                    <button type="submit" class="btn btn-success btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
