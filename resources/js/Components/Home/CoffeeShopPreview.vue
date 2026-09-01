<template>
   <section class="px-6 py-20 sm:py-24 bg-taupe-100 dark:bg-taupe-900">
      <div class="mx-auto max-w-7xl">

         <SectionHeader
            badge="☕️ Alfirka Coffee"
            title="Завітайте на чашечку кави"
            description="Затишна кав'ярня, де можна відпочити, насолодитися ароматною кавою та приємною атмосферою"
         />

         <div
            class="grid overflow-hidden rounded-3xl border border-gray-200
               bg-gray-50 dark:border-gray-700 dark:bg-gray-800 md:grid-cols-2"
         >

            <!-- Фото кав'ярні -->
            <div class="min-h-80 md:min-h-full">
               <div
                  class="flex h-full min-h-80 items-center justify-center
                     bg-gray-200 text-sm text-gray-500
                     dark:bg-gray-700 dark:text-gray-400"
               >
                  Фото кав'ярні буде додано
               </div>
            </div>

            <!-- Content -->
            <div
               class="relative  bg-cover bg-center bg-fixed"
               :style="{ backgroundImage: `url(${coffeeShopBg})` }"
            >
               <!-- Затемнение общего фона -->
               <div class="absolute inset-0 bg-black/20"></div>

               <div class="relative z-10 flex items-center p-8 sm:p-12 lg:p-16">
                  <div class="max-w-lg">

                     <h3
                        class="text-2xl font-semibold text-white sm:text-3xl"
                     >
                        Місце для приємних моментів
                     </h3>

                     <p
                        class="mt-5 text-base leading-7 text-gray-300"
                     >
                        Завітайте до Alfirka Coffee, щоб зробити паузу,
                        випити улюблену каву та просто провести час
                        у затишній атмосфері
                     </p>

                     <Link :href="route('coffee-shop')">
                        <Button
                           variant="glass"
                           size="lg"
                           class="mt-8 text-gray-200 border-white/20 bg-white/10 hover:border-pink-500/50">
                              Завітати до кав'ярні
                        </Button>
                     </Link>

                  </div>
               </div>
            </div>
         </div>

      </div>
   </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

import SectionHeader from '@/Components/UI/SectionHeader.vue'
import Button from '@/Components/UI/Button.vue'

import coffeeShopBg from '@/Assets/images-optimized/coffee-shop/coffee-shop-bg.webp'

</script>