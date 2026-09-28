<template>
    <AdminLayout>
        <div class="mb-6">
            <Link
                :href="route('admin.products.index')"
                class="text-sm font-medium text-blue-600 hover:text-blue-700"
            >
                ← Назад до товарів
            </Link>

            <h1 class="mt-4 text-2xl font-semibold text-gray-900 sm:text-3xl">
                Новий товар
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Додайте новий товар до каталогу.
            </p>
        </div>

        <div
            class="max-w-2xl rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6"
        >
            <form class="space-y-6" @submit.prevent="submit">
                <div>
                    <label
                        for="category_id"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Категорія
                    </label>

                    <select
                        id="category_id"
                        v-model="form.category_id"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    >
                        <option value="">Оберіть категорію</option>

                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>

                    <p
                        v-if="form.errors.category_id"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.category_id }}
                    </p>
                </div>

                <div>
                    <label
                        for="title"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Назва
                    </label>

                    <input
                        id="title"
                        v-model="form.title"
                        type="text"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    />

                    <p
                        v-if="form.errors.title"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.title }}
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
                        Використовується в URL товару.
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
                        for="description"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Опис
                    </label>

                    <textarea
                        id="description"
                        v-model="form.description"
                        rows="5"
                        class="w-full resize-y rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    ></textarea>

                    <p
                        v-if="form.errors.description"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.description }}
                    </p>
                </div>

                <div>
                    <label
                        for="full_description"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Детальний опис
                    </label>

                    <textarea
                        id="full_description"
                        v-model="form.full_description"
                        rows="6"
                        class="w-full resize-y rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    ></textarea>

                    <p
                        v-if="form.errors.full_description"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.full_description }}
                    </p>
                </div>

                <div>
                    <label
                        for="badge"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Badge
                    </label>

                    <input
                        id="badge"
                        v-model="form.badge"
                        type="text"
                        placeholder="Наприклад: Новинка"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    />

                    <p
                        v-if="form.errors.badge"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.badge }}
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
                        Активний товар
                    </span>
                </label>

                <p v-if="form.errors.is_active" class="text-sm text-red-600">
                    {{ form.errors.is_active }}
                </p>

                <div
                    class="flex flex-col-reverse gap-3 pt-2 sm:flex-row sm:justify-end"
                >
                    <Link
                        :href="route('admin.products.index')"
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
import { Link, useForm } from "@inertiajs/vue3";
import { slugify } from "@/utils/slugify";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

defineProps({
    categories: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    category_id: "",
    title: "",
    slug: "",
    description: "",
    full_description: "",
    badge: "",
    sort_order: 0,
    is_active: true,
});

const generateSlug = () => {
    form.slug = slugify(form.title);
};

const submit = () => {
    form.post(route("admin.products.store"), {
        preserveScroll: true,
    });
};
</script>
