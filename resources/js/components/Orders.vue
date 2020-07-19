<template>
  <div class="container">
    <table class="table table-stripped table-hover">
            <thead>
              <tr>
                <th class="text-center"># Pedido</th>
                <th class="text-center">Fecha</th>
                <th class="text-left">Cliente</th>
                <th class="text-center">Cantidad</th>
              </tr>
            </thead>

            <tbody>
              <tr v-if="records.length === 0">
                <td colspan="4" class="text-center">
                  No hay Existen Pedidos Actualmente
                </td>
              </tr>
              <tr v-for="item in records" v-bind:key="item.id">
                <th scope="row" class="text-center" >{{ item.id }}</th>
                <td class="text-center">
                     {{ item.orderdate }}
                </td>
                <td class="text-left">
                     {{ item.username }}
                </td>
                <td class="text-center"> {{ item.quantity }}
                </td>
           </tr>
            </tbody>
    </table>
    </div>
</template>

<script>
export default {
    name: "Orders",
    data(){
        return  {

            records: [],
        }

    },
    created(){
        this.read_records();
    },
    mounted() {

        Pusher.logToConsole = true;
        var self = this;
        var pusher = new Pusher('575fe64b2d524f039927', {
            cluster: 'us2',
            forceTLS: true,
                authEndpoint: '/broadcasting/auth',
        });

        var channel_message_orders = pusher.subscribe('message.orders');
        channel_message_orders.bind('SendMessageEvent', function(data) {

            self.push_records(data);

        });

    },
   methods: {
       push_records: function(data){
        //console.log(data[0].username);
           this.records.length = 0;

           data.forEach((element) =>

           this.records.push( {id : element.id , quantity : element.quantity , username : element.username , orderdate : element.orderdate  }));

       },
           async read_records()
       {
                var self = this;
                window.axios.get('/api/listorders').then(response => {

                        this.push_records(response.data);
                    })
                    .catch(e => {
                        console.log(e);
                    });
   },
}
}
</script>
