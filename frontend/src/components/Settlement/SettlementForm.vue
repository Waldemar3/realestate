<template>
    <div class="login-container">
        <form class="login-form" @submit.prevent="load">
            <ui-input v-model="name" placeholder="Название" required />
            <ui-input v-model="address" placeholder="Адрес" required />
            <ui-input v-model="area" placeholder="Площадь" required />
            <ui-input v-model="hotline" placeholder="Номер телефона" required />
            <ui-input v-model="youtube_video" placeholder="Видео" required />
            <ui-input v-if="!settlement" type="file" placeholder="Загрузить фото" @change="photoUpload" />
            <ui-input v-if="!settlement" type="file" placeholder="Загрузить pdf" @change="pdfUpload" />
            <ui-button type="submit">Сохранить</ui-button>
        </form>
    </div>
</template>

<script>

export default {
    props: {
        settlement: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            name: '',
            address: '',
            area: '',
            hotline: '',
            youtube_video: '',
            photo: null,
            presentation: null,
        };
    },
    mounted(){
        if(this.settlement){
            for (let key in this.settlement) {
                if (this.settlement.hasOwnProperty(key)) {
                    this.$data[key] = this.settlement[key];
                }
            }
        }
    },
    methods:{
        photoUpload(event) {
            this.photo = event.target.files[0];
        },
        pdfUpload(event) {
            this.presentation = event.target.files[0];
        },
        load(){
            this.$emit('load', this.$data);
        }
    }
}
</script>

<style scoped>

</style>