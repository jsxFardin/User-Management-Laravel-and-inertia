<script setup>
  import { ref, reactive } from "vue";
  import BreezeDropdownLink from "@/Components/DropdownLink.vue";
  import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
  import { Link } from "@inertiajs/inertia-vue3";
  import BreezeAside from "@/Components/Aside.vue";
  import { Inertia } from "@inertiajs/inertia";
  import BreezePreloader from "@/Components/Preloader.vue";

  // handleNavToggle click
  function handleNavToggle() {
    let sideBar = $(".sidebar");
    let mainSideBar = $(".main-sidebar");
    if (mainSideBar.width() == 250 && window.innerWidth > 768) {
      sideBar.removeClass("sidebar-initial-width");
      sideBar.addClass("sidebar-mini-initial-width");
    } else {
      sideBar.removeClass("sidebar-mini-initial-width");
      sideBar.addClass("sidebar-initial-width");
    }
  }

  let data = reactive({
    isPreloader: false,
  });

  Inertia.on("start", ({ detail: { visit } }) => {
    data.isPreloader = true;
  });
  Inertia.on("finish", ({ detail: { visit } }) => {
    data.isPreloader = false;
  });
  
</script>

<template>
  <div>
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item nav-toggle-button">
            <a
              class="nav-link"
              data-widget="pushmenu"
              href="#"
              role="button"
              @click="handleNavToggle"
            >
              <font-awesome-icon :icon="['fas', 'bars']"></font-awesome-icon>
            </a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a
              class="nav-link"
              data-widget="fullscreen"
              :href="'#'"
              role="button"
            >
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item">
            <BreezeDropdownLink :href="route('logout')" method="post">
              <font-awesome-icon
                :icon="['fas', `right-from-bracket`]"
              ></font-awesome-icon>
              {{ __("message.Logout") }}
            </BreezeDropdownLink>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <BreezeAside></BreezeAside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <BreezePreloader v-if="data.isPreloader" />
        <!-- Page Main Content -->
        <slot />
      </div>

      <footer class="main-footer">
        <div class="float-right d-none d-sm-block"><b>Version</b> 1.0.0</div>
        <strong>Copyright &copy; 2022 <a href="#">oxFam</a>.</strong>
        All rights reserved.
      </footer>
    </div>
    <!-- /.Site wrapper -->
  </div>
</template>
