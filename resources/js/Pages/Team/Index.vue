<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import BreezeFlashMessage from "@/Components/FlashMessage.vue";
import BreezeFilter from "@/Pages/Team/Filter.vue";

const header = ref([
    {
        title: "#",
        type: "text",
        key: "id",
    },
    {
        title: "Team Name",
        type: "text",
        key: "team_name",
        sort: true,
        sortBy: "teams.team_name",
    },
    {
        title: "Agency Name",
        type: "text",
        key: "agency_name",
        sort: true,
        sortBy: "agencies.agency_name",
    },
    {
        title: "email",
        type: "text",
        key: "email",
        sort: true,
        sortBy: "teams.email",
    },
    {
        title: "Contact Person",
        type: "text",
        key: "contact_person",
        sort: true,
        sortBy: "teams.contact_person",
    },
    {
        title: "Mobile",
        type: "text",
        key: "mobile",
        sort: true,
        sortBy: 'teams.mobile'
    },
]);

defineProps({
    lists: {
        type: Object,
        default: null,
    },
    flash: {
        type: String,
        default: null,
    },
    access: {
        type: Array,
        default: []
    },
    camps: Object,
    blocks: Object,
    agencies: Object,
});
</script>

<template>
    <Head title="Team" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'people-group'" title="Team's List" :route="route('team.index')" />

        <section class="content">
            <BreezeFlashMessage />
            <BreezeFilter :camps="camps" :blocks="blocks" :agencies="agencies" />
            <BreezeCard :title="'Team'">
                <BreezeDataTable
                :route-name="'team'"
                :modal="false"
                :header="header"
                :data-set="lists"
                :actions="access"
                delete-message="Are you sure you want to delete this item? It will be delete from Team's camp, block & users."
                />
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
