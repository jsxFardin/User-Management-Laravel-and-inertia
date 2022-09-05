<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import BreezeForm from "./Form.vue"

const propsData = defineProps({
    latrine: Object,
    camps: Object,
    blocks: Object,
    facilityTypes: Object,
    facilityUseds: Object,
    constructionStatus: Object,
    latrineStructure: Object,
    donor: Object,
    pits: Object,
    subBlocks: Object,
    sanitationZones: Object,
});

const form = useForm(propsData.latrine);

const submit = () => {
    form.put(route("latrine.update", propsData.latrine), {
        onSuccess: () => {
            form.reset();
            toast.success("Latrine Created Successfully");
        },
        onError: () => {
            console.log(form.errors);
        },
    });
};
</script>

<template>
  <Head title="Update Latrine" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb :icon="'toilet'" :title="' Update Latrine'" :route="route('latrine.index')"/>

    <section class="content">
        <BreezeCard :title="'Latrine'">
            <form @submit.prevent="submit">
                <BreezeForm
                    :form-data="form"
                    :camps="camps"
                    :blocks="blocks"
                    :facility-types="facilityTypes"
                    :facility-useds="facilityUseds"
                    :construction-status="constructionStatus"
                    :latrine-structure="latrineStructure"
                    :donor="donor"
                    :pits="pits"
                    :subBlocks="subBlocks"
                    :sanitation-zones="sanitationZones"
                />
            </form>
        </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
