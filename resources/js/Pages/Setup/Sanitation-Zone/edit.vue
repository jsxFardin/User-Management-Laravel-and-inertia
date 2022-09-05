<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeSelect from "@/Components/Select.vue";
import Button from "@/Components/Button.vue";
import BreezeButton from "@/Components/Button.vue";
import BreezeTextarea from "@/Components/Textarea.vue";

const propsData = defineProps({
  sanitationZone: Object,
});
const form = useForm(propsData.sanitationZone);

const submit = () => {
  form.put(route("setup.sanitation-zone.update", propsData.sanitationZone), {
    onSuccess: () => toast.success("Sanitation Zone update Successfully"),
  });
};
</script>

<template>
  <Head title="Update Block" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'gear'"
      :title="' Update Sanitation Zone'"
      :route="route('setup.sanitation-zone.index')"
    />

    <section class="content">
      <BreezeCard :title="'Structure'">
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
          {{ status }}
        </div>

        <form @submit.prevent="submit">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <BreezeLabel for="name" value="Name" />
                <BreezeInput
                  id="name"
                  type="text"
                  class="form-control"
                  v-model="form.name"
                  autofocus
                  placeholder="Name"
                  :autocomplete="form.name"
                  :error="form.errors.name"
                />
              </div>
              <div class="mb-3">
                <BreezeLabel for="latitude" value="Latitude" />
                <BreezeInput
                  id="latitude"
                  type="number"
                  class="form-control"
                  v-model="form.latitude"
                  autofocus
                  placeholder="Latitude"
                  :autocomplete="form.latitude"
                  :error="form.errors.latitude"
                  :step="0.0000001"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <BreezeLabel for="longitude" value="Longitude" />
                <BreezeInput
                  id="longitude"
                  type="number"
                  class="form-control"
                  v-model="form.longitude"
                  autofocus
                  placeholder="Longitude"
                  :autocomplete="form.longitude"
                  :error="form.errors.longitude"
                  step="0.0000001"
                />
              </div>
              <div class="mb-3">
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
                <span class="text-danger">{{ form.errors.remarks }}</span>
              </div>
            </div>
          </div>
          <BreezeButton
            class="btn btn-success float-right"
            :disabled="form.processing"
            >Save</BreezeButton
          >
        </form>
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
