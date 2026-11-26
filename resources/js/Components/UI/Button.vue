<template>
    <button
        v-bind="$attrs"
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
import { computed } from "vue";

defineOptions({
    inheritAttrs: false,
});

const props = defineProps({
    type: {
        type: String,
        default: "button",
    },

    disabled: {
        type: Boolean,
        default: false,
    },

    variant: {
        type: String,
        default: "primary",
    },

    size: {
        type: String,
        default: "md",
    },

    motion: {
        type: Boolean,
        default: true,
    },
});

const baseClass = computed(() => [
    "group inline-flex items-center justify-center gap-2 rounded-full font-medium",
    "focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-500 focus-visible:ring-offset-2",
    "cursor-pointer",

    props.motion
        ? "transition-all duration-300 ease-out shadow-md hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98]"
        : "transition-colors duration-200",
]);

const disabledClass = `opacity-50 cursor-not-allowed hover:translate-y-0 hover:shadow-md`;

const sizeClass = computed(() => {
    switch (props.size) {
        case "sm":
            return `px-3 py-2 text-sm`;

        case "lg":
            return `px-6 py-3 text-sm sm:px-7 sm:py-3 sm:text-base lg:px-8 lg:py-4 lg:text-lg`;

        default:
            return `px-5 py-2.5 text-sm sm:text-base`;
    }
});

const variantClass = computed(() => {
    switch (props.variant) {
        case "glass":
            return `border dark:border-white/20 dark:bg-white/10 backdrop-blur-md dark:hover:bg-white/20 dark:hover:border-pink-500/50 hover:text-pink-500/90`;

        case "secondary":
            return `bg-gray-200 text-gray-800 hover:bg-gray-300`;

        case "danger":
            return `border border-red-200/80 bg-red-50/80 text-red-700 shadow-sm hover:border-red-300 hover:bg-red-100 hover:text-red-800
                dark:border-red-400/20 dark:bg-red-950/30 dark:text-red-200 dark:hover:border-red-400/40 dark:hover:bg-red-950/50 dark:hover:text-red-50`;

        default:
            return `bg-gradient-to-r from-pink-500 to-fuchsia-500 text-white hover:from-pink-600 hover:to-purple-500`;
    }
});
</script>
