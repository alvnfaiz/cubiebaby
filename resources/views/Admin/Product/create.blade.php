@extends('Admin.layout')

@section('content')
    <div class="container px-10 py-6 mx-auto mt-20 bg-white shadow-xl">
        <h2 class="text-2xl font-medium text-center text-blue-600">Tambah Produk</h2>
        <div class="mt-10">
            <div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 space-y-6 bg-white sm:p-6">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="name" class="block text-sm font-medium text-gray-700">
                                            Nama Produk
                                        </label>
                                        <div class="flex mt-1 shadow-sm">
                                            <input type="text" name="name" id="name" class="flex-1 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" placeholder="Nama Produk" value="{{ old('name') }}">
                                        </div>
                                        @error('name')
                                            <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>                                            
                                        @enderror
                                    </div>
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="price" class="block text-sm font-medium text-gray-700">
                                            Harga
                                        </label>
                                        <div class="flex mt-1 shadow-sm">
                                            Rp.  <input type="number" step="any" name="price" id="price" class="flex-1 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" placeholder="120000"value="{{ old('price') }}">
                                        </div>
                                        @error('price')
                                            <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="capital" class="block text-sm font-medium text-gray-700">
                                            Modal
                                        </label>
                                        <div class="flex mt-1 shadow-sm">
                                            Rp.  <input type="number" step="any" name="capital" id="capital" class="flex-1 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" placeholder="120000"value="{{ old('capital') }}">
                                        </div>
                                        @error('capital')
                                            <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="stock" class="block text-sm font-medium text-gray-700">
                                            Stok
                                        </label>
                                        <div class="flex mt-1 shadow-sm">
                                            <input type="number" name="stock" id="stock" class="flex-1 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" placeholder="500" value="{{ old('stock') }}">
                                        </div>
                                        @error('stock')
                                            <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                                        @enderror
                                        
                                    </div>
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="id_category" class="block text-sm font-medium text-gray-700">Kategori</label>
                                        <select id="id_category" name="id_category" autocomplete="id_category" class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($category as $cat)
                                                @if(old('id_category') == $cat->id)
                                                    <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                                @else
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option> 
                                                @endif
                                            @endforeach
                                            
                                        </select>
                                        @error('id_category')
                                            <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                                        @enderror
                                        
                                    </div>
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                        <input type="radio" value="Available" name="status" @if(old('status') == 'Available') checked @endif>
                                        <label for="status" class="ml-2">Available</label>
                                        <input type="radio" value="Unvailable" name="status" @if(old('status') == 'Unavailable') checked @endif>
                                        <label for="status" class="ml-2">Unvailable</label>
                                        @error('status')
                                            <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">
                                            Deskripsi
                                        </label>
                                        <div class="mt-1">
                                            <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4">{{ old('deskripsi') }}</textarea>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">
                                            Silahkan diisi deskripsi barang anda.
                                        </p>
                                        @error('deskripsi')
                                            <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                                        @enderror
                                        
                                    </div>
                                    <div class="col-span-3 sm:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Foto Produk
                                        </label>
                                        <div class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center">
                                            <div class="flex text-sm text-gray-600">
                                                <label for="image" class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload a file</span>
                                                    <input id="image" name="image" type="file" accept="image/png, image/jpeg">
                                                </label>
                                                
                                            </div>
                                                <p class="text-xs text-gray-500">
                                                    PNG, JPG up to 2MB
                                                </p>
                                            </div>
                                        </div>
                                        @error('image')
                                            <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 text-right sm:px-6">
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