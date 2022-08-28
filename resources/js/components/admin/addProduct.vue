<template>
<div class="row mt-4">
    <div class="col-md-12">
        <h5><strong>Add Product</strong></h5>
    </div>
    <div class="col-md-12">
        <div class="bg-white shadow-sm rounded-1 p-3">
            <div class="row m-0 p-2 border-bottom">
                <div class="col-md-4 text-center">
                    <h6 v-if="tab1" class="text-center"><strong><span  class="text-center px-2 py-1 bg-primary rounded shadow-sm text-white">1</span> Product Identity</strong></h6>
                    <h6 v-if="!tab1" class="text-center"><span  class="text-center px-2 py-1 bg-secondary rounded shadow-sm text-white">1</span> Product Identity</h6>
                </div>
                <div class="col-md-4 text-center">
                    
                    <h6 v-if="tab2" class="text-center"><strong><span  class="text-center px-2 py-1 bg-primary rounded shadow-sm text-white">2</span> Colors and images</strong></h6>
                    <h6 v-if="!tab2" class="text-center"><span  class="text-center text-white px-2 py-1 bg-secondary rounded shadow-sm">2</span>  Colors and images</h6>
                </div>
                <div class="col-md-4 text-center">
                    <h6 v-if="tab3" class="text-center"><strong><span  class="text-center px-2 py-1 bg-primary rounded shadow-sm text-white">3</span> Publish</strong></h6>
                    <h6 v-if="!tab3" class="text-center"><span  class="text-center text-white px-2 py-1 bg-secondary rounded shadow-sm">3</span>  Publish</h6>
                </div>
            </div>
            <div  v-if="tab1" class="row mx-0 mt-5">
                <div class="col-md-3"></div>
                <div class="col-md-6 px-0">
                    <div class="row m-0">
                        <div class="col-md-6">
                            <label for="">Product Name</label>
                            <input v-model="productIdentity.p_name" type="text" class="form-control" placeholder="Product Name">
                        </div>
                        <div class="col-md-6">
                            <label for="">Category</label>
                            <select v-model="productIdentity.cat_id" class="form-select" id=""></select>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="">Product description</label>
                            <textarea v-model="productIdentity.description" class="form-control" id="" cols="20" rows="3"></textarea>
                        </div>
                    </div><hr>
                    <div class="row mx-0">
                        <div class="col-md-12">
                            <button @click="nextProcess()" class="btn btn-primary float-end">Next <span class="fa fa-arrow-right"></span></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
            <div  v-if="tab2">
                <div v-for="(color,index) in colors" :key="color.id" class="row mx-0 mt-5">
                    <div class="col-md-12">
                        <button @click="addColorModal()" class="btn btn-primary btn-sm float-end"><span class="fa fa-plus"></span> Add Colors</button>
                    </div>
                    <div class="col-md-12">
                        <h6 class="m-0"><strong>Color:  <span class="shadow-sm rounded p-1 text-white" :style="{backgroundColor:color}">{{color}}</span></strong></h6>
                    </div>
                    <div class="col-md-4 mt-3 border-end">
                        <div class="row m-0">
                            <div class="col-md-12 px-0">
                                <label for="">Price in Birr</label>
                                <input v-model="prices[index].price" class="form-control" type="number" placeholder="Price in Birr">
                            </div>                        
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h6 class="m-0">Sizes and Quantities <span @click="addSizes(index)" class="fa fa-plus float-end" style="cursor:pointer"></span></h6>
                            </div>
                        </div>
                        <div v-for="(size,ind) in sizes[index].sizes" :key="ind" class="row mt-1">
                            <div class="col-md-6">
                                <input  v-model="size.size" type="text" class="form-control" placeholder="Size">
                            </div>
                            <div class="col-md-6">
                                <input v-model="size.quantity" type="text" class="form-control" placeholder="Quantity">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h6>Pictures</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 align-self-center" >
                                <div class="bg-secondary rounded p-2" style="height: 200px">
                                    <h5 class="text-center pt-2"><span class="fa fa-camera"></span></h5>
                                    <h5 class="text-center pt-1"><strong>1080 X 1440</strong></h5>
                                    <h6 class="text-center">Please choose image according to the aspect ratio</h6>
                                    <label class="text-center text-white d-block m-auto fs-5 pt-2 fa fa-plus mt-2" style="cursor:pointer">
                                        <input type="file" class="form-control" id="photo" name="photo" @change="uploadPic($event)" style="display: none">
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
</template>
<script>
import addColorModalVue from './addColorModal.vue';
export default {
    data(){
        return{
            productIdentity:{
                p_name: "",
                cat_id: "",
                description: "",
            },
            colors:['#ff0000'],
            myStyle:{backgroundColor:"#ff0000"},
            prices:[
                {color:'#ff0000', price:200}
            ],
            sizes:[
                {
                    color:'#ff0000', 
                    sizes:[
                        {size:'S', quantity: 10},
                        {size:'M', quantity: 10},
                        {size:'L', quantity: 10},
                        {size:'XL', quantity: 9}
                    ]
                }
            ],
            tab1:true,
            tab2:false,
            tab3:false,
        }
    },
    methods:{
        nextProcess(){
            this.tab1 = false
            this.tab2 = true
        },
        addSizes(index){
            this.sizes[index].sizes.push({size:'',quantity:''})
        },
        addColors(){
            this.colors.push('')
        },
        addColorModal(){
            this.$modal.show(
                addColorModalVue,
                {},
                {width:"300px",height:"auto"}
            );
        },
        async addIdentity(){
            await axios.post('/products', this.productIdentity)
            .then( response =>{
                this.tab1 = false
                this.tab1 = true
            })
        }
    }
}
</script>