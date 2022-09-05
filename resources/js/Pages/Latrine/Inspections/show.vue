<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";

defineProps({
  item: {
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
});
</script>

<template>
  <Head title="Inspection" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'box-open'"
      title="Complaint"
      :route="route('inspection.index')"
    />
    <section class="content">
      <BreezeCard :title="'Inspection'">
        <h5>Inspection Details</h5>
        <hr />
        <div class="row">
          <div class="col">
            <strong>Latrine ID : </strong> {{ item.uid_no }}
          </div>
          <div class="col">
            <strong>Count filled up ring : </strong>
            {{ item.count_filled_up_ring }}
          </div>
          <div class="col">
            <strong>Available height from top : </strong>
            {{ item.available_height_from_top }}
          </div>
          <div class="col"><strong>Remarks : </strong> {{ item.remarks }}</div>
        </div>
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
