<template>
    <div class="p-3">
        <div class="row">
            <div class="col-md-12">
                <h5><strong>{{mainCat.cat_name}}</strong></h5>
            </div>
            <div v-for="(subCat,index) in subCats" :key="index" class="col-md-12 mt-3">
                <h5>{{subCat.cat_name}}</h5>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:["subCats", "mainCat"]
}
</script>