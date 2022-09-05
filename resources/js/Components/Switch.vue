<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from '@vue/reactivity';
import { computed } from '@vue/runtime-core';


const props = defineProps({
    routeName: {
        type: String,
        required: true
    },
    data: {
        type: Object,
        required: true
    },
})

const exceptions = ref([
    'latrine',
    'team',
    'agency',
    'user',
    'role',
    'inspection',
    'complaint',
    'setup.block'
])

const info = computed(() => props.data)

const form = useForm(info.value)

const changeStatus = () => {
    if(confirm('Are you sure?')) {
        const actionURL = props.routeName + (exceptions.value.includes(props.routeName) ? '.status' : '.update')

        info.value.active = form.active = !info.value.active

        form.put(route(actionURL, info.value.id), {
            preserveScroll: true,
            onSuccess: (res) => {
                if (res.props.flash && res.props.flash.message != null) {
                    toast.warning(res.props.flash.message)
                }
                else {
                    toast.success(`${props.routeName} status updated successfully!`)
                }
            }
        })
    }
}
</script>

<template>
    <div class="form-group">
        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success" @click.prevent="changeStatus">
            <input type="checkbox" class="custom-control-input" :checked="info.active" :id="'customSwitch'+info.id">
            <label class="custom-control-label" :for="'customSwitch'+info.id"></label>
        </div>
    </div>
</template>
