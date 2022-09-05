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
                    <h5>Price - {{cart.price}} Birr</h5>
                    <h5>Color - <span class="badge rounded-pill"  :style="{backgroundColor:cart.color}">{{cart.color}}</span></h5>
                    <h5>Size - {{cart.size}}</h5>
                </div>
                <div class="col-md-3 text-end">
                    <h3><strong>{{subTotal(index)}} Birr</strong></h3>
                    <div class="row ms-md-5 ms-sm-3">
                        <div class="input-group mb-3 mt-2 float-end">
                            <button @click="subtract(index)" class="btn btn-outline-secondary" type="button" id="button-addon1"><span class="fa fa-minus"></span></button>
                            <input disabled v-model="cart.quantity" type="text" class="form-control text-center" placeholder=""  aria-describedby="button-addon1">
                            <button @click="add(index)" class="btn btn-outline-secondary" type="button" id="button-addon1"><span class="fa fa-plus"></span></button>
                        </div>                        
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <h6><span class="fa fa-trash-alt"></span> Delete</h6>
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
            <h6 class="mt-4">Subtotal <span class="float-end fs-3"><strong>{{orderSummary()}} ETB</strong></span></h6>
        </div>
        <button class="btn btn-primary py-3 form-control mt-3"><h4 class="m-0"><strong>Secure Checkout</strong></h4></button>
    </div>
</div>    
</template>
<script>
export default {
    data(){
        return{
            cartItems:{}
        }
    },
    mounted(){
        this.getCart()

    },
    methods:{
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