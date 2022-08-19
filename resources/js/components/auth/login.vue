<template>
<div class="container justify-content-center">
    <div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="bg-white rounded-sm p-4">
                <div class="row">
                    <div class="col-md-6 border-end">
                        <h4 class="text-center"><strong>SIGN IN</strong></h4>
                        <form action="#" @submit.prevent="login">
                            <div class="row m-0 mt-4">
                                <div class="col-md-12">
                                    <label for="email">Email Address</label>
                                    <input v-model="logForm.email" required type="email" class="form-control form-control-auth" placeholder="Email address">
                                </div>
                            </div>
                            <div class="row m-0 mt-4">
                                <div class="col-md-12">
                                    <label for="password">Password</label>
                                    <input v-model="logForm.password" required type="password" pattern="\w{8}" title="your password must be atleast 8 characters" class="form-control form-control-auth" placeholder="Password">
                                </div>
                            </div>   
                            <div class="row m-0 mt-4">
                                <div class="col-md-12">
                                    <div v-if="logLoading" class="d-flex justify-content-center">
                                        <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                                    </div>
                                    <button type="submit" v-if="!logLoading" class="btn btn-primary form-control form-control-auth-btn"><h5 class="m-0"><strong>SIGN IN</strong></h5></button>
                                    <router-link to="/forgetPassword"><h6 class="text-center mt-3">Forgot your password?</h6></router-link>
                                </div>
                                
                                <div class="col-md-6 mt-3 border-end">
                                    <img src="/storage/settings/google.png" class="img img-fluid d-flex m-auto" alt="" style="width:40px; height:40px">
                                    <h6 class="text-center mt-2">Sign in with google</h6>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <img src="/storage/settings/facebook.png" class="img img-fluid d-flex m-auto" alt="" style="width:40px; height:40px">
                                    <h6 class="text-center mt-2">Sign in with facebook</h6>
                                </div>
                            </div>
                        </form>                      
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-center"><strong>REGISTER</strong></h4>
                        <form action="#" @submit.prevent="registerUser">
                            <div class="row m-0 mt-4">
                                <div class="col-md-6">
                                    <label for="email">First Name</label>
                                    <input required v-model="registerData.f_name" type="text" class="form-control form-control-auth" placeholder="First Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Last Name</label>
                                    <input required v-model="registerData.l_name" type="text" class="form-control form-control-auth" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="row m-0 mt-4">
                                <div class="col-md-12">
                                    <label for="email">Email Address</label>
                                    <input required v-model="registerData.email" type="email" class="form-control form-control-auth" placeholder="Email address">
                                </div>
                            </div>
                            <div class="row m-0 mt-4">
                                <div class="col-md-12">
                                    <label for="email">Password</label>
                                    <input required v-model="registerData.password" type="password" class="form-control form-control-auth" placeholder="Password">
                                </div>
                            </div> 
                            <div class="row m-0 mt-4">
                                <div class="col-md-12">
                                    <label for="email">ConfirmPassword</label>
                                    <input required v-model="registerData.password_confirmation" type="password" class="form-control form-control-auth" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="row m-0 mt-4">
                                <div class="col-md-12">
                                    <h6>Style preference</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Women
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Men
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Home
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Plus Size
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Kids
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Pets
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0 mt-4">
                                <div class="col-md-12">
                                    <div v-if="regLoading" class="d-flex justify-content-center">
                                        <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                                    </div>
                                    <button type="submit" v-if="!regLoading" class="btn btn-primary form-control form-control-auth-btn" ><h5 class="m-0"><strong>REGISTER</strong></h5></button>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-md-2"></div>      
    </div>

</div>
</template>
<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
  import { mapActions } from 'vuex'
export default {
        components:{
            PulseLoader
        },
        data(){
            return{
                registerData:{
                    f_name:null,
                    l_name:null,
                    email:null,
                    password:null,
                    password_confirmation:null,
                },
                logForm: {
                    email: null,
                    password: null,
                },
                regLoading:false,
                logLoading:false
            }
        },
        methods:{
            ...mapActions({
                signIn: 'auth/signIn'
            }),

            async login () {
                this.logLoading = true
                await this.signIn(this.logForm)
                window.location.replace('/')
                this.logLoading = false
            },
            async registerUser(){
                this.regLoading = true
                await axios.post('/registerUser', this.registerData)
                .then( response =>{
                    this.$router.push({name: 'Otp', params:{
                        user_id: response.data.id
                    }})
                })
                .catch( error=>{
                    this.regLoading = false
                })
            },

        }
    }
</script>