<template>

    <article
        class="group rounded-3xl border border-pink-200 dark:border-pink-200/25 bg-white/5 p-8 backdrop-blur-md transition-all duration-300 
            hover:-translate-y-2 hover:border-pink-500/50 hover:bg-white/10 hover:shadow-2xl dark:hover:shadow-pink-100/10"
    >

        <div
            class="-mx-8 -mt-8 mb-6 overflow-hidden rounded-t-3xl"
        >
            <slot />
        </div>

        <h3
            class="text-xl font-semibold text-pink-500 dark:text-pink-400"
        >
            {{ title }}
        </h3>

        <p
            class="mt-3 leading-relaxed text-pink-500 dark:text-pink-400"
        >
            {{ description }}
        </p>

    </article>

</template>

<script setup>

defineProps({

    title: {

        type: String,

        required: true,

    },

    description: {

        type: String,

        required: true,

    },

})

</script>