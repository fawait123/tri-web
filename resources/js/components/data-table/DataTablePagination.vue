<script setup lang="ts">
import {
    Pagination,
    PaginationEllipsis,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
} from '@/components/ui/pagination'

import {
    Button,
} from '@/components/ui/button'

const props = withDefaults(defineProps<{
    page: number,
    total: number,
    defaultPage: number
}>(), {
    page: 1,
    total: 1,
    defaultPage: 1
})

const emmit = defineEmits()

const handlePagination = (currentPage: number) => {
    emmit('updatePage', currentPage);
}
</script>

<template>
    <Pagination v-slot="{ page }" @update:page="handlePagination" :page="props.page" :total="props.total"
        :sibling-count="1" show-edges :default-page="props.defaultPage">
        <PaginationList v-slot="{ items }" class="flex items-center gap-1">
            <PaginationFirst />
            <PaginationPrev />

            <template v-for="(item, index) in items">
                <PaginationListItem v-if="item.type === 'page'" :key="index" :value="item.value" as-child>
                    <Button class="w-10 h-10 p-0" :variant="item.value === page ? 'default' : 'outline'">
                        {{ item.value }}
                    </Button>
                </PaginationListItem>
                <PaginationEllipsis v-else :key="item.type" :index="index" />
            </template>
            <PaginationNext />
            <PaginationLast />
        </PaginationList>
    </Pagination>
</template>
