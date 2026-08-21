<template>

   <MainLayout fullScreen>

      <ProductPage :slug="slug" />
      
   </MainLayout>

</template>

<script setup>

import MainLayout from '@/Layouts/MainLayout.vue'
import ProductPage from '@/Components/Product/ProductPage.vue'

defineProps({
    slug: {
        type: String,
        required: true,
    },
})
</script>