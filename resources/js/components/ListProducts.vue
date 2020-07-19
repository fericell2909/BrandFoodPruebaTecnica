<template>
    <div>

     <input type="text" class="form-control text-center"
                   placeholder="Escriba el Nombre y presione Enter" v-model="searchquery"/>
        <br>
        <div class="row">
            <article class="item  col-xs-1 col-sm-4 col-lg-3" v-for="item in items" v-bind:key="item.id">
                <div class="thumbnail item__container" >
                    <img class="image  item__image"
                        :src="item.linkimage" loading="lazy"  />
                        <div class="caption">
                            <p class="group inner list-group-item-heading text-center">
                                {{ item.description }}
                            </p>
                            <div class="row">
                            <div class="col-md-12 text-center">
                                <component-itemquantity
                                    :quantity="item.quantity"
                                    ttype="1" @click="ChangeQuantityItem()"
                                    @UpdteQuantityItem="UpdateQuantityItemProduct"
                                    :id="item.id" class="mr-1">
                                </component-itemquantity>
                                <label class="label label__item__quantity ml-4"   >{{item.quantity}}</label>
                                <component-itemquantity
                                    :quantity="item.quantity"
                                    ttype="2"
                                    @click="ChangeQuantityItem()"
                                    @UpdteQuantityItem="UpdateQuantityItemProduct"
                                    :id="item.id" class="ml-4">
                                </component-itemquantity>
                            </div>
                            </div>
                        </div>
                </div>
        </article>
        <div v-if="items.length === 0" class="alert alert-success">
                  No hay productos para realizar pedido
        </div>
        <div class="fab-container" >
            <div class="fab fab-icon-holder">
                <i class="fa fa-plus-circle"
                    aria-hidden="true"></i>
            </div>
            <ul class="fab-options">
                <li>
                    <span class="fab-label" id="Order">
                    <label for="" class="label order__tittle">Detalle de Pedido</label>
                        <div v-if="recordsorders.length === 0" class="alert alert-success">
                            Aun no ha Agregago un Producto
                         </div>
                        <table class="table table-stripped table-hover">
                                <thead v-if="recordsorders.length != 0">
                                    <tr>
                                        <th>Producto</th>
                                        <th >Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="oitem in recordsorders" v-bind:key="oitem.id">
                                        <td class="text-left">{{ oitem.description }}</td>
                                        <td class="text-center">{{ oitem.quantity }}</td>
                                    </tr>
                                </tbody>

                                <tfoot v-if="recordsorders.length != 0">
                                    <tr class="text-info">
                                        <td class="text-right">Total</td>
                                        <td class="text-center">{{ totalAmount(2) }}</td>
                                    </tr>
                                </tfoot>
                        </table>
                        <button v-if="recordsorders.length != 0" class="btn btn-success btn-block" v-on:click="registerOrder">Registrar Pedido</button>
                    </span>
                </li>
            </ul>
        </div>
        </div>
    </div>
</template>
<style>
    .item
    {
        display: flex;
        flex-flow: row wrap;
       justify-content: flex-start;
    }
    .item__container
    {
        flex: 1
    }
    .item__image
    {
        width: 100px;
        height: 100px;
    }
</style>

<script>
    export default {
        data() {
                return {
                    NewEntry : {
                                    id: 0,
                                    quantity : 0
                                    },
                    records : [] ,
                    alertmessage : '',
                    searchquery : '',
                    recordsorders : [],
                    mute: false,
                }
            },

        created() {
            this.read_records();
          },
          mounted(){
                console.log('mounted');
          },
          watch: {
                mute(val) {
                document.getElementById('mute').className = val ? "on" : "";
                }
            },
        computed: {
            items :  function ()
                {

                    if(this.searchquery ){
                        return this.records.filter((item)=>{
                        return item.description.startsWith(this.searchquery) ;
                        })
                        }else{
                            return this.records;
                        }
                },
            },
        methods : {
            UpdateQuantityItemProduct : function(item)
                {
                    //console.log(item);
                this.records.forEach(function(element, index) {
                    if(element.id === item.id)
                    {
                        element.quantity = item.quantity;
                        item.description = element.description;
                    }
                });

                this.GenerateOrder(item);

            },
            GenerateOrder : function (item)
            {
                this.recordsorders.length = 0;
                //let data = response.data;

                this.records.forEach( element => {

                        if(element.quantity > 0)
                        {
                            this.recordsorders.push({id : element.id , description : element.description , quantity : element.quantity});
                        }
                    });

            },
            resetRecords(){

                this.records.forEach((element) => { element.quantity = 0 });
                this.recordsorders.forEach((element) => { element.quantity = 0 });
                this.recordsorders.length = 0;
            },
            totalAmount(t){

                let total = 0;
                this.recordsorders.forEach( function(value, indice, array) {
                total = total + value.quantity;
            });

            return total.toFixed(0);

            },
            registerOrder(){
                let records_post =  this.recordsorders;
                let self = this;
                window.axios.post('/api/clientsorder', {
                        data: records_post
                    }).then(response => {
                            let data = response.data;
                            Swal.fire(data.message);
                            //self.resetRecords();
                    })
                    .catch(e => {
                        Swal.fire(e);
                    }).then(function() {
                        self.resetRecords();
                    });

            },
            async  read_records() {

                window.axios.get('/api/listproducts').then(response => {
                        //console.log(response.data);
                        let data = response.data;
                        data.forEach(product => this.records.push({id : product.id , quantity : 0 , description : product.description, linkimage : product.linkimage })
                        );
                    })
                    .catch(e => {
                        console.log(e);
                    })
            }
        }
    }
</script>
