<template>
<div class="container justify-content-center">
    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="bg-white rounded-sm p-4">
                <form action="#" @submit.prevent="verifyOTP">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center"><strong>Please enter the one time password to verify your account</strong></h5>
                            <h6 class="text-center">A code has been sent to your email</h6>
                        </div>
                        <div class="inputs d-flex flex-row justify-content-center mt-2">
                            <v-otp-input
                            ref="otpInput"
                            input-classes="otp-input"
                            separator="-"
                            :num-inputs="4"
                            :should-auto-focus="true"
                            :is-input-num="true"
                            @on-change="handleOnChange"
                            @on-complete="handleOnComplete"
                            />                            
                        </div>

                        <div class="col-md-12 mt-3">
                            <div v-if="regLoading" class="d-flex justify-content-center">
                                <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                            </div>
                            <button type="submit" v-if="!regLoading" :disabled="!completed" class="btn btn-primary form-control form-control-auth-btn"><h5 class="m-0">Verify</h5></button>
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
            regLoading:false,
            completed:false,
        }
    },
    props:['user_id'],
    mounted(){
        this.formData.user_id = this.user_id;
    },
    methods:{
        async verifyOTP(){
            this.regLoading = true
            await axios.post('/verifyOTP', this.formData)
            .then( response =>{
                window.location.replace('/');
            })
            .catch( error =>{
                this.regLoading = false
            })
        },
        handleOnComplete(value) {
            this.formData.otp = value;
            this.completed = true;
        },
        handleOnChange(value){
            if(value.length < 4){
                this.completed = false;
            }
        }
    }
}
</script>