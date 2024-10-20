<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const props = defineProps<{
    errors: any,
}>()

const page: any = usePage()

const formRef = useForm({
    name: page.props.auth.user.name,
    email: page.props.auth.user.email,
    date_of_birth: page.props.auth.user.date_of_birth,
    address: page.props.auth.user.address
})

const passwordRef = useForm({
    old_password: '',
    new_password: ''
})

const updateProfile = () => {
    formRef.post('/auth/update-profile', {
        onProgress: () => {
            console.log('loading...')
        }
    })
}
</script>


<template>
    <div class="grid gap-20">
        <Card>
            <CardHeader>
                <CardTitle>Informasi Pengguna</CardTitle>
                <CardDescription>
                    Detail informasi pengguna
                </CardDescription>
            </CardHeader>
            <CardContent>
                <div class="grid gap-4">
                    <div class="grid gap-2">
                        <Label for="name">Nama</Label>
                        <Input id="name" type="text" v-model="formRef.name" :error-message="props?.errors?.name"
                            placeholder="Masukan nama anda" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input id="email" type="text" v-model="formRef.email" :error-message="props?.errors?.email"
                            placeholder="Masukan nama anda" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="date_of_birth">Tanggal Lahir</Label>
                        <Input type="date" id="date_of_birth" v-model="formRef.date_of_birth"
                            :error-message="props?.errors?.date_of_birth" placeholder="Masukan nama anda" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="address">Alamat</Label>
                        <Input id="address" type="text" v-model="formRef.address"
                            :error-message="props?.errors?.address" placeholder="Masukan nama anda" />
                    </div>
                </div>
            </CardContent>
            <CardFooter class="flex justify-end">
                <Button type="button" @click="updateProfile">Simpan</Button>
            </CardFooter>
        </Card>
        <Card>
            <CardHeader>
                <CardTitle>Ubah Password</CardTitle>
                <CardDescription>
                    Silahkan masukan password baru anda jika ingin mengubah password
                </CardDescription>
            </CardHeader>
            <CardContent>
                <div class="grid gap-4">
                    <div class="grid gap-2">
                        <Label for="old_password">Password Lama</Label>
                        <Input id="old_password" type="text" v-model="passwordRef.old_password"
                            :error-message="props?.errors?.old_password" placeholder="******" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="new_password">Password Baru</Label>
                        <Input id="new_password" type="text" v-model="passwordRef.new_password"
                            :error-message="props?.errors?.new_password" placeholder="******" />
                    </div>
                </div>
            </CardContent>
            <CardFooter class="border-t px-6 py-4">
                <Button>Save</Button>
            </CardFooter>
        </Card>
    </div>
</template>
