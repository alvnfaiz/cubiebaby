@extends('Admin.layout')

@section('content')
<div class="flex flex-col container mx-auto bg-white mt-6">
    <div class="w-full flex flex-row m-6">
        <div class="flex flex-col mr-12">
            <span>{{ $order->destination->name }}</span>
            <span>{{ $order->destination->phone }}</span>
            <span>{{ $order->destination->address }}</span>
        </div>
        <div class="w-96">
            <img src="{{ asset('storage/'.$order->image) }}" alt="">
        </div>
    </div>
    <div class="flex shadow-md my-10">
        <div class="w-3/4 bg-white px-10 py-10">
          <div class="flex justify-between border-b pb-8">
            <h1 class="font-semibold text-2xl">Shopping Cart</h1>
            <h2 class="font-semibold text-2xl">{{ $order->detail->count() }}</h2>
          </div>
          <div class="flex mt-10 mb-5">
            <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
            <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
          </div>
          @php
              $total = 0;
          @endphp
          @foreach($order_detail as $barang)
          <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
            <div class="flex w-2/5"> <!-- product -->
              <div class="w-24">
                <img class="h-24" src="{{ asset('storage/' . $barang->product->image) }}" alt="">
              </div>
              <div class="flex flex-col justify-between ml-4 flex-grow">
                <span class="font-bold text-md">{{ $barang->product->name }}</span>
                
              </div>
            </div>
            <div class="flex justify-center w-1/5">
                <span class="text-red-500 ">{{ $barang->total }}</span>
            </div>
            <span class="text-center w-1/5 font-semibold text-sm">{{ $barang->price }}</span>
            <span class="text-center w-1/5 font-semibold text-sm">{{ $barang->total * $barang->price }}</span>
            @php
                $total += $barang->total * $barang->price;
            @endphp
          </div>  
          @endforeach
          

        </div>
  
        <div id="summary" class="w-1/4 px-8 py-10">
          
          <div class="flex justify-between mt-10 mb-5">
            <span class="font-semibold text-sm uppercase">Total Harga </span>
            <span class="font-semibold text-sm">{{ $total }}</span>
          </div>
          <div>
            <label class="font-medium inline-block mb-3 text-sm uppercase">Pengiriman</label>
            <span class="block p-2 text-gray-600 w-full text-sm">
                {{  $order->shipping->city }} - Rp. {{ $order->shipping->cost }}
            </span>
          </div>
          <div class="border-t mt-8">
            <div class="flex font-semibold justify-between py-6 text-sm uppercase">
              <span>Total Bayar</span>
              <span>{{ $order->total_price }}</span>
            </div>
        </div>
        </div>
      </div>


      
<form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="container mx-auto p-6 w-2/3">
    @csrf
    @method('put')
    <div class="mb-6">
        <label for="resi_number" class="block mb-2 text-sm font-medium text-gray-900">Nomor Resi</label>
        <input type="text" id="resi_number" name="resi_number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('resi_number', $order->resi_number) }}">
      </div>
    <div class="flex items-start mb-6">
        <label for="payment_status" class="block mb-2 text-sm font-medium text-gray-900">Status Pembayaran</label>
        <select name="payment_status" id="payment_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="Lunas" @if(old('payment_status') == "Lunas" || $order->status_payment == "Lunas") selected @endif>Lunas</option>
            <option value="Belum Lunas" @if(old('payment_status') == "Belum Lunas" || $order->status_payment == "Belum Lunas") selected @endif>Belum Lunas</option>
        </select>
    </div>
    <div class="flex items-start mb-6">
        <label for="shipping_status" class="block mb-2 text-sm font-medium text-gray-900">Status Pengiriman</label>
        <select name="shipping_status" id="shipping_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="Diproses" @if(old('shipping_status') == "Diproses" || $order->shipping_status == "Diproses") selected @endif>Diproses</option>
            <option value="Dikirim" @if(old('shipping_status') == "Dikirim" || $order->shipping_status == "Dikirim") selected @endif>Dikirim</option>
            <option value="Selesai" @if(old('shipping_status') == "Selesai" || $order->shipping_status == "Selesai") selected @endif>Selesai</option>
        </select>
    </div>
    <div class="flex items-start mb-6">
        <label for="order_status" class="block mb-2 text-sm font-medium text-gray-900">Status Order</label>
        <select name="order_status" id="order_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="Proses" @if(old('order_status') == "Proses" || $order->order_status == "Proses") selected @endif>Proses</option>
            <option value="Expired" @if(old('order_status') == "Expired" || $order->order_status == "Expired") selected @endif>Expired</option>
            <option value="Cancel" @if(old('order_status') == "Cancel" || $order->order_status == "Cancel") selected @endif>Cancel</option>
            <option value="Selesai" @if(old('order_status') == "Selesai" || $order->order_status == "Selesai") selected @endif>Selesai</option>
        </select>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
  </form>

</div>



@endsection