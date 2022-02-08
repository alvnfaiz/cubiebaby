@extends('Admin.layout')
@section('title', 'Dashboard Admin - CubieBaby')
@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex flex-col space-x-4">
            <div class="text-md no-print">Laporan Penjualan Dari Tanggal</div>
            <form id="submit" class="no-print" method="POST" action="{{ route('admin.report.get') }}">
                @csrf
                <div class="flex items-center">
                    <div class="relative">
                          <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                              <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                          </div>
                          <input name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" autocomplete="false" value="{{ old('start', $startDate) }}">
                      </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div class="relative">
                      <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                          <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                      </div>
                      <input name="end" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" autocomplete="false" value="{{ old('end', $endDate) }}">
                  </div>
                  </div>
                <button type="submit" class="mt-4 bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600" onclick="requestReport()">
                    Submit
                </button>
            </form>
            <div class="my-4">
                <a onclick="print()" id="btnPrint"
                    class="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 no-print"
                    target="_blank">
                    Download PDF
                </a>
            </div>
            <div id="print">
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <h1 class="text-center text-2xl">Laporan Cubie Baby</h1>
                    <h4 class="text-center text-sm print mb-20">Jln Ketmumanggungan, Pasar papan Batusangkar</h4>

                    <span class=""> Dari Tanggal : {{ $startDate }} s/d {{ $endDate }}</span>
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nama Produk
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Modal
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Terjual
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Harga
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Pendapatan
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Keuntungan
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="report">
                                @foreach ($reports['products'] as $product)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-10 h-10">
                                                        <img class="w-full h-full"
                                                            src="{{ asset('storage/' . $product->image) }}"
                                                            alt="" />
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $product->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">Rp. {{ number_format($product->capital,2,',','.') }}</p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $product->total_order }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    Rp. {{ number_format($product->price,2,',','.') }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    Rp. {{ number_format($product->total_order*$product->price,2,',','.') }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <span
                                                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                    <span aria-hidden
                                                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">Rp. {{ number_format($product->total_order*$product->price - $product->total_order*$product->capital,2,',','.') }}</span>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                            
                        </table>

                        <div class="flex justify-between mt-20 print">
                            <div class="w-1/3">
                                
                            </div>
                            <div class="w-1/3">
                                
                            </div>
                            <div class="w-1/3 flex-col print-woi">
                                <span class="text-gray-600 mb-40">
                                    Batusangkar, {{ now()->format('d F Y') }}

                                </span>
                                <span class="text-gray-600">
                                    Cubie Baby
                                </span>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.3.2/dist/datepicker.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
        function requestReport() {
            var start = $('input[name="start"]').val();
            var end = $('input[name="end"]').val();
            $.ajax({
                url: '/admin/report',
                type: 'POST',
                data: {
                    start: start,
                    end: end
                },
                success: function(data) {
                    $('#report').html(data);
                }
            });
        }
    </script>

@endsection
