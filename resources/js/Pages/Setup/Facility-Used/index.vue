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
});
</script>

<template>
  <Head title="Facility used List" />
  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb :icon="'gear'" title="Facility used List" :route="route('setup.facility-used.index')"/>

    <section class="content">
      <BreezeCard :title="'Facility used List'">
        <!-- FILTER -->
        <BreezeFilter></BreezeFilter>
        <BreezeDataTable
          :route-name="'setup.facility-used'"
          :modal="false"
          :header="header"
          :data-set="list"
          :actions="access"
        />
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
