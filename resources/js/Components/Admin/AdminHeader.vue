<template>
    <header class="h-16 border-b border-gray-200 bg-blue-50">
        <div class="flex h-full items-center justify-between px-4 sm:px-6">

            <div class="flex min-w-0 items-center gap-4 sm:gap-6">

                <img
                    src="@/Assets/logo.png"
                    alt="Alfirka"
                    class="h-14 w-auto shrink-0 sm:h-16"
                />

                <div class="hidden border-l h-8 border-gray-300 pl-6 sm:block">
                    <p class="mt-1.5 text-sm font-medium text-gray-900">
                        Адмін-панель
                    </p>
                </div>

            </div>

            <div class="flex items-center gap-2 sm:gap-4">

                <span class="hidden text-sm text-gray-600 sm:block">
                    Admin
                </span>

                <button
                    type="button"
                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-blue-100 sm:px-4"
                    @click="logout"
                >
                    Вийти
                </button>

                <button
                    type="button"
                    class="flex h-10 w-10 items-center justify-center rounded-lg border border-gray-300 bg-white text-gray-700 transition hover:bg-gray-50 lg:hidden"
                    :aria-expanded="sidebarOpen"
                    aria-label="Відкрити меню"
                    @click="$emit('toggle-sidebar')"
                >
                    <svg
                        v-if="!sidebarOpen"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    <svg
                        v-else
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>

        </div>
    </header>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
    sidebarOpen: {
        type: Boolean,
        default: false,
    },
})

defineEmits(['toggle-sidebar'])

const logout = () => {
    router.post(route('admin.logout'))
}
</script>
