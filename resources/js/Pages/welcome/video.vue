<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
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
                <Tabs default-value="account" class="w-full">
                    <TabsList>
                        <TabsTrigger value="account">
                            Edukasi Kesehatan Gigi
                        </TabsTrigger>
                        <TabsTrigger value="password">
                            Cara Sikat Gigi
                        </TabsTrigger>
                    </TabsList>
                    <TabsContent value="account">
                        <video class="w-full aspect-video my-8" controls>
                            <source src="/video/animasi-ibu-hamil.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </TabsContent>
                    <TabsContent value="password">
                        <video class="w-full aspect-video my-8" controls>
                            <source src="/video/cara-sikat-gigi.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </TabsContent>
                </Tabs>
            </CardContent>
            <CardFooter class="flex justify-end">
                <Button type="button" @click="router.get('/')" variant="outline">Kembali</Button>
            </CardFooter>
        </Card>
    </div>
</template>
