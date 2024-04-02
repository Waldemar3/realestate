<template>
  <div class="settlement" v-for="{ 
        name, 
        address, 
        area, 
        youtube_video, 
        photo_path, 
        presentation_path 
        } in settlements">
        <div><strong>Название: </strong>{{ name }}</div>
        <div><strong>Адрес: </strong>{{ address }}</div>
        <div><strong>Площадь: </strong>{{ area }}</div>
        <div><strong>Видео: </strong>{{ youtube_video }}</div>
        <div><strong>Ссылка на фото: </strong>{{ photo_path }}</div>
        <div><strong>Ссылка на pdf: </strong>{{ presentation_path }}</div>
    </div>
</template>

<script>
const axios = require('axios');

export default {
  data(){
    return {
      settlements: [],
    }
  },
  mounted() {
    axios.post('http://localhost/api/settlements')
      .then(response => {
        this.settlements = response.data;
      })
      .catch(error => {
        console.error('Error fetching posts:', error);
      });
  }
};
</script>

<style>
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
</style>