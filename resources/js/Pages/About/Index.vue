<template>
    <Head title="Про нас | Alfirka" />

    <MainLayout fullScreen>
        <AboutStory />
        <AboutFeatures />
        <AboutProcess />
        <AboutCoffee />
        <AboutCTA />
        <div class="mx-auto max-w-4xl px-6 py-16">
            <div class="mt-8 space-y-6 text-lg leading-relaxed">
                <p>Что нужно рассказать в разделе про нас:</p>

                <ul class="list-disc space-y-2 pl-6">
                    <li>История создания Alfirka.</li>
                    <li>Кто занимается созданием букетов.</li>
                    <li>В чём особенность наших букетов.</li>
                    <li>Какие ингредиенты используются.</li>
                    <li>Почему стоит выбрать именно Alfirka.</li>
                    <li>Информация о качестве и ручной работе.</li>
                    <li>Фотографии процесса создания.</li>
                    <li>
                        Другие факты, которые заказчик хочет рассказать о
                        бренде.
                    </li>
                </ul>

                <p class="pt-4 font-semibold">
                    👉 Заказчику нужно предоставить текст и фотографии для этого
                    раздела.
                </p>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";

import MainLayout from "@/Layouts/MainLayout.vue";

import AboutStory from "@/Components/About/AboutStory.vue";
import AboutFeatures from "@/Components/About/AboutFeatures.vue";
import AboutProcess from "@/Components/About/AboutProcess.vue";
import AboutCoffee from "@/Components/About/AboutCoffee.vue";
import AboutCTA from "@/Components/About/AboutCTA.vue";
</script>
