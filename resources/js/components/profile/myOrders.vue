<template>
<div class="col-md-9">
    <div class="row m-0">
        <div class="col-md-12">
            <h4 class="text-center"><strong>My Orders</strong></h4>
        </div>
    </div>
    <div class="bg-white rounded-1 p-3 mt-3">
        <div class="row ms-0 me-0 mt-4">
            <div @click="getOrders()" :class="(active==`all`)?`col-md-3 p-2 border-bottom border-dark border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                <h5 class="text-center m-0"><span class="fa fa-shopping-bag"></span> All Ordered</h5>
            </div>
            <div @click="getMyOrdersStatus('PROCESSING')" :class="(active==`PROCESSING`)?`col-md-3 p-2 orders-hover border-bottom border-dark border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                <h5 class="text-center m-0"><span class="fa fa-cart-plus"></span> Processing</h5>
                
            </div>
            <div @click="getMyOrdersStatus('SHIPPED')" :class="(active==`SHIPPED`)?`col-md-3 p-2 orders-hover border-bottom border-dark border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                <h5 class="text-center m-0"><span class="fa fa-shipping-fast"></span> Shipped</h5>
                
            </div>
            <div @click="getMyOrdersStatus('DELIVERED')" :class="(active==`DELIVERED`)?`col-md-3 p-2 orders-hover border-bottom border-dark border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                <h5 class="text-center m-0"><span class="fa fa-box-open"></span> Delivered</h5>
                
            </div>
            <div v-if="loading" class="col-md-12 p-5 mt-4">
                <div class="d-flex justify-content-center align-self-center">
                    <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                </div>
            </div>  
            <div v-if="!loading" class="col-md-12 mt-4">
                <table v-for="order in orders" :key="order.id" class="table table-sm mt-2 table-bordered">
                    <thead>
                        <tr>
                            <th >Order No. {{order.order_no}}</th>
                            <th colspan="6">Order date. {{order.created_at | moment("ddd, MMM Do YYYY")}}</th>
                        </tr>                        
                    </thead>

                    <tbody>
                        <tr class="border-bottom text-center align-middle">
                            <td>
                                <img :src="`/storage/products/`+order.p_image" class="img img-fluid" style="width: 60px; height:auto" alt="">
                            </td>
                            <td>{{order.no_items}} items</td>
                            <td>{{order.total | numFormat}} ETB</td>
                            <td>{{order.order_status}}</td>
                            <td><button @click="repurchaseModal(order.id)" class="btn btn-outline-success rounded-0 px-3">Repurchase</button></td>
                            <td><router-link :to="`/myAccount/orderDetails/`+order.id">Order Details <span class="fa fa-external-link-alt"></span></router-link></td>
                        </tr>                        
                    </tbody>

                </table>
                
            </div>
        </div>
    </div>
</div>
</template>
<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

import repurchaseModalVue from './repurchaseModal.vue'
export default {
    props:['orderStatus'],
    components:{
        PulseLoader
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
        repurchaseModal(order_id){
            this.$modal.show(
                repurchaseModalVue,
                {'order_id':order_id},
                {width:"400px", height:"auto"},
                {"closed": this.refreshPage}
            )
        },
        refreshPage(){
            window.location.replace('/cart')
        },
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