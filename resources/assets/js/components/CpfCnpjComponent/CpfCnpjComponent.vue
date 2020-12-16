<template>
    <div class="row">
        <div class="col-sm-6">
            <!-- select -->
            <div class="form-group">
                <label>Tipo de documento</label>
                <select v-model="type" class="form-control">
                    <option value="cpf">CPF</option>
                    <option value="cnpj">CNPJ</option>
                </select>
            </div>
        </div>

        <div class="col-md-5" v-if="type == 'cpf'">
            <div class="form-group">
                <label>CPF</label>
                <input type="text" class="form-control" placeholder="CPF" name="cpf_cnpj" v-mask="'###.###.###-##'" v-model="cpf_cnpj">
            </div>
        </div>

        <div class="col-md-5" v-else>
            <div class="form-group">
                <label>CNPJ</label>
                <input type="text" class="form-control" placeholder="CNPJ" name="cpf_cnpj" v-mask="'##.###.###/####-##'" v-model="cpf_cnpj">
            </div>
        </div>
    </div>


</template>

<script>
import Vue from 'vue'

import VueMask from "v-mask";
Vue.use(VueMask);

export default {
    name: 'CpfCnpjComponent',
    props: ['value', 'error'],

    mounted() {
        this.verifyValue();
    },

    data() {
        return {
            type: 'cpf',
            cpf_cnpj: this.value,
            errorField: this.error
        }
    },

    methods: {
        verifyValue: function() {
            if(this.value.length > 14) {
                this.type = 'cnpj';
            }
        }
    }
};
</script>
