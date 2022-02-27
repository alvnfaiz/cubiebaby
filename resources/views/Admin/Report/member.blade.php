@extends('Admin.layout')
@section('title', 'Dashboard Admin - CubieBaby')
@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex flex-row p-10">
            <div class="bg-white p-8 rounded-md w-full">
                <div class=" flex items-center justify-between pb-6">
                    <div>
                        <h2 class="text-gray-600 font-semibold">Laporan Pelanggan CubieBaby</h2>
                        <span class="text-xs">Pelanggan yang telah melakukan order produk</span>
                    </div>
                </div>
                <div>
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <h2 class="text-xl text-gray-800">Jumlah Orderan : <span class="text-blue-500">{{ $reports['total'] }}</span></h2>
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Pelanggan
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Total Belanja
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Total Pembayaran
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports['users'] as $user)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">

                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $user->username }} | {{ $user->email }}
                                                        </p>
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            Jumlah Orderan : {{ $user->login->login_count }}
                                                        </p>
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            Terakhir Login :{{ $user->login->last_login }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $user->total_order}}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    Rp. {{ number_format($user->total_price,2,',','.') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
