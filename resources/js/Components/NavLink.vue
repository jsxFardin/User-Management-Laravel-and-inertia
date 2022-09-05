<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() => (props.active ? "nav-link active" : "nav-link"));
function closeMobileSidebar() {
  let sideBar = $(".sidebar-mini");
  if (sideBar.hasClass("sidebar-open")) {
    sideBar.removeClass("sidebar-open");
    sideBar.addClass("sidebar-closed");
    sideBar.addClass("sidebar-collapse");
  }
}
</script>

<template>
  <Link :href="href" @click.prevent="closeMobileSidebar" :class="classes">
    <slot />
  </Link>
</template>
