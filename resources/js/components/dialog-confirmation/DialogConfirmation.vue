<script setup lang="ts">
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import Button from '@/components/ui/button/Button.vue';
import { ref } from 'vue';
import { DialogOverlay } from 'radix-vue';

const props = defineProps<{
    title?: string,
    body?: string,
    defaultOpen: boolean
}>()

const emmit = defineEmits()

const isOpen = ref<boolean>(props.defaultOpen)

const onConfirm = () => {
    emmit('onConfirm')
}

const openChange = () => {
    isOpen.value = false
    console.log('open change')
}

</script>

<template>
    <Dialog :open="isOpen" @update:open="openChange">
        <DialogOverlay />
        <DialogContent>
            <DialogHeader>
                <DialogTitle>{{ props.title }}</DialogTitle>
                <DialogDescription>
                    {{ props.body }}
                </DialogDescription>
            </DialogHeader>

            <DialogFooter>
                <Button type="button" @click="onConfirm">Hapus</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
