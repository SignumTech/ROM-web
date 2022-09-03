<template>
<div class="row m-0 p-4">
    <div class="col-md-1 p-0">
        <div v-for="(pic) in pictures[currentColor]" :key="pic" class="row">
            <div class="col-md-12" >
                <img @click="makeMain(pic)" :class="(pic == main)?`img img-fluid mt-2 color-choice`:`img img-fluid mt-2`" :src="`/storage/productsThumb/`+pic" style="cursor:pointer" alt="">
            </div>
        </div>                 
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-12">
                <img class="img img-fluid mt-2" :src="`/storage/products/`+main" alt="">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <h5 class="mb-0 mt-2"><strong>{{product.p_name}} </strong></h5>
        <h6 class="mb-0 mt-2">{{product.description}}</h6>
        <h2 class="mt-3"><strong>{{product.price}} Birr</strong></h2>
        <hr class="mt-3">
        <h5 class="mt-3"><strong>Colors</strong></h5>
        <h5>
            <span @click="makeCurrentColor(color)" v-for="color in colors" :key="color.id" :class="(currentColor == color)?`hov-color badge rounded-1 p-2 shadow-sm m-1 color-choice`:`hov-color badge rounded-1 p-2 shadow m-1`" :style="{backgroundColor:color}"><h5 class="m-0"></h5></span>
        </h5>
        
        <h5 class="mt-3"><strong>Sizes</strong></h5>
        <span @click="makeCurrentSize(size['size'])" v-for="size in sizes[currentColor]" :key="size.id" :class="(currentSize == size['size'])?`hov-main badge rounded-1 p-2 shadow-sm m-1 size-choice` : `hov-main badge rounded-1 p-2 shadow-sm m-1`"><h5 class="m-0">{{size['size']}}</h5></span>  
        <h6 v-if="sizeError" class="text-danger mt-1">Please choose a size before add to bag.</h6>
        <button @click="addToBag()" class="btn btn-primary form-control rounded-1 mt-4"><span class="fa fa-shopping-bag"></span> ADD TO BAG</button>      
    </div>
</div>
</template>
<script>
export default {
    props:['id'],
    data(){
        return{
            product:{},
            pictures:{main:""},
            productIdentity:{},
            colors:{},
            sizes:{},
            currentColor:'',
            currentSize:'',
            main:'',
            sizeError:false
        }
    },
    mounted(){
        this.getProduct()
        this.getInventory()
    },
    methods:{
        async addToBag(){
            if(this.currentSize == ''){
                this.sizeError = true
            }
            else{
                await axios.post('/addToCart', {product:this.product,color:this.currentColor,size:this.currentSize})
                .then( response =>{
                    console.log(response.data)
                })
            }
        },
        makeMain(pic){
            this.main = pic
        },
        makeCurrentColor(color){
            this.currentColor = color
            this.currentSize = ''
            this.main = this.pictures[this.currentColor][0]
        },
        makeCurrentSize(size){
            this.currentSize = size
        },
        async getProduct(){
            await axios.get('/products/'+this.id)
            .then( response =>{
                this.product = response.data
                this.pictures = JSON.parse(this.product.p_image)
                this.colors = JSON.parse(response.data.color)
                this.currentColor = this.colors[0]
                this.productIdentity = {
                    p_name:response.data.p_name,
                    cat_id:response.data.cat_id,
                    price:response.data.price,
                    brand:response.data.brand_id,
                    description:response.data.description
                }
                this.main = this.pictures[this.currentColor][0]
            })
        },
        async getInventory(){
            await axios.get('/getInventory/'+this.id)
            .then( response =>{
                this.sizes = response.data
            })
        }
    }
}
</script>