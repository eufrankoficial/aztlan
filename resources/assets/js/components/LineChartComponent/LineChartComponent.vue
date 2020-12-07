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
                    labels: [
                        'January',
                        'February',
                        'March',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'Octuber',
                        'November',
                        'December'
                    ],
                    datasets: [
                        {
                            label: 'CO2',
                            backgroundColor: '#0c5389',
                            data: [
                                441,
                                330,
                                200,
                                100,
                                250,
                                90,
                                80,
                                222,
                                234,
                                400,
                                422,
                                188,
                                92
                            ]
                        },
                        {
                            label: 'Temperatura',
                            backgroundColor: '#FFF',
                            data: [
                                441,
                                330,
                                200,
                                100,
                                250,
                                90,
                                80,
                                222,
                                234,
                                400,
                                422,
                                188,
                                92
                            ]
                        }
                    ]
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
