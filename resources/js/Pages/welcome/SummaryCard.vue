<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    quiz: any,
    observableOne: any,
    observableTwo: any,
    type: string
}>()
</script>


<template>
    <div>
        <Card>
            <CardHeader>
                <CardTitle>
                    Summary
                </CardTitle>
                <CardDescription>
                    Berikut hasil dari {{ type == "pre-test" ? "Pre Test" : "Post Test" }} yang sudah anda kerjakan
                </CardDescription>
            </CardHeader>
            <CardContent>
                <div class="grid gap-8">
                    <div class="grid grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <span class="text-[14px] font-bold">Keterangan</span>
                            <span class="text-[12px]">Kuesioner pengetahuan kesehatan gigi dan mulut ibu hamil</span>
                        </div>
                        <div class="flex justify-end gap-8">
                            <div class="flex flex-col gap-2">
                                <span class="text-[14px] font-bold">Score</span>
                                <span class="text-[12px]">{{ quiz.score }}</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="text-[14px] font-bold">Grade</span>
                                <span class="text-[12px]">{{ quiz.grade }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <span class="text-[14px] font-bold">Keterangan</span>
                            <span class="text-[12px]">Lembar Observasi Sikap Ibu Hamil dalam mencegah karies
                                gigi</span>
                        </div>
                        <div class="flex justify-end gap-8">
                            <div class="flex flex-col gap-2">
                                <span class="text-[14px] font-bold">Sangat Setuju</span>
                                <span class="text-[12px]">{{ observableOne.ss }}</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="text-[14px] font-bold">Setuju</span>
                                <span class="text-[12px]">{{ observableOne.s }}</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="text-[14px] font-bold">Tidak Setuju</span>
                                <span class="text-[12px]">{{ observableOne.ts }}</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="text-[14px] font-bold">Sangat Tidak Setuju</span>
                                <span class="text-[12px]">{{ observableOne.sts }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <span class="text-[14px] font-bold">Keterangan</span>
                            <span class="text-[12px]">Lembar Observasi Keterampilan Menggosok Gigi Pada Ibu Hamil
                                Berilah tanda ceklis (√) pada kolom yang dilakukan</span>
                        </div>
                        <div class="flex justify-end gap-8">
                            <div class="flex flex-col gap-2">
                                <span class="text-[14px] font-bold">Sangat Setuju</span>
                                <span class="text-[12px]">{{ observableTwo.ss }}</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="text-[14px] font-bold">Setuju</span>
                                <span class="text-[12px]">{{ observableTwo.s }}</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="text-[14px] font-bold">Tidak Setuju</span>
                                <span class="text-[12px]">{{ observableTwo.ts }}</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <span class="text-[14px] font-bold">Sangat Tidak Setuju</span>
                                <span class="text-[12px]">{{ observableTwo.sts }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </CardContent>
            <CardFooter class="flex justify-end">
                <Button type="button" @click="router.get('/')" variant="outline">Kembali</Button>
            </CardFooter>
        </Card>
    </div>
</template>
