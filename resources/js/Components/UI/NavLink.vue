<template>
   <Link
      :href="href"
      :class="linkClass"
   >
      <slot />
   </Link>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3';


const props = defineProps({
   href: {
      type: String,
      default: '#',
   },

    active: {
        type: Boolean,
        default: false,
    },
})

// const page = usePage()

// const isActive = computed(() => {

//     return page.url === props.href

// })

const linkClass = computed(() => [

    'group inline-flex items-center rounded-lg px-2 py-1 font-medium transition-all duration-300',

    props.active
        ? 'bg-violet-400/30 text-pink-600 hover:text-pink-700 shadow-[0_0_14px_rgba(236,72,153,0.25)]'
        : 'text-pink-600 hover:bg-white/10 hover:text-pink-700',

])

</script>