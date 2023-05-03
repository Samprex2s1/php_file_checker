<template>
    <div class="p-20">ManyToMany</div>

    <input type="file" id="files" ref="files" multiple @change="handleFilesUpload">

    <button @click="submitFile">Сравить!</button>
</template>

<script>
export default {
    name: 'ManyToMany',

    methods: {
      handleFilesUpload(){
        this.files = this.$refs.files.files;
      },

      submitFile() {
        const formData = new FormData();
        
        for( var i = 0; i < this.files.length; i++ ){
          formData.append("files["+i+"]", this.files[i]);
        }

        const headers = { 'Content-Type': 'multipart/form-data' };
        axios.post('/api/uploadfile/manytomany', formData, { headers }).then((res) => {
          console.log(res.data)
        });

      }
    }
}
</script>

<style scoped>
div {
    background-color: coral;
    color: white;
}
</style>