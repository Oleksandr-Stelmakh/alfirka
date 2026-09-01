<template>
    <Head title="Контакти | Alfirka" />

    <MainLayout>

        <div class="mx-auto max-w-4xl px-6 py-16">

            <h1 class="text-4xl font-bold">
                КОНТАКТИ
            </h1>

            <div class="mt-8 space-y-6 text-lg leading-relaxed">

                <p>
                    📝 Тут заказчик должен предоставить информацию
                    для связи с Alfirka.
                </p>

                <p>
                    Что нужно разместить:
                </p>

                <ul class="list-disc space-y-2 pl-6">
                    <li>Номер телефона.</li>
                    <li>Email.</li>
                    <li>Ссылки на Instagram / социальные сети.</li>
                    <li>Адрес или город работы.</li>
                    <li>Информация о доставке.</li>
                    <li>График работы.</li>
                    <li>Способы связи и заказа.</li>
                    <li>Другую необходимую контактную информацию.</li>
                </ul>

                <p class="pt-4 font-semibold">
                    👉 Заказчику нужно предоставить актуальные
                    контактные данные и ссылки.
                </p>

            </div>

        </div>

    </MainLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'

import MainLayout from '@/Layouts/MainLayout.vue'
</script>