<template>
    <section
        class="relative overflow-hidden bg-violet-50 py-40 lg:pt-40 dark:bg-violet-950/50"
    >
        <!-- Верхний декоративний градієнт -->
        <div
            class="absolute inset-x-0 top-0 h-50 bg-linear-to-br from-violet-800 via-violet-50 to-violet-50 dark:hidden"
        ></div>

        <!-- Верхний правый декоративний градієнт -->
        <div
            class="absolute right-0 top-0 h-50 w-full bg-linear-to-bl from-orange-300 via-cyan-50/5 to-cyan-50/5 dark:hidden"
        ></div>

        <Container class="relative z-10">
            <SectionHeader
                badge="📸 Наша колекція"
                title="Зефірні букети ручної роботи"
                :description="defaultDescription"
            />

            <!-- Усі товари -->
            <div
                v-if="products.length"
                class="mt-16 grid gap-8 md:grid-cols-2 xl:grid-cols-3"
            >
                <BouquetCard
                    v-for="product in products"
                    :key="product.id"
                    :bouquet="product"
                />
            </div>

            <!-- Якщо товарів поки немає -->
            <div
                v-else
                class="mt-16 rounded-2xl border border-gray-200 bg-white px-6 py-12 text-center dark:border-white/10 dark:bg-gray-900"
            >
                <p class="text-lg font-medium text-gray-900 dark:text-white">
                    Наразі композицій немає.
                </p>

                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Завітайте трохи пізніше — нові роботи вже можуть готуватися.
                </p>
            </div>
        </Container>
    </section>
</template>

<script setup>
import Container from "@/Components/Common/Container.vue";
import SectionHeader from "@/Components/UI/SectionHeader.vue";
import BouquetCard from "@/Components/Gallery/BouquetCard.vue";

defineProps({
    products: {
        type: Array,
        required: true,
    },
});

const defaultDescription =
    "Кожен букет створюється вручну. Оберіть композицію, яка найбільше припаде до душі. Показані в цьому розділі роботи є прикладом композицій.\nВаше замовлення може бути виготовлене в необхідному Вам розмірі, кольорі, поєднанні квітів і смаків.";
</script>
