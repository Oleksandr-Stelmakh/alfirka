
<template>
    <div class="min-h-screen flex flex-col">
        <Header />

        <main class="min-h-screen bg-white text-gray-900 dark:bg-gray-900 dark:text-white transition-colors duration-300"
            :class="fullScreen ? '' : 'pt-32'"
        >
            <slot />
        </main>

        <Footer />
    </div>
</template>

<script setup>
import Header from '@/Components/Common/Header.vue'
import Footer from '@/Components/Common/Footer.vue'

defineProps({
    fullScreen: {
        type: Boolean,
        default: false,
    },
})

</script>