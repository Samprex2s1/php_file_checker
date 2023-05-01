<template>
    <div class="p-20">Home Page</div>
    <input type="file" @change="uploadFile" ref="file" name="file">

    <input type="file" id="files" ref="files" multiple @change="handleFilesUpload">

    <button @click="submitFile">Сравить!</button>
</template>

<script>
export default {
    name: 'Home',

    methods: {
      uploadFile() {
        this.Images = this.$refs.file.files[0];
      },

      handleFilesUpload(){
        this.files = this.$refs.files.files;
      },

      submitFile() {
        const formData = new FormData();
        formData.append('file', this.Images);
        
        for( var i = 0; i < this.files.length; i++ ){
          formData.append("files["+i+"]", this.files[i]);
        }

        const headers = { 'Content-Type': 'multipart/form-data' };
        console.log(formData)
        axios.post('/api/uploadfile', formData, { headers }).then((res) => {
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