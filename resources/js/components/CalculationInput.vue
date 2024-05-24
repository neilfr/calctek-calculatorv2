<template>
    <div>
        <input type="text" v-model="equation" placeholder="Enter your equation here">
        <button @click="submitEquation">Submit</button>
        <ul>
            <li v-for="(calculation, index) in calculations" :key="index">{{ calculation }}</li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
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
                alert('Equation submitted successfully!');
                this.fetchCalculations()
            } catch (error) {
                console.error(error);
                alert('An error occurred while submitting the equation.');
            }
        },
        async fetchCalculations() {
            try {
                console.log('getting existing calculations')
                const response = await axios.get('api/calculations');
                this.calculations = response.data;
                console.log('calculations:', this.calculations)
            } catch (error) {
                console.error(error);
                alert('An error occurred while fetching calculations.');
            }
        }
    },
};
</script>
