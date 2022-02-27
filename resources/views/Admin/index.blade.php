@extends('Admin.layout')
@section('title', 'Dashboard Admin - CubieBaby')
@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex flex-row space-x-4">
            <div class="w-1/6 shadow-md h-60 bg-white">
                <!-- Make text center -->
                <div class="text-center p-10">
                    <div class="text-2xl text-red-600">{{ $message }}</div>
                    Pesan Belum Dibalas
                    <div class="text-2xl text-blue-600 mt-4">{{ $inbox }}</div>
                    Pesan Masuk
                </div>
            </div>
            <div class="w-1/6 shadow-md h-60 bg-white">
                <div class="text-center p-10">
                    <div class="text-2xl text-green-600">{{ $barang }}</div>
                    Banyak Barang
                    <div class="text-2xl text-blue-600 mt-4">{{ $sold }}</div>
                    Barang Terjual
                </div>
            </div>
            <div class="w-1/6 shadow-md h-60 bg-white">
                <div class="text-center p-10">
                    <div class="text-2xl text-red-600">{{ $order }}</div>
                    Order Masuk
                    <div class="text-2xl text-blue-600 mt-4">{{ $finish_order }}</div>
                    Order Selesai
                </div>
            </div>
            <div class="w-1/6 shadow-md h-60 bg-white">
                <div class="text-center p-10">
                    <div class="text-2xl text-red-600">{{ $cancel_order }}</div>
                    Order Dibatalkan
                    <div class="text-2xl text-blue-600 mt-4">{{ $shipping_order }}</div>
                    Sedang Dikirim
                </div>
            </div>
            <div class="w-1/6 shadow-md h-60 bg-white">
                <div class="text-center p-10">
                    <div class="text-2xl text-red-600">{{ $userCount }}</div>
                    Jumlah Pengguna
                    <div class="text-2xl text-blue-600 mt-4">{{ $potential }}</div>
                    Pelanggan Potensial
                </div>
            </div>
            <div class="w-1/6 shadow-md h-60 bg-white">
                <div class="text-center p-10">
                    <div class="text-2xl text-red-600">{{ $message }}</div>
                    Penghasilan Kotor
                    <div class="text-2xl text-blue-600 mt-4">{{ $inbox }}</div>
                    Penghasilan Bersih
                </div>
            </div>
        </div>
        <div class="flex flex-row h-full mt-10 space-x-10">
            <!-- Table -->
            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">Proses Pesanan</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Member</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Produk</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Pembayaran</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Banyak Barang</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Bukti Bayar</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                @foreach($listOrder as $orderan)
                                <tr class="hover:bg-slate-200 cursor-pointer" onclick="location.href='{{route('admin.order.edit', $orderan->id)}}'"">
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex flex-col items-center">
                                            <div class="font-medium text-gray-800">{{ $orderan->user->username }}</div>
                                            <div class="text-sx">{{ $orderan->user->email }}</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">
                                            @foreach ($orderan->detail as $detail)
                                                <div class="text-gray-800">{{ $detail->product->name }}</div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500">{{ $orderan->total_price }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-lg text-center">{{ $orderan->detail->sum('total') }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-xs text-center">
                                        @if($orderan->image)
                                            Sudah Upload
                                        @else
                                            Belum diupload
                                         @endif    
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">Pesanan Baru</h2>
                </header>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Name</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Email</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-left">Spent</div>
                                    </th>
                                    <th class="p-2 whitespace-nowrap">
                                        <div class="font-semibold text-center">Country</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100">
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg" width="40" height="40" alt="Alex Shatov"></div>
                                            <div class="font-medium text-gray-800">Alex Shatov</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">alexshatov@gmail.com</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500">$2,890.66</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-lg text-center">🇺🇸</div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection