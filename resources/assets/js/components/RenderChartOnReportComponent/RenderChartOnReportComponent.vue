<template>
	<div class="RenderChartOnReportComponent">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12" id="chart">
				<line-chart-component :labels="labels" :sets="sets" :chart="datachart" v-if="labels.length > 0"></line-chart-component>
			</div>

		</div>
	</div>
</template>

<script>

import LineChartComponent from "../LineChartComponent/LineChartComponent";

export default {
	name: 'RenderChartOnReportComponent',
	props: ['data'],

	async mounted() {
		const dataChart = JSON.parse(this.$props.data);
		this.labels = dataChart.labels;
		this.sets = dataChart.sets;
	},

	components: {
		LineChartComponent
	},

	data() {
		return {
			labels: [],
			sets: [],
			datachart: [],
		}
	}
};
</script>
