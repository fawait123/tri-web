<script setup lang="ts">
import WelcomeLayout from "@/layouts/WelcomeLayout.vue";
import CardItemList from "./CardItemList.vue";
import { IEducation } from "@/interface";
import { router } from "@inertiajs/vue3";

interface IFiles {
    filename: string;
}
const props = defineProps<{
    educations: IEducation[];
    files: IFiles[];
}>();

defineOptions({
    layout: WelcomeLayout,
});

const onMore = (item: IEducation) => {
    router.get("/welcome/education/" + item.id);
};

const onMorePdf = (item: IFiles) => {
    console.log(item);
    router.get(
        "/welcome/education/" + item.filename.replace("pdf/", "") + "/pdf"
    );
};
</script>

<template>
    <div class="grid w-full min-w-[800px]">
        <CardItemList
            v-for="item in props.educations"
            :key="item.id"
            :title="item.title"
            @onMore="onMore(item)"
            :description="`klik lebih lanjut untuk melihat lebih detail tentang edukasi ${item.title}`"
        />
        <CardItemList
            v-for="item in props.files"
            :key="item.filename"
            :title="item.filename.replace('.pdf', '').replace('pdf/', '')"
            @onMore="onMorePdf(item)"
            :description="`klik lebih lanjut untuk melihat lebih detail tentang edukasi ${item.title}`"
        />
    </div>
</template>
