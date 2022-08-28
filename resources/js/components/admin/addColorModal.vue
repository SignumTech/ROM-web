<template>
<div class="col-md-12 p-2">
<color-panel class="d-block m-auto" v-model="color"></color-panel>
<button class="btn btn-primary form-control mt-2">Add Color</button>
</div>

</template>
<script>
export default {
    data(){
        return{
            color:""
        }
    }
}
</script>