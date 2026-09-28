<template>
    <AdminLayout>
        <div
            class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                    Категорії
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Керування категоріями каталогу.
                </p>
            </div>

            <Link
                :href="route('admin.categories.create')"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
            >
                Додати категорію
            </Link>
        </div>

        <div
            v-if="categories.length === 0"
            class="rounded-2xl border border-gray-200 bg-white p-8 text-center shadow-sm"
        >
            <p class="text-gray-500">Категорій поки немає.</p>
        </div>

        <div
            v-else
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
        >
            <!-- Desktop -->
            <div class="hidden overflow-x-auto md:block">
                <table class="min-w-full">
                    <thead class="border-b border-gray-200 bg-emerald-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Назва
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Slug
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Сортування
                            </th>

                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Статус
                            </th>

                            <th
                                class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Дія
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="category in categories" :key="category.id">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ category.name }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ category.slug }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ category.sort_order }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium"
                                    :class="
                                        category.is_active
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-gray-100 text-gray-500'
                                    "
                                >
                                    {{
                                        category.is_active
                                            ? "Активна"
                                            : "Неактивна"
                                    }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div
                                    class="flex items-center justify-end gap-4"
                                >
                                    <Link
                                        :href="
                                            route(
                                                'admin.categories.edit',
                                                category.id,
                                            )
                                        "
                                        class="rounded-lg border border-blue-200 px-2 py-1.5 text-xs font-medium text-blue-600 transition hover:bg-blue-50 xl:px-2.5 xl:py-2 xl:text-sm"
                                    >
                                        Редагувати
                                    </Link>

                                    <button
                                        type="button"
                                        class="rounded-lg border border-red-200 px-2 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50 xl:px-2.5 xl:py-2 xl:text-sm"
                                        @click="deleteCategory(category)"
                                    >
                                        Видалити
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile -->
            <div class="divide-y divide-gray-200 md:hidden">
                <div
                    v-for="category in categories"
                    :key="category.id"
                    class="p-4"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <h2 class="font-medium text-gray-900">
                                {{ category.name }}
                            </h2>

                            <p class="mt-1 break-all text-sm text-gray-500">
                                {{ category.slug }}
                            </p>
                        </div>

                        <span
                            class="shrink-0 rounded-full px-2.5 py-1 text-xs font-medium"
                            :class="
                                category.is_active
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-500'
                            "
                        >
                            {{ category.is_active ? "Активна" : "Неактивна" }}
                        </span>
                    </div>

                    <div class="mt-4 flex items-center justify-between text-sm">
                        <span class="text-gray-500">
                            Сортування: {{ category.sort_order }}
                        </span>

                        <div class="flex items-center gap-4">
                            <Link
                                :href="
                                    route('admin.categories.edit', category.id)
                                "
                                class="rounded-lg border border-blue-200 bg-blue-50 px-1 py-1 font-medium text-blue-600 transition"
                            >
                                Редагувати
                            </Link>

                            <button
                                type="button"
                                class="rounded-lg border border-red-200 bg-red-50 px-1 py-1 font-medium text-red-600 transition"
                                @click="deleteCategory(category)"
                            >
                                Видалити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

defineProps({
    categories: {
        type: Array,
        default: () => [],
    },
});

const deleteCategory = (category) => {
    if (!confirm(`Видалити категорію «${category.name}»?`)) {
        return;
    }

    router.delete(route("admin.categories.destroy", category.id));
};
</script>
