<script setup>
import PieChart from "@/Components/Charts/PieChart.vue";
import Card from "@/Components/Card.vue";
const chartData = {
  labels: ["HouseHold", "Source"],
  datasets: [
    {
      backgroundColor: ["#41B883", "#E46651"],
      data: [40, 20],
    },
  ],
};
</script>
<template>
  <card title=" Water Samples at Household and Source Level" :showHeader="true">
    <pie-chart :chart-data="chartData" />
  </card>
</template>
