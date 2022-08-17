import Vue from 'vue'
import Router from 'vue-router'

import login from './components/auth/login.vue'
import otp from './components/auth/otp.vue'

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
]

export default new  Router({
    mode: 'history',
    routes
})
