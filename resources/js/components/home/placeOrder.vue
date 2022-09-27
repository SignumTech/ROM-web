<template>
<div class="row m-0 px-5 mb-5">
    <div class="col-md-12 mt-5 text-center">
        <h5>Shopping Bag > <strong>Place Order </strong>> Pay > Order Complete</h5>
    </div>
    <div class="col-md-8 mt-3">
        <div class="bg-white rounded-1 p-3 shadow-sm">
            <h5 class="m-0">Shipping Address</h5>
        </div>
        <div v-if="loading" class="row mx-0 mt-3 p-3">
            <div  class="col-md-12 p-5 mt-4">
                <div class="d-flex justify-content-center align-self-center">
                    <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                </div>
            </div>         
        </div>

        <div v-if="addressBookExists && !loading" class="row mx-0 mt-3 p-3">
            <div v-for="ad in addressData" :key="ad.id" class="col-md-6 mt-3">
                <div @click="makeDefault(ad.id)" :class="(ad.type == 'DEFAULT')?`bg-white shadow-sm rounded-1 border border-primary border-5 p-3`:`bg-white shadow-sm rounded-1 border-start border-secondary border-3 p-3`" style="cursor:pointer">
                    <h5><strong>{{ad.f_name}} {{ad.l_name}}</strong> <span @click="editAddress(ad)" class="fa fa-edit float-end" style="cursor:pointer"></span></h5>
                    <h6>+251-{{ad.phone_no}}</h6>
                    <h6>{{ad.city}} - {{ad.state}}</h6>
                    <h6>{{ad.address_1}} / {{ad.address_2}}</h6>
                </div>
            </div>
            <div class="col-md-12 mt-3 align-self-center text-center">
                <button @click="addAddress()" class="btn btn-outline-primary rounded-1"> <span class="fa fa-plus"></span> Add Shipping Address</button>
            </div>
        </div>
        <form v-if="!addressBookExists && !loading" action="#" @submit.prevent="saveAddress">
            <div class="row mx-0 mt-3 p-3 bg-white rounded-1 shadow-sm">
                <div class="col-md-6">
                    <label>First Name</label>
                    <input required v-model="addressData.f_name" type="text" class="form-control" placeholder="First Name">
                </div>
                <div class="col-md-6">
                    <label>Last Name</label>
                    <input required v-model="addressData.l_name" type="text" class="form-control" placeholder="Last Name">
                </div>
                <div class="col-md-12 mt-3">
                    <label for="">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroup-sizing-default">+251</span>
                        <input required v-model="addressData.phone_no" type="text" class="form-control" placeholder="Phone Number">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label>City</label>
                    <input required v-model="addressData.city" type="text" class="form-control" placeholder="City">
                </div>
                <div class="col-md-6 mt-3">
                    <label>State</label>
                    <input required v-model="addressData.state" type="text" class="form-control" placeholder="State">
                </div>
                <div class="col-md-6 mt-3">
                    <label>Address 1</label>
                    <input required v-model="addressData.address_1" type="text" class="form-control" placeholder="Address 1">
                </div>
                <div class="col-md-6 mt-3">
                    <label>Address 2 (optional)</label>
                    <input v-model="addressData.address_2" type="text" class="form-control" placeholder="Address 2">
                </div>
                <div class="col-md-12 mt-2">
                    <h6 v-if="addressError" class="text-danger text-center mt-2">Please add a shipping address!</h6>
                </div>
                <div class="col-md-12 mt-4 text-center">
                    <button type="submit" class="btn btn-primary px-3 rounded-1"><span class="fa fa-address-book"></span> Save Address</button>
                </div>                
            </div>
        </form>
    </div>
    <div class="col-md-4 mt-3">
        <form method="POST" action="/pay" id="paymentForm">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="address" :value="currentAddress">
            <input type="hidden" name="amount" :value="orderSummary()">
            <input type="hidden" name="cart_id" :value="c_id">
            <div class="bg-white rounded-1 p-3 shadow-sm">
                <h5><strong>
                    Payment Options
                </strong></h5>
                <table class="table table-borderless">
                    <tr class="align-self-center">
                        <td><input class="form-check-input" value="telebirr" type="radio" v-model="paymentMethod" id="flexRadioDefault2"></td>
                        <td>
                            <img class="img img-fluid" src="/storage/settings/telebirr.png" style="max-width: 85px; height: auto" alt="">
                        </td>                    
                    </tr>
                    <tr class="align-self-center">
                        <td><input class="form-check-input" value="ebirr" type="radio" v-model="paymentMethod" id="flexRadioDefault2"></td>
                        <td>
                            <img class="img img-fluid" src="/storage/settings/ebirr.jpg" style="max-width: 85px; height: auto" alt="">
                        </td>                    
                    </tr>
                </table>
                <h6 v-if="paymentError" class="text-danger mt-2">Please choose a payment method!</h6>
            </div>
            <div class="bg-white rounded-1 p-3 shadow-sm mt-3">
                <h4 class="m-0"><strong>Order Summary</strong></h4>
                <h6 class="mt-4">Subtotal <span class="float-end fs-3"><strong>{{orderSummary() | numFormat}} ETB</strong></span></h6>
            </div>
            <div v-if="btnLoading" class="d-flex justify-content-center mt-3 align-self-center">
                <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
            </div>
            <button type="submit" value="Buy" v-if="!btnLoading" class="btn btn-primary py-3 form-control mt-3"><h4 class="m-0"><strong>Place Order</strong></h4></button>        
        </form>

    </div>
