<template>
    <div
        class="admin-panel min-h-screen overflow-x-hidden bg-gray-50 text-gray-900"
    >
        <AdminHeader
            :sidebar-open="sidebarOpen"
            @toggle-sidebar="toggleSidebar"
        />

        <div class="flex min-h-[calc(100vh-64px)] min-w-0">
            <AdminSidebar :open="sidebarOpen" @close="closeSidebar" />

            <main class="min-w-0 flex-1 overflow-x-hidden p-4 sm:p-6 lg:p-8">
                <!-- Flash notification -->
                <Transition name="flash">
                    <div
                        v-if="flashVisible && currentFlashMessage"
                        class="pointer-events-none fixed left-1/2 top-6 z-50 w-[calc(100%-2rem)] max-w-xl -translate-x-1/2"
                    >
                        <div
                            class="pointer-events-auto rounded-xl border px-4 py-3 text-center text-sm font-medium shadow-lg"
                            :class="
                                currentFlashType === 'success'
                                    ? 'border-green-200 bg-green-100 text-green-700'
                                    : 'border-red-200 bg-red-100 text-red-700'
                            "
                        >
                            {{ currentFlashMessage }}
                        </div>
                    </div>
                </Transition>

                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import AdminHeader from "@/Components/Admin/AdminHeader.vue";
import AdminSidebar from "@/Components/Admin/AdminSidebar.vue";

const page = usePage();

const sidebarOpen = ref(false);
const flashVisible = ref(false);
let flashTimer = null;

const currentFlashMessage = computed(() => {
    return page.props.flash?.success || page.props.flash?.error || "";
});

const currentFlashType = computed(() => {
    if (page.props.flash?.success) {
        return "success";
    }

    if (page.props.flash?.error) {
        return "error";
    }

    return null;
});

const showFlash = () => {
    if (flashTimer) {
        clearTimeout(flashTimer);
    }

    if (!currentFlashMessage.value) {
        flashVisible.value = false;
        return;
    }

    flashVisible.value = true;

    flashTimer = setTimeout(() => {
        flashVisible.value = false;
    }, 3000);
};

watch(
    () => [page.props.flash?.success, page.props.flash?.error],
    () => {
        showFlash();
    },
    {
        immediate: true,
    },
);

const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

const closeSidebar = () => {
    sidebarOpen.value = false;
};
</script>

<style>
.admin-panel input:-webkit-autofill,
.admin-panel input:-webkit-autofill:hover,
.admin-panel input:-webkit-autofill:focus,
.admin-panel textarea:-webkit-autofill,
.admin-panel textarea:-webkit-autofill:hover,
.admin-panel textarea:-webkit-autofill:focus,
.admin-panel select:-webkit-autofill,
.admin-panel select:-webkit-autofill:hover,
.admin-panel select:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px #ffffff inset;
    -webkit-text-fill-color: #111827;
    transition: background-color 5000s ease-in-out 0s;
}

.flash-enter-active,
.flash-leave-active {
    transition:
        opacity 0.2s ease,
        transform 0.2s ease;
}

.flash-enter-from,
.flash-leave-to {
    opacity: 0;
    transform: translate(-50%, -10px);
}
</style>
