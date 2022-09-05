<script setup>
    import { computed, onMounted, watch } from "@vue/runtime-core";
    import BreezeDropdown from "@/Components/Dropdown.vue";
    import { usePage, Link } from "@inertiajs/inertia-vue3";

    const user = computed(() => storeData.getters.getAuthUser);
    const menus = computed(() => storeData.getters.getMenus);
    const appName = computed(() => usePage().props.value.config.appName);

    onMounted(() => {
        storeData.dispatch("getUser");
        storeData.dispatch("menuRequest", {
            id: user.value.id,
        });
    });

    watch( () => menus.value, (value) => {
        if (value.length == 0) {
            storeData.dispatch("menuRequest", {
                id: user.value.id,
            });
            }
        }, { immediate: true }
    )
    watch( () => user.value, (value) => {
        if (value.id == "") {
            storeData.dispatch("getUser");
            }
        }, { immediate: true } 
    )

    function showNavElement() {
        let sideBar = $('.sidebar');
        let sideBarMini = $('.sidebar-mini');

        if (!sideBarMini.hasClass("sidebar-collapse")) {
            sideBar.removeClass("sidebar-initial-width");
            sideBar.addClass("expand-sideBar");
        } else {
            sideBar.addClass("sidebar-mini-new-width");
        }
    }

    function hideNavElement() {
        let sideBar = $('.sidebar');
        sideBar.addClass("sidebar-initial-width");
        sideBar.removeClass("expand-sideBar");

        if (sideBar.hasClass("sidebar-mini-new-width")) {
            sideBar.removeClass("sidebar-mini-new-width");
            sideBar.addClass("sidebar-mini-initial-width");
        }
    }

</script>

<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
        <!-- Brand Logo -->
        <Link :href="route('dashboard')" class="brand-link text-center">
            <div class="brand-text font-weight-light app-name">
                <!-- Digitized Operation -->
                {{ appName }}
            </div>
        </Link>
        <div class="clearfix"></div>

        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light sidebar-initial-width">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="$page.props.config.logo" :alt="'User Image'" class="img-circle elevation-2">
                </div>
                <div class="info">
                    <Link :href="route('user.profile')" class="d-block">
                        {{ user.name }}
                    </Link>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column mcd-menu" @mouseover="showNavElement" @mouseleave="hideNavElement" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <BreezeDropdown v-for="(menu, m) in menus" :key="m" :item="menu" />
                </ul>
            </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<style>
.brand-link {
  padding: 0;
  background: #61a534;
}
.brand-link .brand-image {
  float: none;
  max-height: 60px;
}
.app-name {
  padding: 0.8rem;
}
</style>
