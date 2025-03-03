<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { QuillEditor } from '@vueup/vue-quill';
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import { IEducation } from '@/interface';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';


const props = defineProps<{
    education?: IEducation,
    editable: boolean
}>()

const formRef = useForm({
    title: props.education ? props.education.title : 'Title Content',
    body: props.education ? props.education.body : ''
})

const toolbarOptions = ref({
    modules: {
        toolbar: ['bold', 'italic', 'underline', 'blockquote', 'code-block', 'link', 'image', { 'header': 1 }, { 'header': 2 }, { 'script': 'sub' }, { 'script': 'super' }, { 'align': [] }, 'clean'],
    },
})

const handleChangeTitle = (event: Event) => {
    const target = event.target as HTMLElement;
    formRef.title = target.innerText; // Bind innerText to reactive variable
}

const handleSubmit = () => {
    if (props.education) {
        formRef.put('/education/' + props.education.id, {
            onSuccess: () => {
                router.get('/education')
            }
        })
    } else {
        formRef.post('/education', {
            onSuccess: () => {
                router.get('/education')
            }
        })
    }
}

const handleBack = () => {
    router.get('/education')
}

defineOptions({
    layout: AppLayout
})
</script>

<template>
    <div>
        <Card>
            <CardHeader class="px-7">
                <CardTitle>Menggosok Edukasi</CardTitle>
                <CardDescription>
                    Tambahkan konten edukasi dibawah ini
                </CardDescription>
            </CardHeader>
            <CardContent>
                <div class="grid gap-2 mb-4">
                            <Label for="Email">Judul Konten</Label>
                            <Input v-model="formRef.title" :disabled="!props.editable"
                                 placeholder="Masukan judul konten" />
                        </div>
                <QuillEditor v-model:content="formRef.body" content-type="html" :read-only="!editable"
                    :placeholder="props.education ? '' : 'Tulis disini...'" theme="snow" :options="toolbarOptions"
                    class="min-h-[300px]" />
            </CardContent>
            <CardFooter class="flex justify-end">
                <div>
                    <Button type="button" @click="handleBack" v-show="!editable" variant="outline">Kembali</Button>
                    <Button type="button" @click="handleSubmit" v-show="editable">{{ props.education ? 'Ubah' : 'Tambah'
                        }}</Button>
                </div>
            </CardFooter>
        </Card>
    </div>
</template>
<style scoped>
.bg-red {
    background: 'red' !important;
}

.z-index {
    z-index: 999999;
}
</style>
