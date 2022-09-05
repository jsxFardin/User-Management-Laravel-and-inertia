<script setup>
    import { Head } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import { reactive, ref } from "@vue/reactivity";
    import { useForm } from '@inertiajs/inertia-vue3';
    import BreezeButton from "@/Components/Button.vue";
    import BreezeDataTable from "@/Components/Table.vue";

    const agencyHeader = ref([
        {
            title: "Agency Name",
            type: "text",
            key: "agency_name",
        },
        {
            title: "Contact Person",
            type: "text",
            key: "contact_person",
        },
        {
            title: "Mobile",
            type: "text",
            key: "mobile",
        },
        {
            title: "Email",
            type: "text",
            key: "email",
        },
    ])
    const teamHeader = ref([
        {
            title: "Team Name",
            type: "text",
            key: "team_name",
        },
        {
            title: "Contact Person",
            type: "text",
            key: "contact_person",
        },
        {
            title: "Mobile",
            type: "text",
            key: "mobile",
        },
        {
            title: "Email",
            type: "text",
            key: "email",
        },
    ])
    const blockHeader = ref([
        {
            title: "Block Name",
            type: "text",
            key: "name",
        },
        {
            title: "Block Short Name",
            type: "text",
            key: "short_name",
        },
    ])
    const campHeader = ref([
        {
            title: "Camp Name",
            type: "text",
            key: "name",
        },
        {
            title: "Camp Short Name",
            type: "text",
            key: "short_name",
        },
    ])
    const propsData = defineProps({
        item: {
            type: Array,
            default: [],
        },
        message: {
            type: String,
            default: null,
        },
        access: {
            type: Array,
            default: [],
        },
        user_agency: Object,
        user_team: Object,
        camps: Object,
        blocks: Object,
        storage_url: String
    });
    const form = useForm({
        avatar: null,
        user_id: propsData.item.id
    });
    const image = reactive({
        imageUrl: '',
        imageShow: false
    });

    if (propsData.item.image) {
        image.imageUrl = propsData.storage_url;
        image.imageShow = true;
    }
    else {
        image.imageShow = false;
    }

    function submit() {
        form.post(route(`upload.image`));
    }

    function loadImage(e) {
        image.imageShow = true;
        let targetImage = document.getElementById('output');
        targetImage.src = URL.createObjectURL(e.target.files[0]);
        submit();
    }
</script>

<template>
    <Head title="User Info" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb
        :icon="'box-open'"
        title="User Info"
        :route="route('user.index')"
        />
        <section class="content">
        <BreezeCard :title="'User'">
            <h5>User Details</h5>
            <hr />
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div><strong>User ID : </strong> {{ item.id_no }}</div>
                            <div><strong>Name : </strong> {{ item.name }}</div>
                            <div><strong>Username : </strong> {{ item.username }}</div>
                            <div><strong>Emai : </strong> {{ item.email }}</div>
                            <div><strong>Mobile : </strong> {{ item.mobile }}</div>
                        </div>
                        <div class="col-md-6">
                            <div><strong>Role : </strong> {{ item.role_name }}</div>
                            <div><strong>Joined : </strong> {{ item.joined }}</div>
                            <div><strong>Position : </strong> {{ item.position }}</div>
                            <div>
                                <strong>Status : </strong>
                                <span v-if="item.status == 1" class="badge badge-success">Active</span> 
                                <span v-else class="badge badge-danger">Inactive</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div>
                        <div><strong>Picture : </strong></div>
                        <div>
                            <img v-show="image.imageShow" class="profile-user-img img-fluid img-circle" 
                                :src="image.imageUrl" id="output" />
                        </div>

                        <form @submit.prevent="submit">
                            <input type="hidden" v-model="form.user_id" />
                            <input type="file" @input="form.avatar = $event.target.files[0]" @change="loadImage" class="btn-sm" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                            <BreezeButton
                                class="btn btn-success d-none"
                                :disabled="form.processing"
                                >Submit</BreezeButton>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <h5 class="text-bold">Camp Info</h5>
                <hr />

                <BreezeDataTable
                    :route-name="''"
                    :modal="false"
                    :header="campHeader"
                    :data-set="propsData.camps"
                    :actions="''"
                    />
            </div>
            <div class="row mt-3">
                <h5 class="text-bold">Block Info</h5>
                <hr />

                <BreezeDataTable
                    :route-name="''"
                    :modal="false"
                    :header="blockHeader"
                    :data-set="propsData.blocks"
                    :actions="''"
                    />
            </div>
            <div class="row mt-3">
                <h5 class="text-bold">Agency Info</h5>
                <hr />

                <BreezeDataTable
                    :route-name="''"
                    :modal="false"
                    :header="agencyHeader"
                    :data-set="propsData.user_agency"
                    :actions="''"
                    />
            </div>
            <div class="row mt-3">
                <h5 class="text-bold">Team Info</h5>
                <hr />

                <BreezeDataTable
                    :route-name="''"
                    :modal="false"
                    :header="teamHeader"
                    :data-set="propsData.user_team"
                    :actions="''"
                    />
            </div>
        </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>

<style scoped>
    .profile-user-img{
        width: 150px;
        height: 150px;
        object-fit: contain;
    }
</style>