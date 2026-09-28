<template>
    <article
        class="relative group overflow-hidden rounded-3xl border border-violet-300 bg-white shadow-md transition-[box-shadow,border-color] duration-300 hover:shadow-xl dark:border-violet-800 dark:bg-violet-900/40"
    >
        <!-- Фото -->
        <div class="overflow-hidden">
            <img
                :src="mainImage"
                :alt="bouquet.title"
                class="aspect-square w-full object-cover transform-gpu transition-transform duration-300 group-hover:scale-[1.02]"
            />

            <div
                v-if="bouquet.badge"
                class="absolute left-4 top-4 rounded-full bg-pink-500 px-3 py-1 text-xs font-semibold text-white shadow-lg"
            >
                {{ bouquet.badge }}
            </div>

            <div
                class="absolute inset-0 pointer-events-none transition-colors duration-200 group-hover:bg-black/10"
            ></div>
        </div>

        <!-- Контент -->
        <div class="p-6">
            <h3 class="text-2xl font-bold text-violet-900 dark:text-white">
                {{ bouquet.title }}
            </h3>

            <p
                class="mt-3 text-sm leading-6 text-violet-600 dark:text-violet-300"
            >
                {{ bouquet.description }}
            </p>

            <!-- Характеристики -->
            <div v-if="firstVariant" class="mt-6 flex flex-wrap gap-2">
                <span
                    v-if="firstVariant.box_size"
                    class="rounded-full bg-violet-100 px-3 py-1 text-xs font-medium text-violet-700 dark:bg-violet-800 dark:text-violet-200"
                >
                    📦 {{ firstVariant.box_size }}
                </span>

                <span
                    v-if="firstVariant.flowers_count"
                    class="rounded-full bg-pink-100 px-3 py-1 text-xs font-medium text-pink-700 dark:bg-pink-900/50 dark:text-pink-200"
                >
                    🌸 {{ firstVariant.flowers_count }} квітів
                </span>
            </div>

            <!-- Цена -->
            <div class="mt-8 flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-violet-500">
                        Від
                    </p>

                    <p class="text-3xl font-bold text-pink-600">
                        {{ priceFrom }} грн
                    </p>
                </div>

                <Link :href="route('products.show', bouquet.slug)">
                    <Button variant="glass" size="sm" class="group/button">
                        <span> Детальніше </span>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4 transition-transform duration-300 group-hover/button:translate-x-1"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 12h14m-6-6 6 6-6 6"
                            />
                        </svg>
                    </Button>
                </Link>
            </div>
        </div>
    </article>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

import Button from "@/Components/UI/Button.vue";

const props = defineProps({
    bouquet: {
        type: Object,
        required: true,
    },
});

const mainImage = computed(() => {
    const main = props.bouquet.images?.find((image) => image.is_main);

    return main?.path ?? props.bouquet.images?.[0]?.path ?? "";
});

const firstVariant = computed(() => {
    return props.bouquet.variants?.[0] ?? null;
});

const priceFrom = computed(() => {
    const prices = props.bouquet.variants
        ?.map((variant) => Number(variant.price))
        .filter((price) => Number.isFinite(price));

    if (!prices?.length) {
        return 0;
    }

    return Math.min(...prices);
});
</script>
