<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";
import BreezeDataTable from "@/Components/Table.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import BreezeUserFilter from "@/Pages/User/User/Filter.vue";

const header = ref([
  {
    title: "Id",
    type: "text",
    key: "id_no",
    sort: true,
    sortBy: "users.id_no",
  },
  {
    title: "Name",
    type: "text",
    key: "name",
    sort: true,
    sortBy: "users.name",
  },
  {
    title: "Email",
    type: "text",
    key: "email",
    sort: true,
    sortBy: "users.email",
  },
  {
    title: "Role Name",
    type: "text",
    key: "role_name",
    sort: true,
    sortBy: "r.id",
  },
  {
    title: "Phone",
    type: "text",
    key: "mobile",
    sort: true,
    sortBy: "users.mobile",
  },
  {
    title: "Joined",
    type: "text",
    key: "created_at",
    sort: true,
    sortBy: "users.created_at",
  },
]);

defineProps({
  list: {
    type: Array,
    default: [],
  },
  access: {
    type: Array,
    default: [],
  },
  message: {
    type: String,
    default: null,
  },
  roles: Object,
  agencies: Object,
});
</script>

<template>
  <Head title="Users" />
  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'user'"
      title="User's List"
      :route="route('user.index')"
    />

    <section class="content">
      <BreezeCard :title="'Users'">
        <BreezeUserFilter :roles="roles" :agencies="agencies"/>
        <BreezeDataTable
          :route-name="'user'"
          :modal="false"
          :header="header"
          :data-set="list"
          :actions="access"
          :nonDestroyId="[1]"
        />
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>
