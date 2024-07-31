
@extends('layouts.app')

@section('title', 'Register')

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
<form method="POST" action="{{ url('register') }}" class="container" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" class="form-control" value="{{ old('name') }}" type="text" name="name" required autofocus>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" class="form-control" value="{{ old('email') }}" type="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="profile_image">Profile Image</label>
        <input id="profile_image" class="form-control" type="file" name="profile_image">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input id="username" class="form-control" value="{{ old('username') }}" type="text" name="username" required>
    </div>
    <div class="form-group">
        <label for="mobile_number">Mobile Number</label>
        <input id="mobile_number" class="form-control" value="{{ old('mobile_number') }}" type="text" name="mobile_number" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" class="form-control" type="password" name="password" required>
    </div>

   
    <div class="form-check mt-2">
        <input class="form-check-input" {{ old('role') == 'user' ? 'checked' : '' }}  value="user" id="flexRadioDefault1"  type="radio" name="role" >
        <label class="form-check-label" for="flexRadioDefault1">
        User
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" {{ old('role') == 'admin' ? 'checked' : '' }} type="radio" id="flexRadioDefault2" name="role" value="admin"  >
        <label class="form-check-label" for="flexRadioDefault2">
        Admin
        </label>
    </div>
    <div class="d-flex my-1 form-group">
        <button class="btn btn-primary mx-1" type="submit">Register</button>
        
    </div>
</form>


@endsection

