@extends('layout')

@section('title', 'Chat Dengan Admin | CubieBaby')

@section('content')
<div class="container col-span-2 mx-auto mt-4 bg-white">
    <div class="w-full">

        <div class="relative w-full p-10 overflow-y-auto" style="height: 700px;" ref="toolbarChat">
            <ul>
                <li class="clearfix2" id="chat">
                    @foreach ($chats as $chat)
                        @if($chat->admin == true)
                            @if($chat->image != null)
                                <div class="flex justify-start w-full p-3">
                                    <div class="flex flex-col">
                                        <img src="{{ asset('storage/'.$chat->image) }}" alt="" class="w-64">
                                        <div class="p-4 mr-3 text-blue-700 bg-blue-100 border-l-4 border-blue-500 rounded-r-lg">
                                            <p class="text-sm" id="{{ $chat->id }}">{!! $chat->message !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="flex justify-start w-full p-3">
                                    <div class="p-4 mr-3 text-blue-700 bg-blue-100 border-l-4 border-blue-500 rounded-r-lg">
                                        <p class="text-sm" id="{{ $chat->id }}">{!! $chat->message !!}</p>
                                    </div>
                                </div>
                            @endif
                        @else
                        @if($chat->image != null)
                                <div class="flex justify-end w-full p-3">
                                    <div class="flex flex-col">
                                        <img src="{{ asset('storage/'.$chat->image) }}" alt="" class="w-64">
                                        <div class="p-4 ml-3 text-gray-700 bg-gray-100 border-r-4 border-gray-500 rounded-l-lg">
                                            <p class="text-sm" id="{{ $chat->id }}">{!! $chat->message !!}</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            @else
                                <div class="flex justify-end w-full p-3">
                                    <div class="p-4 ml-3 text-gray-700 bg-gray-100 border-r-4 border-gray-500 rounded-l-lg">
                                        <p class="text-sm" id="{{ $chat->id }}">{!! $chat->message !!}</p>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </li>
            </ul>
        </div>
        <div class="chatbox">
            <button class="px-4 py-2 text-blue-600 bg-white border-2 border-blue-600 rounded-full" onclick="send('selamat pagi');">
                Selamat Pagi
            </button>
            <button class="px-4 py-2 text-blue-600 bg-white border-2 border-blue-600 rounded-full" onclick="send('apakah produk masih tersedia');">
                Apakah Produk Masih Tersedia?
            </button>
            <button class="px-4 py-2 text-blue-600 bg-white border-2 border-blue-600 rounded-full" onclick="send('Status pengiriman barang saya bagaimana');">
                Status pengiriman saya bagaimana
            </button>
        </div>
        {{-- <img id="preview" class="absolute inset-0 w-full h-32"> --}}
        <form id="message_form">
        <div class="flex items-center justify-between w-full px-3 py-3 border-t border-gray-300">
            {{-- <button class="outline-none focus:outline-none">
                <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </button>
            --}}
            <input type="file" id="image" style="display:none"/> 
            <span class="ml-1 outline-none focus:outline-none" id="upload-image">
                <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
            </span>
            
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <input id="message" placeholder="Ketik Pesan"
                class="block w-full py-2 pl-5 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700" type="text" name="message" required aria-id="{{ auth()->user()->id }}"/>

                <button class="outline-none focus:outline-none" type="submit" id="submit-pesan">
                    <svg class="text-gray-400 origin-center transform rotate-90 h-7 w-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
<script>
    function send(message) {
        $('#message').val(message);
        $('#submit-pesan').click();
    }
    
    $('#upload-image').click(function(){ $('#image').trigger('click') }); 
    function sendMessageAjaX(){
        //jika id image tidak kosong
        if($('#image').val() != ''){
            //maka ajax
            var fd = new FormData();
            fd.append('message', $('#message').val());
            fd.append('user_id', $('#user_id').val());
            fd.append('image', $('#image')[0].files[0]);
            $.ajax({
                url: '{{ route('message.send') }}',
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    //maka append ke chat
                    img = "storage/" + data.image ;
                    $('#chat').append(
                        '<div class="flex justify-end w-full p-3"><div class="flex flex-col">'+
                            '<img src="/storage/'+ data.image +' " class="w-64">'+
                            '<div class="p-4 ml-3 text-gray-700 bg-gray-100 border-r-4 border-gray-500 rounded-l-lg">'+
                                '<p class="text-sm" id="' + data.id + '">'+data.message+'</p>'+
                            '</div></div>'+
                        '</div>'
                    );
                    //maka kosongkan image
                    $('#image').val('');
                }
            });
        }else{
            $.ajax({
                url: '{{ route('message.send') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    message: $('#message').val(),
                    user_id: $('#message').attr('aria-id'),
                    image: $('#image').val(),
                },
                success: function(data) {   
                console.log(data);
                    //scroll to bottom #chat
                    
                    $('#chat').append(
                        '<div class="flex justify-end w-full p-3">' +
                            '<div class="p-4 ml-3 text-gray-700 bg-gray-100 border-r-4 border-gray-500 rounded-l-lg">' +
                                '<p class="text-sm" id="' + data.id + '">' + data.message + '</p>' +
                            '</div>' +
                        '</div>'
                    );
                    $("#chat").animate({
                        scrollTop: $("#" + data.id).position().top
                    }, 1000);   
                }
            });
        }
    }
    $('#message').keydown(function (e){
        if(e.keyCode == 13){
            //jika #message not null
            if($('#message').val() != ''){
                sendMessageAjaX();
                $('#message').val('');
            }
        }
    })
    //submit onclick
    $('button[type="submit"]').click(function(e){
        e.preventDefault();
        if($('#message').val() != ''){
            sendMessageAjaX();
            $('#message').val('');
        }
    });

    setInterval(() => {
        $.ajax({
            url: '{{ route('message.get') }}',
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                user_id: $('#message').attr('aria-id'),
            },
            success: function(data) {
                if(data.success){
                    //foreach data.chats append to chat
                    data.chats.forEach(function(chat){
                        if(chat.image!=null){
                            img = "storage/" + chat.image ;
                            $('#chat').append(
                                '<div class="flex justify-start w-full p-3"><div class="flex flex-col">'+
                                    '<img src="'+ img +'" class="w-64">'+
                                    '<div class="p-4 mr-3 text-blue-700 bg-blue-100 border-l-4 border-blue-500 rounded-r-lg">'+
                                        '<p class="text-sm">'+chat.message+'</p>'+
                                    '</div></div>'+
                                '</div>'
                            );
                        }else{
                            $('#chat').append(
                                '<div class="flex justify-start w-full p-3">' +
                                    '<div class="p-4 mr-3 text-blue-700 bg-blue-100 border-l-4 border-blue-500 rounded-r-lg">' +
                                        '<p class="text-sm">' + chat.message + '</p>' +
                                    '</div>' +
                                '</div>'
                            );
                        }
                    });
                }else{
                    return false;
                }
            }
        });
    }, 5000);
</script>

@endsection