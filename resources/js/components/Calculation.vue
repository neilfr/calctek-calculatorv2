<template>
    <li class="mb-2">
        <button @click="deleteCalculation(calculation.id)"><i class="fas fa-trash-can"></i></button>
        {{ calculation.calculation }}={{calculation.result}}
    </li>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        calculation: []
    },
    methods: {
        async deleteCalculation(id) {
            try {
                await axios.delete(`api/calculations/${id}`);
                console.log('Item deleted successfully');
                this.$emit('calculation-deleted')
            } catch (error) {
                console.error('Error deleting item:', error);
            }
        }
    }
};
</script>
