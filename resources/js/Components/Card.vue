<script setup>
    import { reactive } from '@vue/reactivity'

    defineProps({
        title: {
            type: String,
            default: 'Card Title',
        },
        showHeader: {
            type: Boolean,
            default: false,
        },
    })

    const toggle = () => {
        data.fullscreen = !data.fullscreen
    }
    let data = reactive({
        fullscreen: false
    })

</script>

<template>
    <!-- Default box -->
    <fullscreen v-model="data.fullscreen" :page-only="data.pageOnly" >
        <div class="card">
            <div v-if="showHeader" class="card-header">
                <h3 class="card-title text-bold">{{ title }}</h3>

                <button class="float-right btn btn-danger btn-sm" @click="toggle" >
                    <font-awesome-icon :icon="['fas', `expand`]" />
                </button>
            </div>

            <div class="card-body">
                <slot />
            </div>
            <!-- /.card-body -->
        </div>
    </fullscreen>
    <!-- /.card -->
</template>
