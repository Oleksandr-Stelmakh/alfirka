<template>
    <AdminLayout>
        <div
            class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <h1 class="text-3xl font-semibold text-gray-900">
                    Адміністратори
                </h1>

                <p class="mt-2 text-gray-500">
                    Керування доступом до панелі керування.
                </p>
            </div>

            <Link
                :href="route('admin.admins.create')"
                class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-blue-700"
            >
                Додати адміністратора
            </Link>
        </div>

        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"
        >
            <div class="border-b border-gray-200 bg-emerald-50 px-6 py-5">
                <h2 class="text-lg font-semibold text-gray-900">
                    Список адміністраторів
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Усі користувачі, які мають доступ до панелі керування.
                </p>
            </div>

            <div v-if="admins.length">
                <!-- Desktop -->
                <div class="hidden md:block">
                    <div
                        v-for="admin in admins"
                        :key="admin.id"
                        class="flex items-center justify-between border-b border-gray-100 px-6 py-5 last:border-b-0"
                    >
                        <div class="min-w-0">
                            <p class="font-medium text-gray-900">
                                {{ admin.name }}
                            </p>

                            <p class="mt-1 truncate text-sm text-gray-500">
                                {{ admin.email }}
                            </p>

                            <p class="mt-1 text-xs text-gray-400">
                                Доданий:
                                {{ formatDate(admin.created_at) }}
                            </p>
                        </div>

                        <div class="flex shrink-0 items-center gap-4">
                            <Link
                                :href="route('admin.admins.edit', admin.id)"
                                class="rounded-lg border border-blue-200 px-4 py-2 text-sm font-medium text-blue-600 transition hover:bg-blue-50"
                            >
                                Редагувати
                            </Link>

                            <button
                                type="button"
                                class="rounded-lg border border-red-200 px-4 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50"
                                @click="deleteAdmin(admin)"
                            >
                                Видалити
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile -->
                <div class="divide-y divide-gray-200 md:hidden">
                    <div v-for="admin in admins" :key="admin.id" class="p-4">
                        <div class="min-w-0">
                            <p class="font-medium text-gray-900">
                                {{ admin.name }}
                            </p>

                            <p class="mt-1 break-all text-sm text-gray-500">
                                {{ admin.email }}
                            </p>

                            <p class="mt-1 text-xs text-gray-400">
                                Доданий:
                                {{ formatDate(admin.created_at) }}
                            </p>
                        </div>

                        <div
                            class="mt-4 flex items-center justify-end gap-4 text-sm"
                        >
                            <Link
                                :href="route('admin.admins.edit', admin.id)"
                                class="rounded-lg border border-blue-200 bg-blue-50 px-1 py-1 font-medium text-blue-600 transition"
                            >
                                Редагувати
                            </Link>

                            <button
                                type="button"
                                class="rounded-lg border border-red-200 bg-red-50 px-1 py-1 font-medium text-red-600 transition"
                                @click="deleteAdmin(admin)"
                            >
                                Видалити
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="px-6 py-10 text-center text-gray-500">
                Адміністраторів поки немає.
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

defineProps({
    admins: {
        type: Array,
        required: true,
    },
});

const formatDate = (value) => {
    if (!value) {
        return "";
    }

    return new Date(value).toLocaleDateString("uk-UA", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
    });
};

const deleteAdmin = (admin) => {
    const confirmed = window.confirm(
        `Ви дійсно хочете видалити адміністратора "${admin.name}"?`,
    );

    if (!confirmed) {
        return;
    }

    router.delete(route("admin.admins.destroy", admin.id));
};
</script>
