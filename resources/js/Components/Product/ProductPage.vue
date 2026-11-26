<template>
    <section class="relative overflow-hidden bg-cyan-50/40 dark:bg-cyan-950/50">
        <!-- Верхний декоративний градієнт -->
        <div
            class="absolute inset-x-0 top-0 h-50 bg-linear-to-br from-emerald-800 via-cyan-50/5 to-cyan-50/5 dark:hidden"
        ></div>

        <!-- Верхний правый декоративний градієнт -->
        <div
            class="absolute right-0 top-0 h-50 w-full bg-linear-to-bl from-orange-300 via-cyan-50/5 to-cyan-50/5 dark:hidden"
        ></div>

        <Container class="relative z-10 py-16">
            <div class="grid gap-16 lg:grid-cols-[1.15fr_0.85fr] pt-30">
                <ProductGallery
                    :bouquet="bouquet"
                    :selected-size="selectedSize"
                    @select-image="selectedImage = $event"
                />

                <ProductInfo
                    :bouquet="bouquet"
                    :selected-size="selectedSize"
                    @select-size="selectedSize = $event"
                    @add-to-cart="addToCart"
                />
            </div>

            <Transition
                enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0 -translate-y-3"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition-all duration-300 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-3"
            >
                <div
                    v-if="addedToCart"
                    class="pointer-events-none fixed inset-x-0 top-24 z-60 flex justify-center px-4"
                >
                    <div
                        class="rounded-xl backdrop-blur-xl bg-emerald-400/60 px-6 py-3 text-center font-medium text-violet-700 border border-emerald-300"
                    >
                        <span class="flex items-center gap-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="h-5 w-5 shrink-0"
                            >
                                <path d="M20 6 9 17l-5-5" />
                            </svg>

                            Товар додано до кошика!
                        </span>
                    </div>
                </div>
            </Transition>
        </Container>
    </section>
</template>

<script setup>
import { ref, watch, onUnmounted } from "vue";

import Container from "@/Components/Common/Container.vue";
import ProductGallery from "./ProductGallery.vue";
import ProductInfo from "./ProductInfo.vue";

import { useCart } from "@/Composables/useCart";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const bouquet = props.product;

const selectedSize = ref(bouquet.variants[0]);

const initialImages = bouquet.variants[0]?.images?.length
    ? bouquet.variants[0].images
    : (bouquet.images ?? []);

const selectedImage = ref(
    initialImages.find((image) => image.is_main) ?? initialImages[0] ?? null,
);

const { addItem } = useCart();

const addedToCart = ref(false);

let notificationTimer = null;

watch(selectedSize, () => {
    addedToCart.value = false;
    clearTimeout(notificationTimer);
});

onUnmounted(() => {
    clearTimeout(notificationTimer);
});

function addToCart() {
    if (!selectedSize.value || !selectedImage.value) {
        return;
    }

    addItem({
        productId: bouquet.id,
        variantId: selectedSize.value.id,
        imageId: selectedImage.value.id,

        title: bouquet.title,
        slug: bouquet.slug,

        variantName: selectedSize.value.name,
        boxSize: selectedSize.value.box_size,
        flowersCount: selectedSize.value.flowers_count,

        price: selectedSize.value.price,

        imagePath: selectedImage.value.path,
    });

    addedToCart.value = true;

    clearTimeout(notificationTimer);

    notificationTimer = setTimeout(() => {
        addedToCart.value = false;
    }, 3000);
}
</script>
