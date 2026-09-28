
<template>
    <Head title="Gallery | Alfirka" />

    <MainLayout fullScreen>

        <GalleryCatalog
            :products="products"
        /> 
           
    </MainLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'

import MainLayout from '@/Layouts/MainLayout.vue'
import GalleryCatalog from '@/Components/Gallery/GalleryCatalog.vue'

defineProps({
    products: {
        type: Array,
        required: true,
    },
})
</script>