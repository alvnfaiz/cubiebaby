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
    <div class="bg-white shadow-md">
        <div class="container flex flex-row justify-between mx-auto">
            <div class="flex flex-row">
                <div class="flex flex-row items-center">
                    <span class="text-md font-bold text-blue-600">Cubie</span><span class="text-blue-400 italic">Baby</span>
                </div>
                <div class="flex flex-row items-center ml-4">
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
            <div class="flex flex-row items-center">
                @if(auth()->user())
                    <a href="">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span id="notif-count" class="absolute top-2 px-1.5 py-0.5 bg-green-500 rounded-full text-xs text-white opacity-50 hover:opacity-100">{{ $report }}</span>
                    </a>
                    <a href="">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <span id="notif-count" class="absolute top-2 px-1.5 py-0.5 bg-green-500 rounded-full text-xs text-white opacity-50 hover:opacity-100">{{ $report }}</span>
                    </a>

                    @if(auth()->user()->role != 'Member')
                        <a href="{{ route('dashboard') }}" class="text-sky-600 hover:text-blue-600 mx-6"> {{ auth()->user()->email }} </a>
                    @endif
                    @if(auth()->user()->role == 'Member')
                        <a href="{{ route('member.profile') }}" class="text-sky-600 hover:text-blue-600 mx-6"> {{ auth()->user()->email}} </a>
                    @endif
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="p-4 font-semibold text-blue-500 hover:bg-blue-500 hover:text-white">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                    <a href="{{ route('login') }}" class="p-2 font-semibold text-blue-500 rounded hover:bg-blue-500 hover:text-white">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="p-2 ml-4 font-semibold text-white rounded hover:bg-blue-500 bg-sky-500">
                        Register
                    </a>
                @endif
                
            </div>
        </div>
    </div>
     @yield('content')
</body>

</html>