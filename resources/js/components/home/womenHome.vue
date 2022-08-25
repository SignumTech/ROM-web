<template>
<div class="p-0">
    <hero :image="heroImage"></hero>
    <div class="row m-0">
        <div class="col-12 mt-4">
            <h4 class="text-center"><strong>Shop By Category</strong></h4>
        </div>
    </div>  
    <div class="row m-0 ps-5 pe-5 pb-5 pt-3">
        <div class="col-md-2 mt-4">
            <router-link to="/women/shopByCategory">
                <div class="bg-white rounded-1 shadow-sm">
                    <div class="row m-0 ">
                        <div class="col-6 ps-0 align-self-center">
                            <img src="/storage/settings/dresses.jpg" class="img img-fluid" alt="">
                        </div>
                        <div class="col-6 align-self-center">
                            <h6 class="m-0"><strong>DRESSES</strong></h6>
                        </div>
                    </div>
                </div>
            </router-link>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/t-shirts.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>T-SHIRTS</strong></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/beachwear.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>BEACH WEAR</strong></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/tanktops.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>TANK TOPS</strong></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/outwear.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>OUT WEAR</strong></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/bottoms.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>BOTTOMS</strong></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/lingerie.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>LINGERIE & LOUNGE</strong></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/sweatshirts.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>SWEAT SHIRTS</strong></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/skirts.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>SKIRTS</strong></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/blouses.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>BLOUSES</strong></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/shoes.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>SHOES</strong></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-4">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0">
                    <div class="col-6 ps-0 align-self-center">
                        <img src="/storage/settings/jewelry.jpg" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>JEWELERY</strong></h6>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
</template>
<script>
import hero from './hero.vue'
export default {
    components:{
        hero
    },
    data(){
        return{
            heroImage:"/storage/settings/front.jpg"
        }
    }
    
}
</script>