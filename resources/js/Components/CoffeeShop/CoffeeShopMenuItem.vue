<template>

    <article
        class="group overflow-hidden rounded-3xl border border-white/20 bg-white/10 shadow-xl backdrop-blur-md transition-all duration-500 hover:-translate-y-2 hover:bg-white/15"
    >

        <!-- Фото -->
        <div class="relative aspect-4/3 overflow-hidden">

            <img
                :src="image"
                :alt="title"
                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
            >

            <!-- Небольшое затемнение снизу -->
            <div
                class="absolute inset-x-0 bottom-0 h-1/2 bg-linear-to-t from-black/60 to-transparent"
            ></div>

        </div>

        <!-- Контент -->
        <div class="p-6 text-white">

            <h3 class="text-xl font-semibold sm:text-2xl">
                {{ title }}
            </h3>

            <p
                class="mt-3 text-sm leading-6 text-white/75 sm:text-base"
            >
                {{ description }}
            </p>

        </div>

    </article>

</template>

<script setup>

defineProps({

    image: {
        type: String,
        required: true,
    },

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