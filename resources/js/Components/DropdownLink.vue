<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Link class="nav-link" data-widget="control-sidebar" data-slide="true" :href="'#'" role="button">
        <slot />
    </Link>
</template>
