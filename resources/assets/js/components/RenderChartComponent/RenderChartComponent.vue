<template>
    <div class="RenderChartComponent">
        <div class="col-lg-12">
            <line-chart-component :chart="data"></line-chart-component>
        </div>
    </div>
</template>

<script>
    import LineChartComponent from "../LineChartComponent/LineChartComponent";
    export default {
        name: 'RenderChartComponent',
        props: ['data'],
        components: {
            LineChartComponent
        },
    };
</script>
