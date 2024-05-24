<template>
        <VueApexCharts
            :type="type"
            :height="height"
            :options="options"
            :series="series"
        ></VueApexCharts>
</template>

<script>
import {defineComponent} from "vue";
import LoadingIcon from "@/Components/loading-icon/Main.vue";
import VueApexCharts from "vue3-apexcharts";

export default defineComponent({
    components: {LoadingIcon, VueApexCharts},
    props: {
        type: {
            type: String,
            default : "bar"
        },
        height: {
            type: String,
            default : "350"
        },
        options: {
            type: Object,
            default : {}
        },
        series: {
            type: Array,
            default : []
        }
    }
});
</script>
