<script setup lang="ts">
import WelcomeLayout from '@/layouts/WelcomeLayout.vue';
import { IEducation } from '@/interface';
import { router } from '@inertiajs/vue3';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import Button from '@/components/ui/button/Button.vue';

defineProps<{
    education: IEducation
}>()

defineOptions({
    layout: WelcomeLayout
})

const handleBack = () => {
    router.get('/welcome/education')
}

</script>


<template>
    <div class="flex justify-center items-center mt-10 gap-4">
        <div class="w-[80vw]">
            <Card>
                <CardContent>
                    <div class="flex justify-center mb-4 mt-4">
                        <h6 class="p-2 text-2xl text-center inline">{{ education.title }}</h6>
                    </div>
                    <div v-html="education.body"></div>
                </CardContent>
                <CardFooter class="flex justify-end">
                    <Button type="button" variant="outline" @click="handleBack">Kembali</Button>
                </CardFooter>
            </Card>
        </div>
    </div>
</template>
