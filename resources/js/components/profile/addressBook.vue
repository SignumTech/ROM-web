<template>
<div class="col-md-9">
        <div class="row m-0">
            <div class="col-md-12">
                <h4 class="text-center"><strong>Address Book</strong></h4>
            </div>
            <div class="bg-white rounded-1 p-3 shadow-sm">
            <h5 class="m-0">Shipping Address</h5>
        </div>
        <div v-if="loading" class="row mx-0 mt-3 p-3">
            <div  class="col-md-12 p-5 mt-4">
                <div class="d-flex justify-content-center align-self-center">
                    <pulse-loader :color="`#BF7F25`" :size="`15px`"></pulse-loader> 
                </div>
            </div>
        </div>
  
        <div v-if="addressBookExists && !loading" class="row mx-0 mt-3 p-3">
            <div v-for="ad in addressData" :key="ad.id" class="col-md-6 mt-3">
                <div @click="makeDefault(ad.id)" :class="(ad.type == 'DEFAULT')?`bg-white shadow-sm rounded-1 border border-primary border-5 p-3`:`bg-white shadow-sm rounded-1 border-start border-secondary border-3 p-3`" style="cursor:pointer">
                    <h5><strong>{{ad.f_name}} {{ad.l_name}}</strong> <span @click="editAddress(ad)" class="fa fa-edit float-end" style="cursor:pointer"></span></h5>
                    <h6>+251-{{ad.phone_no}}</h6>
                    <h6>{{ad.city}} - {{ad.state}}</h6>
                    <h6>{{ad.address_1}} / {{ad.address_2}}</h6>
                </div>
            </div>
            <div class="col-md-12 mt-3 align-self-center text-center">
                <button @click="addAddress()" class="btn btn-outline-primary rounded-1"> <span class="fa fa-plus"></span> Add Shipping Address</button>
            </div>
        </div>
        <form v-if="!addressBookExists && !loading" action="#" @submit.prevent="saveAddress">
            <div class="row mx-0 mt-3 p-3 bg-white rounded-1 shadow-sm">
                <div class="col-md-6">
                    <label>First Name</label>
                    <input required v-model="addressData.f_name" type="text" class="form-control" placeholder="First Name">
                </div>
                <div class="col-md-6">
                    <label>Last Name</label>
                    <input required v-model="addressData.l_name" type="text" class="form-control" placeholder="Last Name">
                </div>
                <div class="col-md-12 mt-3">
                    <label for="">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroup-sizing-default">+251</span>
                        <input required v-model="addressData.phone_no" type="text" class="form-control" placeholder="Phone Number">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <label>City</label>
                    <input required v-model="addressData.city" type="text" class="form-control" placeholder="City">
                </div>
                <div class="col-md-6 mt-3">
                    <label>State</label>
                    <input required v-model="addressData.state" type="text" class="form-control" placeholder="State">
                </div>
                <div class="col-md-6 mt-3">
                    <label>Address 1</label>
                    <input required v-model="addressData.address_1" type="text" class="form-control" placeholder="Address 1">
                </div>
                <div class="col-md-6 mt-3">
                    <label>Address 2 (optional)</label>
                    <input v-model="addressData.address_2" type="text" class="form-control" placeholder="Address 2">
                </div>
                <div class="col-md-12 mt-4 text-center">
                    <button type="submit" class="btn btn-primary px-3 rounded-1"><span class="fa fa-address-book"></span> Save Address</button>
                </div>                
            </div>
        </form>
        </div>        
    

</div>
</template>
<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import addressModalVue from '../home/addressModal.vue'
import editAddressModalVue from '../home/editAddressModal.vue'
export default {
    components:{
        PulseLoader
    },
    data(){
        return{
            loading:false,
            addressData:{
                f_name:"",
                l_name:"",
                phone_no:"",
                city:"",
                state:"",
                address_1:"",
                address_2:"",
            },
            addressBookExists:false,
            currentAddress:"",
        }
    },
    mounted(){
        this.getAddressBook()
    },
    methods:{
        async makeDefault(id){
            await axios.get('/makeDefaultAddress/'+id)
            .then( response =>{
                this.getAddressBook()
            })
        },
        addAddress(){
            this.$modal.show(
                addressModalVue,
                {},
                {"width":"600px", height:"auto"},
                {"closed":this.getAddressBook}
            )
        },
        editAddress(ad){
            this.$modal.show(
                editAddressModalVue,
                {"address":ad},
                {"width":"600px", height:"auto"},
                {"closed":this.getAddressBook}
            )
        },
        async getAddressBook(){
            this.loading = true
            await axios.get('/addressBooks/'+this.$store.state.auth.user.id)
            .then( response =>{
                this.currentAddress = response.data[response.data.length - 1].id
                this.addressData = response.data
                this.addressBookExists = true
                this.loading = false
            })
            .catch( error =>{
                if(error.response.status == 422){
                    this.addressBookExists = false
                    this.loading = false
                }
            })
        },
        async saveAddress(){
            this.loading = true
            await axios.post('/addressBooks', this.addressData)
            .then( response =>{
                this.addressData = response.data
                this.loading = false
            })
        },
    }
}
</script>