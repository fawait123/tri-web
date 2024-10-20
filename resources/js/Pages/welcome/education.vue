<script setup lang="ts">
import WelcomeLayout from '@/layouts/WelcomeLayout.vue';
import CardItemList from './CardItemList.vue';
import { IEducation } from '@/interface';
import { router } from '@inertiajs/vue3';

const props = defineProps<{
    educations: IEducation[]
}>()

defineOptions({
    layout: WelcomeLayout
})


const onMore = (item: IEducation) => {
    router.get('/welcome/education/' + item.id)
}

</script>


<template>
    <div class="flex justify-center items-center mt-10 gap-4">
        <CardItemList v-for="item in props.educations" :key="item.id" :title="item.title" @onMore="onMore(item)"
            description="lorem ipsum dolor ismet" />
    </div>
</template>
