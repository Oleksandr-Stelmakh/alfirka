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
                Редагування товару
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Змініть дані товару та збережіть зміни.
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
                        {{
                            form.processing ? "Збереження..." : "Зберегти зміни"
                        }}
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 max-w-5xl">
            <div
                class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
            >
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">
                        Фотографії товару
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Загальні фотографії товару. Одна з них може бути
                        головною.
                    </p>
                </div>

                <form
                    class="flex flex-col gap-2 sm:flex-row sm:items-center"
                    @submit.prevent="uploadImage"
                >
                    <input
                        ref="imageInput"
                        type="file"
                        accept="image/jpeg,image/png,image/webp"
                        class="block w-full text-sm text-gray-600 file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-blue-700 hover:file:bg-blue-100 sm:w-auto"
                        @change="handleImageChange"
                    />

                    <button
                        type="submit"
                        :disabled="!selectedImage || imageUploading"
                        class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        {{ imageUploading ? "Завантаження..." : "Додати фото" }}
                    </button>
                </form>
            </div>

            <p
                v-if="imageError"
                class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-600"
            >
                {{ imageError }}
            </p>

            <div
                v-if="props.product.images?.length"
                class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3"
            >
                <div
                    v-for="image in props.product.images"
                    :key="image.id"
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
                >
                    <div class="relative aspect-square bg-gray-100">
                        <img
                            :src="`/storage/${image.path}`"
                            alt=""
                            class="h-full w-full object-cover"
                        />

                        <span
                            v-if="image.is_main"
                            class="absolute left-3 top-3 rounded-full bg-blue-600 px-3 py-1 text-xs font-semibold text-white"
                        >
                            Головна
                        </span>
                    </div>

                    <div class="p-4">
                        <div
                            class="mb-3 flex items-center justify-between gap-3"
                        >
                            <span class="text-sm text-gray-500">
                                Порядок: {{ image.sort_order }}
                            </span>

                            <span
                                v-if="image.is_main"
                                class="text-sm font-medium text-blue-600"
                            >
                                ★ Головна
                            </span>
                        </div>

                        <div class="flex gap-2">
                            <button
                                v-if="!image.is_main"
                                type="button"
                                class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                                @click="setMainImage(image)"
                            >
                                Зробити головною
                            </button>

                            <span
                                v-else
                                class="flex-1 rounded-lg bg-blue-50 px-3 py-2 text-center text-sm font-medium text-blue-700"
                            >
                                Головна фотографія
                            </span>

                            <button
                                type="button"
                                class="rounded-lg border border-red-200 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                                @click="deleteImage(image)"
                            >
                                Видалити
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div
                v-else
                class="rounded-2xl border border-dashed border-gray-300 bg-white p-8 text-center"
            >
                <p class="text-sm text-gray-500">
                    У цього товару ще немає фотографій.
                </p>
            </div>
        </div>

        <!-- Варіанти товару -->
        <div id="product-variants" class="mt-8 max-w-5xl">
            <div
                class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
            >
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">
                        Варіанти товару
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Розміри, ціни та характеристики товару.
                    </p>
                </div>

                <Link
                    :href="
                        route(
                            'admin.products.variants.create',
                            props.product.id,
                        )
                    "
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700"
                >
                    + Додати варіант
                </Link>
            </div>

            <div
                v-if="props.product.variants?.length"
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
            >
                <div class="hidden overflow-x-auto md:block">
                    <table class="w-full text-left">
                        <thead class="border-b border-gray-200 bg-gray-50">
                            <tr>
                                <th
                                    class="px-5 py-3 text-sm font-medium text-gray-600"
                                >
                                    Назва
                                </th>

                                <th
                                    class="px-5 py-3 text-sm font-medium text-gray-600"
                                >
                                    Коробка
                                </th>

                                <th
                                    class="px-5 py-3 text-sm font-medium text-gray-600"
                                >
                                    Квітів
                                </th>

                                <th
                                    class="px-5 py-3 text-sm font-medium text-gray-600"
                                >
                                    Ціна
                                </th>

                                <th
                                    class="px-5 py-3 text-sm font-medium text-gray-600"
                                >
                                    Порядок
                                </th>

                                <th
                                    class="px-5 py-3 text-right text-sm font-medium text-gray-600"
                                >
                                    Дії
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            <tr
                                v-for="variant in props.product.variants"
                                :key="variant.id"
                            >
                                <td class="px-5 py-4 font-medium text-gray-900">
                                    {{ variant.name }}
                                </td>

                                <td class="px-5 py-4 text-gray-600">
                                    {{ variant.box_size || "—" }}
                                </td>

                                <td class="px-5 py-4 text-gray-600">
                                    {{ variant.flowers_count ?? "—" }}
                                </td>

                                <td class="px-5 py-4 font-medium text-gray-900">
                                    {{ variant.price }} ₴
                                </td>

                                <td class="px-5 py-4 text-gray-600">
                                    {{ variant.sort_order }}
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex justify-end gap-2">
                                        <Link
                                            :href="
                                                route(
                                                    'admin.products.variants.edit',
                                                    [
                                                        props.product.id,
                                                        variant.id,
                                                    ],
                                                )
                                            "
                                            class="rounded-lg border border-blue-200 px-3 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-50"
                                        >
                                            Змінити
                                        </Link>

                                        <button
                                            type="button"
                                            class="rounded-lg border border-red-200 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                                            @click="deleteVariant(variant)"
                                        >
                                            Видалити
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="divide-y divide-gray-100 md:hidden">
                    <div
                        v-for="variant in props.product.variants"
                        :key="variant.id"
                        class="p-4"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="font-medium text-gray-900">
                                    {{ variant.name }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{
                                        variant.box_size || "Розмір не вказано"
                                    }}
                                </p>
                            </div>

                            <span class="shrink-0 font-semibold text-gray-900">
                                {{ variant.price }} ₴
                            </span>
                        </div>

                        <div class="mt-3 space-y-1 text-sm text-gray-600">
                            <p>
                                Квітів:
                                {{ variant.flowers_count ?? "—" }}
                            </p>

                            <p>
                                Порядок:
                                {{ variant.sort_order }}
                            </p>
                        </div>

                        <div class="mt-4 flex gap-2">
                            <Link
                                :href="
                                    route('admin.products.variants.edit', [
                                        props.product.id,
                                        variant.id,
                                    ])
                                "
                                class="flex-1 rounded-lg border border-blue-200 px-3 py-2 text-center text-sm font-medium text-blue-600 transition hover:bg-blue-50"
                            >
                                Змінити
                            </Link>

                            <button
                                type="button"
                                class="flex-1 rounded-lg border border-red-200 px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                                @click="deleteVariant(variant)"
                            >
                                Видалити
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div
                v-else
                class="rounded-2xl border border-dashed border-gray-300 bg-white p-8 text-center"
            >
                <p class="text-sm text-gray-500">
                    У цього товару ще немає варіантів.
                </p>

                <Link
                    :href="
                        route(
                            'admin.products.variants.create',
                            props.product.id,
                        )
                    "
                    class="mt-3 inline-flex text-sm font-medium text-blue-600 hover:text-blue-700"
                >
                    Додати перший варіант
                </Link>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import { slugify } from "@/utils/slugify";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },

    categories: {
        type: Array,
        default: () => [],
    },
});

