<template>
    <section class="bg-white py-16 dark:bg-gray-950 sm:py-24">
        <Container>
            <div
                class="overflow-hidden rounded-3xl bg-linear-to-br from-rose-100 via-orange-50 to-cyan-100 py-12 text-center dark:from-rose-950/50 dark:via-gray-900 dark:to-cyan-950/50 sm:px-12 sm:py-16"
            >
                <p
                    class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-800 dark:text-emerald-300"
                >
                    Будемо раді знайомству
                </p>

                <h2
                    class="mx-auto mt-4 max-w-2xl text-3xl font-semibold tracking-tight text-gray-900 dark:text-gray-200 sm:text-4xl"
                >
                    Оберіть букет, який подарує емоції
                </h2>

                <p
                    class="mx-auto mt-5 max-w-xl leading-7 text-gray-700 dark:text-gray-300"
                >
                    Перегляньте наші композиції або зв'яжіться з нами, щоб
                    дізнатися більше про Alfirka.
                </p>

                <div
                    class="mt-8 flex flex-col justify-center gap-5 sm:flex-row"
                >
                    <Link :href="route('gallery')" class="self-center">
                        <Button
                            class="flex border-pink-200 bg-white/10 hover:border-pink-500/50"
                            variant="glass"
                            size="lg"
                        >
                            Переглянути букети
                        </Button>
                    </Link>

                    <Link :href="route('contacts')" class="self-center">
                        <Button
                            class="flex border-white/20 bg-white/10 hover:border-pink-500/50"
                            variant="glass"
                            size="lg"
                        >
                            Наші контакти
                        </Button>
                    </Link>
                </div>
            </div>
        </Container>
    </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import Container from "@/Components/Common/Container.vue";
import Button from "@/Components/UI/Button.vue";
</script>
