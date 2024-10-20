<script setup lang="ts">
import { Eye, Pencil, Trash } from 'lucide-vue-next';


const emmit = defineEmits()


const handleEdit = () => {
    emmit('edit')
}

const handleShow = () => {
    emmit('show')
}

const handleRemove = () => {
    emmit('delete')
}
</script>

<template>
    <div class="flex gap-3">
        <Eye :size="20" @click="handleShow" class="text-slate-500 cursor-pointer" />
        <Pencil :size="20" @click="handleEdit" class="text-blue-500 cursor-pointer" />
        <Trash :size="20" @click="handleRemove" class="text-red-500 cursor-pointer" />
    </div>
</template>
