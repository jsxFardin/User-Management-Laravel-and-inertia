<script setup>

    import { Head } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeDataTable from "@/Components/Table.vue";
    import { ref } from "@vue/reactivity";
    import BreezeFilter from "./Filter.vue"

    const header = ref([
        {
            title: "Latrine ID",
            type: "text",
            key: "uid_no",
            sort: true, //FOR SORTING
        },
        {
            title: "Camp",
            type: "text",
            key: "camp_name",
            sort: true,
        },
        {
            title: "Block",
            type: "text",
            key: "block_name",
            sort: true,
        },
        {
            title: "Sub Block",
            type: "text",
            key: "sub_block_name",
            sort: true,
        },
        {
            title: "Facility Type",
            type: "text",
            key: "facility_type_name",
            sort: true,
        },
        {
            title: "Facility Used",
            type: "text",
            key: "facility_used_name",
            sort: true,
        },
        {
            title: "Construction Status",
            type: "text",
            key: "construction_status_name",
            sort: true,
        },
        {
            title: "Latrine Structure",
            type: "text",
            key: "latrine_structure_name",
            sort: true,
        },
        {
            title: "Sanitation Zone",
            type: "text",
            key: "sanitation_zone_name",
            sort: true,
        }
    ]);
    defineProps({
        lists: {
            type: Array,
            default: [],
        },
        message: {
            type: String,
            default: null,
        },
        access: {
            type: Array,
            default: []
        },
        facilityTypes: Object,
        facilityUseds: Object,
        constStatus: Object,
        latStructure: Object,
        camps: Object,
        blocks: Object,
        sanitationZones: Object,
    })

</script>

<template>
    <Head title="Latrines List" />
    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'toilet'" title="Latrines List" :route="route('latrine.index') "/>

        <section class="content">
            <BreezeCard :title="'Latrine'">
                <!-- FILTER -->
                <BreezeFilter :facilityTypes="facilityTypes" :facilityUseds="facilityUseds"
                    :constStatus="constStatus" :latStructure="latStructure" :camps="camps"
                    :blocks="blocks" :sanitation-zones="sanitationZones"></BreezeFilter>

                <BreezeDataTable
                    :route-name="'latrine'"
                    :modal="false"
                    :header="header"
                    :data-set="lists"
                    :actions="access"
                />
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
