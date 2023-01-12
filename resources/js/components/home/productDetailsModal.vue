<template>
<div class="row m-0 p-4">
    <div v-if="loading" class="col-md-12 p-5">
        <div class="d-flex justify-content-center align-self-center">
            <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
        </div>
    </div>  
    <div v-if="!loading" class="col-md-1 p-0">
        <div v-for="(pic,index) in previewData[currentColor].images" :key="`pic`+index" class="row">
            <div class="col-md-12" >
                <img @click="makeMain(pic.p_image)" :class="(pic.p_image == main)?`img img-fluid mt-2 color-choice`:`img img-fluid mt-2`" :src="`/storage/productsThumb/`+pic.p_image" style="cursor:pointer" alt="">
            </div>
        </div>                 
    </div>
    <div v-if="!loading" class="col-md-5">
        <div class="row">
            <div class="col-md-12">
                <img class="img img-fluid mt-2" :src="`/storage/products/`+main" alt="">
            </div>
        </div>
    </div>
    <div v-if="!loading" class="col-md-6">
        <h5 class="mb-0 mt-2"><strong>{{product.p_name}} </strong></h5>
        <h6 class="mb-0 mt-2">{{product.description}}</h6>
        <h2 v-if="product.promotion_status == 'REGULAR'" class="mt-3"><strong>{{product.price}} Birr</strong></h2>
        <h2 v-if="product.promotion_status == 'SALE' || product.promotion_status == 'FLASH SALE'" class="mb-0"><strong><span>{{product.price - (product.price *(product.discount/100)) | numFormat}} ETB</span> <span class="text-muted fs-6"><s><strong>{{product.price | numFormat}} ETB</strong></s></span> </strong></h2>
        <h6 v-if="product.promotion_status == 'SALE'" class="mt-2">
            <span class="bg-warning p-1"><span class="fa fa-tags"></span> Sale</span> 
            <span class="bg-warning p-1">-{{product.discount}}%</span>
        </h6>
        <h6 v-if="product.promotion_status == 'FLASH SALE'" class="mt-2">
            <span class="bg-warning p-1"><span class="fa fa-bolt"></span> Flash Sale</span> 
            <span class="bg-warning p-1">-{{product.discount}}%</span>
            <span class="bg-warning p-1">Ends {{product.expiry_date | moment("MMM Do YYYY h:mm")}}</span>
        </h6>
        <hr class="mt-3">
        <h5 class="mt-3"><strong>Colors</strong></h5>
        <h5>
            <span @click="makeCurrentColor(color.color, color.id)" v-for="color,index in product.colors" :key="`size`+index" :class="(currentColor == color.color)?`hov-color badge rounded-1 p-2 shadow-sm m-1 color-choice`:`hov-color badge rounded-1 p-2 shadow m-1`" :style="{backgroundColor:color.color}"><h5 class="m-0"></h5></span>
        </h5>
        
        <h5 class="mt-3"><strong>Sizes</strong></h5>
        <span @click="makeCurrentSize(size.size,size.size_id)" v-for="size,index in sizes" :key="`color`+index" :class="(currentSize == size.size)?`hov-main badge rounded-1 p-2 shadow-sm m-1 size-choice` : `hov-main badge rounded-1 p-2 shadow-sm m-1`"><h5 class="m-0">{{size.size}}</h5></span>  
        <h6 v-if="sizeError" class="text-danger mt-1">Please choose a size before add to bag.</h6>
        <div v-if="btnLoading" class="d-flex justify-content-center align-self-center mt-3">
            <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
        </div>
        <button  @click="addToBag()" class="btn btn-primary form-control rounded-1 mt-4"><span class="fa fa-shopping-bag"></span> ADD TO BAG</button>      
    </div>
</div>
</template>
<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
export default {
    components:{
        PulseLoader
    },
    props:['id'],
    data(){
        return{
            loading:true,
            btnLoading:false,
            product:{},
            previewData:{},
            currentColor:'',
            chosenColor:'',
            chosenSize:'',
            currentSize:'',
            main:'',
            sizeError:false,
            sizesData:{},
            sizes:{}
        }
    },
    mounted(){
        this.getProduct()        
    },
    methods:{
        async getPreviewData(){
            this.loading = true
            await axios.get('/getPreviewData/'+this.id)
            .then( response =>{
                this.previewData = response.data
                this.main = this.previewData[this.currentColor].images[0].p_image
                this.getInventory()
            })
        },
        async getCart(){
            await axios.post('/getCart')
            .then( response => {
                this.$store.state.auth.cart = response.data
            })
        },
        async addToBag(){
            if(this.currentSize == ''){
                this.sizeError = true
            }
            else{
                this.btnLoading = true
                await axios.post('/addToCart', {product_id:this.product.id,color_id:this.chosenColor,size_id:this.chosenSize,quantity:1})
                .then( response =>{
                    this.getCart()
                    this.$notify({
                        group: 'foo',
                        type: 'success',
                        title: 'Item add to bag!',
                        text: 'Your item was added to your shopping bag.'
                    });
                    this.$emit('close')
                    this.btnLoading = false
                })
            }
        },
        makeMain(pic){
            this.main = pic
        },
        makeCurrentColor(color,id){
            this.currentColor = color
            this.currentSize = ''
            this.main = this.previewData[this.currentColor].images[0].p_image
            this.chosenColor = id
            this.sizes = this.sizesData[id]
        },
        makeCurrentSize(size,id){
            this.currentSize = size
            this.chosenSize = id
        },
        async getProduct(){
            await axios.get('/products/'+this.id)
            .then( response =>{
                this.product = response.data
                this.currentColor = this.product.colors[0].color
                this.chosenColor = this.product.colors[0].id
                this.getPreviewData()
            })
        },
        async getInventory(){
            await axios.get('/getInventory/'+this.id)
            .then( response =>{
                this.sizesData = response.data
                this.sizes = this.sizesData[this.chosenColor]
                this.loading = false
            })
        }
    }
}
</script>