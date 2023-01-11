<template>
<div class="row mx-0 bg-white pb-5">
    <subnavVue class="mob_hide" :subCats="subCats" :mainCat="mainCat"></subnavVue>
    <div class="col-md-12 mt-3">
        <h6>Home / {{catDetail.cat_name}}</h6>
    </div>
    <div class="col-md-2 col-12 mt-3">
        <h4><strong>{{catDetail.cat_name}}</strong></h4>
    </div>
    <div class="col-md-10 mob_hide">
        <span class="fs-6 shadow-sm py-1 px-4 bg-light me-3 rounded-pill border border-1" v-for="leaf,index in leafs" :key="index">
           <router-link :to="`/home/`+$route.params.id+`/shop/`+leaf.id">{{ leaf.cat_name }}</router-link> 
        </span>
    </div>
    <div class="col-12 mt-2 overflow-auto hide-scroll mob_display">
        <div class="row" style="min-width:500%">
            <div class="col-12 p-2">
                <span class="fs-6 shadow-sm py-1 px-4 bg-light me-3 rounded-pill border border-1" v-for="leaf,index in leafs" :key="index">
                    <router-link :to="`/home/`+$route.params.id+`/shop/`+leaf.id">{{ leaf.cat_name }}</router-link> 
                </span>
                <span class="fs-6 shadow-sm py-1 px-4 bg-light me-3 rounded-pill border border-1" v-for="leaf,index in leafs" :key="index">
                    <router-link :to="`/home/`+$route.params.id+`/shop/`+leaf.id">{{ leaf.cat_name }}</router-link> 
                </span>
            </div>

            

        </div>
        
    </div>
    <div class="col-md-2 mt-3 border-top mt-md-5 mt-sm-2">
        <div class="row m-0">
            <div class="col-md-12 mt-3 mb-2">
                <h5><strong>Sizes</strong></h5>
            </div>
            <div v-for="filter,index in filters" :key="index" class="col-md-6 col-2">
                <div  class="form-check">
                    <input @change="filterProductData()" class="form-check-input" v-model="filterData" type="checkbox" :value="filter" >
                    <label class="form-check-label" for="flexCheckDefault">
                        {{filter}}
                    </label>
                </div>
            </div>
        </div>
        <div class="row m-0">
            <div class="col-md-12 mt-5">
                <h5><strong>Price range</strong></h5>
                <input @change="filterProductData()" type="range" class="form-range" :min="priceMin" :max="priceMax" step="1" v-model="filterRange">
                <h6>{{priceMin}} ETB <span class="float-end">{{filterRange}} ETB</span></h6>
            </div>
            
        </div>
    </div>
    
    <div v-if="loading" class="col-md-10 p-5">
        <div class="d-flex justify-content-center align-self-center">
            <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
        </div>
    </div>  
    
    <div v-if="!loading" class="col-md-10 ps-0 pe-0">
        <div class="row m-0">
            <div v-for="item in items" :key="item.id" class="col-md-3 col-6 mt-5">
                <product-card :item="item"></product-card>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import subnavVue from '../main/subnav.vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import productCard from './productCard.vue';
export default {
    components:{
        productCard,
        PulseLoader,
        subnavVue
    },
    data(){
        return{
            query:null,
            leafs:{},
            upHere:false,
            filterRange:this.priceMax,
            items:{},
            loading:true,
            catDetail:{},
            filters:{},
            filterData:[],
            priceMax:{},
            priceMin:{},
            mainCat:{},
            subCats:{}
        }
    },
    mounted(){
        this.getCatProducts()
        this.getCatDetail()
        this.getProductFilters()
        this.priceRange()
        this.getSubCats()
        feather.replace();
    },
    watch: {
        $route (to, from) {
            this.getCatProducts()
            this.getCatDetail()
            this.getProductFilters()
            this.priceRange()
            this.getSubCats()
            this.getLeafs(this.$route.params.cat_id)
        }
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
        async getLeafs(id){
            await axios.get('/showSubCategories/'+id)
            .then( response =>{
                this.leafs = response.data
                this.loading = false
            })
        },
        mouseHov(){
            console.log('hover')
        },
        async filterProductData(){
            this.loading = true
            await axios.post('/filterData',{sizeData:this.filterData, cat_id:this.$route.params.cat_id, max:this.filterRange, min:this.priceMin})
            .then( response =>{
                this.items = response.data
                this.loading = false
            })
        },
        async getProductFilters(){
            await axios.get('/productFilters/'+this.$route.params.cat_id)
            .then( response =>{
                this.filters = response.data
            })
        },
        async getCatDetail(){
            await axios.get('/showMainCat/'+this.$route.params.cat_id)
            .then( response =>{
                this.catDetail = response.data
                if(this.catDetail.tree_level == 'NODE'){
                    this.getLeafs(this.catDetail.id)
                }
            })
        },
        async getCatProducts(){
            this.loading = true
            await axios.get('/productsByCategory/'+this.$route.params.cat_id)
            .then( response =>{
                this.items = response.data
                this.loading = false
            })
        },
        async priceRange(){
            await axios.get('/priceRange/'+this.$route.params.cat_id)
            .then( response => {
                this.priceMax = response.data.max
                this.priceMin = response.data.min
                this.filterRange = this.priceMax
            })
        }
    }
}
</script>