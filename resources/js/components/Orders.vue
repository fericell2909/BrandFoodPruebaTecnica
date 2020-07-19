<template>
    <div>
        <label class="label label-primary"> Esto es un Componente</label>   
    </div>
</template>

<script>
export default {
    name: "Orders",
    created() {
        console.log('Componente Creado');
    },
    mounted() {
        console.log('mounted');
        console.log(Echo);

        Pusher.logToConsole = true;

    var pusher = new Pusher('575fe64b2d524f039927', {
      cluster: 'us2',
      forceTLS: true,
        authEndpoint: '/broadcasting/auth',
    });

    /*
    var channel2 = pusher.subscribe('channel-orders');
    channel2.bind('MessageSentEvent', function(data) {
      //app.messages.push(JSON.stringify(data));
        console.log(JSON.stringify(data));
    });
    */


        Echo.private('private-SendMessageChannel')
           .listen('SendMessageEvent', function(data) {
      //app.messages.push(JSON.stringify(data));
        console.log(JSON.stringify(data));
    });

   },
}
</script>
