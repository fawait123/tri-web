<script setup lang="ts">
import WelcomeLayout from '@/layouts/WelcomeLayout.vue';
import Profile from '@/Pages/profile/index.vue'

const props = defineProps<{
    errors: any
}>()

defineOptions({
    layout: WelcomeLayout
})
</script>

<template>
    <div class="w-[80vh] mt-10">
        <Profile :errors="props.errors" />
    </div>
</template>
