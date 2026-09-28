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
                Редагування варіанту
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
                        Фотографії варіанту
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Фотографії саме цього варіанту товару.
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
                v-if="props.variant.images?.length"
                class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3"
            >
                <div
                    v-for="image in props.variant.images"
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
                    У цього варіанту ще немає фотографій.
                </p>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },

    variant: {
        type: Object,
        required: true,
    },
});

const imageInput = ref(null);
const selectedImage = ref(null);
const imageUploading = ref(false);
const imageError = ref("");

const form = useForm({
    name: props.variant.name,
    box_size: props.variant.box_size ?? "",
    flowers_count: props.variant.flowers_count ?? "",
    price: props.variant.price,
    sort_order: props.variant.sort_order,
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
        route("admin.products.variants.images.store", [
            props.product.id,
            props.variant.id,
        ]),
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
        route("admin.products.variants.images.main", [
            props.product.id,
            props.variant.id,
            image.id,
        ]),

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
        route("admin.products.variants.images.destroy", [
            props.product.id,
            props.variant.id,
            image.id,
        ]),

        {
            preserveScroll: true,
        },
    );
};

const submit = () => {
    form.put(
        route("admin.products.variants.update", [
            props.product.id,
            props.variant.id,
        ]),
        {
            preserveScroll: true,
        },
    );
};
</script>
