<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import BreezeFlashMessage from "@/Components/FlashMessage.vue";
import { computed } from "@vue/runtime-core";
import BreezeFilter from "@/Pages/Agency/Filter.vue";

const userAgency = computed(() => storeData.getters.getAgencies);

const header = ref([
  {
    title: "#",
    type: "text",
    key: "id",
  },
  {
    title: "Agency Name",
    type: "text",
    key: "agency_name",
    sort: true,
  },
  {
    title: "Contact Person",
    type: "text",
    key: "contact_person",
    sort: true,
  },
  {
    title: "Email",
    type: "text",
    key: "email",
    sort: true,
  },
  {
    title: "Mobile",
    type: "text",
    key: "mobile",
    sort: true,
  },
]);

let propsData = defineProps({
  lists: {
    type: Object,
    default: null,
  },
  flash: {
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
  <Head title="Agency" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'house'"
      title="Agency's List"
      :route="route('agency.index')"
    />

    <section class="content">
      <BreezeFlashMessage />
      <BreezeCard :title="'Agency'">
        <BreezeFilter :camps="camps" :blocks="blocks" />
        <BreezeDataTable
          :route-name="'agency'"
          :modal="false"
          :header="header"
          :data-set="lists"
          :actions="access"
          delete-message="Are you sure you want to delete this item? It will be delete from Agency's camp, block, team & users."
        />
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
