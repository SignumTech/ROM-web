<template>
    <div class="p-2">
        <div class="row border-bottom pb-2">
            <div class="col-12 overflow-auto hide-scroll">
                <div class="row" style="min-width:200vw">
                    <div class="col-12">
                        <span :class="($route.path == `/home/`+cat.id)?`mx-2 px-1 border-bottom border-md border-dark border-3`:`mx-2 px-1`" v-for="(cat,index) in mainCat" :key="index">
                            <router-link :to="(`/home/`+cat.id)"><strong>{{cat.cat_name}}</strong></router-link>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2 px-2">
            <div class="col-md-12 mt-1">
                <a class="nav-link active" aria-current="page" href="#">NEW ARRIVALS</a>
            </div>
            <div class="col-md-12 mt-1">
                <a class="nav-link" href="#">TRENDS</a>
            </div>
            <div class="col-md-12 mt-1">
                <a class="nav-link" href="#">SALE</a>
            </div>
            <div @click="$emit('close')" v-for="sc,index in subCats" :key="index" class="col-md-12 mt-1">
                <router-link  class="nav-link" :to="`/home/`+$route.params.id+`/shop/`+sc.id">{{ sc.cat_name }}</router-link> 
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:["mainCat"],
    data(){
        return{
            subCats:{}
        }
    },
    mounted(){
        this.$router.push('/home/'+this.mainCat[0].id)
        this.getSubCats(this.mainCat[0].id)
    },
    methods:{
        async getSubCats(){
            await axios.get('/showSubCategories/'+this.$route.params.id)
            .then( response =>{
                this.subCats = response.data
                this.loading = false
            })
        }
    },
    watch: {
        $route (to, from) {
            this.getSubCats()
        }
    }
}
</script>