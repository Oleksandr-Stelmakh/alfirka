<template>

   <section class="py-20">

      <Container>

         <SectionHeader
               light
               badge="☕️ Наше меню"
               title="Обирайте те, що любите"
               description="Ароматна кава, ніжна матча, бельгійські вафлі та особливі десерти"
         />

         <!-- Основное меню -->
         <div
            class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3"
         >

            <CoffeeShopMenuItem
               v-for="item in coffeeItems"
               :key="item.title"
               :image="item.image"
               :title="item.title"
               :description="item.description"
            />

         </div>


         <!-- Разделитель -->
         <div class="my-24">

            <div class="flex items-center gap-6">

               <div
                  class="h-px flex-1 bg-linear-to-r from-transparent via-white/70 to-white/70"
               ></div>

               <h2
                  class="shrink-0 text-2xl font-semibold text-white sm:text-3xl"
               >
                  Бельгійські вафлі
               </h2>

               <div
                  class="h-px flex-1 bg-linear-to-l from-transparent via-white/70 to-white/70"
               ></div>

            </div>

            <p
                  class="mx-auto mt-5 max-w-3xl text-center text-sm leading-6 text-white/80 sm:text-base"
               >
                  Є можливість вафлі взяти з собою та куштувати з друзями на прогулянці.
                  Або ж насолодитися у кав'ярні з ароматною кавою чи матча
               </p>
         </div>


         <!-- Вафлі -->

         <div
            class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3"
         >

            <CoffeeShopMenuItem
               v-for="item in waffleItems"
               :key="item.title"
               :image="item.image"
               :title="item.title"
               :description="item.description"
            />

         </div>     

      </Container>

   </section>

</template>

<script setup>

import Container from '@/Components/Common/Container.vue'
import SectionHeader from '@/Components/UI/SectionHeader.vue'
import CoffeeShopMenuItem from '@/Components/CoffeeShop/CoffeeShopMenuItem.vue'

import coffeeImage from '@/Assets/images-optimized/coffee-shop/coffee-marshmallow.webp'
import cookiesImage from '@/Assets/images-optimized/coffee-shop/cookies.webp' 
import bubbleteaImage from '@/Assets/images-optimized/coffee-shop/bubbleti.webp' 
import bubbleLatteImage from '@/Assets/images-optimized/coffee-shop/bubbleLatte.webp' 
import marshmallows1Image from '@/Assets/images-optimized/coffee-shop/marshmallows1.webp' 
import marshmallowsImage from '@/Assets/images-optimized/coffee-shop/marshmallows.webp' 
import childrensFigurinesImage from '@/Assets/images-optimized/coffee-shop/childrens-figurines.webp' 

import belgianWafflesImage from '@/Assets/images-optimized/coffee-shop/img.webp' 
import belgianWaffles1Image from '@/Assets/images-optimized/coffee-shop/img1.webp'
import belgianWaffles2Image from '@/Assets/images-optimized/coffee-shop/img2.webp'
import belgianWaffles3Image from '@/Assets/images-optimized/coffee-shop/belgianWaffles3.webp'


const menuItems = [

    {
        category: 'coffee',
        image: coffeeImage,
        title: 'Кава в зефірній квітці',
        description:
            'Унікальна кава подана в їстівній зефірній квітці — наша особлива подача',
    },

    {
        category: 'coffee',
        image: cookiesImage,
        title: 'Печиво «Cookies»',
        description:
            'Солодке печиво з різноманітними начинками, яке підкреслює смак кави',
    },

    {
        category: 'coffee',
        image: bubbleteaImage,
        title: 'Баблті ?',
        description:
            'Ароматна кава ?',
    },

    {
        category: 'coffee',
        image: bubbleLatteImage,
        title: 'Бабл лате ?',
        description:
            'Ароматна кава ?',
    },

    {
        category: 'coffee',
        image: marshmallows1Image,
        title: 'Зефір різних смаків до кави',
        description:
            'Полуниця, лохина, лимон, орео…',
    },

    {
        category: 'coffee',
        image: marshmallowsImage,
        title: 'Зефір різних смаків до кави ?',
        description:
            'Полуниця, лохина, лимон, орео… ?',
    },

    {
        category: 'coffee',
        image: childrensFigurinesImage,
        title: 'Подаруйте гарний настрій своїм коханим',
        description:
            'Поштучно: Дитячі фігурки, квіти, тваринки, сердечка… ?',
    },

    {
        category: 'waffles',
        image: belgianWafflesImage,
        title: 'Лосось та крем-сир',
        description:
            'Слабосолена риба, вершковий крем-сир, зелень, кунжут',
    },

    {
        category: 'waffles',
        image: belgianWaffles1Image,
        title: 'Нутелла банан',
        description:
            'Нутелла, банан, лохина, мигдаль, зефірна квітка',
    },

    {
        category: 'waffles',
        image: belgianWaffles2Image,
        title: 'Шинка-сир',
        description:
            'Бельгійська вафля, шинка, сир, вершковий крем-сир, рукола',
    },

    {
        category: 'waffles',
        image: belgianWaffles3Image,
        title: 'Бельгійські вафлі ?',
        description:
            'Куштуйте з кавою або беріть з собою ?',
    },

]

const coffeeItems = menuItems.filter(
    item => item.category === 'coffee'
)

const waffleItems = menuItems.filter(
    item => item.category === 'waffles'
)

</script>