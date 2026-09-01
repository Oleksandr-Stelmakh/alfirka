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
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    href: {
        type: String,
        default: '#',
    },

    active: {
        type: Boolean,
        default: false,
    },

    variant: {
        type: String,
        default: 'header',
    },
})

const linkClass = computed(() => {
    if (props.variant === 'footer') {
        return [
            'group inline-flex items-center rounded-lg px-2 py-1 font-medium transition-all duration-300',

            props.active
                ? 'bg-violet-400/30 text-pink-700 hover:text-pink-500 shadow-[0_0_14px_rgba(236,72,153,0.25)]'
                : 'text-gray-700 hover:bg-gray-200 hover:text-pink-500 dark:text-gray-400 dark:hover:bg-gray-700',
        ]
    }

    return [
        'group inline-flex items-center rounded-lg px-2 py-1 font-medium transition-all duration-300',

        props.active
            ? 'bg-violet-400/30 text-pink-600 hover:text-pink-700 shadow-[0_0_14px_rgba(236,72,153,0.25)]'
            : 'text-pink-600 hover:bg-white/20 hover:text-pink-700',
    ]
})
</script>