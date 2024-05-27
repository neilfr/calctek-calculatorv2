<template>
    <div>
        <div class="grid grid-cols-4 gap-2 max-w-80 mb-4">
            <input
                class="col-span-4 overflow-x-auto!important border bg-white"
                type="text"
                :value="equation"
                ref="readout"
                readonly
            >
            <button class="border bg-red-300 rounded" @click="clear">AC</button>
            <calculator-button value="(" @calculator-button-press="append"></calculator-button>
            <calculator-button value=")" @calculator-button-press="append"></calculator-button>
            <calculator-button value="^" @calculator-button-press="append"></calculator-button>
            <calculator-button value="sin(" @calculator-button-press="append"></calculator-button>
            <calculator-button value="cos(" @calculator-button-press="append"></calculator-button>
            <calculator-button value="tan(" @calculator-button-press="append"></calculator-button>
            <calculator-button value="sqrt(" @calculator-button-press="append"></calculator-button>
            <calculator-button value="7" @calculator-button-press="append"></calculator-button>
            <calculator-button value="8" @calculator-button-press="append"></calculator-button>
            <calculator-button value="9" @calculator-button-press="append"></calculator-button>
            <calculator-button value='÷' @calculator-button-press="append"></calculator-button>
            <calculator-button value="4" @calculator-button-press="append"></calculator-button>
            <calculator-button value="5" @calculator-button-press="append"></calculator-button>
            <calculator-button value="6" @calculator-button-press="append"></calculator-button>
            <calculator-button value="x" @calculator-button-press="append"></calculator-button>
            <calculator-button value="1" @calculator-button-press="append"></calculator-button>
            <calculator-button value="2" @calculator-button-press="append"></calculator-button>
            <calculator-button value="3" @calculator-button-press="append"></calculator-button>
            <calculator-button value="-" @calculator-button-press="append"></calculator-button>
            <calculator-button value="0" @calculator-button-press="append"></calculator-button>
            <calculator-button value="." @calculator-button-press="append"></calculator-button>
            <button
                class="border rounded bg-orange-200"
                @click="submitEquation"
            >
                =
            </button>
            <calculator-button value="+" @calculator-button-press="append"></calculator-button>
        </div>
        <ticker
            :calculations="calculations"
            @delete-calculation="deleteCalculation"
            @delete-all-calculations="deleteAllCalculations"
        ></ticker>
    </div>
</template>

<script>

// TODO: conditionally render buttons based on backend service
import axios from 'axios'
import CalculatorButton from "./CalculatorButton.vue"
import Ticker from "./Ticker.vue";
export default {
    components: {Ticker, CalculatorButton},
    data() {
        return {
            readout: null,
            equation: '',
            calculations: [],
        };
    },
    mounted() {
        this.readout = this.$refs.readout
        this.fetchCalculations()
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
                await axios.post('/api/calculations', { calculation: this.formatEquation() })
                this.fetchCalculations()
                this.clear()
            } catch (error) {
                console.error(error)
                alert(`Equation ${this.equation} is invalid`)
                this.clear()
            }
        },
        formatEquation(){
            return this.equation
                .replace(/x/g, '*')
                .replace(/÷/g, '/')
        },
        async fetchCalculations() {
            try {
                const response = await axios.get('api/calculations')
                this.calculations = response.data.data.map(calculation => ({
                    id:calculation.id,
                    calculation: calculation.calculation,
                    result: calculation.result
                }))
                this.calculations.sort((a, b) => b.id - a.id)
            } catch (error) {
                console.error(error);
                alert('An error occurred while fetching calculations.')
            }
        },
        refreshCalculations() {
            this.fetchCalculations()
        },
        async deleteAllCalculations() {
            try {
                await axios.delete(`api/calculations`)
                this.fetchCalculations()
            } catch (error) {
                console.error('Error deleting item:', error)
            }
        },
        async deleteCalculation(id) {
            try {
                await axios.delete(`api/calculations/${id}`)
                await this.fetchCalculations()
            } catch (error) {
                console.error('Error deleting item:', error)
            }
        }
    },
};
</script>
