<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Profile from '@/Pages/profile/index.vue'

const props = defineProps<{
    errors: any
}>()

defineOptions({
    layout: AppLayout
})
</script>

<template>
    <div class="w-full flex justify-center">
        <Profile :errors="props.errors" />
    </div>
</template>
