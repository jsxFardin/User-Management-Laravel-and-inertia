<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { ref } from "@vue/reactivity";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeFilter from "./Filter.vue";

const header = ref([
  {
    title: "Id",
    type: "text",
    key: "id",
  },
  {
    title: "Name",
    type: "text",
    key: "name",
    sort: true,
  },
]);

defineProps({
  list: {
    type: Array,
    default: [],
  },
  access: {
      type: Array,
      default: []
  },
});
</script>

<template>
  <Head title="Transfer List" />
  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb :icon="'screwdriver-wrench'" title="Transfer List" :route="route('setup.transfer.index')"/>

    <section class="content">
      <BreezeCard :title="'Transfer List'">
        <!-- FILTER -->
        <BreezeFilter></BreezeFilter>
        <BreezeDataTable
          :route-name="'setup.transfer'"
          :modal="false"
          :header="header"
          :data-set="list"
          :actions="access"
        />
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
