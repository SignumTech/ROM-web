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
                    <a class="nav-link active" aria-current="page" href="#">NEW ARRIVALS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">DISCOVER</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">SALE</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">SWIMWEAR</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">BABY</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">TODDLER GIRLS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">TODDLER BOYS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">BOYS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">GIRLS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">MATERNITY</a>
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
            heroImage:"/storage/settings/kids.jpg"
        }
    }
    
}
</script>