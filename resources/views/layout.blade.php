<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/flowbite@1.3.2/dist/flowbite.js"></script>
</head>

<body class="bg-gray-50">
    <div class="bg-white shadow md:px-0 px-4">
        <div class="md:container flex flex-row justify-between mx-auto">
            <div class="flex flex-row">
                <div class="flex flex-row items-center uppercase tracking-widest">
                    <span class="text-md font-bold text-blue-600">Cubie</span><span
                        class="text-blue-400 italic">Baby</span>
                </div>
                <div class="flex flex-row items-center ml-4 hidden md:block">
                    <div class="flex flex-row items-center">
                        <a href="{{ route('home') }}"
                            class="p-4 font-semibold text-sky-500 hover:bg-sky-500 hover:text-white">
                            Home
                        </a>
                        <a href="{{ route('home') }}"
                            class="p-4 font-semibold text-sky-500 hover:bg-sky-500 hover:text-white">
                            About
                        </a>
                        <a href="{{ route('home') }}"
                            class="p-4 font-semibold text-sky-500 hover:bg-sky-500 hover:text-white">
                            Contact Us
                        </a>
                        <div class="flex items-center">
                            <button type="button"
                                class="p-4 font-semibold text-sky-500 hover:bg-sky-500 hover:text-white"
                                id="user-menu-button" aria-expanded="false" type="button"
                                data-dropdown-toggle="dropdown-cat">Category
                            </button>
                            <!-- Dropdown menu -->
                            <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow py-1"
                                id="dropdown-cat">
                                <ul class="py-1" aria-labelledby="dropdown">
                                    @foreach ($category as $cat)
                                        <li>
                                            <a href="{{ route('category.show', $cat->slug) }}"
                                                class="block py-2 px-4 text-sm text-blue-500 hover:bg-blue-300  hover:text-white">{{ $cat->name }}</a>
                                        </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                            <button data-collapse-toggle="mobile-menu-2" type="button"
                                class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                aria-controls="mobile-menu-2" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-row items-center space-x-2">
                <div class="flex flex-row">
                    <form action="{{ route('search') }}" method="GET" class="flex flex-row">
                        <div class="hidden relative mr-3 md:mr-0 md:block">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                              <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="text" id="email-adress-icon" name="search" class="block p-2 pl-10 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-sm focus:ring-blue-500 focus:border-blue-500 focus:ring-blue-500 focus:border-blue-500" placeholder="Search...">
                          </div>
                    </form>
                </div>
                @if (auth()->user())

                    <a href="{{ route('cart') }}" class="group">
                        <svg class="w-8 h-8 text-blue-400 hover:text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span id="notif-count"
                            class="absolute top-2 px-1.5 py-0.5 bg-green-500 rounded-full text-xs text-white group-hover:opacity-50 opacity-90">{{ $cart_count }}</span>
                    </a>

                    <a href="{{ route('message') }}" class="group">
                        <svg class="w-8 h-8 text-blue-400 hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        <span id="notif-count"
                            class="absolute top-2 px-1.5 py-0.5 bg-green-500 rounded-full text-xs text-white group-hover:opacity-50 opacity-90">{{ $message }}</span>
                    </a>
                    <button class="p4 text-blue-600  focus:outline-none focus:shadow-outline"  data-dropdown-toggle="dropdown-user">
                        {{ auth()->user()->username }}
                    </button>
                    <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow " id="dropdown-user">
                        <div>
                            <span class="block text-sm text-gray-900 pt-2 px-4">{{ auth()->user()->username }}</span>
                            <span class="block text-sm font-medium text-gray-500 truncate pb-2 px-4">{{ auth()->user()->email }}</span>
                            @if (auth()->user()->role != 'Member')
                                <a href="{{ route('dashboard') }}"
                                    class="block py-2 px-4 text-sm text-blue-500 hover:bg-blue-700 hover:text-white" data-dropdown-toggle="dropdown-user">
                                    Admin Area</a>
                            @endif
                        </div>
                        <ul class="py-1" aria-labelledby="dropdown">
                        
                        <li>
                          <a href="{{ route('member.profile') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-700 hover:text-white">Profile</a>
                        </li>
                        <li>
                          <a href="{{ route('message') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-700 hover:text-white">Message</a>
                        </li>
                        <li>
                          <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-700 hover:text-white">Order History</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="block py-2 px-4 text-sm text-red-700 hover:bg-red-700 hover:text-white">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        </li>
                        
                        </ul>
                      </div>

                    
                @else
                    <a href="{{ route('login') }}"
                        class="p-2 font-semibold text-blue-500 rounded hover:bg-blue-500 hover:text-white">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="p-2 ml-4 font-semibold text-blue-500    md:text-white rounded hover:bg-blue-500 md:bg-sky-500">
                        Register
                    </a>
                @endif
            </div>
        </div>
    </div>
    @yield('content')
    <script>
        toggleCollapse('dropdown-cat', false);
        toggleCollapse('dropdown-user', false);
    </script>
</body>

</html>
