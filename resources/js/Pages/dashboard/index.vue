<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import {
    BellRing,
    Copy,
} from 'lucide-vue-next'

import { Badge } from '@/components/ui/badge'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card'
import { Progress } from '@/components/ui/progress'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from '@/components/ui/tabs'
import { router, usePage } from '@inertiajs/vue3';

const page: any = usePage();

const currentParam = page.props.params

defineOptions({
    layout: AppLayout
})

const props = defineProps<{
    totalUser: number,
    totalEducation: number,
    quiz: any,
    observable: any,
    quizActivity: any,
    observableActivity: any,
    notifications: Record<string, any>[]
}>()


</script>

<template>
    <div class="grid flex-1 items-start gap-4 p-4 md:gap-8 lg:grid-cols-3 xl:grid-cols-3">
        <div class="grid auto-rows-max items-start gap-4 md:gap-8 lg:col-span-2">
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-2 xl:grid-cols-4">
                <Card class="sm:col-span-2">
                    <CardHeader class="pb-2">
                        <CardDescription>Jumlah Pengguna</CardDescription>
                        <CardTitle class="text-4xl">
                            {{ props.totalUser }}
                        </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="text-xs text-muted-foreground">
                            {{ new Date().toDateString() }}
                        </div>
                    </CardContent>
                    <CardFooter>
                        <Progress :model-value="(props.totalUser / (props.totalUser + props.totalEducation)) * 100"
                            aria-label="25% increase" />
                    </CardFooter>
                </Card>
                <Card class="sm:col-span-2">
                    <CardHeader class="pb-2">
                        <CardDescription>Jumlah Konten Edukasi</CardDescription>
                        <CardTitle class="text-4xl">
                            {{ props.totalEducation }}
                        </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="text-xs text-muted-foreground">
                            {{ new Date().toDateString() }}
                        </div>
                    </CardContent>
                    <CardFooter>
                        <Progress :model-value="(props.totalEducation / (props.totalUser + props.totalEducation)) * 100"
                            aria-label="25% increase" />
                    </CardFooter>
                </Card>
            </div>
            <Tabs default-value="week">
                <div class="flex items-center">
                    <TabsList>
                        <TabsTrigger value="week">
                            Kuisioner
                        </TabsTrigger>
                    </TabsList>
                </div>
                <TabsContent value="week">
                    <Card>
                        <CardHeader class="px-7">
                            <CardTitle>Kuesioner</CardTitle>
                            <CardDescription>
                                Kuesioner pengetahuan kesehatan gigi dan mulut ibu hamil
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Nama</TableHead>
                                        <TableHead class="hidden sm:table-cell">
                                            Tipe
                                        </TableHead>
                                        <TableHead class="hidden sm:table-cell">
                                            Score
                                        </TableHead>
                                        <TableHead class="hidden md:table-cell">
                                            Grade
                                        </TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    <TableRow class="bg-accent" v-for="item in props.quiz.data">
                                        <TableCell>
                                            <div class="font-medium">
                                                {{ item.user.name }}
                                            </div>
                                            <div class="hidden text-sm text-muted-foreground md:inline">
                                                {{ item.user.email }}
                                            </div>
                                        </TableCell>
                                        <TableCell class="hidden sm:table-cell">
                                            <Badge class="text-xs" variant="default" v-if="item.type == 'pre-test'">
                                                Pre Test
                                            </Badge>
                                            <Badge class="text-xs bg-blue-500" variant="default" v-else>
                                                Post Test
                                            </Badge>
                                        </TableCell>
                                        <TableCell class="hidden sm:table-cell">
                                            <Badge class="text-xs" variant="secondary">
                                                {{ item.score }}
                                            </Badge>
                                        </TableCell>
                                        <TableCell class="hidden md:table-cell">
                                            {{ item.grade }}
                                        </TableCell>
                                    </TableRow>
                                </TableBody>
                            </Table>
                        </CardContent>
                        <CardFooter class="flex justify-end">
                            <div class="flex gap-4">
                                <Button type="button"
                                    @click="router.get('/dashboard', { ...currentParam, quiz_page: props.quiz.current_page - 1 })"
                                    :disabled="props.quiz.current_page == 1 ? true : false">Prev</Button>
                                <Button type="button"
                                    @click="router.get('/dashboard', { ...currentParam, quiz_page: props.quiz.current_page + 1 })"
                                    :disabled="props.quiz.current_page == props.quiz.last_page ? true : false">Next</Button>
                            </div>
                        </CardFooter>
                    </Card>
                </TabsContent>
            </Tabs>

            <Tabs default-value="week">
                <div class="flex items-center">
                    <TabsList>
                        <TabsTrigger value="week">
                            Observasi
                        </TabsTrigger>
                    </TabsList>
                </div>
                <TabsContent value="week">
                    <Card>
                        <CardHeader class="px-7">
                            <CardTitle>Observasi</CardTitle>
                            <CardDescription>
                                Lembar Observasi Sikap Ibu Hamil dalam mencegah karies gigi
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Nama</TableHead>
                                        <TableHead class="hidden sm:table-cell">
                                            Tipe
                                        </TableHead>
                                        <TableHead class="hidden sm:table-cell">
                                            Setuju
                                        </TableHead>
                                        <TableHead class="hidden md:table-cell">
                                            Sangat Setuju
                                        </TableHead>
                                        <TableHead class="hidden md:table-cell">
                                            Tidak Setuju
                                        </TableHead>
                                        <TableHead class="hidden md:table-cell">
                                            Sangat Tidak Setuju
                                        </TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    <TableRow class="bg-accent" v-for="item in props.observable.data">
                                        <TableCell>
                                            <div class="font-medium">
                                                {{ item.user.name }}
                                            </div>
                                            <div class="hidden text-sm text-muted-foreground md:inline">
                                                {{ item.user.email }}
                                            </div>
                                        </TableCell>
                                        <TableCell class="hidden sm:table-cell">
                                            <Badge class="text-xs" variant="default" v-if="item.type == 'pre-test'">
                                                Pre Test
                                            </Badge>
                                            <Badge class="text-xs bg-blue-500" variant="default" v-else>
                                                Post Test
                                            </Badge>
                                        </TableCell>
                                        <TableCell class="hidden sm:table-cell">
                                            <Badge class="text-xs" variant="secondary">
                                                {{ item.s }}
                                            </Badge>
                                        </TableCell>
                                        <TableCell class="hidden sm:table-cell">
                                            <Badge class="text-xs" variant="secondary">
                                                {{ item.ss }}
                                            </Badge>
                                        </TableCell>
                                        <TableCell class="hidden sm:table-cell">
                                            <Badge class="text-xs" variant="secondary">
                                                {{ item.ts }}
                                            </Badge>
                                        </TableCell>
                                        <TableCell class="hidden sm:table-cell">
                                            <Badge class="text-xs" variant="secondary">
                                                {{ item.sts }}
                                            </Badge>
                                        </TableCell>
                                    </TableRow>
                                </TableBody>
                            </Table>
                        </CardContent>
                        <CardFooter class="flex justify-end">
                            <div class="flex gap-4">
                                <Button type="button"
                                    @click="router.get('/dashboard', { ...currentParam, observable_page: props.observable.current_page - 1 })"
                                    :disabled="props.observable.current_page == 1 ? true : false">Prev</Button>
                                <Button type="button"
                                    @click="router.get('/dashboard', { ...currentParam, observable_page: props.observable.current_page + 1 })"
                                    :disabled="props.observable.current_page == props.quiz.last_page ? true : false">Next</Button>
                            </div>
                        </CardFooter>
                    </Card>
                </TabsContent>
            </Tabs>
        </div>
        <div class="grid gap-8">
            <Card class="overflow-hidden">
                <CardHeader class="flex flex-row items-start bg-muted/50">
                    <div class="grid gap-0.5">
                        <CardTitle class="group flex items-center gap-2 text-lg">
                            Aktifitas Hari Ini
                            <Button size="icon" variant="outline"
                                class="h-6 w-6 opacity-0 transition-opacity group-hover:opacity-100">
                                <Copy class="h-3 w-3" />
                                <span class="sr-only"></span>
                            </Button>
                        </CardTitle>
                        <CardDescription>Date: {{ new Date().toDateString() }}</CardDescription>
                    </div>
                </CardHeader>
                <CardContent class="p-6 text-sm">
                    <div class="grid gap-3">
                        <div class="font-semibold">
                            Kuisioner
                        </div>
                        <dl class="grid gap-3" v-if="props.quizActivity.length > 0">
                            <div class="flex items-center justify-between" v-for="item in props.quizActivity">
                                <dt class="text-muted-foreground">
                                    {{ item.user.name }}
                                </dt>
                                <dd>{{ item.type == 'pre-test' ? 'Pre Test' : 'Post Test' }}</dd>
                            </div>
                        </dl>
                        <dl class="grid gap-3" v-else>
                            <dt class="text-muted-foreground">Tidak ada aktifitas</dt>
                        </dl>
                    </div>
                    <div class="grid gap-3 mt-8">
                        <div class="font-semibold">
                            Observasi
                        </div>
                        <dl class="grid gap-3" v-if="props.observableActivity.length > 0">
                            <div class="flex items-center justify-between" v-for="item in props.observableActivity">
                                <dt class="text-muted-foreground">
                                    {{ item.user.name }}
                                </dt>
                                <dd>{{ item.type == 'pre-test' ? 'Pre Test' : 'Post Test' }}</dd>
                            </div>
                        </dl>
                        <dl class="grid gap-3" v-else>
                            <dt class="text-muted-foreground">Tidak ada aktifitas</dt>
                        </dl>
                    </div>
                </CardContent>
            </Card>
            <Card class="overflow-hidden">
                <CardHeader class="flex flex-row items-start bg-muted/50">
                    <div class="grid gap-0.5">
                        <CardTitle class="group flex items-center gap-2 text-lg">
                            Pemberitahuan
                            <Button size="icon" variant="outline"
                                class="h-6 w-6 opacity-0 transition-opacity group-hover:opacity-100">
                                <Copy class="h-3 w-3" />
                                <span class="sr-only"></span>
                            </Button>
                        </CardTitle>
                        <CardDescription>
                            <span class="font-semibold text-muted-foreground"
                                v-if="props.notifications.length > 0">Total <span class="text-primary">{{
                                    props.notifications.length }}</span>
                                orang belum melakukan
                                sikat
                                gigi</span>
                        </CardDescription>
                    </div>
                </CardHeader>
                <CardContent class="p-6 text-sm">
                    <div class="grid gap-3">
                        <div class="flex gap-4 items-center" v-if="props.notifications.length > 0"
                            v-for="notification in props.notifications">
                            <BellRing class="w-[20px] text-primary" />
                            <span class="text-[14px] font-medium text-muted-foreground"><span
                                    class="font-bold text-black">{{ notification.name }}</span> belum melakukan
                                gosok gigi hari
                                ini, silahkan untuk
                                mengingatkannya</span>
                        </div>
                        <div class="flex justify-center items-center" v-else>
                            <span class="font-bold text-muted-foreground">Tidak ada pemberitahuan</span>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    </div>
</template>
