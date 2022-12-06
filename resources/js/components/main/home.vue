<template>
    <div>
        <subnavVue class="mob_hide" :subCats="subCats" :mainCat="mainCat"></subnavVue>
        <hero :image="heroImage"></hero>
        
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
        <categoriesVue :categories="subCats" :mainCatId="mainCat.id"></categoriesVue>
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
        <div v-if="!noFeatured" class="row m-0 px-md-5 px-sm-1 pb-5 pt-3">
            <div class="col-md-12 mt-4">
                <h4 class="text-center"><strong>Featured Products</strong></h4>
            </div>
            <div v-for="item in featuredItems" :key="item.id" class="col-md-2 col-6 mt-5">
                <product-card :item="item"></product-card>
            </div>
        </div>
    </div>
</template>
<script>
import subnavVue from './subnav.vue';
import categoriesVue from './categories.vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import FlipCountdown from 'vue2-flip-countdown'
import hero from '../home/hero.vue'
import FlashCard from '../home/flashCard.vue'
import productCard from '../home/productCard.vue';
import MobNavigation from '../home/mobNavigation.vue';
export default {
    components:{
        subnavVue,
        categoriesVue,
        hero,
        PulseLoader,
        FlashCard,
        FlipCountdown,
        productCard,
        MobNavigation
    },
    data(){
        return{
            featuredItems:{},
            loading:true,
            noFlash:true,
            subCats:{},
            mainCat:{},
            heroImage:"/storage/settings/front.jpg",
            noFeatured:false,
            flashProducts:{}
        }
    },
    mounted(){
        this.getSubCats()
        this.getFlashSales()
        this.getFeaturedItems()
        this.getMainCat()
    },
    methods:{
        async getMainCat(){
            await axios.get('/showMainCat/'+this.$route.params.id)
            .then( response =>{
                this.mainCat = response.data
            })
        },
        async getSubCats(){
            await axios.get('/showSubCategories/'+this.$route.params.id)
            .then( response =>{
                this.subCats = response.data
                this.loading = false
            })
        },
        async getFlashSales(){
            await axios.get('/getFlashSales')
            .then( response => {
                this.flashProducts = response.data
                this.noFlash = (this.flashProducts.length == 0)? true:false
            })
            .catch( error =>{
                this.noFlash = true
            })
        },
        async getFeaturedItems(){
            await axios.get('/getFeatured/'+this.$route.params.id)
            .then( response =>{
                this.featuredItems = response.data
                if(this.featuredItems.length == 0){
                    this.noFeatured = true
                }
            })
            .catch( error =>{
                this.noFeatured = true
            })
        },
    },
    watch: {
        $route (to, from) {
            this.getSubCats()
        }
    }
}
</script>