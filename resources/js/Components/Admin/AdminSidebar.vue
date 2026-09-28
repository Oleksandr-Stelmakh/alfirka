<template>
    <!-- Затемнение фона на мобильном -->
    <div
        v-if="open"
        class="fixed inset-0 z-40 bg-black/30 lg:hidden"
        @click="$emit('close')"
    ></div>

    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-50 w-[20vw] min-w-40 max-w-64 shrink-0 overflow-hidden border-r border-gray-200 bg-purple-50 transition-transform duration-300 lg:static lg:z-auto lg:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full'"
    >
        <div class="flex h-full min-w-0 flex-col">
            <div class="min-w-0 border-b border-gray-200 p-4 sm:p-5 xl:p-6">
                <p
                    class="truncate text-xs font-semibold uppercase tracking-wider text-gray-400"
                >
                    Навігація
                </p>
            </div>

            <nav class="min-w-0 flex-1 space-y-1 overflow-y-auto p-3 xl:p-4">
                <!-- Dashboard -->
                <a
                    :href="route('admin.dashboard')"
                    class="flex min-w-0 items-center rounded-lg px-3 py-3 text-sm font-medium transition xl:px-4"
                    :class="
                        isActive('admin.dashboard')
                            ? 'bg-emerald-100 text-gray-900'
                            : 'text-gray-700 hover:bg-emerald-100 hover:text-gray-900'
                    "
                    @click="handleNavigation"
                >
                    <span class="truncate">Панель керування</span>
                </a>

                <!-- Будущие разделы -->

                <!-- Каталог -->
                <!-- <div class="px-3 pb-2 pt-5 xl:px-4">
                    <p class="text-xs font-medium text-gray-400">Каталог</p>
                </div> -->

                <a
                    :href="route('admin.products.index')"
                    class="flex min-w-0 items-center rounded-lg px-3 py-3 text-sm font-medium transition xl:px-4"
                    :class="
                        isActive('admin.products.*')
                            ? 'bg-emerald-100 text-gray-900'
                            : 'text-gray-700 hover:bg-emerald-100 hover:text-gray-900'
                    "
                    @click="handleNavigation"
                >
                    <span class="truncate">Товари</span>
                </a>

                <!-- <a
                    :href="route('admin.categories.index')"
                    class="flex min-w-0 items-center rounded-lg px-3 py-3 text-sm font-medium transition xl:px-4"
                    :class="
                        isActive('admin.categories.*')
                            ? 'bg-emerald-100 text-gray-900'
                            : 'text-gray-700 hover:bg-emerald-100 hover:text-gray-900'
                    "
                    @click="handleNavigation"
                >
                    <span class="truncate">Категорії</span>
                </a> -->

                <!-- Керування -->
                <!-- <div class="px-3 pb-2 pt-5 xl:px-4">
                    <p class="text-xs font-medium text-gray-400">Керування</p>
                </div> -->

                <a
                    :href="route('admin.admins.index')"
                    class="flex min-w-0 items-center rounded-lg px-3 py-3 text-sm font-medium transition xl:px-4"
                    :class="
                        isActive('admin.admins.*')
                            ? 'bg-emerald-100 text-gray-900'
                            : 'text-gray-700 hover:bg-emerald-100 hover:text-gray-900'
                    "
                    @click="handleNavigation"
                >
                    <span class="truncate">Адміністратори</span>
                </a>
            </nav>
        </div>
    </aside>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";

defineProps({
    open: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close"]);

const page = usePage();

const isActive = (pattern) => {
    const currentUrl = page.url;

    if (pattern.endsWith(".*")) {
        const prefix = pattern.slice(0, -2);

        return currentUrl.startsWith(`/${prefix.replaceAll(".", "/")}`);
    }

    return currentUrl === route(pattern).replace(window.location.origin, "");
};

const handleNavigation = () => {
    emit("close");
};
</script>
