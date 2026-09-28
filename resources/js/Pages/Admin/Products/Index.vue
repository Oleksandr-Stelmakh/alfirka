<template>
    <AdminLayout>
        <div
            class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                    Товари
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Керування товарами каталогу.
                </p>
            </div>

            <Link
                :href="route('admin.products.create')"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
            >
                Додати товар
            </Link>
        </div>

        <div
            v-if="products.length === 0"
            class="rounded-2xl border border-gray-200 bg-white p-8 text-center shadow-sm"
        >
            <p class="text-gray-500">Товарів поки немає.</p>
        </div>

        <div
            v-else
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
        >
            <!-- Desktop -->
            <div class="hidden overflow-x-auto md:block">
                <table class="w-full table-fixed">
                    <thead class="border-b border-gray-200 bg-emerald-50">
                        <tr>
                            <th
                                class="w-[22%] px-3 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Назва
                            </th>

                            <th
                                class="w-[16%] px-3 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Категорія
                            </th>

                            <th
                                class="w-[20%] px-3 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Slug
                            </th>

                            <th
                                class="w-[13%] px-3 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Статус
                            </th>

                            <th
                                class="w-[10%] px-3 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Сортування
                            </th>

                            <th
                                class="w-[19%] px-3 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500"
                            >
                                Дія
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="product in products" :key="product.id">
                            <td class="px-3 py-4">
                                <div
                                    class="wrap-break-words font-medium text-gray-900"
                                >
                                    {{ product.title }}
                                </div>

                                <div
                                    v-if="product.badge"
                                    class="mt-1 wrap-break-words text-xs text-gray-500"
                                >
                                    {{ product.badge }}
                                </div>
                            </td>

                            <td
                                class="wrap-break-words px-3 py-4 text-sm text-gray-600"
                            >
                                {{ product.category?.name ?? "Без категорії" }}
                            </td>

                            <td
                                class="wrap-break-words px-3 py-4 text-sm text-gray-500"
                            >
                                {{ product.slug }}
                            </td>

                            <td class="px-3 py-4">
                                <span
                                    class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium"
                                    :class="
                                        product.is_active
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-gray-100 text-gray-500'
                                    "
                                >
                                    {{
                                        product.is_active
                                            ? "Активний"
                                            : "Неактивний"
                                    }}
                                </span>
                            </td>

                            <td
                                class="px-3 py-4 text-center text-sm text-gray-600"
                            >
                                {{ product.sort_order }}
                            </td>

                            <td class="px-3 py-4">
                                <div
                                    class="flex flex-col items-end justify-center gap-1.5 xl:flex-row xl:items-center xl:justify-end xl:gap-2"
                                >
                                    <Link
                                        :href="
                                            route(
                                                'admin.products.edit',
                                                product.id,
                                            )
                                        "
                                        class="rounded-lg border border-blue-200 px-2 py-1.5 text-xs font-medium text-blue-600 transition hover:bg-blue-50 xl:px-2.5 xl:py-2 xl:text-sm"
                                    >
                                        Редагувати
                                    </Link>

                                    <button
                                        type="button"
                                        class="rounded-lg border border-red-200 px-2 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50 xl:px-2.5 xl:py-2 xl:text-sm"
                                        @click="deleteProduct(product)"
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
                <div v-for="product in products" :key="product.id" class="p-4">
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <h2 class="font-medium text-gray-900">
                                {{ product.title }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                {{ product.category?.name ?? "Без категорії" }}
                            </p>

                            <p
                                class="mt-1 wrap-break-words text-xs text-gray-400"
                            >
                                {{ product.slug }}
                            </p>
                        </div>

                        <span
                            class="shrink-0 rounded-full px-2.5 py-1 text-xs font-medium"
                            :class="
                                product.is_active
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-500'
                            "
                        >
                            {{ product.is_active ? "Активний" : "Неактивний" }}
                        </span>
                    </div>

                    <div
                        class="mt-4 flex items-center justify-between gap-4 text-sm"
                    >
                        <span class="text-gray-500">
                            Сортування: {{ product.sort_order }}
                        </span>

                        <div class="flex items-center gap-4">
                            <Link
                                :href="route('admin.products.edit', product.id)"
                                class="rounded-lg border border-blue-200 bg-blue-50 px-1 py-1 font-medium text-blue-600 transition"
                            >
                                Редагувати
                            </Link>

                            <button
                                type="button"
                                class="rounded-lg border border-red-200 bg-red-50 px-1 py-1 font-medium text-red-600 transition"
                                @click="deleteProduct(product)"
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
    products: {
        type: Array,
        default: () => [],
    },
});

const deleteProduct = (product) => {
    if (!confirm(`Видалити товар «${product.title}»?`)) {
        return;
    }

    router.delete(route("admin.products.destroy", product.id));
};
</script>
