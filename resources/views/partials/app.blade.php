<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://kit.fontawesome.com/ef96fb6aeb.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>
<body>
    <div class="content-wrapper @yield('class')">
        <main>
            <nav class="navbar">
            <a href="/"><p>Interact</p></a>
            @if( $flash = session('User') )
                
                <div>
                        <a href="/user/profile/{{ $flash }}"><button type="button" class="btn btn-light">checkout profile</button></a>
                        <a href="/user/applications"><button type="button" class="btn btn-primary">View applications @if(isset($counter))<span> {{ $counter }}</span>@endif</button></a>
                </div>
                
            @else
                <div>
                    <a href="/login"><button type="button" class="btn btn-light">login</button></a>
                    <a href="/register"><button type="button" class="btn btn-primary">register</button></a>
                </div>
            
            @endif   
            </nav>
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer>&copy; Interact</footer>
    </div>
    
   
</body>
</html>