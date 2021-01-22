<script>
    import { Line } from 'vue-chartjs';
    export default {
        extends: Line,
        name: 'LineChartComponent',
        props: ['chart'],

        mounted () {
            this.mountChart();
            this.renderChart(this.chartdata, this.options)
        },

        data () {
            return {
                chartOptions: [],
                chartdata: {
                    labels: [],
                    datasets: []
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true
                }
            };
        },

        methods: {
            mountChart: function () {
				this.chartOptions = JSON.parse(this.chart);
                this.chartdata.labels = this.chartOptions.labels;
                this.chartdata.datasets = this.chartOptions.sets;
            }
        }
    };
</script>
