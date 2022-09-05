import Vue from 'vue'
import Router from 'vue-router'
import store from './store'
//////////////////////admin////////////////////////////////////
import adminDash from './components/admin/adminDash.vue'
import categories from './components/admin/categories.vue'
import products from './components/admin/products.vue'
import addProducts from './components/admin/addProduct.vue'
import editProducts from './components/admin/editProduct.vue'
/////////////////////checkout process/////////////////////////
import cart from './components/home/cart.vue'
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
        path: '/cart',
        component: cart,
        name: 'Cart'
    },
    {
        path: '/admin/adminDash',
        component: adminDash,
        name: 'AdminDash'
    },
    {
        path: '/admin/categories',
        component: categories,
        name: 'Categories'
    },
    {
        path: '/admin/products',
        component: products,
        name: 'Products'
    },
    {
        path: '/admin/addProducts',
        component: addProducts,
        name: 'AddProducts',
        props: true
    },
    {
        path: '/admin/editProduct/:id',
        component: editProducts,
        name: 'EditProduct',
        props: true
    },
    {
        path: '/women',
        component: women,
        children: [
            {
                path: '/',
                component: womenHome,
                name: 'WomenHome'
                
            }, 
            {
                path: '/women/shopByCategory/:id',
                component: shopByCategory,
                name: 'WomenCat',
                props: true
                
            }, 
        ]
    },
    {
        path: '/men',
        component: men,
        children: [
            {
                path: '/',
                component: menHome,
                name: 'MenHome'
                
            },
            {
                path: '/men/shopByCategory/:id',
                component: shopByCategory,
                name: 'MenCat',
                props: true
            }, 
        ]
    },
    {
        path: '/kids',
        component: kids,
        children: [
            {
                path: '/',
                component: kidsHome,
                name: 'KidsHome'
                
            },
            {
                path: '/kids/shopByCategory/:id',
                component: shopByCategory,
                name: 'KidsCat',
                props: true
            }, 
        ]
    },
    {
        path: '/curvePlus',
        component: curvePlus,
        children: [
            {
                path: '/',
                component: curveHome,
                name: 'CurveHome'
                
            },
            {
                path: '/curvePlus/shopByCategory/:id',
                component: shopByCategory,
                name: 'CurveCat',
                props: true
            }, 
        ]
    },
    {
        path: '/beauty',
        component: beauty,
        children: [
            {
                path: '/',
                component: beautyHome,
                name: 'BeautyHome'
                
            },
            {
                path: '/beauty/shopByCategory/:id',
                component: shopByCategory,
                name: 'BeautyCat',
                props: true
            }, 
        ]
    },
    {
        path: '/home',
        component: home,
        children: [
            {
                path: '/',
                component: homesHome,
                name: 'HomeHome'
                
            },
            {
                path: '/home/shopByCategory/:id',
                component: shopByCategory,
                name: 'HomeCat',
                props: true
            }, 
        ]
    },
    {
        path: '/africanClothing',
        component: africanClothing,
        children: [
            {
                path: '/',
                component: africanHome,
                name: 'AfricanHome'
                
            },
            {
                path: '/africanClothing/shopByCategory/:id',
                component: shopByCategory,
                name: 'AfricanCat',
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
        beforeEnter: (to, from, next)=>{
            if(store.state.auth.permissions == 'ADMIN'){
                next('/adminDash')
            }
            else{
                next('/women')
            }
        }
        
    },    
]

export default new  Router({
    mode: 'history',
    routes
})
