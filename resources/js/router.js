import Vue from 'vue'
import Router from 'vue-router'

import login from './components/login.vue'

Vue.use(Router)

const routes = [
    {
        path: '/login',
        component: login,
        name: 'Login'
    },           
]

export default new  Router({
    mode: 'history',
    routes
})
