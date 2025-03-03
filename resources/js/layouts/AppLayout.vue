<script setup lang="ts">
import {
    CircleUser,
    Package2,
    PanelLeft,
} from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbSeparator,
} from '@/components/ui/breadcrumb'
import { Sheet, SheetContent, SheetTrigger } from '@/components/ui/sheet'
import { ref } from 'vue'
import { cn } from '@/lib/utils'
import MiniSidebar from '@/layouts/MiniSidebar.vue'
import NormalSidebar from '@/layouts/NormalSidebar.vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import { menuItem } from '@/constant'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'

const props = defineProps<{
    breadcrumb: string
}>()

const isMiniSidebar = ref(true)
const handleSidebarMenuClick = () => {
    isMiniSidebar.value = !isMiniSidebar.value
}

const page: any = usePage()


const toProfile = () => {
    router.get('/profile');
}

const handleLogout = () => {
    router.post('/auth/logout', {}, {
        onSuccess: () => {
            router.get('/auth/login');
        }
    })
}

</script>

<template>
    <div class="flex min-h-screen w-full flex-col bg-muted/40">
        <aside
            :class="cn('fixed inset-y-0 left-0 z-10 hidden flex-col border-r bg-background sm:flex transition-all', isMiniSidebar ? 'w-14' : 'w-[279px]')">
            <component :is="isMiniSidebar ? MiniSidebar : NormalSidebar" @onClick="handleSidebarMenuClick"
                key="sidebar-menu" />
        </aside>
        <div :class="cn('flex flex-col sm:gap-4 transition-all', isMiniSidebar ? 'sm:pl-14' : 'sm:pl-[279px]')">
            <header
                class="sticky top-0 z-30 flex h-14 justify-between items-center gap-4 border-b bg-background px-4 lg:h-[60px] lg:px-6">
                <Sheet>
                    <SheetTrigger as-child>
                        <Button size="icon" variant="outline" class="sm:hidden">
                            <PanelLeft class="h-5 w-5" />
                            <span class="sr-only">Toggle Menu</span>
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left" class="sm:max-w-xs">
                        <nav class="grid gap-6 text-lg font-medium">
                            <a href="#"
                                class="group flex h-10 w-10 shrink-0 items-center justify-center gap-2 rounded-full bg-primary text-lg font-semibold text-primary-foreground md:text-base">
                                <Package2 class="h-5 w-5 transition-all group-hover:scale-110" />
                                <span class="sr-only">Acme Inc</span>
                            </a>
                            <Link :href="menu.link" v-for="menu in menuItem" :key="menu.label"
                                class="flex items-center gap-4 px-2.5 text-muted-foreground hover:text-foreground">
                            <component :is="menu.icon" class="h-5 w-5" />
                            {{ menu.label }}
                            </Link>
                        </nav>
                    </SheetContent>
                </Sheet>
                <Breadcrumb class="hidden md:flex">
                    <BreadcrumbList>
                        <BreadcrumbItem>
                            <BreadcrumbLink as-child>
                                <span class="font-bold text-muted-foreground">Halaman</span>
                            </BreadcrumbLink>
                        </BreadcrumbItem>
                        <BreadcrumbSeparator />
                        <BreadcrumbItem>
                            <BreadcrumbLink as-child>
                                <span class="font-bold text-slate-950">{{ props.breadcrumb }}</span>
                            </BreadcrumbLink>
                        </BreadcrumbItem>
                    </BreadcrumbList>
                </Breadcrumb>
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Avatar class="mr-6 cursor-pointer">
                            <AvatarImage src="https://pics.craiyon.com/2023-10-25/b65f72d6d11a48c1bc560059cc36e31f.webp"
                                alt="@radix-vue" />
                            <AvatarFallback>AV</AvatarFallback>
                        </Avatar>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuLabel>{{ page.props?.auth?.user?.email || 'My Account' }}</DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem @click="toProfile">Profile</DropdownMenuItem>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem @click="handleLogout">Logout</DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </header>
            <main class="w-full sm:px-6 sm:py-0">
                <slot />
            </main>
        </div>
    </div>
</template>
