<script setup>
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "@vue/reactivity";
import BreezeDataTableFilter from "@/Components/TableFilter.vue";

let filterForm = reactive({
  page: route().params.page ?? 1,
  sort: route().params.sort ?? "desc",
  name: route().params.name ?? "id",
  max_count: route().params.max_count ?? 10,
  search: route().params.search ?? "",
});

const filterTable = (search) => {
  filterForm.search = search;
  Inertia.get(`camp`, filterForm, {
    preserveState: true,
  });
};
</script>

<template>
  <BreezeDataTableFilter @filterTable="filterTable" 
    :label="'Search Name || Longitude || Latitude'" 
    :placeholder="'Enter Name || Longitude || Latitude'"/>
</template>