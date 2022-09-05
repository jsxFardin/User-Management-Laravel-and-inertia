<script setup>
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeLabel from "@/Components/Label.vue";
    import BreezeInput from "@/Components/Input.vue";
    import BreezeButton from "@/Components/Button.vue";

    const form = useForm({
        name: "",
    });
    const submit = () => {
        form.post(route("position.store"), {
            preserveScroll: true,
            onSuccess: (res) => {
                if (res.props.flash && res.props.flash.message != null) {
                    toast.warning(res.props.flash.message);
                } else {
                    toast.success("Position created successfully!");
                }
            },
        })
    };
</script>

<template>
    <Head title="Create new Position" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb :icon="'street-view'" :title="' New Position '" :route="route('position.index')"/>

        <section class="content">
            <BreezeCard :title="'Position '">
                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="mb-3">
                            <BreezeLabel for="name" value="Position Name" />
                            <BreezeInput id="name" type="text" class="form-control" v-model="form.name"
                                autofocus placeholder="Name" :autocomplete="form.name" :error="form.errors.name" />
                        </div>
                        </div>
                    </div>

                    <BreezeButton class="btn btn-success float-right" :disabled="form.processing">Submit</BreezeButton>
                </form>
            </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>
