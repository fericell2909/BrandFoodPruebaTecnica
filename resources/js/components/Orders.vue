<template>
  <div class="container">
    <table class="table table-stripped table-hover">
            <thead>
              <tr>
                <th>Fecha</th>
                <th >Cliente</th>
                <th >Cantidad</th>
              </tr>
            </thead>

            <tbody>
              <tr v-if="records.length === 0">
                <td colspan="4" class="text-center">
                  No hay Existen Pedidos Actualmente
                </td>
              </tr>
              <tr v-for="item in records" v-bind:key="item.id">
                <th scope="row" v-show="false">{{ item.id }}</th>
                <td>
                     {{ item.orderdate }}
                </td>
                <td> {{ item.quantity }}
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
    created() {
        this.records = [];

        Pusher.logToConsole = true;

        var pusher = new Pusher('575fe64b2d524f039927', {
        cluster: 'us2',
        forceTLS: true,
            authEndpoint: '/broadcasting/auth',
        });

        var channel2 = pusher.subscribe('message.orders');
        channel2.bind('SendMessageEvent', function(data) {
        //app.messages.push(JSON.stringify(data));
                //console.log(JSON.stringify(data));
           // this.push_records(data);
            Swal.fire(data);
            //console.log(JSON.stringify(data));
            //console.log(data);
            this.records = data;
            console.log(this.records);
           //data.forEach((element) => this.records.push(new element));

        });



    },
   methods: {
       push_records: function($data){

           this.records.length = 0;
           $data.forEach((element) => this.records.push(new element));

       }
   },
}
</script>
