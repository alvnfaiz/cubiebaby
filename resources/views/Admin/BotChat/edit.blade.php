@extends('Admin.layout')

@section('content')
    <div class="container px-10 py-6 mx-auto mt-20 bg-white">
        <h2 class="text-2xl font-medium text-center text-blue-600">Buat BotChat</h2>
        <div class="mt-10">
            <div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('admin.botchat.store') }}" method="POST">
                        @csrf
                        <div class="sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 space-y-6 bg-white sm:p-6">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="message" class="block text-sm font-medium text-gray-700">
                                            Pesan
                                        </label>
                                        <div class="flex mt-1 shadow-sm">
                                            <input value="{{ old('message', $bot->message) }}" type="text" name="message" id="message" class="p-2 flex-1 block w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Nama Pesan yang akan dibalas">
                                        </div>
                                        @error('message')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="reply" class="block text-sm font-medium text-gray-700">
                                            Balasan
                                        </label>
                                        <div class="flex mt-1 shadow-sm">
                                            <textarea name="reply" id="editor">
                                                {{ old('reply', $bot->reply) }}
                                            </textarea>
                                        </div>
                                        @error('reply')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <input type="radio" value="active" name="status" @if(old('status', $bot->status) == 'active') checked @endif>
                                    <label for="status" class="ml-2">Active</label>
                                    <input type="radio" value="inactive" name="status" @if(old('status', $bot->status) == 'inactive') checked @endif>
                                    <label for="status" class="ml-2">Inactive</label>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection