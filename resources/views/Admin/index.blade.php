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
                                @foreach($User as $pelanggan)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="font-medium text-gray-800">{{ $pelanggan->username }}</div>
                                            <div class="text-sx">{{ $pelanggan->email }}</div>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
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
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-06.jpg" width="40" height="40" alt="Philip Harbach"></div>
                                            <div class="font-medium text-gray-800">Philip Harbach</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">philip.h@gmail.com</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500">$2,767.04</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-lg text-center">🇩🇪</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-07.jpg" width="40" height="40" alt="Mirko Fisuk"></div>
                                            <div class="font-medium text-gray-800">Mirko Fisuk</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">mirkofisuk@gmail.com</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500">$2,996.00</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-lg text-center">🇫🇷</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-08.jpg" width="40" height="40" alt="Olga Semklo"></div>
                                            <div class="font-medium text-gray-800">Olga Semklo</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">olga.s@cool.design</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500">$1,220.66</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-lg text-center">🇮🇹</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-09.jpg" width="40" height="40" alt="Burak Long"></div>
                                            <div class="font-medium text-gray-800">Burak Long</div>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">longburak@gmail.com</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left font-medium text-green-500">$1,890.66</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-lg text-center">🇬🇧</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection