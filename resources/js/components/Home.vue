<template>
    <div class="container">
        <h1 class="text-3xl font-bold underline">
            Welcome To Calctek Calculator!
        </h1>
        <div>
            <CalculationInput></CalculationInput>
        </div>
    </div>
</template>

<script>
    import CalculationInput from "./CalculationInput.vue";

    export default {
        components: {CalculationInput},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
