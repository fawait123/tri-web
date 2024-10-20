<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import WelcomeLayout from '@/layouts/WelcomeLayout.vue';
import { router } from '@inertiajs/vue3';
defineOptions({
    layout: WelcomeLayout
})
</script>


<template>
    <div class="w-[50vw] mt-10">
        <Card>
            <CardHeader>
                <CardTitle>
                    Video Animasi
                </CardTitle>
                <CardDescription>
                    video animasi kesehatan ibu hamil
                </CardDescription>
            </CardHeader>
            <CardContent>
                <iframe class="w-full aspect-video"
                    src="https://www.youtube.com/embed/3udU4zynr0Y?si=nUi4FDHBOatyUj-G"></iframe>
            </CardContent>
            <CardFooter class="flex justify-end">
                <Button type="button" @click="router.get('/')" variant="outline">Kembali</Button>
            </CardFooter>
        </Card>
    </div>
</template>
