<template>
<div class="row m-0 p-0">
    <nav class="navbar shadow-sm navbar-expand-lg bg-white">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-1">
                    <a class="nav-link active" aria-current="page" href="#">MAKEUP</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">NEW IN</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">BEAUTY TOOLS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">WIGS & ACCS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">PERSONAL CARE</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">E-GIFT CARDS</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <hero :image="heroImage"></hero>
    <router-view></router-view>
</div>      
</template>
<script>
import hero from '../home/hero.vue'
export default {
    components:{
        hero
    },
    data(){
        return{
            heroImage:"/storage/settings/beauty.jpg"
        }
    }
}
</script>