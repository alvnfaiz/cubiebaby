@extends('layout')

@section('title', 'Cart')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                    <h2 class="font-semibold text-2xl">{{ $cart->count() }}</h2>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>
                @foreach ($cart as $barang)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5" id="cart-{{ $barang->product->id }}">
                        <div class="flex w-2/5">
                            <!-- product -->
                            <div class="w-20">
                                <img class="h-24" src="{{ asset('storage/' . $barang->product->image) }}" alt="">
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm">{{ $barang->product->name }}</span>
                                <span class="text-red-500 text-xs">{{ $barang->product->category->name }}</span>
                                <button type="submit" class="text-red-500 text-xs"
                                    onclick="deleteCart({{ $barang->product->id }})">Remove</button>
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5">
                            <button type="submit" class="w-4 h-8" onclick="subtract({{ $barang->product->id }})">
                                <svg class="fill-current text-gray-600 w-4" viewBox="0 0 448 512">
                                    <path
                                        d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                </svg>
                            </button>
                            <input id="{{ $barang->product->id }}" onchange="update({{ $barang->product->id }})"
                                class="mx-2 border text-center w-12" type="text" value="{{ $barang->total_product }}">
                            <button type="submit" class="w-4 h-8" onclick="add({{ $barang->product->id }})">
                                <svg class="fill-current text-gray-600 w-4" viewBox="0 0 448 512">
                                    <path
                                        d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                </svg>
                            </button>
                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">Rp.
                            {{ number_format($barang->product->price, 2, ',', '.') }}</span>
                        <span class="text-center w-1/5 font-semibold text-sm"
                            id="total-price-{{ $barang->product->id }}">Rp.
                            {{ number_format($barang->product->price * $barang->total_product, 2, ',', '.') }}</span>
                    </div>
                @endforeach


                <a href="{{ route('home') }}" class="flex font-semibold text-indigo-600 text-sm mt-10">

                    <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                        <path
                            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                    </svg>
                    Continue Shopping
                </a>
            </div>
            <form action="{{ route('member.order.add') }}" method="POST" class="w-1/4 px-8 py-10">
                @csrf
                <div id="summary" class="">
                    <h1 class="font-semibold text-2xl border-b pb-8">Detail Order Anda</h1>
                    <div class="flex justify-between mt-10 mb-5">
                        <span class="font-semibold text-sm uppercase">Total Harga</span>
                        <span class="font-semibold text-sm" id="total-harga">Rp.
                            {{ number_format($total_price, 2, ',', '.') }}</span>
                        <input name="total" type="hidden" value="{{ $total_price }}">
                    </div>
                    <div>
                        <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
                        <select name="shipping_id" class="block p-2 text-gray-600 w-full text-sm" onchange="shipUpdate()"
                            id="cost">
                            <option disabled selected>Pilih Kota Pengiriman</option>
                            @foreach ($shipping as $ship)
                                <option value="{{ $ship->id }}">{{ $ship->city }} -
                                    {{ number_format($ship->cost, 2, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="border-t mt-8">
                        <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                            <span>Total Bayar</span>
                            <span id="total-bayar">Rp. {{ number_format($total_price, 2, ',', '.') }}</span>
                        </div>
                        <input type="text" name="name" class="block p-2 text-gray-600 w-full text-sm"
                            placeholder="Nama Penerima" required value="{{ old('name') }}">
                        <input type="text" name="phone" class="block p-2 text-gray-600 w-full text-sm"
                            placeholder="Nomor Telepon" required value="{{ old('phone') }}">
                        <input type="text" name="address" class="block p-2 text-gray-600 w-full text-sm"
                            placeholder="Alamat Lengkap" required value="{{ old('address') }}">

                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase">Checkout</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            function subtract(id) {
                var qty = $('#' + id).val();
                if (qty > 1) {
                    qty--;
                    $('#' + id).val(qty);
                    update(id, qty);
                }
            }

            function add(id) {
                var qty = $('#' + id).val();
                qty++;
                $('#' + id).val(qty);
                update(id, qty);
            }

            function update(id, qty = null) {
                if (qty == null) {
                    qty = $('#' + id).val();
                }
                $.ajax({
                    url: "{{ route('api.cart.update') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: id,
                        qty: qty
                    },
                    success: function(data) {
                        console.log(data);
                        $('#' + id).val(data.total_product);
                        $('#total-price-' + id).text(new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(data.price * data.total_product));
                        $('#total-harga').text(new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(data.total_price));
                    }
                });
            }

            function deleteCart(id) {
                $.ajax({
                    url: "{{ route('api.cart.delete') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: id
                    },
                    success: function(data) {
                        console.log(data);
                        shipUpdate();
                        $('#cart-' + id).remove();
                    }
                });
            }

            function shipUpdate() {
                //get id cost value
                var cost = $('#cost').val();
                $.ajax({
                    url: "{{ route('api.cart.ship') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cost: cost
                    },
                    success: function(data) {
                        //total
                        $('#total-bayar').text(new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(data.total_price));
                    }
                });
            }
        </script>
    @endsection
