<template>
    <div class="table">
        <div class="heading">Результаты</div>
        <table>
            <thead class="">
                <tr>
                    <th></th>
                    <td v-for="FileName in tableResults[0]">{{ FileName }}</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(FileName, index) in tableResults[0]" >
                    <th>{{ FileName }}</th>
                    <td v-for="perc in tableResults[1]">
                        {{ perc[index] }}
                    </td>
                </tr>
            </tbody>        
        </table>
    </div>
</template>

<script>
export default {
    name: 'TableManyToMany',
    props: ['tableResults'],
}
</script>

<style scoped>
.heading {
    font-size: 24px;
}
table {
    margin-top: 16px;
}
table, th, td {
  border-collapse: collapse;
  padding: 4px;
}
td {
    text-align: center;
}
thead{
    background: rgba(8, 121, 202, 0.4);
}
tr:nth-child(even) {
    background: #85b5d4;
}
</style>