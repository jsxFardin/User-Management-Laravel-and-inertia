<script setup>
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeForm from '@/Pages/Team/Form.vue'
    import { Inertia } from "@inertiajs/inertia";

    const props = defineProps({
        agencies: {
            type: Object,
            default: null,
        },
    });
    const blockNames = []
    const form = useForm({
        agency_id       : route().params.agency??'',
        team_name       : "",
        email           : "",
        password        : "",
        mobile          : "",
        contact_person  : "",
        user_id         : "",
        role_id         : "",
        agency          : [],
        assigns         : [],
    });
    const submit = () => {
        form.post(route("team.store"), {
            preserveScroll: true,
            onSuccess: (res) => {
                if (res.props.flash && res.props.flash.message != null) {
                    toast.warning(res.props.flash.message);
                } else {
                    toast.success("Team created successfully!");
                }
            },
        });
    };
</script>

<template>
    <Head title="Team Create" />

    <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb :icon="'house'" :title="'Team Create'" :route="route('team.index')" />

        <section class="content">
            <BreezeCard :title="'Team'">

                <form @submit.prevent="submit">
                    <BreezeForm
                        :formData="form"
                        :agencies="agencies"
                    ></BreezeForm>
                </form>

            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
