<script setup>
    import BreezeCard from "@/Components/Card.vue";
    import BreezeInput from "@/Components/Input.vue";
    import Button from "@/Components/Button.vue";
    import BreezeLabel from "@/Components/Label.vue";
    import {reactive } from "@vue/runtime-core";
    import BreezeButton from "@/Components/Button.vue";
    
    const props = defineProps({
        formData: Object,
        roles: Object
    })

</script>

<template>
    <div class="form-row">
        <div class="form-group col-md-6">
            <BreezeLabel for="name" value="Name" />
            <BreezeInput id="name" type="text" class="form-control" v-model="props.formData.name" autofocus
                placeholder="Name" :autocomplete="props.formData.name" :error="props.formData.errors.name" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="username" value="User Name" />
            <BreezeInput id="username" type="text" class="form-control" v-model="props.formData.username"
                autofocus placeholder="username" :autocomplete="props.formData.username" :error="props.formData.errors.username" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="form-control" v-model="props.formData.email"
                autofocus placeholder="Email" :autocomplete="props.formData.email" :error="props.formData.errors.email" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="form-control" v-model="props.formData.password"
                placeholder="Password" autofocus :autocomplete="props.formData.password" :error="props.formData.errors.password" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="mobile" value="Phone" />
            <BreezeInput id="mobile" type="phone" class="form-control" v-model="props.formData.mobile"
                autofocus placeholder="Phone" :autocomplete="props.formData.mobile" :error="props.formData.errors.mobile" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="roles" value="Roles" />
            <multi-select v-model="props.formData.roles" :options="roles"
                :searchable="true" :placeholder="'Choose a role'"
            ></multi-select>
        </div>
    </div>

    <BreezeButton
        class="btn btn-success float-right"
        :disabled="formData.processing"
        >Save</BreezeButton>
</template>
