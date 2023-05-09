<template>
  <div class="container">
    <div class="content">
      <div class="content__left">

        <div class="heading">СРАВНЕНИЕ МЕЖДУ СОБОЙ</div>
        <p class="text">Выберите несколько файлов, они сравнятся между собой</p>
        <button class="cmp-btn" @click="submitFile">Сравнить</button>

      </div>
      <div class="content__right">

        <DropFile :handleFilesUpload='handleFilesUpload'/>

      </div>
    </div>
    <TableManyToMany :tableResults="tableResults" />
  </div> 
</template>

<script>
import DropFile from "../components/DropFile.vue";
import TableManyToMany from "../components/TableManyToMany.vue";
export default {
    name: 'ManyToMany',

    data() {
      return {
        tableResults: [],
      }
    },

    components: {
      DropFile,
      TableManyToMany
    },

    methods: {
      handleFilesUpload(data){
        this.files = data;
      },

      submitFile() {
        const formData = new FormData();
        
        for( var i = 0; i < this.files.length; i++ ){
          formData.append("files["+i+"]", this.files[i]);
        }

        const headers = { 'Content-Type': 'multipart/form-data' };
        axios.post('/api/uploadfile/manytomany', formData, { headers }).then((res) => {
          this.tableResults = res.data
          console.log(res.data)
        });

      }
    }
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
  .heading {
    font-size: 24px;
  }
  .text {
    margin-top: 16px;
    font-size: 20px;
  }
  .content__right {
    width: 50%;
  }
  .content__left {
    width: 50%;
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
  .cmp-btn:hover {
    background: #0483dd;
  }
</style>