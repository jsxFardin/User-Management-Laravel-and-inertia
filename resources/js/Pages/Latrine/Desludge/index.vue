<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { ref } from "@vue/reactivity";
import BreezeFilter from "./Filter.vue";

const header = ref([
  {
    title: "Id",
    type: "text",
    key: "id",
  },
  {
    title: "Latrine",
    type: "text",
    key: "uid_no",
  },
  {
    title: "Collection Date",
    type: "text",
    key: "collection_date_time",
  },
  {
    title: "Count Ring",
    type: "text",
    key: "count_desludge_ring",
  },
  {
    title: "Height From Top",
    type: "text",
    key: "desludged_height_from_top",
  },
  {
    title: "Total Volume",
    type: "text",
    key: "total_volume_desludged",
  },
  {
    title: "Petrol(l)",
    type: "text",
    key: "litre_of_petrol",
  },
  {
    title: "Status",
    type: "text",
    key: "status",
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
  camps: Object,
  blocks: Object,
});
</script>

<template>
  <Head title="Desludge List" />
  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'person-digging'"
      title="Desludge List"
      :route="route('desludge.index')"
    />

    <section class="content">
      <BreezeCard :title="'Desludge'">
        <!-- FILTER -->
        <BreezeFilter :camps="camps" :blocks="blocks"></BreezeFilter>
        <BreezeDataTable
          :route-name="'desludge'"
          :modal="false"
          :header="header"
          :data-set="lists"
          :actions="access"
        />
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
