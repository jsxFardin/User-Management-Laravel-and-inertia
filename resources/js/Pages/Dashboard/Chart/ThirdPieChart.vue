<script setup>
import PieChart from "@/Components/Charts/PieChart.vue";
import Card from "@/Components/Card.vue";
const chartData = {
  labels: ["HandPump", "RawWater", "BottledWater"],
  datasets: [
    {
      backgroundColor: ["#41B883", "#E46651", "#00D8FF"],
      data: [40, 20, 50],
    },
  ],
};
</script>
<template>
  <card title=" Water Samples at Household and Source Level" :showHeader="true">
    <pie-chart :chart-data="chartData" />
  </card>
</template>
