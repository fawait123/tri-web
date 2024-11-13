<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import { Textarea } from '@/components/ui/textarea';
import { Checkbox } from '@/components/ui/checkbox'
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import Button from '@/components/ui/button/Button.vue';
import Dialog from '@/components/ui/dialog/Dialog.vue';
import { DialogOverlay } from 'radix-vue';
import DialogContent from '@/components/ui/dialog/DialogContent.vue';
import DialogHeader from '@/components/ui/dialog/DialogHeader.vue';
import DialogTitle from '@/components/ui/dialog/DialogTitle.vue';
import DialogDescription from '@/components/ui/dialog/DialogDescription.vue';
import { ref } from 'vue';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import { router, useForm } from '@inertiajs/vue3';
import moment from 'moment';

const getStatus = (data: any) => {
    if (data.is_morning) {
        return 'Pagi'
    } else if (data.is_afternoon) {
        return 'Siang'
    } else if (data.is_evening) {
        return 'Malam';
    } else {
        return ''
    }
}

const props = defineProps<{
    data: any
}>()

const editedData = ref<any | null>(null)

const formRef = useForm({
    date: '',
    note: '',
    is_morning: false,
    is_afternoon: false,
    is_evening: false
})

const openModal = ref<boolean>(false)
const handleDayClick = (arg: any) => {
    formRef.date = arg.dateStr
    openModal.value = true;
}

const eventClick = (arg: any) => {
    const dateEdited = arg.event.extendedProps
    const date = moment(arg.event.start).format('YYYY-MM-DD')
    formRef.date = date
    formRef.note = arg.event.title
    formRef.is_morning = dateEdited.is_morning == 1
    formRef.is_afternoon = dateEdited.is_afternoon == 1
    formRef.is_evening = dateEdited.is_evening == 1
    editedData.value = dateEdited
    openModal.value = true;
}

const openChange = () => {
    openModal.value = false;
}


const calendarOptions = {
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    dateClick: handleDayClick,
    eventClick: eventClick,
    events: props.data.map((item: any) => ({ ...item, title: item.note, date: item.date, dataId: item.id })),
    eventBackgroundColor: 'hsl(var(--primary))',
    eventBorderColor: 'hsl(var(--primary))',
    eventLimit: true, // If you set a number it will hide the itens
    eventLimitText: "Something",
    dayMaxEvents: 3 // Can also be set as a boolean
}

const handleSubmit = () => {
    if (!editedData.value) {
        formRef.post('/brushing-teeth', {
            onFinish: () => {
                router.get('/brushing-teeth')
            }
        })
    } else {
        formRef.put('/brushing-teeth/' + editedData.value.dataId, {
            onFinish: () => {
                router.get('/brushing-teeth')
            }
        })
    }
}

const handleRemove = () => {
    router.delete('/brushing-teeth/' + editedData.value.dataId, {
        onFinish: () => {
            router.get('/brushing-teeth');
        },
        onError: (err) => {
            console.log(err)
        }
    })
}

defineOptions({
    layout: AppLayout
})
</script>

<template>
    <div>
        <div>
            <Dialog :open="openModal" @update:open="openChange">
                <DialogOverlay />
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>{{ editedData ? 'Ubah' : 'Tambah' }} Data</DialogTitle>
                        <DialogDescription>
                            <form @submit.prevent="handleSubmit">
                                <div class="grid gap-4 mt-8">
                                    <div class="grid gap-2">
                                        <Label for="Tanggal">Tanggal</Label>
                                        <Input type="date" readonly placeholder="Masukan Tanggal"
                                            v-model="formRef.date" />
                                    </div>
                                    <div class="grid gap-2">
                                        <Label for="Nama">Keterangan</Label>
                                        <Textarea v-model="formRef.note" placeholder="Masukan catatan anda"></Textarea>
                                    </div>
                                    <div class="grid grid-cols-3">
                                        <div class="flex gap-2">
                                            <Checkbox id="pagi" :checked="formRef.is_morning"
                                                @update:checked="(value: boolean) => formRef.is_morning = value" />
                                            <label for="pagi"
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                Pagi
                                            </label>
                                        </div>
                                        <div class="flex gap-2">
                                            <Checkbox :checked="formRef.is_afternoon"
                                                @update:checked="(value: boolean) => formRef.is_afternoon = value"
                                                id="siang" />
                                            <label for="siang"
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                Siang
                                            </label>
                                        </div>
                                        <div class="flex gap-2">
                                            <Checkbox :checked="formRef.is_evening"
                                                @update:checked="(value: boolean) => formRef.is_evening = value"
                                                id="malam" />
                                            <label for="malam"
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                Malam
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <Button type="submit">{{ editedData ? 'Ubah' : 'Tambah' }} </Button>
                                        <Button variant="secondary" type="button" @click="handleRemove"
                                            v-show="editedData">Hapus</Button>
                                    </div>
                                </div>
                            </form>
                        </DialogDescription>
                    </DialogHeader>
                </DialogContent>
            </Dialog>
        </div>
        <Card>
            <CardHeader class="px-7">
                <CardTitle>Menggosok Gigi</CardTitle>
                <CardDescription>
                    Halaman untuk Menggosok Gigi
                </CardDescription>
            </CardHeader>
            <CardContent>
                <FullCalendar :options="calendarOptions">
                    <template v-slot:eventContent='arg'>
                        <span class="text-[12px] cursor-pointer">{{ arg.event.title }}</span>
                    </template>
                </FullCalendar>
            </CardContent>
        </Card>
    </div>
</template>
