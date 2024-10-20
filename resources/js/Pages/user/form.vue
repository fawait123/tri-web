<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { IUser } from '@/interface';
import AppLayout from '@/layouts/AppLayout.vue';
import { router, useForm } from '@inertiajs/vue3';

defineOptions({
    layout: AppLayout
})

const props = defineProps<{
    errors: any,
    user: IUser | undefined,
    readonly: boolean | undefined
}>()


const userRef = useForm({
    name: props?.user?.name || '',
    email: props?.user?.email || '',
    password: ''
})


const handleBack = () => {
    router.get('/user')
}

const handleSubmit = () => {
    if (props.user) {
        userRef.put(`/user/${props.user.id}`)
    } else {
        userRef.post('/user')
    }
}
</script>

<template>
    <div class="flex justify-center items-center">
        <Card class="w-full sm:max-w-[40%] sm:min-w-[40%]">
            <CardHeader class="px-7">
                <CardTitle>Kelola Pengguna</CardTitle>
                <CardDescription>
                    Halaman untuk kelola pengguna
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="handleSubmit">
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="Nama">Nama</Label>
                            <Input v-model="userRef.name" :error-message="props.errors.name"
                                :disabled="props.readonly ?? false" placeholder="Masukan nama" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="Email">Email</Label>
                            <Input v-model="userRef.email" :disabled="props.readonly ?? false"
                                :error-message="props.errors.email" placeholder="Masukan email" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="Password">Password</Label>
                            <Input v-model="userRef.password" :disabled="props.readonly ?? false"
                                :error-message="props.errors.password" placeholder="Masukan password" />
                        </div>
                        <div class="flex gap-4">
                            <Button type="button" variant="outline" @click="handleBack">Kembali</Button>
                            <Button type="submit" :class="{ 'pointer-events-none': props.readonly }">{{ props.user ?
                                'Ubah' : 'Tambah'
                                }}</Button>
                        </div>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
