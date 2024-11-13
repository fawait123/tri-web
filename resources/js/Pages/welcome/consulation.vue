<script setup lang="ts">
import WelcomeLayout from '@/layouts/WelcomeLayout.vue';
import { Mail, PhoneOutgoing } from 'lucide-vue-next';
defineOptions({
    layout: WelcomeLayout
})

</script>


<template>
    <div class="grid w-full min-w-[800px]">
        <div class="bg-white shadow-sm border border-slate-200 rounded-lg p-6 my-10">
            <h1 class="text-normal text-[14px]">Untuk konsultasi lebih lanjut bisa hubungi kami kontak dibawah ini</h1>

            <div class="grid gap-8 my-8">
                <div class="flex gap-4 items-center">
                    <Mail class="w-[20px] text-primary" /> <span class="font-bold  text-[14px]">mail@gmail.com</span>
                </div>
                <div class="flex gap-4 items-center">
                    <PhoneOutgoing class="w-[20px] text-primary" /> <span class="font-bold  text-[14px]">+62 879 8292
                        8292</span>
                </div>
            </div>
        </div>
    </div>
</template>
