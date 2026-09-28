<template>
    <div
        class="admin-auth flex min-h-screen items-center justify-center bg-gray-50 px-4"
    >
        <div class="w-full max-w-md rounded-2xl bg-white p-8 shadow">
            <h1 class="mb-6 text-2xl font-semibold text-gray-900">
                Вхід до адмін-панелі
            </h1>

            <form class="space-y-5" @submit.prevent="submit">
                <div>
                    <label
                        for="email"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        v-model="form.email"
                        type="text"
                        autocomplete="email"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 placeholder-gray-400 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
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
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Пароль
                    </label>

                    <div class="relative">
                        <input
                            id="password"
                            v-model="form.password"
                            :type="showPassword ? 'text' : 'password'"
                            autocomplete="current-password"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 pr-12 text-gray-900 placeholder-gray-400 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
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
                                    d="M9.88 5.09A10.94 10.94 0 0 1 12 5c4.478 0 8.268 2.943 9.542 7a10.95 10.95 0 0 1-4.043 5.137M6.228 6.228A10.953 10.953 0 0 0 2.458 12c1.274 4.057 5.065 7 9.542 7 1.61 0 3.128-.356 4.482-.988"
                                />
                            </svg>
                        </button>
                    </div>

                    <p
                        v-if="form.errors.password"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.password }}
                    </p>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded-lg bg-blue-600 px-4 py-3 text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    {{ form.processing ? "Вхід..." : "Увійти" }}
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
});

const showPassword = ref(false);

const submit = () => {
    form.post(route("admin.login.store"));
};
</script>

<style>
.admin-auth input:-webkit-autofill,
.admin-auth input:-webkit-autofill:hover,
.admin-auth input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px #ffffff inset;
    -webkit-text-fill-color: #062c7e;
    transition: background-color 5000s ease-in-out 0s;
}
</style>
