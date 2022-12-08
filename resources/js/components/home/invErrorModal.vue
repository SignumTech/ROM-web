<template>
<div class="row p-4">
    <div class="col-md-12 text-center">
        <h5>{{error.data}}</h5>
    </div>
</div>
</template>
<script>
export default {
    props:["error"]
}
</script>