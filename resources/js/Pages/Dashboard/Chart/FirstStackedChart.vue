<script setup>
  import StackedChart from "@/Components/Charts/StackedChart.vue";
  import Card from "@/Components/Card.vue";

  defineProps({
      data: {
          type: Object,
          default: {
              labels: [],
              datasets: []
          }
      },
      title: {
          type: String,
          default: "Stacked Chart"
      }
  })

</script>

<template>
  <card :title="title" :showHeader="true">
    <stacked-chart :chart-data="data" />
  </card>
</template>
