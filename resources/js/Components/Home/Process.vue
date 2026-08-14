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

const steps = [
    {
        media: '🍓',
        title: 'Натуральні інгредієнти',
        description: 'Добираємо лише якісні продукти, щоб кожна квітка була не лише красивою, а й смачною',
    },
    {
        media: '🤲',
        title: 'Ручна робота',
        description: 'Кожна квітка створюється вручну з любов’ю та увагою до найменших деталей',
    },
    {
        media: '🎀',
        title: 'Оформлення',
        description: 'Поєднуємо квіти в гармонійну композицію та святкове пакування',
    },
    {
        media: '😊',
        title: 'Щасливий отримувач',
        description: 'Готовий букет дарує емоції, які залишаються в пам’яті надовго',
    },
]

</script>