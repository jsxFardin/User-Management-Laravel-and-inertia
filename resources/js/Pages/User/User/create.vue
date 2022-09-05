<script setup>
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeForm from '@/Pages/User/User/Form.vue'

    const propsData = defineProps({
        roles: Object,
    });
    const form = useForm({
        name: "",
        username: "",
        email: "",
        mobile: "",
        password: "",
        roles: "",
    })
    
    const submit = () => {
        form.post(route("user.store"), {
            preserveScroll: true,
            onSuccess: (res) => {
                if (res.props.flash && res.props.flash.message != null) {
                    toast.warning(res.props.flash.message);
                } else {
                    toast.success("Team created successfully!");
                }
            },
        })
    };
</script>

<template>
    <Head title="Create new user" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'user'" :title="'New user'" :route="route('user.index')" />

        <section class="content">
            <BreezeCard :title="'User'">
                <div
                    v-if="status"
                    class="mb-4 font-medium text-sm text-green-600"
                >
                    {{ status }}
                </div>
                
                <form @submit.prevent="submit">
                    <BreezeForm :form-data="form" :roles="roles"></BreezeForm>
                </form>

            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
