<template>
<div class="container-fluid">
    <div class="row m-0 px-3">
        <div class="col-md-12 mt-3">
            <h6><router-link to="/">Home</router-link> / {{$route.name}}</h6>
        </div>
    </div>
    <div class="row mt-4 px-3">
        <div class="col-md-3">
            <div class="bg-white rounded-1 p-3">
                <router-link to="/myAccount"><h5 class="m-0"><b>My Account</b></h5></router-link>
                <router-link to="/myAccount/myProfile"><h6 class="mt-3 ms-3">My profile</h6></router-link>
                <router-link to="/myAccount/addressBook"><h6 class="mt-3 ms-3">Address Book</h6></router-link>
            </div>
            <div class="bg-white rounded-1 p-3 mt-3">
                <router-link to="/myAccount/myOrders"><h5 class="m-0"><b>My Orders</b></h5></router-link>
                <!--<h6 class="mt-3 ms-3" style="cursor:pointer">All orders</h6>
                <h6 class="mt-3 ms-3" style="cursor:pointer">Processing</h6>
                <h6  class="mt-3 ms-3" style="cursor:pointer">Shipped</h6>
                <h6  class="mt-3 ms-3" style="cursor:pointer">Delivered</h6>-->
            </div>
        </div>
        <router-view></router-view>
    </div>
    
</div>    
</template>
<script>
export default {
    mounted(){
        console.log(this.$route)
    },
    methods:{
        myOrders(order_status){
            this.$root.$refs.A.getMyOrdersStatus(order_status);
        }
    }
}
</script>