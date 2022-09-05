<script setup>

    import BreezeLabel from "@/Components/Label.vue";
    import BreezeInput from "@/Components/Input.vue";
    import BreezeButton from "@/Components/Button.vue";
    import { Inertia } from "@inertiajs/inertia";
    import { reactive } from "@vue/reactivity";
    import { Link } from "@inertiajs/inertia-vue3";

    let propsData = defineProps({
        camps: Object,
        blocks: Object,
        years: Object,
        months: Object,
        Zones: Object,
        route: String
    })
    let filterForm = reactive({
        page: route().params.page ?? 1,
        sort: route().params.sort ?? 'desc',
        name: route().params.name ?? 'id',
        max_count: route().params.max_count ?? 10,

        sanitationZones: route().params.sanitationZones ?? [],
        block: route().params.block ?? [],
        camp: route().params.camp ?? [],
        year: route().params.year ?? [],
        month: route().params.month ?? [],
        toDate: route().params.toDate ?? "",
        fromDate: route().params.fromDate ?? "",
    })
    let data = reactive({
        campBlocks: propsData.blocks,
        isExpanded: false
    })
    const getBlock = (event) => {
        if (event != null) {
            filterForm.block = [];
            data.campBlocks = propsData.blocks.filter((item) => event == item.camp_id);
        }
    }

    const filterTable = () => {
        Inertia.get(propsData.route, filterForm, {
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

                        <div class="col-md-3">
                            <BreezeLabel for="year" value="Year" />
                            <multi-select
                                v-model="filterForm.year"
                                :options="propsData.years"
                                :placeholder="`Choose a year`"
                                :searchable="true"
                                :close-on-select="false"
                                mode="tags"
                            />
                        </div>
                        <div class="col-md-3">
                            <BreezeLabel for="month" value="Month" />
                            <multi-select
                                v-model="filterForm.month"
                                :options="propsData.months"
                                :placeholder="`Choose a Month`"
                                :searchable="true"
                                :close-on-select="false"
                                mode="tags"
                            />
                        </div>
                        <div class="col-md-3">
                            <BreezeLabel for="camp" value="Camp" />
                            <multi-select
                                v-model="filterForm.camp"
                                @change="getBlock($event), $emit('onChangeData')"
                                :options="camps"
                                :placeholder="`Choose a camp`"
                                :searchable="true"
                                mode="tags"
                                :close-on-select="false"
                            />
                        </div>
                        <div class="col-md-3">
                            <BreezeLabel for="block" value="Block" />
                            <multi-select
                                v-model="filterForm.block"
                                :options="data.campBlocks"
                                :placeholder="`Choose a block`"
                                :searchable="true"
                                mode="tags"
                                :close-on-select="false"
                            />
                        </div>
                        <div class="col-md-3">
                            <BreezeLabel for="sanitationZones" value="Sanitation Zone" />
                            <multi-select
                                v-model="filterForm.sanitationZones"
                                :options="propsData.Zones"
                                :placeholder="`Choose a Sanitation Zone`"
                                :searchable="true"
                                mode="tags"
                                :close-on-select="false"
                            />
                        </div>

                        <div class="col-md-3">
                            <BreezeLabel for="fromDate" value="From Date" />
                            <input v-model="filterForm.fromDate" :class="'form-control'" type="date" />
                        </div>
                        <div class="col-md-3">
                            <BreezeLabel for="toDate" value="To Date" />
                            <input v-model="filterForm.toDate" :class="'form-control'" type="date" />
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <Link
                        type="button"
                        class="btn btn-warning btn-sm float-left"
                        :href="'sanitation-zone'"
                    >
                        <span class="mr-1"
                        ><font-awesome-icon :icon="['fas', 'eraser']"
                        /></span>
                        RESET FILTER
                    </Link>
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
