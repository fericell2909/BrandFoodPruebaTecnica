<template>
    <div class="d-inline">
        <button  @click="ChangeQuantityItem" 
                type="button" 
                class="btn btn-default btn-sm"
                 data-toggle="tooltip" data-placement="left" :title="tooltipsymbol"
                > <em>{{symbol}}</em>
        </button>  
    </div>
</template>
<style>
.d-inline
{
    display :inline-block;
}
</style>
<script> 
export default {
    name: "ItemQuantity",
    props: ["ttype","quantity","id"],
    data(){
        return {  symbol: '' , tooltipsymbol : '' }
    },
    methods: {
        ChangeQuantityItem :  function(){            
            let quantity =  this.quantity;
   
            if(this.ttype == 1){
                    quantity = quantity + 1;
            } else
                {
                    quantity = quantity - 1;
                } 

                if(quantity < 0)
                {

                    Swal.fire('La Cantidad No puede ser Menor que Cero.');
                } else
                {       
                    // console.log('New Quantity : ' + quantity)             
                    let item = { id : this.id , quantity : quantity}

                    this.$emit('UpdteQuantityItem', item)
                
                }
        },
    },
    mounted(){
        if(this.ttype == 1)
        {
            this.symbol = '+';
            this.tooltipsymbol = 'Agregar';
        } else
        {
            this.symbol = '-'
            this.tooltipsymbol = 'Disminuir';
        }
    }
}
</script>
