<template>
    <div class="settlement">
        <div>
            <div><strong>Название: </strong>{{ house.name }}</div>
            <div><strong>USD: </strong>{{ house.price_usd }}</div>
            <div><strong>RUB: </strong>{{ house.price_rub }}</div>
            <div><strong>Кол-во этажей: </strong>{{ house.floors }}</div>
            <div><strong>Кол-во спальней: </strong>{{ house.bedrooms }}</div>
            <div><strong>Площадь: </strong>{{ house.area }}</div>
            <div><strong>Тип: </strong>{{ house.type }}</div>
            <div><strong>Поселок: </strong>{{ house.settlement.name }}</div>
        </div>
        <div class="settlement__btns">
            <ui-button @click="$emit('remove', house)">
                Удалить
            </ui-button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        house: {
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
  