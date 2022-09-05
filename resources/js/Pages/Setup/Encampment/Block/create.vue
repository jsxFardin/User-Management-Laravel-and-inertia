<script setup>
import { watch } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import Button from "@/Components/Button.vue";
import { ref } from "@vue/reactivity";
import BreezeButton from "@/Components/Button.vue";

const propsData = defineProps({
  camps: Object,
  blocks: Object,
});
const form = useForm({
  camp_id: "",
  parent_id: "",
  name: "",
  location: "",
  latitude: "",
  longitude: "",
  area: "",
  number_of_family: "",
  number_of_house: "",
  population: "",
  short_name: "",
});

const submit = () => {
  form.post(route("setup.block.store"), {
    onSuccess: () => {
      form.reset();
      toast.success("Block Created Successfully");
    },
  });
};

watch(
  () => [form.camp_id, form.name, form.parent_id],
  (value) => {
    makeShortName();
  },
  { deep: true }
);

const makeShortName = () => {
  let camp = "";
  let block = "";
  if (form.camp_id) {
    camp = propsData.camps.find((camp) => camp.value == form.camp_id);
  }
  if (form.parent_id) {
    block = propsData.blocks.find((block) => block.value == form.parent_id);
  }
  form.short_name = `${camp ? camp.short_name : ""}${camp ? "_" : ""}${
    block ? block.label : ""
  }${form.name}`;
};
</script>

<template>
  <Head title="Create new Block" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'map'"
      :title="' New Block'"
      :route="route('setup.block.index')"
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
                <BreezeLabel for="camp_id" value="Camps" />
                <multi-select
                  v-model="form.camp_id"
                  :options="camps"
                  placeholder="Choose a camp"
                  :searchable="true"
                />
                <span class="text-danger"> {{ form.errors.camp_id }}</span>
              </div>
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
              <div class="mb-3">
                <BreezeLabel for="area" value="Area (Square KM)" />
                <BreezeInput
                  id="area"
                  type="number"
                  class="form-control"
                  v-model="form.area"
                  autofocus
                  placeholder="Area"
                  :autocomplete="form.area"
                  :error="form.errors.area"
                  :step="0.01"
                />
              </div>
              <div class="mb-3">
                <BreezeLabel for="number_of_family" value="Number of family" />
                <BreezeInput
                  id="number_of_family"
                  type="number"
                  class="form-control"
                  v-model="form.number_of_family"
                  autofocus
                  placeholder="Number of family"
                  :autocomplete="form.number_of_family"
                  :error="form.errors.number_of_family"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <BreezeLabel for="parent_id" value="Parent Blocks" />
                <multi-select
                  v-model="form.parent_id"
                  :options="blocks"
                  placeholder="Choose a Parent block"
                  :searchable="true"
                />
                <span class="text-danger"> {{ form.errors.parent_id }}</span>
              </div>
              <div class="mb-3">
                <BreezeLabel for="short_name" value="Short name" />
                <BreezeInput
                  id="short_name"
                  type="text"
                  class="form-control"
                  v-model="form.short_name"
                  autofocus
                  placeholder="Short name"
                  :autocomplete="form.short_name"
                  :error="form.errors.short_name"
                  readonly
                />
              </div>
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
                  :step="0.0000001"
                />
              </div>
              <div class="mb-3">
                <BreezeLabel for="population" value="Population" />
                <BreezeInput
                  id="population"
                  type="number"
                  class="form-control"
                  v-model="form.population"
                  autofocus
                  placeholder="Population"
                  :autocomplete="form.population"
                  :error="form.errors.population"
                />
              </div>
              <div class="mb-3">
                <BreezeLabel for="number_of_house" value="Number of house" />
                <BreezeInput
                  id="number_of_house"
                  type="number"
                  class="form-control"
                  v-model="form.number_of_house"
                  autofocus
                  placeholder="Number of house"
                  :autocomplete="form.number_of_house"
                  :error="form.errors.number_of_house"
                />
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
