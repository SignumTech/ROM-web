<template>
<div class="col-md-12">
    <div class="main-nav shadow-sm">
        <div class="row m-0 p-2">
            <div class="col-6">
                <h5 class="text-white m-0"><a href="/" class="text-white"><strong>ROM</strong></a></h5>
            </div>
            <div class="col-6 text-end">
                <router-link to="/signin" class="mx-3"><span class="fa fa-user  text-white"></span></router-link>
                <router-link to="/cart" class="mx-3"><span class="fa fa-shopping-bag  text-white"></span> <span v-if="$store.state.auth.cart.length > 0" class="badge bg-light text-dark">{{$store.state.auth.cart.length}}</span></router-link>
                <span class="fa fa-search ms-3 text-white"></span>
            </div>
        </div>
    </div>
    <div class="bg-white shadow-sm p-2">
        <div class="row m-0">
            <div class="col-1">
                <span @click="showNav()" class="fa fa-bars"></span>
            </div>
            <div class="col-10 overflow-auto hide-scroll">
                <div class="row" style="min-width:200vw">
                    <div class="col-12">
                        <span :class="($route.path == `/home/`+cat.id)?`mx-2 px-1 border-bottom border-md border-dark border-3`:`mx-2 px-1`" v-for="(cat,index) in categories" :key="index">
                            <router-link :to="(`/home/`+cat.id)"><strong>{{cat.cat_name}}</strong></router-link>
                            
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-1">
                <span class="fa fa-chevron-right text-secondary"></span>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import showNavModalVue from './showNavModal.vue'
export default {
    props:["categories"],
    data(){
        return{
            subCats:{}
        }
    },
    methods:{
        showNav(){
            this.$modal.show(
                showNavModalVue,
                {subCats:this.subCats, mainCat:this.mainCat},
                {height: "100%", width: "300px", shiftX: -1}  
            );   
        }
    }
}
</script>