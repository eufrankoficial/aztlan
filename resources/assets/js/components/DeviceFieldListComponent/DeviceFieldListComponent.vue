<template>
    <div class="DeviceFieldListComponent">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <form>
								<div class="form-group">
									<div class="input-group">
										<input
											type="text"
											name="term"
											class="form-control form-control-lg float-right"
											placeholder="Nome do dispositivo"
											v-model="description"
										/>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<input
											type="text"
											name="term"
											class="form-control form-control-lg float-right"
											placeholder="Empresa"
											v-model="company"
											@keypress="getCompanies()"
											:disabled="company_id !== null && companies.length == 0"
										/>
										<div class="col-md-3">
											<button
												class="btn btn-lg btn-success"
												@click="updateDeviceName($event)"
											>{{ buttonSaveName }}</button>
										</div>
									</div>
								</div>

								<div class="form-group" v-if="companies.length > 0">
									<div class="form-check" v-for="(company, index) in companies" :key="index">
										<input class="form-check-input" :id="company.id" type="checkbox" @click="setCompanyId(index)" :checked="company_id == company.id">
										<label class="form-check-label" :for="company.id" @click="setCompanyId(index)">{{  company.fantasy_name }}</label>
									</div>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" v-if="fields.length > 0">
                <div class="card-header">
                    <h3 class="card-title">Campos do dispositivo</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Campo</th>
                                <th>Tipo</th>
                                <th>Nome na listagem</th>
                                <th>Nome no detalhe</th>
                                <th>Nome no relatório</th>
                                <th>Exibir na listagem</th>
                                <th>Exibir no detalhe</th>
                                <th>Exibir no relatório</th>
                                <th>Exibir no gráfico</th>
                                <th>Cor no gráfico</th>
                            </tr>
                        </thead>
                        <tbody>
                            <field-list-item-component
                                v-for="(field, index) in fields"
                                :key="index"
                                :field="field"
                                :url="savefieldaction"
								:types="typesprop"
								:device="device"
                            ></field-list-item-component>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { request } from "../../request";
    import FieldListItemComponent from "../FieldListItemComponent/FieldListItemComponent";
    import { lastArgumentUrl, addCodeDeviceToUrl, changeLastUrlStringDeviceCode } from "../../helpers";

    export default {
        name: 'DeviceFieldListComponent',
        props: ['deviceprop', 'savefieldaction', 'getfieldsaction', 'typesprop', 'actionsavedevice', 'findcompanyaction'],
        components: {
            FieldListItemComponent
        },

        mounted() {
            if(lastArgumentUrl !== 'fields') {
                this.device = lastArgumentUrl;
                this.getDeviceFields(null, 'url');
            }
			const device = JSON.parse(this.$props.deviceprop);
			this.company_id = device.company_id;
			this.company = device.company.fantasy_name;
        },

        data() {
            return {
                fields: [],
                device: null,
				description: null,
                currentUrl: null,
				buttonSaveName: 'Salvar',
				company: null,
				companies: [],
				company_id: null
            };
        },

        methods: {

			setCompanyId: function (id) {
				this.company_id = this.companies[id].id;
				this.company = this.companies[id].fantasy_name;
			},

			getCompanies: async function(event) {
				const term = this.company;

				if(term != null && term.length > 4)
					return false;

				const result = await request.post(this.$props.findcompanyaction, {
					field: 'company_name',
					value: term
				});

				if(result.data.status !== false && result.data.result.length > 0) {
					this.companies = result.data.result;
				}
			},

            getDeviceFields: async function (event, type = 'change') {
                const code = this.device;
                const url = this.getfieldsaction;

                const response = await request.get(this.getfieldsaction);
                if(!response.data.status) {
                    this.$swal('Atenção!', 'Não localizamos o dispositivo informado', 'warning');
                    return false;
                }

                this.fields = response.data.device.fields;
                this.description = response.data.device.description;
            },

            updateDeviceName: async function (event) {
            	this.buttonSaveName = 'Salvando...';
				event.preventDefault();
				const data = {
					description: this.description,
				};

				if(this.company_id !== null) {
					data.company_id = this.company_id;
				}

				const response = request.post(this.actionsavedevice, data);
				this.buttonSaveName = 'Salvo!';
				let buttonName = this.buttonSaveName;
				setTimeout(function () {
					buttonName = 'Salvar';
				}, 3000);

				this.buttonSaveName = buttonName;
            }
        }
    };
</script>
