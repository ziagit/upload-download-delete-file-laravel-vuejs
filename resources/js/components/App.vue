<template>
  <div>
    <h1>Vue.js</h1>
      <form v-on:submit.prevent="uploadFile">
        <md-field>
          <label>Select file</label>
          <md-file  name="file" v-on:change="onFileChange" />
        </md-field>

        <md-button type="submit" class="md-raised md-accent">Upload</md-button>
    </form>
    <hr>
    <table>
      <tr>
        <th>File name</th>
        <th>Actions</th>
      </tr>
      <tr v-for="file of files">
        <td>{{file}}</td>
        <td>
          <form v-on:submit.prevent="downloadFile(file)">
            <md-button class="md-raised md-danger" type="submit">Download</md-button>
          </form>
          <form v-on:submit.prevent="deleteFile(file)">
            <md-button class="md-raised md-danger" type="submit">Delete</md-button>
          </form>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "App",
  data: ()=>({
    file: '',
    files:''
  }),
  methods:{
    onFileChange(e){
      this.file = e.target.files[0];
    },
    uploadFile(){
      let formData = new FormData();
      formData.append('file', this.file);
        axios.post('/api/upload', formData).then(res=>{
            this.getFiles();
          }).catch(err=>{
            console.log('Error: ', err);
          });
    },
    deleteFile(file){
      axios.get('/api/delete/'+file).then(res=>{
        this.getFiles();
      })
    },
    getFiles(){
      axios.get('/api/files').then(res=>{
        this.files = res.data;
      })
    },
    downloadFile(file){
      axios.get('/api/download/'+file, {responseType: 'arraybuffer'}).then(res=>{
        let blob = new Blob([res.data], {type:'application/*'})
        let link = document.createElement('a')
        link.href = window.URL.createObjectURL(blob)
        link.download = file
        link.click();
      })
    }
  },
  created(){
    this.getFiles()
  },
};
</script>
<style lang="scss" scoped>
  form {
    display:inline;
  }
</style>