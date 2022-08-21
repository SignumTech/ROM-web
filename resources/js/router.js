import Vue from 'vue'
import Router from 'vue-router'

///////////////////////////////////////////////////////////////
import home from './components/home/home.vue'
///////////////////////////////////////////////////////////////
import signin from './components/auth/signin.vue'
import otp from './components/auth/otp.vue'
import forgetPassword from './components/auth/forgetPassword.vue'
import resetOTP from './components/auth/resetOTP.vue'
import resetPassword from './components/auth/resetPassword.vue'
///////////////////////////////////////////////////////////////
import myProfile from './components/profile/myProfile.vue'

Vue.use(Router)

const routes = [
    {
        path: '/signin',
        component: signin,
        name: 'Signin'
    },  
    {
        path: '/otp',
        component: otp,
        name: 'Otp',
        props: true
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
        name: 'ResetOTP',
        props: true
    }, 
    {
        path: '/resetPassword',
        component: resetPassword,
        name: 'ResetPassword',
        props: true
    },   
    {
        path: '/myProfile',
        component: myProfile,
        name: 'MyProfile',
        props: true
    },  
    {
        path: '/',
        component: home,
        name: 'Home',
        props: true
    },    
]

export default new  Router({
    mode: 'history',
    routes
})
