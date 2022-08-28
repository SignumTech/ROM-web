<template>
<div class="row mt-4">
    <div class="col-md-12">
        <h5><strong>Products</strong></h5>
    </div>
    <div class="col-md-12 mt-3">
        <div class="bg-white rounded-1 p-3 shadow-sm">
             <router-link to="/admin/addProducts" class="btn btn-primary btn-sm float-end shadow text-white"><span class="fa fa-plus"></span> Add Product</router-link>
            <table class="table table-striped px-2 table-sm mt-2">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Purchased</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle">
                            <img src="/storage/products/dress.jpg" class="img img-fluid img-thumb cat_img rounded" alt="">
                        </td>
                        <td class="align-middle">Puff Sleeve Tie Front Shirred Waist Ruffle Hem Dress</td>
                        <td class="align-middle">1500 Birr</td>
                        <td class="align-middle">13</td>
                        <td class="align-middle">122</td>
                        <td class="align-middle">ACTIVE</td>
                        <td class="align-middle">26 Aug, 2022</td>
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
</template>
<script>
export default {
    
}
</script>