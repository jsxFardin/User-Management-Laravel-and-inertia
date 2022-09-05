<script setup>
    import { reactive, defineProps } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3'

    const props = defineProps({
        icon: {
            type: String,
            required: false
        },
        title: {
            type: String,
            required: false
        },
        route: {
            type: String,
            required: false
        }
    })

    const data = reactive({
        icon: props.icon?? '',
        title: props.title?? '',
        route: props.route?? '',
    })

</script>

<template>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-3 pl-4">
        <Link :href="data.route" class="navbar-brand" style="color:#222d32;'">
            <font-awesome-icon :icon="['fas', `${data.icon}`]" class="mr-3"/> {{ data.title }}
        </Link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
</template>
