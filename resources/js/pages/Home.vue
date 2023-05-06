<template>
    <div class="p-20">Home Page</div>
    <input type="file" @change="uploadFile" ref="file" name="file">

    <input v-if="!compWithCategory" type="file" id="files" ref="files" multiple @change="handleFilesUpload">
    <br>
    <label for="withAllDB">Сравнить со всей БД</label>
    <input type="checkbox" v-model="compWithAllDB"/>
    <br>
    <label for="withCategory">Сравнить с категорией</label>
    <input type="checkbox" v-model="compWithCategory"/>
    <br>
    <select v-if="compWithCategory"  v-model="pickedCategory">
      <option v-for="category in categories" :key="categories.Category" :value="category.Category">{{ category.Category }}</option>
    </select>
    <br>
    <label for="saveCategory">Сохранить файлы как категорию</label>
    <input type="checkbox" v-model="saveCategory"/>
    <br>
    <input v-if="saveCategory" v-model="categoryName" type="text" placeholder="Название категории"/>
    <br>
    <button @click="submitFile">Сравить!</button>
</template>

<script>
export default {
    name: 'Home',

    data() {
      return {
        compWithAllDB: false,
        compWithCategory: false,
        pickedCategory: null,
        saveCategory: false,
        categoryName: null,
        categories: [], 
      }
    },

    mounted() {
      this.getCategories()
    },

    methods: {
      uploadFile() {
        this.Images = this.$refs.file.files[0];
      },

      handleFilesUpload(){
        this.files = this.$refs.files.files;
      },

      getCategories(){
        axios.post('/api/getcategories').then((res) => {
            this.categories = res.data
          });
      },

      submitFile() {
        const formData = new FormData();
        formData.append('file', this.Images);


        if(this.files) {
          for( var i = 0; i < this.files.length; i++ ){
            formData.append("files["+i+"]", this.files[i]);
          }
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
        } else if (this.compWithCategory){
          formData.append("pickedCategory", this.pickedCategory);
          axios.post('/api/uploadfile/withcategory', formData, { headers }).then((res) => {
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