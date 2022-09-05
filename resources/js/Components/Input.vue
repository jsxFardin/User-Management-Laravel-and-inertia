<script setup>
import { computed, onMounted, ref } from "vue";

const props = defineProps([
    "modelValue",
    "error",
    "value",
    "class",
    "type",
    "id",
    "type",
    "step",
    "placeholder",
    "autocomplete",
    "readonly"
]);
defineEmits(["update:modelValue", 'getUserData']);

const input = ref(null);
onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});
const Classes = computed(() => {
    return props.error != null ? props.class + " is-invalid" : props.class;
});
</script>

<template>
    <input
        :class="Classes"
        :value="value ?? modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        :id="id"
        :type="type"
        autofocus
        :placeholder="placeholder"
        :autocomplete="autocomplete"
        @change="$emit('getUserData')"
        :step="step"
        :readonly="readonly"
        v-bind="$attrs"
    />
    <span v-show="error" class="text-danger">{{ error }}</span>
</template>
