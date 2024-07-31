<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        @if(auth()->check())
                           {{ auth()->user()->username }}
                        @endif
                    </a>
                </li>
                <li class="nav-item ">
                    @if(auth()->check())
                        <a class="btn float-left btn-primary" href="{{url('logout')}}">
                           Logout
                        </a>
                    @else
                        <a class="btn float-left btn-primary" href="{{url('login')}}">
                           Login
                        </a>
                        <a class="btn float-left btn-primary" href="{{url('register')}}">
                           Register
                        </a>
                    @endif
                </li>
         
            </ul>
           
        </div>
        </nav>
    </header>

  

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

   

</body>
</html>