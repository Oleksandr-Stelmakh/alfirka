<template>
    <Head :title="`${product.title} | Alfirka`" />

    <MainLayout fullScreen>
        <ProductPage :product="product" />
    </MainLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import ProductPage from "@/Components/Product/ProductPage.vue";

defineProps({
    product: {
        type: Object,
        required: true,
    },
});
</script>
