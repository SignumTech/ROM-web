<template>
<div class="row mt-4">
    <div class="col-md-12">
        <h5><strong>Categories</strong></h5>
    </div>
    <div class="col-md-12 mt-3">
        <div class="bg-white rounded-1 p-3 shadow-sm">
            <div class="row m-0">
                <div class="col-md-6 px-0">
                    <h5 class="m-0"><strong>Main Categories</strong></h5>
                </div>
                <div class="col-md-6 px-0">
                    <button class="btn btn-primary btn-sm float-end"><span class="fa fa-plus"></span> Add Main Category</button>
                </div>
            </div>
            <div class="row mt-1 mx-0">
                <div class="col-md-12 px-0">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Items</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Women</td>
                                <td>2</td>
                                <td>
                                    
                                    <button class="btn btn-danger btn-sm float-end ms-3"><span class="fa fa-trash-alt"></span></button>
                                    <button class="btn btn-success btn-sm float-end "><span class="fa fa-edit"></span></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Men</td>
                                <td>2</td>
                                <td>
                                    
                                    <button class="btn btn-danger btn-sm float-end ms-3"><span class="fa fa-trash-alt"></span></button>
                                    <button class="btn btn-success btn-sm float-end "><span class="fa fa-edit"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <div class="col-md-12 mt-3">
        <div class="bg-white rounded-1 p-3 shadow-sm">
            <div class="row m-0">
                <div class="col-md-6 px-0">
                    <h5 class="m-0"><strong>Sub Categories</strong></h5>
                </div>
                <div class="col-md-6 px-0">
                    <button class="btn btn-primary btn-sm float-end"><span class="fa fa-plus"></span> Add Sub Category</button>
                </div>
            </div>
            <div class="row mt-1 mx-0">
                <div class="col-md-12 px-0">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Category Name</th>
                                <th>Items</th>
                                <th>Parent Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <td><img src="/storage/settings/dresses.jpg" class="img img-fluid img-thumb cat_img rounded" alt=""></td>
                                <td class="align-middle">Dresses</td>
                                <td class="align-middle">2</td>
                                <td class="align-middle">Women</td>
                                <td class="align-middle">
                                    
                                    <button class="btn btn-danger btn-sm float-end ms-3"><span class="fa fa-trash-alt"></span></button>
                                    <button class="btn btn-success btn-sm float-end "><span class="fa fa-edit"></span></button>
                                </td>
                            </tr>
                            <tr>
                                 <td class="align-middle"><img src="/storage/settings/shoes.jpg" class="img img-fluid img-thumb cat_img rounded" alt=""></td>
                                <td class="align-middle">Shoes</td>
                                <td class="align-middle">2</td>
                                <td class="align-middle">Women</td>
                                <td class="align-middle">
                                    
                                    <button class="btn btn-danger btn-sm float-end ms-3"><span class="fa fa-trash-alt"></span></button>
                                    <button class="btn btn-success btn-sm float-end "><span class="fa fa-edit"></span></button>
                                </td>
                            </tr>
                            <tr>
                                 <td class="align-middle"><img src="/storage/settings/dresses.jpg" class="img img-fluid img-thumb cat_img rounded" alt=""></td>
                                <td class="align-middle">Dresses</td>
                                <td class="align-middle">2</td>
                                <td class="align-middle">Women</td>
                                <td class="align-middle">
                                    
                                    <button class="btn btn-danger btn-sm float-end ms-3"><span class="fa fa-trash-alt"></span></button>
                                    <button class="btn btn-success btn-sm float-end "><span class="fa fa-edit"></span></button>
                                </td>
                            </tr>
                            <tr>
                                 <td class="align-middle"><img src="/storage/settings/dresses.jpg" class="img img-fluid cat_img" alt=""></td>
                                <td class="align-middle">Shoes</td>
                                <td class="align-middle">2</td>
                                <td class="align-middle">Women</td>
                                <td class="align-middle">
                                    
                                    <button class="btn btn-danger btn-sm float-end ms-3"><span class="fa fa-trash-alt"></span></button>
                                    <button class="btn btn-success btn-sm float-end "><span class="fa fa-edit"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return{
            mainCategories:{},
            subCategories:{},
        }
    },
    mounted(){
        this.getMainCategories()
        this.getSubCategories()
    },
    methods:{
        async getMainCategories(){
            await axios.get('/')
            .then( response =>{
                this.mainCategories = response.data
            })
            .catch( error =>{

            })
        },
        async getSubCategories(){
            await axios.get('/')
            .then( response =>{
                this.subCategories = response.data
            })
            .catch( error =>{
                
            })
        }
    }
}
</script>