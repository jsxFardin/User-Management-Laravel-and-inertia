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
    facility: Object,
    parent: Object,
});
const form = useForm(propsData.facility);

const submit = () => {
    form.put(route("setup.facility.update", propsData.facility), {
        onSuccess: () => toast.success("Facility update Successfully"),
    });
};
</script>

<template>
    <Head title="Create new Facility" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'gear'" :title="' New Facility'" :route="route('setup.facility.index')" />

        <section class="content">
            <BreezeCard :title="'Facility'">
                <div
                    v-if="status"
                    class="mb-4 font-medium text-sm text-green-600"
                >
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <BreezeLabel for="name" value="Parent" />
                                <BreezeSelect
                                    id="name"
                                    class="form-control"
                                    v-model="form.parent_id"
                                    :options="parent"
                                />
                            </div>
                        </div>
                        <div class="col">
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
                        >Update</BreezeButton>
                </form>
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
