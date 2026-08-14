<template>
    <Transition name="mobile-menu">
        <div
         v-if="isOpen"
         class="fixed inset-0 z-40 lg:hidden">

                <!-- Затемнение -->
            <div
                class="absolute inset-0 bg-black/55 backdrop-blur-[2px]"
                @click="emit('close')"
            />

            <!-- Панель меню -->
            <div
                class="fixed right-4  w-80
                overflow-hidden rounded-2xl border border-pink-300/20
                bg-white/10 backdrop-blur-xl shadow-xl"
                 :class="
                    isScrolled
                        ? 'top-18'
                        : 'top-28 sm:top-32'
                "
            >
                <ul>
                   <li
                        v-for="item in navigation"
                        :key="item.route"
                        class="border-b border-white/10 last:border-none"
                    >
                        <NavLink
                            :href="route(item.route)"
                            :active="route().current(item.route)"
                            @click="emit('close')"
                            class="px-6 py-3"
                        >
                            {{ item.label }}
                        </NavLink>
                    </li>
                </ul>
           </div>
        </div>
    </Transition>
</template>

<script setup>
import NavLink from '@/Components/UI/NavLink.vue'

const emit = defineEmits([
    'close',
])

defineProps({
    isOpen: {
        type: Boolean,
        required: true,
    },

    isScrolled: {
        type: Boolean,
        required: true,
    },

    navigation: {
        type: Array,
        required: true,
    },
})

</script>

<style scoped>

.mobile-menu-enter-active,
.mobile-menu-leave-active {
    /* transition: all .25s ease; */
    transition: opacity .3s ease, transform .3s ease;
}

.mobile-menu-enter-from,
.mobile-menu-leave-to {
    opacity: 0;
    /* transform: translateY(-12px); */
    transform: translateY(-20px);
}

.mobile-menu-enter-to,
.mobile-menu-leave-from {
    opacity: 1;
    transform: translateY(0);
}

</style>