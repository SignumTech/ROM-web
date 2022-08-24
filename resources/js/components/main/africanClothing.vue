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
                    <a class="nav-link active" aria-current="page" href="#">EAST AFRICAN FOR WOMEN</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">EAST AFRICAN FOR MEN</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">EAST AFRICAN FOR KIDS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">WEST AFRICAN FOR WOMEN</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">WEST AFRICAN FOR MEN</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">WEST AFRICAN FOR KIDS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">SOUTH AFRICAN FOR WOMEN</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">SOUTH AFRICAN FOR MEN</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">SOUTH AFRICAN FOR KIDS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">NORTH AFRICAN FOR WOMEN</a>
                </li>
                                <li class="nav-item me-1">
                    <a class="nav-link" href="#">NORTH AFRICAN FOR MEN</a>
                </li>
                                <li class="nav-item me-1">
                    <a class="nav-link" href="#">NORTH AFRICAN FOR KIDS</a>
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
            heroImage:"/storage/settings/african.jpg"
        }
    }
    
}
</script>