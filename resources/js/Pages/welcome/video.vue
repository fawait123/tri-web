<script setup lang="ts">
import Button from "@/components/ui/button/Button.vue";
import Card from "@/components/ui/card/Card.vue";
import CardContent from "@/components/ui/card/CardContent.vue";
import CardDescription from "@/components/ui/card/CardDescription.vue";
import CardFooter from "@/components/ui/card/CardFooter.vue";
import CardHeader from "@/components/ui/card/CardHeader.vue";
import CardTitle from "@/components/ui/card/CardTitle.vue";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import WelcomeLayout from "@/layouts/WelcomeLayout.vue";
import { router } from "@inertiajs/vue3";

interface IVideo {
    filename: string;
}
defineOptions({
    layout: WelcomeLayout,
});
const props = defineProps<{
    videos: IVideo[];
}>();
</script>

<template>
    <div class="w-[50vw] mt-10">
        <Card>
            <CardHeader>
                <CardTitle> Video Animasi </CardTitle>
                <CardDescription>
                    video animasi kesehatan ibu hamil
                </CardDescription>
            </CardHeader>
            <CardContent>
                <Tabs
                    default-value="video/ANIMASI IBU HAMIL.mp4"
                    class="w-full"
                >
                    <TabsList>
                        <TabsTrigger
                            :value="video.filename"
                            v-for="video in props.videos"
                            :key="video.filename"
                        >
                            {{
                                video.filename
                                    .replace("video/", "")
                                    .replace(".mp4", "")
                            }}
                        </TabsTrigger>
                    </TabsList>
                    <TabsContent
                        v-for="video in props.videos"
                        :key="video.filename"
                        :value="video.filename"
                    >
                        <video class="w-full aspect-video my-8" controls>
                            <source
                                :src="`/${video.filename}`"
                                type="video/mp4"
                            />
                            Your browser does not support the video tag.
                        </video>
                    </TabsContent>
                </Tabs>
            </CardContent>
            <CardFooter class="flex justify-end">
                <Button type="button" @click="router.get('/')" variant="outline"
                    >Kembali</Button
                >
            </CardFooter>
        </Card>
    </div>
</template>
