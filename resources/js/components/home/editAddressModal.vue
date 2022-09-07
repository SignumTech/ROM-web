<template>
    <form action="#" @submit.prevent="updateAddress">
        <div class="row mx-0 pt-3 px-3">
            <div class="col-md-12">
                <h5 class="float-end"><span @click="$emit('close')" class="fa fa-times"></span></h5>
            </div>
        </div>
        <div class="row mx-0 p-3 bg-white rounded-1 shadow-sm">
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
</template>
<script>
export default {
    props:['address'],
    mounted(){
        this.addressData = this.address
    },
    data(){
        return{
            addressData:{
                f_name:"",
                l_name:"",
                phone_no:"",
                city:"",
                state:"",
                address_1:"",
                address_2:"",
            }
        }
    },
    methods:{
        async updateAddress(){
            await axios.put('/addressBooks/'+this.addressData.id, this.addressData)
            .then( response =>{
                this.$emit('close')
            })
        }
    }
}
</script>