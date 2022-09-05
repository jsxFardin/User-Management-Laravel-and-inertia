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
const form = useForm({
  name: "",
});

const submit = () => {
  form.post(route("setup.construction.store"), {
    onSuccess: () => {
      form.reset();
      toast.success("Construction Created Successfully");
    },
  });
};
</script>

<template>
  <Head title="Create new construction" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb :icon="'screwdriver-wrench'" :title="' New construction '" :route="route('setup.construction.index')" />

    <section class="content">
      <BreezeCard :title="'Construction '">
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
            </div>
          </div>
          <BreezeButton
                class="btn btn-success float-right"
                :disabled="form.processing"
                >SAVE</BreezeButton>
        </form>
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
