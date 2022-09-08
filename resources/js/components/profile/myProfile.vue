<template>
<div class="col-md-9">
    <div class="row m-0">
        <div class="col-md-12">
            <h4 class="text-center"><strong>My Profile</strong></h4>
        </div>
    </div>
    <div class="bg-white rounded-1 shadow-sm p-3 mt-4">
        <div class="row mx-0">
            <div class="col-md-12">
                <h5><strong>Information</strong></h5>
            </div>
            <div class="col-md-6">
                <label for="email">First Name</label>
                <input required v-model="detailsForm.f_name" type="text" class="form-control form-control-auth" placeholder="First Name">
                <h6 v-for="er in loginErrors.f_name" :key="er.id" class="text-danger m-0">{{er}}</h6>
            </div>
            <div class="col-md-6">
                <label for="email">Last Name</label>
                <input required v-model="detailsForm.l_name" type="text" class="form-control form-control-auth" placeholder="Last Name">
                <h6 v-for="er in loginErrors.l_name" :key="er.id" class="text-danger m-0">{{er}}</h6>
            </div>
        </div>   
        <div class="row mx-0 mt-5">
            <div class="col-md-12">
                <h5><strong>Style preferences</strong></h5>
                <span class="badge text-dark rounded-2 px-3 badge bg-light border border-dark border-1 shadow-sm"><h5 class="m-0">Women <span class="fa fa-times ms-2 fs-6"></span></h5></span>
                <span class="badge text-dark rounded-2 px-3 badge bg-light border border-dark border-1 shadow-sm"><h5 class="m-0">Men <span class="fa fa-times ms-2 fs-6"></span></h5></span>
                <span class="badge text-dark rounded-2 px-3 badge bg-light border border-dark border-1 shadow-sm"><h5 class="m-0">Curve+plus <span class="fa fa-times ms-2 fs-6"></span></h5></span>
                <span class="badge text-dark rounded-2 px-3 badge bg-light border border-dark border-1 shadow-sm"><h5 class="m-0">Women <span class="fa fa-times ms-2 fs-6"></span></h5></span>
            </div>
        </div>     
    </div>

</div>
</template>
<script>
export default {
    data(){
        return{
            detailsForm:{},
            loginErrors:{}
        }
    }
}
</script>