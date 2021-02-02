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
							<datepicker input-class="form-control" v-model="initialDate" name="initialDate" format="dd/MM/yyyy" :use-utc="true" :language="ptBr"></datepicker>
						</div>
						<div class="form-group">
							<vue-timepicker input-class="form-control" format="HH:mm" v-model="initialTime" name="initialTime"></vue-timepicker>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label>Data final</label>
							<datepicker input-class="form-control" v-model="finalDate" name="finalDate" format="dd/MM/yyyy" :use-utc="true" :language="ptBr"></datepicker>
						</div>
						<div class="form-group">
							<vue-timepicker input-class="form-control" format="HH:mm" v-model="finalTime" name="finalTime"></vue-timepicker>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-md-6 col-sm-12 text-left">
					<a href="javascript:void(0);" class="btn btn-success" @click="filterData($event)">
						<i class="fa fa-search"></i> {{ textButton }}
					</a>
					<button type="submit" class="btn btn-warning">
						<i class="fa fa-print"></i> {{ textButtonReport }}
					</button>
				</div>
			</div>
			</form>
		</div>
		<div class="row">
        	<div class="col-lg-12 col-md-12 col-sm-12" id="chart">
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
	import {ptBR} from 'vuejs-datepicker/dist/locale'

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
				initialDate: null,
				initialTime: {},
				finalDate: null,
				finalTime: {},
				devicemodel: null,
				datachart: [],
				labels: [],
				sets: [],
				ptBr: ptBR,
			}
		},

		methods: {
			filterData: async function() {
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
					this.initialDate
				}

				if(this.finalTime !== null && this.finalTime.HH !== undefined && this.finalTime.mm !== undefined) {
					this.finalDate.setUTCHours(this.finalTime.HH, this.finalTime.mm);
				}
			}
		}
    };
</script>
