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
                    <div @click="getOrders()" :class="(active==`all`)?`col-md-3 col-6 p-2 orders-hover border-bottom border-dark border-3`:`col-md-3 col-6 p-2 orders-hover rounded-1`" style="cursor:pointer">
                        <h3 class="text-center m-0"><span class="fa fa-shopping-bag"></span></h3>
                        <h6 class="text-center m-0">All Ordered</h6>
                    </div>
                    <div @click="getMyOrdersStatus('PROCESSING')" :class="(active==`PROCESSING`)?`col-md-3 col-6 p-2 orders-hover border-bottom border-dark border-3`:`col-md-3 col-6 p-2 orders-hover rounded-1`" style="cursor:pointer">
                        <h3 class="text-center m-0"><span class="fa fa-cart-plus"></span></h3>
                        <h6 class="text-center m-0">Processing</h6>
                    </div>
                    <div @click="getMyOrdersStatus('SHIPPED')" :class="(active==`SHIPPED`)?`col-md-3 col-6 p-2 orders-hover border-bottom border-dark border-3`:`col-md-3 col-6 p-2 orders-hover rounded-1`" style="cursor:pointer">
                        <h3 class="text-center m-0"><span class="fa fa-shipping-fast"></span></h3>
                        <h6 class="text-center m-0">Shipped</h6>
                    </div>
                    <div @click="getMyOrdersStatus('DELIVERED')" :class="(active==`DELIVERED`)?`col-md-3 col-6 p-2 orders-hover border-bottom border-dark border-3`:`col-md-3 col-6 p-2 orders-hover rounded-1`" style="cursor:pointer">
                        <h3 class="text-center m-0"><span class="fa fa-box-open"></span></h3>
                        <h6 class="text-center m-0">Delivered</h6>
                    </div>
                    <div v-if="loading" class="col-md-12 p-5">
                        <div class="d-flex justify-content-center align-self-center">
                            <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                        </div>
                    </div>  
                    <div v-if="!loading" class="col-md-12 mt-2 table-responsive" >
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
                <div class="p-5">
                    <wishlist-card v-if="$store.state.auth.wishlist.length > 0" :item="$store.state.auth.wishlist[0]"></wishlist-card>
                </div>
                
                <router-link to="/myAccount/myWishlist"><h5><strong>View all >></strong></h5></router-link>
            </div>
        </div>             
    </div>

</div>
   
</template>

<script>
import wishlistCard from '../home/wishlistCard.vue'
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
export default {

    components:{
        PulseLoader,
        wishlistCard
    },
    data(){
        return{
            active:"all",
            orders:{},
            loading:true
        }
    },
    mounted(){
        this.getOrders()
    },
    methods:{
        async getOrders(){
            this.active = 'all'
            this.loading = true
            await axios.get('/getMyOrders')
            .then( response =>{
                this.orders = response.data
                this.loading = false
            })
        },
        async getMyOrdersStatus(status){
            this.active = status
            this.loading = true
            await axios.get('/getMyOrdersStatus/'+status)
            .then( response =>{
                this.orders = response.data
                this.loading = false
            })
        }
    }
}
</script>