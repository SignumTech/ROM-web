<template>
<div class="container-fluid p-0 overflow-hidden mob_hide" style="height: 100vh">
  <div class="row m-0">
      <div class="p-0" style="background-color:#2c2c2c; width:18%" >
          <div class="row m-0">
              <div class="col-md-12 mt-3">
                  <div class="rounded-circle shadow m-auto d-flex align-items-center overflow-hidden" style="width: 100px; height: 100px;">
                      <img class="img img-fluid d-block m-auto" src="/storage/settings/company.png" style="width:200px; height: auto">
                  </div>
              </div>
          </div>
          <nav id="sidebar" style="height: 100vh; overflow-y: auto">
            <ul class="list-unstyled components">
              <li :class="$route.path == `/admin/adminDash` ? `active nav-item` : ``">
                <router-link class="nav-link a-admin" to="/admin/adminDash"><i data-feather="home"></i> Dashboard <span class="sr-only">(current)</span></router-link>
              </li>
              <li :class="$route.path == `/admin/products` ? `active nav-item` : ``">
                <router-link class="nav-link a-admin" to="/admin/products"><i data-feather="box"></i> Products</router-link>
              </li>
              <li :class="$route.path == `/admin/orders` ? `active nav-item` : ``">
                <router-link class="nav-link a-admin" to="/admin/orders"><i data-feather="shopping-cart"></i> Orders</router-link>
              </li>
              <li :class="$route.path == `/admin/categories` ? `active nav-item` : ``">
                <router-link class="nav-link a-admin" to="/admin/categories"><i data-feather="grid"></i> Categories</router-link>
              </li>
              <li :class="$route.path == `/users` ? `active nav-item` : ``">
                <router-link class="nav-link a-admin" to="/users"><i data-feather="user"></i> Users Management</router-link>
              </li>
              <li :class="$route.path == `/setting` ? `active nav-item` : ``">
                <router-link class="nav-link a-admin" to="/setting"><i data-feather="trending-up"></i> Sales Report</router-link>
              </li>
              <li :class="$route.path == `/customers` ? `active nav-item` : ``">
                <router-link class="nav-link a-admin" to="/customers"><i data-feather="users"></i> Customers</router-link>
              </li>
            </ul>
          </nav>            
      </div>
      <div class="p-0" style="width: 82%">
          <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #bf7f25;; height: 55px">
              <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <!-- Left Side Of Navbar -->
                      <ul class="navbar-nav mr-auto">

                      </ul>

                      <!-- Right Side Of Navbar -->
                      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="text-white px-5">
                                <router-link class="a-admin" to="/profile">
                                    <span class="fa fa-user-cog pr-2 text-white" style="font-size: 20px"></span><strong>  {{$store.state.auth.user.f_name}} {{$store.state.auth.user.l_name}}</strong>
                                </router-link>
                            </li>
                            <li>
                                <a @click="logout()" style="cursor:pointer">
                                <span class="fa fa-power-off text-white" style="font-size: 20px"></span>
                                </a>
                            </li>
                        </ul>
                      </div>
                  </div>
              </div>
          </nav>
        <div class="row m-0 main_dis">
            <div class="col-md-12">   
                <router-view></router-view>             
            </div>
        </div>
        
      </div>
  </div>
</div>
</template>
<script>
export default {
    methods:{
        logout: function(){
            axios.post("logout").then(response => { 
                window.location.replace("/signin");
            })
            .catch(error => {
            
            });
        },
    }
}
</script>