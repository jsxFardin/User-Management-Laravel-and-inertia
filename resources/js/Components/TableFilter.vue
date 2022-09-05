<script setup>
    import { reactive } from "@vue/reactivity";
    import BreezeLabel from "@/Components/Label.vue";
    import BreezeInput from "@/Components/Input.vue";
    import BreezeButton from "@/Components/Button.vue";
    import { Link } from "@inertiajs/inertia-vue3";
    
    let propsData = defineProps({
        showSearch: {
            type: Boolean,
            default: true,
        },
        showSearchBtn: {
            type: Boolean,
            default: true,
        },
        showResetBtn: {
            type: Boolean,
            default: false,
        },
        resetLink: {
            type: String,
            default: ""
        },
        showFooter: {
            type: Boolean,
            default: true,
        },
        label: {
            type: String,
            default: "Search",
        },
        placeholder: {
            type: String,
            default: "Search",
        },
    })
    
    let data = reactive({
        isExpanded: false,
        search: "",
    })
    const collapse = () => {
        data.isExpanded = !data.isExpanded;
    }
</script>
    
<template>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card card-primary card-outline collapsed-card">
                <div class="card-header">
                    <h3 class="card-title text-bold">
                        <span class="mr-1"
                        ><font-awesome-icon :icon="['fas', 'arrow-down-wide-short']"
                        /></span>
                        Filter Data
                    </h3>
        
                    <div class="card-tools">
                        <button
                        type="button"
                        class="btn btn-tool"
                        @click="collapse"
                        data-card-widget="collapse"
                        title="Collapse"
                        >
                        <font-awesome-icon
                            :icon="['fas', data.isExpanded ? 'minus' : 'plus']"
                        />
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <slot />

                        <div v-if="showSearch" class="col-md-4">
                            <BreezeLabel for="search" :value="label" />
                            <BreezeInput
                                type="text"
                                class="form-control"
                                v-model="data.search"
                                :placeholder="placeholder"
                                @keyup.enter="$emit('filterTable', data.search)"
                            />
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" v-if="showFooter">
                    <BreezeButton
                        v-if="showSearchBtn"
                        type="button"
                        class="btn btn-danger btn-sm float-right"
                        @click="$emit('filterTable', data.search)"
                    >
                        <span class="mr-1"
                        ><font-awesome-icon :icon="['fas', 'magnifying-glass']"
                        /></span>
                        SEARCH
                    </BreezeButton>
            
                    <Link
                        v-if="showResetBtn"
                        type="button"
                        class="btn btn-danger btn-sm float-right"
                        :href="resetLink"
                    >
                        <span class="mr-1"
                        ><font-awesome-icon :icon="['fas', 'eraser']"
                        /></span>
                        RESET FILTER
                    </Link>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>