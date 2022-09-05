<script setup>
import PieChart from "@/Components/Charts/PieChart.vue";
import Card from "@/Components/Card.vue";
const chartData = {
  labels: ["IOM", "UNHCR", "UNICEF"],
  datasets: [
    {
      backgroundColor: ["#41B883", "#E46651", "#00D8FF"],
      data: [40, 20, 80],
    },
  ],
};
</script>
<template>
  <card title="Per AFA" :showHeader="true">
    <pie-chart :chart-data="chartData" />
  </card>
</template>
