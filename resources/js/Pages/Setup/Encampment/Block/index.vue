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
    title: "Camp",
    type: "text",
    key: "camp_name",
    sort: true
  },
  {
    title: "Parent block",
    type: "text",
    key: "parent_name",
    sort: true
  },
  {
    title: "Block Name",
    type: "text",
    key: "name",
    sort: true
  },
  {
    title: "Short Name",
    type: "text",
    key: "short_name",
    sort: true
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
  camps: Object,
  blocks: Object,
});
</script>

<template>
  <Head title="Blocks List" />
  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb :icon="'screwdriver-wrench'" title="Blocks List" :route="route('setup.block.index')" />

    <section class="content">
      <BreezeCard :title="'Blocks List'">
        <!-- FILTER -->
        <BreezeFilter :camps="camps" :blocks="blocks"></BreezeFilter>
        <BreezeDataTable
          :route-name="'setup.block'"
          :modal="false"
          :header="header"
          :data-set="list"
          :actions="access"
        />
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
