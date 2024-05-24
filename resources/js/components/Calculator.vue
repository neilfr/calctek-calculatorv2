<template>
    <div>
        <div>
            <calculator-button value="1" @calculator-button-press="append"></calculator-button>
            <calculator-button value="2" @calculator-button-press="append"></calculator-button>
            <calculator-button value="3" @calculator-button-press="append"></calculator-button>
            <calculator-button value="4" @calculator-button-press="append"></calculator-button>
            <calculator-button value="5" @calculator-button-press="append"></calculator-button>
            <calculator-button value="6" @calculator-button-press="append"></calculator-button>
            <calculator-button value="7" @calculator-button-press="append"></calculator-button>
            <calculator-button value="8" @calculator-button-press="append"></calculator-button>
            <calculator-button value="9" @calculator-button-press="append"></calculator-button>
            <calculator-button value="0" @calculator-button-press="append"></calculator-button>
            <calculator-button value="." @calculator-button-press="append"></calculator-button>
            <calculator-button value="+" @calculator-button-press="append"></calculator-button>
            <calculator-button value="-" @calculator-button-press="append"></calculator-button>
            <calculator-button value='/' @calculator-button-press="append"></calculator-button>
            <calculator-button value="x" @calculator-button-press="append"></calculator-button>
            <calculator-button value="^" @calculator-button-press="append"></calculator-button>
        </div>

        <input type="text" v-model="equation" placeholder="Enter your equation here" readonly>
        <button @click="submitEquation">=</button>

        <ul>
            <Calculation
                v-for="(calculation, index) in calculations"
                :key="index"
                :calculation="calculation"
                @calculation-deleted="refreshCalculations"
            ></Calculation>
        </ul>
        <button @click="deleteAllCalculations">Delete All</button>
    </div>
</template>

<script>

import axios from 'axios';
import Calculation from "./Calculation.vue";
import CalculatorButton from "./CalculatorButton.vue";
export default {
    components: {CalculatorButton, Calculation},
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
        async append($value){
            this.equation = this.equation + $value
        },
        async one(){
            this.equation = this.equation + '1'
        },
        async two(){
            this.equation = this.equation + '2'
        },
        async submitEquation() {
            try {
                await axios.post('/api/calculations', { calculation: this.equation });
                this.fetchCalculations()
                this.equation=""
            } catch (error) {
                console.error(error);
                alert(`Equation ${this.equation} is invalid`);
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
