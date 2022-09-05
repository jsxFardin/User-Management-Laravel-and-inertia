<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { ref } from "@vue/reactivity";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeFilter from "@/Pages/Setup/Sanitation-Zone/Filter.vue";

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
  },
  {
    title: "Latitude",
    type: "number",
    key: "latitude",
  },
  {
    title: "Longitude",
    type: "number",
    key: "longitude",
  }
]);

defineProps({
  list: {
    type: Array,
    default: [],
  },
  access: {
    type: Array,
    default: [],
  },
});
</script>

<template>
  <Head title="Sanitation Zone List" />
  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'screwdriver-wrench'"
      title="Sanitation Zone List"
      :route="route('setup.sanitation-zone.index')"
    />

    <section class="content">
      <BreezeCard :title="'Sanitation Zone List'">
        <BreezeFilter />
        <BreezeDataTable
          :route-name="'setup.sanitation-zone'"
          :modal="false"
          :header="header"
          :data-set="list"
          :actions="access"
        />
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
