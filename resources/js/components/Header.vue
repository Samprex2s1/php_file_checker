<template>
    <router-link :to="{ name: 'home' }">Home</router-link>
    <router-link :to="{ name: 'ManyToMany' }">ManyToMany</router-link>
</template>

<script>
export default {
    name: 'Header',
}
</script>

<style scoped>

</style>