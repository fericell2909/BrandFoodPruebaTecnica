<template>
    <div>

     <input type="text" class="form-control text-center"
                   placeholder="Escriba el Nombre y presione Enter" v-model="searchquery"/>
        <br>
        <div class="row">
            <article class="item  col-xs-12 col-sm-4 col-lg-3" v-for="item in items" v-bind:key="item.id">
                <div class="thumbnail">
                    <img class="image  item__image"
                        :src="item.linkimage" loading="lazy"  />
                        <div class="caption">
                            <p class="group inner list-group-item-heading text-center">
                                {{ item.description }}
                            </p>
                            <div class="row text-center">
                                <component-itemquantity
                                    :quantity="item.quantity"
                                    ttype="1" @click="ChangeQuantityItem()"
                                    @UpdteQuantityItem="UpdateQuantityItemProduct"
                                    :id="item.id" >
                                </component-itemquantity>
                                <label class="label label-primary"  >{{item.quantity}}</label>
                                <component-itemquantity
                                    :quantity="item.quantity"
                                    ttype="2"
                                    @click="ChangeQuantityItem()"
                                    @UpdteQuantityItem="UpdateQuantityItemProduct"
                                    :id="item.id">
                                </component-itemquantity>
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
                    <label for="" class="label label-primary">Detalle de Pedido</label>
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
.item__image{
    max-height: 80px;
    max-width: 80px;
}

.fab-container {
    position: fixed;
    bottom: 50px;
    right: 50px;
    z-index: 999;

}

.fab-icon-holder {
    width: 50px;
    height: 50px;
    border-radius: 100%;
    background: #016fb9;

    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.fab-icon-holder:hover {
    opacity: 0.8;
}

.fab-icon-holder i {
    display: flex;
    align-items: center;
    justify-content: center;

    height: 100%;
    font-size: 25px;
    color: #ffffff;
}

.fab {
    width: 60px;
    height: 60px;
    background: #d23f31;
}

.fab-options {
    list-style-type: none;
    margin: 0;

    position: absolute;
    bottom: 70px;
    right: 0;

    opacity: 0;

    transition: all 0.3s ease;
    transform: scale(0);
    transform-origin: 85% bottom;
}

.fab:hover+.fab-options,
.fab-options:hover {
    opacity: 1;
    transform: scale(1);
}

.fab-options li {
    display: flex;
    justify-content: flex-end;
    padding: 5px;
}

.fab-label {
    padding: 2px 5px;
    align-self: center;
    user-select: none;
    white-space: nowrap;
    border-radius: 3px;
    font-size: 16px;
    background: #ffffff;
    color: #666666;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    margin-right: 10px;
}

 #mute {
        position: absolute;
      }
      #mute.on {
        opacity: 0.7;
        z-index: 1000;
        background: white;
        height: 100%;
        width: 100%;
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
            totalAmount(t){

                let total = 0;
                this.recordsorders.forEach( function(value, indice, array) {
                total = total + value.quantity;
            });

            return total.toFixed(0);

            },
            registerOrder(){

                window.axios.get('/clientsorder').then(response => {
                        //console.log(response.data);
                        //let data = response.data;
                        //data.forEach(product => this.records.push({id : product.id , quantity : 0 , description : product.description, linkimage : product.linkimage })
                        console.log(response);

                    })
                    .catch(e => {
                        console.log(e);
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
