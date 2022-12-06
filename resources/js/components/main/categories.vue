<template>
<div class="row m-0 px-md-5 px-sm-1 pb-5 pt-3">
    <div v-for="category in categories" :key="category.id" class="col-md-2 col-6 mt-4">
        <router-link :to="`/women/shopByCategory/`+category.id">
            <div class="bg-white rounded-1 shadow-sm">
                <div class="row m-0 ">
                    <div class="col-6 ps-0 align-self-center">
                        <img :src="`/storage/settings/`+category.cat_image" class="img img-fluid" alt="">
                    </div>
                    <div class="col-6 align-self-center">
                        <h6 class="m-0"><strong>{{category.cat_name}}</strong></h6>
                    </div>
                </div>
            </div>
        </router-link>
    </div>
</div>   
</template>
<script>
export default {
    props:['categories']
}
</script>