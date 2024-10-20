<script setup lang="ts">
import WelcomeLayout from '@/layouts/WelcomeLayout.vue';
import LandingPage from '@/Pages/welcome/LandigPage.vue';
import CustomCard from '@/Pages/welcome/CustomCard.vue';
import { ref } from 'vue';
import { Brush, GraduationCap, Heart, NotebookPen, NotepadText, Video } from 'lucide-vue-next';
import { usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const page: any = usePage()
defineOptions({
    layout: WelcomeLayout
})

const cardData = ref([
    {
        link: '/welcome/education',
        icon: GraduationCap,
        title: 'Edukasi',
        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis modi unde incidunt culpa repudiandae nisi vel, enim perferendis. Dignissimos tempora nostrum minus tenetur ipsum, ipsam repellat repudiandae illo corrupti praesentium alias mollitia voluptatum blanditiis nam suscipit, laborum quia eligendi ut. Magnam harum molestias laborum esse dolore enim sapiente beatae ad!'
    },
    {
        link: '/welcome/video',
        icon: Video,
        title: 'Video Animasi',
        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis modi unde incidunt culpa repudiandae nisi vel, enim perferendis. Dignissimos tempora nostrum minus tenetur ipsum, ipsam repellat repudiandae illo corrupti praesentium alias mollitia voluptatum blanditiis nam suscipit, laborum quia eligendi ut. Magnam harum molestias laborum esse dolore enim sapiente beatae ad!'
    },
])

onMounted(() => {
    if (page.props.auth.user) {
        const cardAuth = [
            {
                link: '/welcome/brushing-teeth',
                icon: Brush,
                title: 'Sikat Gigi',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis modi unde incidunt culpa repudiandae nisi vel, enim perferendis. Dignissimos tempora nostrum minus tenetur ipsum, ipsam repellat repudiandae illo corrupti praesentium alias mollitia voluptatum blanditiis nam suscipit, laborum quia eligendi ut. Magnam harum molestias laborum esse dolore enim sapiente beatae ad!'
            },
            {
                link: '/welcome/pre-test',
                icon: NotebookPen,
                title: 'Pre Test',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis modi unde incidunt culpa repudiandae nisi vel, enim perferendis. Dignissimos tempora nostrum minus tenetur ipsum, ipsam repellat repudiandae illo corrupti praesentium alias mollitia voluptatum blanditiis nam suscipit, laborum quia eligendi ut. Magnam harum molestias laborum esse dolore enim sapiente beatae ad!'
            },
            {
                link: '/welcome/post-test',
                icon: NotepadText,
                title: 'Post Test',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis modi unde incidunt culpa repudiandae nisi vel, enim perferendis. Dignissimos tempora nostrum minus tenetur ipsum, ipsam repellat repudiandae illo corrupti praesentium alias mollitia voluptatum blanditiis nam suscipit, laborum quia eligendi ut. Magnam harum molestias laborum esse dolore enim sapiente beatae ad!'
            },
            {
                link: '/welcome/consultation',
                icon: Heart,
                title: 'Konsultasi',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis modi unde incidunt culpa repudiandae nisi vel, enim perferendis. Dignissimos tempora nostrum minus tenetur ipsum, ipsam repellat repudiandae illo corrupti praesentium alias mollitia voluptatum blanditiis nam suscipit, laborum quia eligendi ut. Magnam harum molestias laborum esse dolore enim sapiente beatae ad!'
            }
        ]

        cardAuth.map((item) => {
            cardData.value.push(item)
        })
    }
})
</script>


<template>
    <div>
        <LandingPage />
        <div class="flex gap-4 flex-wrap justify-center">
            <CustomCard :link="card.link" :icon="card.icon" :title="card.title" :description="card.description"
                v-for="card in cardData" :key="card.title" />
        </div>
    </div>
</template>
