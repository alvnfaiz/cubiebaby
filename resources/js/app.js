const { default: axios } = require('axios');

require('./bootstrap');
// // const messages_el = document.getElementById('messages');
// // const username_input = document.getElementById('user_id');
// // const message_input = document.getElementById('message_input');
// // const message_form = document.getElementById('message_form');

// // message_form.addEventListener('submit', function(e){
// //     e.preventDefault();

// //     let has_error = false;
// //     if(message_input == ''){
// //         has_error = true;
// //         message_input.classList.add('border border-red-500');
// //     }
// //     if(has_error){
// //         return;
// //     }

// //     const options = {
// //         method: 'POST',
// //         url: '/api/message',
// //         data: {
// //             user_id: username_input.value,
// //             message: message_input.value
// //         }
// //     };

// //     axios(options);

// // })

// // window.Echo.channel('chat')
// //     .listen('.message', (e) => {
// //         console.log(e);
// //     });

// async fetchConversation() {
//     const response = await axios.get('/api/message').then((data)=> {
//         return console.log(data.data.messages);
//     })
// }


