<script setup lang="ts">
import {
    Menu,
    Package2,
} from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { menuItem } from '@/constant';
import { Link, usePage } from '@inertiajs/vue3';
import { cn } from '@/lib/utils'
import { activeLinks } from '@/helpers/index'

const emmit = defineEmits()
const page = usePage()

const handleClick = () => {
    emmit('onClick')
}
</script>
<template>
    <div class="flex gap-4 flex-col">
        <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
            <a href="/" class="flex items-center gap-2 font-semibold">
                <Package2 class="h-6 w-6" />
                <span class="">Acme Inc</span>
            </a>
            <Button variant="outline" size="icon" class="ml-auto h-8 w-8" @click="handleClick">
                <Menu class="h-4 w-4" />
                <span class="sr-only">Toggle notifications</span>
            </Button>
        </div>
        <div class="flex-1">
            <nav class="grid items-start px-2 text-sm font-medium lg:px-4 gap-4">
                <Link :href="menu.link" v-for="menu in menuItem" :key="menu.link"
                    :class="cn('flex items-center gap-3 rounded-lg px-3 py-2 transition-all hover:text-primary', activeLinks(menu.activeLink, page.url) ? 'text-primary' : 'text-muted-foreground')">
                <component class="h-4 w-4" :is="menu.icon" />
                {{ menu.label }}
                </Link>
            </nav>
        </div>
    </div>
</template>
