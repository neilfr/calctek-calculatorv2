<template>
    <li class="mb-2">
        <button
            @click="$emit('delete-calculation', calculation.id)"
        >
            <i class="fas fa-trash-can"></i>
        </button>
        {{ formattedCalculation }}={{calculation.result}}
    </li>
</template>

<script>
export default {
    props: {
        calculation: Object
    },
    computed: {
        formattedCalculation() {
            return this.calculation.calculation
                .replace(/\//g, '÷')
                .replace(/\*/g, 'x')
        }
    }
};
</script>
