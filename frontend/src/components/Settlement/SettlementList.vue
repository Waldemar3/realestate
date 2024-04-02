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
export default {

}
</script>

<style scoped>
.settlement{
    padding: 15px;
    border: 2px solid teal;
    margin-top: 10px;
}
</style>
