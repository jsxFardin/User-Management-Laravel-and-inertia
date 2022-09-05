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

const propsData = defineProps({
  latrines: Object,
  data: Object,
});

const form = useForm(propsData.data);

const submit = () => {
  // console.log(data);
  form.put(route("complaint.update", propsData.data), {
    onSuccess: () => toast.success("Complaint update Successfully"),
  });
  //  form.put(route("complaint.update", propsData.complaint), {
  //       onSuccess: () => {
  //           form.reset();
  //           toast.success("Latrine Created Successfully");
  //       },
  //       onError: () => {
  //           console.log(form.errors);
  //       },
  //   });
};
</script>

<template>
  <Head title="Update  Complaint" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'screwdriver-wrench'"
      :title="' Update Complaint'"
      :route="route('complaint.index')"
    />

    <section class="content">
      <BreezeCard :title="'Complaint'">
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
                <BreezeLabel for="name" value="Complaint" />
                <BreezeInput
                  id="name"
                  type="text"
                  class="form-control"
                  v-model="form.name"
                  autofocus
                  placeholder="Complaint"
                  :autocomplete="form.name"
                  :error="form.errors.name"
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
            >Update</BreezeButton>
        </form>
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
