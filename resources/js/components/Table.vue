<template>
    <div class="">
        <div v-for="result in tableResults" :key="result.name">
            <span>{{ result.name }}</span>
            <span>{{ result.perc }}</span>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Table',
    props: ['tableResults'],
}
</script>

<style scoped>

</style>