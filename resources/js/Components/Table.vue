<script setup>

    import { Link } from "@inertiajs/inertia-vue3";
    import BreezeButton from "@/Components/Button.vue";
    import BreezeSwitch from "@/Components/Switch.vue";
    import { Inertia } from "@inertiajs/inertia";
    import { reactive, watch, computed } from 'vue'
    import CustomPagination from "@/Components/CustomPagination.vue";

    const pageSize = [10, 25, 50, 100];
    const exception = reactive({
        route: ['role', 'user'],
        id: propsData.nonDestroyId ?? []
    })
    let initialData = reactive({
        currentPage: 0,
        lastPage: 1,
        totalRow: 0,
        limit: 0,
        dataList: [],
    })
    let queryParams = reactive({
        page: null,
        max_count: 10,
        sort: 'desc',
        name: 'id'
    })
    const propsData = defineProps({
        nonDestroyId: {
            type: Array,
            required: false
        },
        routeName: {
            type: String,
            required: true,
        },
        showCreateButton: {
            type: Boolean,
            default: true
        },
        modal: {
            type: Boolean,
            required: true,
            default: false,
        },
        header: {
            type: Object,
            required: true,
            default: [
                {
                    title: "Id",
                    type: "text",
                    key: "id",
                },
                {
                    title: "Name",
                    type: "text",
                    key: "name",
                },
            ],
        },
        showAction: {
            type: Boolean,
            required: true,
            default: true,
        },
        actions: {
            type: Array,
            required: false,
            default: ["show", "edit", "destroy"],
        },
        dataSet: {
            type: Object,
            required: true,
            default: null,
        },
        deleteMessage: {
            type: String,
            required: true,
            default: "Are you sure you want to delete this item?",
        },
    })
    const destroy = (id) => {
        if (confirm(propsData.deleteMessage)) {
            Inertia.delete(route(`${propsData.routeName}.destroy`, id), {
                preserveScroll: true,
                onSuccess: (res) => {
                    if (res.props.flash && res.props.flash.message != null) {
                        toast.warning(res.props.flash.message);
                    } else {
                        toast.error(`${propsData.routeName} delete successfully!`);
                    }
                },
            });
        }
    }

    watch(() => propsData.dataSet, (value) => {
        if (value.data !== undefined) {
            initialData.dataList = value.data;
            initialData.currentPage = value.current_page
            initialData.lastPage = value.last_page
            initialData.totalRow = value.total;
            initialData.limit = value.per_page;
        } else{
            initialData.dataList = value;
        }
    }, {immediate:true})

    // FOR CHANGE LIMIT
    const limitChange = (event) => {
        // queryParams = Object.assign(route().params, queryParams)
        queryParams = {...queryParams, ...route().params}

        queryParams.max_count = event.target.value
        queryParams.page = 1 //only for redirect to page 1
        let url = route(`${propsData.routeName}.index`, queryParams);

        Inertia.get(url, { preserveState: true });
    }
    //FOR SORT TABLE DATA
    const sortTableData = (item) => {
        if(item.sort) {
            queryParams = {...queryParams, ...route().params}
            queryParams.name = item.sortBy ?? item.key
            queryParams.sort = queryParams.sort == 'desc' ? 'asc' : 'desc';

            let url = route(`${propsData.routeName}.index`, queryParams);
            Inertia.get(url, { preserveState: true });
        }
    }

</script>

