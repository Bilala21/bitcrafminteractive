<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <header class="global-header simple">
            <nav class="breadcrumbs-container user__nav">
                <div class="d-flex">
                    <a class="header-logo" name="logoLink" href="#">MI</a>
                    <ul class="breadcrumbs">
                        <li class="crumb plain-message">
                            <a href="{{ route('home') }}" class="add_coupon ancher_style">Home</a>
                        </li>
                        <li class="crumb plain-message">
                                @auth
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="ancher_style">Logout</button>
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="add_coupon ancher_style">Login</a>
                                @endauth
                            
                        </li>
                    </ul>
                </div>
                <div class="current__user__email">
                    <a href="{{ route('user') }}" class="ancher_style">
                        
                    @if(isset(auth()->user()->email))
                    {{auth()->user()->email}}
                    @endif
                       
                    </a>
                </div>
            </nav>
        </header>
