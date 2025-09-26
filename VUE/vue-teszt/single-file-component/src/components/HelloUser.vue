<template>
    <div>
        <p>Hello {{ name }}</p>
    </div>
</template>

<script>
    export default{
        props: {
            name: String,
        }
    }
</script>

<style scoped>
    p {
        color:goldenrod
    }
</style>
