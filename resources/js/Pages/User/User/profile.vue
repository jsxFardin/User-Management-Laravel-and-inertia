<script setup>
    import { Head } from "@inertiajs/inertia-vue3";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
    import BreezeCard from "@/Components/Card.vue";
    import { reactive, ref } from "@vue/reactivity";
    import { useForm } from '@inertiajs/inertia-vue3';
    import BreezeButton from "@/Components/Button.vue";
    import BreezeInput from "@/Components/Input.vue";
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
    storage_url: String,
    default_image_url: String
    });

    const form = useForm({
        avatar: null,
        user_id: propsData.item.id,
        current_password: null,
        new_password: null,
        confirm_password: null
    });

    const image = reactive({
        imageUrl: '',
        bgAshColor: true,
        imageShow: false,
    });

    if (propsData.item.image) {
        image.imageUrl = propsData.storage_url;
        image.bgAshColor = false;
        image.imageShow = true;
    }
    else {
        image.bgAshColor = true;
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

    function getFile(){
        document.getElementById("upfile").click();
    }

    function changePassword() {
        form.put(route(`changepassword`, propsData.item.id), {
            onSuccess: (res) => {
                if (res.props.flash && res.props.flash.message != null) {
                    toast.warning(res.props.flash.message);
                } 
                else {
                    form.reset();
                    toast.success("Password updated Successfully!");
                }
            },
        });
    }
</script>

<template>
    <Head title="User Profile" />

    <BreezeAuthenticatedLayout>
        <BreezeBreadcrumb
        :icon="'box-open'"
        title="User Profile"
        :route="route('user.index')"
        />
        <section class="content">
            <BreezeCard :title="'User'">

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <div :class="image.bgAshColor ? 'gray-bg' : ''">
                                    <img v-show="image.imageShow" class="profile-user-img img-fluid img-circle" 
                                        :src="image.imageUrl" id="output" />

                                    <form @submit.prevent="submit">
                                        <div id="yourBtn" @click="getFile()">Upload Photo</div>                     

                                        <input type="hidden" v-model="form.user_id" />
                                        <input type="file" @input="form.avatar = $event.target.files[0]" @change="loadImage" class="btn-sm" id="upfile" v-show="false" />
                                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}%</progress>
                                        <BreezeButton
                                            class="btn btn-success d-none"
                                            :disabled="form.processing"
                                            >Submit</BreezeButton>
                                    </form>
                                </div>
                            </div>
                            <h3 class="profile-username text-center">{{ item.name }}</h3>
                            <p class="text-muted text-center">{{ item.role_name }}</p>
                        </div>
                    </div>
                    
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile profile-password">
                            <div class="text-center">
                                <form @submit.prevent="changePassword">
                                    <input type="hidden" v-model="form.user_id" />
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <BreezeInput
                                            id="current_password"
                                            type="password"
                                            class="form-control"
                                            autofocus
                                            v-model="form.current_password"
                                            :error="form.errors.current_password"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <BreezeInput
                                            id="new_password"
                                            type="password"
                                            class="form-control"
                                            v-model="form.new_password"
                                            :error="form.errors.new_password"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <BreezeInput
                                            id="confirm_password"
                                            type="password"
                                            class="form-control"
                                            v-model="form.confirm_password"
                                            :error="form.errors.confirm_password"
                                        />
                                    </div>
                                    <div>
                                        <BreezeButton
                                        class="btn btn-success"
                                        :disabled="form.processing"
                                        >Change Password</BreezeButton>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card card-primary card-outline p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div><strong>User ID : </strong> {{ item.id_no }}</div>
                                <div><strong>Username : </strong> {{ item.username }}</div>
                                <div><strong>Emai : </strong> {{ item.email }}</div>
                                <div><strong>Mobile : </strong> {{ item.mobile }}</div>
                            </div>
                            <div class="col-md-6">
                                <div><strong>Role : </strong> {{ item.role_name }}</div>
                                <div><strong>Joined : </strong> {{ item.joined }}</div>
                                <div><strong>Position : </strong> {{ item.position }}</div>
                                <div><strong>Status : </strong> {{ item.status == 1 ? 'Active' : 'Inactive' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary card-outline p-3">
                        <div class="row">
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
                    </div>
                    
                    <div class="card card-primary card-outline p-3">
                        <div class="row">
                            <h5 class="text-bold">Block Info</h5>
                            <hr/>

                            <BreezeDataTable
                                :route-name="''"
                                :modal="false"
                                :header="blockHeader"
                                :data-set="propsData.blocks"
                                :actions="''"
                                />
                        </div>
                    </div>

                    <div class="card card-primary card-outline p-3">
                        <div class="row">
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
                    </div>

                    <div class="card card-primary card-outline p-3">
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
                    </div>                    

                </div>
            </div>
            
        </BreezeCard>
        </section>
    </BreezeAuthenticatedLayout>
</template>

<style scoped>
#yourBtn {
    padding: 10px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border: 1px dashed #BBB;
    text-align: center;
    background-color: #DDD;
    margin: 0 auto;
    margin-top: 10px;

    height: 44px; 
    width: 125px;
    border: 1px dashed #BBB; 
    cursor: pointer;
}
.profile-user-img{
    width: 150px;
    height: 150px;
    object-fit: contain;
}
</style>