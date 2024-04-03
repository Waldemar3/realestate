<template>
    <select @change="changeOption">
        <option disabled value=""><slot></slot></option>
        <option
            v-for="option in options"
            :key="option.value"
            :value="option.value"
        >
        {{ option.name }}
        </option>
    </select>
</template>

<script>
export default {
    name: 'ui-select',
    props: {
        options: {
            type: Array,
            default: () => []
        }
    },
    methods: {
        changeOption(event) {
            this.$emit('select', event.target.value);
        }
    }
}
</script>

<style scoped>

</style>
  