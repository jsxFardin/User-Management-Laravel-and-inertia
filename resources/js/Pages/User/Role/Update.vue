<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeCheckbox from '@/Components/Checkbox.vue';
import RoleList from './Common/List.vue'
import { useForm, Head } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button.vue";

const propsData = defineProps({
    role: {
        type: Object,
        default: [],
    },
});

const form = useForm(propsData.role);

const submit = () => {
    form.put(route("role.update", propsData.role.id), {
        onSuccess: () => {
            storeData.commit('resetState')
            toast.success("Role updated Successfully")
        },
        onError: () => toast.error("error"),
    });
}
</script>

<template>
    <Head title="Update Role" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'user-tag'" title="Role Update" :route="route('role.index')" />

        <section class="content">
            <BreezeCard :title="'User'">
                <form @submit.prevent="submit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput
                                    id="name"
                                    type="text"
                                    class="form-control"
                                    v-model="form.name"
                                    autofocus
                                    placeholder="Name"
                                    :autocomplete="form.name"
                                    :error="form.errors.name"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>

                    <div id="accordion">
                        <RoleList
                            v-for="(assign, a) in role.assign"
                            :item="assign"
                            :key="a"
                        />
                    </div>

                    <BreezeButton
                        class="btn btn-success float-right"
                        :disabled="form.processing"
                        >Update</BreezeButton>
                </form>
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
