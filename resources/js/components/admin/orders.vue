<template>
<div class="row mt-4">
    <div class="col-md-12">
        <h5><strong>Orders</strong></h5>
    </div>
    <div class="col-md-12">
        <div class="bg-white shadow-sm p-2">
            <div class="row ms-0 me-0">
                <div @click="getAllOrders()" :class="(active==`all`)?`col-md-3 p-2 border-bottom border-dark border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                    <h5 class="text-center m-0"><span class="fa fa-shopping-bag"></span> All Ordered</h5>
                </div>
                <div @click="getProcessing()" :class="(active==`PROCESSING`)?`col-md-3 p-2 orders-hover border-bottom border-dark border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                    <h5 class="text-center m-0"><span class="fa fa-cart-plus"></span> Processing</h5>
                    
                </div>
                <div @click="getShipped()" :class="(active==`SHIPPED`)?`col-md-3 p-2 orders-hover border-bottom border-dark border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                    <h5 class="text-center m-0"><span class="fa fa-shipping-fast"></span> Shipped</h5>
                    
                </div>
                <div @click="getDelivered()" :class="(active==`DELIVERED`)?`col-md-3 p-2 orders-hover border-bottom border-dark border-3`:`col-md-3 p-2 orders-hover rounded-1`" style="cursor:pointer">
                    <h5 class="text-center m-0"><span class="fa fa-box-open"></span> Delivered</h5>
                    
                </div>            
            </div>
        </div>
    </div>
    <div v-if="loading" class="col-md-12">
        <div class="bg-white shadow-sm p-5">
            <div class="d-flex justify-content-center align-self-center">
                <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
            </div>            
        </div>

    </div> 
    <div v-if="!loading" class="col-md-12">
        <div class="bg-white shadow-sm p-2">
            
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
                            <td><router-link :to="`/admin/orderDetails/`+order.id">Order Details <span class="fa fa-external-link-alt"></span></router-link></td>
                        </tr>                        
                    </tbody>

                </table>
        </div>
    </div>
</div>  
</template>

<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
export default {
    components:{
            PulseLoader
        },
    data(){
        return{
            active:'all',
            orders:{},
            loading:true
        }
    },
    mounted(){
        this.getAllOrders()
    },
    methods:{
        async getAllOrders(){
            this.active = 'all'
            this.loading = true
            await axios.get('/orders')
            .then( response =>{
                this.orders = response.data
                this.loading = false
            })
        },
        async getProcessing(){
            this.active = 'PROCESSING'
            this.loading = true
            await axios.get('/getProcessing')
            .then( response =>{
                this.orders = response.data
                this.loading = false
            })
        },
        async getShipped(){
            this.active = 'SHIPPED'
            this.loading = true
            await axios.get('/getShipped')
            .then( response =>{
                this.orders = response.data
                this.loading = false
            })
        },
        async getDelivered(){
            this.active = 'DELIVERED'
            this.loading = true
            await axios.get('/getDelivered')
            .then( response =>{
                this.orders = response.data
                this.loading = false
            })
        }
    }
}
</script>
