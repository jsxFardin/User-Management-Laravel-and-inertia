<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
  email: String,
  token: String,
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  if (form.password !== form.password_confirmation) {
    form.errors.password_confirmation = "Password confirmation does not match";
    return true;
  }
  form.post(route("password.update"), {
    onFinish: () => form.reset("password", "password_confirmation"),
    onSuccess: () => {
      toast.success("Password updated successfully!");
    },
  });
};
</script>

<template>
  <BreezeGuestLayout>
    <Head title="Reset Password" />

    <BreezeValidationErrors class="mb-4" />

    <div class="login-box">
      <div class="login-logo text-bold">
        <Link href="/">
          <BreezeApplicationLogo class="fill-current text-gray-500" />
        </Link>
      </div>

      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Reset password</p>
          <form @submit.prevent="submit">
            <div>
              <BreezeLabel for="email" value="Email" />
              <BreezeInput
                id="email"
                type="email"
                class="form-control"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
                readonly
                :error="form.errors.email"
              />
            </div>

            <div class="mt-4">
              <BreezeLabel for="password" value="Password" />
              <BreezeInput
                id="password"
                type="password"
                class="form-control"
                v-model="form.password"
                required
                autocomplete="new-password"
                :error="form.errors.password"
              />
            </div>

            <div class="mt-4">
              <BreezeLabel
                for="password_confirmation"
                value="Confirm Password"
              />
              <BreezeInput
                id="password_confirmation"
                type="password"
                class="form-control"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
                :error="form.errors.password_confirmation"
              />
            </div>

            <div class="flex items-center justify-end mt-4">
              <BreezeButton
                class="btn btn-primary btn-block"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Reset Password
              </BreezeButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </BreezeGuestLayout>
</template>
