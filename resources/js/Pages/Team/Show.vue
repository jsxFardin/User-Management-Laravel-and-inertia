<script setup>
    import { Head, Link } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeDataTable from "@/Components/Table.vue";
    import { ref } from "@vue/reactivity";
    import AssignCampBlocks from "@/Components/AssignCampBlocks.vue";

    defineProps({
        team:Object,
        users: Object,
        camps: Object,
        blocks: Object,
    })

   const userHeader = ref([
        {
            title: "Id No",
            type: "text",
            key: "id_no",
        },
        {
            title: "Name",
            type: "text",
            key: "name",
        },
        {
            title: "Email",
            type: "text",
            key: "email",
        },
        {
            title: "Phone",
            type: "text",
            key: "mobile",
        },
    ]);

</script>

<template>
    <Head title="Team Details" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'house'" :title="'Team Details'" :route="route('team.index')" />

        <section class="content">
            <div class="row">
                <div class="col-md-3">

                    <!-- Team Details Box -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Team Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><font-awesome-icon :icon="['fas', 'building']"></font-awesome-icon> Agency Name </strong>
                            <p class="text-muted"> {{ team.agency_name??'' }} </p>
                            <hr>

                            <strong><font-awesome-icon :icon="['fas', 'people-group']"></font-awesome-icon> Team Name</strong>
                            <p class="text-muted">{{ team.team_name??'' }}</p>
                            <hr>

                            <strong><font-awesome-icon :icon="['fas', 'user']"></font-awesome-icon> Contact Person Name </strong>
                            <p class="text-muted"> {{ team.contact_person??'' }} </p>
                            <hr>

                            <strong><font-awesome-icon :icon="['fas', 'envelope']"></font-awesome-icon> Email</strong>
                            <p class="text-muted">{{ team.email??'' }}</p>
                            <hr>

                            <strong><font-awesome-icon :icon="['fas', 'mobile']"></font-awesome-icon> Mobile</strong>
                            <p class="text-muted">{{ team.mobile??'' }}</p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-bold">User's List</h3>
                            <Link
                                :class="'btn btn-info btn-sm float-right'"
                                :href="route(`user.create`, {team: team.id, agency: team.agency_id })"
                            >
                                <font-awesome-icon :icon="['fas', 'plus']" /> Create
                            </Link>
                        </div>
                        
                        <BreezeDataTable
                            :route-name="''"
                            :modal="false"
                            :header="userHeader"
                            :data-set="team.user"
                            :show-action="false"
                            :showCreateButton="false"
                            />
                    </div>

                    <assign-camp-blocks :assigns="team.campBlock" />
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

        </section>

    </BreezeAuthenticatedLayout>
</template>
