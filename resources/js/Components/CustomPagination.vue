<script setup>
    import { computed } from 'vue'
    import { Inertia } from "@inertiajs/inertia";

    let propsData = defineProps({
        initialData: {
            type: Object,
            required: true,
        },
        queryParams: {
            type: Object,
            required: true,
        },
        dataSet: {
            type: Object,
            required: true,
        },
        routeName: {
            type: String,
            required: true,
        },
    })
    // FOR PAGINATION
    const pagination = (getPage) => {
        propsData.queryParams = {...propsData.queryParams, ...route().params}
        propsData.queryParams.page = getPage;

        let url = route(`${propsData.routeName}.index`, propsData.queryParams);
        Inertia.get(url, propsData.queryParams, {  preserveState: true });
    }
    const isPrevPageDisabled = computed(() => {
        return propsData.initialData.currentPage > 1 ? "" : "disabled";
    })
    const isNextPageDisabled = computed(() => {
        return propsData.initialData.currentPage >= propsData.initialData.lastPage
            ? "disabled"
            : "";
    })
    const changePage = (page) => {
        pagination(page)
    }
    const getPages = computed(() => {
        let pages = [];
        let from = propsData.dataSet.current_page - Math.floor(10 / 2);
            if (from < 1) {
                from = 1
            }
        let to = from + 10 - 1;
        if (to > propsData.dataSet.last_page) {
            to = propsData.dataSet.last_page;
        }
        while (from <= to) {
            pages.push(from)
            from++
        }
        return pages
    })

</script>

<template>
    <nav aria-label="Page navigation" class="align-items-center">
        <ul class="pagination">
            <li :class="`page-item me-3 ${isPrevPageDisabled}`">
                <a
                    class="page-link"
                    href="#"
                    aria-label="Previous"
                    @click.prevent="changePage(propsData.initialData.currentPage - 1)"
                >
                    <span aria-hidden="true">Previous</span>
                </a>
            </li>
            <li v-for="(page, index) in getPages" :key="index"
                :class="`page-item ${propsData.initialData.currentPage == page ? 'active' : ''}`">
                <a
                    class="page-link"
                    href="#"
                    aria-label="Previous"
                    @click.prevent="changePage(page)"
                >
                    {{page}}
                </a>
            </li>
            <li :class="`page-item ${isNextPageDisabled}`">
                <a
                    class="page-link"
                    href="#"
                    aria-label="Next"
                    @click.prevent="changePage(propsData.initialData.currentPage + 1)"
                >
                    <span aria-hidden="true">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</template>
