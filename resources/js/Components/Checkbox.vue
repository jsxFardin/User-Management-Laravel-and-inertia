<script setup>
import { computed } from "vue";
import BreezeLabel from "@/Components/Label.vue";

const emit = defineEmits(["update:checked"]);
const props = defineProps({
  checked: {
    type: [Array, Boolean],
    default: false,
  },
  value: {
    default: null,
  },
  label_class: {
    type: String,
    default: "form-check-label",
  },
  class: String,
  error: Object,
  id: String,
  label: String,
});

const proxyChecked = computed({
  get() {
    return Boolean(props.checked)
  },

  set(val) {
    emit("update:checked", val);
  },
});
const Classes = computed(() => {
  return props.error != null ? props.class + " is-invalid" : props.class;
});
</script>

<template>
  <div class="form-check pl-0">
    <input :class="Classes" type="checkbox" :id="id" v-model="proxyChecked" />
    <label :class="label_class" :for="id"> {{ label }} </label>
  </div>
</template>
