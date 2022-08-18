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
                        <button @click="resetPassword()" class="btn btn-primary form-control form-control-auth-btn"><h5 class="m-0">Reste</h5></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    props:['user_id'],
    data(){
        return{
            formData:{
                password: null,
                password_confirmation: null,
                user_id: null,
            }
        }
    },
    mounted(){
        this.formData.user_id = this.user_id
    },
    methods:{
        async sendReset(){
            await axios.post('/resetPassword', this.formData)
            .then( response =>{
                window.location.replace('/');
            })
        },
    }
}
</script>