<template>
<div class="col-md-9">
    <div class="row m-0">
        <div class="col-md-8">
            <div class="bg-white rounded-1 p-3">
                <h4 class="m-0"><b>Hi {{$store.state.auth.user.f_name}}!</b></h4>
            </div>
            <div class="bg-white rounded-1 p-3 mt-3">
                <h5 class="m-0"><b>My Orders</b></h5>
                <div class="row ms-0 me-0 mt-4">
                    <div @click="getOrders()" :class="(active==`all`)?`col-md-3 p-2 orders-hover rounded-1 border-bottom border-primary border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                        <h3 class="text-center m-0"><span class="fa fa-shopping-bag"></span></h3>
                        <h6 class="text-center m-0">All Ordered</h6>
                    </div>
                    <div @click="getMyOrdersStatus('PROCESSING')" :class="(active==`PROCESSING`)?`col-md-3 p-2 orders-hover rounded-1 border-bottom border-primary border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                        <h3 class="text-center m-0"><span class="fa fa-cart-plus"></span></h3>
                        <h6 class="text-center m-0">Processing</h6>
                    </div>
                    <div @click="getMyOrdersStatus('SHIPPED')" :class="(active==`SHIPPED`)?`col-md-3 p-2 orders-hover rounded-1 border-bottom border-primary border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                        <h3 class="text-center m-0"><span class="fa fa-shipping-fast"></span></h3>
                        <h6 class="text-center m-0">Shipped</h6>
                    </div>
                    <div @click="getMyOrdersStatus('DELIVERED')" :class="(active==`DELIVERED`)?`col-md-3 p-2 orders-hover rounded-1 border-bottom border-primary border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                        <h3 class="text-center m-0"><span class="fa fa-box-open"></span></h3>
                        <h6 class="text-center m-0">Delivered</h6>
                    </div>
                    <div class="col-md-12 mt-2">
                        <table class="table table-sm mt-2 table-borderless">
                            <tr v-for="order in orders" :key="order.id" class="border-top text-center">
                                <td>
                                    <img :src="`/storage/products/`+order.p_image" class="img img-fluid" style="width: 60px; height:auto" alt="">
                                </td>
                                <td>{{order.no_items}} items</td>
                                <td>{{order.total | numFormat}} ETB</td>
                                <td>{{order.order_status}}</td>
                                <td><router-link :to="`/myAccount/orderDetails/`+order.id">Order Details <span class="fa fa-external-link-alt"></span></router-link></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bg-white rounded-1 p-3">
                <h5 class="m-0"><b><span class="fa fa-heart"></span> Wishlist</b></h5>
            </div>
        </div>             
    </div>

</div>
   
</template>
<script>
export default {
    data(){
        return{
            active:"all",
            orders:{}
        }
    },
    mounted(){
        this.getOrders()
    },
    methods:{
        async getOrders(){
            this.active = 'all'
            await axios.get('/getMyOrders')
            .then( response =>{
                
                this.orders = response.data
            })
        },
        async getMyOrdersStatus(status){
            this.active = status
            await axios.get('/getMyOrdersStatus/'+status)
            .then( response =>{
                this.orders = response.data
            })
        }
    }
}
</script>