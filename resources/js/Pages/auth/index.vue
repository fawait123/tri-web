<script setup lang="ts">
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { router } from '@inertiajs/vue3'
import { reactive } from 'vue'


const props = defineProps<{
    errors: any
}>()

const formRef = reactive({
    username: '',
    password: ''
})


const onsubmit = () => {
    router.post('/auth/login', formRef)
}
</script>

<template>
    <div class="h-screen flex justify-center items-center">
        <form @submit.prevent="onsubmit">
            <Card class="mx-auto max-w-sm">
                <CardHeader>
                    <CardTitle class="text-2xl">
                        Login
                    </CardTitle>
                    <CardDescription>
                        Enter your email below to login to your account
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="Username">Username</Label>
                            <Input id="Username" type="text" v-model="formRef.username"
                                :error-message="props.errors.username" placeholder="example" />
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <Label for="password">Password</Label>
                                <a href="#" class="ml-auto inline-block text-sm underline">
                                    Forgot your password?
                                </a>
                            </div>
                            <Input id="password" type="password" placeholder="******"
                                :error-message="props.errors.password" v-model="formRef.password" />
                        </div>
                        <Button type="submit" class="w-full">
                            Login
                        </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Tidak punya akun ?
                        <a href="/auth/register" class="underline">
                            Daftar
                        </a>
                    </div>
                </CardContent>
            </Card>
        </form>
    </div>
</template>
