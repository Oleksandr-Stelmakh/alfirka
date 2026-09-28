<template>
    <AdminLayout>
        <div class="mb-6">
            <Link
                :href="route('admin.categories.index')"
                class="text-sm font-medium text-blue-600 hover:text-blue-700"
            >
                ← Назад до категорій
            </Link>

            <h1 class="mt-4 text-2xl font-semibold text-gray-900 sm:text-3xl">
                Нова категорія
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Додайте нову категорію до каталогу.
            </p>
        </div>

        <div
            class="max-w-2xl rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6"
        >
            <form class="space-y-6" @submit.prevent="submit">
                <div>
                    <label
                        for="name"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Назва
                    </label>

                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    />

                    <p
                        v-if="form.errors.name"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.name }}
                    </p>
                </div>

                <div>
                    <div class="mb-2 flex items-center justify-between gap-4">
                        <label
                            for="slug"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Slug
                        </label>

                        <button
                            type="button"
                            class="text-sm font-medium text-blue-600 hover:text-blue-700"
                            @click="generateSlug"
                        >
                            Згенерувати
                        </button>
                    </div>

                    <input
                        id="slug"
                        v-model="form.slug"
                        type="text"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    />

                    <p class="mt-1 text-xs text-gray-500">
                        Використовується в URL категорії.
                    </p>

                    <p
                        v-if="form.errors.slug"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.slug }}
                    </p>
                </div>

                <div>
                    <label
                        for="sort_order"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Порядок сортування
                    </label>

                    <input
                        id="sort_order"
                        v-model.number="form.sort_order"
                        type="number"
                        min="0"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    />

                    <p
                        v-if="form.errors.sort_order"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.sort_order }}
                    </p>
                </div>

                <label class="flex cursor-pointer items-center gap-3">
                    <input
                        v-model="form.is_active"
                        type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    />

                    <span class="text-sm font-medium text-gray-700">
                        Активна категорія
                    </span>
                </label>

                <p v-if="form.errors.is_active" class="text-sm text-red-600">
                    {{ form.errors.is_active }}
                </p>

                <div
                    class="flex flex-col-reverse gap-3 pt-2 sm:flex-row sm:justify-end"
                >
                    <Link
                        :href="route('admin.categories.index')"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                    >
                        Скасувати
                    </Link>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        {{ form.processing ? "Збереження..." : "Зберегти" }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import { slugify } from "@/utils/slugify";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

const form = useForm({
    name: "",
    slug: "",
    sort_order: 0,
    is_active: true,
});

const generateSlug = () => {
    form.slug = slugify(form.name);
};

const submit = () => {
    form.post(route("admin.categories.store"), {
        preserveScroll: true,
    });
};
</script>
