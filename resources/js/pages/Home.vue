<template>
  <div class="container">
    <div class="content">
      <div class="content__right">
        <div class="heading">СРАВНЕНИЕ С ГРУППОЙ</div>
        <p class="text">Выберите файл для сравнения и несколько файлов с которыми будете сравнивать</p>

        <div class="content__btn">
          <label class="upload-btn" for="upload-file">Выбрать файл</label>
          <p class="upload-btn__fileName">
            {{ Images.name }}
          </p>
          <input id="upload-file" type="file" @change="uploadFile" ref="files" name="file">
        </div>

        <div class="upload-checkbox">
          <input type="checkbox" v-model="compWithAllDB"/>
          <label class="upload-checkbox__name" for="withAllDB">Сравнить со всей БД</label>
        </div>
        
        <div class="upload-checkbox">
          <input type="checkbox" v-model="compWithCategory"/>
          <label class="upload-checkbox__name" for="withCategory">Сравнить с категорией</label>
          <select v-if="compWithCategory"  v-model="pickedCategory">
            <option v-for="category in categories" :key="categories.Category" :value="category.Category">{{ category.Category }}</option>
          </select>
        </div>
        
        <div class="upload-checkbox">
          <input type="checkbox" name="saveCategory" v-model="saveCategory"/>
          <label class="upload-checkbox__name" for="saveCategory">Сохранить файлы как категорию</label>
          <input v-if="saveCategory" v-model="categoryName" type="text" placeholder="Название категории"/>
        </div>
        
        <button class="cmp-btn" @click="submitFile">Сравнить</button>
        
      </div>
      <div class="content__left">
        <DropFile v-if="!compWithCategory" :handleFilesUpload='handleFilesUpload'/>
      </div>
    </div>
    <Table :tableResults="tableResults" />
  </div>
</template>

<script>
import DropFile from "../components/DropFile.vue";
import Table from "../components/Table.vue";
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
        Images: [],
        tableResults: [],
      }
    },

    mounted() {
      this.getCategories()
    },

    methods: {
      uploadFile() {
        this.Images = this.$refs.files.files[0];
      },

      handleFilesUpload(data){
        this.files = data;
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
            this.tableResults = res.data
          });
        } else if (this.compWithCategory){
          formData.append("pickedCategory", this.pickedCategory);
          axios.post('/api/uploadfile/withcategory', formData, { headers }).then((res) => {
            this.tableResults = res.data
          });
        } else {
          axios.post('/api/uploadfile', formData, { headers }).then((res) => {
            this.tableResults = res.data
          });
        }
        
      }
    },

    components: {
      DropFile,
      Table
    },
}
</script>

<style scoped>
  .container {
    max-width: 1280px;
    margin: auto;
    height: 1000px;
  }
  .content {
    display: flex;
    margin-top: 96px;
  }
  .content__right {
    width: 50%;
  }
  .content__left {
    width: 50%;
  }
  .heading {
    font-size: 24px;
  }
  .text {
    margin-top: 16px;
    font-size: 20px;
  }
  #upload-file {
    opacity: 0;
    position: absolute;
    z-index: -1;
  }
  .content__btn {
    display: flex;
    align-items: center;
    margin-top: 64px;
  }
  .upload-btn {
    display: block;
    max-width: 232px;
    padding: 24px 44px;
    text-align: center;
    cursor: pointer;
    background: #0366AD;
    font-weight: 500;
    color: #FFFFFF;
  }
  .upload-btn__fileName {
    margin-left: 12px;
  }
  .upload-checkbox {
    margin-top: 12px;
  }
  .cmp-btn {
    margin-top: 24px;
    display: block;
    max-width: 232px;
    padding: 24px 44px;
    text-align: center;
    cursor: pointer;
    background: #0366AD;
    font-size: 16px;
    font-weight: 500;
    color: #FFFFFF;
    border: none;
  }
  .upload-checkbox__name {
    margin-left: 4px;
  }
</style>