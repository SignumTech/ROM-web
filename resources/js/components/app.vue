<template>
    <div class="row m-0">
        <div class="p-0" v-if="$store.state.auth.permissions != `ADMIN` || !$store.state.auth.authenticated">
            <nav class="navbar navbar-expand-lg pe-2 ps-2 main-nav">
                <div class="container-fluid">
                    <a class="navbar-brand text-white" href="/"><h2 class="m-0"><strong>ROM</strong></h2></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item me-3">
                            <router-link :class="($route.path.includes(`/women`) || $route.path == '/')? `nav-link nav-link-main nav-link-active`: `nav-link nav-link-main`" aria-current="page" to="/women"><h5 class="m-0">WOMEN</h5></router-link>
                        </li>
                        <li class="nav-item me-3">
                            <router-link :class="($route.path.includes(`/curvePlus`))? `nav-link nav-link-main nav-link-active`: `nav-link nav-link-main `" to="/curvePlus"><h5 class="m-0">CURVE + PLUS</h5></router-link>
                        </li>
                        <li class="nav-item me-3">
                            <router-link :class="($route.path.includes(`/kids`))? `nav-link nav-link-main nav-link-active`: `nav-link nav-link-main`" to="/kids"><h5 class="m-0">KIDS</h5></router-link>
                        </li>
                        <li class="nav-item me-3">
                            <router-link :class="($route.path.includes(`/men`))? `nav-link nav-link-main nav-link-active`: `nav-link nav-link-main`" to="/men"><h5 class="m-0">MEN</h5></router-link>
                        </li>
                        <li class="nav-item me-3">
                            <router-link :class="($route.path.includes(`/beauty`))? `nav-link nav-link-main nav-link-active`: `nav-link nav-link-main`" to="/beauty"><h5 class="m-0">BEAUTY</h5></router-link>
                        </li>
                        <li class="nav-item me-3">
                            <router-link :class="($route.path.includes(`/home`))? `nav-link nav-link-main nav-link-active`: `nav-link nav-link-main`" to="/home"><h5 class="m-0">HOME</h5></router-link>
                        </li>
                        <li class="nav-item me-3">
                            <router-link :class="($route.path.includes(`/africanClothing`))? `nav-link nav-link-main nav-link-active`: `nav-link nav-link-main`" to="/africanClothing"><h5 class="m-0">AFRICAN CLOTHING</h5></router-link>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item me-4 dropdown">
                            <a class="nav-link nav-link-main dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><h5 class="m-0"><span class="fa fa-user"></span></h5></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li v-if="!authenticated"><router-link class="dropdown-item" to="/signin">SIGN IN / REGISTER</router-link></li>
                                <li v-if="authenticated"><router-link class="dropdown-item" to="/myAccount"><strong>{{user.f_name}} {{user.l_name}}</strong></router-link></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><router-link to="/myAccount/myOrders" class="dropdown-item">My orders</router-link></li>
                                <li v-if="authenticated"><a class="dropdown-item" @click="logout()" style="cursor:pointer">Sign out</a></li>
                            </ul>
                        </li>
                        <li class="nav-item me-4 dropdown">
                            <a class="nav-link nav-link-main dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <h5 class="m-0"><span class="fa fa-shopping-bag"></span> <span class="fs-6">{{$store.state.auth.cart.length}}</span></h5>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="width:400px">
                                
                                <div v-for="cart in $store.state.auth.cart" :key="cart.id" class="row m-0 p-2 border-bottom">
                                    <div class="col-md-3">
                                        <img class="img img-fluid" :src="`/storage/productsThumb/`+cart.p_image" alt="" style="">
                                    </div>
                                    <div class="col-md-8">
                                        <p class="m-0">{{cart.p_name}}</p>
                                        <p class="m-0">Color - <span class="badge rounded-pill"  :style="{backgroundColor:cart.color}">{{cart.color}}</span></p>
                                        <p class="m-0">Size - {{cart.size}}</p>
                                        <h5 class="mt-2"><strong>{{cart.price | numFormat}} Birr</strong></h5>
                                    </div>
                                </div>
                            
                                <div class="row m-0 p-2">
                                    <div class="col-md-12">
                                        <h5 class="text-end m-0">Total: <strong>{{sumPrice($store.state.auth.cart) | numFormat}} Birr</strong></h5>
                                    </div>
                                </div>
                                <div class="row m-0 p-2 border-top">
                                    <div class="col-md-12">
                                        <router-link to="/cart" class="btn btn-primary form-control rounded-1 py-3 text-white"><h5 class="m-0"><strong><span class="fa fa-shopping-bag"></span> VIEW BAG</strong></h5> </router-link>
                                    </div>
                                    
                                </div>
                                
                            </ul>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link nav-link-main" to="/"><h5 class="m-0"><span class="fa fa-heart"></span></h5></router-link>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>  
            <router-view></router-view>          
        </div>
        <div class="p-0">
             <admin-nav v-if="$store.state.auth.permissions == `ADMIN` && $store.state.auth.authenticated"></admin-nav>
        </div>
        <div class="p-0">
            <footer1></footer1>
        </div>
        <notifications group="foo" position="bottom right"/>
        
    </div>
</template>

<script>
import adminNav from './admin/adminNav.vue'
import footer1 from './footer.vue'
export default {
    components:{
        adminNav,
        footer1
    },
    data(){
        return{
            authenticated:false,
            user:{}
        }
    },
    mounted() {
        this.getCart()
        this.authenticated = this.$store.state.auth.authenticated
        this.user = this.$store.state.auth.user
        feather.replace();
        
    },
    methods:{
        sumPrice(cart){
            var sum = 0;
            cart.forEach(function(c){
                sum = sum + parseFloat(c.price)
            })
            return sum;
        },
        async getCart(){
            await axios.post('/getCart')
            .then( response => {
                this.$store.state.auth.cart = JSON.parse(response.data.items)
            })
        },
        logout: function(){
            axios.post("logout").then(response => { 
                window.location.replace("/signin");
            })
            .catch(error => {
            
            });
        },
    }
}
</script>