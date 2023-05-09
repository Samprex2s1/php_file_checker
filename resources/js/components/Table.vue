<template>
    <div class="table">
        <div class="heading">Результаты</div>
        <div class="table__row" v-for="result in tableResults" :key="result.name">
            <span class="table__FileName">{{ result.name }}</span>
            <span class="table__Perc">{{ result.perc }}%</span>
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
.heading {
    font-size: 24px;
  }
.table {
    margin-top: 16px;
}
.table__row {
    display: flex;
    justify-content: space-between;
    margin-top: 8px;
    padding: 8px 16px;
    background: rgba(3, 102, 173, 0.4);
}
.table__FileName {
    font-weight: 500;
}
.table__Perc {
    font-weight: 500;
    margin-right: 20%;
}
</style>