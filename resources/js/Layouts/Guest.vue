<script setup>
import { onMounted } from "@vue/runtime-core"

onMounted(() => {
    storeData.commit('resetState')
    storeData.commit('resetUserState')
})

</script>

<template>
    <div class="login-page">
        <slot />
    </div>
</template>
