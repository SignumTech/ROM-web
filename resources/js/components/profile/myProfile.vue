<template>
<div class="col-md-9">
    <div class="row m-0">
        <div class="col-md-12">
            <h4 class="text-center"><strong>My Profile</strong></h4>
        </div>
    </div>
    <div class="bg-white rounded-1 shadow-sm p-3 mt-4">
        <div v-if="loading" class="row mx-0 mt-3 p-3">
            <div  class="col-md-12 p-5 mt-4">
                <div class="d-flex justify-content-center align-self-center">
                    <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                </div>
            </div>
        </div>
        <form v-if="!loading" action="#" @submit.prevent="updateInfo">
            <div class="row mx-0">
                <div class="col-md-12">
                    <h5><strong>Information</strong></h5>
                </div>
                <div class="col-md-6">
                    <label for="email">First Name</label>
                    <input required v-model="detailsForm.f_name" type="text" class="form-control form-control-auth" placeholder="First Name">
                    <h6 v-for="er in loginErrors.f_name" :key="er.id" class="text-danger m-0">{{er}}</h6>
                </div>
                <div class="col-md-6">
                    <label for="email">Last Name</label>
                    <input required v-model="detailsForm.l_name" type="text" class="form-control form-control-auth" placeholder="Last Name">
                    <h6 v-for="er in loginErrors.l_name" :key="er.id" class="text-danger m-0">{{er}}</h6>
                </div>
            </div>   
            <div class="row mx-0 mt-5">
                <div class="col-md-12">
                    <h5><strong>Style preferences</strong></h5>
                    <span  v-for="cat in mainCategories" :key="cat.id" :class="(stylePreference.includes(cat.id))?`badge text-dark rounded-2 px-3 badge bg-light border border-dark border-1 shadow-sm ms-3 mt-3`:`badge text-dark rounded-2 px-3 badge bg-light shadow-sm ms-3 mt-3`"><h5 class="m-0"><span @click="(stylePreference.includes(cat.id))?'':addPreference(cat.id)" style="cursor:pointer">{{cat.cat_name}}</span> <span @click="removePreference(cat.id)" v-if="stylePreference.includes(cat.id)" class="fa fa-times ms-2 fs-6" style="cursor:pointer"></span></h5></span>
                </div>
            </div> 
            <div class="row mx-0 mt-5">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary float-end rounded-1 px-3"><span class="fa fa-save"></span> SAVE</button>
                </div>
            </div>              
        </form>
  
    </div>

</div>
</template>
<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
export default {
    components:{
        PulseLoader
    },
    data(){
        return{
            loading:false,
            mainCategories:{},
            detailsForm:{
                f_name:"",
                l_name:"",
                id:""
            },
            loginErrors:{},
            stylePreference:{}
        }
    },
    mounted(){
        this.getCategories()
        this.stylePreference = JSON.parse(this.$store.state.auth.user.style_preference)
        this.detailsForm.f_name = this.$store.state.auth.user.f_name
        this.detailsForm.l_name = this.$store.state.auth.user.l_name
        this.detailsForm.id = this.$store.state.auth.user.id
    },
    methods:{
        async updateInfo(){
            this.loading = true
            await axios.post('/updateInfo',{detailsForm:this.detailsForm,style_preference:this.stylePreference})
            .then( response =>{
                this.$notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Informationa Updated!',
                    text: 'Your profile information was updated successfully'
                });
                this.loading = false
            })
        },
        addPreference(id){
            this.stylePreference.push(id)
        },
        removePreference(id){
            for( var i = 0; i < this.stylePreference.length; i++){ 
    
                if ( this.stylePreference[i] === id) { 

                    this.stylePreference.splice(i, 1); 
                }

            }
        },
        async getCategories(){
            await axios.get('/getMainCategories')
            .then( response =>{
                this.mainCategories = response.data
            })
        }
    }
}
</script>