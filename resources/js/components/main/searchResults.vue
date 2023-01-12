<template>
<div class="row mx-0 bg-white pb-5">
    <div class="col-md-12 mt-3 px-md-5">
        <h6>Home / {{query}}</h6>
    </div>
    <div class="col-md-12 mt-3 px-md-5">
        <div class="bg-white rounded-1 shadow-sm p-2">
            <div class="row">
                <div class="col-md-10 col-12 align-self-center">
                    <h5 class="m-0">Search results for "{{query}}", {{items.length}} items found.</h5>
                </div>
                <div class="col-md-2 col-12 mt-md-0 mt-3">
                    <div class="input-group">
                        <input v-model="queryData.searchQuery" type="text" class="form-control rounded-0" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button @click="searchItems()" class="btn btn-primary rounded-0" type="button" id="button-addon2"><span class="fa fa-search"></span></button>
                    </div>
                </div>
            </div> 
        </div>

    </div>
    <div v-if="loading" class="col-md-12 p-5">
        <div class="d-flex justify-content-center align-self-center">
            <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
        </div>
    </div>  
    
    <div v-if="!loading" class="col-md-12 px-md-5">
        
        <div class="row m-0">
            <div v-for="item in items" :key="item.id" class="col-md-2 col-6 mt-5">
                <product-card v-if="item.promotion_status == 'REGULAR'" :item="item"></product-card>
                <flash-card v-if="item.promotion_status == 'FLASH SALE'" :item="item"></flash-card>
                <sale-card v-if="item.promotion_status == 'SALE'" :item="item"></sale-card>
            </div>
        </div>
    </div>
</div>    
</template>
<script>
import productCard from '../home/productCard.vue'
import flashCard from '../home/flashCard.vue'
import saleCard from '../home/saleCard.vue'
export default {
    components:{
        productCard,
        flashCard,
        saleCard
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