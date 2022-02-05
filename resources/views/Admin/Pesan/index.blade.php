@extends('Admin.layout')

@section('title', 'Pesan Masuk')

@section('content')
  <div class="flex flex-row flex-auto bg-white m-6 border-l shadow-xl h-5/6">
    <div class="flex flex-col w-1/5 ">
      <div class="flex-auto overflow-y-auto">

        @foreach ($inbox as $user)
            @if($user->latestMessage != null)
            <a class="block border-b" onclick="getMessage({{ $user->id }})">
                <div class="border-l-2 border-transparent hover:bg-gray-100 p-3 space-y-4">
                <div class="flex flex-row items-center space-x-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <strong class="flex-grow text-sm">{{ $user->username }}</strong>
                    <div class="text-sm text-gray-600">{{ $user->latestMessage->created_at }}</div>
                </div>
    
                <div class="flex flex-row items-center space-x-1">
                    <div class="flex-grow truncate text-xs">{{ $user->latestMessage->message }} </div>
                </div>
                </div>
            </a>
            @endif
        @endforeach

      </div>
    </div>


<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<div class="col-span-2 bg-white container mt-4 mx-auto hidden" id="textbox">
    <div class="w-full">

        <div class="w-full overflow-y-auto p-10 relative" style="height: 700px;" ref="toolbarChat">
            <ul>
                <li class="clearfix2" id="chat">
                    
                </li>
            </ul>
        </div>
        <form id="message_form">
        <div class="w-full py-3 px-3 flex items-center justify-between border-t border-gray-300">

            
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <input id="message" placeholder="Ketik Pesan"
                class="py-2 mx-3 pl-5 block w-full rounded-full bg-gray-100 outline-none focus:text-gray-700" type="text" name="message" required aria-id="0"/>

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
    function sendMessageAjaX(){
        $.ajax({
            url: '{{ route('admin.message.send') }}',
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                message: $('#message').val(),
                user_id: $('#message').attr('aria-id'),
            },
            success: function(data) {   
                console.log(data);
                if(data.image!=null){
                    $('#chat').append(
                        '<div class="w-full flex justify-end p-3">'+
                            '<img src="'+ data.image +'" class="w-64">'+
                            '<div class="bg-gray-100 border-r-4 border-gray-500 text-gray-700 p-4 mr-3 rounded-l-lg">'+
                                '<p class="text-sm">'+data.message+'</p>'+
                            '</div>'+
                        '</div>'
                    );
                }else{
                    $('#chat').append(
                        '<div class="w-full flex justify-end p-3">' +
                            '<div class="bg-gray-100 border-r-4 border-gray-500 text-gray-700 p-4 mr-3 rounded-l-lg">' +
                                '<p class="text-sm">' + data.message + '</p>' +
                            '</div>' +
                        '</div>'
                    );
                }
            }
        });
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

    function getMessage(id){
        $.ajax({
            url: '{{ route('admin.message.get') }}',
            type: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                user_id: id,
            },
            success: function(data) {
                console.log(data);
                //set attribute aria-id
                $('#message').attr('aria-id', id);
                //remove hidden attribute from id textbox
                $('#textbox').removeClass('hidden');
                $.each(data, function(index, value){
                    if(value.image!=null){
                        if(value.admin == 1){
                            $('#chat').append(
                                '<div class="w-full flex justify-end p-3">'+
                                    '<img src="'+ value.image +'" class="w-64">'+
                                    '<div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mr-3 rounded-l-lg">'+
                                        '<p class="text-sm" id="'+value.id+'">'+value.message+'</p>'+
                                    '</div>'+
                                '</div>'
                            );
                        }else{
                            $('#chat').append(
                                '<div class="w-full flex justify-start p-3">'+
                                    '<div class="bg-blue-100 border-r-4 border-blue-500 text-blue-700 p-4 ml-3 rounded-r-lg">'+
                                        '<p class="text-sm">'+value.message +'</p>'+
                                    '</div>'+
                                    '<img src="'+ value.image +'" class="w-64">'+
                                '</div>'
                            );
                        }
                    }else{
                        if(value.admin == 1){
                            $('#chat').append(
                                '<div class="w-full flex justify-end p-3">'+
                                    '<div class="bg-gray-100 border-r-4 border-gray-500 text-gray-700 p-4 mr-3 rounded-l-lg">'+
                                        '<p class="text-sm" id="'+value.id+'">'+value.message+'</p>'+
                                    '</div>'+
                                '</div>'
                            );
                        }else{
                            $('#chat').append(
                                '<div class="w-full flex p-3 justify-start">' +
                                    '<div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 ml-3 rounded-r-lg">' +
                                        '<p class="text-sm">' + value.message + '</p>' +
                                    '</div>' +
                                '</div>'
                            );
                        }
                    }
                });
            }
        });
    }

    setInterval(() => {
        $.ajax({
            url: '{{ route('admin.message.list') }}',
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
                            $('#chat').append(
                                '<div class="w-full flex justify-start p-3">'+
                                    '<img src="'+ chat.image +'" class="w-64">'+
                                    '<div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mr-3 rounded-r-lg">'+
                                        '<p class="text-sm">'+chat.message+'</p>'+
                                    '</div>'+
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
    }, 1000);
</script>
 
  </div>
  @endsection