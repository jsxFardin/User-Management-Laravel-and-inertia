<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import { reactive } from "@vue/reactivity";
import { useForm } from '@inertiajs/inertia-vue3';
import BreezeButton from "@/Components/Button.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { ref } from "@vue/reactivity";

const propsData = defineProps({
  message: {
    type: String,
    default: null,
  },
  access: {
    type: Array,
    default: [],
  },
  camp: Object,
  blocks: Object,
  agencies: Object,
});

console.log(propsData.agencies, "agencies");

// const blockHeader = ref([
//     {
//         title: "#",
//         type: "text",
//         key: "block_id",
//     },
//     {
//         title: "Block Name",
//         type: "text",
//         key: "block_name",
//     },
//     {
//         title: "Short Name",
//         type: "text",
//         key: "short_name",
//     },
//     {
//         title: "Longitude",
//         type: "text",
//         key: "block_longitude",
//     },
//     {
//         title: "Latitude",
//         type: "text",
//         key: "block_latitude",
//     },
//     {
//         title: "Area",
//         type: "text",
//         key: "block_area",
//     },
//     {
//         title: "Number of Family",
//         type: "text",
//         key: "number_of_family",
//     },
//     {
//         title: "Number of House",
//         type: "text",
//         key: "number_of_house",
//     },    
//     {
//         title: "Population",
//         type: "text",
//         key: "population",
//     },
//     {
//         title: "Status",
//         type: "text",
//         key: "block_status",
//     },
// ]);
</script>

<template>
    <Head title="Camp Info" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb
        :icon="'box-open'"
        title="Camp Info"
        :route="route('setup.camp.index')"
        />
        <section class="content">
        <BreezeCard :title="'Camp'">

            <div class="row">
                <div class="col-md-3">
                    <!-- Agency Details Box -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Camp Details</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <strong>Camp Name </strong>
                            <p class="text-muted">{{ camp.name }}</p>
                            <hr>
                            <strong>Camp Short Name</strong>
                            <p class="text-muted">{{ camp.short_name }}</p>
                            <hr>
                            <strong>Location</strong>
                            <p class="text-muted">{{ camp.location }}</p>
                            <hr>
                            <strong>Longitude</strong>
                            <p class="text-muted">{{ camp.longitude }}</p>
                            <hr>
                            <strong>Latitude</strong>
                            <p class="text-muted">{{ camp.latitude }}</p>
                            <hr>
                            <strong>Area</strong>
                            <p class="text-muted">{{ camp.area }}</p>
                            <hr>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
                
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Block List</h3>
                            <a class="btn btn-info btn-sm float-right" :href="route('setup.block.create')"><font-awesome-icon :icon="['fas', 'plus']" /> Create</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-header">
                                    <tr>
                                        <th><span>Block Name</span></th>
                                        <th><span>Short Name</span></th>
                                        <th><span>Longitude</span></th>
                                        <th><span>Latitude</span></th>
                                        <th><span>Area</span></th>
                                        <th><span>Number of Family</span></th>
                                        <th><span>Number of House</span></th>
                                        <th><span>Population</span></th>
                                        <th><span>Status</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="block in propsData.blocks" :key="block.block_id">
                                        <td>{{ block.block_name }}</td>
                                        <td>{{ block.short_name }}</td>
                                        <td>{{ block.block_longitude }}</td>
                                        <td>{{ block.block_latitude }}</td>
                                        <td>{{ block.block_area }}</td>
                                        <td>{{ block.number_of_family }}</td>
                                        <td>{{ block.number_of_house }}</td>
                                        <td>{{ block.population }}</td>
                                        <td>{{ block.block_status == 1 ? 'Active' : 'Inactive' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- <BreezeDataTable
                            :route-name="'setup.camp.show'"
                            :modal="false"
                            :header="blockHeader"
                            :data-set="blocks"
                            :show-action="false"
                            :showCreateButton="false"
                            /> -->
                    </div>

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Agency List</h3>
                        </div>

                        <div>
                            <ul class="list-group">
                                <li v-for="(item, name) in agencies" :key="name" class="list-group-item"> {{ item }}</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>