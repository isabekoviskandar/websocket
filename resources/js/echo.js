import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,  // Add the cluster
    encrypted: true,  // Optional, depends on your setup
});


document.addEventListener('DOMContentLoaded', function () {
    const messageList = document.getElementById('messageList');

    if (messageList) {
        window.Echo.channel('message')
            .listen('MessageEvent', (e) => {
                console.log(e);

                const newMessage = document.createElement('li');
                newMessage.innerText = e.message.message; // Adjust if the data structure differs
                messageList.prepend(newMessage);
            });
    } else {
        console.error('Element with id "messageList" not found.');
    }
});
