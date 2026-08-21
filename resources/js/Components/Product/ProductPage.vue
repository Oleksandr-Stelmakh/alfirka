<template>
 
   <section class="relative overflow-hidden bg-cyan-50/40 dark:bg-cyan-950/50">

      <!-- Верхний декоративний градієнт -->
      <div
         class="absolute inset-x-0 top-0 h-50
         bg-linear-to-br
         from-emerald-800
         via-cyan-50/5
         to-cyan-50/5
         dark:hidden"
      ></div>

      <!-- Верхний правый декоративний градієнт -->
      <div
          class="absolute right-0 top-0 h-50 w-full
          bg-linear-to-bl
          from-orange-300
          via-cyan-50/5
          to-cyan-50/5
          dark:hidden"
      ></div>

      <Container class="relative z-10 py-16">

         <div
            class="grid gap-16 lg:grid-cols-[1.15fr_0.85fr] pt-50"
         >

            <ProductGallery
               :bouquet="bouquet"
               :selected-size="selectedSize"
            />

            <ProductInfo
               :bouquet="bouquet"
               :selected-size="selectedSize"
               @select-size="selectedSize = $event"
               @open-order="isOrderFormOpen = true"
            />

         </div>

         <Transition
             enter-active-class="transition-all duration-500 ease-out"
             enter-from-class="opacity-0 translate-y-8"
             enter-to-class="opacity-100 translate-y-0"
             leave-active-class="transition-all duration-300 ease-in"
             leave-from-class="opacity-100 translate-y-0"
             leave-to-class="opacity-0 translate-y-8"
         >

             <ProductOrderForm
                 v-if="isOrderFormOpen"
                 :bouquet="bouquet"
                 :selected-size="selectedSize"
                 @close="isOrderFormOpen = false"
             />

         </Transition>

      </Container>

   </section>

</template>

<script setup>
import { ref } from 'vue'
import bouquets from '@/Data/bouquets'

import Container from '@/Components/Common/Container.vue'
import ProductGallery from './ProductGallery.vue'
import ProductInfo from './ProductInfo.vue'
import ProductOrderForm from './ProductOrderForm.vue'


const props = defineProps({
    slug: {
        type: String,
        required: true,
    },
})

const bouquet = bouquets.find(
    bouquet => bouquet.slug === props.slug
)

const selectedSize = ref(bouquet.sizes[0])

const isOrderFormOpen = ref(false)
</script>