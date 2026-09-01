<template>
    <Head title="Про нас | Alfirka" />

    <MainLayout>

        <div class="mx-auto max-w-4xl px-6 py-16">

            <h1 class="text-4xl font-bold">
                ПРО НАС
            </h1>

            <div class="mt-8 space-y-6 text-lg leading-relaxed">

                <p>
                    📝 Тут заказчик должен предоставить информацию
                    о бренде Alfirka.
                </p>

                <p>
                    Что нужно рассказать:
                </p>

                <ul class="list-disc space-y-2 pl-6">
                    <li>История создания Alfirka.</li>
                    <li>Кто занимается созданием букетов.</li>
                    <li>В чём особенность наших букетов.</li>
                    <li>Какие ингредиенты используются.</li>
                    <li>Почему стоит выбрать именно Alfirka.</li>
                    <li>Информация о качестве и ручной работе.</li>
                    <li>Фотографии процесса создания.</li>
                    <li>Другие факты, которые заказчик хочет рассказать о бренде.</li>
                </ul>

                <p class="pt-4 font-semibold">
                    👉 Заказчику нужно предоставить текст
                    и фотографии для этого раздела.
                </p>

            </div>

        </div>

    </MainLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'

import MainLayout from '@/Layouts/MainLayout.vue'
</script>