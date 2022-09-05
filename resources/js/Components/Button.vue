<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    classes: {
        type: String,
        default: ' focus:shadow-outline-gray transition ease-in-out duration-150'
    }
});
</script>

<template>
    <button :type="type" :class="classes">
        <slot />
    </button>
</template>
