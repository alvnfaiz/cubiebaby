@extends('Admin.layout')

@section('content')
    <div class="container px-10 py-6 mx-auto mt-20 bg-white">
        <h2 class="text-2xl font-medium text-center text-blue-600">Input Ongkos Kirim</h2>
        <div class="mt-10">
            <div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('admin.shipping.store') }}" method="POST">
                        @csrf
                        <div class="sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 space-y-6 bg-white sm:p-6">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="city" class="block text-sm font-medium text-gray-700">
                                            Nama Kota
                                        </label>
                                        <div class="flex mt-1 shadow-sm">
                                            <input type="text" name="city" id="city" class="p-2 flex-1 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Nama Kota">
                                        </div>
                                        @error('city')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="cost" class="block text-sm font-medium text-gray-700">
                                            Cost
                                        </label>
                                        <div class="flex mt-1 shadow-sm">
                                            <input type="number" name="cost" id="cost" class="p-2 flex-1 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Ongkir">
                                        </div>
                                        @error('cost')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                                <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection