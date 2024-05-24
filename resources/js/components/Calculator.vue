<template>
    <div>
        <div class="grid grid-cols-4 gap-2 max-w-80">
            <input class="col-span-4 overflow-x-auto!important border bg-white" type="text" v-model="equation" ref="readout">
            <button class="border bg-red-300 rounded" @click="clear">AC</button>
            <button class="border bg-red-600 rounded" @click="deleteAllCalculations">DA</button>
            <div></div>
            <calculator-button value="^" @calculator-button-press="append"></calculator-button>
            <calculator-button value="7" @calculator-button-press="append"></calculator-button>
            <calculator-button value="8" @calculator-button-press="append"></calculator-button>
            <calculator-button value="9" @calculator-button-press="append"></calculator-button>
            <calculator-button value='/' @calculator-button-press="append"></calculator-button>
            <calculator-button value="4" @calculator-button-press="append"></calculator-button>
            <calculator-button value="5" @calculator-button-press="append"></calculator-button>
            <calculator-button value="6" @calculator-button-press="append"></calculator-button>
            <calculator-button value="*" @calculator-button-press="append"></calculator-button>
            <calculator-button value="1" @calculator-button-press="append"></calculator-button>
            <calculator-button value="2" @calculator-button-press="append"></calculator-button>
            <calculator-button value="3" @calculator-button-press="append"></calculator-button>
            <calculator-button value="-" @calculator-button-press="append"></calculator-button>
            <calculator-button value="0" @calculator-button-press="append"></calculator-button>
            <calculator-button value="." @calculator-button-press="append"></calculator-button>
            <button class="border rounded bg-orange-200" @click="submitEquation">=</button>
            <calculator-button value="+" @calculator-button-press="append"></calculator-button>
        </div>


        <ul>
            <Calculation
                v-for="(calculation, index) in calculations"
                :key="index"
                :calculation="calculation"
                @calculation-deleted="fetchCalculations"
            ></Calculation>
        </ul>
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
            readout: null,
            equation: '',
            calculations: []
        };
    },
    mounted() {
        this.readout = this.$refs.readout
        console.log('I am mounted!')
        this.fetchCalculations();
    },
    methods: {
        async append($value){
            this.equation = this.equation + $value
            this.scrollInput()
        },
        scrollInput() {
            this.$nextTick(() => {
                if (this.readout) {
                    this.readout.scrollLeft = this.readout.scrollWidth
                }
            });
        },
        clear(){
            this.equation = ''
        },
        async submitEquation() {
            try {
                console.log('submitting:',this.equation)
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
                console.log('calculations:', this.calculations)
            } catch (error) {
                console.error(error);
                alert('An error occurred while fetching calculations.');
            }
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
