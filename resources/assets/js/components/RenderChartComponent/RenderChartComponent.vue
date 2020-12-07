<template>
    <div class="RenderChartComponent">
        <div class="small">
            <line-chart-component></line-chart-component>
        </div>
    </div>
</template>

<script>
    import LineChartComponent from "../LineChartComponent/LineChartComponent";
    export default {
        name: 'RenderChartComponent',
        components: {
            LineChartComponent
        },
    };
</script>
