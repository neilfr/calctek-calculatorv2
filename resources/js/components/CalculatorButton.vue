<template>
    <button
        class="border rounded bg-gray-300"
        @click="$emit('calculator-button-press', value)"
    >
        {{this.value}}
    </button>
</template>

<script>
export default {
    name: "CalculatorButton",
    props: {
        value: '',
    }
}
</script>
