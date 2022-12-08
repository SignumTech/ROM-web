<template>
<div class="row p-4">
    <div class="col-md-12 text-center">
        <h3><span class="fa fa-exclamation-triangle text-warning"></span></h3>
        <h5 class="mt-3">{{error.data}}</h5>
        <button @click="$emit('close')" class="btn btn-warning mt-3"><span class="fa fa-times"></span> Close</button>
    </div>
</div>
</template>
<script>
export default {
    props:["error"]
}
</script>