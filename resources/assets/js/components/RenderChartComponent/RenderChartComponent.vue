<template>
    <div class="RenderChartComponent">
        <div class="small">
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
