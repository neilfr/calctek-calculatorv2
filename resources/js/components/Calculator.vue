<template>
    <div>
        <input type="text" v-model="equation" placeholder="Enter your equation here">
        <button @click="submitEquation">=</button>

        <h2>Calculation</h2>
        <ul>
            <Calculation
                v-for="(calculation, index) in calculations"
                :key="index"
                :calculation="calculation"
                @calculationDeleted="refreshCalculations"
            ></Calculation>
        </ul>
        <button @click="deleteAllCalculations">Delete All</button>
    </div>
</template>

<script>

import axios from 'axios';
import Calculation from "./Calculation.vue";
export default {
    components: {Calculation},
    data() {
        return {
            equation: '',
            calculations: []
        };
    },
    mounted() {
        console.log('I am mounted!')
       this.fetchCalculations();
    },
    methods: {
        async submitEquation() {
            try {
                await axios.post('/api/calculations', { calculation: this.equation });
                this.fetchCalculations()
            } catch (error) {
                console.error(error);
            }
        },
        async fetchCalculations() {
            try {
                console.log('getting existing calculations')
                const response = await axios.get('api/calculations');
                this.calculations = response.data.data
                this.calculations = response.data.data.map(calculation => ({
                    id:calculation.id,
                    calculation: calculation.calculation,
                    result: calculation.result
                }));
                console.log('calculations:', this.calculations)
            } catch (error) {
                console.error(error);
                alert('An error occurred while fetching calculations.');
            }
        },
        refreshCalculations() {
            this.fetchCalculations()
        },
        async deleteAllCalculations() {
            try {
                await axios.delete(`api/calculations`);
                console.log('Items deleted successfully');
                this.fetchCalculations();
            } catch (error) {
                console.error('Error deleting item:', error);
            }
        }
    },
};
</script>
