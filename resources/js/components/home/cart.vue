<template>
<div class="row m-0 px-5 mb-5">
    <div class="col-md-12 mt-5 text-center">
        <h5><strong>Shopping Bag</strong> > Place Order > Pay > Order Complete</h5>
    </div>
    <div class="col-md-8 mt-3">
        <div class="bg-white rounded-1 p-3 shadow-sm">
            <h5 class="m-0">Shopping bag items</h5>
        </div>
        <div v-for="(cart,index) in cartItems" :key="index" class="bg-white rounded-1 p-3 shadow-sm mt-3">
            <div class="row">
                <div class="col-md-2">
                    <img :src="`/storage/productsThumb/`+cart.p_image" class="img img-fluid" alt="">
                </div>
                <div class="col-md-7">
                    <h5><strong>{{cart.p_name}}</strong></h5>
                    <h6 class="mt-4">Price - {{cart.price | numFormat}} Birr</h6>
                    <h6  style="cursor:pointer">Color - <span @click="detailsModal(cart.p_id,index,cart)" class="badge rounded-pill px-3"  :style="{backgroundColor:cart.color}">{{cart.color}}</span></h6>
                    <h6  style="cursor:pointer">Size - <span @click="detailsModal(cart.p_id,index,cart)" class="badge rounded-pill bg-light shadow-sm text-dark px-3"><strong>{{cart.size}}</strong></span></h6>
                </div>
                <div class="col-md-3 text-end">
                    <h4><strong>{{subTotal(index) | numFormat}} Birr</strong></h4>
                    <div class="row ms-md-5 ms-sm-3">
                        <div class="input-group mb-3 mt-2 float-end">
                            <button @click="subtract(index)" class="btn btn-outline-secondary btn-sm" type="button" id="button-addon1"><span class="fa fa-minus"></span></button>
                            <input disabled v-model="cart.quantity" type="text" class="form-control text-center" placeholder=""  aria-describedby="button-addon1">
                            <button @click="add(index)" class="btn btn-outline-secondary btn-sm" type="button" id="button-addon1"><span class="fa fa-plus"></span></button>
                        </div>                        
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <h6 @click="deleteItem(index)" style="cursor:pointer"><span class="fa fa-trash-alt"></span> Delete</h6>
                        </div>
                        <div class="col-md-6">
                            <h6><span class="fa fa-heart"></span> Save</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-3">
        <div class="bg-white rounded-1 p-3 shadow-sm">
            <h4 class="m-0"><strong>Order Summary</strong></h4>
            <h6 class="mt-4"><strong>Subtotal</strong> <span class="float-end fs-3"><strong>{{orderSummary() | numFormat}} ETB</strong></span></h6>
        </div>
        
        <div v-if="btnLoading" class="d-flex justify-content-center align-self-center mt-3">
            <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
        </div>
        
        <button v-if="!btnLoading" @click="checkout()" class="btn btn-primary py-2 form-control mt-3"><h4 class="m-0"><strong>Secure Checkout</strong></h4></button>
    </div>
</div>    
</template>
<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import editSizesColorsVue from './editSizesColors.vue';
import signinModal from './signinModal.vue';
export default {
    components:{
        PulseLoader
    },
    data(){
        return{
            cartItems:[],
            cart_id:"",
            btnLoading:false
        }
    },
    mounted(){
        this.getCart()
        this.orderSummary()
    },
    methods:{
        async deleteItem(index){
            var check = confirm('Do you want to remove this item from your shopping bag?')
            if(check){
                await axios.post('/deleteItem', {cartItems:this.cartItems, index:index})
                .then(response =>{
                    this.getCart()
                })
            }

        },
        detailsModal(id,index,toEdit){
            this.$modal.show(
                editSizesColorsVue,
                {"id":id, "index":index, "toEdit":toEdit},
                { "height" : "auto", "width" : "900px"},
                { "closed" : this.getCart}
            )
        },
        async checkout(){
            if(!this.$store.state.auth.authenticated){
                this.$modal.show(
                    signinModal,
                    {},
                    {"width":"900px", "height":"500px"},
                    {}
                )
            }
            else{
                this.btnLoading = true
                await axios.put('/updateCart/'+this.cart_id, {items:this.cartItems})
                .then( response =>{
                    this.$router.push({name:'PlaceOrder', params:{
                        cart_id:response.data.id
                    }})
                    this.btnLoading = false
                })
            }
        },
        orderSummary(){
            var sum = 0;
            this.cartItems.forEach(function(cart){
                sum += (cart.quantity * cart.price);
            })
            return sum
        },
        subTotal(index){
            return this.cartItems[index].quantity * this.cartItems[index].price
        },
        sumPrice(cart){
            var sum = 0;
            cart.forEach(function(c){
                sum = sum + c.price
            })
            return sum;
        },
        async getCart(){
            await axios.post('/getCart')
            .then( response => {
                this.cart_id = response.data.id
                this.cartItems = JSON.parse(response.data.items)
            })
        },
        subtract(index){
            if( (this.cartItems[index].quantity - 1) < 1){

            }
            else{
                this.cartItems[index].quantity -= 1 
            }
        },
        add(index){
            this.cartItems[index].quantity += 1 
        }
    }
}
</script>