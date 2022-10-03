<template>
    
</template>
<script>
export default {
    mounted(){
        feather.replace();
        console.log(this.$store.state.auth.permissions)
    }
}
</script>