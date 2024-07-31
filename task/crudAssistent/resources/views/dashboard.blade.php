
@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
   <div>Welcome to admin</div>
   <div class="container">
    <div >
        <a class="btn btn-primary" href="{{url('download')}}">Download</a>
        <div class="form-group"> 
                <a href="{{url('/')}}/public/sample.csv" class="btn-sm btn btn-info" target="_blank" >Download Import Sample</a> 
        </div>
        <form action="{{ route('users.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="csv">Select CSV File</label>
                <input type="file" class="form-control" name="csv" id="csv" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
    </div>
   <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">email</th>
        <th scope="col">mobile</th>
        </tr>
    </thead>
   <tbody>
  @foreach ($users as $user)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$user->username}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->mobile_number}}</td>
    </tr>
  @endforeach
    
    
  </tbody>
</table>
   </div>
@endsection