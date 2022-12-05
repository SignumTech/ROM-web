import Vue from 'vue'
import Router from 'vue-router'
import store from './store'

/////////////////////checkout process/////////////////////////
import cart from './components/home/cart.vue'
import placeOrder from './components/home/placeOrder.vue'
import pay from './components/home/pay.vue'
import orderComplete from './components/home/orderComplete.vue'

/////////////////////main//////////////////////////////////////
import women from './components/main/women.vue'
import home from './components/main/home.vue'
import searchResults from './components/main/searchResults.vue'
///////////////////////////////////////////////////////////////
//import home from './components/home/home.vue'
import shopByCategory from './components/home/shopByCategory.vue'
import womenHome from './components/home/womenHome.vue'
import productDetail from './components/home/mobProductDetail.vue'
///////////////////////////////////////////////////////////////
import signin from './components/auth/signin.vue'
import otp from './components/auth/otp.vue'
import forgetPassword from './components/auth/forgetPassword.vue'
import resetOTP from './components/auth/resetOTP.vue'
import resetPassword from './components/auth/resetPassword.vue'
///////////////////////////////////////////////////////////////
import myAccount from './components/profile/myAccount.vue'
import myAccountHome from './components/profile/myAccountHome.vue'
import myProfile from './components/profile/myProfile.vue'
import myOrders from './components/profile/myOrders.vue'
import addressBook from './components/profile/addressBook.vue'
import orderDetails from './components/profile/orderDetails.vue'
import wishlist from './components/profile/myWishlist.vue'


Vue.use(Router)

const routes = [
    {
        path: '/home/:id',
        component: home,
        name: 'Home',
        props: true
    },
    {
        path: '/orderComplete',
        component: orderComplete,
        name: 'OrderComplete',
        props: true
    },
    {
        path: '/pay',
        component: pay,
        name: 'Pay',
        props: true
    },
    {
        path: '/placeOrder',
        component: placeOrder,
        name: 'PlaceOrder',
        props: true
    },
    {
        path: '/cart',
        component: cart,
        name: 'Cart'
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
            {
                path: '/women/productDetail/:id',
                component: productDetail,
                name: 'productDetail',
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
        path: '/myAccount',
        component: myAccount,
        props: true,
        children:[
            {
                path: '/',
                component: myAccountHome,
                name: 'MyAccount'
            },
            {
                path: '/myAccount/myProfile',
                component: myProfile,
                name: 'MyProfile'
            }
            ,
            {
                path: '/myAccount/myOrders',
                component: myOrders,
                name: 'MyOrders',
                props: true
            }
            ,
            {
                path: '/myAccount/addressBook',
                component: addressBook,
                name: 'AddressBook'
            }
            ,
            {
                path: '/myAccount/orderDetails/:id',
                component: orderDetails,
                name: 'OrderDetails'
            }
            ,
            {
                path: '/myAccount/myWishlist',
                component: wishlist,
                name: 'Wishlist'
            }
        ]
    },  
    {
        path: '/',
        component: home,
    },    
    {
        path: '/search/:query',
        component: searchResults,
        name: 'SearchResults',
        props: true
    },
    
    
]

export default new  Router({
    mode: 'history',
    routes
})
