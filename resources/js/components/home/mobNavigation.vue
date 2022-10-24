<template>
<div class="row">
    <div class="col-md-12">
        <div class="bg-white shadow-sm p-2">
            <span @click="showNav()" class="fa fa-bars"></span>
        </div>
    </div>
</div>    
</template>
<script>
import showNavModalVue from './showNavModal.vue'
export default {
    data(){
        return{

        }
    },
    methods:{
        showNav(){
            this.$modal.show(
                    showNavModalVue,
                    {},
                    { height: "100%", width: "300px", shiftX: -1}  
                );   
        }
    }
}
</script>