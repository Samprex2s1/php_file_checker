<template>
    <div class="p-20">Home Page</div>
    <input type="file" @change="uploadFile" ref="file" name="file">

    <input type="file" id="files" ref="files" multiple @change="handleFilesUpload">
    <br>
    <label for="withAllDB">Сравнить со всей БД</label>
    <input type="checkbox" id="subscribeNews" v-model="compWithAllDB"/>
    <br>
    <label for="withCategory">Сравнить с категорией</label>
    <input type="checkbox" id="subscribeNews" name="withCategory"/>
    <br>
    <label for="saveCategory">Сохранить файлы как категорию</label>
    <input type="checkbox" id="subscribeNews" v-model="saveCategory"/>
    <br>
    <input v-if="saveCategory" v-model="categoryName" type="text" id="subscribeNews" placeholder="Название категории"/>
    <br>
    <button @click="submitFile">Сравить!</button>
</template>

<script>
export default {
    name: 'Home',

    data() {
      return {
        compWithAllDB: false,
        saveCategory: false,
        categoryName: null,
      }
    },

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

        if(this.saveCategory){
          formData.append("categoryName", this.categoryName);
          axios.post('/api/uploadfile/savecategory', formData, { headers }).then((res) => {
            console.log(res.data)
          });
        }

        if(this.compWithAllDB){
          axios.post('/api/uploadfile/withdb', formData, { headers }).then((res) => {
            console.log(res.data)
          });
        } else {
          axios.post('/api/uploadfile', formData, { headers }).then((res) => {
            console.log(res.data)
          });
        }
        
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