<template>

    <div
        class="relative flex flex-col items-center text-center"
    >
        <div
            class="h-22 w-22 overflow-hidden rounded-2xl bg-white shadow-lg dark:bg-violet-900"
        >
            <img
                :src="icon"
                alt="img"
                class="h-full w-full object-cover"
            />
        </div>

        <!-- Смещение линии относительно центра круга -->
        <div
            v-if="!isLast"
            class="absolute top-10 left-[calc(35%+2.7rem)] hidden h-0.5 w-[calc(100%-3.7rem)]  translate-x-1/4 bg-linear-to-r from-pink-300 via-violet-300 to-pink-300 lg:block"
         ></div>

        <h3
            class="mt-6 text-xl font-semibold text-violet-900 dark:text-white"
        >
            {{ title }}
        </h3>

        <p
            class="mt-3 max-w-60 text-sm leading-6 text-violet-600 dark:text-violet-300"
        >
            {{ description }}
        </p>
    </div>

</template>

<script setup>

defineProps({
    icon: String,
    title: String,
    description: String,
    isLast: Boolean,
})

</script>