<template>
<div class="row mt-4">
    <div class="col-md-12">
        <h5><strong>Flash Sales</strong></h5>
    </div>
    <div class="col-md-12">
        <button @click="addFlash()" class="btn btn-primary btn-sm float-end shadow text-white"><span class="fa fa-plus"></span> Add Flash Sale</button>
    </div>
    <div v-for="flash,index in flashes" :key="index" class="col-md-4 mt-3">
        <div class="bg-white rounded-1 p-3 shadow-sm border-top border-primary border-3">
            <h5><i data-feather="zap"></i> Flash Sale {{index +1}}</h5>
            <h6 class="mt-2">Starts at | {{flash.starts_at | moment("ddd, MMM Do YYYY h:mm:ss")}} </h6>
            <h6 class="mt-2">Ends at | {{flash.expiry_date | moment("ddd, MMM Do YYYY h:mm:ss")}}</h6>
        </div>
    </div>
</div>    
</template>
<script>
import addFlashVue from './addFlash.vue';

export default {
    data(){
        return{
            flashes:{}
        }
    },
    components:{
        addFlashVue
    },
    mounted(){
        this.getFlashes()
    },
    methods:{
        async getFlashes(){
            await axios.get('/flashSales')
            .then( response =>{
                this.flashes = response.data
            })
        },
        updateData(){
            this.getFlashes()    
        },
        addFlash(){
            this.$modal.show(
                addFlashVue,
                {},
                {"width":"600px", "height":"auto"},
                {"closed":this.updateData}
            )
        },
    }
 
}
</script>