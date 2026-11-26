<template>
    <section
        class="mx-auto mt-16 max-w-3xl rounded-3xl border border-violet-200 bg-white/90 p-6 shadow-xl backdrop-blur-sm dark:border-violet-700 dark:bg-violet-950/80 sm:p-8"
    >
        <!-- Заголовок -->
        <div class="text-center">
            <span
                class="text-sm font-semibold uppercase tracking-[0.2em] text-pink-500"
            >
                🌸 Замовлення
            </span>

            <h2 class="mt-3 text-3xl font-bold text-violet-900 dark:text-white">
                Оформити замовлення
            </h2>

            <p
                class="mx-auto mt-3 max-w-xl text-violet-600 dark:text-violet-300"
            >
                Заповніть форму, і ми зв'яжемося з вами для уточнення деталей
                замовлення.
            </p>
        </div>

        <!-- Загальна помилка -->
        <div
            v-if="errors.general"
            class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-950/40 dark:text-red-300"
        >
            {{ errors.general }}
        </div>

        <!-- Помилка старих позицій -->
        <div
            v-if="hasInvalidItems"
            class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800 dark:border-amber-800 dark:bg-amber-950/40 dark:text-amber-300"
        >
            У кошику є позиції зі старої версії без фотографії. Видаліть їх і
            додайте товари повторно.
        </div>

        <!-- Форма -->
        <form class="mt-8 space-y-5" novalidate @submit.prevent="submitForm">
            <!-- Ім'я -->
            <div>
                <label
                    for="order-name"
                    class="block text-sm font-medium text-violet-800 dark:text-violet-200"
                >
                    Ваше ім'я
                </label>

                <input
                    id="order-name"
                    v-model="form.name"
                    type="text"
                    autocomplete="name"
                    maxlength="100"
                    placeholder="Наприклад, Олександр"
                    class="mt-2 w-full rounded-xl border bg-white px-4 py-3 text-violet-900 outline-none transition placeholder:text-violet-300 dark:bg-violet-900 dark:text-white dark:placeholder:text-violet-500"
                    :class="
                        errors.name
                            ? 'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-200 dark:border-red-500 dark:focus:ring-red-900'
                            : 'border-violet-200 focus:border-violet-500 focus:ring-2 focus:ring-purple-200 dark:border-violet-700 dark:focus:ring-violet-800'
                    "
                    @input="clearError('name')"
                />

                <p v-if="errors.name" class="mt-1 text-sm text-red-500">
                    {{ errors.name }}
                </p>
            </div>

            <!-- Телефон -->
            <div>
                <label
                    for="order-phone"
                    class="block text-sm font-medium text-violet-800 dark:text-violet-200"
                >
                    Номер телефону
                </label>

                <input
                    id="order-phone"
                    v-model="form.phone"
                    type="tel"
                    autocomplete="tel"
                    maxlength="20"
                    placeholder="+380..."
                    class="mt-2 w-full rounded-xl border bg-white px-4 py-3 text-violet-900 outline-none transition placeholder:text-violet-300 dark:bg-violet-900 dark:text-white dark:placeholder:text-violet-500"
                    :class="
                        errors.phone
                            ? 'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-200 dark:border-red-500 dark:focus:ring-red-900'
                            : 'border-violet-200 focus:border-violet-500 focus:ring-2 focus:ring-purple-200 dark:border-violet-700 dark:focus:ring-violet-800'
                    "
                    @input="clearError('phone')"
                />

                <p v-if="errors.phone" class="mt-1 text-sm text-red-500">
                    {{ errors.phone }}
                </p>
            </div>

            <!-- Email -->
            <div>
                <label
                    for="order-email"
                    class="block text-sm font-medium text-violet-800 dark:text-violet-200"
                >
                    Email
                </label>

                <input
                    id="order-email"
                    v-model="form.email"
                    type="email"
                    autocomplete="email"
                    maxlength="255"
                    placeholder="example@gmail.com"
                    class="mt-2 w-full rounded-xl border bg-white px-4 py-3 text-violet-900 outline-none transition placeholder:text-violet-300 dark:bg-violet-900 dark:text-white dark:placeholder:text-violet-500"
                    :class="
                        errors.email
                            ? 'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-200 dark:border-red-500 dark:focus:ring-red-900'
                            : 'border-violet-200 focus:border-violet-500 focus:ring-2 focus:ring-purple-200 dark:border-violet-700 dark:focus:ring-violet-800'
                    "
                    @input="clearError('email')"
                />

                <p v-if="errors.email" class="mt-1 text-sm text-red-500">
                    {{ errors.email }}
                </p>
            </div>

            <!-- Коментар -->
            <div>
                <label
                    for="order-comment"
                    class="block text-sm font-medium text-violet-800 dark:text-violet-200"
                >
                    Коментар
                    <span class="font-normal text-violet-400">
                        (необов'язково)
                    </span>
                </label>

                <textarea
                    id="order-comment"
                    v-model="form.comment"
                    rows="4"
                    maxlength="1000"
                    placeholder="Наприклад, бажана дата отримання..."
                    class="mt-2 w-full resize-none rounded-xl border border-violet-200 bg-white px-4 py-3 text-violet-900 outline-none transition placeholder:text-violet-300 focus:border-violet-500 focus:ring-2 focus:ring-purple-200 dark:border-violet-700 dark:bg-violet-900 dark:text-white dark:placeholder:text-violet-500 dark:focus:ring-violet-800"
                ></textarea>
            </div>

            <!-- Кнопка -->
            <div class="flex justify-center pt-2">
                <Button
                    type="submit"
                    size="lg"
                    class="w-full sm:max-w-100"
                    :disabled="isSubmitting || hasInvalidItems"
                >
                    <span class="flex items-center justify-center gap-2">
                        <!-- Спіннер -->
                        <span
                            v-if="isSubmitting"
                            class="h-5 w-5 animate-spin rounded-full border-2 border-white/30 border-t-white"
                            aria-hidden="true"
                        ></span>

                        <!-- Текст -->
                        <span>
                            {{
                                isSubmitting
                                    ? "Надсилаємо..."
                                    : "Підтвердити замовлення"
                            }}
                        </span>
                    </span>
                </Button>
            </div>
        </form>
    </section>
</template>

<script setup>
import { reactive, ref } from "vue";
import { router } from "@inertiajs/vue3";

import Button from "@/Components/UI/Button.vue";
import { useCart } from "@/Composables/useCart";

const emit = defineEmits(["success"]);

const { items, hasInvalidItems, clearCart } = useCart();

const isSubmitting = ref(false);

const form = reactive({
    name: "",
    phone: "",
    email: "",
    comment: "",
});

const errors = reactive({
    name: "",
    phone: "",
    email: "",
    general: "",
});

function clearError(field) {
    errors[field] = "";
    errors.general = "";
}

function validateForm() {
    errors.name = "";
    errors.phone = "";
    errors.email = "";
    errors.general = "";

    // Ім'я
    if (!form.name.trim()) {
        errors.name = "Вкажіть, будь ласка, ваше ім'я";
    } else if (form.name.trim().length < 2) {
        errors.name = "Ім'я повинно містити щонайменше 2 символи";
    }

    // Телефон
    const phoneDigits = form.phone.replace(/\D/g, "");

    if (!form.phone.trim()) {
        errors.phone = "Вкажіть номер телефону";
    } else if (phoneDigits.length < 12) {
        errors.phone = "Введіть повний номер телефону";
    }

    // Email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    if (!form.email.trim()) {
        errors.email = "Вкажіть Email";
    } else if (!emailPattern.test(form.email.trim())) {
        errors.email = "Введіть коректний Email";
    }

    return !errors.name && !errors.phone && !errors.email;
}

