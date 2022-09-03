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
    </div>           
</div>
</template>
<script>
import hero from './hero.vue'
export default {
    props:['heroImage'],
    components:{
        hero
    }, 
}
</script>