<template>
<div class="p-0">
    <hero :image="heroImage"></hero>    
</div>
</template>
<script>
import hero from './hero.vue'
export default {
    components:{
        hero
    },
    data(){
        return{
            heroImage:"/storage/settings/men.jpg"
        }
    }
    
}
</script>