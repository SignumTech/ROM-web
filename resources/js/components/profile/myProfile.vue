<template>
<div class="container">
    <div class="row m-0">
        <div class="col-md-1"></div>
        <div class="col-md-10 mt-3">
            <h6>Home / My Profile</h6>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row m-0">
                <div class="col-md-3">
                    <div class="bg-white rounded-1 p-3">
                        <h5 class="m-0"><b>My Account</b></h5>
                        <h6 class="mt-3 ms-3">My profile</h6>
                        <h6 class="mt-3 ms-3">Address Book</h6>
                    </div>
                    <div class="bg-white rounded-1 p-3 mt-2">
                        <h5 class="m-0"><b>My Orders</b></h5>
                        <h6 class="mt-3 ms-3">All orders</h6>
                        <h6 class="mt-3 ms-3">Processing</h6>
                        <h6 class="mt-3 ms-3">Shipped</h6>
                        <h6 class="mt-3 ms-3">Delivered</h6>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white rounded-1 p-3">
                        <h4 class="m-0"><b>Hi {{$store.state.auth.user.f_name}}!</b></h4>
                    </div>
                    <div class="bg-white rounded-1 p-3 mt-3">
                        <h5 class="m-0"><b>My Orders</b></h5>
                        <div class="row ms-0 me-0 mt-4">
                            <div class="col-md-4 p-2 orders-hover rounded-1">
                                <h3 class="text-center m-0"><span class="fa fa-cart-plus"></span></h3>
                                <h6 class="text-center m-0">Ordered</h6>
                            </div>
                            <div class="col-md-4 p-2 orders-hover rounded-1">
                                <h3 class="text-center m-0"><span class="fa fa-shipping-fast"></span></h3>
                                <h6 class="text-center m-0">Shipped</h6>
                            </div>
                            <div class="col-md-4 p-2 orders-hover rounded-1">
                                <h3 class="text-center m-0"><span class="fa fa-box-open"></span></h3>
                                <h6 class="text-center m-0">Delivered</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-white rounded-1 p-3">
                        <h5 class="m-0"><b><span class="fa fa-heart"></span> Wishlist</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
    
</div>    
</template>
<script>
export default {
    
}
</script>