<template>
    <div class="DeviceChartTypeComponent">
        <div class="row">
            <div class="col-lg-12">
                <form>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Tipos</label>
                                <select
                                    class="form-control"
                                    v-model="charttype"
                                >
                                    <option>Selecione</option>
                                    <option
                                        v-for="(type, index) in typesmodel"
                                        :key="index"
                                        :value="index"
                                    >
                                        {{ type }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Eixo X</label>
                                <select class="form-control" v-model="x">
                                    <option>Selecione</option>
                                    <option
                                        v-for="(field, index) in fieldsmodel"
                                        :key="index"
                                        :value="field.id"
                                    >
                                        {{ field.form_name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Eixo Y</label>
                                <select class="form-control" v-model="y">
                                    <option>Selecione</option>
                                    <option
                                        v-for="(field, index) in fieldsmodel"
                                        :key="index"
                                        :value="field.id"
                                    >
                                        {{ field.form_name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary" @click="save($event)">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row" v-if="device.charts.length > 0">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Campo</th>
                            <th>Eixo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(typeChart, index) in device.charts">
                            <td>{{ typeChart.type }}</td>
                            <td>
                                {{ currentTypes[typeChart.pivot.field_id][0] }}
                            </td>
                            <td>{{ typeChart.pivot.x === 1 ? "X" : "Y" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
	import { minLength, required } from "vuelidate/lib/validators";
	import { request } from '../../request';

    export default {
        name: 'DeviceChartTypeComponent',
        props: ['types', 'fields', 'action', 'deviceprop'],

		created() {
			this.typesmodel = JSON.parse(this.types);
			this.fieldsmodel = JSON.parse(this.fields);
			this.device = JSON.parse(this.deviceprop);

			this.configureChartTypesRegistered();
		},

        data() {
            return {
                typesmodel: [],
				fieldsmodel: [],
				charttype: 0,
				device: [],
				x: null,
                y: null,
                currentTypes: []
            }
		},

		validations: {
        	charttype: {
            	required
        	}
    	},

        methods: {
            configureChartTypesRegistered: function () {
				const fields = this.device.fields;
				let registeredTypes = {};
                this.device.charts.map(function (chart) {
                    const finded = fields.find(function(field) {
                        if(field.id == chart.pivot.field_id) {
							const formName = field.form_name
							registeredTypes[chart.pivot.field_id] = [];
							registeredTypes[chart.pivot.field_id].push(formName);
						}
					});
                });

                this.currentTypes = registeredTypes;
            },


            save: async function (event) {
				event.preventDefault();

				if (this.charttype === 1 && this.x == null) {
					this.$swal('Atenção!', 'Para o gráfico tipo linha, é necessário informar o eixo X', 'warning');
					return false;
				};

				const response = await request.post(this.action, {
					chart_type_id: this.charttype,
					x: this.x,
					y: this.y
				});

				if(response.data.status == false) {
					this.$swal('Atenção!', 'Não foi possível salvar configurações.', 'danger');
					return false;
				}

				this.$swal('Sucesso!', 'Configurações salvas com sucesso', 'success');
				return true;

            },

        }
    };
</script>
