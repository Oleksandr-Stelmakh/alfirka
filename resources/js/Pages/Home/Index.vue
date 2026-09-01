
<template>
    <Head title="Home | Alfirka" />

    <MainLayout fullScreen>

        <Hero />
        <Features />
        <GalleryPreview />
        <Process />
        <CoffeeShopPreview />
        
    </MainLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'

import MainLayout from '@/Layouts/MainLayout.vue'

import Hero from '@/Components/Home/Hero.vue'
import Features from '@/Components/Home/Features.vue'
import GalleryPreview from '@/Components/Home/GalleryPreview.vue'
import Process from '@/Components/Home/Process.vue'
import CoffeeShopPreview from '@/Components/Home/CoffeeShopPreview.vue'
</script>