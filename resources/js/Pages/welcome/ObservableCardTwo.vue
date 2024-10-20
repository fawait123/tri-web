<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import WelcomeLayout from '@/layouts/WelcomeLayout.vue';
import { router, useForm } from '@inertiajs/vue3';
import { observasiListTwo } from '@/constant'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import Input from '@/components/ui/input/Input.vue';


const props = defineProps<{
    type: string
}>()
defineOptions({
    layout: WelcomeLayout
})

const formRef = useForm([
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    },
    {
        value: ''
    }
])


const handleSubmit = () => {
    formRef.post('/welcome/observable/' + props.type, {
        onProgress: () => {
            console.log('Loading...')
        }
    })
}


</script>


<template>
    <div class="w-[50vw] mt-10">
        <Card>
            <CardHeader>
                <CardTitle>
                    Lembar Observasi Sikap Ibu Hamil dalam mencegah karies gigi
                </CardTitle>
                <CardDescription>
                    <span class="block mb-2">Berilah tandaceklis(√)pada kolom jawaban dibawah yang dianggap paling
                        sesuai; Keterangan:</span>
                    <div class="grid gap-2">
                        <span class="block"><b>SS:</b> Sangat Setuju</span>
                        <span class="block"><b>S:</b> Setuju</span>
                        <span class="block"><b>TS:</b> Tidak Setuju</span>
                        <span class="block"><b>STS:</b> Sangat Tidak Setuju</span>
                    </div>
                </CardDescription>
            </CardHeader>
            <CardContent>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[60%]">
                                Pertanyaan
                            </TableHead>
                            <TableHead>SS</TableHead>
                            <TableHead>S</TableHead>
                            <TableHead>TS</TableHead>
                            <TableHead>STS</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="(item, index) in observasiListTwo" :key="item.list">
                            <TableCell class="font-medium">
                                {{ item.list }}
                            </TableCell>
                            <TableCell>
                                <Input type="radio" v-model="formRef[index].value" :name="`${index}`" value="SS"
                                    class="w-4" />
                            </TableCell>
                            <TableCell>
                                <Input type="radio" v-model="formRef[index].value" :name="`${index}`" value="S"
                                    class="w-4" />
                            </TableCell>
                            <TableCell>
                                <Input type="radio" v-model="formRef[index].value" :name="`${index}`" value="TS"
                                    class="w-4" />
                            </TableCell>
                            <TableCell>
                                <Input type="radio" v-model="formRef[index].value" :name="`${index}`" value="STS"
                                    class="w-4" />
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </CardContent>
            <CardFooter class="flex justify-end gap-3">
                <Button type="button" @click="router.get('/')" variant="outline">Kembali</Button>
                <Button type="button" @click="handleSubmit">Simpan</Button>
            </CardFooter>
        </Card>
    </div>
</template>
