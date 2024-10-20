<script setup lang="ts">
import { router } from '@inertiajs/vue3';

const toRegister = () => {
    router.get('/auth/register')
}
</script>


<template>
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
        <div class="hidden sm:mb-8 sm:flex sm:justify-center">
            <div
                class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                Daftar sekarang untuk mendapatkan fitur lebih banyak <button type="button" @click="toRegister"
                    class="font-semibold text-indigo-600"><span class="absolute inset-0"
                        aria-hidden="true"></span>Daftar Sekarang <span aria-hidden="true">&rarr;</span></button>
            </div>
        </div>
        <div class="text-center">
            <h1 class="text-balance text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Kesehatan Gigi, Ibu
                Hamil</h1>
            <p class="mt-6 text-lg leading-8 text-gray-600">Dapatkan informasi lengkap tentang setiap tahap kehamilan,
                termasuk perkembangan janin, perubahan fisik, dan tips kesehatan. Pelajari tentang nutrisi, olahraga,
                dan cara merawat diri selama masa hamil.</p>
            <p class="mt-6 text-lg leading-8 text-gray-600">Menjaga kesehatan gigi sangat penting selama kehamilan.
                Aplikasi kami menyediakan panduan tentang cara merawat gigi dan gusi, termasuk teknik menyikat gigi yang
                tepat dan pentingnya pemeriksaan gigi secara rutin.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="#"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get
                    started</a>
                <button type="button" @click="toRegister" class="text-sm font-semibold leading-6 text-gray-900">Daftar
                    Sekarang <span aria-hidden="true">→</span></button>
            </div>
        </div>
    </div>
</template>
