<script setup lang="ts">
import DataTable from '@/components/data-table/DataTable.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { IEducation } from "@/interface"
import { createColumnHelper } from "@tanstack/vue-table"
import { h } from "vue"
import DropdownAction from '@/components/data-table/DataTableColumn.vue'
import { router } from '@inertiajs/vue3';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import { ref } from 'vue';
import moment from 'moment'
import Dialog from '@/components/ui/dialog/Dialog.vue';
import { DialogOverlay } from 'radix-vue';
import DialogContent from '@/components/ui/dialog/DialogContent.vue';
import DialogHeader from '@/components/ui/dialog/DialogHeader.vue';
import DialogTitle from '@/components/ui/dialog/DialogTitle.vue';
import DialogDescription from '@/components/ui/dialog/DialogDescription.vue';
import DialogFooter from '@/components/ui/dialog/DialogFooter.vue';
const columnHelper = createColumnHelper<IEducation>()

const isDelete = ref<boolean>(false)
const dataToDelete = ref<IEducation | null>(null)

const columns = [
    columnHelper.accessor('title', {
        enablePinning: true,
        header: 'Judul Kontent',
        cell: ({ row }) => h('div', { class: 'capitalize' }, row.getValue('title')),
    }),
    columnHelper.accessor('published_at', {
        enablePinning: true,
        header: 'Dipublis',
        cell: ({ row }) => h('div', { class: 'capitalize' }, moment(row.getValue('published_at')).format('DD MMMM YYYY HH:m')),
    }),
    columnHelper.accessor('created_at', {
        enablePinning: true,
        header: 'Dibuat',
        cell: ({ row }) => h('div', { class: 'capitalize' }, moment(row.getValue('created_at')).format('DD MMMM YYYY HH:m')),
    }),
    columnHelper.display({
        id: 'actions',
        enableHiding: false,
        header: '#',
        cell: ({ row }) => {
            const data = row.original

            return h('div', { class: 'relative' }, h(DropdownAction, {
                onEdit: () => {
                    router.get('/education/' + data.id + '/edit')
                },
                onDelete: () => {
                    isDelete.value = true;
                    dataToDelete.value = data
                },
                onShow: () => {
                    router.get('/education/' + data.id)
                }
            }))
        },
    }),
]

const props = defineProps<{
    data: any
}>()

const data: IUser[] = props.data.data


defineOptions({
    layout: AppLayout
})

const updatePage = (currentPage: number) => {
    router.get('/education', {
        page: currentPage
    })
}

const urlParams = new URLSearchParams(window.location.search);
const search = ref<any>(urlParams.get('search') || null)

const onSearch = (event: any) => {
    router.get('/education', {
        search: event.target.value
    })
}

const gotoForm = () => {
    router.get('/education/create')
}

const handleDelete = () => {
    router.delete('/education/' + dataToDelete.value?.id)
    isDelete.value = false;
    dataToDelete.value = null
    router.get('/education')
}

const openChange = () => {
    isDelete.value = false;
    dataToDelete.value = null
}
</script>

<template>
    <div class="">
        <div>
            <Dialog :open="isDelete" @update:open="openChange">
                <DialogOverlay />
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Hapus Data ?</DialogTitle>
                        <DialogDescription>
                            Apakah anda yakin ingin menghapus data ?
                        </DialogDescription>
                    </DialogHeader>

                    <DialogFooter>
                        <Button type="button" @click="handleDelete">Hapus</Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </div>
        <Card>
            <CardHeader class="px-7">
                <CardTitle>Kelola Pengguna</CardTitle>
                <CardDescription>
                    Halaman untuk kelola pengguna
                </CardDescription>
            </CardHeader>
            <CardContent>
                <DataTable :columns="columns" :data="data" :currentPage="props.data.current_page"
                    :total="props.data.total" @updatePage="updatePage">
                    <template #addbutton>
                        <Button size="sm" @click="gotoForm">Tambah</Button>
                    </template>
                    <template #search>
                        <Input placeholder="Masukan pencarian..." v-model="search" @change="onSearch" />
                    </template>
                </DataTable>
            </CardContent>
        </Card>
    </div>
</template>
