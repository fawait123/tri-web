<script setup lang="ts">

const props = defineProps<{
    title?: string,
    description?: string,
    icon?: any,
}>()

const emmit = defineEmits()
const onMore = () => {
    emmit('onMore')
}
</script>


<template>
    <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg p-6">
        <div class="flex items-center mb-4">
            <component :is="props.icon" class="h-6 w-6 text-slate-600" />
            <h5 class="ml-3 text-slate-800 text-xl font-semibold">
                {{ props.title }}
            </h5>
        </div>
        <p class="block text-slate-600 leading-normal font-light mb-4">
            {{ props.description?.substring(0, 100) }} ...
        </p>
        <div>
            <button type="button" @click="onMore"
                class="text-slate-800 font-semibold text-sm hover:underline flex items-center">
                Lebih lanjut
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </div>
</template>
