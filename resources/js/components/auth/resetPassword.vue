<template>
<div class="container justify-content-center">
    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="bg-white rounded-sm p-4">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-center"><strong>Please enter the one time password to reset your password</strong></h5>
                        <h6 class="text-center">A code has been sent to your email</h6>
                    </div>
                    <div class="inputs d-flex flex-row justify-content-center mt-2"> 
                        <input class="m-2 form-control-auth auth-font text-center form-control rounded" type="text" id="first" maxlength="1" /> 
                        <input class="m-2 form-control-auth auth-font text-center form-control rounded" type="text" id="second" maxlength="1" /> 
                        <input class="m-2 form-control-auth auth-font text-center form-control rounded" type="text" id="third" maxlength="1" /> 
                        <input class="m-2 form-control-auth auth-font text-center form-control rounded" type="text" id="fourth" maxlength="1" /> 
                    </div>
                    <div class="col-md-12 mt-3">
                        <button class="btn btn-primary form-control form-control-auth-btn"><h5 class="m-0">Verify</h5></button>
                    </div>
                    <div class="col-md-12 mt-3">
                        <h6 class="text-center">Didnt get the code? <a href="">Resend</a></h6>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>    
</template>
<script>
export default {
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
            }
        }
    },
    props:['user_id'],
    mounted(){
        this.formData = this.user_id;
    },
    methods:{
        async verifyReset(){
            this.formData.otp = this.digits.digit1+this.digits.digit2+this.digits.digit3+this.digits.digit4
            await axios.post('/resetVerify', this.formData)
            .then( response =>{
                console.log(response.data)
            })
        }
    }
}
</script>
<style>
.btn-primary{
    color:white;
    border-color: #bf7f25;
    background-color: #bf7f25;
}
.auth-font{
    font-size: 20px;
}
</style>