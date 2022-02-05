<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="bg-gray-50">
    <div class="bg-white shadow md:px-0 px-4">
        <div class="md:container flex flex-row justify-between mx-auto">
            <div class="flex flex-row">
                <div class="flex flex-row items-center uppercase tracking-widest">
                    <span class="text-md font-bold text-blue-600">Cubie</span><span class="text-blue-400 italic">Baby</span>
                </div>
                <div class="flex flex-row items-center ml-4 hidden md:block">
                    <div class="flex flex-row items-center">
                        <a href="{{ route('home') }}" class="p-4 font-semibold text-sky-500 hover:bg-sky-500 hover:text-white">
                            Home
                        </a>
                        <a href="{{ route('home') }}" class="p-4 font-semibold text-sky-500 hover:bg-sky-500 hover:text-white">
                            About
                        </a>
                        <a href="{{ route('home') }}" class="p-4 font-semibold text-sky-500 hover:bg-sky-500 hover:text-white">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-row items-center space-x-2">
                <div class="flex flex-row">
                    <form action="{{ route('search') }}" method="GET" class="flex flex-row">
                        <input type="text" name="search" class="p-1 border border-gray-400 rounded w-full" placeholder="Search" value="{{ request('search') }}">
                        <button type="submit" class="p-1 border border-blue-400 rounded bg-blue-500 hover:bg-sky-700">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>
                @if(auth()->user())

                    <a href="{{ route('cart') }}" class="group">
                        <svg class="w-8 h-8 text-blue-400 hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span id="notif-count" class="absolute top-2 px-1.5 py-0.5 bg-green-500 rounded-full text-xs text-white opacity-50 group-hover:opacity-100">{{ $cart_count }}</span>
                    </a>

                    @if(auth()->user()->role != 'Member')
                        <a href="{{ route('dashboard') }}" class="text-blue-600 dark-mode:text-white focus:outline-none focus:shadow-outline"> {{ auth()->user()->email }} </a>
                    @endif
                    @if(auth()->user()->role == 'Member')
                        <a href="{{ route('member.profile') }}" class="text-blue-600 dark-mode:text-white focus:outline-none focus:shadow-outline"> {{ auth()->user()->email}} </a>
                    @endif
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="p-4 font-semibold text-red-500 hover:text-red-200">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                    <a href="{{ route('login') }}" class="p-2 font-semibold text-blue-500 rounded hover:bg-blue-500 hover:text-white">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="p-2 ml-4 font-semibold text-blue-500    md:text-white rounded hover:bg-blue-500 md:bg-sky-500">
                        Register
                    </a>
                @endif
            </div>
        </div>
    </div>
     @yield('content')
</body>

</html>