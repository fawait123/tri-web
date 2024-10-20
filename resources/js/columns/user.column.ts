import { IUser } from "@/interface"
import { createColumnHelper } from "@tanstack/vue-table"
import { h } from "vue"
import DropdownAction from '@/components/data-table/DataTableColumn.vue'

const columnHelper = createColumnHelper<IUser>()
export const columns = [
    columnHelper.accessor('name', {
        enablePinning: true,
        header: 'Nama',
        cell: ({ row }) => h('div', { class: 'capitalize' }, row.getValue('name')),
    }),
    columnHelper.display({
        id: 'actions',
        enableHiding: false,
        cell: ({ row }) => {
            const payment = row.original

            return h('div', { class: 'relative' }, h(DropdownAction, {
                payment,
                onExpand: row.toggleExpanded,
            }))
        },
    }),
]
