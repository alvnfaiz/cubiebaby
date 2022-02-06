@extends('Admin.layout')

@section('content')
    <div class="container mx-auto mt-20">
        <a href="{{  route('admin.broadcast.create') }}"><button class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-sky-600">Tambah Broadcast</button></a>
            <div class="flex flex-col mt-6">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                      <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Pesan
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Gambar
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Penerima
                                </th>
                            </tr>
                        </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                             @php
                                 $i=1
                             @endphp
                            @foreach ($chats as $chat)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                        <span>{{  $i++ }}</span>
                                        </div>
                                        <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {!! $chat->value !!}
                                        </div>
                                        
                                        </div>
                                    </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{!! $chat->image !!}</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        @foreach ($chat->recipient as $user)
                                            <div class="text-sm text-gray-900">{{ $user->user->username }}</div>
                                            
                                        @endforeach

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