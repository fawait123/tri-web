<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { useVModel } from '@vueuse/core'
import { cn } from '@/lib/utils'

const props = defineProps<{
    defaultValue?: string | number
    modelValue?: string | number
    class?: HTMLAttributes['class'],
    errorMessage?: string,
    type?: string
    placeholder?: string,
    disabled?: boolean,
    readonly?: boolean,
    name?: string
    value?: string
}>()

const emits = defineEmits<{
    (e: 'update:modelValue', payload: string | number): void
}>()

const modelValue = useVModel(props, 'modelValue', emits, {
    passive: true,
    defaultValue: props.defaultValue,
})
</script>

<template>
    <div>
        <input v-if="value" :value="value" :name="name" :readonly="props.readonly" v-model="modelValue"
            :disabled="props.disabled" :type="type ? type : 'text'" :placeholder="placeholder"
            :class="cn('flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50', props.class)">
        <input v-else :name="name" :readonly="props.readonly" v-model="modelValue" :disabled="props.disabled"
            :type="type ? type : 'text'" :placeholder="placeholder"
            :class="cn('flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50', props.class)">
        <span class="text-red-500 text-sm text-[11px]" v-show="errorMessage">{{ errorMessage }}</span>
    </div>
</template>
