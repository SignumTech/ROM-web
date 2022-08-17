<template>
    <div class="row m-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white p-2">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><h2 class="m-0"><strong>ROM</strong></h2></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link active" aria-current="page" href="#"><h5 class="m-0">WOMEN</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><h5 class="m-0">CURVE + PLUS</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><h5 class="m-0">KIDS</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><h5 class="m-0">MEN</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><h5 class="m-0">BEAUTY</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><h5 class="m-0">HOME</h5></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><h5 class="m-0">AFRICAN CLOTHING</h5></a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><h4><span class="fa fa-user"></span></h4></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><router-link class="dropdown-item" to="/login">SIGN IN / REGISTER</router-link></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">My orders</a></li>
                        </ul>
                    </li>
                    <li class="nav-item me-4">
                        <router-link class="nav-link" to="/otp"><h4><span class="fa fa-shopping-bag"></span></h4></router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><h4><span class="fa fa-heart"></span></h4></a>
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
            console.log('Component mounted.')
        }
    }
</script>
<style>
.dropdown-toggle::after {
            content: none;
        }
</style>