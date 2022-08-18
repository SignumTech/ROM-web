<template>
<div class="container justify-content-center">
    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="bg-white rounded-sm p-4">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-center"><strong>Please enter your email below</strong></h5>
                        <h6 class="text-center">We will send you an OTP on your email</h6>
                    </div>
                    <div class="col-md-12 mt-3">
                        <input v-model="formData.email" type="email" class="form-control form-control-auth" placeholder="Email address">
                    </div>
                    <div class="col-md-12 mt-3">
                        <button @click="sendReset()" class="btn btn-primary form-control form-control-auth-btn"><h5 class="m-0">Continue</h5></button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return{
            formData:{
                email: null
            }
        }
    },
    methods:{
        async sendReset(){
            await axios.post('/foregetPasswordMailer', this.formData)
            .then( response =>{
                
                this.$router.push({ name: 'ResetOTP', params:{
                    user_id: response.data.id
                }});
            })
        },
    }
}
</script>