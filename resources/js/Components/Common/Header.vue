<template>
   <header
       class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
       :class="[
           isScrolled
               ? 'bg-taupe-500/70 shadow-lg backdrop-blur-xl dark:border-violet-800/50 dark:bg-violet-950/75'
               : 'bg-transparent'
       ]"
   >
      <Container 
         class="transition-all duration-300"
         :class="isScrolled ? 'py-1' : 'py-2 sm:py-4'"
      >

         <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
               <img
                  :src="Logo"
                  alt="Alfirka"
                  class="w-auto brightness-0 invert transition-all duration-300"
                  :class="isScrolled ? 'h-16' : 'h-21.5'"
               >

               <!-- <span class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                  Alfirka
               </span> -->
            </div> 
            
            <nav class="hidden lg:block">
               <ul class="flex gap-3 lg:gap-6 text-gray-900 dark:text-gray-100">
                  <li
                     v-for="item in navigation"
                     :key="item.route"
                  >
                     <NavLink 
                        :href="route(item.route)"
                        :active="route().current(item.route)"
                     >
                        {{ item.label }}
                     </NavLink>
                  </li>
               </ul>
            </nav>

            <div class="flex items-center gap-2 sm:gap-4">

               <Button variant="primary" size="sm">
                  
                   <Flower class="hidden sm:block h-5 w-5 text-gray-200 group-hover:text-sky-300
                     transition-all duration-300 group-hover:rotate-360 group-hover:scale-110" />

                   <span class="text-xs sm:text-sm text-gray-200 group-hover:text-emerald-300 ">
                      Замовити букет
                   </span>
               </Button>

               <ThemeSwitcher />

               <BurgerButton
                  :is-open="isMenuOpen"
                  @toggle="toggleMenu"
               />

            </div>
            
         </div>

      </Container>

   </header>

   <!-- Мобильное меню -->
   <MobileMenu
         :is-open="isMenuOpen"
         :is-scrolled="isScrolled"
         :navigation="navigation"
         @close="isMenuOpen = false"
       />
</template>

<script setup>
import { ref, watch, onBeforeUnmount, onMounted } from 'vue'
import { Menu, X } from 'lucide-vue-next'

import Container from '@/Components/Common/Container.vue'
import NavLink from '@/Components/UI/NavLink.vue'
import ThemeSwitcher from '@/Components/Common/ThemeSwitcher.vue'
import Logo from '@/Assets/logo.png'
import Button from '@/Components/UI/Button.vue'
import Flower from '@/Components/Icons/Flower.vue'
import MobileMenu from '@/Components/Common/MobileMenu.vue'
import BurgerButton from '@/Components/UI/BurgerButton.vue'

const isScrolled = ref(false)

const navigation = [
   { label: 'Головна', route: 'home' },
   { label: 'Галерея', route: 'gallery' },
   { label: 'Кав\'ярня', route: 'coffee-shop' },
   { label: 'Про нас', route: 'about' },
   { label: 'Контакти', route: 'contacts' },
]

const toggleMenu = () => {

    isMenuOpen.value = !isMenuOpen.value

}

const isMenuOpen = ref(false)

watch(isMenuOpen, (isOpen) => {

    document.body.style.overflow = isOpen
        ? 'hidden'
        : ''

})

onBeforeUnmount(() => {

    document.body.style.overflow = ''

    window.removeEventListener(
        'keydown',
        handleKeydown
    )

     window.removeEventListener(
        'scroll',
        handleScroll
    )

})

const handleKeydown = (event) => {

    if (
        event.key === 'Escape'
        && isMenuOpen.value
    ) {

        isMenuOpen.value = false

    }

}

const handleScroll = () => {

    isScrolled.value = window.scrollY > 30

}

onMounted(() => {

    window.addEventListener(
        'keydown',
        handleKeydown
    )

     window.addEventListener(
        'scroll',
        handleScroll
    )

    handleScroll()

})

</script>