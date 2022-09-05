<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { reactive, ref } from "@vue/reactivity";
import { watch } from "@vue/runtime-core";
import AssignCampBlocks from "@/Components/AssignCampBlocks.vue";

const props = defineProps({
  agency: Object,
});

let data = reactive({
  teams: props.agency.teams,
  assigns: props.agency.assigns,
});

watch(
  () => props.agency,
  (newVal) => {
    data.teams = newVal.teams;
    data.assigns = newVal.assigns;
  },
  { immediate: true }
);
const teamHeader = ref([
  {
    title: "#",
    type: "text",
    key: "id",
  },
  {
    title: "Team Name",
    type: "text",
    key: "team_name",
  },
  {
    title: "email",
    type: "text",
    key: "email",
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
]);
const userHeader = ref([
  {
      title: "Id No",
      type: "text",
      key: "id_no",
  },
  {
      title: "Name",
      type: "text",
      key: "name",
  },
  {
      title: "Email",
      type: "text",
      key: "email",
  },
  {
      title: "Phone",
      type: "text",
      key: "mobile",
  },
]);
</script>

<template>
  <Head title="Agency Details" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'house'"
      :title="'Agency Details'"
      :route="route('agency.index')"
    />

    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Agency Details Box -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title text-bold">Agency Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong
                ><font-awesome-icon
                  :icon="['fas', 'building']"
                ></font-awesome-icon>
                Agency Name
              </strong>
              <p class="text-muted">{{ agency.agency_name ?? "" }}</p>
              <hr />

              <strong
                ><font-awesome-icon :icon="['fas', 'user']"></font-awesome-icon>
                Contact Person Name
              </strong>
              <p class="text-muted">{{ agency.contact_person ?? "" }}</p>
              <hr />

              <strong
                ><font-awesome-icon
                  :icon="['fas', 'envelope']"
                ></font-awesome-icon>
                Email</strong
              >
              <p class="text-muted">{{ agency.email ?? "" }}</p>
              <hr />

              <strong
                ><font-awesome-icon
                  :icon="['fas', 'mobile']"
                ></font-awesome-icon>
                Mobile</strong
              >
              <p class="text-muted">{{ agency.mobile ?? "" }}</p>
              <hr />

              <strong
                ><font-awesome-icon :icon="['fas', 'map']"></font-awesome-icon>
                Address</strong
              >
              <p class="text-muted">{{ agency.address ?? "" }}</p>
              <hr />
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title text-bold">User's List</h3>
                <Link
                    :class="'btn btn-info btn-sm float-right'"
                    :href="route(`user.create`, { agency: agency.id })"
                >
                    <font-awesome-icon :icon="['fas', 'plus']" /> Create
                </Link>
            </div>
            
            <BreezeDataTable
                :route-name="''"
                :modal="false"
                :header="userHeader"
                :data-set="agency.user"
                :show-action="false"
                :showCreateButton="false"
                />
        </div>
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title text-bold">Team's List</h3>
              <Link
                :class="'btn btn-info btn-sm float-right'"
                :href="route(`team.create`, { agency: agency.id })"
              >
                <font-awesome-icon :icon="['fas', 'plus']" /> Create
              </Link>
            </div>
            <BreezeDataTable
              :route-name="''"
              :modal="false"
              :header="teamHeader"
              :data-set="agency.team"
              :show-action="false"
              :showCreateButton="false"
            />
          </div>
          <!-- /.card -->
          <assign-camp-blocks :assigns="agency.campBlock" />
        </div>
        <!-- /.col -->
      </div>
    </section>
  </BreezeAuthenticatedLayout>
</template>
