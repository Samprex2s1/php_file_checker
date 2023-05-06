<template>
    <Header />
    <router-view />
</template>

<script>
import Header from "./components/Header.vue";

export default {
    name: 'App',
    components: {
        Header,
    },
}
</script>

<style>
    * {
        padding: 0;
        margin: 0;
    }
    body {
        font-family: 'Montserrat', sans-serif;
        font-weight: 400;
    }
    a{
        text-decoration: none;
        color: #1D1D1D;
    }
</style>