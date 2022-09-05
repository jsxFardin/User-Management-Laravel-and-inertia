<script setup>
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeForm from '@/Pages/Team/Form.vue'
    import { Inertia } from "@inertiajs/inertia";
    import { computed } from "vue";

    const props = defineProps({
        agencies: {
            type: Object,
            default: null,
        },
        team: {
            type: Object,
            default: null,
        },
        campNames: {
            type: Array,
            default: null,
        },
        blockNames: {
            type: Array,
            default: null,
        }
    });
    const form = useForm(props.team);

    const submit = () => {
        form.put(route("team.update", props.team.id), {
            preserveScroll: true,
            onSuccess: (res) => {
                if (res.props.flash && res.props.flash.message != null) {
                    toast.warning(res.props.flash.message);
                } else {
                    toast.success("Team updated successfully!");
                }
            },
        });
    };
</script>

<template>
    <Head title="Team Update" />

    <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb :icon="'house'" :title="'Team Update'" :route="route('team.index')" />

        <section class="content">
            <BreezeCard :title="'Team'">

                <form @submit.prevent="submit">
                    <BreezeForm :formData="form" :agencies="agencies"
                       :campNames="campNames" :blockNames="blockNames" :password="false"></BreezeForm>
                </form>

            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
