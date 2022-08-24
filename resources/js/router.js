import Vue from 'vue'
import Router from 'vue-router'
/////////////////////main//////////////////////////////////////
import women from './components/main/women.vue'
import men from './components/main/men.vue'
import kids from './components/main/kids.vue'
import home from './components/main/home.vue'
import curvePlus from './components/main/curvePlus.vue'
import beauty from './components/main/beauty.vue'
import africanClothing from './components/main/africanClothing.vue'
///////////////////////////////////////////////////////////////
//import home from './components/home/home.vue'
import shopByCategory from './components/home/shopByCategory.vue'
import womenHome from './components/home/womenHome.vue'
import menHome from './components/home/menHome.vue'
import curveHome from './components/home/curveHome.vue'
import kidsHome from './components/home/kidsHome.vue'
import homesHome from './components/home/homesHome.vue'
import africanHome from './components/home/africanHome.vue'
import beautyHome from './components/home/beautyHome.vue'
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
        path: '/women',
        component: women,
        name: 'Women',
        children: [
            {
                path: '/',
                component: womenHome,
                name: 'WomenHome'
                
            }, 
            {
                path: '/women/shopByCategory',
                component: shopByCategory,
                name: 'ShopByCategory'
                
            }, 
        ]
    },
    {
        path: '/men',
        component: men,
        name: 'Men',
        children: [
            {
                path: '/',
                component: menHome,
                name: 'MenHome'
                
            },
            {
                path: '/men/shopByCategory',
                component: shopByCategory,
                name: 'ShopByCategory',
                props: true
            }, 
        ]
    },
    {
        path: '/kids',
        component: kids,
        name: 'Kids',
        children: [
            {
                path: '/',
                component: kidsHome,
                name: 'KidsHome'
                
            },
            {
                path: '/kids/shopByCategory',
                component: shopByCategory,
                name: 'ShopByCategory',
                props: true
            }, 
        ]
    },
    {
        path: '/curvePlus',
        component: curvePlus,
        name: 'CurvePlus',
        children: [
            {
                path: '/',
                component: curveHome,
                name: 'CurveHome'
                
            },
            {
                path: '/curvePlus/shopByCategory',
                component: shopByCategory,
                name: 'ShopByCategory',
                props: true
            }, 
        ]
    },
    {
        path: '/beauty',
        component: beauty,
        name: 'Beauty',
        children: [
            {
                path: '/',
                component: beautyHome,
                name: 'BeautyHome'
                
            },
            {
                path: '/beauty/shopByCategory',
                component: shopByCategory,
                name: 'ShopByCategory',
                props: true
            }, 
        ]
    },
    {
        path: '/home',
        component: home,
        name: 'Home',
        children: [
            {
                path: '/',
                component: homesHome,
                name: 'HomesHome'
                
            },
            {
                path: '/home/shopByCategory',
                component: shopByCategory,
                name: 'ShopByCategory',
                props: true
            }, 
        ]
    },
    {
        path: '/africanClothing',
        component: africanClothing,
        name: 'AfricanClothing',
        children: [
            {
                path: '/',
                component: africanHome,
                name: 'AfricanHome'
                
            },
            {
                path: '/africanClothing/shopByCategory',
                component: shopByCategory,
                name: 'ShopByCategory',
                props: true
            }, 
        ]
    },
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
        redirect: '/women'
    },    
]

export default new  Router({
    mode: 'history',
    routes
})
