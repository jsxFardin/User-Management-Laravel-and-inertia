<script setup>
defineProps({
  class: {
    type: String,
    default: null,
  },
  style: {
    type: String,
    default: null,
  },
  title: {
    type: String,
    default: null,
  },
  icon: {
    type: String,
    default: null,
  },
  value: {
    type: Number,
    default: 0,
  },
  backgroundColor: {
    default: "bg-info",
  },
});
</script>

<template>
  <div class="info-box" :class="class" :style="style">
    <span :class="['info-box-icon', backgroundColor]">
      <font-awesome-icon :class="'nav-icon'" :icon="['fas', icon]">
      </font-awesome-icon>
    </span>

    <div class="info-box-content">
      <span class="info-box-number">{{ value }}</span>
      <span class="info-box-text ">{{ title }}</span>
    </div>
    <!-- /.info-box-content -->
  </div>
</template>
