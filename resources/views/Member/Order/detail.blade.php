@extends('layout')

@section('title', 'Cart')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Order Detail</h1>
                    <h2 class="font-semibold text-2xl">{{ $orderDetail->count() }}</h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>
                @foreach ($orderDetail as $barang)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5" id="cart-{{ $barang->product->id }}">
                        <div class="flex w-2/5">
                            <!-- product -->
                            <div class="w-20">
                                <img class="h-24" src="{{ asset('storage/' . $barang->product->image) }}" alt="">
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm">{{ $barang->product->name }}</span>
                                <span class="text-red-500 text-xs">{{ $barang->product->category->name }}</span>
                                
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5">

                            <span id="{{ $barang->product->id }}" class="mx-2 border text-center w-8"
                                type="text">{{ $barang->total }}</span>

                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">Rp.
                            {{ number_format($barang->product->price, 2, ',', '.') }}</span>
                        <span class="text-center w-1/5 font-semibold text-sm"
                            id="total-price-{{ $barang->product->id }}">Rp.
                            {{ number_format($barang->product->price * $barang->total, 2, ',', '.') }}</span>
                    </div>
                @endforeach

            </div>
            <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Detail Order Anda</h1>
                <div class="flex justify-between mt-10 mb-5">
                    <span class="font-semibold text-sm uppercase">Total Harga</span>
                    <span class="font-semibold text-sm" id="total-harga">Rp.
                        {{ number_format($order->total_price, 2, ',', '.') }}</span>
                    <input name="total" type="hidden" value="">
                </div>
                <div>
                    <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
                    <span class="block p-2 text-gray-600 w-full text-sm">
                        {{ $order->shipping->city }}
                    </span>
                </div>

                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total Bayar</span>
                        <span id="total-bayar">Rp. {{ number_format($order->total_price, 2, ',', '.') }}</span>
                    </div>


                </div>
            </div>
            <div class="flex flex-col rounded shadow-md p-2">
                
                @if(!$order->image)
                <span>Silahkan Transfer Pembayaran Kamu kesini</span>
                <div class="flex flex-col mt-4">
                    <span class="text-blue-500">BRI</span>
                    <span class="text-md font-bold text-blue-500">543601009704534 </span>
                    <span class=" text-gray-700">a\n Alvin Faiz Zulfitri</span>
                </div>
                <form method="POST" action="{{ route('member.order.update', $order->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <div class="flex text-sm text-gray-600">
                                <label for="image"
                                    class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload Bukti Pembayaran</span>
                                    <input id="image" name="image" type="file" accept="image/png, image/jpeg">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG up to 2MB | 1216px x 420 px
                            </p>
                        </div>
                    </div>
                    <input type="submit" value="Submit" class="px-6 py-3 bg-blue-500 text-white rounded-md">
                    
                </form>
                @else
                    <img src="{{ asset('storage/' . $order->image) }}" alt="" class="w-64">

                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

@endsection
