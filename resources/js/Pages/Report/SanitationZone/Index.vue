<script setup>
    import { Head } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeDataTable from "@/Components/Table.vue";
    import { reactive, ref, watch } from 'vue'
    import BreezeFilter from "./Filter.vue";
    import { Inertia } from "@inertiajs/inertia";
    
    const header = ref([
        {
            title: "Camp",
            type: "html",
            key: "camp_name",
            modifier: (value, row) => {
                return value
            },
            sort: true, 
        },
        {
            title: "Block",
            type: "html",
            key: "block_name",
            modifier: (value, row) => {
                return value
            },
            sort: true, 
        },
        {
            title: "Zone",
            type: "html",
            key: "name",
            modifier: (value, row) => {
                return value
            },
            sort: true, 
        },
        {
            title: "Total Latrine",
            type: "html",
            key: "total_latrine",
            modifier: (value, row) => {
                return value
            },
            sort: true, 
        },
        {
            title: "Danger",
            type: "html",
            key: "danger",
            modifier: (value, row) => {
                return value
            },
            sort: true, 
        },
        {
            title: "Warning",
            type: "html",
            key: "warning",
            modifier: (value, row) => {
                return value
            },
            sort: true, 
        },
        {
            title: "Last Desludged Date",
            type: "html",
            key: "last_desludge_date",
            modifier: (value, row) => {
                return value
            },
            sort: true, 
        },
        {
            title: "Last Volume Desludged",
            type: "html",
            key: "last_volume_desludged",
            modifier: (value, row) => {
                return value
            },
            sort: true, 
        },
        {
            title: "Next Desludged Date",
            type: "html",
            key: "next_desludge_date",
            modifier: (value, row) => {
                return value
            },
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
    })
</script>
    
<template>
    <Head title="Sanitation Zone Report" />
    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb
            :icon="'person-digging'"
            title="Sanitation Zone Report"
            :route="route('report.sanitation-zone.index')"
        />
    
        <section class="content">
            <BreezeCard :title="'report'">
                <!-- FILTER -->
                <BreezeFilter :camps="camps" :blocks="blocks" :years="years" :months="months"
                    :Zones="sanitationZones" :route="'sanitation-zone'"/>
        
                <div class="row mb-2">
                <div class="col-md-12 text-right">
                    <a
                    :class="'btn btn-success btn-sm'"
                    :href="route('download.sanitationZoneReport')"
                    >
                    <font-awesome-icon :icon="['fas', 'file-excel']" /> Excel
                    </a>
                </div>
                </div>
                <!-- TABLE -->
                <BreezeDataTable
                    :route-name="'report.sanitation-zone'"
                    :modal="false"
                    :header="header"
                    :data-set="lists"
                    :actions="access"
                />
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
    