<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import WelcomeLayout from '@/layouts/WelcomeLayout.vue';
import { router, useForm } from '@inertiajs/vue3';
import OptionItem from './OptionItem.vue';
import { questionList } from '@/constant/index'

const props = defineProps<{
    type: string
}>()


defineOptions({
    layout: WelcomeLayout
})

const formRef = useForm([
    {
        correct: false,
        answer: ''
    },
    {
        correct: false,
        answer: ''
    },
    {
        correct: false,
        answer: ''
    },
    {
        correct: false,
        answer: ''
    },
    {
        correct: false,
        answer: ''
    },
    {
        correct: false,
        answer: ''
    },
    {
        correct: false,
        answer: ''
    },
    {
        correct: false,
        answer: ''
    },
    {
        correct: false,
        answer: ''
    },
    {
        correct: false,
        answer: ''
    },
])

const onInput = (value: any, index: number) => {
    const check = questionList[index].answer == value.key
    formRef[index].correct = check
}


const handleSubmit = () => {
    formRef.post('/welcome/' + props.type, {
        onProgress: () => {
            console.log('loading...')
        },
    })
}

</script>


<template>
    <div class="w-[50vw] mt-10">
        <Card>
            <CardHeader>
                <CardTitle>
                    {{ type == "pre-test" ? "Pre Test" : "Post Test" }}
                </CardTitle>
                <CardDescription>
                    Silahkan mengisi form {{ type == "pre-test" ? "Pre Test" : "Post Test" }} dibawah ini
                </CardDescription>
            </CardHeader>
            <CardContent>
                <div>
                    <OptionItem v-for="(question, index) in questionList" :parentIndex="index" :name="`option${index}`"
                        :key="index" @onInput="onInput" v-model="formRef[index].answer"
                        :question="`${index + 1}. ${question.question}`" :options="question.options" />
                </div>
            </CardContent>
            <CardFooter class="flex justify-end gap-3">
                <Button type="button" @click="router.get('/')" variant="outline">Kembali</Button>
                <Button type="button" @click="handleSubmit">Simpan</Button>
            </CardFooter>
        </Card>
    </div>
</template>
