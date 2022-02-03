@extends('layout')

@section('title', 'Login | CubieBaby')

@section('content')
    <div class="container mx-auto mt-20">
        <div class="w-4/12 bg-white rounded-lg mx-auto p-10 shadow-2xl">
            <h1 class="text-2xl font-semibold text-blue-500 text-center">Login</h1>
            <form class="mt-10 flex flex-col" method="POST">
                @csrf

                <input type="email" name="email" placeholder="Email@email.com" class="border border-gray-400 rounded p-2" required value="{{ old('email') }}">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <input type="password" name="password" placeholder="Password" class="border border-gray-400 rounded p-2 mt-5" required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <button type="submit" class="bg-blue-500 text-white rounded p-2 mt-5">Login</button>
            </form>
            <div class="text-center mt-5">
                <a href="{{ route('register') }}" class="text-blue-500">Belum punya akun?</a>
            </div>
        </div>
    </div>
@endsection