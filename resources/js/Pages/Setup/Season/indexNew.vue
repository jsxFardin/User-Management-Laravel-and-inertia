<script setup>
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import BreezeLabel from "@/Components/Label.vue";
    import BreezeTextarea from "@/Components/Textarea.vue";
    import BreezeButton from "@/Components/Button.vue";
    import { reactive } from "@vue/reactivity";
    import { watch } from "@vue/runtime-core";


    const propsData = defineProps({
        access: {
            type: Array,
            default: [],
        },
        drySeason: Object,
        rainySeason: Object,
    })
    const form = useForm({
        rainy_season_id: [],
        dry_season_id: [],
        id: "",
        months: [],
        rainy_season:{
            id: '',
            months: []
        },
        dry_season:{
            id: '',
            months: []
        }
    })
    const data = reactive({
        months: [
            {
                value: "JANUARY",
                label: "JANUARY",
                disabled: false,
            },
            {
                value: "FEBRUARY",
                label: "FEBRUARY",
                disabled: false,
            },
            {
                value: "MARCH",
                label: "MARCH",
                disabled: false,
            },
            {
                value: "APRIL",
                label: "APRIL",
                disabled: false,
            },
            {
                value: "MAY",
                label: "MAY",
                disabled: false,
            },
            {
                value: "JUNE",
                label: "JUNE",
                disabled: false,
            },
            {
                value: "JULY",
                label: "JULY",
                disabled: false,
            },
            {
                value: "AUGUST",
                label: "AUGUST",
                disabled: false,
            },
            {
                value: "SEPTEMBER",
                label: "SEPTEMBER",
                disabled: false,
            },
            {
                value: "OCTOBER",
                label: "OCTOBER",
                disabled: false,
            },
            {
                value: "NOVEMBER",
                label: "NOVEMBER",
                disabled: false,
            },
            {
                value: "DECEMBER",
                label: "DECEMBER",
                disabled: false,
            },
        ],
        rainySeasonMonths: [],
        drySeasonMonths: [],
    })
    const submit = () => {
        //RAINY SEASON
        form.id = [1, 2];
        form.rainy_season.id = 1
        form.rainy_season.months = form.rainy_season_id
        //DRY SEASON
        form.dry_season.id = 2
        form.dry_season.months = form.dry_season_id
        
        form.put(route("setup.season.update", form), {
            onSuccess: () => {
                toast.success("season update Successfully");
            },
            onError: (error) => toast.error(error.message),
        });
    }
    const submitRainySeason = () => {
        // form.id = 1;
        form.months = form.rainy_season_id;
        submit();
    }
    const submitDrySeason = () => {
        // form.id = 2;
        form.months = form.dry_season_id;
        submit();
    }
    const changeRainySeason = (month) => {
        if (form.dry_season_id.includes(month)) {
            form.rainy_season_id.pop(month);
            form.errors.rainy_season_id = `${month} is already in dry season`;
            alert(form.errors.rainy_season_id);
        }
    }
    const changeDrySeason = (month) => {
        if (form.rainy_season_id.includes(month)) {
            form.dry_season_id.pop(month);
            form.errors.dry_season_id = `${month} is already in dry season`;
            alert(form.errors.dry_season_id);
        }
    }
    
    watch(() => propsData.drySeason, (value, old) => {
        if (value) {
            form.dry_season_id = value;
        }
    }, { immediate: true })

    watch(() => propsData.rainySeason, (value, old) => {
        if (value) {
            form.rainy_season_id = value;
        }
    }, { immediate: true })

    watch(() => form.dry_season_id, (value, old) => {
        if (value) {
            makeMonthsDisabled(data.months);
        }
    }, { immediate: true })

    watch(() => form.rainy_season_id, (value, old) => {
        if (value) {
            makeMonthsDisabled(data.months);
        }
    }, { immediate: true })

    function makeMonthsDisabled(months) {
        data.rainySeasonMonths  = JSON.parse(JSON.stringify(months));
        data.drySeasonMonths    = JSON.parse(JSON.stringify(months));
        data.rainySeasonMonths.filter((month) => {
            if (form.dry_season_id.includes(month.value)) {
                month.disabled = true;
            }
        });
        data.drySeasonMonths.filter((month) => {
            if (form.rainy_season_id.includes(month.value)) {
                month.disabled = true;
            }
        });
    }
</script>

<template>
    <Head title="Season Info" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb
            :icon="'screwdriver-wrench'"
            :title="'Season Info'"
            :route="route('setup.season.index')"
        />

        <section class="content">

            <form @submit.prevent="submit">

                <BreezeCard :title="'Season'">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="mb-3">
                            <BreezeLabel for="rainy_season_id" value="Rainy Season" />
                            <multi-select
                            v-model="form.rainy_season_id"
                            :options="data.rainySeasonMonths"
                            mode="tags"
                            :close-on-select="false"
                            :searchable="true"
                            :create-option="true"
                            @select="changeRainySeason"
                            placeholder="Choose Rainy Season"
                            />
                            <span class="text-danger">
                            {{ form.errors.rainy_season_id }}</span
                            >
                        </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <BreezeLabel for="dry_season_id" value="Dry Season" />
                                <multi-select
                                v-model="form.dry_season_id"
                                :options="data.drySeasonMonths"
                                mode="tags"
                                :close-on-select="false"
                                :searchable="true"
                                :create-option="true"
                                @select="changeDrySeason"
                                placeholder="Choose Dry Season"
                                />
                                <span class="text-danger">
                                {{ form.errors.dry_season_id }}</span
                                >
                            </div>
                        </div>
                    </div>

                     <BreezeButton
                        class="btn btn-success float-right"
                        :disabled="form.processing"
                        >Save</BreezeButton>

                </BreezeCard>
            </form>

        </section>
    </BreezeAuthenticatedLayout>
</template>
