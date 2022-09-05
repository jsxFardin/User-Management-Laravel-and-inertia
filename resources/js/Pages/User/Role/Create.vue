<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import { useForm, Head } from "@inertiajs/inertia-vue3";
import { onMounted } from "@vue/runtime-core";
import BreezeLabel from "@/Components/Label.vue";
import BreezeInput from "@/Components/Input.vue";
import RoleList from './Common/List.vue';
import BreezeButton from "@/Components/Button.vue";

const propsData = defineProps({
    permissions: {
        type: Array,
    }
})

const form = useForm({
    id: "",
    name: "",
    assign: []
});

onMounted(() => {
    form.assign = propsData.permissions
})

const submit = () => {
    form.post(route("role.store"), {
        preserveScroll: true,
        onSuccess: (res) => {
            if (res.props.flash && res.props.flash.message != null) {
                toast.warning(res.props.flash.message);
            } else {
                toast.success("Role created successfully!");
            }
        },
    });
}

</script>

<template>
    <Head title="Create Role" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'user-tag'" title="Role Create" :route="route('role.index')"/>

        <section class="content">
            <BreezeCard :title="'Role'">
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
                            v-for="(assign, a) in form.assign"
                            :item="assign"
                            :item-key="a+1"
                            :key="a"
                        />
                    </div>

                    <BreezeButton
                        class="btn btn-success float-right"
                        :disabled="form.processing"
                        >Save</BreezeButton>
                    
                </form>
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
