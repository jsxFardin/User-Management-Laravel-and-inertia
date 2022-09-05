<script setup>
import { Array } from "lodash/_freeGlobal";
import { computed, onMounted, ref } from "vue";

const props = defineProps({
    options: {
        type: Array,
        default: null,
    },
    modelValue: {
        type: Number,
        default: null,
    },
    error: Object,
    class: String,
    type: String,
    id: String,
    multiple: {
        type: Boolean,
        default: false
    },
    keyName: {
        type: String,
        default: 'value'
    },
    valueName: {
        type: String,
        default: 'label'
    }
});

defineEmits(["update:modelValue"]);

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
    <select
        :class="Classes"
        @change="$emit('update:modelValue', $event.target.value)"
        ref="input"
        :multiple="multiple"
    >
        <option value="">Select</option>
        <option
            v-for="(item, index) in props.options" :key="index"
            :value="item[keyName]"
            :selected="item[keyName] == modelValue ?? 0"
        >
            {{ item[valueName] }}
        </option>
    </select>
    <span v-show="error" class="text-danger">{{ error }}</span>
</template>
