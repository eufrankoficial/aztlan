<template>
    <div class="RenderChartComponent">
		<div class="col-lg-12 col-md-12 col-sm-12 ml-5">
			<div class="row">
				<div class="col-md-5">
					<!-- Date and time range -->
					<div class="form-group">
						<label>Data inicial</label>
						<datepicker input-class="form-control" v-model="initialDate"></datepicker>
					</div>
					<div class="form-group">
						<vue-timepicker input-class="form-control" format="HH:mm" v-model="initialTime"></vue-timepicker>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label>Data final</label>
						<datepicker input-class="form-control" v-model="finalDate"></datepicker>
					</div>
					<div class="form-group">
						<vue-timepicker input-class="form-control" format="HH:mm" v-model="finalTime"></vue-timepicker>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-12 text-left">
					<button class="btn btn-success" @click="filterData($event)">
						<i class="fa fa-search"></i> {{ textButton }}
					</button>
					<a href="javascript:void(0);" class="btn btn-warning">
						<i class="fa fa-close"></i> Limpar
					</a>
				</div>
			</div>
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
        props: ['device', 'action'],

		async mounted() {
        	await this.filterData();

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
			filterData: async function(event) {
				this.textButton = 'Carregando...';
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

				const data = {
					initialDate: this.initialDate,
					finalDate: this.finalDate
				};

				const response = await request.post(this.action, data)
				this.labels = response.data.data.labels;
				this.sets = response.data.data.sets;
				this.textButton = 'Filtrar';
			}
		}
    };
</script>
