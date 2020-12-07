<script>
    import { Line } from 'vue-chartjs';
    export default {
        extends: Line,
        name: 'LineChartComponent',

        mounted () {
            this.renderChart(this.chartdata, this.options)
        },

        data () {
            return {
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
                            backgroundColor: '#84C7C7',
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
        }
    };
</script>
