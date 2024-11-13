<script setup lang="ts">
import {
    Settings,
    Menu,
} from 'lucide-vue-next'
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from '@/components/ui/tooltip'
import { menuItem } from '@/constant';
import { Link, usePage } from '@inertiajs/vue3';
import { cn } from '@/lib/utils'
import { activeLinks } from '@/helpers/index'

const emmit = defineEmits()

const handleClick = () => {
    emmit('onClick')
}

const page = usePage()

</script>
<template>
    <div>
        <nav class="flex flex-col items-center gap-4 px-2 sm:py-5">
            <a href="#" @click="handleClick"
                class="group flex h-9 w-9 shrink-0 items-center justify-center gap-2 rounded-full bg-primary text-lg font-semibold text-primary-foreground md:h-8 md:w-8 md:text-base">
                <Menu class="h-4 w-4 transition-all group-hover:scale-110" />
                <span class="sr-only">Acme Inc</span>
            </a>
            <TooltipProvider v-for="menu in menuItem" :key="menu.link">
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Link :href="menu.link"
                            :class="cn('flex h-9 w-9 items-center justify-center rounded-lg transition-colors hover:text-foreground md:h-8 md:w-8', activeLinks(menu.activeLink, page.url) ? 'text-primary' : 'text-muted-foreground')">
                        <component class="h-5 w-5" :is="menu.icon" />
                        <span class="sr-only">{{ menu.label }}</span>
                        </Link>
                    </TooltipTrigger>
                    <TooltipContent side="right">
                        {{ menu.label }}
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
        </nav>
    </div>
</template>
