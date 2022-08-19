<template>
<div class="container justify-content-center">
    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="bg-white rounded-sm p-4">
                <form action="#" @submit.prevent="verfiyOTP">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center"><strong>Please enter the one time password to verify your account</strong></h5>
                            <h6 class="text-center">A code has been sent to your email</h6>
                        </div>
                        <div class="inputs d-flex flex-row justify-content-center mt-2"> 
                            <input required v-model="digits.digit1" class="m-2 form-control-auth auth-font text-center form-control rounded" type="text" id="first" maxlength="1" /> 
                            <input required v-model="digits.digit2" class="m-2 form-control-auth auth-font text-center form-control rounded" type="text" id="second" maxlength="1" /> 
                            <input required v-model="digits.digit3" class="m-2 form-control-auth auth-font text-center form-control rounded" type="text" id="third" maxlength="1" /> 
                            <input required v-model="digits.digit4" class="m-2 form-control-auth auth-font text-center form-control rounded" type="text" id="fourth" maxlength="1" /> 
                        </div>
                        <div class="col-md-12 mt-3">
                            <div v-if="regLoading" class="d-flex justify-content-center">
                                <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                            </div>
                            <button type="submit" v-if="!regLoading" class="btn btn-primary form-control form-control-auth-btn"><h5 class="m-0">Verify</h5></button>
                        </div>
                        <div class="col-md-12 mt-3">
                            <h6 class="text-center">Didnt get the code? <a href="">Resend</a></h6>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
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
            formData:{
                otp:null,
                user_id:null
            },
            digits:{
                digit1:null,
                digit2:null,
                digit3:null,
                digit4:null,
            },
            regLoading:false
        }
    },
    props:['user_id'],
    mounted(){
        this.formData.user_id = this.user_id;
    },
    methods:{
        async verifyOTP(){
            this.regLoading = true
            this.formData.otp = this.digits.digit1+this.digits.digit2+this.digits.digit3+this.digits.digit4
            await axios.post('/verifyOTP', this.formData)
            .then( response =>{
                window.location.replace('/');
            })
            .catch( error =>{
                this.regLoading = false
            })
        }
    }
}
</script>