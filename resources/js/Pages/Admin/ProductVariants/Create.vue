<template>
    <AdminLayout>
        <div class="mb-6">
            <Link
                :href="route('admin.products.edit', props.product.id)"
                class="text-sm font-medium text-blue-600 hover:text-blue-700"
            >
                ← Назад до товару
            </Link>

            <h1 class="mt-4 text-2xl font-semibold text-gray-900 sm:text-3xl">
                Новий варіант
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Товар: {{ props.product.title }}
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
                        Назва варіанту
                    </label>

                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        placeholder="Наприклад: S"
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
                    <label
                        for="box_size"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Розмір коробки
                    </label>

                    <input
                        id="box_size"
                        v-model="form.box_size"
                        type="text"
                        placeholder="Наприклад: 20×20 см"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    />

                    <p
                        v-if="form.errors.box_size"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.box_size }}
                    </p>
                </div>

                <div>
                    <label
                        for="flowers_count"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Кількість квітів
                    </label>

                    <input
                        id="flowers_count"
                        v-model.number="form.flowers_count"
                        type="number"
                        min="0"
                        placeholder="Наприклад: 5"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                    />

                    <p
                        v-if="form.errors.flowers_count"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.flowers_count }}
                    </p>
                </div>

                <div>
                    <label
                        for="price"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Ціна
                    </label>

                    <div class="relative">
                        <input
                            id="price"
                            v-model.number="form.price"
                            type="number"
                            min="0"
                            placeholder="Наприклад: 350"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 pr-12 text-gray-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                        />

                        <span
                            class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-sm text-gray-500"
                        >
                            ₴
                        </span>
                    </div>

                    <p
                        v-if="form.errors.price"
                        class="mt-2 text-sm text-red-600"
                    >
                        {{ form.errors.price }}
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

                <div
                    class="flex flex-col-reverse gap-3 pt-2 sm:flex-row sm:justify-end"
                >
                    <Link
                        :href="route('admin.products.edit', props.product.id)"
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
import { nextTick } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: "",
    box_size: "",
    flowers_count: "",
    price: "",
    sort_order: 0,
});

const submit = () => {
    form.post(route("admin.products.variants.store", props.product.id), {
        preserveScroll: true,

        onSuccess: async () => {
            await nextTick();

            document.getElementById("product-variants")?.scrollIntoView({
                block: "start",
            });
        },
    });
};
</script>
