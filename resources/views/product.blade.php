@extends('layout')

@section('title')
    {{ $barang->name }} | CubieBaby
@endsection

@section('content')
    <div class="container mt-10 mx-auto">
        <div class="flex flex-row">
            <div class="w-full sm:w-1/3">
                <img src="{{ asset('storage/'.$barang->image) }}" alt="{{ $barang->nama }}" class="w-full">
            </div>
            <div class="w-full sm:w-2/3 ml-10">
                <h1 class="text-3xl font-bold">{{ $barang->name }}</h1>
                <div class="flex flex-row">
                    <div class="w-1/2">
                        <p class="text-gray-600">{{ $barang->deskripsi }}</p>
                        <p class="text-green-500 font-bold text-xl">Rp. {{ $barang->price }}</p>
                    </div>
                    <div class="w-1/2 flex flex-col">
                        <form action="{{ route('buy.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $barang->id }}">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-32">
                                Beli
                            </button>
                        </form>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $barang->id }}">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-32 mt-4   ">
                               Add cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($barangs as $barang)
                    <div class="flex flex-col">
                        <div class="group relative">
                            <div
                                class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                <img src="{{ asset('storage/' . $barang->image) }}" alt="{{ $barang->name }}"
                                    class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700">
                                        <a href="{{ route('product.show', $barang->id) }}">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $barang->name }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ $barang->category->name }}</p>
                                </div>
                                <p class="text-sm font-medium text-green-600">Rp. {{ $barang->price }}</p>
                            </div>
                        </div>
                        <form action="{{ route('buy.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $barang->id }}">
                            <button class="mt-2 w-full bg-gray-300 text-center p-1 rounded-lg hover:bg-gray-500" value="beli">
                                Beli
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection