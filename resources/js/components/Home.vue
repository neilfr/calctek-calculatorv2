<template>
    <div class="container p-6">
        <h1 class="text-3xl font-bold underline mb-4">
            CalcTek Calculator
        </h1>
        <div>
            <Calculator></Calculator>
        </div>
    </div>
</template>

<script>
    import Calculator from "./Calculator.vue";

    export default {
        components: {Calculator},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
