<template>
    <Head title="Кошик | Alfirka" />

    <MainLayout fullScreen>
        <section class="min-h-screen bg-cyan-50/50 dark:bg-cyan-950/40 pt-30">
            <!-- Верхний декоративний градієнт -->
            <div
                class="absolute inset-x-0 top-0 h-25 sm:h-35 bg-linear-to-b from-emerald-600 via-cyan-600 to-cyan-50/5 dark:hidden"
            ></div>

            <Container class="py-10 sm:py-18">
                <div class="mb-10">
                    <h1
                        class="text-3xl font-bold text-violet-900 dark:text-white sm:text-4xl"
                    >
                        Ваш кошик
                    </h1>

                    <p class="mt-3 text-violet-600 dark:text-violet-300">
                        Перевірте обрані композиції перед оформленням
                        замовлення. Зверніть увагу на фото композиції, що ви
                        вибираєте, саме цю композицію ви замовляєте.
                    </p>
                </div>

                <div
                    v-if="successMessage"
                    ref="successAlert"
                    class="mb-6 rounded-2xl border border-green-400 bg-green-100 p-5 text-green-800"
                >
                    {{ successMessage }}
                </div>

                <!-- Порожній кошик -->
                <div
                    v-if="items.length === 0"
                    class="rounded-2xl bg-white p-10 text-center shadow-sm dark:bg-violet-900/50"
                >
                    <div class="mb-5 flex justify-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="h-16 w-16 text-violet-300 dark:text-violet-500"
                        >
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="20" cy="21" r="1" />
                            <path
                                d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"
                            />
                        </svg>
                    </div>

                    <h2
                        class="text-xl font-semibold text-violet-900 dark:text-white"
                    >
                        Ваш кошик поки порожній
                    </h2>

                    <p class="mt-2 text-gray-500 dark:text-gray-300">
                        Додайте композиції з нашого каталогу.
                    </p>

                    <Link :href="route('gallery')" class="mt-7 inline-flex">
                        <Button size="lg" variant="primary">
                            Перейти до каталогу
                        </Button>
                    </Link>
                </div>

                <!-- Товари в кошику -->
                <div v-else class="grid gap-8 lg:grid-cols-[1fr_340px]">
                    <div class="space-y-5">
                        <article
                            v-for="item in items"
                            :key="item.key"
                            class="flex flex-col gap-5 rounded-2xl bg-white p-4 shadow-sm dark:bg-violet-900/50 sm:flex-row sm:p-5"
                        >
                            <!-- Фото -->
                            <div
                                class="h-48 w-full shrink-0 overflow-hidden rounded-xl bg-violet-100 dark:bg-violet-800 sm:h-40 sm:w-36"
                            >
                                <img
                                    :src="item.imagePath"
                                    :alt="item.title"
                                    class="h-full w-full object-cover"
                                />
                            </div>

                            <!-- Інформація -->
                            <div class="flex min-w-0 flex-1 flex-col">
                                <div
                                    class="flex items-start justify-between gap-3"
                                >
                                    <div>
                                        <h2
                                            class="text-lg font-bold text-violet-900 dark:text-white"
                                        >
                                            {{ item.title }}
                                        </h2>

                                        <p
                                            class="mt-1 text-sm text-violet-600 dark:text-violet-300"
                                        >
                                            Розмір: {{ item.variantName }}
                                        </p>
                                    </div>

                                    <button
                                        type="button"
                                        @click="removeItem(item.key)"
                                        aria-label="Видалити товар"
                                        title="Видалити товар"
                                        class="shrink-0 rounded-lg p-2 text-gray-400 transition hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-950/40"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="h-5 w-5"
                                        >
                                            <path d="M3 6h18" />
                                            <path d="M8 6V4h8v2" />
                                            <path d="m19 6-1 14H6L5 6" />
                                            <path d="M10 11v5M14 11v5" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Характеристики -->
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <span
                                        v-if="item.boxSize"
                                        class="rounded-full bg-violet-100 px-3 py-1 text-xs text-violet-700 dark:bg-violet-800 dark:text-violet-200"
                                    >
                                        {{ item.boxSize }}
                                    </span>

                                    <span
                                        v-if="item.flowersCount"
                                        class="rounded-full bg-pink-100 px-3 py-1 text-xs text-pink-700 dark:bg-pink-900/50 dark:text-pink-200"
                                    >
                                        {{ item.flowersCount }}
                                    </span>
                                </div>

                                <div
                                    class="mt-auto flex flex-wrap items-end justify-between gap-4 pt-5"
                                >
                                    <!-- Кількість -->
                                    <div>
                                        <p
                                            class="mb-2 text-xs text-gray-500 dark:text-gray-400"
                                        >
                                            Кількість
                                        </p>

                                        <div
                                            class="flex items-center overflow-hidden rounded-lg border border-violet-200 dark:border-violet-700"
                                        >
                                            <button
                                                type="button"
                                                @click="
                                                    updateQuantity(
                                                        item.key,
                                                        item.quantity - 1,
                                                    )
                                                "
                                                :disabled="item.quantity <= 1"
                                                class="px-3 py-2 text-violet-700 transition hover:bg-violet-100 disabled:cursor-not-allowed disabled:opacity-30 dark:text-violet-200 dark:hover:bg-violet-800"
                                            >
                                                −
                                            </button>

                                            <span
                                                class="min-w-10 text-center font-semibold text-violet-900 dark:text-white"
                                            >
                                                {{ item.quantity }}
                                            </span>

                                            <button
                                                type="button"
                                                @click="
                                                    updateQuantity(
                                                        item.key,
                                                        item.quantity + 1,
                                                    )
                                                "
                                                class="px-3 py-2 text-violet-700 transition hover:bg-violet-100 dark:text-violet-200 dark:hover:bg-violet-800"
                                            >
                                                +
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Ціна -->
                                    <div class="text-right">
                                        <p
                                            class="text-xs text-gray-500 dark:text-gray-400"
                                        >
                                            Сума
                                        </p>

                                        <p
                                            class="mt-1 text-xl font-bold text-pink-600"
                                        >
                                            {{
                                                formatPrice(
                                                    item.price * item.quantity,
                                                )
                                            }}
                                            грн
                                        </p>

                                        <p
                                            class="text-xs text-gray-500 dark:text-gray-400"
                                        >
                                            {{ formatPrice(item.price) }} грн /
                                            шт.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- Підсумок -->
                    <aside
                        class="h-fit rounded-2xl bg-white p-6 shadow-sm dark:bg-violet-900/50 lg:sticky lg:top-28"
                    >
                        <h2
                            class="text-xl font-bold text-violet-900 dark:text-white"
                        >
                            Разом
                        </h2>

                        <div
                            class="mt-5 flex justify-between text-sm text-gray-600 dark:text-gray-300"
                        >
                            <span>Кількість товарів</span>
                            <span
                                class="font-semibold text-violet-900 dark:text-white"
                            >
                                {{ totalItems }}
                            </span>
                        </div>

                        <div
                            class="mt-4 flex justify-between gap-3 border-t border-violet-100 pt-4 dark:border-violet-800"
                        >
                            <span
                                class="font-medium text-violet-900 dark:text-white"
                            >
                                До сплати
                            </span>

                            <span class="text-2xl font-bold text-pink-600">
                                {{ formatPrice(totalPrice) }} грн
                            </span>
                        </div>

                        <p
                            class="mt-4 text-xs leading-5 text-gray-500 dark:text-gray-400"
                        >
                            Вартість замовлення буде остаточно підтверджена під
                            час оформлення.
                        </p>

                        <div class="mt-6">
                            <Button
                                type="button"
                                size="sm"
                                variant="danger"
                                :motion="false"
                                @click="clearCart"
                            >
                                Очистити кошик
                            </Button>
                        </div>
                    </aside>
                </div>

                <!-- Форма оформления заказа -->
                <ProductOrderForm
                    v-if="items.length > 0"
                    @success="handleOrderSuccess"
                />
            </Container>
        </section>
    </MainLayout>
</template>

<script setup>
import { nextTick, ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";

import MainLayout from "@/Layouts/MainLayout.vue";
import Container from "@/Components/Common/Container.vue";
import ProductOrderForm from "@/Components/Product/ProductOrderForm.vue";
import Button from "@/Components/UI/Button.vue";

import { useCart } from "@/Composables/useCart";

const { items, totalItems, totalPrice, removeItem, updateQuantity, clearCart } =
    useCart();

function formatPrice(value) {
    return new Intl.NumberFormat("uk-UA").format(value);
}

const successMessage = ref("");
const successAlert = ref(null);

function handleOrderSuccess(message) {
    successMessage.value = message;

    nextTick(() => {
        successAlert.value?.scrollIntoView({
            behavior: "smooth",
            block: "center",
        });
    });
}
</script>
