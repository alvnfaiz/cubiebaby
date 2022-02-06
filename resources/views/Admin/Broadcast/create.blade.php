@extends('Admin.layout')

@section('content')
    <div class="container px-10 py-6 mx-auto mt-20 bg-white">
        <h2 class="text-2xl font-medium text-center text-blue-600">Buat BotChat</h2>
        <div class="mt-10">
            <div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('admin.broadcast.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="value" class="block text-sm font-medium text-gray-700">
                                            Balasan
                                        </label>
                                        <div class="flex mt-1 shadow-sm">
                                            <textarea name="value" id="editor">
                                                {{ old('value') }}
                                            </textarea>
                                        </div>
                                        @error('value')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <span class="block text-sm font-medium text-gray-700">
                                            Penerima
                                        </span>
                                        <div id="search">
                                            <div class="flex mt-1 shadow-sm">
                                                <input type="text" name="user_id" id="user_id" class="p-2" placeholder="Cari nama pengguna" autocomplete="off">
                                            </div>
                                            <div id="pencarian"></div>
                                        </div>
                                        <div id="id_penerima" class="flex flex-col">
                                            {{-- <input type="checkbox" name="receiver[]" id="receiver-0" value="0" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                            <label for="0" class="ml-2">Pelanggan Potensial</label> --}}
                                        </div>
                                        @error('user_id')
                                            <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                                        @enderror

                                        
                                    </div>
                                </div>
                            {{-- <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="send_at" class="block text-sm font-medium text-gray-700">
                                        Kirim Pada
                                    </label>
                                    <div class="flex mt-1 shadow-sm">
                                        <input type="date" value="{{ old('send_at') }}" name="send_at" id="send_at" class="form-input w-full">
                                    </div>
                                    @error('send_at')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                                </div>
                            </div> --}}

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            $('#user_id').keyup(function(){
                
            var username = $("#user_id").val();
            $.ajax({
                url: "{{ route('admin.username') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    username: username
                },
                success: function(data){
                    //foreach data
                    
                    $("#pencarian").html("");
                    console.log(data);
                    $.each(data, function(i, value){
                        $("#pencarian").append(
                            "<div class='flex items-center justify-between px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-900 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition ease-in-out duration-150'  onclick='addUser(\""+value.username+"\", "+value.id+")'>"+
                                "<div class='flex items-center'>"+
                                    "<div class='ml-3'>"+
                                        "<div class='text-sm leading-5 font-medium text-gray-900'>"+value.username+"</div>"+
                                    "</div>"+
                                "</div>"+
                            "</div>"
                            );
                        });
                    }
                });
            });
        });

        function addUser(username, id){
            //if id receiver value != 1 dont append
            if($('#receiver-'+id).val() != id ){
                $('#id_penerima').append(
                    "<input type='checkbox' name='receiver[]' id='receiver-"+id+"' value='"+id+"' class='form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out'>"+
                    "<label for='"+id+"' class='ml-2'>"+username+"</label>"
                );
            } 
        }
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection