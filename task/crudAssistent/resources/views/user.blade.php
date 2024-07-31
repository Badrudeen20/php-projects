

@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
   <div class="text-center">Update Profile</div>
   @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
         </ul>
      </div>
   @endif
   <form method="POST" action="{{ url('update').'/'.auth()->user()->id }}" class="container" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
         <label for="name">Name</label>
         <input id="name" class="form-control" value="{{ old('name') ?? $user->name }}" type="text" name="name" required autofocus>
      </div>
      <div class="form-group">
         <label for="email">Email</label>
         <input id="email" class="form-control" value="{{ old('email') ?? $user->email }}" type="email" name="email" required>
      </div>
      <div class="form-group">
         <label for="profile_image">Profile Image</label>
         <input id="profile_image" class="form-control" type="file" name="profile_image">
         <img src="{{ asset('public/'.$user->profile_image) }}" width="50" alt="Profile">
      </div>
      <div class="form-group">
         <label for="username">Username</label>
         <input id="username" class="form-control" value="{{ old('username') ?? $user->username }}" type="text" name="username" required>
      </div>
      <div class="form-group">
         <label for="mobile_number">Mobile Number</label>
         <input id="mobile_number" class="form-control" value="{{ old('mobile_number') ?? $user->mobile_number }}" type="text" name="mobile_number" required>
      </div>
      <!-- <div class="form-group">
         <label for="password">Password</label>
         <input id="password" class="form-control" type="password" name="password" required>
      </div> -->

      
      <!-- <div class="form-check mt-2">
         <input class="form-check-input" {{ old('role') == 'user' ? 'checked' : '' }}  
         @if($user->role=='user')
          checked
         @endif
         value="user" id="flexRadioDefault1"  type="radio" name="role" >
         <label class="form-check-label" for="flexRadioDefault1">
         User
         </label>
         </div>
         <div class="form-check">
            <input class="form-check-input" {{ old('role') == 'admin' ? 'checked' : '' }} 
            @if($user->role=='admin')
            checked
            @endif
            type="radio" id="flexRadioDefault2" name="role" value="admin"  >
            <label class="form-check-label" for="flexRadioDefault2">
            Admin
            </label>
      </div> -->
      <div class="d-flex my-1 form-group">
         <button class="btn btn-primary mx-1" type="submit">Register</button>
         
      </div>
   </form>
@endsection