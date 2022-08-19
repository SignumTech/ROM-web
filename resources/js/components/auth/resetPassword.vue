<template>
<div class="container justify-content-center">
    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="bg-white rounded-sm p-4">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-center"><strong>Please enter your new password below</strong></h5>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="new_password">New password</label>
                        <input v-model="formData.password" type="password" class="form-control form-control-auth" placeholder="Email address">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="new_password">Confirm password</label>
                        <input v-model="formData.password_confirmation" type="password" class="form-control form-control-auth" placeholder="Email address">
                    </div>
                    <div class="col-md-12 mt-3">
                        <div v-if="regLoading" class="d-flex justify-content-center">
                            <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                        </div>
                        <button v-if="!regLoading" @click="resetPassword()" class="btn btn-primary form-control form-control-auth-btn"><h5 class="m-0">Reste</h5></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
export default {
    components:{
        PulseLoader
    },
    props:['user_id'],
    data(){
        return{
            formData:{
                password: null,
                password_confirmation: null,
                user_id: null,
            },
            regLoading:false
        }
    },
    mounted(){
        this.formData.user_id = this.user_id
    },
    methods:{
        async resetPassword(){
            this.regLoading = true
            await axios.post('/resetPassword', this.formData)
            .then( response =>{
                window.location.replace('/');
            })
            .catch( error =>{
                this.regLoading = false
            })
        },
    }
}
</script>