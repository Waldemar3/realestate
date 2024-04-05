<template>
    <div class="login-container">
        <form class="login-form" @submit.prevent="load">
            <ui-input v-model="name" placeholder="Название" required />
            <ui-input v-model="price_usd" placeholder="Цена" required />
            <ui-input v-model="floors" placeholder="Кол-во этажей" required />
            <ui-input v-model="bedrooms" placeholder="Кол-во спальней" required />
            <ui-input v-model="area" placeholder="Площадь" required />
            <ui-input v-model="type" placeholder="Тип" required />
            <ui-input v-model="settlement_id" placeholder="ID поселка" required />
            <ui-button type="submit">Сохранить</ui-button>
        </form>
    </div>
</template>

<script>

export default {
    props: {
        house: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            name: '',
            price_usd: '',
            floors: '',
            bedrooms: '',
            area: '',
            type: '',
            settlement_id: '',
        };
    },
    mounted(){
        if(this.house){
            for (let key in this.house) {
                if (this.house.hasOwnProperty(key)) {
                    this.$data[key] = this.house[key];
                }
            }
        }
    },
    methods:{
        load(){
            this.$emit('load', this.$data);
        }
    }
}
</script>

<style scoped>

</style>