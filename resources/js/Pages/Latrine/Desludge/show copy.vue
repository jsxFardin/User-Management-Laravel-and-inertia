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
  <Head title="Desludge" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'box-open'"
      title="Desludge"
      :route="route('desludge.index')"
    />
    <section class="content">
      <BreezeCard :title="'Desludge'">
        <h5>Desludge Details</h5>
        <hr />
        <div class="row mt-3">
          <div class="col">
            <strong>Latrine ID : </strong> {{ item.uid_no }}
          </div>
          <div class="col">
            <strong>Collection Date : </strong> {{ item.collection_date }}
          </div>
          <div class="col">
            <strong>Count Desludge Ring : </strong>
            {{ item.count_desludge_ring }}
          </div>
          <div class="col">
            <strong>Desludged Height From Top : </strong>
            {{ item.desludged_height_from_top }}
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <strong>Total Volume Desludged : </strong>
            {{ item.total_volume_desludged }}
          </div>
          <div class="col">
            <strong>See Foreign Materials : </strong>
            {{ item.see_foreign_materials }}
          </div>
          <div class="col">
            <strong>Sludge Transferred to : </strong>
            {{ item.sludge_transferred_to }}
          </div>
          <div class="col">
            <strong>Litre of petrol : </strong>
            {{ item.litre_of_petrol }}
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <strong>Man/Woman Days Used : </strong>
            {{ item.man_woman_days_used }}
          </div>
          <div class="col">
            <strong>latitude : </strong>
            {{ item.latitude }}
          </div>
          <div class="col">
            <strong>longitude : </strong>
            {{ item.longitude }}
          </div>
          <div class="col"><strong>Remarks : </strong> {{ item.remarks }}</div>
        </div>
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
