<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { onMounted } from "@vue/runtime-core";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

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
    }
});
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
</script>

<template>
    <Head title="Roles" />
    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'user'" title="Role's List" :route="route('role.index')" />

        <section class="content">
            <BreezeCard :title="'Roles'">
                <BreezeDataTable
                    :route-name="'role'"
                    :modal="false"
                    :header="header"
                    :data-set="lists"
                    :actions="access"
                    :nonDestroyId="[1, 2, 3, 4]"
                />
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
