<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { ref } from "@vue/reactivity";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeFilter from "@/Pages/Setup/Encampment/Camp/Filter.vue";

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
    title: "Short Name",
    type: "text",
    key: "short_name",
  },
  {
    title: "Location",
    type: "text",
    key: "location",
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
  },
  {
    title: "Area",
    type: "number",
    key: "area",
  },
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
  <Head title="Camp List" />
  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'screwdriver-wrench'"
      title="Camp List"
      :route="route('setup.camp.index')"
    />

    <section class="content">
      <BreezeCard :title="'Camp List'">
        <BreezeFilter />
        <BreezeDataTable
          :route-name="'setup.camp'"
          :modal="false"
          :header="header"
          :data-set="list"
          :actions="access"
        />
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
