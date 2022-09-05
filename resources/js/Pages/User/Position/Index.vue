<script setup>
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeDataTable from "@/Components/Table.vue";
    import { ref } from "@vue/reactivity";
    import { Head } from "@inertiajs/inertia-vue3";

    const header = ref([
        {
            title: "Id",
            type: "text",
            key: "id"
        },
        {
            title: "Name",
            type: "text",
            key: "name",
            sort: true,
        },
    ]);

    defineProps({
        list: {
            type: Array,
            default: [],
        },
        access: {
            type: Array,
            default: []
        },
    });
</script>

<template>
    <Head title="Position List" />
    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'street-view'" title="Position List" :route="route('position.index')"/>

        <section class="content">
        <BreezeCard :title="'Position  List'">
            <BreezeDataTable
            :route-name="'position'"
            :modal="false"
            :header="header"
            :data-set="list"
            :actions="access"
            />
        </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
