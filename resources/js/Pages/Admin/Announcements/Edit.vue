<template>
    <AdminLayout>
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-900">
                Оголошення на сайті
            </h1>

            <p class="mt-2 text-gray-500">
                Керуйте повідомленням, яке відображатиметься під шапкою сайту.
            </p>
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <!-- Announcement text -->
            <section
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
            >
                <div class="border-b border-gray-200 bg-emerald-50 px-6 py-5">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Текст оголошення
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Напишіть повідомлення, яке побачать відвідувачі сайту.
                    </p>
                </div>

                <div class="p-6">
                    <label
                        for="message"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Повідомлення
                    </label>

                    <textarea
                        id="message"
                        v-model="form.message"
                        rows="3"
                        maxlength="2000"
                        placeholder="Наприклад: До кінця тижня діє спеціальна пропозиція!"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"
                        :class="{ 'border-red-400': form.errors.message }"
                    ></textarea>

                    <div class="mt-2 flex items-center justify-between">
                        <p
                            v-if="form.errors.message"
                            class="text-sm text-red-600"
                        >
                            {{ form.errors.message }}
                        </p>

                        <p v-else class="text-xs text-gray-400">
                            Максимум 2000 символів
                        </p>

                        <span class="text-xs text-gray-400">
                            {{ form.message.length }} / 2000
                        </span>
                    </div>
                </div>
            </section>

            <!-- Schedule -->
            <section
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
            >
                <div class="border-b border-gray-200 bg-emerald-50 px-6 py-5">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Період показу
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Вкажіть, коли оголошення має з'явитися та зникнути. Час
                        використовується за Києвом.
                    </p>
                </div>

                <div class="grid gap-6 p-6 sm:grid-cols-2">
                    <div>
                        <label
                            for="starts_at"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Дата та час початку
                        </label>

                        <input
                            id="starts_at"
                            v-model="form.starts_at"
                            type="datetime-local"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"
                            :class="{ 'border-red-400': form.errors.starts_at }"
                        />

                        <p
                            v-if="form.errors.starts_at"
                            class="mt-2 text-sm text-red-600"
                        >
                            {{ form.errors.starts_at }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="ends_at"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Дата та час завершення
                        </label>

                        <input
                            id="ends_at"
                            v-model="form.ends_at"
                            type="datetime-local"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"
                            :class="{ 'border-red-400': form.errors.ends_at }"
                        />

                        <p
                            v-if="form.errors.ends_at"
                            class="mt-2 text-sm text-red-600"
                        >
                            {{ form.errors.ends_at }}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Appearance -->
            <section
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
            >
                <div class="border-b border-gray-200 bg-emerald-50 px-6 py-5">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Зовнішній вигляд
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Оберіть колірну тему оголошення.
                    </p>
                </div>

                <div class="space-y-5 p-6">
                    <div>
                        <label
                            for="theme"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Колір оголошення
                        </label>

                        <div class="flex flex-wrap items-center gap-4">
                            <input
                                id="theme"
                                v-model="form.theme"
                                type="color"
                                class="h-12 w-20 cursor-pointer rounded-lg border border-gray-300 bg-white p-1"
                            />

                            <span
                                class="rounded-lg border border-gray-200 px-4 py-2 font-mono text-sm text-gray-700"
                            >
                                {{ form.theme.toUpperCase() }}
                            </span>
                        </div>

                        <p
                            v-if="form.errors.theme"
                            class="mt-2 text-sm text-red-600"
                        >
                            {{ form.errors.theme }}
                        </p>
                    </div>

                    <div>
                        <p class="mb-3 text-sm font-medium text-gray-700">
                            Попередній перегляд
                        </p>

                        <div
                            class="rounded-lg px-4 py-3 text-center text-sm font-medium shadow-sm"
                            :style="previewStyle"
                        >
                            {{ form.message || "Тут буде ваше оголошення" }}
                        </div>
                    </div>
                </div>
            </section>

            <!-- Display settings -->
            <section
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
            >
                <div class="border-b border-gray-200 bg-emerald-50 px-6 py-5">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Налаштування показу
                    </h2>
                </div>

                <div class="space-y-5 p-6">
                    <label class="flex cursor-pointer items-start gap-3">
                        <input
                            v-model="form.is_enabled"
                            type="checkbox"
                            class="mt-1 h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                        />

                        <span>
                            <span
                                class="block text-sm font-medium text-gray-900"
                            >
                                Увімкнути оголошення
                            </span>

                            <span class="mt-1 block text-sm text-gray-500">
                                Оголошення буде показуватися у вказаний період.
                            </span>
                        </span>
                    </label>

                    <label class="flex cursor-pointer items-start gap-3">
                        <input
                            v-model="form.can_be_closed"
                            type="checkbox"
                            class="mt-1 h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500"
                        />

                        <span>
                            <span
                                class="block text-sm font-medium text-gray-900"
                            >
                                Дозволити відвідувачам закривати оголошення
                            </span>

                            <span class="mt-1 block text-sm text-gray-500">
                                Якщо вимкнути, кнопку закриття не буде показано.
                            </span>
                        </span>
                    </label>
                </div>
            </section>

            <!-- Save -->
            <div
                class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
            >
                <p class="text-sm text-gray-500">
                    Усі зміни набудуть чинності після збереження.
                </p>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-medium text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60"
                >
                    {{
                        form.processing
                            ? "Збереження..."
                            : "Зберегти налаштування"
                    }}
                </button>
            </div>
        </form>
    </AdminLayout>
</template>

<script setup>
import { computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

const props = defineProps({
    announcement: {
        type: Object,
        default: null,
    },
});

const form = useForm({
    message: props.announcement?.message ?? "",
    starts_at: props.announcement?.starts_at ?? "",
    ends_at: props.announcement?.ends_at ?? "",
    theme: props.announcement?.theme ?? "#702b3a",
    is_enabled: props.announcement?.is_enabled ?? false,
    can_be_closed: props.announcement?.can_be_closed ?? true,
});

const previewStyle = computed(() => {
    return {
        backgroundColor: form.theme,
        color: getContrastColor(form.theme),
    };
});

const getContrastColor = (hex) => {
    const color = hex.replace("#", "");

    const red = parseInt(color.substring(0, 2), 16);
    const green = parseInt(color.substring(2, 4), 16);
    const blue = parseInt(color.substring(4, 6), 16);

    const brightness = (red * 299 + green * 587 + blue * 114) / 1000;

    return brightness >= 150 ? "#1f2937" : "#ffffff";
};

const submit = () => {
    form.put(route("admin.announcements.update"));
};
</script>
