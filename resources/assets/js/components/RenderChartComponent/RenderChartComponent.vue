<template>
    <div class="RenderChartComponent">
		<div class="col-lg-12 col-md-12 col-sm-12 ml-5">
			<div class="row">
				<div class="col-md-4">
					<!-- Date and time range -->
					<div class="form-group">
						<label>Data inicial</label>
						<datepicker input-class="form-control" v-model="initialDate"></datepicker>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Data final</label>
						<datepicker input-class="form-control" v-model="finalDate"></datepicker>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 text-left">
					<button class="btn btn-success" @click="filterData($event)">
						<i class="fa fa-search"></i> Buscar
					</button>
					<a href="javascript:void(0);" class="btn btn-warning">
						<i class="fa fa-close"></i> Limpar
					</a>
				</div>
			</div>
		</div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <line-chart-component :labels="labels" :sets="sets" :chart="datachart" v-if="labels.length > 0"></line-chart-component>
        </div>
    </div>
</template>

<script>
	import Vue from 'vue';
    import LineChartComponent from "../LineChartComponent/LineChartComponent";
	import { request } from "../../request";
	import Datepicker from 'vuejs-datepicker';
	Vue.use(Datepicker);
    export default {
        name: 'RenderChartComponent',
        props: ['device', 'action'],

		async mounted() {
        	await this.filterData();

        	setInterval(this.filterData, 60000);
		},

		components: {
            LineChartComponent,
			Datepicker
        },

		data() {
        	return {
				initialDate: null,
				finalDate: null,
				devicemodel: null,
				datachart: [],
				labels: [],
				sets: []
			}
		},

		methods: {
			filterData: async function(event) {
				const data = {
					initialDate: this.initialDate,
					finalDate: this.finalDate
				};
				const response = await request.post(this.action, data)
				this.labels = response.data.data.labels;
				this.sets = response.data.data.sets;
			}
		}
    };
</script>
