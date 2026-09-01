<template>
    <section class="py-20 text-center bg-pink-50 dark:bg-pink-950/20">

       <Container>

            <SectionHeader
                badge="✨ Чому обирають Alfirka"
                title="Місце, де солодощі стають мистецтвом"
                description="Ми створюємо авторські зефірні букети та готуємо ароматну каву, щоб кожен візит викликав незабутні емоції"
            />

            <div
                class="grid gap-6 md:grid-cols-2 xl:grid-cols-3"
            >

                <FeatureCard
                    v-for="feature in features"
                    :key="feature.title"
                    :title="feature.title"
                    :description="feature.description"
                >

                   <img
                        :src="feature.image"
                        :alt="feature.title"
                        :class="feature.imageClass"
                        class="aspect-4/3 w-full object-cover transition-transform duration-500 group-hover:scale-105"
                    />

                </FeatureCard>

            </div>
        </Container>
    </section>
</template>

<script setup>

import Container from '@/Components/Common/Container.vue'
import FeatureCard from '@/Components/UI/FeatureCard.vue'
import SectionHeader from '@/Components/UI/SectionHeader.vue'

import Handmade from '@/Assets/images-optimized/features/handmade.webp'
import Coffee from '@/Assets/images-optimized/features/coffee.webp'
import Present from '@/Assets/images-optimized/features/present.webp'

const features = [
    {
        title: 'Ручна робота',
        description:
            'Кожен зефірний букет створюється вручну та є унікальним',
        image: Handmade,
        imageClass: 'object-[center_50%]',
    },

    {
        title: 'Ароматна кава',
        description:
            'Добірні зерна, професійне приготування та затишна атмосфера',
        image: Coffee,
        imageClass: 'object-[center_5%]',
    },

    {
        title: 'Ідеальний подарунок',
        description:
            'Подарунок, який дивує красою, смаком і залишає теплі спогади',
        image: Present,
        imageClass: 'object-[center_65%]',
    },
]

</script>
