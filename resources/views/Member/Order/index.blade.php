@extends('layout')

@section('title', 'Riwayat Order')

@section('content')

<div class="flex justify-center my-6">
    <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
      <div class="flex-1">
        <table class="w-full text-sm lg:text-base" cellspacing="0">
          <thead>
            <tr class="h-12 uppercase">
              <th>ID</th>

              <th class="hidden text-right md:table-cell">Banyak Produk</th>
              <th class="text-right">Total Bayar</th>
              <th class="text-right">Penerima</th>
              <th class="text-right">Status Pembayaran</th>
              <th class="text-right">Status Order</th>
              <th class="text-right">Status Pengiriman</th>
            </tr>
          </thead>
          <tbody>
              @foreach($orders as $order)
              <tr class="hover:bg-slate-200 cursor-pointer" onclick="location.href='{{route('member.order.detail', $order->id)}}'">
                <td>{{ $order->id }}</td>


              <td class="justify-center md:justify-end md:flex">
                <div class="w-20 h-10">
                  <div class="relative flex flex-row w-full">
                  <span >{{ $order->detail->count() }}</span>
                  </div>
                </div>
              </td>
              <td class="hidden text-right md:table-cell">
                <span>
                  Rp. {{ number_format($order->total_price,2,',','.')}}
                </span>
              </td>
              <td class="text-right">
                <div>
                    {{ $order->destination->name }}
                </div>
                <div>
                    {{ $order->destination->phone }}
                </div>
              </td>
              <td class="text-right">
                <span>
                  {{ $order->status_payment  }}
                </span>
              </td>
              <td class="text-right">
                <span>
                  {{ $order->order_status }}
                </span>
              </td>
              <td class="text-right">
                <span>
                  {{ $order->shipping_status }}
                </span>
              </td>
            </tr> 
              @endforeach
            
            
          </tbody>
        </table>
        <hr class="pb-6 mt-6">
      </div>
    </div>
  </div>

@endsection