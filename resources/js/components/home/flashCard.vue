<template>
<div class="row m-0 show-add-btn">
    <div class="col-12" style="margin-bottom: -100px; z-index: 2;">
        <span class="bg-info text-white p-2 fs-5"><strong>-52%</strong></span>
    </div>
    <div class="col-12  text-center">
        <img class="img img-fluid" :src="`/storage/products/`+item.p_image" alt="">
    </div>
    <div class="col-md-12 text-center">
        <span class="add-cart">
            <button @click="detailsModal(item.id)" class="btn btn-light rounded-1 ps-4 pe-4 shadow"><strong>ADD TO BAG</strong></button>
        </span>
    </div>
    <div class="col-8 mt-1 mb-0">
        <h6 class="mb-0 text-danger"></h6>
    </div>
    <div class="col-12 mt-1 mb-0">
        <h5 class="mb-0"><strong><span>{{495 | numFormat}} ETB</span> <span class="text-muted fs-6"><s><strong>{{item.price | numFormat}} ETB</strong></s></span> </strong></h5>
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
    props:['item'],
    methods:{
        detailsModal(id){
            this.$modal.show(
                productDetailsModal,
                {"id":id},
                { "height" : "auto", "width" : "900px"},
                {}
            )
        }
    }
}
</script>