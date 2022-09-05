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
  <Head title="Complaint" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'box-open'"
      title="Complaint"
      :route="route('complaint.index')"
    />
    <section class="content">
      <BreezeCard :title="'Complaint'">
        <h5>Complaint Details</h5>
        <hr />
        <div class="row">
          <div class="col">
            <strong>Latrine ID : </strong> {{ item.uid_no }}
          </div>
          <div class="col">
            <strong>Complaint : </strong> {{ item.complaint }}
          </div>
          <div class="col"><strong>Status : </strong> {{ item.status }}</div>
          <div class="col"><strong>Remarks : </strong> {{ item.remarks }}</div>
        </div>
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
