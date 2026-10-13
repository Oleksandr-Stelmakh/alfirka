<template>
    <section class="bg-cyan-50/40 py-16 dark:bg-cyan-950/30 sm:py-24">
        <Container>
            <div class="grid items-center gap-10 md:grid-cols-2 md:gap-16">
                <div class="grid grid-cols-2 gap-3">
                    <img
                        :src="coffeeOne"
                        alt="Атмосфера кав'ярні Alfirka"
                        class="h-64 w-full rounded-2xl object-cover sm:h-90"
                        loading="lazy"
                    />

                    <img
                        :src="coffeeTwo"
                        alt="Кава та затишок в Alfirka"
                        class="mt-8 h-64 w-full rounded-2xl object-cover sm:h-90"
                        loading="lazy"
                    />
                </div>

                <div>
                    <p
                        class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700 dark:text-emerald-300"
                    >
                        ☕ Alfirka Coffee
                    </p>

                    <h2
                        class="mt-4 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white sm:text-4xl"
                    >
                        Місце для маленької паузи
                    </h2>

                    <div
                        class="mt-6 space-y-4 text-base leading-8 text-gray-600 dark:text-gray-300"
                    >
                        <p>
                            Alfirka — це не лише зефірні букети. Це також
                            можливість зупинитися на хвилинку, замовити каву та
                            насолодитися приємною атмосферою.
                        </p>

                        <p>
                            Завітайте самі, зустріньтеся з друзями або поєднайте
                            вибір подарунка з маленьким кавовим відпочинком.
                        </p>
                    </div>
                </div>
            </div>
        </Container>
    </section>
</template>

<script setup>
import Container from "@/Components/Common/Container.vue";

import coffeeOne from "@/Assets/images-optimized/coffee-shop-preview/coffee-11.webp";
import coffeeTwo from "@/Assets/images-optimized/coffee-shop-preview/coffee-2.webp";
</script>
