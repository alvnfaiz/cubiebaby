@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="px-3 py-2 mt-10">
        @if($errors->any())
            <div id="error-box">
                @foreach($errors as $error)
                    <p class="mt-2 text-xs italic text-red-500">{{ $error->message }}</p>
                @endforeach
            </div>
        @endif
        @if(session()->get('success'))
            <div id="success-box">
                <p class="mt-2 text-xs italic text-green-500">{{ session()->get('success') }}</p>
            </div>
        @endif
        @if(session()->get('error'))
            <div id="error-box">
                <p class="mt-2 text-xs italic text-red-500">{{ session()->get('error') }}</p>
            </div>
        @endif
        <form method="POST">
            @csrf
            @method('put')
            <div class="mb-6 w-full group">
                
                <label for="email" class="ext-sm text-gray-500 dark:text-gray-400 duration-300 transform  -z-10 origin-[0]">Email address</label>
                <input type="email" name="email" class="block pt-4 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('email', auth()->user()->email) }}"/>
                @error('email')
                    <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 w-full group">
                
                <label for="username" class="ext-sm text-gray-500 dark:text-gray-400 duration-300 transform  -z-10 origin-[0]">Username</label>
                <input type="text" name="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('username', auth()->user()->username) }}"/>
                @error('username')
                    <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 w-full group">
                <label for="password" class="ext-sm text-gray-500 dark:text-gray-400 duration-300 transform  -z-10 origin-[0]">Password</label>
                <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                @error('password')
                    <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 w-full group">
                <label for="new_password" class="ext-sm text-gray-500 dark:text-gray-400 duration-300 transform  -z-10 origin-[0]">Password Baru</label>
                <input type="password" name="new_password" id="new_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                @error('new_password')
                    <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 w-full group">
                <label for="confirm_password" class="ext-sm text-gray-500 dark:text-gray-400 duration-300 transform  -z-10 origin-[0]">Konfirmasi Password Baru</label>
                <input type="password" name="confirm_password" id="confirm_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
                @error('confirm_password')
                    <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 w-full group">
                <label for="address" class="ext-sm text-gray-500 dark:text-gray-400 duration-300 transform  -z-10 origin-[0]">Kota Alamat</label>
                <input type="text" name="address" id="address" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="{{ old('address', auth()->user()->address) }}"/>
                @error('address')
                    <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-span-3 sm:col-span-2 flex flex-col">
                <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>

                <label class="ml-2"><input type="radio" value="Pria" name="gender"
                        @if (old('gender', $user->gender) == 'Pria') 
                            checked 
                        @endif>
                    Pria</label>

                <label class="ml-2"><input type="radio" value="Wanita" name="gender"
                        @if (old('gender', $user->gender) == 'Wanita') 
                            checked 
                        @endif>
                    Wanita</label>
                @error('gender')
                    <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid xl:grid-cols-2 xl:gap-6 mt-4">
              <div class="mb-6 w-full group">
                <label for="phone_number" class="ext-sm text-gray-500 dark:text-gray-400 duration-300 transform  -z-10 origin-[0]" >Phone number</label>
                  <input type="text" name="phone_number" id="phone_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('phone_number', auth()->user()->phone_number) }}"/>
                  @error('phone_number')
                  <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
              @enderror
              </div>
              <div class="mb-6 w-full group">
                <label for="birth_date" class="ext-sm text-gray-500 dark:text-gray-400 duration-300 transform  -z-10 origin-[0]">Tanggal Lahir</label>
                  <input type="date" name="birth_date" id="birth_date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('birth_date', auth()->user()->birth_date) }}"/>
                  @error('birth_date')
                  <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
              @enderror
                </div>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
          </form>
    </div>


</div>
@endsection