<template>

    <div class="row" v-if="showCreateButton && actions.includes('create')">
        <div class="col-md-12 text-right">
            <Link
                :class="'btn btn-info btn-sm'"
                :href="route(`${routeName}.create`)"
            >
                <font-awesome-icon :icon="['fas', 'plus']" /> Create
            </Link>
        </div>
    </div>

    <div class="table-responsive" :class="showCreateButton && actions.includes('create') ? 'mt-3' : ''">
        <table
            :options="{select: true}"
            class="table table-striped table-hover display"
        >
            <thead class="table-header">
                <tr>
                    <th
                        v-for="(item, index) in header"
                        :key="'-head-' + index"
                        scope="col"
                        :class="`${item.sort ? 'header-cursor' : ''}`"
                        @click="sortTableData(item)"
                    >
                        <span>{{ item.title }}</span>
                        <span class="ml-1" v-if="item.sort">
                            <font-awesome-icon :icon="['fas', 'sort']" />
                        </span>
                    </th>
                    <th
                        v-if="showAction && actions.includes('status')"
                        scope="col"
                        class="text-center"
                        :style="{ width: '110px' }"
                    >
                        Status
                    </th>
                    <th
                        v-if="showAction && (actions.includes('show') || actions.includes('edit') || actions.includes('destroy'))"
                        scope="col"
                        class="text-center"
                        :style="{ width: '110px' }"
                    >
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody v-if="initialData.dataList && initialData.dataList.length > 0">
                <tr v-for="(data, key) in initialData.dataList" :key="'-row-' + key">
                    <td v-for="(item, index) in header" :key="index">

                        <span v-if="item.type == 'html'" v-html="item.modifier(data[item.key], data)"></span>

                        <span v-else>
                            {{ data[item.key] ?? 'N/A' }}
                        </span>
                    </td>
                    <td
                        v-if="showAction && actions.includes('status')"
                        class="text-center"
                    >
                        <BreezeSwitch
                            :index="key"
                            :data="data"
                            :route-name="routeName"
                        />
                    </td>
                    <td v-if="showAction" scope="col" class="text-center">
                        <Link
                            v-if="actions.includes('show')"
                            :class="'btn btn-outline-success btn-xs'"
                            :href="route(`${routeName}.show`, { id: data.id })"
                        >
                            <font-awesome-icon :icon="['fas', 'eye']" />
                        </Link>
                        <Link
                            v-if="actions.includes('edit')"
                            :class="'btn btn-outline-primary btn-xs ml-2'"
                            :href="route(`${routeName}.edit`, { id: data.id })"
                        >
                            <font-awesome-icon :icon="['fas', 'file-pen']" />
                        </Link>
                        <BreezeButton
                            v-if="actions.includes('destroy') &&
                            ((exception.route.includes(routeName) && exception.id.includes(data.id)) ? false :true)"
                            :class="'btn btn-outline-danger btn-xs ml-2'"
                            @click="destroy(data.id)"
                        >
                            <font-awesome-icon :icon="['fas', 'trash']" />
                        </BreezeButton>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td class="text-center text-danger"
                        :colspan=" header.length + (showAction ? actions.includes('status') ? 2 : 1 : 0) ">
                        No Data Found
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="d-flex justify-content-between bd-highlight"
        v-if="initialData.dataList && initialData.dataList.length > 0 && routeName">
        <div class="p-2 bd-highlight ml-2">
            <div class="row">
                <div>Rows per page:</div>
                <div class="mx-2">
                    <select
                        class="form-control form-control-sm me-2"
                        aria-label="Default select"
                        @change="limitChange($event)"
                    >
                        <option
                            v-for="(item, key) in pageSize"
                            :key="`list-count-${key}`"
                            :value="item"
                            :selected="item == route().params.max_count"
                        >
                            {{ item }}
                        </option>
                    </select>
                </div>
                <div>
                    Showing {{ dataSet.from }} to {{ dataSet.to }} of
                    {{ dataSet.total }} entries
                </div>
            </div>
        </div>

        <div class="p-2 bd-highlight" v-if="dataSet.links && initialData.currentPage > 0">
            <CustomPagination :queryParams="{...queryParams, ...route().params}" :initialData="initialData"
                :routeName="routeName" :dataSet="dataSet"></CustomPagination>
        </div>
    </div>

</template>

<style>
    .header-cursor{
        cursor: pointer;
    }
</style>
