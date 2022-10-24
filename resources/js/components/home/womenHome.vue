<template>
<div class="p-0">
    <hero :image="heroImage"></hero>
    <mob-navigation></mob-navigation>
    <div class="row m-0">
        <div class="col-12 mt-4">
            <h4 class="text-center"><strong>Shop By Category</strong></h4>
        </div>
    </div>  
    <div v-if="loading" class="row m-0 mt-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-center">
                <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
            </div>
        </div>  
    </div>
    <div v-if="!loading" class="row m-0 px-md-5 px-sm-1 pb-5 pt-3">
        <div v-for="category in categories" :key="category.id" class="col-md-2 col-6 mt-4">
            <router-link :to="`/women/shopByCategory/`+category.id">
                <div class="bg-white rounded-1 shadow-sm">
                    <div class="row m-0 ">
                        <div class="col-6 ps-0 align-self-center">
                            <img :src="`/storage/settings/`+category.cat_image" class="img img-fluid" alt="">
                        </div>
                        <div class="col-6 align-self-center">
                            <h6 class="m-0"><strong>{{category.cat_name}}</strong></h6>
                        </div>
                    </div>
                </div>
            </router-link>
        </div>
    </div>
    <!--<div class="row m-0">
        <div class="col-12 mt-4">
            <h4 class="text-center"><strong>Deals Of The Day</strong></h4>
           
        </div>
    </div> --> 
    <div v-if="!noFlash" class="row m-0 px-md-5 px-sm-1 pb-3 pt-3">
        <div class="col-md-6 col-12 align-self-center">
            <h2 class="fw-bolder"><strong>FLASH SALE</strong></h2>
            
        </div>
        <div class="col-md-6 col-12">
            <flip-countdown :class="`float-end`" :deadline="flashProducts[0].expiry_date" :showDays="true"></flip-countdown>
        </div>
    </div>
    <div class="row m-0 px-md-5 px-sm-1 pb-5 pt-3">
        <div v-for="flash,index in flashProducts" :key="index" class="col-md-2 col-6">
            <flash-card :item="flash"></flash-card>
        </div>
    </div>
    <div class="row m-0 px-md-5 px-sm-1 pb-5 pt-3">
        <div class="col-md-12 mt-4">
            <h4 class="text-center"><strong>Featured Products</strong></h4>
        </div>
        <div v-for="item in featuredItems" :key="item.id" class="col-md-2 col-6 mt-5">
            <product-card :item="item"></product-card>
        </div>
    </div>
    <div class="row m-0 px-md-5 px-sm-1">
        <div class="col-12 mt-4">
            <h4 class="text-center"><strong>Style Gallery</strong></h4>
        </div>
    </div> 
    <div class="row m-0 px-md-5 px-sm-1 pb-5 pt-3">
        <div class="col-md-3">
            <img src="/storage/products/dress.jpg" class="img img-fluid" alt="">
        </div>
        <div class="col-md-3">
            <img src="/storage/products/dress_2.jpg" class="img img-fluid" alt="">
        </div>
        <div class="col-md-3">
            <img src="/storage/products/dress_3.jpg" class="img img-fluid" alt="">
        </div>
        <div class="col-md-3">
            <img src="/storage/products/dress.jpg" class="img img-fluid" alt="">
        </div>
    </div>
</div>
</template>
<script>
import FlipCountdown from 'vue2-flip-countdown'
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import hero from './hero.vue'
import FlashCard from './flashCard.vue'
import productCard from './productCard.vue';
import MobNavigation from './mobNavigation.vue';
export default {
    components:{
    hero,
    PulseLoader,
    FlashCard,
    FlipCountdown,
    flashProducts: [],
    productCard,
    MobNavigation
},
    mounted(){
        this.getCatByName()
        this.getFlashSales()
        
    },
    data(){
        return{
            featuredItems:{},
            item:{
                p_name: "this is a flash sale",
                p_image: "dress.jpg",
                price: "1000"
            },
            loading:true,
            cat_id:{},
            categories:{},
            heroImage:"/storage/settings/front.jpg",
            noFlash:false
        }
    },
    methods:{
        async getFeaturedItems(){
            await axios.get('/getFeatured/'+this.cat_id)
            .then( response =>{
                this.featuredItems = response.data
            })
        },
        async getFlashSales(){
            await axios.get('/getFlashSales')
            .then( response => {
                this.flashProducts = response.data
                if(this.flashProducts.length == 0){
                    this.noFlash = true
                }
            })
            .catch( error =>{
                this.noFlash = true
            })
        },
        async getCatByName(){
            this.loading = true
            var name = "WOMEN";
            await axios.get('/getCatByName/'+name)
            .then( response =>{
                this.cat_id = response.data.id
                this.getCategories()
                this.getFeaturedItems()
            })
        },
        async getCategories(){
            await axios.get('/showSubCategories/'+this.cat_id)
            .then( response =>{
                this.categories = response.data
                this.loading = false
            })
        }
    }

    
}
</script>