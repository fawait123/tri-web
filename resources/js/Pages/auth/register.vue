<script setup lang="ts">
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { router, useForm } from '@inertiajs/vue3'
import { reactive } from 'vue'


const props = defineProps<{
    errors: any
}>()

const formRef = useForm({
    username: '',
    password: '',
    name: '',
    date_of_birth: '',
    address: '',
    email: ''
})


const onsubmit = () => {
    formRef.post('/auth/register', {
        onSuccess: () => {
            router.get('/auth/login');
        }
    })
}
</script>

<template>
    <div class="h-screen flex justify-center items-center">
        <form @submit.prevent="onsubmit">
            <Card class="mx-auto max-w-sm">
                <CardHeader>
                    <CardTitle class="text-2xl">
                        Daftar
                    </CardTitle>
                    <CardDescription>
                        Masukan data anda berdasarkan form di bawah
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="name">Nama</Label>
                            <Input id="name" type="text" v-model="formRef.name" :error-message="props.errors.name"
                                placeholder="example" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="date_of_birth">Tanggal Lahir</Label>
                            <Input id="date_of_birth" type="date" v-model="formRef.date_of_birth"
                                :error-message="props.errors.date_of_birth" placeholder="example" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="address">Alamat</Label>
                            <Input id="address" type="text" v-model="formRef.address"
                                :error-message="props.errors.address" placeholder="example" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input id="email" type="text" v-model="formRef.email" :error-message="props.errors.email"
                                placeholder="example" />
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <Label for="password">Password</Label>
                            </div>
                            <Input id="password" type="password" placeholder="******"
                                :error-message="props.errors.password" v-model="formRef.password" />
                        </div>
                        <Button type="submit" class="w-full">
                            Login
                        </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Sudah punya akun ?
                        <a href="/auth/login" class="underline">
                            Login
                        </a>
                    </div>
                </CardContent>
            </Card>
        </form>
    </div>
</template>
