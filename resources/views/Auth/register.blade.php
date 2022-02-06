@extends('layout')

@section('title', 'Login | CubieBaby')

@section('content')
    <div class="container mx-auto mt-20">
        <div class="w-4/12 bg-white rounded-lg mx-auto p-10 shadow-2xl">
            <h1 class="text-2xl font-semibold text-blue-500 text-center">Register</h1>
            <form class="mt-10 flex flex-col" method="POST">
                @csrf
                <label for="email" class="text-sm font-medium text-gray-700 mt-4">Email</label>
                <input type="email" name="email" placeholder="Email@email.com" class="border border-gray-400 rounded p-2" required value="{{ old('email') }}">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <label for="username" class="text-sm font-medium text-gray-700 mt-4">Username</label>
                <input type="text" name="username" placeholder="Username" class="border border-gray-400 rounded p-2" required value="{{ old('username') }}">
                @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                    <label for="phone_number" class="text-sm font-medium text-gray-700 mt-4">Phone Number</label>
                    <input type="text" name="phone_number" placeholder="+62xxx xxxx xxxx" class="border border-gray-400 rounded p-2" required value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <label for="birth_date" class="text-sm font-medium text-gray-700 mt-4">Tanggal Lahir</label>
                    <input type="date" max="{{ now() }}" name="birth_date" class="border border-gray-400 rounded p-2" required value="{{ old('birth_date') }}">
                    @error('birth_date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                <div class="w-full">
                    <label for="gender" class="block text-sm font-medium text-gray-700 mt-4">Jenis Kelamin</label>
                    <input type="radio" value="Pria" name="gender" @if(old('gender') == 'Pria') checked @endif>
                    <label for="gender" class="ml-2">Pria</label>
                    <input type="radio" value="Wanita" name="gender" @if(old('gender') == 'Wanita') checked @endif>
                    <label for="gender" class="ml-2">Wanita</label>
                    @error('gender')
                        <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mt-4">Password</label>
                    <input type="password" name="password" placeholder="Password" class="border border-gray-400 rounded p-2" required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mt-4">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="border border-gray-400 rounded p-2" required>
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                <label for="address" class="block text-sm font-medium text-gray-700 mt-4">Kota Asal</label>
                <input type="text" name="address" placeholder="Kota Tinggal" class="border border-gray-400 rounded p-2" required value="{{ old('address') }}">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                

                
                <button type="submit" class="bg-blue-500 text-white rounded p-2 mt-5">Register</button>
            </form>
            <div class="text-center mt-5">
                <a href="{{ route('login') }}" class="text-blue-500">Sudah punya akun?</a>
            </div>
        </div>
    </div>
@endsection