<script setup>
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeButton from "@/Components/Button.vue";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "@vue/reactivity";
import BreezeDataTableFilter from "@/Components/TableFilter.vue";

defineProps({
  latrines: Object,
});

let filterForm = reactive({
  page: route().params.page ?? 1,
  sort: route().params.sort ?? "desc",
  name: route().params.name ?? "id",
  max_count: route().params.max_count ?? 10,

  latrine: route().params.latrine ?? "",
  search: route().params.search ?? "",
});

const filterTable = (search) => {
  filterForm.search = search;
  Inertia.get(`inspection`, filterForm, {
    preserveState: true,
  });
};
</script>

<template>
  <BreezeDataTableFilter @filterTable="filterTable" :label="'Search UID No. || Count filled up ring || Available height from top'"
    :placeholder="'Enter UID No. || Count filled up ring || Available height from top'">
    <!-- <div class="col-md-4">
      <BreezeLabel for="camp" value="Camp" />
      <multi-select
        v-model="filterForm.camp"
        :options="latrines"
        :placeholder="`Choose a camp`"
        :searchable="true"
      />
    </div> -->
  </BreezeDataTableFilter>
</template>