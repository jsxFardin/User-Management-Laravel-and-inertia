<script setup>
    import { Head } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeDataTable from "@/Components/Table.vue";
    import { ref } from "@vue/reactivity";
    import BreezeFilter from "./Filter.vue";
    
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
            title: "Zone",
            type: "text",
            key: "sanitation_zone_name",
            sort: true,
        },
        {
            title: "Structure",
            type: "text",
            key: "latrine_structure_name",
            sort: true,
        },
        {
            title: "Last Date",
            type: "text",
            key: "last_date",
            sort: true,
        },
        {
            title: "Last Desludged Volume",
            type: "text",
            key: "last_volume_desludged",
            sort: true,
        },
        {
            title: "Next Date",
            type: "text",
            key: "next_date",
            sort: true,
        },
    ])
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
            default: [],
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
    <Head title="Latrine Report" />
    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb
          :icon="'toilet'"
          title="Latrine Report"
          :route="route('report.latrine.index')"
        />
    
        <section class="content">
            <BreezeCard :title="'report'">
                <!-- FILTER -->
                <BreezeFilter
                :facilityTypes="facilityTypes"
                :facilityUseds="facilityUseds"
                :constStatus="constStatus"
                :latStructure="latStructure"
                :camps="camps"
                :blocks="blocks"
                :sanitation-zones="sanitationZones"
                ></BreezeFilter>
        
                <div class="row mb-2">
                    <div class="col-md-12 text-right">
                        <a
                        :class="'btn btn-success btn-sm'"
                        :href="route('download.latrineReport')"
                        >
                        <font-awesome-icon :icon="['fas', 'file-excel']" /> Excel
                        </a>
                    </div>
                </div>

                <!-- TABLE -->
                <BreezeDataTable
                :route-name="'report.latrine'"
                :modal="false"
                :header="header"
                :data-set="lists"
                :actions="access"
                />
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
    