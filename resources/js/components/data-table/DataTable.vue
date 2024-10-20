<script setup lang="ts">
import type {
    ColumnFiltersState,
    ExpandedState,
    SortingState,
    VisibilityState,
} from '@tanstack/vue-table'
import {
    FlexRender,
    getCoreRowModel,
    getExpandedRowModel,
    getFilteredRowModel,
    getPaginationRowModel,
    getSortedRowModel,
    useVueTable,
} from '@tanstack/vue-table'
import { Filter } from 'lucide-vue-next'

import { ref } from 'vue'
import {
    DropdownMenu,
    DropdownMenuCheckboxItem,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import { cn, valueUpdater } from '@/lib/utils'
import DataTablePagination from './DataTablePagination.vue'

const props = withDefaults(defineProps<{
    columns: any,
    data: any,
    total: number,
    currentPage: number
}>(), {
})

const emmit = defineEmits()

const sorting = ref<SortingState>([])
const columnFilters = ref<ColumnFiltersState>([])
const columnVisibility = ref<VisibilityState>({})
const rowSelection = ref({})
const expanded = ref<ExpandedState>({})

const updatePage = (currnetPage: number) => {
    emmit('updatePage', currnetPage)
}

const table = useVueTable({
    data: props.data,
    columns: props.columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    getExpandedRowModel: getExpandedRowModel(),
    onSortingChange: updaterOrValue => valueUpdater(updaterOrValue, sorting),
    onColumnFiltersChange: updaterOrValue => valueUpdater(updaterOrValue, columnFilters),
    onColumnVisibilityChange: updaterOrValue => valueUpdater(updaterOrValue, columnVisibility),
    onRowSelectionChange: updaterOrValue => valueUpdater(updaterOrValue, rowSelection),
    onExpandedChange: updaterOrValue => valueUpdater(updaterOrValue, expanded),
    state: {
        get sorting() { return sorting.value },
        get columnFilters() { return columnFilters.value },
        get columnVisibility() { return columnVisibility.value },
        get rowSelection() { return rowSelection.value },
        get expanded() { return expanded.value },
        columnPinning: {
            left: ['status'],
        },
    },
})
</script>

<template>
    <div class="w-full">
        <div class="flex gap-2 items-center py-4 justify-between">
            <div class="flex gap-3 items-center">
                <slot name="addbutton"></slot>
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Filter class="text-primary" />
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuCheckboxItem
                            v-for="column in table.getAllColumns().filter((column: any) => column.getCanHide())"
                            :key="column.id" class="capitalize" :checked="column.getIsVisible()" @update:checked="(value: any) => {
                                column.toggleVisibility(!!value)
                            }">
                            {{ column.id }}
                        </DropdownMenuCheckboxItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>
            <slot name="search"></slot>
        </div>
        <div class="rounded-md">
            <Table>
                <TableHeader>
                    <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                        <TableHead v-for="header in headerGroup.headers" :key="header.id"
                            :data-pinned="header.column.getIsPinned()" :class="cn(
                                { 'sticky bg-background/95': header.column.getIsPinned() },
                                header.column.getIsPinned() === 'left' ? 'left-0' : 'right-0',
                            )" class="hidden sm:table-cell">
                            <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                                :props="header.getContext()" />
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <template v-if="table.getRowModel().rows?.length">
                        <template v-for="row in table.getRowModel().rows" :key="row.id">
                            <TableRow :data-state="row.getIsSelected() && 'selected'">
                                <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id"
                                    :data-pinned="cell.column.getIsPinned()" :class="cn(
                                        { 'sticky bg-background/95': cell.column.getIsPinned() },
                                        cell.column.getIsPinned() === 'left' ? 'left-0' : 'right-0',
                                    )">
                                    <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                                </TableCell>
                            </TableRow>
                            <TableRow v-if="row.getIsExpanded()">
                                <TableCell :colspan="row.getAllCells().length" class="hidden sm:table-cell">
                                    {{ row.original }}
                                </TableCell>
                            </TableRow>
                        </template>
                    </template>

                    <TableRow v-else>
                        <TableCell :colspan="columns.length" class="h-24 text-center">
                            No results.
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>

        <div class="flex flex-col items-start sm:flex-row gap-4 sm:items-center justify-end space-x-2 py-4">
            <div class="flex-1 text-sm text-muted-foreground">
                Showing {{ props.currentPage }} to
                {{ props.total }} row(s) selected.
            </div>
            <div class="space-x-2">
                <DataTablePagination :default-page="1" :page="props.currentPage" :total="props.total"
                    @updatePage="updatePage" />
            </div>
        </div>
    </div>
</template>
