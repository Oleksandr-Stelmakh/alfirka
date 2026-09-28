<template>

   <section class="relative overflow-hidden bg-violet-50 py-30 lg:pt-40 dark:bg-violet-950/20">
 
      <!-- Верхний декоративний градієнт -->
        <div
            class="absolute inset-x-0 top-0 h-50
            bg-linear-to-br
          from-violet-800
          via-violet-50
          to-violet-50
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

      <Container class="relative z-10">

         <SectionHeader
            badge="📸 Наша колекція"
            title="Зефірні букети ручної роботи"
            description="Кожен букет створюється вручну. Оберіть композицію, яка найбільше припаде до душі."
         />

         <div class="mt-16 grid gap-8 md:grid-cols-2 xl:grid-cols-3">

            <BouquetCard
               v-for="product in products"
               :key="product.id"
               :bouquet="product"
            />

         </div>

      </Container>

   </section>

</template>

<script setup>

import Container from '@/Components/Common/Container.vue'
import SectionHeader from '@/Components/UI/SectionHeader.vue'
import BouquetCard from '@/Components/Gallery/BouquetCard.vue'

defineProps({
    products: {
        type: Array,
        required: true,
    },
})
</script>