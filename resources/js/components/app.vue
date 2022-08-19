<template>
    <div class="row m-0">
        <nav class="navbar navbar-expand-lg pe-2 ps-2 main-nav">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#"><h2 class="m-0"><strong>ROM</strong></h2></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link nav-link-main nav-link-active" aria-current="page" href="#"><h5 class="m-0">WOMEN</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link nav-link-main" href="#"><h5 class="m-0">CURVE + PLUS</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link nav-link-main" href="#"><h5 class="m-0">KIDS</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link nav-link-main" href="#"><h5 class="m-0">MEN</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link nav-link-main" href="#"><h5 class="m-0">BEAUTY</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link nav-link-main" href="#"><h5 class="m-0">HOME</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link nav-link-main" href="#"><h5 class="m-0">AFRICAN CLOTHING</h5></a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4 dropdown">
                        <a class="nav-link nav-link-main dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><h5 class="m-0"><span class="fa fa-user"></span></h5></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><router-link class="dropdown-item" to="/signin">SIGN IN / REGISTER</router-link></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">My orders</a></li>
                        </ul>
                    </li>
                    <li class="nav-item  me-4">
                        <router-link class="nav-link nav-link-main" to="/otp"><h5 class="m-0"><span class="fa fa-shopping-bag"></span></h5></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link nav-link-main" to="/forgetPassword"><h5 class="m-0"><span class="fa fa-heart"></span></h5></router-link>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg ps-2 pe-2 bg-white">
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
                        <a class="nav-link" href="#">TRENDS</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link" href="#">TOP RATED</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link" href="#">SALE</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link" href="#">ROM DESIGNERS</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link" href="#">CLOTHING</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link" href="#">DRESSES</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link" href="#">BEACHWEAR</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link" href="#">TOPS</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link" href="#">LINGERIE AND LOUNGE</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        mounted() {
            
        }
    }
</script>