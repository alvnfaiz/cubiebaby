@extends('Admin.layout')

@section('content')
    <div class="container mx-auto mt-20">
        <a href="{{  route('admin.shipping.create') }}"><button class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-sky-600">Tambah Ongkir</button></a>
            <div class="flex flex-col mt-6">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                      <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Kota
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Ongkos Kirim
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Banyak Order
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                             @php
                                 $i=1
                             @endphp
                            @foreach ($shippings as $shipping)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                        <span>{{  $i++ }}</span>
                                        </div>
                                        <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $shipping->city }}
                                        </div>
                                        
                                        </div>
                                    </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $shipping->cost }}</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $shipping->order->count() }}</div>
                                    </td>
                                    
                                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    <a href="{{ route('admin.shipping.edit', $shipping->id) }}" class="text-indigo-600 hover:text-blue-400">Edit</a>
                                    <a href="#" class="ml-8 text-red-600 hover:text-red-400">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                          
                          <!-- More people... -->
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
    </div>
@endsection