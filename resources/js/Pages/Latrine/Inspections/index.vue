<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { ref } from "@vue/reactivity";
import BreezeFilter from "@/Pages/Latrine/Inspections/Filter.vue";
const header = ref([
  {
    title: "Id",
    type: "text",
    key: "id",
  },
  {
    title: "Latrine UID",
    type: "text",
    key: "uid_no",
    sort: true,
    sortBy: "lt.uid_no",
  },
  {
    title: "Count Filled Up Ring",
    type: "text",
    key: "count_filled_up_ring",
    sort: true,
    sortBy: "inp.count_filled_up_ring",
  },
  {
    title: "Available Height From Top",
    type: "text",
    key: "available_height_from_top",
    sort: true,
    sortBy: "inp.available_height_from_top",
  },
]);

defineProps({
  lists: {
    type: Array,
    default: [],
  },
  message: {
    type: String,
    default: null,
  },
  access: {
    type: Array,
    default: [],
  },
  latrines: Object,
});
</script>

<template>
  <Head title="Inspection List" />
  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'lightbulb'"
      title="Inspection List"
      :route="route('inspection.index')"
    />

    <section class="content">
      <BreezeCard :title="'Inspection'">
        <BreezeFilter :latrines="latrines"/>
        <BreezeDataTable
          :route-name="'inspection'"
          :modal="false"
          :header="header"
          :data-set="lists"
          :actions="access"
        />
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
