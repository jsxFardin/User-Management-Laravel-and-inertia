<script setup>
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import { ref } from "@vue/reactivity";
    import BreezeForm from "./Form.vue"

    defineProps({
        camps: Object,
        blocks: Object,
        facilityTypes: Object,
        facilityUseds: Object,
        constructionStatus: Object,
        latrineStructure: Object,
        donor: Object,
        pits: Object,
        sanitationZones: Object,
    });
    const form = useForm({
        camp_id: "",
        block_id: "",
        facility_type_id: "",
        facility_used_id: "",
        construction_status_id: "",
        latrine_structure_id: "",
        sanitation_zone_id: "",
        pit_type_id: "",
        pwsn: "",
        constructor_id: "",
        chamber_door: "",
        male_number_stickers: "",
        male_number_user: "",
        female_number_stickers: "",
        female_number_user: "",
        children_number: "",
        common_shared: "",
        functional: "",
        non_functional: "",
        min_or_repair: false,
        pwsn_hand_rail_outside: false,
        pwsn_hand_rail_inside: false,
        pwsn_ramp: false,
        pwsn_stair: false,
        pwsn_high_commode: false,
        hwd: false,
        hwd_water: false,
        hwd_soap: false,
        latitude: "",
        longitude: "",
        total_chamber: "",
        total_ring_number: "",
        dia_of_ring: "",
        septic_tank_dimension: "",
        total_volume: "",
        remarks: "",
        sub_block_id: '',
        camp_sn: '',
        block_sn: '',
        subBlock_sn: '',
    });

    const submit = () => {
        form.post(route("latrine.store"), {
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
  <Head title="Create new Latrine" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'toilet'" :title="' New Latrine'" :route="route('latrine.index')"/>

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
                        :sanitation-zones="sanitationZones"
                    />
                </form>
            </BreezeCard>
        </section>
  </BreezeAuthenticatedLayout>
</template>
