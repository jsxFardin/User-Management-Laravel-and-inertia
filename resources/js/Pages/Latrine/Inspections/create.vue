<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeSelect from "@/Components/Select.vue";
import Button from "@/Components/Button.vue";
import BreezeTextarea from "@/Components/Textarea.vue";
import BreezeButton from "@/Components/Button.vue";

const props = defineProps({
  latrines: Object,
});

const form = useForm({
  latrine_id: "",
  count_filled_up_ring: "",
  available_height_from_top: "",
  remarks: "",
});

const submit = () => {
  form.post(route("inspection.store"), {
    onSuccess: () => {
      form.reset();
      toast.success("Inspection Created Successfully");
    },
  });
};
</script>

<template>
  <Head title="Create new inspection" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'screwdriver-wrench'"
      :title="' New Inspection '"
      :route="route('inspection.index')"
    />

    <section class="content">
      <BreezeCard :title="'Inspection '">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
          {{ status }}
        </div>

        <form @submit.prevent="submit">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <BreezeLabel for="latrine_id" value="Latrine" />
                <multi-select
                  v-model="form.latrine_id"
                  :options="latrines"
                  :searchable="true"
                  placeholder="Choose a latrine"
                />
                <span class="text-danger"> {{ form.errors.latrine_id }}</span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <BreezeLabel
                  for="count_filled_up_ring"
                  value="Filled Up Ring"
                />
                <BreezeInput
                  id="count_filled_up_ring"
                  type="number"
                  class="form-control"
                  v-model="form.count_filled_up_ring"
                  autofocus
                  placeholder="Filled Up Ring"
                  :autocomplete="form.count_filled_up_ring"
                  :error="form.errors.count_filled_up_ring"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <BreezeLabel
                  for="available_height_from_top"
                  value="Height From Top"
                />
                <BreezeInput
                  id="available_height_from_top"
                  type="number"
                  class="form-control"
                  v-model="form.available_height_from_top"
                  autofocus
                  placeholder="Height From Top"
                  :autocomplete="form.available_height_from_top"
                  :error="form.errors.available_height_from_top"
                />
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <BreezeLabel for="remarks" value="Remarks" />
              <BreezeTextarea
                id="remarks"
                type="text"
                class="form-control"
                v-model="form.remarks"
                autofocus
                placeholder="Remarks"
                :autocomplete="form.remarks"
                :error="form.errors.remarks"
              />
            </div>
          </div>
          <BreezeButton
            class="btn btn-success float-right"
            :disabled="form.processing"
            >Save</BreezeButton>
        </form>
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
