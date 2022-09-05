<script setup>
import BreezeCheckbox from '@/Components/Checkbox.vue';
import { watch } from '@vue/runtime-core';

const propsData = defineProps({
    item: Object,
    key: Number,
    checkAllItems: Boolean
})

watch( () => propsData.checkAllItems, (value) => {
            if(value){
                propsData.item.have_permission = value
            }
        },
    {immediate: true}
);
</script>

<template>
    <div class="col">
        <div class="icheck-primary">
            <label class="flex items-center">
                <BreezeCheckbox
                    :id="item.name + item.id"
                    class="form-check-input"
                    v-model:checked="item.have_permission"
                    :label="item.label"
                />
            </label>
        </div>
    </div>
</template>
