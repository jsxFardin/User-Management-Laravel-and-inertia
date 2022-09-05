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
    sort: true,
  },
  {
    title: "Latrine ID",
    type: "text",
    key: "uid_no",
    sort: true,
  },
  {
    title: "Complaint",
    type: "text",
    key: "complaint",
  },
  {
    title: "Pending/Verified",
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
  <Head title="Complaint List" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'box-open'"
      title="Complaint List"
      :route="route('complaint.index')"
    />
    <section class="content">
      <BreezeCard :title="'Complaint'">
        <!-- FILTER -->
        <BreezeFilter :camps="camps" :blocks="blocks"></BreezeFilter>
        <BreezeDataTable
          :route-name="'complaint'"
          :modal="false"
          :header="header"
          :data-set="lists"
          :actions="access"
        />
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
