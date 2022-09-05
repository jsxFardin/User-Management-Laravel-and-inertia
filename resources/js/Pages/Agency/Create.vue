<script setup>
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeForm from '@/Pages/Agency/Form.vue'
    import { Inertia } from "@inertiajs/inertia";
    import { computed } from 'vue';

    const form = useForm({
        agency_name     : "",
        email           : "",
        mobile          : "",
        phone           : "",
        contact_person  : "",
        password        : "",
        address         : "",
        user_id         : "",
        role_id         : "",
        assigns         : [{
            camp_id     : "",
            block_id    : [],
        }]
    });
    const props = defineProps({
        camps: Object,
        blocks: Object,
    })

    const submit = () => {
        form.post(route("agency.store"), {
            preserveScroll: true,
            onSuccess: (res) => {
                if (res.props.flash && res.props.flash.message != null) {
                    toast.warning(res.props.flash.message);
                } else {
                    toast.success("Agency created successfully!");
                }
            },
        });
    };
</script>

<template>
    <Head title="Agency Create" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'house'" :title="'Agency Create'" :route="route('agency.index')" />

        <section class="content">
            <BreezeCard :title="'Agency'">

                <form @submit.prevent="submit">
                    <BreezeForm :formData="form" :campNames="camps" :blockNames="blocks"></BreezeForm>
                </form>

            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
