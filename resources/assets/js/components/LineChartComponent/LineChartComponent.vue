<script>
    import { Line, mixins } from 'vue-chartjs';
    export default {
		extends: Line,
        name: 'LineChartComponent',
        props: ['chart', 'labels', 'sets'],

		watch: {
			labels: function(newVal, oldVal) { // watch it
				this.chartdata.labels = newVal;
			},
			sets: function(newVal, oldVal) {
				this.chartdata.datasets = newVal;
				this.renderChart(this.chartdata, this.options);
			},
			chart: function(newVal, oldVal) {
				this.chartOptions = newVal;
			}
		},
        mounted () {
			this.chartOptions = this.$props.chart;
            this.mountChart();
            this.renderChart(this.chartdata, this.options)
        },

        data () {
            return {
                chartOptions: this.$props.chart,
                chartdata: {
                    labels: this.$props.labels,
                    datasets: this.$props.sets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
					scales: {
						xAxes:[{
							ticks:{
								autoSkip: false,
								autoSkipPadding: -20,
								max: 9999,
								min: 0,
								stepSize: 0.5
							}
						}]
					},
					tooltips: {
						mode: 'point'
					}
                }
            };
        },

        methods: {
            mountChart: function () {
				if(this.chartOptions.length > 0) {
					this.chartdata.labels = this.chartOptions.labels;
					this.chartdata.datasets = this.chartOptions.sets;
				}
            }
        }
    };
</script>
