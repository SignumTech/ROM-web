<template>
<div class="row m-0 px-5 mb-5">
    <div class="col-md-12 mt-5 text-center">
        <h5><strong>Shopping Bag</strong> > Place Order > Pay > Order Complete</h5>
    </div>
    <div class="col-md-8 mt-3">
        <div class="bg-white rounded-1 p-3 shadow-sm">
            <h5 class="m-0">Shopping bag items</h5>
        </div>
        <div v-if="loading" class="d-flex justify-content-center align-self-center mt-5">
            <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
        </div>
        <div v-for="(cart,index) in cartItems" :key="index" class="bg-white rounded-1 p-3 shadow-sm mt-3">
            <div class="row">
                <div class="col-md-2">
                    <img :src="`/storage/productsThumb/`+cart.p_image" class="img img-fluid" alt="">
                </div>
                <div class="col-md-7">
                    <h5><strong>{{cart.p_name}}</strong></h5>
                    <h5 v-if="cart.promotion_status == `REGULAR`" class="mt-4"><strong>{{cart.price | numFormat}} Birr</strong></h5>
                    <h5 v-if="cart.promotion_status == `FLASH SALE`" class="mt-4"><strong>{{cart.new_price | numFormat}} Birr</strong> <span class="text-muted fs-6"><s><strong>{{cart.price | numFormat}} ETB</strong></s></span></h5>
                    <h6 v-if="cart.promotion_status == `FLASH SALE`" class="mt-3"><span class="bg-warning p-1"><span class="fa fa-bolt"></span> Flash Sale</span></h6>
                    <h6  style="cursor:pointer">Color - <span @click="detailsModal(cart.p_id,index,cart)" class="badge rounded-pill px-3 mt-2 shadow-sm"  :style="{backgroundColor:cart.color}">{{cart.color}}</span></h6>
                    <h6  style="cursor:pointer">Size - <span @click="detailsModal(cart.p_id,index,cart)" class="badge rounded-pill border bg-light shadow-sm text-dark px-3 mt-2"><strong>{{cart.size}}</strong></span></h6>
                </div>
                <div class="col-md-3 text-end">
                    <h4><strong>{{subTotal(index) | numFormat}} Birr</strong></h4>
                    <div class="row ms-md-5 ms-sm-3">
                        <div class="input-group mb-3 mt-2 float-end">
                            <button @click="subtract(index)" class="btn btn-outline-secondary btn-sm" type="button" id="button-addon1"><span class="fa fa-minus"></span></button>
                            <input disabled v-model="cart.quantity" type="text" :max="inventory[index]" :class="(cart.quantity > inventory[index])?`form-control text-center border-danger-inv border-2`:`form-control text-center`" placeholder=""  aria-describedby="button-addon1">
                            <button @click="add(index)" class="btn btn-outline-secondary btn-sm" type="button" id="button-addon1"><span class="fa fa-plus"></span></button>
                        </div>
                        <h6 v-if="invError">{{invEr[cart.p_id]['err']}}</h6>                        
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
            loading:true,
            cartItems:[],
            cart_id:"",
            btnLoading:false,
            invError:false,
            invEr:{},
            inventory:{}
        }
    },
    mounted(){
        this.getCart()
        this.orderSummary()
    },
    methods:{
        async getInventory(){
            await axios.post('/itemsInventory', {items:this.cartItems})
            .then( response =>{
                this.inventory = response.data
            })
        },
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
                    this.invError = false
                })
                .catch( error =>{
                    if(error.response.status == 422){
                        
                        this.invEr = error.response.data
                        console.log(this.invEr[57]['err'])
                        this.invError = true
                        this.btnLoading = false
                    }
                    
                })
            }
        },
        orderSummary(){
            var sum = 0;
            this.cartItems.forEach(function(cart){
                if(cart.promotion_status == 'REGULAR'){
                    sum += (parseInt(cart.quantity) * parseFloat(cart.price));
                }
                else{
                    sum += (parseInt(cart.quantity) * parseFloat(cart.new_price))
                }
                
            })
            return sum
        },
        subTotal(index){
            if(this.cartItems[index].promotion_status == 'REGULAR'){
                return parseInt(this.cartItems[index].quantity) * parseFloat(this.cartItems[index].price)
            }
            else{
                return parseInt(this.cartItems[index].quantity) * parseFloat(this.cartItems[index].new_price)
            }
        },
        sumPrice(cart){
            var sum = 0;
            cart.forEach(function(c){
                sum = sum + parseFloat(c.price)
            })
            return sum;
        },
        async getCart(){
            this.loading = true
            await axios.post('/getCart')
            .then( response => {
                this.cart_id = response.data.id
                this.cartItems = JSON.parse(response.data.items)
                this.loading = false
                this.getInventory()
            })
            .catch( response =>{
                this.loading = false
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
            if(this.cartItems[index].quantity > this.inventory[index]){

            }
            else{
                this.cartItems[index].quantity += 1
            }
             
        }
    }
}
</script>