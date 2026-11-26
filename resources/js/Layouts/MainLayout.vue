<template>
    <div class="min-h-screen flex flex-col">
        <Header />

        <main
            class="min-h-screen text-gray-800 dark:text-white duration-300 bg-white dark:bg-gray-900"
            :class="fullScreen ? '' : 'pt-29'"
        >
            <slot />
        </main>

        <Footer />
    </div>
</template>

<script setup>
import Header from "@/Components/Common/Header.vue";
import Footer from "@/Components/Common/Footer.vue";

defineProps({
    fullScreen: {
        type: Boolean,
        default: false,
    },
});
</script>
