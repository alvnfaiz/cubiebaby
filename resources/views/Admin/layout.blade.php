<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=asdaoksdn">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .print{
            display: none;
        }
        .print-woi{
            display: none;
        }
        @media print{
            .no-print{
                display: none;
            }
            .print{
                display: block;
            }
            .print-woi{
                display: flex;
            }
        }
    </style>
</head>
<body class="bg-gray-200">
    <div class="absolute flex-col w-full md:flex md:flex-row md:min-h-screen">
        <div @click.away="open = false" class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-white md:w-64 dark-mode:text-gray-200 dark-mode:bg-gray-800" x-data="{ open: false }">
            <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
            <a href="{{ route('home') }}" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">CubieBaby</a>
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
            </div>
            <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg hover:text-gray-900 {{ (request()->is('admin/')) ? 'bg-gray-200' : 'bg-transparent hover:bg-gray-200' }}" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg hover:text-gray-900 {{ (request()->is('admin/product*')) ? 'bg-gray-200' : 'bg-transparent hover:bg-gray-200' }}" href="{{ route('admin.product.index') }}">Produk</a>
            <div @click.away="report = false" class="relative" x-data="{ report: false }">
                <button @click="report = !report" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 hover:bg-gray-200 ">
                <span>Laporan</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': report, 'rotate-0': !report}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div x-show="report" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 hover:bg-gray-200 " href="{{ route('admin.report.index') }}">Index</a>
                    @if(auth()->user()->role == 'Admin')
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 hover:bg-gray-200 " href="{{ route('admin.report.member') }}">Pelanggan</a>
                    @endif
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 hover:bg-gray-200 " href="{{ route('admin.report.sale') }}">Penjualan</a>
                </div>
                </div>
            </div>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg hover:text-gray-900 {{ (request()->is('admin/category*')) ? 'bg-gray-200' : 'bg-transparent hover:bg-gray-200' }}" href="{{ route('admin.category.index') }}">Kategori</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg hover:text-gray-900 {{ (request()->is('admin/message*')) ? 'bg-gray-200' : 'bg-transparent hover:bg-gray-200' }}" href="{{ route('admin.message.index') }}">Pesan</a>
            
            @if(auth()->user()->role == 'Admin')
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg hover:text-gray-900 {{ (request()->is('admin/shipping*')) ? 'bg-gray-200' : 'bg-transparent hover:bg-gray-200' }}" href="{{ route('admin.shipping.index') }}">Ongkir</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg hover:text-gray-900 {{ (request()->is('admin/banner*')) ? 'bg-gray-200' : 'bg-transparent hover:bg-gray-200' }}" href="{{ route('admin.banner.index') }}">Banner</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg hover:text-gray-900 {{ (request()->is('admin/botchat*')) ? 'bg-gray-200' : 'bg-transparent hover:bg-gray-200' }}" href="{{ route('admin.botchat.index') }}">BotChat</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg hover:text-gray-900 {{ (request()->is('admin/member*')) ? 'bg-gray-200' : 'bg-transparent hover:bg-gray-200' }}" href="{{ route('admin.member.list') }}">Kelola User</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg hover:text-gray-900 {{ (request()->is('admin/broadcast*')) ? 'bg-gray-200' : 'bg-transparent hover:bg-gray-200' }}" href="{{ route('admin.broadcast.index') }}">Broadcast</a>
            @endif
            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 hover:bg-gray-200 ">
                <span>Order</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 hover:bg-gray-200 " href="{{ route('admin.order.index') }}">Selesai</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 hover:bg-gray-200 " href="{{ route('admin.order.proses') }}">Diproses</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 hover:bg-gray-200 " href="{{ route('admin.order.cancel') }}">Batal/Expired</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 hover:bg-gray-200 " href="{{ route('admin.order.selesai') }}">Selesai</a>
                </div>
                </div>
            </div>
            </nav>
        </div>
        <div class="w-full">
            <div class="bg-white shadow-md no-print">
                <div class="container flex flex-row justify-between mx-auto">
                    <div class="flex flex-row p-4 space-x-8">
                        <a href="{{ route('member.profile') }}" class="mx-6 text-sky-600 hover:text-blue-600"> {{ auth()->user()->email}} </a>
                        <a href="{{ route('admin.message.index') }}" class="group">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            <span id="notif-count" class="absolute top-2 px-1.5 py-0.5 bg-green-500 rounded-full text-xs text-white opacity-50 group-hover:opacity-100">{{ $message}}</span>
                        </a>   
                    </div>
                    <div class="flex flex-row items-center">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="p-4 font-semibold text-red-500 hover:text-red-100">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>      
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</body>

</html>