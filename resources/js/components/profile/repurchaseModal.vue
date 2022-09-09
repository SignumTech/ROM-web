<template>
<div class="row p-4">
    <div v-if="!repurchased" class="col-md-12">
        <h5 class="text-center"><strong>Are you sure you want to repurchase the items in this order?</strong></h5>
    </div>
    <div v-if="!repurchased" class="col-md-6 mt-3">
        <button @click="$emit('close')" class="btn btn-secondary rounded-0 form-control fs-5">No</button>
    </div>
    <div v-if="!repurchased" class="col-md-6  mt-3">
        <button @click="repurchaseOrder()" class="btn btn-primary rounded-0 form-control fs-5">Yes</button>
    </div>
    <div v-if="repurchased" class="col-md-12">
        <h5 class="text-center"><strong>The items have been added to your shopping bag.</strong></h5>
    </div>
    <div v-if="repurchased" class="col-md-12 mt-3 text-center">
        <button @click="$emit('close')" class="btn btn-primary rounded-0 fs-5 px-5">OK</button>
    </div>
</div>
</template>
<script>
export default {
    props:['order_id'],
    data(){
        return{
            repurchased:false
        }
        
    },
    methods:{
        async repurchaseOrder(){
            await axios.post('/repurchaseOrder', {order_id:this.order_id})
            .then( response =>{
                this.$store.state.cart = JSON.parse(response.data.items)
                this.repurchased = true
            })
        }
    }
}
</script>