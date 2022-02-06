@extends('layout')

@section('title', 'Chat Dengan Admin | CubieBaby')

@section('content')
<div class="col-span-2 bg-white container mt-4 mx-auto">
    <div class="w-full">

        <div class="w-full overflow-y-auto p-10 relative" style="height: 700px;" ref="toolbarChat">
            <ul>
                <li class="clearfix2" id="chat">
                    @foreach ($chats as $chat)
                        @if($chat->admin == true)
                            @if($chat->image != null)
                                <div class="w-full flex justify-start p-3">
                                    <div class="flex flex-col">
                                        <img src="{{ asset('storage/'.$chat->image) }}" alt="" class="w-64">
                                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mr-3 rounded-r-lg">
                                            <p class="text-sm" id="{{ $chat->id }}">{!! $chat->message !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="w-full flex justify-start p-3">
                                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mr-3 rounded-r-lg">
                                        <p class="text-sm" id="{{ $chat->id }}">{!! $chat->message !!}</p>
                                    </div>
                                </div>
                            @endif
                        @else
                        @if($chat->image != null)
                                <div class="w-full flex justify-end p-3">
                                    <div class="flex flex-col">
                                        <img src="{{ asset('storage/'.$chat->image) }}" alt="" class="w-64">
                                        <div class="bg-gray-100 border-r-4 border-gray-500 text-gray-700 p-4 ml-3 rounded-l-lg">
                                            <p class="text-sm" id="{{ $chat->id }}">{!! $chat->message !!}</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            @else
                                <div class="w-full flex justify-end p-3">
                                    <div class="bg-gray-100 border-r-4 border-gray-500 text-gray-700 p-4 ml-3 rounded-l-lg">
                                        <p class="text-sm" id="{{ $chat->id }}">{!! $chat->message !!}</p>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </li>
            </ul>
        </div>
        {{-- <img id="preview" class="absolute inset-0 w-full h-32"> --}}
        <form id="message_form">
        <div class="w-full py-3 px-3 flex items-center justify-between border-t border-gray-300">
            {{-- <button class="outline-none focus:outline-none">
                <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </button>
            --}}
            <input type="file" id="image" style="display:none"/> 
            <span class="outline-none focus:outline-none ml-1" id="upload-image">
                <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
            </span>
            
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <input id="message" placeholder="Ketik Pesan"
                class="py-2 mx-3 pl-5 block w-full rounded-full bg-gray-100 outline-none focus:text-gray-700" type="text" name="message" required aria-id="{{ auth()->user()->id }}"/>

                <button class="outline-none focus:outline-none" type="submit">
                    <svg class="text-gray-400 h-7 w-7 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
<script>
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
                        '<div class="w-full flex justify-end p-3"><div class="flex flex-col">'+
                            '<img src=" '+ img +' " class="w-64">'+
                            '<div class="bg-gray-100 border-r-4 border-gray-500 text-gray-700 p-4 ml-3 rounded-l-lg">'+
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
                        '<div class="w-full flex justify-end p-3">' +
                            '<div class="bg-gray-100 border-r-4 border-gray-500 text-gray-700 p-4 ml-3 rounded-l-lg">' +
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
                                '<div class="w-full flex justify-start p-3"><div class="flex flex-col">'+
                                    '<img src="'+ img +'" class="w-64">'+
                                    '<div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mr-3 rounded-r-lg">'+
                                        '<p class="text-sm">'+chat.message+'</p>'+
                                    '</div></div>'+
                                '</div>'
                            );
                        }else{
                            $('#chat').append(
                                '<div class="w-full flex justify-start p-3">' +
                                    '<div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mr-3 rounded-r-lg">' +
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