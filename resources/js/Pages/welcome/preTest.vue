<script setup lang="ts">
import WelcomeLayout from '@/layouts/WelcomeLayout.vue';
import QuizCard from './quizCard.vue';
import ObservableCard from './ObservableCard.vue'
import ObservableCardTwo from './ObservableCardTwo.vue';
import SummaryCard from './SummaryCard.vue'

defineOptions({
    layout: WelcomeLayout
})

const props = defineProps<{
    showQuiz: boolean,
    showObservableOne: boolean,
    showObservableTwo: boolean,
    quiz: any,
    observableOne: any,
    observableTwo: any
}>()


</script>


<template>
    <div class="w-[50vw] mt-10">
        <QuizCard type="pre-test" v-if="props.showQuiz" />
        <ObservableCard type="pre-test" v-else-if="props.showObservableOne" />
        <ObservableCardTwo type="pre-test" v-else-if="props.showObservableTwo" />
        <SummaryCard type="pre-test" v-else :quiz="quiz" :observableOne="observableOne"
            :observableTwo="observableTwo" />
    </div>
</template>
