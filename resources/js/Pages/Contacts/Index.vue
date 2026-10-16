<template>
    <Head title="Контакти | Alfirka" />

    <MainLayout fullScreen>
        <ContactInfo />

        <div class="mx-auto max-w-4xl px-6 py-16">
            <div class="mt-8 space-y-6 text-lg leading-relaxed">
                <p>Что нужно разместить в этом разделе:</p>

                <ul class="list-disc space-y-2 pl-6">
                    <li class="line-through">Номер телефона. 0660592120</li>
                    <li>Email. alyusikosi@gmail.com</li>
                    <li>Ссылки на Instagram / социальные сети. @alfirka_if</li>
                    <li>Адрес или город работы.</li>
                    <li>Информация о доставке.</li>
                    <li>График работы.</li>
                    <li>Способы связи и заказа.</li>
                    <li>Другую необходимую контактную информацию.</li>
                </ul>

                <p class="pt-4 font-semibold">
                    👉 Заказчику нужно предоставить актуальные контактные данные
                    и ссылки.
                </p>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";

import MainLayout from "@/Layouts/MainLayout.vue";

import ContactInfo from "@/Components/Contacts/ContactInfo.vue";
</script>
