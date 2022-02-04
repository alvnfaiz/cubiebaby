@extends('Admin.layout')

@section('title', 'Product')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Product</h1>
            <form>
                <input type="text" name="search" placeholder="Search" class="border border-gray-400 rounded-lg p-2" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-500 text-white rounded-lg p-2 ml-2">Search</button>
            </form>
            <a href="{{ route('admin.product.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Create</a>
        </div>
        <table class="table-auto w-full mt-4">
            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                <tr>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left ml-6">Name Barang</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Kategori</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-left">Harga Jual | Harga Beli</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="font-semibold text-center">Gambar</div>
                    </th>
                    <th class="p-2 whitespace-nowrap">
                        <div class="mr-6">Aksi</div>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @foreach($product as $barang)
                <tr class="odd:bg-white even:bg-slate-100 px-6">
                    <td class="p-2 whitespace-nowrap">
                        <div class="flex flex-col ml-6">
                            <div class="font-medium text-gray-800">{{ $barang->name }}</div>
                            <div class="text-xs text-red-500 font-bold">Stock : {{ $barang->stock }}</div>
                        </div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-left">{{ $barang->category->name }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-left font-medium text-red-500">Rp. {{ $barang->price }} </div><div class="text-left font-medium text-green-500">Rp. {{ $barang->capital }}</div>
                    </td>
                    <td class="p-2 whitespace-nowrap">
                        <div class="text-center">
                            <img src="{{ asset('/storage/'.$barang->image) }}" alt="{{ $barang->name }}" class="w-32 mx-auto">
                        </div>
                    </td>
                    <td>
                        <div class="flex justify-end space-x-6 mr-6">
                            <a href="{{ route('admin.product.edit', $barang->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Edit</a>
                            <form action="{{ route('admin.product.delete', $barang->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection