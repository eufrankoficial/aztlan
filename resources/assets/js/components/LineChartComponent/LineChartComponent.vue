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
                chartOptions: JSON.parse(this.chart),
                chartdata: {
                    labels: [],
                    datasets: []
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            };
        },

        methods: {
            mountChart: function () {
                this.chartdata.labels = this.chartOptions.labels;
                this.chartdata.datasets = this.chartOptions.sets;
            }
        }
    };
</script>
