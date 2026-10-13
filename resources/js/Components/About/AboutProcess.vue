<template>
    <section class="bg-white py-16 dark:bg-gray-950 sm:py-24">
        <Container>
            <SectionHeader
                badge="👐 За лаштунками"
                title="Як народжується зефірний букет"
                description="Від задуму до готової композиції — кожен етап допомагає створити подарунок, яким хочеться милуватися."
            />

            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article
                    v-for="(step, index) in steps"
                    :key="step.title"
                    class="relative rounded-2xl bg-gray-50 p-3 sm:p-7 dark:bg-gray-900"
                >
                    <span
                        class="inline-flex size-11 items-center justify-center rounded-full bg-emerald-100 text-lg font-semibold text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-200"
                    >
                        {{ String(index + 1).padStart(2, "0") }}
                    </span>

                    <h3
                        class="mt-5 text-xl font-semibold text-gray-900 dark:text-white"
                    >
                        {{ step.title }}
                    </h3>

                    <p class="mt-3 leading-7 text-gray-600 dark:text-gray-300">
                        {{ step.description }}
                    </p>
                </article>
            </div>

            <p
                class="mx-auto mt-8 max-w-3xl text-center text-sm leading-6 text-gray-500 dark:text-gray-400"
            >
                Деталі виробництва, склад та особливості приготування уточнимо
                перед публікацією остаточного тексту.
            </p>
        </Container>
    </section>
</template>

<script setup>
import Container from "@/Components/Common/Container.vue";
import SectionHeader from "@/Components/UI/SectionHeader.vue";

const steps = [
    {
        title: "Задум композиції",
        description:
            "Визначаємо настрій майбутнього букета, його кольорову гаму та загальний вигляд.",
    },
    {
        title: "Створення квітів",
        description:
            "Формуємо зефірні елементи та приділяємо увагу їхньому вигляду й охайності.",
    },
    {
        title: "Оформлення букета",
        description:
            "Поєднуємо елементи в композицію та готуємо її до вручення як подарунка.",
    },
];
</script>
