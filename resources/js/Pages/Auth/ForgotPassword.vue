<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

defineProps({
  status: String,
});

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"), {
    onFinish: () => form.reset("email"),
    onSuccess: () => {
      toast.success("Reset password link send successfully!");
      form.reset("email");
    },
  });
};
</script>


<template>
  <BreezeGuestLayout>
    <Head title="Forgot password" />

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
          <p class="login-box-msg">Forgot password</p>

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
            </div>

            <div class="row">
              <!-- /.col -->
              <div class="col-md-4">
                <p class="mb-1">
                  <a href="/"> Back </a>
                </p>
              </div>
              <div class="col-md-8">
                <BreezeButton
                  class="btn btn-primary btn-block"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Email Password Reset Link
                </BreezeButton>
              </div>
              <!-- /.col -->
            </div>
          </form>
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