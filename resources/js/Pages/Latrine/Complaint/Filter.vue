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
    });

    let data = reactive({
        campBlocks: propsData.blocks,
    });

    let filterForm = reactive({
        page: route().params.page ?? 1,
        sort: route().params.sort ?? 'desc',
        name: route().params.name ?? 'id',
        max_count: route().params.max_count ?? 10,

        search: route().params.search ?? "",
        camp: route().params.camp ?? "",
        block: route().params.block ?? "",
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
            axios.get(`latrine/create`, params)
                .then((response)=>{
                    data.campBlocks = response.data
                })
                .catch((error)=>{
                    toast.warning(error)
                })
        }
    }
    const filterTable = (search) => {
        filterForm.search = search;
        Inertia.get(`complaint`, filterForm, {
            preserveState: true,
        });
    }

</script>

<template>

    <BreezeDataTableFilter @filterTable="filterTable" :label="'Search UID No.'" :placeholder="'Enter UID No.'">
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
    </BreezeDataTableFilter>
</template>