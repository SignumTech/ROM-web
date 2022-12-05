<template>
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
                        <a class="nav-link" href="#">SALE</a>
                    </li>
                    <li v-for="subCat,index in subCats" :key="index" class="nav-item me-1">
                        <a class="nav-link" href="#">{{subCat.cat_name}}</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input v-model="query" type="text" class="form-control rounded-0" placeholder="Search..." aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button @click="searchItems()" class="btn btn-primary rounded-0" type="button" id="button-addon2"><span class="fa fa-search"></span></button>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>    
</template>
<script>
export default {
    props:['subCats'],
    data(){
        return{
            query
        }
    },
    
}
</script>