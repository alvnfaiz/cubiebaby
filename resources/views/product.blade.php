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
                        <form action="{{ route('cart') }}" method="POST">
                            @csrf
                            //total pembelian

                            <input type="hidden" name="id" value="{{ $barang->id }}">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add to Cart
                            </button>
                        </form>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $barang->id }}">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Beli
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection