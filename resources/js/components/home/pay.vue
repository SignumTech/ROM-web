<template>
<div class="row m-0 px-5 mb-5">
    <div class="col-md-12 mt-5 text-center">
        <h5>Shopping Bag > Place Order > <strong>Pay</strong> > Order Complete</h5>
    </div>
    <div class="col-md-3"></div>
    <div v-if="btnLoading" class="col-md-6 mt-2">
        <div  class="d-flex justify-content-center align-self-center">
            <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
        </div>
    </div>
    <div v-if="!btnLoading" class="col-md-6 mt-2">
        <div class="bg-white shadow-sm rounded-1 p-4 ">
            <img src="/storage/settings/telebirr.png" class="img img-fluid" style="width:70px; height:auto" alt="">
            <h6 class="mt-3">Reciever Name: ROM Fashion</h6>
            <h6>Amount: {{total | numFormat}} ETB</h6>
            <h3 class="text-center text-warning mt-4"><strong>{{total | numFormat}} ETB</strong></h3>
            <h6 class="text-center">Scan to pay ({{total | numFormat}} ETB)</h6>
            <img src="/storage/settings/qr.png" class="img img-fluid d-block m-auto" style="width:200px; height:auto" alt="">
            <hr class="mt-4">
            <h5 class="text-center mt-3"><span class="fa fa-qrcode"></span>  Turn on the telebirr App and scan the QR code</h5>
            <h6 class="text-center text-danger mt-4">* This button is only for development purposes till Telebirr is integrated! Press it to continue.</h6>
            <button @click="completePayment()" class="btn btn-success btn-sm d-block m-auto"> Complete paymet</button>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
</template>
<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
export default {
    components:{
        PulseLoader,
    },
    props:['address', 'total', 'cart_id'],
    data(){
        return{
            btnLoading : false
        }
    },
    methods:{
        async completePayment(){
            this.btnLoading = true
            await axios.post('/orders', {address:this.address,total:this.total,cart_id:this.cart_id})
            .then( response =>{
                window.location.replace('/orderComplete')
                this.btnLoading = false
            })
        }
    }
}
</script>