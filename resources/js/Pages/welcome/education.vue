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
    <div class="grid w-full min-w-[800px]">
        <CardItemList v-for="item in props.educations" :key="item.id" :title="item.title" @onMore="onMore(item)"
            :description="`klik lebih lanjut untuk melihat lebih detail tentang edukasi ${item.title}`" />
    </div>
</template>
