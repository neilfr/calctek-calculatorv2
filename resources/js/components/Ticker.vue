<template>
    <div>
        <button
            class="border bg-red-300 rounded px-2 mb-2"
            @click="$emit('delete-all-calculations')"
        >
            Clear Ticker
        </button>
        <ul>
            <Calculation
                v-for="(calculation, index) in calculations"
                :key="index"
                :calculation="calculation"
                @delete-calculation="$emit('delete-calculation', calculation.id)"
            ></Calculation>
        </ul>
    </div>
</template>

<script>
import Calculation from "./Calculation.vue";

export default {
    name: "Ticker",
    components: {Calculation},
    props: {
        calculations: Array
    }
}
</script>