function submitForm() {
    if (isSubmitting.value) {
        return;
    }

    if (hasInvalidItems.value) {
        errors.general =
            "У кошику є товари, які потрібно додати повторно. Перевірте фотографії товарів.";
        return;
    }

    if (items.value.length === 0) {
        errors.general = "Ваш кошик порожній.";
        return;
    }

    if (!validateForm()) {
        return;
    }

    router.post(
        route("orders.store"),
        {
            name: form.name.trim(),
            phone: form.phone.trim(),
            email: form.email.trim(),
            comment: form.comment.trim(),

            // Передаємо всі позиції кошика.
            // Ціни та назви сервер отримує з бази даних.
            items: items.value.map((item) => ({
                variant_id: item.variantId,
                image_id: item.imageId,
                quantity: item.quantity,
            })),
        },
        {
            preserveScroll: true,

            onStart: () => {
                isSubmitting.value = true;
            },

            onSuccess: () => {
                clearCart();

                form.name = "";
                form.phone = "";
                form.email = "";
                form.comment = "";

                errors.name = "";
                errors.phone = "";
                errors.email = "";
                errors.general = "";

                emit(
                    "success",
                    "Дякуємо! Ваше замовлення успішно відправлено. Ми зв’яжемося з вами найближчим часом.",
                );
            },

            onError: (serverErrors) => {
                errors.name = serverErrors.name || "";
                errors.phone = serverErrors.phone || "";
                errors.email = serverErrors.email || "";

                // Інші помилки сервера, наприклад помилки позицій кошика.
                const otherError = Object.entries(serverErrors).find(
                    ([key]) => !["name", "phone", "email"].includes(key),
                );

                errors.general = otherError ? otherError[1] : "";
            },

            onFinish: () => {
                isSubmitting.value = false;
            },
        },
    );
}
</script>
