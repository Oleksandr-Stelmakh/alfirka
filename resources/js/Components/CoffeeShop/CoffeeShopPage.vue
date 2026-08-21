<template>

   <div
      class="relative min-h-screen bg-cover bg-center bg-fixed"
      :style="{ backgroundImage: `url(${coffeeShopBg})` }"
   >

      <!-- Затемнение общего фона -->
      <div class="absolute inset-0 bg-black/40"></div>


      <!-- Контент страницы -->
      <div class="relative z-10">

         <!-- Hero -->
         <section class="pt-30 lg:pt-40">

            <Container>

               <SectionHeader
                  light
                  badge="☕️ Кав'ярня"
                  title="Ароматна кава та солодкі моменти"
                  description="Завітайте до нашої кав'ярні, щоб насолодитися улюбленими напоями та особливими десертами."
               />
               
               <div class="mx-auto grid max-w-5xl gap-4 sm:grid-cols-2 lg:grid-cols-5">

                  <div
                      class="rounded-2xl border border-white/15 bg-black/20 p-5 text-center backdrop-blur-sm"
                  >
                      <div class="text-2xl">
                          ☕️
                      </div>

                      <h3 class="mt-2 font-semibold text-white">
                          Ароматна кава
                      </h3>

                      <p class="mt-2 text-sm leading-6 text-white/70">
                          Еспресо, американо, капучино, лате та кава з сиропами.
                      </p>
                  </div>

                  <div
                      class="rounded-2xl border border-white/15 bg-black/20 p-5 text-center backdrop-blur-sm"
                  >
                      <div class="text-2xl">
                          🧇
                      </div>

                      <h3 class="mt-2 font-semibold text-white">
                          Бельгійські вафлі
                      </h3>

                      <p class="mt-2 text-sm leading-6 text-white/70">
                          Солодкі та солоні вафлі з різноманітними начинками.
                      </p>
                  </div>

                  <div
                      class="rounded-2xl border border-white/15 bg-black/20 p-5 text-center backdrop-blur-sm"
                  >
                      <div class="text-2xl">
                          🍵
                      </div>

                      <h3 class="mt-2 font-semibold text-white">
                          Матча
                      </h3>

                      <p class="mt-2 text-sm leading-6 text-white/70">
                          Ніжна матча та матча-напої для тих, хто любить щось особливе.
                      </p>
                  </div>

                  <div
                      class="rounded-2xl border border-white/15 bg-black/20 p-5 text-center backdrop-blur-sm"
                  >
                      <div class="text-2xl">
                          🍫
                      </div>

                      <h3 class="mt-2 font-semibold text-white">
                          Какао
                      </h3>

                      <p class="mt-2 text-sm leading-6 text-white/70">
                          Гарячий шоколадний напій, а також какао в зефірній квітці 🌸.
                      </p>
                  </div>

                  <div
                      class="rounded-2xl border border-white/15 bg-black/20 p-5 text-center backdrop-blur-sm"
                  >
                      <div class="text-2xl">
                          🌸
                      </div>

                      <h3 class="mt-2 font-semibold text-white">
                          Кава в зефірній квітці
                      </h3>

                      <p class="mt-2 text-sm leading-6 text-white/70">
                          Ароматна кава, подана в їстівній зефірній квітці.
                      </p>
                  </div>
               </div>

            </Container>

         </section>

         <!-- Меню -->
         <CoffeeShopMenu />

      </div>

   </div>

</template>


<script setup>

import Container from '@/Components/Common/Container.vue'
import SectionHeader from '@/Components/UI/SectionHeader.vue'
import CoffeeShopMenu from '@/Components/CoffeeShop/CoffeeShopMenu.vue'

import coffeeShopBg from '@/Assets/images-optimized/coffee-shop/coffee-shop-bg.webp'

</script>





<!-- <template>

   <section 
      class="relative min-h-screen bg-cover bg-center bg-fixed py-40"
      :style="{ backgroundImage: `url(${coffeeShopBg})` }"
   >
   <div class="absolute inset-0 bg-black/40"></div>

      <Container class="relative z-10">

         <SectionHeader
               light
               badge="☕️ Кав'ярня"
               title="Ароматна кава та солодкі моменти"
               description="Завітайте до нашої кав'ярні, щоб насолодитися улюбленими напоями та особливими десертами."
         />

      </Container>

   </section>

</template>

<script setup>

import Container from '@/Components/Common/Container.vue'
import SectionHeader from '@/Components/UI/SectionHeader.vue'

import coffeeShopBg from '@/Assets/images-optimized/coffee-shop/coffee-shop-bg.webp'

</script> -->