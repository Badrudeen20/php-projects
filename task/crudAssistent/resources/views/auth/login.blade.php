
@extends('layouts.app')

@section('title', 'Login')

@section('content')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ url('login') }}">
    @csrf
    <div>
        <label for="login">Email, Username, or Mobile Number</label>
        <input id="login" type="text" name="login" required autofocus>
    </div>
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>
    <div>
        
    </div>
    <div class="d-flex my-1">
        <button class="btn btn-primary mx-1" type="submit">Login</button>
        
    </div>
</form>


@endsection
