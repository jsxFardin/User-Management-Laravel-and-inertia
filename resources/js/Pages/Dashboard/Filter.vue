<script setup>
    import BreezeLabel from "@/Components/Label.vue";
    import BreezeInput from "@/Components/Input.vue";
    import BreezeButton from "@/Components/Button.vue";
    import { Inertia } from "@inertiajs/inertia";
    import { reactive } from "@vue/reactivity";
    import BreezeDataTableFilter from "@/Components/TableFilter.vue";

    let propsData = defineProps({
        camps: Object,
        blocks: Object,
        years: Object,
        months: Object,
        sanitationZones: Object,
        filterForm: Object,

        resetLink: String,
        showResetBtn: Boolean,
        showSearch: Boolean,
        showSearchBtn: Boolean,
        showFooter: Boolean,
    });

    let data = reactive({
        campBlocks: propsData.blocks,
    })
    const getBlock = (event) => {
        if (event != null) {
            propsData.filterForm.block = [];
            data.campBlocks = propsData.blocks.filter((item) => event == item.camp_id);
        }
    }

</script>

<template>
    <BreezeDataTableFilter
        :show-search="showSearch"
        :show-search-btn="showSearchBtn"
        :show-footer="showFooter"
        :show-reset-btn="showResetBtn"
        :reset-link="resetLink"
    >
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
                :options="propsData.sanitationZones"
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

    </BreezeDataTableFilter>
</template>
