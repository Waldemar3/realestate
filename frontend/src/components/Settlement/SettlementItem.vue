<template>
    <div class="settlement">
        <div>
            <div><strong>Название: </strong>{{ settlement.name }}</div>
            <div><strong>Адрес: </strong>{{ settlement.address }}</div>
            <div><strong>Площадь: </strong>{{ settlement.area }}</div>
            <div><strong>Видео: </strong>{{ settlement.youtube_video }}</div>
            <div><strong>Ссылка на фото: </strong>{{ settlement.photo_path }}</div>
            <div><strong>Ссылка на pdf: </strong>{{ settlement.presentation_path }}</div>
        </div>
        <div class="settlement__btns">
            <ui-button @click="$emit('remove', settlement)">
                Удалить
            </ui-button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        settlement: {
            type: Object,
            required: true,
        }
    }
}
</script>

<style scoped>
.settlement{
    padding: 15px;
    border: 2px solid teal;
    margin-top: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.settlement__btns{
    display: flex;
}
</style>
  