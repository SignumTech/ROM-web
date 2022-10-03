<template>
<div @mouseover="slideShow()" @mouseleave="backToStatic()" class="row m-0 show-add-btn">
    <div class="col-12  text-center">
        <img class="img img-fluid" :src="`/storage/products/`+mainPic" alt="">
    </div>
    <div class="col-md-12 text-center">
        <span class="add-cart">
            <button @click="detailsModal(item.id)" class="btn btn-light rounded-1 ps-4 pe-4 shadow"><strong>ADD TO BAG</strong></button>
        </span>
    </div>
    <div class="col-12 mt-1 mb-0">
        <h6 class="mb-0">{{item.p_name}}</h6>
    </div>
    <div class="col-8 mt-1 mb-0">
        <h5 class="mb-0"><strong>{{item.price}} Birr</strong></h5>
    </div>
    <div class="col-4 mt-1 mb-0">
        <h6 class="float-end mb-0"><i data-feather="heart"></i></h6>
    </div>
</div>   
</template>
<script>
import productDetailsModal from './productDetailsModal.vue';
export default {
    data(){
        return{
            mainPic:JSON.parse(this.item.p_image)['main']
        }
    },
    props:['item'],
    mounted(){
        feather.replace();
    },
    methods:{
        detailsModal(id){
            this.$modal.show(
                productDetailsModal,
                {"id":id},
                { "height" : "auto", "width" : "900px"},
                {}
            )
        },
        slideShow(){
            //slideshow
        },
        backToStatic(){
            //slideshow
        }
    }
}
</script>