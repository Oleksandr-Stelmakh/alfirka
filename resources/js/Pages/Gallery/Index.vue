
<template>
    <Head title="Gallery | Alfirka" />

    <MainLayout fullScreen>

        <GalleryCatalog /> 
           
    </MainLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'

import MainLayout from '@/Layouts/MainLayout.vue'
import GalleryCatalog from '@/Components/Gallery/GalleryCatalog.vue'

</script>