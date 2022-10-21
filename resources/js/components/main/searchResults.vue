<template>
<div class="row mx-0 bg-white pb-5">
    <div class="col-md-12 mt-3 px-5">
        <h6>Home / {{query}}</h6>
    </div>
    <div class="col-md-12 mt-3 px-5">
        <div class="bg-white rounded-1 shadow-sm p-3">
            <h5 class="m-0">Search results for "{{query}}", {{items.length}} items found.</h5>
        </div>
    </div>
    <div v-if="loading" class="col-md-12 p-5">
        <div class="d-flex justify-content-center align-self-center">
            <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
        </div>
    </div>  
    
    <div v-if="!loading" class="col-md-12 px-5">
        <div class="row m-0">
            <div v-for="item in items" :key="item.id" class="col-md-2 col-6 mt-5">
                <product-card :item="item"></product-card>
            </div>
        </div>
    </div>
</div>    
</template>
<script>
import productCard from '../home/productCard.vue'
export default {
    components:{
        productCard
    },
    props:['query'],
    data(){
        return{
            items:{},
            loading:true,
            queryData:{
                searchQuery:null
            }
        }
    },
    mounted(){
        this.queryData.searchQuery = this.query
        this.searchItems()
    },
    methods:{
        async searchItems(){
            this.loading = true
            await axios.post('/searchItems', this.queryData)
            .then( response =>{
                this.items = response.data
                this.loading = false
            })
        }
    }
}
</script>