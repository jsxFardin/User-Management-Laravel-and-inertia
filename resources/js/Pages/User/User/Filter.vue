<script setup>

    import BreezeLabel from "@/Components/Label.vue";
    import BreezeInput from "@/Components/Input.vue";
    import BreezeButton from "@/Components/Button.vue";
    import { Inertia } from "@inertiajs/inertia";
    import { reactive } from "@vue/reactivity";
    import BreezeDataTableFilter from "@/Components/TableFilter.vue";
    import { computed } from 'vue'

    let data = reactive({
        isExpanded: false,
    });
    let filterForm = reactive({
        page: route().params.page ?? 1,
        sort: route().params.sort ?? 'desc',
        name: route().params.name ?? 'id',
        max_count: route().params.max_count ?? 10,

        search_value: route().params.search_value ?? "",
        role_id: route().params.role_id ?? "",
    });
    defineProps({
        roles: Object,
    })
    const role = computed(() => storeData.getters.getAuthUser.roles ?? [])

    const filterTable = () => {
        Inertia.get(`user`, filterForm, {
        preserveState: true,
        });
    }
  

</script>

<template>
    <BreezeDataTableFilter @filterTable="filterTable" :showSearch="false">
        <div class="col-md-4">
            <BreezeLabel for="search_value" value="Search User ID || Email || Mobile" />
            <BreezeInput
                type="text"
                class="form-control"
                v-model="filterForm.search_value"
                placeholder="Enter User ID || Email || Mobile"
            />
        </div>
        <div class="col-md-4">
            <BreezeLabel for="role_id" value="Role" />
            <multi-select v-model="filterForm.role_id" :searchable="true"
                :options="roles" :placeholder="`Choose a Role`"/>
        </div>
    </BreezeDataTableFilter>
</template>