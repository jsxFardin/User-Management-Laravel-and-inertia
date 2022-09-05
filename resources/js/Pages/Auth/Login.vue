<script setup>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import BreezeButton from "@/Components/Button.vue";
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

defineProps({
  canResetPassword: Boolean,
  status: String,
});
const appName = computed(() => usePage().props.value.config.appName);
const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
    onSuccess: (response) => {
      console.log(response);
    },
  });
};
</script>

<template>
  <BreezeGuestLayout>
    <Head title="Log in" />

    <div class="login-box">
      <div class="login-logo text-bold">
        <Link href="/">
          <BreezeApplicationLogo class="fill-current text-gray-500" />
        </Link>
        <!-- Digitized Operation -->
        <!-- {{ appName }} -->
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <!-- <BreezeValidationErrors class="mb-4" /> -->

          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
          </div>

          <form @submit.prevent="submit">
            <div class="form-row mt-3 mb-3">
              <div class="form-group col-md-12 mb-3">
                <BreezeInput
                  id="email"
                  type="email"
                  class="form-control"
                  v-model="form.email"
                  required
                  autofocus
                  placeholder="Email"
                  autocomplete="username"
                  :error="form.errors.email"
                />
              </div>

              <div class="form-group col-md-12 mb-3">
                <BreezeInput
                  id="password"
                  type="password"
                  class="form-control"
                  v-model="form.password"
                  required
                  placeholder="Password"
                  autocomplete="current-password"
                  :error="form.errors.password"
                />
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <div class="icheck-primary">
                  <BreezeCheckbox
                    id="remember"
                    name="remember"
                    label="Remember me"
                    label_class=" ml-2 "
                    v-model:checked="form.remember"
                  />
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <BreezeButton
                  class="btn btn-primary btn-block"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Sign in
                </BreezeButton>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <p class="mb-1">
            <a href="password/reset"> Forgot Your Password </a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
  </BreezeGuestLayout>
</template>

<style>
.w-20 {
  width: 5rem;
}

.height {
  height: 5rem;
}
</style>
