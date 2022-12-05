<template>
    <div>
        <subnavVue :subCats="subCats"></subnavVue>
    </div>
</template>
<script>
import subnavVue from './subnav.vue';
export default {
    components:{
        subnavVue
    },
    data(){
        return{
            subCats:{}
        }
    },
    mounted(){
        this.getSubCats()
    },
    methods:{
        async getSubCats(){
            await axios.get('/showSubCategories/'+this.$route.params.id)
            .then( response =>{
                this.subCats = response.data
            })
        }
    },
    watch: {
        $route (to, from) {
            this.getSubCats()
        }
    }
}
</script>