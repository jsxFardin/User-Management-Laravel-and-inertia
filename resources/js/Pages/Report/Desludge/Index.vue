<script setup>
    import { Head } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeDataTable from "@/Components/Table.vue";
    import { ref } from "@vue/reactivity";
    import BreezeFilter from "./../SanitationZone/Filter.vue";
    
    const header = ref([
        {
            title: "Latrine",
            type: "text",
            key: "uid_no",
            sort: true, 
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
            title: "Zone",
            type: "text",
            key: "sanitation_zone_name",
            sort: true, 
        },
        {
            title: "Date",
            type: "text",
            key: "date",
        },
        {
            title: "Time",
            type: "text",
            key: "time",
        },
        {
            title: "User Name",
            type: "text",
            key: "desludge_user_name",
            sort: true, 
        },
        {
            title: "Height From Top",
            type: "text",
            key: "desludged_height_from_top",
            sort: true, 
        },
        {
            title: "Total Volume",
            type: "text",
            key: "total_volume_desludged",
            sort: true, 
        },
        {
            title: "Petrol(l)",
            type: "text",
            key: "litre_of_petrol",
            sort: true, 
        },
        {
            title: "Count Ring",
            type: "text",
            key: "count_desludge_ring",
            sort: true, 
        },
        {
            title: "Dia Of Ring",
            type: "text",
            key: "dia_of_ring",
            sort: true, 
        },
        {
            title: "Ring Left Behind",
            type: "text",
            key: "ring_left_behind",
            sort: true, 
        },
        {
            title: "Dim. Of Septic Tank",
            type: "text",
            key: "dimension_of_septic_tank",
            sort: true, 
        },
        {
            title: "Septic Tank ID TS Num.",
            type: "text",
            key: "septic_tank_id_ts_number",
            sort: true, 
        },
        {
            title: "M/W Days Used",
            type: "text",
            key: "man_woman_days_used",
            sort: true, 
        },
        
    ])
    defineProps({
        lists: {
            type: Array,
            default: [],
        },
        access: {
            type: Array,
            default: [],
        },
        camps: {
            type: Array,
            default: [],
        },
        blocks: {
                type: Array,
                default: [],
        },
        sanitationZones: {
                type: Array,
                default: [],
        },
        years: {
                type: Array,
                default: [],
        },
        months: {
            type: Array,
            default: [],
        },
    });
</script>
    
<template>
    <Head title="Desludge Report" />
    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb
            :icon="'person-digging'"
            title="Desludge Report"
            :route="route('report.desludge.index')"
        />
    
        <section class="content">
            <BreezeCard :title="'report'">
                <!-- FILTER -->
                <BreezeFilter :camps="camps" :blocks="blocks" :years="years" :months="months"
                    :Zones="sanitationZones" :route="'desludge'"/>
        
                <div class="row mb-2">
                <div class="col-md-12 text-right">
                    <a
                    :class="'btn btn-success btn-sm'"
                    :href="route('download.desludgeReport')"
                    >
                    <font-awesome-icon :icon="['fas', 'file-excel']" /> Excel
                    </a>
                </div>
                </div>
                <!-- TABLE -->
                <BreezeDataTable
                    :route-name="'report.desludge'"
                    :modal="false"
                    :header="header"
                    :data-set="lists"
                    :actions="access"
                />
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
    