</div>    
</template>
<script>
import addressModalVue from './addressModal.vue'
import editAddressModalVue from './editAddressModal.vue'

import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
export default {
    components:{
        PulseLoader
    },
    props:['cart_id'],
    data(){
        return{
            btnLoading:false,
            loading:false,
            c_id:this.cart_id,
            currentAddress:"",
            cartItems:[],
            paymentMethod:null,
            addressData:{
                f_name:"",
                l_name:"",
                phone_no:"",
                city:"",
                state:"",
                address_1:"",
                address_2:"",
            },
            addressBookExists:false,
            paymentError:false,
            addressError:false,
            cartItemsError:false,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content

        }
    },
    mounted(){
        
        this.getCart()
        this.getAddressBook()
    },
    methods:{
        async makeDefault(id){
            await axios.get('/makeDefaultAddress/'+id)
            .then( response =>{
                this.currentAddress = id
                this.getAddressBook()
            })
        },
        async placeOrder(){
            if(this.paymentMethod == null){
                this.paymentError = true
            }
            else if(!this.addressBookExists){
                this.addressError = true
            } 
            else if(this.cartItems.length == 0){
                this.cartItemsError = true
            }
            else{
                this.btnLoading = true
                //await axios.post('/orders')
                /*this.$router.push({name:'Pay', params:{
                    address:this.currentAddress,
                    total:this.orderSummary(),
                    cart_id:this.c_id
                    
                }})
                this.btnLoading = false*/
                await axios.post('/pay', {amount:this.orderSummary(),address:this.currentAddress,cart_id:this.c_id,csrf:this.csrf})
                .then( response =>{
                    
                })
            }
        },
        addAddress(){
            this.$modal.show(
                addressModalVue,
                {},
                {"width":"600px", height:"auto"},
                {"closed":this.getAddressBook}
            )
        },
        editAddress(ad){
            this.$modal.show(
                editAddressModalVue,
                {"address":ad},
                {"width":"600px", height:"auto"},
                {"closed":this.getAddressBook}
            )
        },
        async getAddressBook(){
            this.loading = true
            await axios.get('/addressBooks/'+this.$store.state.auth.user.id)
            .then( response =>{
                this.addressData = response.data
                
                this.addressData.forEach((ad)=>{
                    if(ad.type === 'DEFAULT'){
                        this.currentAddress = ad.id
                    }
                })
                this.addressBookExists = true
                this.loading = false
            })
            .catch( error =>{
                if(error.response.status == 422){
                    this.addressBookExists = false
                    this.loading = false
                }
            })
        },
        async saveAddress(){
            this.loading = true
            await axios.post('/addressBooks', this.addressData)
            .then( response =>{
                this.addressData = response.data
                this.addressBookExists = true
                this.getAddressBook()
                this.loading = false
            })
        },
        async getCart(){
            await axios.post('/getCart')
            .then( response => {
                this.c_id = response.data.id
                this.cartItems = JSON.parse(response.data.items)
            })
        },
        orderSummary(){
            var sum = 0;
            this.cartItems.forEach(function(cart){
                if(cart.promotion_status == 'REGULAR'){
                    sum += (cart.quantity * cart.price);
                }
                else{
                    sum += (cart.quantity * cart.new_price)
                }
                
            })
            return sum
        }
    }
}
</script>