@extends('user.layout.index')
@section('title', 'Login Page')
@section('content')

<div class="container">
    <h2 class="bg-primary p-3 text-light text-center">Welcome to Login Page</h2>
</div>
<form action="{{ route('user.login.store')}}" method="POST" id="loginForm">
    @csrf
    <div class="mt-2">
        @if($errors->any())
        <div class="col-12">
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
    </div>
    <div class="container d-flex min-vh-100 justify-content-center align-items-center">


        <div class="card border border-info col-md-6">
            <div class="mb-3 p-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" required>
            </div>
            <div class="mb-3 p-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
            </div>
            <div class="text-center p-2">
                <button type="submit" class="btn btn-outline-info">Login</button>
                <p class="text-center mb-0">Don't have an Account? <a href="{{route('user.register')}}">Register</a></p>
            </div>
        </div>

    </div>
</form>
@endsection