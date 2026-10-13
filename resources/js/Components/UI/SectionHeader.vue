<template>
    <div class="mx-auto mb-14 max-w-3xl text-center">
        <Badge
            v-if="badge || $slots.badge"
            class="mb-5"
            :class="
                light
                    ? 'border-white/30 bg-white/10 text-white'
                    : 'border-pink-200 bg-white/10 text-gray-900 dark:border-white/15 dark:text-gray-100'
            "
        >
            <slot name="badge">
                {{ badge }}
            </slot>
        </Badge>

        <h2
            class="text-3xl font-semibold sm:text-4xl"
            :class="light ? 'text-white' : 'text-emerald-700 dark:text-emerald-300'"
        >
            {{ title }}
        </h2>

        <p
            v-if="description"
            class="mx-auto mt-5 max-w-2xl text-base leading-relaxed sm:text-lg"
            :class="
                light ? 'text-white/80' : 'text-gray-600 dark:text-gray-400'
            "
        >
            {{ description }}
        </p>
    </div>
</template>

<script setup>
import Badge from "@/Components/UI/Badge.vue";

defineProps({
    badge: String,

    title: {
        type: String,
        required: true,
    },

    description: String,

    light: {
        type: Boolean,
        default: false,
    },
});
</script>
