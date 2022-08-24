<template>
    <div class="row m-0">
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
                            <li v-if="authenticated"><router-link class="dropdown-item" to="/myProfile"><strong>{{user.f_name}} {{user.l_name}}</strong></router-link></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">My orders</a></li>
                            <li v-if="authenticated"><a class="dropdown-item" @click="logout()" style="cursor:pointer">Sign out</a></li>
                        </ul>
                    </li>
                    <li class="nav-item  me-4">
                        <router-link class="nav-link nav-link-main" to="/"><h5 class="m-0"><span class="fa fa-shopping-bag"></span></h5></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link nav-link-main" to="/"><h5 class="m-0"><span class="fa fa-heart"></span></h5></router-link>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <notifications group="foo" position="bottom right"/>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    data(){
        return{
            authenticated:false,
            user:{}

        }
    },
    mounted() {
        this.authenticated = this.$store.state.auth.authenticated
        this.user = this.$store.state.auth.user
    },
    methods:{
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