<template>
<div class="col-md-9">
    <div class="bg-white rounded-1 p-3">
        <div v-if="loading" class="row m-0">
            <div class="col-md-12 p-5 mt-4">
                <div class="d-flex justify-content-center align-self-center">
                    <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                </div>
            </div> 
        </div>
        <div v-if="!loading" class="row m-0">
            <div class="col-md-12">
                <h4 class="text-center"><strong>ORDER DETAILS</strong></h4>
            </div>
            <div class="col-md-6 mt-5">
                <h6 class="text-center">Order No.</h6>
                <h5 class="text-center"><strong>{{order.order_no}}</strong></h5>
            </div>
            <div class="col-md-6 mt-5 border-start">
                <h6 class="text-center">Order Date</h6>
                <h5 class="text-center"><strong>{{order.created_at | moment("ddd, MMM Do YYYY")}}</strong></h5>
            </div> 
            <div class="col-md-12 mt-3">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="text-center">
                            <th colspan="2">Products</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ot in orderItems" :key="ot.id" class="align-middle">
                            <td class="ps-2 text-center"><img :src="`/storage/productsThumb/`+ot.p_image" class="img img-fluid" style="width:70px;height:auto"></td>
                            <td class="ps-2">
                                <h6>{{ot.p_name}}</h6>
                                <h6>
                                    <span class="badge rounded-pill px-3"  :style="{backgroundColor:ot.color}">{{ot.color}}</span> / 
                                    <span class="badge rounded-pill bg-light shadow-sm text-dark px-3 border"><strong>{{ot.size}}</strong></span>
                                </h6>
                                <h6 v-if="ot.promotion_status == `FLASH SALE`" class="mt-3"><span class="bg-warning p-1"><span class="fa fa-bolt"></span> Flash Sale</span></h6>
                            </td>
                            <td class="ps-2 text-center">{{ot.quantity}}</td>
                            <td v-if="ot.promotion_status == `REGULAR`" class="ps-2 text-center fs-5">{{ot.price | numFormat}} ETB</td>
                            <td v-if="ot.promotion_status == `FLASH SALE`" class="ps-2 text-center"><span class="fs-5">{{ot.new_price | numFormat}} ETB</span> <span class="fs-6"><s>{{ot.price | numFormat}} ETB</s></span></td>
                            <td class="ps-2 text-center">{{order.order_status}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>    
            <div class="col-md-8 mt-3">

            </div>     
             <div class="col-md-4 border-bottom border-3 mt-3">
                <h6 class="mt-2">Retail Price: <span class="float-end">{{order.total | numFormat}} ETB</span></h6>
                <h6 class="mt-2">Sub Total: <span class="float-end">{{order.total | numFormat}} ETB</span></h6>
                <h5 class="mt-2"><strong>Total: <span class="float-end">{{order.total | numFormat}} ETB</span></strong></h5>
             </div>
             <div class="col-md-6 mt-5">
                <h5 class="border-bottom">Shipping Information</h5>
                <div class="rounded-1 border-start border-warning border-5 p-3" style="cursor:pointer">
                    <h5><strong>{{address.f_name}} {{address.l_name}}</strong> </h5>
                    <h6>+251-{{address.phone_no}}</h6>
                    <h6>{{address.city}} - {{address.state}}</h6>
                    <h6>{{address.address_1}}</h6>
                </div>
             </div>
             <div class="col-md-6 mt-5">
                <h5 class="border-bottom">Billing Information</h5>
                <div class="rounded-1 border-start border-warning border-5 p-3" style="cursor:pointer">
                    <h5><strong>{{address.f_name}} {{address.l_name}}</strong> </h5>
                    <h6>+251-{{address.phone_no}}</h6>
                    <h6>{{address.city}} - {{address.state}}</h6>
                    <h6>{{address.address_1}}</h6>
                </div>
             </div>
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
            order:{},
            orderItems:[],
            address:{},
            loading:true
        }
    },
    mounted(){
        this.getOrder()
    },
    methods:{
        async getOrder(){
            this.loading = true
            await axios.get('/orders/'+this.$route.params.id)
            .then( response =>{
                this.order = response.data
                this.orderItems = JSON.parse(response.data.items)
                console.log(response.data.delivery_details)
                this.getAddress(response.data.delivery_details)
            })
        },
        async getAddress(id){
            await axios.get('/showAddress/'+id)
            .then( response =>{
                this.address = response.data
                this.loading = false
            })
        }
    }
}
</script>