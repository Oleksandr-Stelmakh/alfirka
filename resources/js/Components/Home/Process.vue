<template>

<section class="py-20 bg-gray-100 dark:bg-violet-950/50">

    <Container>

        <SectionHeader
            badge="✨ Як народжується букет"
            title="Від натуральних інгредієнтів до щирих емоцій"
            description="Кожен букет проходить кілька етапів, перш ніж подарувати комусь посмішку"
        />

        <div
            class="grid gap-12 md:grid-cols-2 lg:grid-cols-4"
        >

            <ProcessStep
                v-for="(step, index) in steps"
                :key="step.title"
                :icon="step.media"
                :title="step.title"
                :description="step.description"
                :is-last="index === steps.length - 1"
            />

        </div>

    </Container>

</section>

</template>

<script setup>

import Container from '@/Components/Common/Container.vue'
import SectionHeader from '@/Components/UI/SectionHeader.vue'
import ProcessStep from '@/Components/UI/ProcessStep.vue'

import step1Image from '@/Assets/images-optimized/process/step1.webp'
import step2Image from '@/Assets/images-optimized/process/step2.webp'
import step3Image from '@/Assets/images-optimized/process/step3.webp'
import step4Image from '@/Assets/images-optimized/process/step4.webp'

const steps = [
    {
        media: step1Image,
        title: 'Натуральні інгредієнти',
        description: 'Добираємо лише якісні продукти, щоб кожна квітка була не лише красивою, а й смачною',
    },
    {
        media: step2Image,
        title: 'Ручна робота',
        description: 'Кожна квітка створюється вручну з любов’ю та увагою до найменших деталей',
    },
    {
        media: step3Image,
        title: 'Оформлення',
        description: 'Поєднуємо квіти в гармонійну композицію та святкове пакування',
    },
    {
        media: step4Image,
        title: 'Щасливий отримувач',
        description: 'Готовий букет дарує емоції, які залишаються в пам’яті надовго',
    },
]

</script>