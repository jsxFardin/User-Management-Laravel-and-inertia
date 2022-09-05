<script setup>
import { Pie } from "vue-chartjs";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
  CategoryScale,
} from "chart.js";

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale);

defineProps({
  chartId: {
    type: String,
    default: "pie-chart",
  },
  datasetIdKey: {
    type: String,
    default: "label",
  },
  width: {
    type: Number,
    default: 300,
  },
  height: {
    type: Number,
    default: 300,
  },
  cssClasses: {
    default: "",
    type: String,
  },
  styles: {
    type: Object,
    default: () => {},
  },
  plugins: {
    type: Array,
    default: () => [],
  },
  chartData: {
    type: Object,
    default: () => {},
  },
  chartOptions: {
    type: Object,
    default: () => {
      return {
        responsive: true,
        maintainAspectRatio: false,
      };
    },
  },
});
</script>

<template>
  <Pie
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="styles"
    :width="width"
    :height="height"
  />
</template>
