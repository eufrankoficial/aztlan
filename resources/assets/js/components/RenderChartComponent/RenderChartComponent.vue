<template>
    <div class="RenderChartComponent">
		<div class="col-lg-12 col-md-12 col-sm-12 ml-5">
			<form :action="this.actionreport" method="POST" target="_blank">
				<input type="hidden" name="_token" :value="token">
				<div class="row">
					<div class="col-md-5">
						<!-- Date and time range -->
						<div class="form-group">
							<label>Data inicial</label>
							<datepicker input-class="form-control" v-model="initialDate" name="initialDate"></datepicker>
						</div>
						<div class="form-group">
							<vue-timepicker input-class="form-control" format="HH:mm" v-model="initialTime" name="initialTime"></vue-timepicker>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label>Data final</label>
							<datepicker input-class="form-control" v-model="finalDate" name="finalDate"></datepicker>
						</div>
						<div class="form-group">
							<vue-timepicker input-class="form-control" format="HH:mm" v-model="finalTime" name="finalTime"></vue-timepicker>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-sm-12 text-left">
					<button class="btn btn-success" @click="filterData($event)">
						<i class="fa fa-search"></i> {{ textButton }}
					</button>
					<a href="javascript:void(0);" class="btn btn-warning">
						<i class="fa fa-close"></i> Limpar
					</a>
					<button type="submit" class="btn btn-default">
						<i class="fa fa-print"></i> {{ textButtonReport }}
					</button>
				</div>
			</div>
			</form>
		</div>
		<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12">
				<line-chart-component :labels="labels" :sets="sets" :chart="datachart" v-if="labels.length > 0"></line-chart-component>
			</div>
        </div>
    </div>
</template>

<script>
	import Vue from 'vue';
    import LineChartComponent from "../LineChartComponent/LineChartComponent";
	import { request } from "../../request";
	import Datepicker from 'vuejs-datepicker';
	import VueTimepicker from 'vue2-timepicker';

	Vue.use(Datepicker);
	Vue.use(VueTimepicker);
    export default {
        name: 'RenderChartComponent',
        props: ['device', 'action', 'actionreport'],

		async mounted() {
        	await this.filterData();
			this.token = document.getElementsByName('csrf-token')[0].getAttribute('content');
        	setInterval(this.filterData, 60000);
		},

		components: {
            LineChartComponent,
			Datepicker,
			VueTimepicker
        },

		data() {
        	return {
				textButton: 'Filtrar',
				textButtonReport: 'Exportar para relatório',
				token: null,
				initialDate: new Date(),
				initialTime: {
					HH: '00',
					mm: '00'
				},
				finalDate: new Date(),
				finalTime: {
					HH: '23',
					mm: '59'
				},
				devicemodel: null,
				datachart: [],
				labels: [],
				sets: []
			}
		},

		methods: {
			exportToReport: async function (event) {
				this.textButtonReport = 'Carregando...';
				this.formatDate();

				const data = {
					initialDate: this.initialDate,
					finalDate: this.finalDate
				};

				const response = await request.post(this.actionreport, data);
			},

			filterData: async function(event) {
				this.textButton = 'Carregando...';
				this.formatDate();

				const data = {
					initialDate: this.initialDate,
					finalDate: this.finalDate
				};

				const response = await request.post(this.action, data)
				this.labels = response.data.data.labels;
				this.sets = response.data.data.sets;
				this.textButton = 'Filtrar';
			},

			formatDate: function () {
				if(this.initialTime != null && this.initialTime.HH !== undefined && this.initialTime.mm !== undefined) {
					this.initialDate.setUTCHours(this.initialTime.HH, this.initialTime.mm);
				} else {
					this.initialDate.setUTCHours('00', '00');
				}

				if(this.finalTime !== null && this.finalTime.HH !== undefined && this.finalTime.mm !== undefined) {
					this.finalDate.setUTCHours(this.finalTime.HH, this.finalTime.mm);
				} else {
					this.finalDate.setUTCHours(23, 59);
				}
			}
		}
    };
</script>
