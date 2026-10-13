<template>
    <section class="py-16 bg-cyan-50/40 dark:bg-cyan-950/50 sm:py-24">
        <!-- Верхний декоративний градієнт -->
        <div
            class="absolute inset-x-0 top-0 h-50 bg-linear-to-br from-indigo-900 via-cyan-50/5 to-cyan-50/5 dark:hidden"
        ></div>

        <!-- Верхний правий декоративний градієнт -->
        <div
            class="absolute right-0 top-0 h-50 w-full bg-linear-to-bl from-orange-300 via-cyan-50/5 to-cyan-50/5 dark:hidden"
        ></div>

        <SectionHeader
            class="pt-20 px-2 sm:px-4"
            badge="✨ Чому обирають Alfirka"
            title="про нас"
            description=" Ми створюємо авторські зефірні букети та готуємо ароматну каву, щоб кожен візит викликав незабутні емоції."
        />
        <Container>
            <div
                class="grid items-center gap-10 md:grid-cols-2 md:gap-16 border rounded-2xl border-gray-200 dark:border-gray-700 p-4 sm:p-8 lg:p-12"
            >
                <div>
                    <p
                        class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700 dark:text-emerald-300"
                    >
                        Наша історія
                    </p>

                    <h2
                        class="mt-4 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white sm:text-4xl"
                    >
                        Ідея, що перетворюється на квіти
                    </h2>

                    <div
                        class="mt-6 space-y-4 text-base leading-8 text-gray-600 dark:text-gray-300"
                    >
                        <p>
                            Alfirka — це історія про красу, турботу та бажання
                            дарувати приємні емоції. Ми створюємо зефірні
                            квіткові композиції, які можуть стати особливим
                            подарунком для близької людини.
                        </p>

                        <p>
                            Нам хочеться, щоб за кожним букетом стояла не лише
                            красива композиція, а й теплий момент — привід
                            привітати, подякувати або просто зробити чийсь день
                            приємнішим.
                        </p>

                        <p>
                            А ще Alfirka — це місце, де можна зробити паузу
                            серед щоденних справ, випити кави та приділити трохи
                            часу собі.
                        </p>
                    </div>
                </div>

                <div class="min-h-72 overflow-hidden rounded-3xl sm:min-h-96">
                    <img
                        :src="bouquetImage"
                        alt="Зефірний букет Alfirka"
                        class="h-full min-h-72 w-full rounded-3xl object-cover sm:min-h-96"
                        loading="lazy"
                    />
                </div>
            </div>
        </Container>
    </section>
</template>

<script setup>
import SectionHeader from "@/Components/UI/SectionHeader.vue";
import Container from "@/Components/Common/Container.vue";
import bouquetImage from "@/Assets/images-optimized/Alla-2/Королівський букет/IMG_8432.webp";
</script>
