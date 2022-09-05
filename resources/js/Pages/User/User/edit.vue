<script setup>
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import { onMounted } from "@vue/runtime-core";
    import BreezeForm from '@/Pages/User/User/Form.vue'

    const propsData = defineProps({
        user: Object,
        roles: Object,
        agency: Object,
        teams: Object,
        position: Object,
    });
    const form = useForm(propsData.user);
    onMounted(() => {
        propsData.user.password = "";
    });

    const submit = () => {
        form.put(route("user.update", propsData.user.id), {
            onSuccess: () => {
            if (propsData.user.id == storeData.getters.getAuthUser.id)
                storeData.commit("resetUserState");
            toast.success("User update Successfully");
            },
        });
    };
</script>

<template>
    <Head title="Edit user info" />

    <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb :icon="'user'" :title="' Update user info'" :route="route('user.index')"/>

        <section class="content">
            <BreezeCard :title="'User'">
                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <BreezeForm :form-data="form" :position="position"
                        :roles="roles" :agency="agency" :team-names="teams"></BreezeForm>
                </form>

            </BreezeCard>
        </section>
  </BreezeAuthenticatedLayout>
</template>
