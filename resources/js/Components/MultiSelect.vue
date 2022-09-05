<script setup>

const props = defineProps({
    option: {
        type: Array,
        default: null,
    },
    modelValue: {
        type: Number,
        default: null,
    },
    error: Object,
})

defineEmits(["update:modelValue"])

console.error(props)

</script>

<template>
    <multi-select :options="option" :v-model=""
        @change="$emit('update:modelValue', $event.target.value)" />

    <span v-show="error" class="text-danger">{{ error }}</span>
</template>