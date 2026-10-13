<template>
    <section class="py-20 sm:py-24 bg-taupe-100 dark:bg-taupe-900">
        <Container>
            <SectionHeader
                badge="☕️ Alfirka Coffee"
                title="Завітайте на чашечку кави"
                description="Затишна кав'ярня, де можна відпочити, насолодитися ароматною кавою та приємною атмосферою"
            />

            <div
                class="grid overflow-hidden rounded-3xl border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800"
            >
                <!-- Фото кав'ярні -->
                <div class="grid grid-cols-1 sm:grid-cols-2">
                    <div class="h-90 overflow-hidden lg:h-119">
                        <img
                            :src="coffee1"
                            alt="Інтер'єр кав'ярні Alfirka Coffee"
                            class="h-full w-full object-cover object-[center_30%]"
                            loading="lazy"
                        />
                    </div>

                    <div class="h-90 overflow-hidden lg:h-119">
                        <img
                            :src="coffee2"
                            alt="Кав'ярня Alfirka Coffee"
                            class="h-full w-full object-cover object-center"
                            loading="lazy"
                        />
                    </div>
                </div>

                <!-- Content -->
                <div
                    class="relative bg-cover bg-center bg-fixed"
                    :style="{ backgroundImage: `url(${coffeeShopBg})` }"
                >
                    <!-- Затемнение общего фона -->
                    <div class="absolute inset-0 bg-black/35"></div>

                    <div
                        class="relative z-10 flex items-center p-8 sm:p-12 lg:p-16"
                    >
                        <div class="max-w-lg">
                            <h3
                                class="text-2xl font-semibold text-white sm:text-3xl"
                            >
                                Місце для приємних моментів
                            </h3>

                            <p class="mt-5 text-base text-gray-300">
                                Завітайте до Alfirka Coffee, щоб зробити паузу,
                                випити улюблену каву та просто провести час у
                                затишній атмосфері
                            </p>

                            <Link :href="route('coffee-shop')">
                                <Button
                                    variant="glass"
                                    size="lg"
                                    class="mt-8 border-white/20 bg-white/10 text-gray-200 hover:border-pink-500/50"
                                >
                                    Переглянути меню кав'ярні
                                </Button>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex justify-center sm:justify-end">
                <a
                    href="https://list.in.ua/%D0%A1%D1%82%D1%83%D0%B4%D1%96%D1%97-%D0%B7%D0%B5%D1%84%D1%96%D1%80%D0%BD%D0%BE%D1%97-%D1%84%D0%BB%D0%BE%D1%80%D0%B8%D1%81%D1%82%D0%B8%D0%BA%D0%B8/325793/Alfirka-%D0%86%D0%B2%D0%B0%D0%BD%D0%BE-%D0%A4%D1%80%D0%B0%D0%BD%D0%BA%D1%96%D0%B2%D1%81%D1%8C%D0%BA"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-sm text-gray-700 transition-colors duration-300 hover:text-pink-500 dark:text-gray-300"
                >
                    Відгуки про Alfirka ↗
                </a>
            </div>
        </Container>
    </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import Container from "@/Components/Common/Container.vue";
import SectionHeader from "@/Components/UI/SectionHeader.vue";
import Button from "@/Components/UI/Button.vue";

import coffeeShopBg from "@/Assets/images-optimized/coffee-shop/coffee-shop-bg.webp";
import coffee1 from "@/Assets/images-optimized/coffee-shop-preview/coffee-11.webp";
import coffee2 from "@/Assets/images-optimized/coffee-shop-preview/coffee-2.webp";
</script>
