<template>
    <house-item v-for="house in houses"
        :house="house"
        :key="house.id"
        @remove="$emit('remove', house)"
    />
</template>

<script>
import HouseItem from "./HouseItem";

export default {
    components: {HouseItem},
    props: {
        houses: {
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped>
</style>
