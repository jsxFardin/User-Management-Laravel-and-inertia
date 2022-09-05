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

const propsData = defineProps({
    camp: Object,
});
const form = useForm(propsData.camp);

const submit = () => {
    form.put(route("setup.camp.update", propsData.camp), {
        onSuccess: () => toast.success("Camp update Successfully"),
    });
};
</script>

<template>
    <Head title="Update Block" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'gear'" :title="' Update Camp'" :route="route('setup.camp.index')" />

        <section class="content">
            <BreezeCard :title="'Structure'">
                <div
                    v-if="status"
                    class="mb-4 font-medium text-sm text-green-600"
                >
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
                            <div class="mb-3">
                                <BreezeLabel
                                    for="area"
                                    value="Area (Square KM)"
                                />
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
                        </div>
                        <div class="col-md-6">
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
                                />
                            </div>
                            <div class="mb-3">
                                <BreezeLabel
                                    for="longitude"
                                    value="Longitude"
                                />
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
                                <BreezeLabel for="location" value="Location" />
                                <BreezeInput
                                    id="location"
                                    type="text"
                                    class="form-control"
                                    v-model="form.location"
                                    autofocus
                                    placeholder="Location"
                                    :autocomplete="form.location"
                                    :error="form.errors.location"
                                />
                            </div>
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
