<template>
    <button class="border rounded bg-gray-300" @click="emitValue">{{this.value}}</button>
</template>

<script>
export default {
    name: "CalculatorButton",
    props: {
        value: '',
    },
    methods: {
        emitValue() {
            this.$emit('calculator-button-press', this.value)
        }
    }
}
</script>
