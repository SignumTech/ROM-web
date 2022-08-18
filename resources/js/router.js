import Vue from 'vue'
import Router from 'vue-router'

import login from './components/auth/login.vue'
import otp from './components/auth/otp.vue'
import forgetPassword from './components/auth/forgetPassword.vue'
import resetOTP from './components/auth/resetOTP.vue'
import resetPassword from './components/auth/resetPassword.vue'

Vue.use(Router)

const routes = [
    {
        path: '/login',
        component: login,
        name: 'Login'
    },  
    {
        path: '/otp',
        component: otp,
        name: 'Otp'
    },  
    {
        path: '/forgetPassword',
        component: forgetPassword,
        name: 'ForgetPassword'
    },     
    ,     
    {
        path: '/resetOTP',
        component: resetOTP,
        name: 'ResetOTP'
    }, 
    {
        path: '/resetPassword',
        component: resetPassword,
        name: 'ResetPassword'
    },       
]

export default new  Router({
    mode: 'history',
    routes
})
