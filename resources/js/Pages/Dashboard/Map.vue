<script setup>
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import Breadcrumb from "@/Components/Breadcrumb.vue";
    import Map from "@/Components/Map.vue";

    defineProps({
        zones: {
            type: Array,
            default: []
        },
        latrines: {
            type: Array,
            default: []
        }
    })
</script>

<template>
    <Head title="Map" />

    <BreezeAuthenticatedLayout>
        <Breadcrumb :icon="'border-all'" :title="'Map'" />

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="position: relative;">
                        <Map :zones="zones" :latrines="latrines" />
                    </div>
                </div>
            </div>
        </section>
    </BreezeAuthenticatedLayout>
</template>
