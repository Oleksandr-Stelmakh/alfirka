<template>
    <AdminLayout>
        <div class="mb-8">
            <Link
                :href="route('admin.admins.index')"
                class="text-sm font-medium text-gray-500 transition hover:text-gray-900"
            >
                ← Назад до адміністраторів
            </Link>

            <h1 class="mt-4 text-3xl font-semibold text-gray-900">
                Додати адміністратора
            </h1>

            <p class="mt-2 text-gray-500">
                Створіть новий обліковий запис адміністратора.
            </p>
        </div>

        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
        >
            <div class="border-b border-gray-200 bg-emerald-50 px-6 py-5">
                <h2 class="text-lg font-semibold text-gray-900">
                    Дані адміністратора
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Після створення користувач одразу отримає доступ до адмінки.
                </p>
            </div>

            <form class="space-y-6 p-6" @submit.prevent="submit">
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Ім'я
                    </label>

                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        autocomplete="name"
                        class="mt-2 block w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 outline-none transition focus:border-gray-500 focus:ring-2 focus:ring-gray-200"
                    />

                    <p
                        v-if="form.errors.name"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.name }}
                    </p>
                </div>

                <div>
                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        class="mt-2 block w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 outline-none transition focus:border-gray-500 focus:ring-2 focus:ring-gray-200"
                    />

                    <p
                        v-if="form.errors.email"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.email }}
                    </p>
                </div>

                <div>
                    <label
                        for="password"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Пароль
                    </label>

                    <div class="relative mt-2">
                        <input
                            id="password"
                            v-model="form.password"
                            :type="showPassword ? 'text' : 'password'"
                            autocomplete="new-password"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 text-gray-900 outline-none transition focus:border-gray-500 focus:ring-2 focus:ring-gray-200"
                        />

                        <button
                            type="button"
                            class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 transition hover:text-gray-700"
                            :aria-label="
                                showPassword
                                    ? 'Сховати пароль'
                                    : 'Показати пароль'
                            "
                            @click="showPassword = !showPassword"
                        >
                            <svg
                                v-if="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>

                            <svg
                                v-else
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 3l18 18"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10.584 10.587a2 2 0 0 0 2.829 2.829"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9.88 5.09A10.94 10.94 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a10.95 10.95 0 0 1-4.043 5.137M6.228 6.228A10.953 10.953 0 0 0 2.458 12c1.274 4.057 5.065 7 9.542 7 1.61 0 3.128-.356 4.482.988"
                                />
                            </svg>
                        </button>
                    </div>

                    <p class="mt-2 text-sm text-gray-500">
                        Мінімум 8 символів.
                    </p>

                    <p
                        v-if="form.errors.password"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.password }}
                    </p>
                </div>

                <div>
                    <label
                        for="password_confirmation"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Підтвердження пароля
                    </label>

                    <div class="relative mt-2">
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            :type="
                                showPasswordConfirmation ? 'text' : 'password'
                            "
                            autocomplete="new-password"
                            class="block w-full rounded-xl border border-gray-300 px-4 py-3 pr-12 text-gray-900 outline-none transition focus:border-gray-500 focus:ring-2 focus:ring-gray-200"
                        />

                        <button
                            type="button"
                            class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 transition hover:text-gray-700"
                            :aria-label="
                                showPasswordConfirmation
                                    ? 'Сховати пароль'
                                    : 'Показати пароль'
                            "
                            @click="
                                showPasswordConfirmation =
                                    !showPasswordConfirmation
                            "
                        >
                            <svg
                                v-if="!showPasswordConfirmation"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>

                            <svg
                                v-else
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 3l18 18"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10.584 10.587a2 2 0 0 0 2.829 2.829"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9.88 5.09A10.94 10.94 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a10.95 10.95 0 0 1-4.043 5.137M6.228 6.228A10.953 10.953 0 0 0 2.458 12c1.274 4.057 5.065 7 9.542 7 1.61 0 3.128-.356 4.482-.988"
                                />
                            </svg>
                        </button>
                    </div>

                    <p
                        v-if="form.errors.password_confirmation"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.password_confirmation }}
                    </p>
                </div>

                <div
                    class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-6 sm:flex-row sm:justify-end"
                >
                    <Link
                        :href="route('admin.admins.index')"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-300 px-5 py-3 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                    >
                        Скасувати
                    </Link>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        {{
                            form.processing
                                ? "Збереження..."
                                : "Додати адміністратора"
                        }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);

const submit = () => {
    form.post(route("admin.admins.store"), {
        preserveScroll: true,
    });
};
</script>
