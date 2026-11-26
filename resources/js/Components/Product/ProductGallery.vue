<template>
    <section>
        <div class="relative">
            <img
                :src="selectedImage"
                :alt="bouquet.title"
                class="h-auto max-h-130 w-full rounded-3xl object-cover object-[center_45%] shadow-xl"
            />

            <!-- Предыдущая фотография -->
            <button
                type="button"
                @click="previousImage"
                :disabled="selectedImageIndex === 0"
                class="absolute left-4 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white/35 font-light leading-none text-violet-900/50 shadow-lg backdrop-blur transition hover:bg-white/60 hover:text-violet-900/80 disabled:pointer-events-none disabled:opacity-30"
                aria-label="Попереднє фото"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-6 w-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </button>

            <!-- Следующая фотография -->
            <button
                type="button"
                @click="nextImage"
                :disabled="selectedImageIndex >= displayImages.length - 1"
                class="absolute right-4 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white/35 font-light leading-none text-violet-900/50 shadow-lg backdrop-blur transition hover:bg-white/60 hover:text-violet-900/80 disabled:pointer-events-none disabled:opacity-30"
                aria-label="Наступне фото"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-6 w-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 5l7 7-7 7"
                    />
                </svg>
            </button>
        </div>

        <!-- Миниатюры -->
        <div class="mt-6 flex gap-4 overflow-x-auto pb-2">
            <button
                v-for="(image, index) in displayImages"
                :key="`${selectedSize.id}-${index}`"
                type="button"
                @click="selectImage(image, index)"
                :class="[
                    'shrink-0 overflow-hidden rounded-2xl border-2 transition',
                    selectedImageIndex === index
                        ? 'border-pink-600 shadow-md'
                        : 'border-transparent hover:border-violet-400',
                ]"
            >
                <img
                    :src="image.path"
                    :alt="`${bouquet.title} — фото ${index + 1}`"
                    class="h-24 w-24 object-cover"
                />
            </button>
        </div>
    </section>
</template>

<script setup>
import { ref, watch, computed } from "vue";

const props = defineProps({
    bouquet: {
        type: Object,
        required: true,
    },

    selectedSize: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["select-image"]);

// Если у выбранного варианта есть свои фотографии,
// показываем их. Иначе используем общие фотографии товара.
const displayImages = computed(() => {
    if (props.selectedSize.images?.length) {
        return props.selectedSize.images;
    }

    return props.bouquet.images ?? [];
});

// Выбираем начальную фотографию.
// Сначала ищем главную, если её нет — берём первую.
const initialImage =
    displayImages.value.find((image) => image.is_main) ??
    displayImages.value[0] ??
    null;

const selectedImage = ref(initialImage?.path ?? "");

const selectedImageIndex = ref(
    initialImage ? displayImages.value.indexOf(initialImage) : 0,
);

function selectImage(image, index) {
    selectedImage.value = image.path;
    selectedImageIndex.value = index;

    // Передаём родительской странице весь объект фотографии,
    // чтобы сохранить и ID, и путь к изображению.
    emit("select-image", image);
}

function previousImage() {
    if (selectedImageIndex.value === 0) {
        return;
    }

    selectedImageIndex.value--;

    const image = displayImages.value[selectedImageIndex.value];

    if (!image) return;

    selectedImage.value = image.path;

    emit("select-image", image);
}

function nextImage() {
    if (selectedImageIndex.value >= displayImages.value.length - 1) {
        return;
    }

    selectedImageIndex.value++;

    const image = displayImages.value[selectedImageIndex.value];

    if (!image) return;

    selectedImage.value = image.path;

    emit("select-image", image);
}

// При смене варианта обновляем выбранную фотографию.
watch(
    () => props.selectedSize,
    () => {
        const images = displayImages.value;

        const image = images.find((item) => item.is_main) ?? images[0] ?? null;

        selectedImageIndex.value = image ? images.indexOf(image) : 0;

        selectedImage.value = image?.path ?? "";

        emit("select-image", image);
    },
);
</script>
