<script setup>

    import BreezeLabel from "@/Components/Label.vue";
    import BreezeInput from "@/Components/Input.vue";
    import BreezeButton from "@/Components/Button.vue";
    import { Inertia } from "@inertiajs/inertia";
    import { reactive } from "@vue/reactivity";

    let propsData = defineProps({
        facilityTypes: Object,
        facilityUseds: Object,
        constStatus: Object,
        latStructure: Object,
        camps: Object,
        blocks: Object,
        sanitationZones: Object,
    })
    let data = reactive({
        campBlocks: propsData.blocks,
        isExpanded: false
    })

    let filterForm = reactive({
        page: route().params.page ?? 1,
        sort: route().params.sort ?? 'desc',
        name: route().params.name ?? 'id',
        max_count: route().params.max_count ?? 10,

        uid_no: route().params.uid_no ?? '',
        camp: route().params.camp ?? '',
        block: route().params.block ?? '',
        facility_type: route().params.facility_type ?? '',
        facility_used: route().params.facility_used ?? '',
        construction_status: route().params.construction_status ?? '',
        latrine_structure: route().params.latrine_structure ?? '',
        sanitation_zone: route().params.sanitation_zone ?? '',
    })

    const getBlock = (event) => {
        if (event != null) {
            filterForm.block = ''
            data.campBlocks = propsData.blocks.filter((item) => event == item.camp_id)
        }
        if (event != null && data.campBlocks.length == 0) {
            const params = {
                params: {
                    'camp_id': event,
                }
            }
            filterForm.block = ''
            axios.get(`ajax/block-details`, params)
                .then((response)=>{
                    data.campBlocks = response.data
                })
                .catch((error)=>{
                    toast.warning(error)
                })
        }
    }
    const filterTable = () => {
        Inertia.get(`latrine`, filterForm, {
            preserveState: true,
        });
    }

    const collapse = () => {
        data.isExpanded = !data.isExpanded
    }

</script>

<template>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card card-primary card-outline collapsed-card">
                <div class="card-header">
                    <h3 class="card-title text-bold">
                        <span class="mr-1"><font-awesome-icon :icon="['fas', 'arrow-down-wide-short']" /></span>
                        Filter Data
                    </h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" @click="collapse"
                        data-card-widget="collapse" title="Collapse">
                        <font-awesome-icon :icon="['fas', data.isExpanded ? 'minus' : 'plus']" />
                    </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4">
                            <BreezeLabel for="uid_no" value="Latrine ID" />
                            <BreezeInput type="text" class="form-control" :searchable="true"
                                v-model="filterForm.uid_no" placeholder="Enter Latrine ID" />
                        </div>
                        <div class="col-md-4">
                            <BreezeLabel for="camp" value="Camp" />
                                <multi-select v-model="filterForm.camp" @change="getBlock($event)"
                                :options="camps" :placeholder="`Choose a camp`" :searchable="true"/>
                        </div>
                        <div class="col-md-4">
                            <BreezeLabel for="block" value="Block" />
                                <multi-select v-model="filterForm.block" :searchable="true"
                                :options="data.campBlocks" :placeholder="`Choose a block`"/>
                        </div>
                        <div class="col-md-4">
                            <BreezeLabel for="facility_type" value="Facility Type" />
                                <multi-select v-model="filterForm.facility_type" :searchable="true"
                                :options="facilityTypes" :placeholder="`Choose a facility type`"/>
                        </div>
                        <div class="col-md-4">
                            <BreezeLabel for="facility_used" value="Facility Used" />
                                <multi-select v-model="filterForm.facility_used" :searchable="true"
                                :options="facilityUseds" :placeholder="`Choose a facility used`"/>
                        </div>
                        <div class="col-md-4">
                            <BreezeLabel for="construction_status" value="Construction Status" />
                                <multi-select v-model="filterForm.construction_status" :searchable="true"
                                :options="constStatus" :placeholder="`Choose a construction status`"/>
                        </div>
                        <div class="col-md-4">
                            <BreezeLabel for="latrine_structure" value="Latrine Structure" />
                                <multi-select v-model="filterForm.latrine_structure" :searchable="true"
                                :options="latStructure" :placeholder="`Choose a latrine structure`"/>
                        </div>
                        <div class="col-md-4">
                            <BreezeLabel for="sanitation_zone" value="Sanitation Zone" />
                                <multi-select v-model="filterForm.sanitation_zone" :searchable="true"
                                :options="sanitationZones" :placeholder="`Choose a Sanitation Zone`"/>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <BreezeButton type="button" class="btn btn-danger btn-sm float-right" @click="filterTable" >
                        <span class="mr-1"><font-awesome-icon :icon="['fas', 'magnifying-glass']" /></span>
                        SEARCH
                    </BreezeButton>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>
