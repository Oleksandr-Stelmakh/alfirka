<template>

<section class="py-20 bg-violet-50 dark:bg-violet-950/20">

    <Container>

        <SectionHeader
            badge="📸 Наші роботи"
            title="Кожен букет - це маленький витвір мистецтва"
            description="Погляньте на кілька наших робіт, кожна композиція створюється вручну та має свій характер"
        />

        <div
            class="grid grid-cols-2 gap-4 lg:grid-cols-4"
        >

            <div
                v-for="(image, index) in gallery"
                :key="index"
                class="group overflow-hidden rounded-3xl"
                :class="[
                    index === 0 ? 'col-span-2 row-span-2' : '',
                ]"
            >

                <img
                    :src="image.image"
                    :title="image.title"
                    alt="gallery image"
                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                >

            </div>

        </div>

        <div class="mt-12 text-center">

            <Link :href="route('gallery')">
                <Button 
                    class="border-pink-200 bg-white/10 hover:border-pink-500/50"
                    variant="glass"
                    size="lg"
                >
                    Переглянути всі роботи
                </Button>
            </Link>
        </div>

    </Container>

</section>

</template>

<script setup>

import { Link } from '@inertiajs/vue3'

import Container from '@/Components/Common/Container.vue'
import SectionHeader from '@/Components/UI/SectionHeader.vue'
import Button from '@/Components/UI/Button.vue'

import Gallery1 from '@/Assets/images-optimized/gallery/gallery-1.webp'
import Gallery2 from '@/Assets/images-optimized/gallery/gallery-2.webp'
import Gallery3 from '@/Assets/images-optimized/gallery/gallery-3.webp'
import Gallery4 from '@/Assets/images-optimized/gallery/gallery-4.webp'
import Gallery5 from '@/Assets/images-optimized/gallery/gallery-5.webp'
import Gallery6 from '@/Assets/images-optimized/gallery/gallery-6.webp'
import Gallery7 from '@/Assets/images-optimized/gallery/gallery-7.webp'
import Gallery8 from '@/Assets/images-optimized/gallery/gallery-8.webp'
import Gallery9 from '@/Assets/images-optimized/gallery/gallery-9.webp'

const gallery = [
    {
        image: Gallery1,
        title: 'Квіткова ніжність',
    },
    {
        image: Gallery2,
        title: 'Полуничний ранок',
    },
    {
        image: Gallery7,
        title: 'Полуничний ранок',
    },
 
    {
        image: Gallery4,
        title: 'Полуничний ранок',
    },
    {
        image: Gallery5,
        title: 'Полуничний ранок',
    },
    {
        image: Gallery6,
        title: 'Полуничний ранок',
    },
    {
        image: Gallery9,
        title: 'Полуничний ранок',
    },
    {
        image: Gallery8,
        title: 'Полуничний ранок',
    },
    {
        image: Gallery3,
        title: 'Полуничний ранок',
    },
]

</script>