const imageInput = ref(null);
const selectedImage = ref(null);
const imageUploading = ref(false);
const imageError = ref("");

const form = useForm({
    category_id: props.product.category_id,
    title: props.product.title,
    slug: props.product.slug,
    description: props.product.description ?? "",
    full_description: props.product.full_description ?? "",
    badge: props.product.badge ?? "",
    sort_order: props.product.sort_order,
    is_active: props.product.is_active,
});

const handleImageChange = (event) => {
    imageError.value = "";

    selectedImage.value = event.target.files?.[0] ?? null;
};

const uploadImage = () => {
    if (!selectedImage.value) {
        imageError.value = "Оберіть фотографію.";
        return;
    }

    imageUploading.value = true;
    imageError.value = "";

    const formData = new FormData();

    formData.append("image", selectedImage.value);

    router.post(
        route("admin.products.images.store", props.product.id),
        formData,
        {
            forceFormData: true,
            preserveScroll: true,

            onSuccess: () => {
                selectedImage.value = null;

                if (imageInput.value) {
                    imageInput.value.value = "";
                }
            },

            onError: (errors) => {
                imageError.value =
                    errors.image ?? "Не вдалося завантажити фотографію.";
            },

            onFinish: () => {
                imageUploading.value = false;
            },
        },
    );
};

const setMainImage = (image) => {
    router.post(
        route("admin.products.images.main", [props.product.id, image.id]),
        {},
        {
            preserveScroll: true,
        },
    );
};

const deleteImage = (image) => {
    if (!confirm("Видалити цю фотографію?")) {
        return;
    }

    router.delete(
        route("admin.products.images.destroy", [props.product.id, image.id]),
        {
            preserveScroll: true,
        },
    );
};

const generateSlug = () => {
    form.slug = slugify(form.title);
};

const submit = () => {
    form.put(route("admin.products.update", props.product.id), {
        preserveScroll: true,
    });
};

const deleteVariant = (variant) => {
    if (!confirm(`Видалити варіант "${variant.name}"?`)) {
        return;
    }

    router.delete(
        route("admin.products.variants.destroy", [
            props.product.id,
            variant.id,
        ]),
        {
            preserveScroll: true,
        },
    );
};
</script>
