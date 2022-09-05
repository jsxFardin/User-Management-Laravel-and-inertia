<script setup>
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeForm from '@/Pages/Agency/Form.vue'
    import { Inertia } from "@inertiajs/inertia";
    import { computed } from 'vue';

    const props = defineProps({
        agency: {
            type: Object,
            default: null,
        },
        camps: Object,
        blocks: Object,
    });
    const form = useForm(props.agency);
    
    const submit = () => {
        form.put(route("agency.update", props.agency.id), {
            preserveScroll: true,
            onSuccess: (res) => {
                if (res.props.flash && res.props.flash.message != null) {
                    toast.warning(res.props.flash.message);
                } else {
                    toast.success("Agency updated successfully!");
                }
            },
        });
    };
</script>

<template>
    <Head title="Agency Update" />

    <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb :icon="'house'" :title="'Agency Update'" :route="route('agency.index')" />

        <section class="content">
            <BreezeCard :title="'Agency'">

                <form @submit.prevent="submit">
                    <BreezeForm :formData="form" :password="false" 
                        :campNames="camps" :blockNames="blocks"></BreezeForm>
                </form>
                
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
