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
                    <a class="nav-link" href="#">TRENDS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">TOP RATED</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">SALE</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">CLOTHING</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">TOPS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">BOTTOMS</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">SWIMWEAR</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">SHOES & ACCESSORIES</a>
                </li>
                <li class="nav-item me-1">
                    <a class="nav-link" href="#">E-GIFT CARDS</a>
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

}
</script>