<template>
<div class="row mx-0 bg-white pb-5">
    <div class="col-md-12 mt-3">
        <h6>Home / {{catDetail.cat_name}}</h6>
    </div>
    <div class="col-md-12 mt-3">
        <h4><strong>{{catDetail.cat_name}}</strong></h4>
    </div>
    <div class="col-md-2 mt-3 border-top mt-5">
        <div class="row m-0">
            <div class="col-md-12 mt-3 mb-2">
                <h5><strong>Sizes</strong></h5>
            </div>
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" >
                    <label class="form-check-label" for="flexCheckDefault">
                        XS
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="">
                    <label class="form-check-label" for="flexCheckDefault">
                        M
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="">
                    <label class="form-check-label" for="flexCheckDefault">
                        XL
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="">
                    <label class="form-check-label" for="flexCheckDefault">
                        S
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="">
                    <label class="form-check-label" for="flexCheckDefault">
                        L
                    </label>
                </div>
            </div>
        </div>
        <div class="row m-0">
            <div class="col-md-12 mt-5">
                <h5><strong>Price range</strong></h5>
                <input type="range" class="form-range" min="100" max="1000" step="1" id="customRange3">
                <h6>200 Birr <span class="float-end">10,000 Birr</span></h6>
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
            <div v-for="item in items" :key="item.id" class="col-md-3 mt-5">
                <product-card :item="item"></product-card>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import productCard from './productCard.vue';
export default {
    components:{
        productCard,
        PulseLoader
    },
    data(){
        return{
            items:{},
            loading:true,
            catDetail:{}
        }
    },
    mounted(){
        this.getCatProducts()
        this.getCatDetail()

    },
    methods:{
        async getCatDetail(){
            await axios.get('/categories/'+this.$route.params.id)
            .then( response =>{
                this.catDetail = response.data
            })
        },
        async getCatProducts(){
            this.loading = true
            await axios.get('/productsByCategory/'+this.$route.params.id)
            .then( response =>{
                this.items = response.data
                this.loading = false
            })
        }
    }
}
</script>