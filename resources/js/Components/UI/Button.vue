<!-- <template>
    <button
        :type="type"
        :disabled="disabled"
        class="group inline-flex items-center justify-center rounded-full px-4 py-2 gap-1 text-sm font-medium transition shadow-md 
            focus:outline-none cursor-pointer hover:-translate-y-0.5 hover:shadow-xl"
        :class="[variantClass, disabled ? 'opacity-50 cursor-not-allowed' : '']"
    >
        <slot />
    </button>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    type: {
        type: String,
        default: 'button',
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    variant: {
        type: String,
        default: 'primary', // primary | secondary | danger
    },
})

const variantClass = computed(() => {
    switch (props.variant) {
        case 'secondary':
            return 'bg-gray-200 text-gray-800 hover:bg-gray-300'

        case 'danger':
            return 'bg-red-600 text-white hover:bg-red-700'

        default:
            return 'bg-gradient-to-r from-pink-500 to-fuchsia-500 text-white hover:from-pink-600 hover:to-purple-500 transition-all duration-300'
    }
})
</script> -->



<template>
    <button
        :type="type"
        :disabled="disabled"
        :class="[
            baseClass,
            sizeClass,
            variantClass,
            disabled ? disabledClass : '',
        ]"
    >
        <slot />
    </button>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    type: {
        type: String,
        default: 'button',
    },

    disabled: {
        type: Boolean,
        default: false,
    },

    variant: {
        type: String,
        default: 'primary',
    },

    size: {
        type: String,
        default: 'md',
    },
})

const baseClass =`group inline-flex items-center justify-center gap-2 rounded-full font-medium transition-all duration-300 ease-out 
        shadow-md hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98] focus:outline-none cursor-pointer`

const disabledClass =`opacity-50 cursor-not-allowed hover:translate-y-0 hover:shadow-md`

const sizeClass = computed(() => {

    switch (props.size) {

        case 'sm':
            return `px-3 py-2 text-sm`

        case 'lg':
            return `px-6 py-3 text-sm sm:px-7 sm:py-3 sm:text-base lg:px-8 lg:py-4 lg:text-lg`

        default:
            return `px-5 py-2.5 text-sm sm:text-base`
    }

})

const variantClass = computed(() => {

    switch (props.variant) {

        case 'glass':
            return `border dark:border-white/20 dark:bg-white/10 backdrop-blur-md dark:hover:bg-white/20 dark:hover:border-white/30`

        case 'secondary':
            return `bg-gray-200 text-gray-800 hover:bg-gray-300`

        case 'danger':
            return `bg-red-600 text-white hover:bg-red-700`

        default:
            return `bg-gradient-to-r from-pink-500 to-fuchsia-500 text-white hover:from-pink-600 hover:to-purple-500`
    }

})
</script>