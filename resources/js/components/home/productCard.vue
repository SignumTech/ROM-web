<template>
<div @mouseover="slideShow()" @mouseleave="backToStatic()" class="row show-add-btn">
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
    <div class="col-4 mt-1 mb-0 fs-6">
        <h6 v-if="!item.wishlist" @click="addToWishlist()" class="float-end mb-0" style="cursor:pointer"><i data-feather="heart"></i></h6>
        <h4 v-if="item.wishlist" @click="removeFromWishlist()" class="float-end mb-0" style="cursor:pointer"><i class="fa fa-heart"></i></h4>
    </div>
</div>   
</template>
<script>
import wishlistSignin from './wishlistSignin.vue';
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
        async removeFromWishlist(){
            await axios.delete('/removeFromWishlist/'+this.item.id)
            .then( response =>{
                this.item.wishlist = false
                this.$notify({
                        group: 'foo',
                        type: 'success',
                        title: 'Item removed from wishlist',
                        text: 'Your item was successfully removed from your wishlist'
                    });
                    location.reload();
            })
        },
        async getWishlist(){
            await axios.get('/getMyWishlist')
            .then( response =>{
                this.$store.state.auth.wishlist = response.data
            })
        },
        async addToWishlist(){
            if(!this.$store.state.auth.authenticated){
                this.$modal.show(
                    wishlistSignin,
                    {"item":this.item},
                    {"width":"900px", "height":"500px"},
                    {"closed":this.getWishlist}
                )
            }
            else{
                await axios.get('/addToWishlist/'+this.item.id)
                .then( response =>{
                    this.item.wishlist = true
                    this.$notify({
                        group: 'foo',
                        type: 'success',
                        title: 'Item added to wishlist',
                        text: 'Your item was successfully added to wishlist'
                    });
                    this.getWishlist()
                })
            }
        },
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