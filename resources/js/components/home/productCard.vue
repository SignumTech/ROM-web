<template>
<div class="row m-0 show-add-btn">
    <div class="col-12  text-center">
        <img class="img img-fluid" src="/storage/products/dress_3.jpg" alt="">
    </div>
    <div class="col-md-12 text-center">
        <span class="add-cart">
            <button @click="detailsModal()" class="btn btn-light rounded-1 ps-4 pe-4 shadow"><strong>ADD TO BAG</strong></button>
        </span>
    </div>
    <div class="col-12 mt-1 mb-0">
        <h6 class="mb-0">Sheek orange robe dress.....</h6>
    </div>
    <div class="col-8 mt-1 mb-0">
        <h5 class="mb-0"><strong>1,500 Birr</strong></h5>
    </div>
    <div class="col-4 mt-1 mb-0">
        <h5 class="float-end mb-0"><span class="fa fa-heart "></span></h5>
    </div>
</div>   
</template>
<script>
import productDetailsModal from './productDetailsModal.vue';
export default {
    data(){
        return{

        }
    },
    methods:{
        detailsModal(){
            this.$modal.show(
                productDetailsModal,
                {},
                { "height" : "auto", "width" : "900px"},
                {}
            )
        }
    }
}
</script>