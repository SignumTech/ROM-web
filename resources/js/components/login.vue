<template>
<div class="container justify-content-center">
    <div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="bg-white rounded-sm p-4">
                <div class="row">
                    <div class="col-md-6 border-end">
                        <h4 class="text-center"><strong>SIGN IN</strong></h4>
                        <div class="row m-0 mt-4">
                            <div class="col-md-12">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control form-control-auth" placeholder="Email address">
                            </div>
                        </div>
                        <div class="row m-0 mt-4">
                            <div class="col-md-12">
                                <label for="email">Password</label>
                                <input type="password" class="form-control form-control-auth" placeholder="Password">
                            </div>
                        </div>   
                        <div class="row m-0 mt-4">
                            <div class="col-md-12">
                                <button class="btn btn-primary form-control form-control-auth-btn"><h5 class="m-0"><strong>SIGN IN</strong></h5></button>
                                <h6 class="text-center mt-3">Forgot your password?</h6>
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
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-center"><strong>REGISTER</strong></h4>
                        <div class="row m-0 mt-4">
                            <div class="col-md-6">
                                <label for="email">First Name</label>
                                <input type="text" class="form-control form-control-auth" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <label for="email">Last Name</label>
                                <input type="email" class="form-control form-control-auth" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="row m-0 mt-4">
                            <div class="col-md-12">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control form-control-auth" placeholder="Email address">
                            </div>
                        </div>
                        <div class="row m-0 mt-4">
                            <div class="col-md-12">
                                <label for="email">Password</label>
                                <input type="password" class="form-control form-control-auth" placeholder="Password">
                            </div>
                        </div> 
                        <div class="row m-0 mt-4">
                            <div class="col-md-12">
                                <label for="email">ConfirmPassword</label>
                                <input type="password" class="form-control form-control-auth" placeholder="Confirm Password">
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
                                <button class="btn btn-primary form-control form-control-auth-btn"><h5 class="m-0"><strong>REGISTER</strong></h5></button>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-md-2"></div>      
    </div>

</div>
</template>
<style>
.form-control-auth{
    padding: 11px !important;
    background-color: #fff !important;
}
.form-control-auth-btn{
    padding: 11px !important;
}
.btn-primary{
    color:white;
    border-color: #bf7f25;
    background-color: #bf7f25;
}
</style>