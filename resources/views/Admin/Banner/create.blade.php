@extends('Admin.layout')

@section('content')
    <div class="container px-10 py-6 mx-auto mt-20 bg-white">
        <h2 class="text-2xl font-medium text-center text-blue-600">Buat Banner</h2>
        <div class="mt-10">
            <div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="#" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 space-y-6 bg-white sm:p-6">
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
                                                PNG, JPG up to 2MB | 1216px x 420 px
                                            </p>
                                        </div>
                                    </div>
                                    @error('image')
                                        <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="alt_text" class="block text-sm font-medium text-gray-700">
                                            Text
                                        </label>
                                        <div class="flex mt-1 shadow-sm">
                                            <input value="{{ old('alt_text') }}" type="text" name="alt_text" id="alt_text" class="flex-1 block w-full border border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-3 sm:col-span-2 flex flex-col">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <input type="radio" value="active" name="status" @if(old('status') == 'active') checked @endif>
                                    <label for="active" class="ml-2">Active</label>
                                    <input type="radio" value="inactive" name="status" @if(old('status') == 'inactive') checked @endif>
                                    <label for="inactive" class="ml-2">Inactive</label>
                                    @error('status')
                                        <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                                    @enderror
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