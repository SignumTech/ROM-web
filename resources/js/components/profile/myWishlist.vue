<template>
<div class="col-md-9">
        <div class="row m-0">
            <div class="col-md-12">
                <h4 class="text-center"><strong>My Wishlist</strong></h4>
            </div>
            <div v-for="item in items" :key="item.id" class="col-md-3 mt-5">
                <wishlist-card :item="item"></wishlist-card>
            </div>

    </div>
</div>
</template>
<script>
import wishlistCard from '../home/wishlistCard.vue'
export default {
    components:{
        wishlistCard
    },
    mounted(){
        this.getWishlist()
    },
    data(){
        return{
            items:{}
        }
    },
    methods:{
        async getWishlist(){
            await axios.get('/getMyWishlist')
            .then( response =>{
                this.items = response.data
            })
        },
    }
}
</script>