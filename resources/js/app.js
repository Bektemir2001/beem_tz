import './bootstrap';



window.Echo.channel('public-channel')
    .listen('.record_created', (e) => {
        alert(`created new record Name: ${e.record}    type: ${e.type}`);
    });
