<script setup lang="ts">
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';

defineProps<{
    question: string
    options: any[],
    name: string,
    parentIndex: number
}>()

const model = defineModel()

const emmit = defineEmits()

const onInput = (value: any, parentIndex: number) => {
    emmit('onInput', value, parentIndex)
}
</script>

<template>
    <div class="mb-4">
        <h6 class="font-semibold">{{ question }}</h6>
        <div class="flex flex-row items-center gap-2 ml-3" v-for="(option, index) in options" :key="index">
            <Input :id="name" class="w-4" type="radio" placeholder="example" :name="name"
                @input="onInput(option, parentIndex)" :value="option.key" v-model="model" />
            <Label :for="name" class="text-xs">{{ option.value }}</Label>
        </div>
    </div>
</template>
