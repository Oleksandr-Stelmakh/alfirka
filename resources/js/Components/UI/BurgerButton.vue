<template>
    <button
        @click="$emit('toggle')"
        :aria-expanded="isOpen"
        :aria-label="isOpen ? 'Закрити меню' : 'Відкрити меню'"
        class="group flex h-8 w-8 lg:hidden items-center justify-center rounded-lg
               border border-pink-500/50
               bg-white/10
               backdrop-blur-md
               shadow-[0_0_12px_rgba(139,92,246,0.4)]
               transition-all duration-300
               hover:shadow-[0_0_18px_rgba(139,92,246,0.55)]
               focus:outline-none
               focus:ring-1
               focus:ring-pink-400"
    >

        <div class="relative h-5 w-5 top-0.5">

            <span
                class="absolute left-0 top-px h-[1.5px] w-5 rounded-full bg-white/70 transition-transform duration-300"
                :class="isOpen ? 'translate-y-1.5 rotate-45' : ''"
            />

            <span
                class="absolute left-0 top-1.75 h-[1.5px] w-5 rounded-full bg-white/70 transition-opacity duration-300"
                :class="isOpen ? 'opacity-0' : ''"
            />

            <span
                class="absolute left-0 top-3.25 h-[1.5px] w-5 rounded-full bg-white/70 transition-transform duration-300"
                :class="isOpen ? '-translate-y-1.5 -rotate-45' : ''"
            />

        </div>

    </button>
</template>

<script setup>

defineProps({

    isOpen: {
        type: Boolean,
        required: true,
    },

})

defineEmits([
    'toggle',
])

</script>