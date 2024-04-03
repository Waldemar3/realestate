<template>
    <settlement-item v-for="settlement in settlements"
        :settlement="settlement"
        :key="settlement.id"
        @remove="$emit('remove', settlement)"
    />
</template>

<script>
import SettlementItem from "./SettlementItem";

export default {
    components: {SettlementItem},
    props: {
        settlements: {
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped>
</style>
