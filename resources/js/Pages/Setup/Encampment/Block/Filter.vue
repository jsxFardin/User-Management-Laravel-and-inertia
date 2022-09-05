<script setup>
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeButton from "@/Components/Button.vue";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "@vue/reactivity";
import BreezeDataTableFilter from "@/Components/TableFilter.vue";

let propsData = defineProps({
  camps: Object,
  blocks: Object,
});

let filterForm = reactive({
  page: route().params.page ?? 1,
  sort: route().params.sort ?? "desc",
  name: route().params.name ?? "id",
  max_count: route().params.max_count ?? 10,
  search: route().params.search ?? "",
  camp: route().params.camp ?? "",
  block: route().params.block ?? "",
});

let data = reactive({
  campBlocks: propsData.blocks,
});

const filterTable = (search) => {
  filterForm.search = search;
  Inertia.get(`block`, filterForm, {
    preserveState: true,
  });
};

const getBlock = (event) => {
  if (event != null) {
    filterForm.block = "";
    data.campBlocks = propsData.blocks.filter((item) => event == item.camp_id);
  }
  if (event != null && data.campBlocks.length == 0) {
    filterForm.block = "";
    const params = {
        params: {
            'camp_id': event,
        }
    }
    axios.get(`ajax/block-details`, params)
      .then((response) => {
        data.campBlocks = response.data;
      })
      .catch((error) => {
        toast.warning(error);
      });
  }
};
</script>

<template>
  <BreezeDataTableFilter
    @filterTable="filterTable"
    :label="'Search Name || Short name'"
    :placeholder="'Enter Name || Short name'"
  >
    <div class="col-md-4">
      <BreezeLabel for="camp" value="Camp" />
      <multi-select
        v-model="filterForm.camp"
        @change="getBlock($event)"
        :options="camps"
        :placeholder="`Choose a camp`"
        :searchable="true"
      />
    </div>

    <div class="col-md-4">
      <BreezeLabel for="block" value=" Block" />
      <multi-select
        v-model="filterForm.block"
        :options="data.campBlocks"
        :placeholder="`Choose a block`"
        :searchable="true"
      />
    </div>
  </BreezeDataTableFilter>
</template>