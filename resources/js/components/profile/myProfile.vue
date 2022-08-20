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
                    <div class="bg-white rounded-sm p-3">
                        <h5 class="m-0"><b>My profile</b></h5>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white rounded-sm p-3">
                        <h4 class="m-0"><b>Hi {{$store.state.auth.user.f_name}}!</b></h4>
                    </div>
                    <div class="bg-white rounded-sm p-3 mt-3">
                        <h5 class="m-0"><b>My Orders</b></h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-white rounded-sm p-3">
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